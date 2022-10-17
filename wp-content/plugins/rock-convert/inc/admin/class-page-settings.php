<?php

namespace Rock_Convert\Inc\Admin;

use Rock_Convert\inc\libraries\MailChimp;

/**
 * The cta settings page
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rock_Convert\Inc\Admin
 * @link       https://rockcontent.com
 * @since      2.0.0
 *
 * @author     Rock Content
 */
class Page_Settings
{
    public $subscriptions_table_name = "rconvert-subscriptions";

    public function register()
    {
        add_submenu_page(
            'edit.php?post_type=cta',
            __('Configurações do Rock Convert', 'rock-convert'),
            __('Configurações', 'rock-convert'),
            'manage_options',
            'rock-convert-settings',
            array(
                $this,
                'display'
            )
        );
        add_filter('admin_footer_text', array($this, 'custom_admin_footer'));
    }

    public function custom_admin_footer()
    {
        $current_page = get_current_screen();

        if ($current_page->id == "cta_page_rock-convert-settings"
            || $current_page->id == "cta"
        ) {
	        echo 'Rock Convert by <a href="https://stage.rockcontent.com" target="_blank">Stage</a> | <a href="' . ROCK_CONVERT_REPORT_ERROR_URL . '" target="_blank">' . __('Entre em contato com o suporte', 'rock-convert') . '</a>';
        }
    }

    public function save_settings_callback()
    {
        if (isset($_POST['rock_convert_settings_nonce'])
            && wp_verify_nonce($_POST['rock_convert_settings_nonce'],
                'rock_convert_settings_nonce')
        ) {
            $tab = sanitize_key(Utils::getArrayValue($_POST, 'tab'));

            if ($tab == "general") {
                $this->updateGeneralTab();
            }

            if ($tab == "advanced") {
                $this->updateAdvancedTab();
            }

            if ($tab == "integrations") {
                $this->updateIntegrationsTab();
            }

            wp_safe_redirect(
                admin_url('edit.php?post_type=cta&page=rock-convert-settings&tab='
                          . $tab . "&success=true")
            );
        }
    }

    protected function updateGeneralTab()
    {
	    $enable_analytics    = intval(Utils::getArrayValue($_POST, 'rock_convert_enable_analytics'));
	    $enable_name_field   = intval(Utils::getArrayValue($_POST, 'rock_convert_enable_name_field'));
	    $enable_custom_field = intval(Utils::getArrayValue($_POST, 'rock_convert_enable_custom_field'));
	    $custom_field_label  = Utils::getArrayValue($_POST, 'rock_convert_custom_field_label');

	    update_option('_rock_convert_name_field', $enable_name_field);
	    update_option('_rock_convert_custom_field', $enable_custom_field);
	    update_option('_rock_convert_custom_field_label', $custom_field_label);
	    update_option('_rock_convert_enable_analytics', $enable_analytics);
    }

    protected function updateAdvancedTab()
    {
        $g_site_key  = sanitize_text_field(Utils::getArrayValue($_POST, 'g_site_key'));
        $g_secret_key  = sanitize_text_field(Utils::getArrayValue($_POST, 'g_secret_key'));
        $mailchimp_token  = sanitize_key(Utils::getArrayValue($_POST, 'mailchimp_token'));
        $rd_public_token  = sanitize_key(Utils::getArrayValue($_POST, 'rd_station_public_token'));
        $hubspot_form_url = esc_url_raw(Utils::getArrayValue($_POST, 'hubspot_form_url'));

        update_option(
            '_rock_convert_g_site_key', $g_site_key
        );

        update_option(
            '_rock_convert_g_secret_key', $g_secret_key
        );


        update_option(
            '_rock_convert_mailchimp_token', $mailchimp_token
        );

        if (isset($_POST['mailchimp_list'])) {
            $mailchimp_list = Utils::getArrayValue($_POST, 'mailchimp_list');

            update_option(
                '_rock_convert_mailchimp_list', $mailchimp_list
            );
        }

        update_option(
            '_rock_convert_rd_public_token', $rd_public_token
        );

        update_option(
            '_rock_convert_hubspot_form_url', $hubspot_form_url
        );
    }

