<?php

class MPG_SearchController
{

    public static function render()
    {
        require_once(realpath(__DIR__) . '/../views/search/index.php');
    }


    public static function mpg_search($search_string = null)
    {

        try {
            if ($search_string) {
                $search_string = sanitize_text_field($search_string);
            } else if (isset($_GET['s'])) {
                $search_string = sanitize_text_field($_GET['s']);
            }

            if (!$search_string) {
                return []; // it's mean, that it's not a search page 
            }

            global $wpdb;
            $projects = $wpdb->get_results("SELECT id, template_id, source_path, urls_array FROM {$wpdb->prefix}" .  MPG_Constant::MPG_PROJECTS_TABLE . ' WHERE `participate_in_search` = true');

            // Params
            $search_in_links = true;
            $search_in_titles = true;

            $entities_ids = [];

            if ($projects) {
                foreach ($projects as $project) {
                    array_push($entities_ids, [
                        'template_id' => (int) $project->template_id,
                        'project_id' => (int) $project->id,
                        'urls_array' => $search_in_links ? json_decode($project->urls_array, true) : null
                    ]);
                }
            }

            $results = [];

            foreach ($entities_ids as $entity) {

                $template = get_post($entity['template_id']);
                if ($template) {
                    $template_name = $template->post_title;
                    $author_email = get_the_author_meta("user_email", $template->post_author);
                    $author_nickname = get_the_author_meta("nickname", $template->post_author);
                    $author_url =  get_the_author_meta("user_url", $template->post_author); // Нормально не работает

                    if ($search_in_titles) {

                        // Если в названии поста \ страницы, которая установлена как шаблон нет шорткодов,
                        // то и нет смысла ее обрабатывать, т.к. мы точно не знаем какую ссылку на нее дать
                        // Возможно, одна из этих страниц будет поймана по ссылке, или по тексту
                        preg_match_all('/{{mpg_\S+}}/m', $template_name, $matches, PREG_SET_ORDER, 0);

                        if (!empty($matches)) {

                            $project = MPG_ProjectModel::mpg_get_project_by_id($entity['project_id']);
                            $dataset_path = $project[0]->source_path;

                            $dataset_array = MPG_Helper::mpg_get_dataset_array($dataset_path, $entity['project_id']);
                            $headers = $project[0]->headers;

                            $short_codes = MPG_CoreModel::mpg_shortcodes_composer(json_decode($headers));
                            $urls_array = $project[0]->urls_array ? json_decode($project[0]->urls_array) : [];


                            foreach ($urls_array as $index => $url) {

                                $strings = $dataset_array[$index + 1];

                                $replaced_shortcodes_string = preg_replace($short_codes, $strings, $template_name);


                                if ($search_in_links && strpos($url, $search_string) !== false) {

                                    array_push($results, [
                                        'page_title' => $replaced_shortcodes_string,
                                        'page_url' => MPG_Helper::mpg_get_base_url(false) . $url,
                                        'page_excerpt' => MPG_Helper::mpg_prepare_post_excerpt($short_codes, $strings, $template->post_content),
                                        'page_author_nickname' => $author_nickname,
                                        'page_author_email' => $author_email,
                                        'page_author_url' => $author_url,
                                        'page_date' => get_the_date('', $template->ID),
                                    ]);
                                }

                                if (stripos($replaced_shortcodes_string, $search_string) !== false) {
                                    array_push($results, [
                                        'page_title' => $replaced_shortcodes_string,
                                        'page_url' => MPG_Helper::mpg_get_base_url(false) . $url,
                                        'page_excerpt' => MPG_Helper::mpg_prepare_post_excerpt($short_codes, $strings, $template->post_content),
                                        'page_author_nickname' => $author_nickname,
                                        'page_author_email' => $author_email,
                                        'page_author_url' => $author_url,
                                        'page_date' => get_the_date('', $template->ID),
                                    ]);
                                }
                            }
                        }
                    }
                }
            }

            $search_res = MPG_Helper::mpg_unique_array_by_field_value($results, 'post_title');

            return [
                'total' => count($search_res),
                'results' => $search_res
            ];
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public static function mpg_search_shortcode($args)
    {
        if (class_exists('MPG_ProjectController')) {

            $search_string  = isset($args['s']) ? $args['s'] : null;
            $limit          = isset($args['limit']) ? (int) $args['limit'] : 25;
            $base_url       = isset($atts['base-url']) ? (string) $atts['base-url']  : MPG_Helper::mpg_get_base_url(true);


            $search = self::mpg_search($search_string);
            if (!isset($search['total']) || $search['total'] === 0) {
                return;
            }

            $response = '<div class="mpg-search-results">';
            $response .= '<span class="mpg-search-results-count">' . __('Total results:', 'mpg') . ' ' . $search['total'] . '</span>';
            foreach ($search['results'] as $index => $result) {

                $response .= '<div class="mpg-search-results-row">';
                $response .= '<h2 class="mpg-page-titile"><a class="mpg-page-link" href="' . $base_url . $result['guid'] . '">' . $result['post_title'] . '</a></h2>' .
                    '<p class="mpg-page-excerpt">' . $result['post_excerpt'] . '</p>';
                $response .= '</div>';
                if ($index >= $limit - 1) {
                    break;
                }
            }

            $response .= '</div>';

            return $response;
        }
    }

    public static function mpg_search_ajax()
    {

        try {

            $search_query = isset($_POST['s']) ? sanitize_text_field($_POST['s']) : null;

            echo json_encode([
                'success' => true,
                'data' =>  self::mpg_search($search_query)
            ]);
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }

        wp_die();
    }

    public static function mpg_search_settings_upset_options()
    {

        try {
            $result_template = isset($_POST['mpg_search_settings_result_template']) ? esc_html($_POST['mpg_search_settings_result_template']) : null;
            $results_container = isset($_POST['mpg_search_settings_results_container']) ? sanitize_text_field($_POST['mpg_search_settings_results_container']) : null;


            $no_results_container = isset($_POST['mpg_search_settings_no_results_container']) ? sanitize_text_field($_POST['mpg_search_settings_no_results_container']) : null;

            $excerpt_legnth =  isset($_POST['mpg_search_settings_excerpt_legnth']) ? (int) $_POST['mpg_search_settings_excerpt_legnth'] : null;

            update_option('mpg_search_result_template', $result_template);
            update_option('mpg_search_results_container', $results_container);
            update_option('mpg_search_no_results_container', $no_results_container);
            update_option('mpg_search_excerpt_legnth', $excerpt_legnth);

            echo json_encode([
                'success' => true
            ]);
            //
            wp_die();
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
            wp_die();
        }
    }

    public static function mpg_search_settings_get_options()
    {

        try {
            echo json_encode([
                'success' => true,
                'data' => [
                    'mpg_search_result_template' =>  stripslashes(wp_specialchars_decode(get_option('mpg_search_result_template'))),
                    'mpg_search_results_container' => get_option('mpg_search_results_container'),
                    'mpg_search_no_results_container' => get_option('mpg_search_no_results_container'),
                    'mpg_search_excerpt_legnth' => get_option('mpg_search_excerpt_legnth')
                ]
            ]);

            wp_die();
            //
        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'error' => $e->getMessage()
            ]);
            wp_die();
        }
    }
}
