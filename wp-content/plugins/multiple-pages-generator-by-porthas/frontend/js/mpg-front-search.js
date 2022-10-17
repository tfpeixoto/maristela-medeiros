
(async function () {

    const [rawSearchSettings, rawSerchResults] = await Promise.all([
        jQuery.post(backendData.ajaxUrl, { action: 'mpg_search_settings_get_options' }),
        jQuery.post(backendData.ajaxUrl, {
            action: 'mpg_get_search_results',
            s: (new URL(location.href)).searchParams.get('s')
        })
    ]);

    let searchResults = JSON.parse(rawSerchResults);

    let searchSettings = JSON.parse(rawSearchSettings);

    if (searchResults.success && searchSettings.success) {

        let pageContentSelector = jQuery(searchSettings?.data?.mpg_search_results_container);
        const trimImages = true;


        const noResultsSelector = searchSettings?.data?.mpg_search_no_results_container;
        if (searchResults?.data?.total && noResultsSelector) {
            // pageContentSelector = jQuery(noResultsSelector);
            // pageContentSelector.empty();
        }



        const template = searchSettings?.data?.mpg_search_result_template;
        searchResults.data.results.forEach(result => {

            dom = template
                .replace(/{{mpg_page_title}}/g, result.page_title)
                .replace(/{{mpg_page_excerpt}}/g, result.page_excerpt)
                .replace(/{{mpg_page_author_nickname}}/g, result.page_author_nickname)

                .replace(/{{mpg_page_author_email}}/g, result.page_author_email)
                .replace(/{{mpg_page_author_url}}/g, result.page_author_url)


                .replace(/{{mpg_page_url}}/g, result.page_url)
                .replace(/{{mpg_page_date}}/g, result.page_date)

            pageContentSelector.append(dom);

        })
    }



})();