    protected function updateIntegrationsTab()
    {
        $g_site_key  = sanitize_text_field(Utils::getArrayValue($_POST, 'g_site_key'));
        $g_secret_key  = sanitize_text_field(Utils::getArrayValue($_POST, 'g_secret_key'));

        update_option(
            '_rock_convert_g_site_key', $g_site_key
        );

        update_option(
            '_rock_convert_g_secret_key', $g_secret_key
        );

        $mailchimp_token = Utils::getArrayValue($_POST, 'mailchimp_token');

        update_option(
            '_rock_convert_mailchimp_token', $mailchimp_token
        );

        if (isset($_POST['mailchimp_list'])) {
            $mailchimp_list = Utils::getArrayValue($_POST, 'mailchimp_list');

            update_option(
                '_rock_convert_mailchimp_list', $mailchimp_list
            );
        }
    }

    public function export_csv_callback()
    {
        if (isset($_POST['rock_convert_csv_nonce'])
            && wp_verify_nonce($_POST['rock_convert_csv_nonce'],
                'rock_convert_csv_nonce')
        ) {
            try {
                $exportCSV = new CSV($this->subscriptions_table_name);
            } catch (\Exception $e) {
                //
            }
        }
    }

    public function display()
    {
        $active_tab       = isset($_GET['tab']) ? $_GET['tab'] : 'general';
        $success_saved    = isset($_GET['success']);
        $integrations_tab = 'advanced';
        $title            = 'Rock Convert';
        ?>
        <div class="wrap">

            <h1 class="wp-heading-inline"><?php echo $title; ?></h1>

            <h2 class="nav-tab-wrapper">
                <a href="<?php echo $this->settings_tab_url('general') ?>"
                   class="nav-tab <?php echo $active_tab
                                             == 'general'
                       ? 'nav-tab-active' : ''; ?>"><?php echo __("Início", "rock-convert"); ?></a>
                <a href="<?php echo $this->settings_tab_url($integrations_tab) ?>"
                   class="nav-tab <?php echo in_array($active_tab, array("integrations", "advanced"))
                       ? 'nav-tab-active' : ''; ?>"><?php echo __("Integrações", "rock-convert"); ?></a>
                <a href="<?php echo $this->settings_tab_url('leads') ?>"
                   class="nav-tab <?php echo $active_tab == 'leads'
                       ? 'nav-tab-active' : ''; ?>"><?php echo __("Contatos <span class='rc-new-label contacts'>Novo</span>", "rock-convert"); ?></a>
            </h2>

            <?php if ($success_saved) { ?>
                <div class="notice notice-success is-dismissible">
                    <p><strong><?php echo __("Atualizações realizadas com sucesso!", "rock-convert"); ?></strong></p>
                    <button type="button" class="notice-dismiss">
                        <span class="screen-reader-text">Dismiss this notice.</span>
                    </button>
                </div>
            <?php } ?>

            <div class="rock-convert-settings-wrap">
                <?php if ($active_tab == "general") {
                    $this->general_tab();
                } elseif ($active_tab == "advanced") {
                    $this->advanced_tab();
                } elseif ($active_tab == "integrations") {
                    $this->integrations_tab();
                } elseif ($active_tab == "logs") {
                    $this->logs_tab();
                } else {
                    $this->leads_tab();
                } ?>
            </div>


        </div>
        <?php
    }

    public function settings_tab_url($tab)
    {
        return admin_url("edit.php?post_type=cta&page=rock-convert-settings&tab="
                         . $tab);
    }

