<div class="tab-pane fade" id="shortcode" role="tabpanel" style="margin-top: 20px;" aria-labelledby="shortcode-tab">


    <div class="main-inner-content shadowed">

        <div id="accordion">


            <div class="accordion-pane">
                <div class="card-header" id="headingFour">
                    <h5 class="mb-0">
                        <button class="collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <h2 class="project-name-header"><?php _e('Get shortcode for generated pages', 'mpg'); ?>
                            </h2>
                            <div class="collapse-actions"><i class="fa fa-chevron-down"></i></div>
                        </button>
                    </h5>
                </div>
                <div id="collapseFour" class="collapse show" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body">

                        <div class="sub-section">
                            <div class="block-with-tooltip" style="margin-bottom:20px">
                                <p><?php _e('Select header', 'mpg'); ?></p>
                                <select class="shortcode-headers-dropdown"></select>
                                <div class="tooltip-circle" data-tippy-content="<?php _e('Choose some header from the dropdown to get appropriate shortcode', 'mpg'); ?>"><i class="fa fa-question"></i></div>
                            </div>
                            <div class="block-with-tooltip">
                                <p><?php _e('Shortcode preview', 'mpg'); ?></p>

                                <div class="shortcode-field-copy">
                                    <span class="shortcode-preview-output">
                                        <?php if (isset($headers[0])) {
                                            echo '{{mpg_' . strtolower($headers[0]) . '}}';
                                        } ?>
                                    </span>
                                    <button class="copy-shortcode-btn btn btn-outline-primary"><?php _e('Copy', 'mpg') ?></button>
                                </div>

                            </div>
                        </div>


                        <div class="generate-subtitle">
                            <h2 class="name-header"><?php _e('Generate list', 'mpg'); ?></h2>
                        </div>


                        <div class="sub-section">
                            <div class="block-with-tooltip  conditions-block">
                                <p><?php _e('Set conditions', 'mpg'); ?></p>
                                <div class=" condition-container"></div>
                                <div class="tooltip-circle" data-tippy-content="<?php _e('Use this shortcode to make a list of generated items from your source file. For example you can use this to generate a list of all URLs in your source file that match a certain criteria. Place this shortcode on any page not generated by MPG. This is an excellent tool to build up inlinks for your generated pages.', 'mpg'); ?>"><i class="fa fa-question"></i></div>
                            </div>

                            <div class="block-with-tooltip  conditions-block operator-selector-block">
                                <p><?php _e('Operator', 'mpg'); ?></p>
                                <select id="mpg_operator_selector">
                                    <option disabled value=""><?php _e('Choose operator', 'mpg') ?></option>
                                    <option value="or"><?php _e('OR', 'mpg'); ?></option>
                                    <option value="and"><?php _e('AND', 'mpg'); ?></option>
                                </select>
                                <div class="tooltip-circle" data-tippy-content="<?php _e('Use this to set up relation between fields', 'mpg'); ?>"><i class="fa fa-question"></i></div>
                            </div>
                        </div>

                        <div class="sub-section filters">

                            <div class="block-with-tooltip ">
                                <p><?php _e('Direction', 'mpg'); ?></p>
                                <select id="mpg_direction">
                                    <option disabled selected value=""><?php _e('Choose direction of sorting', 'mpg') ?></option>
                                    <option value="asc"><?php _e('Ascending', 'mpg'); ?></option>
                                    <option value="desc"><?php _e('Descending', 'mpg'); ?></option>
                                    <option value="random"><?php _e('Random', 'mpg'); ?></option>
                                </select>
                                <div class="tooltip-circle" data-tippy-content="<?php _e('Use this to set up column header to sort by (optional)', 'mpg'); ?>"><i class="fa fa-question"></i></div>
                            </div>

                            <div class="block-with-tooltip">
                                <p><?php _e('Order By', 'mpg'); ?></p>
                                <select id="mpg_order_by" disabled="disabled">
                                    <option disabled selected value=""><?php _e('Choose column to order by', 'mpg'); ?></option>
                                </select>
                                <div class="tooltip-circle" data-tippy-content="<?php _e('Use this to set up column header to sort by', 'mpg'); ?>"><i class="fa fa-question"></i></div>
                            </div>


                            <div class="block-with-tooltip ">
                                <p><?php _e('Limit', 'mpg'); ?></p>
                                <input type="number" id="mpg_limit" min="1" step="1" value="5">
                                <div class="tooltip-circle" data-tippy-content="<?php _e('Use this to set up the number of rows that the shortcode will display', 'mpg'); ?>"><i class="fa fa-question"></i></div>
                            </div>

                            <div class="block-with-tooltip ">
                                <p><?php _e('Unique rows', 'mpg'); ?></p>
                                <select id="mpg_unique_rows">
                                    <option selected value=""><?php _e('No', 'mpg'); ?></option>
                                    <option value=""><?php _e('Yes', 'mpg'); ?></option>
                                </select>
                                <div class="tooltip-circle" data-tippy-content="<?php _e('Use this to make shortcode responses without duplicating rows', 'mpg'); ?>"><i class="fa fa-question"></i></div>
                            </div>
                        </div>

                        <div class="sub-section">
                            <div class="block-with-tooltip  conditions-block">
                                <p><?php _e('Choose shortcode', 'mpg'); ?></p>
                                <div class="insert-shortcode-dn">
                                    <select id="mpg_shortcode_tab_insert_shortcode_dropdown"></select>
                                </div>
                            </div>
                        </div>

                        <div class="sub-section">
                            <div class="block-with-tooltip sandbox-container">
                                <p><?php _e('Shortcode sandbox', 'mpg'); ?></p>
                                <div class="sandbox-block">
                                    <code>
                                        <textarea id="mpg_shortcode_sandbox_textarea" style="width:100%; min-height: 100px;">[mpg project-id=""][/mpg]</textarea>
                                    </code>
                                    <button class="btn btn-outline-primary shortcode-preview"><?php _e('Preview', 'mpg'); ?></button>
                                    <button class="btn btn-outline-primary shortcode-copy"><?php _e('Copy', 'mpg'); ?></button>
                                </div>
                            </div>
                            <div class="block-with-tooltip" style="align-items: flex-start;">
                                <p><?php _e('List preview', 'mpg'); ?></p>

                                <div class="mpg_list_preview-block">
                                    <ul id="mpg_list_preview"></ul>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!--.col-md-6 -->
    <div class="sidebar-container">
        <?php require_once('sidebar.php') ?>
    </div>


</div>