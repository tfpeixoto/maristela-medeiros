import { translate } from "../lang/init.js";

jQuery(document).ready(async function () {

    const search = await jQuery.post(ajaxurl, {
        action: 'mpg_search_settings_get_options'
    });

    let searchData = JSON.parse(search);

    if (!searchData.success) {
        toastr.error(searchData.error, translate['Failed']);
    } else {
        jQuery('#mpg_search_settings_result_template').val(searchData?.data?.mpg_search_result_template)
        jQuery('#mpg_search_settings_results_container').val(searchData?.data?.mpg_search_results_container);
        jQuery('#mpg_search_settings_no_results_container').val(searchData?.data?.mpg_search_no_results_container);
        jQuery('#mpg_search_settings_excerpt_legnth').val(searchData?.data?.mpg_search_excerpt_legnth);
    }

});




jQuery('.search-page #mpg_search_settings_form').on('submit', async function (e) {

    e.preventDefault();

    const searchSettingsResultTemplate = jQuery('#mpg_search_settings_result_template').val();
    const searchSettingsResultsContainer = jQuery('#mpg_search_settings_results_container').val();
    const searchSettingsNoResultsContainer = jQuery('#mpg_search_settings_no_results_container').val();
    const searchSettingsExcerptLegnth = jQuery('#mpg_search_settings_excerpt_legnth').val();

    const search = await jQuery.post(ajaxurl, {
        action: 'mpg_search_settings_upset_options',
        'mpg_search_settings_result_template': searchSettingsResultTemplate,
        'mpg_search_settings_results_container': searchSettingsResultsContainer,
        'mpg_search_settings_no_results_container': searchSettingsNoResultsContainer,
        'mpg_search_settings_excerpt_legnth': searchSettingsExcerptLegnth
    });

    let searchData = JSON.parse(search);

    if (!searchData.success) {
        toastr.error(searchData.error, translate['Failed']);
    } else {
        toastr.success(translate['Success'], { timeOut: 5000 });
    }
});