    public function general_tab()
    {
	    $settings_nonce       = wp_create_nonce('rock_convert_settings_nonce');
	    $analytics_enabled    = Admin::analytics_enabled();
	    $name_field_enabled   = Admin::name_field_is_enabled();
	    $custom_field_enabled = Admin::custom_field_is_enabled();
	    $custom_field_label   = Admin::custom_field_label_value();
	    $hide_referral        = Admin::hide_referral();
        ?>

        <div id="welcome-panel" class="welcome-panel">

            <div class="welcome-panel-content">

                <div class="welcome-panel-column-container">
                    <div class="welcome-panel-column rock-convert-admin-subscribe-container--left">
                        <h2><?php echo __("Comece a usar", "rock-convert"); ?></h2>
                        <a class="button button-primary button-hero load-customize hide-if-no-customize"
                           href="<?php echo admin_url('post-new.php?post_type=cta') ?>"><?php echo __("Adicionar um banner",
                                "rock-convert"); ?>
                        </a>
                        <h2 style="margin-top: 30px;margin-bottom: 15px;"><?php echo __("Precisa de ajuda?",
                                "rock-convert"); ?></h2>
                        <ul>
                            <li>
                                <a href="<?php echo ROCK_CONVERT_HELP_CENTER_URL; ?>"
                                   target="_blank"
                                   class="welcome-icon welcome-widgets-menus"><?php echo __("Dúvidas comuns (FAQ)",
                                        "rock-convert"); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo ROCK_CONVERT_SUGGEST_FEATURE_URL; ?>"
                                   target="_blank"
                                   class="welcome-icon welcome-write-blog"><?php echo __("Sugerir nova funcionalidade",
                                        "rock-convert"); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo ROCK_CONVERT_REPORT_ERROR_URL; ?>"
                                   target="_blank"
                                   class="welcome-icon welcome-comments"><?php echo __("Relatar um problema",
                                        "rock-convert"); ?></a>
                            </li>
                        </ul>
                    </div>
                    <div class="welcome-panel-column rock-convert-admin-subscribe-container">
                        <h2 style="margin-top: 0;margin-bottom: 15px;"><?php echo __("Próximos passos",
                                "rock-convert"); ?></h2>
                        <ul>
                            <li>
                                <a href="https://rockcontent.com/blog/rock-convert/" target="_blank"
                                   class="welcome-icon welcome-learn-more"><?php echo __("Tudo o que você precisa saber sobre o Rock Convert",
                                        "rock-convert"); ?>
                                </a>
                            </li>
                            <li>
                                <a href="https://rockcontent.com/blog/o-que-e-cta/"
                                   target="_blank"
                                   class="welcome-icon welcome-learn-more"><?php echo __("O que é CTA: Tudo que você precisa saber",
                                        "rock-convert"); ?></a>
                            </li>
                            <li>
                                <a href="https://rockcontent.com/blog/parametros-utm-do-google-analytics/"
                                   class="welcome-icon welcome-learn-more"
                                   target="_blank"><?php echo __("Como usar os parâmetros de UTM",
                                        "rock-convert"); ?></a></li>
                        </ul>

                        <?php $this->newsletter_subscribe_form(); ?>
                    </div>
                </div>
            </div>
        </div>

        <h1 class="wp-heading-inline"><?php echo __("Recursos disponíveis", "rock-convert"); ?></h1>
        <br><br>
        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
              method="post">
            <input type="hidden" name="action"
                   value="rock_convert_settings_form">
            <input type="hidden"
                   name="rock_convert_settings_nonce"
                   value="<?php echo $settings_nonce ?>"/>
            <input type="hidden" name="tab" value="general"/>

            <label for="rock_convert_enable_analytics" style="display: block">
                <input type="checkbox" name="rock_convert_enable_analytics"
                       id="rock_convert_enable_analytics"
                       value="1" <?php echo $analytics_enabled ? "checked" : null ?>/>
                <strong><?php echo __("Salvar visualizações e cliques", "rock-convert"); ?></strong>

                <div style="padding-top: 5px;padding-bottom: 10px;padding-left: 25px;">
                    <small>
                        <i><?php echo __("Ative esta opção para coletar os dados de visualizações e clicks nos banners do Rock Convert.",
                                "rock-convert"); ?></i></small>
                </div>
            </label>
            <h1 class="wp-heading-inline"><?php echo __("Campos adicionais", "rock-convert"); ?></h1>
            <small style="display: block; margin-bottom: 10px;">
                <i><?php echo __("Agora, além do email, você também pode captar dados adicionais de seus leads.",
				        "rock-convert"); ?></i></small>
            <label for="rock_convert_enable_name_field" style="display: block">
                <input type="checkbox" name="rock_convert_enable_name_field"
                       id="rock_convert_enable_name_field"
                       value="1" <?php echo $name_field_enabled ? "checked" : null ?>>
                <strong><?php echo __("Ativar o campo 'Nome' no formulário do Widget", "rock-convert"); ?>
                    <span class="rock-convert-label-new"><?php echo __("Novo!", "rock-convert"); ?></span>
                </strong>
                <div style="padding-top: 5px;padding-bottom: 25px;padding-left: 25px;">
                    <small>
                        <i><?php echo __("Ative esta opção para adicionar um novo campo para capturar o Nome do usuário.",
					            "rock-convert"); ?></i></small>
                </div>
            </label>

            <label for="rock_convert_enable_custom_field" style="display: block">
                <input type="checkbox" name="rock_convert_enable_custom_field"
                       id="rock_convert_enable_custom_field"
                       value="1" <?php echo $custom_field_enabled ? "checked" : null ?>>
                <strong><?php echo __("Ativar campo customizado", "rock-convert"); ?>
                    <span class="rock-convert-label-new"><?php echo __("Novo!", "rock-convert"); ?></span>
                </strong>
                <div style="padding-top: 5px;padding-bottom: 5px;padding-left: 25px;">
                    <small>
                        <i><?php echo __("Ative esta opção para configurar um campo extra no formulário do widget, selecione uma label para o campo.",
					            "rock-convert"); ?></i></small>
                </div>
            </label>
            <label id="rock-convert-label-container" class="d-none" for="rock_convert_custom_field_label" style="display: block; margin-left: 25px;">
                <strong style="display: block"><?php echo __("Selecione a label do campo", "rock-convert"); ?></strong>
                <input type="text" name="rock_convert_custom_field_label" id="rock_convert_custom_field_label" value="<?php echo $custom_field_label;?>">
                <div style="padding-top: 5px;padding-bottom: 25px;">
                    <small>
                        <i><?php echo __("Selecione o título que será exibido acima do campo no formulário do widget.",
					            "rock-convert"); ?></i></small>
                </div>
            </label>

            <button type="submit" class="button button-large button-primary"><?php echo __("Salvar configurações",
                    "rock-convert"); ?></button>
        </form>

        <?php
    }

