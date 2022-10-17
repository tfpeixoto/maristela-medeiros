<?php

if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_head', ['Helper', 'mpg_header_code_container']);
?>

<div class="tab-pane main-tabpane" id="search" role="tabpanel" aria-labelledby="search-tab">
    <div class='main-inner-content shadowed'>

        <div class="search-page">
            <div class="search-tab-top">
                <h2><?php _e('Search settings', 'mpg'); ?></h2>
            </div>

            <form action="" id="mpg_search_settings_form">

                <section>
                    <p class="mpg-subtitle"><?php _e('Single search result template', 'mpg'); ?></p>
                    <p style="margin-top: 1rem;"><?php _e("Paste HTML code of single result on a search results page, and replace static text to shortcodes presented below", 'mpg'); ?></p>

                    <textarea required="required" id="mpg_search_settings_result_template" style="width: 100%" rows="5"></textarea>
                    <p><?php _e('Shortcodes:', 'mpg');?></p>
                    <p> <mark>{{mpg_page_title}}</mark>
                        <mark>{{mpg_page_excerpt}}</mark>
                        <mark>{{mpg_page_author_nickname}}</mark>

                        <mark>{{mpg_page_author_email}}</mark>
                        <mark>{{mpg_page_author_url}}</mark>

                        <mark>{{mpg_page_url}}</mark>
                        <mark>{{mpg_page_date}}</mark>
                    </p>
                </section>

                <section>

                    <p class="mpg-subtitle"><?php _e('Search results block selector', 'mpg'); ?></p>
                    <p style="margin-top: 1rem;"><?php _e('Set selector for block, that will be used as a container for the results from MPG', 'mpg'); ?></p>
                    <input required="required" type="text" id="mpg_search_settings_results_container">
                </section>

                <section>

                    <p class="mpg-subtitle"><?php _e('No results block selector', 'mpg'); ?></p>
                    <p style="margin-top: 1rem;"><?php _e('Use these settings if active theme have block with no-result data. This block will be replaced with the search results from MPG (if any)', 'mpg'); ?></p>
                    <input type="text" id="mpg_search_settings_no_results_container">
                </section>

                <section>
                    <p class="mpg-subtitle"><?php _e('Excerpt length ', 'mpg'); ?></p>
                    <p style="margin-top: 1rem;"><?php _e('Use these setting to set max words in the search results.', 'mpg'); ?></p>
                    <input type="number" value="50" id="mpg_search_settings_excerpt_legnth">

                </section>

                <button type="submit" style="margin: 25px" class="btn btn-primary"><?php _e("Update", 'mpg'); ?></button>
            </form>
        </div>
    </div>
</div>

<div class="sidebar-container">
    <?php require_once('sidebar.php') ?>
</div>
</div>