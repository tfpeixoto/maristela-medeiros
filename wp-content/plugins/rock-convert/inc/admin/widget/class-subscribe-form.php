<?php

namespace Rock_Convert\Inc\Admin\Widget;

use Rock_Convert\Inc\Admin\Subscriber;

class Subscribe_Form
{
    /**
     * Callback from subscribe form;
     *
     * Here if the email and post_id are valid it will:
     *  * Store email in database
     *  * Send to RD_Station if is integrated
     *  * Send to Hubspot if is integrated
     *  * Redirect to the page back
     *
     * @since 2.1.0
     */
    public function subscribe_form_callback()
    {

        if (isset($_POST['rock_convert_subscribe_nonce']) && 
            wp_verify_nonce($_POST['rock_convert_subscribe_nonce'],'rock_convert_subscriber_nonce'))
        {
            $url = esc_url_raw($_POST['rock_convert_subscribe_page']);

            if(get_option('_rock_convert_g_site_key') && get_option('_rock_convert_g_secret_key')){
                
                if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
                
                    $g_response = $this->recaptcha_response();
    
                    if ($g_response->success === true){
                        $this->save_email($url);
                        $status = $this->save_email_status('success');
                    }
    
                }else{
                    $status = $this->save_email_status('recaptcha');
                }

            }else{
                $this->save_email($url);
                $status = $this->save_email_status('success');
            }

            $redirect_id = sanitize_text_field($_POST['rock_convert_subscribe_redirect_page']);
           
            if ( ! ! intval($redirect_id)) {
                $redirect_url = get_permalink(get_post($redirect_id));
                $this->redirect($redirect_url);
                exit;
            }
            
            $this->redirect(esc_url_raw(add_query_arg($status, $url)));
            exit;
        }
    }

    public function recaptcha_response()
    {
        $response = $_POST['g-recaptcha-response'];
        $secret = get_option('_rock_convert_g_secret_key');

        $siteverify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response);  
        $json_response = json_decode($siteverify);

        return $json_response;
    }

    public function save_email($url)
    {
	    $email        = sanitize_email($_POST['rock_convert_subscribe_email']);
	    $post_id      = sanitize_text_field($_POST['rock_get_current_post_id']);
	    $name_field   = (isset($_POST['rock_convert_subscribe_name']) ? sanitize_text_field($_POST['rock_convert_subscribe_name']) : null);
	    $custom_field = (isset($_POST['rock_convert_subscribe_custom_field']) ? sanitize_text_field($_POST['rock_convert_subscribe_custom_field']) : null);
	    $subscriber   = new Subscriber($email, $post_id, $url, $name_field, $custom_field);
         
        if ( ! $subscriber->subscribe("rock-convert-". sanitize_title( get_bloginfo('name') ) )) {
            $status = $this->save_email_status('error');
        }
    }

    public function save_email_status($status)
    {
        if($status === 'error') {
            $status = array("error" => "rc-subscribe-email-invalid#rock-convert-alert-box");
        }elseif($status === 'success') {
            $status = array("success" => "rc-subscribed#rock-convert-alert-box");
        }elseif($status === 'recaptcha') {
            $status = array("recaptcha" => "rc-recaptcha-invalid#rock-convert-alert-box");
        }

        return $status;
    }

    /**
     * Redirect
     *
     * @since    2.0.0
     */
    public function redirect($path)
    {
        wp_safe_redirect(esc_url_raw($path));
    }
}