    public function newsletter_subscribe_form()
    {
        ?>
        <h2><?php echo __("Atualizações", "rock-convert"); ?></h2>
        <p class="about-description"><?php echo __("Cadastre seu e-mail abaixo para receber novidades do Rock Convert!",
                "rock-convert"); ?></p>
        <!--[if lte IE 8]>
        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
        <![endif]-->
        <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
        <script>
            hbspt.forms.create({
                portalId: "355484",
                formId: "b674c60c-f3e5-4f22-95f3-2204100e8a62",
                redirectUrl: "<?php echo esc_url_raw(admin_url('edit.php?post_type=cta&page=rock-convert-settings&success=newsletter')); ?>",
                submitButtonClass: "button button-primary button-hero rock-convert-newsletter-form__btn",
                groupErrors: true
            });
        </script>

        <?php
    }

    public function advanced_tab()
    {
        $settings_nonce = wp_create_nonce('rock_convert_settings_nonce');
        ?>

        <h1 class="wp-heading-inline"><?php echo __("Ferramentas de automação", "rock-convert"); ?></h1>

        <p style="max-width: 580px">
            <?php echo __("Selecione abaixo uma ferramenta de automação e envie os leads gerados pelos formulários do Rock Convert.",
                "rock-convert"); ?>
        </p>

        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
              method="post">
            <input type="hidden" name="tab" value="<?php echo esc_attr("advanced")?>"/>
            <input type="hidden" name="action"
                   value="<?php echo esc_attr("rock_convert_settings_form")?>">
            <input type="hidden" name="rock_convert_settings_nonce"
                   value="<?php echo esc_attr($settings_nonce); ?>"/>
            <div class="rock-convert-how-it-works">
                <?php $this->google_form(); ?>
                <hr>
                <br>
                <?php $this->mailchimp_form(); ?>
                <hr>
                <br>
                <?php $this->rd_station_form(); ?>
                <hr>
                <br>
                <?php $this->hubspot_form(); ?>
            </div>

            <button type="submit" class="button button-large button-primary"><?php echo __("Salvar integrações",
                    "rock-convert"); ?></button>
        </form>
        <?php
    }

    public function google_form()
    {
        $g_site_key = get_option('_rock_convert_g_site_key');
        $g_secret_key = get_option('_rock_convert_g_secret_key');
        ?>

        <h3 style="margin-bottom: 0;">Google</h3>

        <table class="form-table">
            <tbody>
            <tr>
                <th>
                    <label for="g_site_key">
                        <?php echo __("Chave do site", "rock-convert"); ?>
                    </label>
                </th>
                <td>
                    <input name="g_site_key"
                           id="g_site_key"
                           type="text"
                           placeholder="Ex: 54567958d8f7k8789jfd987d8ks"
                           class="regular-text code"
                           value="<?php echo $g_site_key ?>">
                    <br>
                </td>
            </tr>
            <tr>
                <th>
                    <label for="g_secret_key">
                        <?php echo __("Chave secreta", "rock-convert"); ?>
                    </label>
                </th>
                <td>
                    <input name="g_secret_key"
                           id="g_secret_key"
                           type="text"
                           placeholder="Ex: 54567958d8f7k8789jfd987d8ks"
                           class="regular-text code"
                           value="<?php echo $g_secret_key ?>">
                    <br>
                    <small><?php echo __("Precisa de ajuda para criar a chave?", "rock-convert"); ?> <a
                                href="https://www.google.com/recaptcha/admin/create"
                                target="_blank"><?php echo __("Acesse o painel do Google e crie um reCaptcha v2",
                                "rock-convert"); ?></a></small>
                </td>
            </tr>
            </tbody>
        </table>
        <?php
    }

    public function mailchimp_form()
    {
        $mailchimp_token = get_option('_rock_convert_mailchimp_token');
        $mailchimp_list  = get_option('_rock_convert_mailchimp_list');

        $lists = $this->get_mailchimp_lists($mailchimp_token);

        ?>

        <h3 style="margin-bottom: 0;">MailChimp</h3>

        <table class="form-table">
            <tbody>
            <tr>
                <th>
                    <label for="mailchimp_token">
                        <?php echo __("Chave de API do MailChimp", "rock-convert"); ?>
                    </label>
                </th>
                <td>
                    <input name="mailchimp_token"
                           id="mailchimp_token"
                           type="text"
                           placeholder="Ex: abc123abc123abc123abc123abc123-us"
                           class="regular-text code"
                           value="<?php echo esc_attr($mailchimp_token); ?>">
                    <br>
                    <small><?php echo __("Precisa de ajuda?", "rock-convert"); ?> <a
                                href="https://mailchimp.com/help/about-api-keys/"
                                target="_blank"><?php echo __("Veja como criar uma chave de API para o MailChimp",
                                "rock-convert"); ?></a>
                    </small>
                </td>
            </tr>
            <?php if ( ! empty($mailchimp_token) && empty($lists)) { ?>
                <tr>
                    <th>
                    </th>
                    <td>
                        <span style="color: orangered;font-weight: bold"><?php echo __("Atenção: nenhuma lista encontrada.",
                                "rock-convert"); ?></span>
                        <br/>
                        <small>
                            <?php
                            $url  = 'https://rockcontent.com/blog/mailchimp/#listas';
                            $link = sprintf(wp_kses(__('Confira se a chave de API está correta e se esta conta já possui uma lista criada. Caso ainda não tenha nenhuma lista, saiba como criar <a href="%s">clicando aqui</a>.',
                                'rock-convert'),
                                array('a' => array('href' => array()))), esc_url($url));
                            echo $link;
                            ?>
                        </small>
                    </td>
                </tr>
            <?php } ?>
            <?php if ( ! empty($mailchimp_token) && ! empty($lists)) { ?>
                <tr>
                    <th>
                        <label for="mailchimp_list">
                            <?php echo __("Selecione uma lista", "rock-convert"); ?>
                        </label>
                    </th>
                    <td>
                        <select name="mailchimp_list" id="mailchimp_list" class="regular-text code">
                            <option>-- <?php echo __("Selecione uma lista", "rock-convert"); ?> --</option>
                            <?php foreach ($lists as $list) { ?>
                                <option value="<?php echo $list['id']; ?>" <?php echo $mailchimp_list == $list['id'] ? "selected" : null ?>>
                                    <?php echo $list['name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <br>
                        <small><?php echo __("Escolha uma lista para enviar os contatos coletados pelo Rock Convert.",
                                "rock-convert"); ?></small>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <?php
    }

    /**
     * @param $token
     *
     * @return array|bool
     */
    public function get_mailchimp_lists($token)
    {
        if (empty($token)) {
            return array();
        }

        try {
            $MailChimp = new MailChimp($token);

            return $MailChimp->getLists();
        } catch (\Exception $e) {
            Utils::logError($e);

            return array();
        }
    }

    public function rd_station_form()
    {
        $rd_public_token = get_option('_rock_convert_rd_public_token');

        ?>
        <h3 style="margin-bottom: 0;">RD Station</h3>

        <table class="form-table">
            <tbody>
            <tr>
                <th>
                    <label for="rd_station_public_token">
                        <?php echo __("Token público da RD Station", "rock-convert"); ?>
                    </label>
                </th>
                <td>
                    <input name="rd_station_public_token"
                           id="rd_station_public_token"
                           type="text" placeholder="Ex: e580854190764dbdaf19ac942334b0fc"
                           class="regular-text code"
                           value="<?php echo $rd_public_token ?>">

                    <br>

                    <?php if ( ! empty($rd_public_token) ) { ?>
                        <small><strong><?php echo __("Identificador único de leads:", "rock-convert" ); ?></strong> rock-convert-<?php echo( sanitize_title( get_bloginfo('name') ) ); ?></small>
                        <br><br>
                    <?php } ?>

                    <small><?php echo __("Para encontrar o token público da RD Station acesse:", "rock-convert"); ?>
                        <a href="https://app.rdstation.com.br/integracoes/tokens" target="_blank">https://app.rdstation.com.br/integracoes/tokens</a>
                    </small>
                </td>
            </tr>
            </tbody>
        </table>
        </p>
        <?php
    }

    public function hubspot_form()
    {
        $hubspot_form_url = get_option('_rock_convert_hubspot_form_url');
        ?>

        <h3 style="margin-bottom: 0;">HubSpot</h3>

        <table class="form-table">
            <tbody>
            <tr>
                <th>
                    <label for="hubspot_form_url">
                        <?php echo __("URL do form da HubSpot", "rock-convert"); ?>
                    </label>
                </th>
                <td>
                    <input name="hubspot_form_url"
                           id="hubspot_form_url"
                           type="text"
                           placeholder="Ex: https://forms.hubspot.com/uploads/form/v2/:portal_id/:form_guid"
                           class="regular-text code"
                           value="<?php echo $hubspot_form_url ?>">
                    <br>
                    <small><?php echo __("Precisa de ajuda?", "rock-convert"); ?> <a
                                href="https://developers.hubspot.com/docs/methods/forms/submit_form"
                                target="_blank"><?php echo __("Acesse a central de ajuda da HubSpot",
                                "rock-convert"); ?></a></small>
                    <br>
                    <br>
                    <small><strong><?php echo __("Formato da URL:", "rock-convert"); ?> </strong>https://forms.hubspot.com/uploads/form/v2/<strong>PORTAL_ID</strong>/<strong>FORM_GUID</strong>
                    </small>
                    <br><br>
                    <small><?php echo __("Onde: <strong>PORTAL_ID</strong> é o id da conta e <strong>FORM_GUID</strong> é o ID do
                        formulário.", "rock-convert"); ?></small>
                </td>
            </tr>
            </tbody>
        </table>
        <?php
    }

    public function integrations_tab()
    {
        $settings_nonce = wp_create_nonce('rock_convert_settings_nonce');
        ?>

        <h1 class="wp-heading-inline"><?php echo __("Ferramentas de automação", "rock-convert"); ?></h1>

        <p style="max-width: 580px">
            <?php echo __("Selecione abaixo uma ferramenta de automação e envie os leads gerados pelos formulários do Rock Convert.",
                "rock-convert"); ?>
        </p>
        <br>

        <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
              method="post">
            <input type="hidden" name="tab" value="<?php echo esc_attr("integrations"); ?>"/>
            <input type="hidden" name="action"
                   value="<?php echo esc_attr("rock_convert_settings_form"); ?>">
            <input type="hidden" name="rock_convert_settings_nonce"
                   value="<?php echo esc_attr($settings_nonce); ?>"/>
            <div class="rock-convert-how-it-works">
                <?php $this->google_form(); ?>
                <br>
                <?php $this->mailchimp_form(); ?>
                <br>
	            <?php $this->rd_station_form(); ?>
                <br>
	            <?php $this->hubspot_form(); ?>
                <br>
            </div>

            <button type="submit" class="button button-large button-primary"><?php echo __("Salvar integrações",
                    "rock-convert"); ?></button>
        </form>
        <?php
    }

    public function logs_tab()
    {
        $file    = plugin_dir_path(__FILE__) . "logs/debug.log";
        $content = Utils::read_backward_line($file, 300);
        ?>
        <h2>Log</h2>
        <div style="height: 100%; overflow-x: scroll">
            <pre><?php echo $content; ?></pre>
        </div>
        <?php
    }

    public function leads_tab()
    {
        $csv_nonce = wp_create_nonce('rock_convert_csv_nonce');
        ?>
        <div class="rock-leads-viewer-container">

            <div class="rock-leads-content leads-table">
			    <?php self::leads_viewer(); ?>
            </div>
            <div class="rock-leads-content leads-download">
                <h1 class="wp-heading-inline"><?php echo __("Exportar", "rock-convert"); ?></h1>
                <p>
				    <?php echo __("Para fazer o download dos contatos capturados pelo formulário de download no formato <strong>CSV</strong>, clique abaixo.",
					    "rock-convert"); ?>
                </p>
                <p>
                    <strong><?php echo $this->get_leads_count(); ?></strong>
				    <?php echo __("contatos salvos.", "rock-convert"); ?>
                </p>
                <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
                      method="post" target="_blank">
                    <input type="hidden" name="action"
                           value="<?php echo esc_attr("rock_convert_export_csv"); ?>">
                    <input type="hidden" name="rock_convert_csv_nonce"
                           value="<?php echo esc_attr($csv_nonce) ?>"/>
                    <button type="submit" class="button button-primary button-hero">
					    <?php echo __("Exportar no formato CSV", "rock-convert"); ?>
                    </button>
                </form>
            </div>
        </div>
        <?php
    }

	private function leads_viewer()
    {
	    global $wpdb;
	    $table     = $wpdb->prefix . $this->subscriptions_table_name;
	    $query     = "(SELECT * FROM `$table`)";
	    $rpp       = 10;
	    $page      = isset($_GET['cpage']) ? (int) $_GET['cpage'] : 1;
	    $offset    = ($page * $rpp) - $rpp;
	    $get_leads = $wpdb->get_results("$query ORDER BY created_at DESC LIMIT {$offset},{$rpp}");
	    $paginate  = $wpdb->get_var("(SELECT COUNT(*) FROM $query as paginate)");
	    $ajax_url  = admin_url('admin-ajax.php');

	    echo "<table class='widefat' data-ajaxurl='$ajax_url'>";
	    echo "<thead>";
	    echo "<tr>";
        if(Admin::name_field_is_enabled())
        {
	        echo "<th scope='col'>".__('Nome','rock-convert')."</th>";
        }
	    echo "<th scope='col'>".__('Email','rock-convert')."</th>";
	    if(Admin::custom_field_is_enabled())
	    {
		    echo "<th scope='col'>".Admin::custom_field_label_value()."</th>";
	    }
	    echo "<th scope='col' class='url'>".__('Origem','rock-convert')."</th>";
	    echo "<th scope='col' class='date'>".__('Data','rock-convert')."</th>";
	    echo "<th scope='col'></th>";
	    echo "</tr>";
	    echo "</thead>";
	    echo "<tbody>";
	    if($get_leads)
	    {
		    foreach($get_leads as $lead):
			    $url   = ($lead->post_id == 0 ?
				    "<a href='" . home_url() . "' title='" . __('Página Inicial', 'rock-convert') . "' target='_blank'>" . __('Página Inicial', 'rock-convert') . "</a>" :
				    "<a href='" . get_permalink($lead->post_id) . "' title='" . get_the_title($lead->post_id) . "' target='_blank'>" . get_the_title($lead->post_id) . "</a>"
			    );
			    $date  = date(__('d-m-Y à\s H:i:s', 'rock-convert'), strtotime($lead->created_at));
			    $nonce = wp_create_nonce("delete-entry-nonce-{$lead->id}");
			    echo "<tr class='alternate' id='entry-{$lead->id}'>";
                echo (Admin::name_field_is_enabled() ? "<td>$lead->user_name</td>" : "");
			    echo "<td>$lead->email</td>";
			    echo (Admin::custom_field_is_enabled() ? "<td>$lead->custom_field</td>" : "");
			    echo "<td>$url</td>";
			    echo "<td>$date</td>";
			    $delete = __('Excluir', 'rock-convert');
			    echo "<td class='rock-lead-delete-action'><a href='#' data-nonce='$nonce' data-entry='{$lead->id}' data-email='{$lead->email}' title='$delete'>$delete</a></td>";
			    echo "</tr>";
		    endforeach;
	    } else
	    {
		    echo "<tr><td class='align-center' colspan='5'>" . __('Nenhum contato cadastrado ainda', 'rock-convert') . "</td></tr>";
        }
	    echo "</tbody>";
	    echo "</table>";
	    echo "<div class='paginate-table'>".paginate_links(array(
		    'base'      => add_query_arg('cpage', '%#%'),
		    'format'    => '',
		    'prev_text' => __('&laquo;'),
		    'next_text' => __('&raquo;'),
		    'total'     => ceil($paginate / $rpp),
		    'current'   => $page
	    ))."</div>";
    }

	public static function confirm_delete_lead()
    {
	    if(!current_user_can('administrator'))
	    {
		    exit;
	    }
	    if(!isset($_POST['entry']))
	    {
		    exit;
	    }
	    check_ajax_referer("delete-entry-nonce-{$_POST['entry']}",'security');
	    ?>
        <div class='rock-confirm-delete-lead'>
            <h3><?php _e('Confirmar Exclusão?','rock-convert')?></h3>
            <strong><?php echo $_POST['email']; ?></strong>
            <p>
                <?php _e('Esta ação não poderá ser desfeita','rock-convert')?>
            </p>
            <div class="delete-actions">
                <button class="confirm-action button-primary" data-entry="<?php echo $_POST['entry']; ?>"><?php _e('Confirmar', 'rock-convert') ?></button>
                <button class="cancel-action button-secondary"><?php _e('Cancelar', 'rock-convert') ?></button>
            </div>
        </div><span class="overlay"></span>
	    <?php
        exit;
    }

	public static function delete_lead()
    {
        if(!current_user_can('administrator'))
        {
            exit;
        }
        if(!isset($_POST['entry']))
        {
            exit;
        }
        check_ajax_referer("delete-entry-nonce-{$_POST['entry']}",'security');
        global $wpdb;
	    $instance = new self();
	    $table    = $wpdb->prefix . $instance->subscriptions_table_name;
	    $lead_id  = $_POST['entry'];
	    $wpdb->delete($table, ['id' => $lead_id]);
        exit;
    }

    /**
     * Get number of subscribers saved in $this->subscriptions_table_name table
     *
     * @return int
     */
    public function get_leads_count()
    {
        global $wpdb;
        $table   = $wpdb->prefix . $this->subscriptions_table_name;
        $query   = "SELECT COUNT(*) as count FROM `" . $table . "`;";
        $results = $wpdb->get_results($query);

        if (count($results)) {
            return $results[0]->count;
        } else {
            return 0;
        }
    }

    /**
     * Add plugin action links.
     *
     * Add a link to the settings page on the plugins.php page.
     *
     * @since 2.0.0
     *
     * @param  array $links List of existing plugin action links.
     *
     * @return array         List of modified plugin action links.
     */
    public function action_links($links)
    {
        $integrations_tab = 'advanced';

        $links = array_merge(array(
            '<a href="' . $this->settings_tab_url('general') . '">'
            . __('Configurações', 'rock-convert') . '</a>',
            '<a href="' . $this->settings_tab_url($integrations_tab) . '">'
            . __('Integrações', 'rock-convert') . '</a>'
        ), $links);

        return $links;
    }

}
/** Confirm delete lead action */
add_action('wp_ajax_confirm_delete_lead', array('Rock_Convert\Inc\Admin\Page_Settings', 'confirm_delete_lead'));
add_action('wp_ajax_nopriv_confirm_delete_lead', array('Rock_Convert\Inc\Admin\Page_Settings', 'confirm_delete_lead'));

/** Delete lead action */
add_action('wp_ajax_delete_lead', array('Rock_Convert\Inc\Admin\Page_Settings', 'delete_lead'));
add_action('wp_ajax_nopriv_delete_lead', array('Rock_Convert\Inc\Admin\Page_Settings', 'delete_lead'));
