<?php
/**
 * TC  Post carousel settings API
 *
 *
 */
if ( !class_exists('TC_post_cacrousel_Settings' ) ):
class TC_post_cacrousel_Settings {

    private $settings_api;

    function __construct() {
        $this->settings_api = new themesCode_Settings_API;

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this,'tc_menu_page'));
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function tc_menu_page(){
    add_menu_page(
        __( 'TC Plugin', 'textdomain' ),
        'TC Post Carousel',
        'manage_options',
        'tc-post-carousel',
        array($this, 'plugin_page'),

        'dashicons-slides',
        6
    );
}



    function my_custom_submenu_page_callback() {

        echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
            echo '<h2>My Custom Submenu Page</h2>';
        echo '</div>';

    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'tc_post_carousel_basics',
                'title' => __( 'Basic Settings', 'tc-wps' )
            ),
            array(
                'id' => 'tc_post_carousel_advanced',
                'title' => __( 'Advanced Settings', 'tc-wps' )
            ),
            array(
                'id' => 'tc_post_carousel_styling',
                'title' => __( 'Styling Settings', 'tc-wps' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'tc_post_carousel_basics' => array(

              array(
                  'name'    => 'auto-play',
                  'label'   => __( 'Auto Play', 'tc-wps' ),
                  'desc'    => __( 'By default  Auto Play is active.', 'tc-wps' ),
                  'type'    => 'select',
                  'default' => 'true',
                  'options' => array(
                      'true' => 'Yes',
                      'false'  => 'No'
                  )
              ),
              array(
                  'name'    => 'stop-onhover',
                  'label'   => __( 'Stop On Hover', 'tc-wps' ),
                  'desc'    => __( 'By default  Stop On Hover is active.', 'tc-wps' ),
                  'type'    => 'select',
                  'default' => 'true',
                  'options' => array(
                      'true' => 'Yes',
                      'false'  => 'No'
                  )
              ),
              array(
                  'name'              => 'large-item-val',
                  'label'             => __( 'Posts Number ( Lg Screen )', 'tc-wps' ),
                  'desc'              => __( 'Any Numaric value. 4 is recomended.', 'tc-wps' ),
                  'type'              => 'text',
                  'default'           => 4,
                  'sanitize_callback' => 'intval'
              ),
              array(
                  'name'              => 'items-desktop-val',
                  'label'             => __( 'Posts Number ( Desktop )', 'tc-wps' ),
                  'desc'              => __( 'Any Numaric value. 4 is recomended', 'tc-wps' ),
                  'type'              => 'text',
                  'default'           => 4,
                  'sanitize_callback' => 'intval'
              ),
              array(
                  'name'              => 'items-desktop-small-val',
                  'label'             => __( 'Posts Number ( Desktop SM)', 'tc-wps' ),
                  'desc'              => __( 'Any Numaric value. 4 is recomended', 'tc-wps' ),
                  'type'              => 'text',
                  'default'           => 4,
                  'sanitize_callback' => 'intval'
              ),
              array(
                  'name'              => 'items-tablet-val',
                  'label'             => __( 'Posts Number ( Tablet )', 'tc-wps' ),
                  'desc'              => __( 'Any Numaric value. 2 is recomended', 'tc-wps' ),
                  'type'              => 'text',
                  'default'           => 2,
                  'sanitize_callback' => 'intval'
              )


            ),
            'tc_post_carousel_advanced' => array(

                              array(
                    'name'    => 'navigation-val',
                    'label'   => __( 'Navigation ', 'tc-wps' ),
                    'desc'    => __( 'show/hide Navigation', 'tc-wps' ),
                    'type'    => 'select',
                    'default' => 'false',
                    'options' => array(
                        'true' => 'Yes',
                        'false'  => 'No'
                    )
                ),

                array(
                    'name'    => 'pagination',
                    'label'   => __( 'Pagination', 'tc-wps' ),
                    'desc'    => __( 'Show / Hide Pagination', 'tc-wps' ),
                    'type'    => 'select',
                    'default' => 'true',
                    'options' => array(
                        'true' => 'Yes',
                        'false'  => 'No'
                    )
                ),
                array(
                    'name'    => 'pagination-numbr',
                    'label'   => __( 'Pagination Number', 'tc-wps' ),
                    'desc'    => __( 'Show / Hide Pagination Number', 'tc-wps' ),
                    'type'    => 'select',
                    'default' => 'false',
                    'options' => array(
                        'true' => 'Yes',
                        'false'  => 'No'
                    )
                ),
                array(
                    'name'    => 'autoheight',
                    'label'   => __( 'Auto Height', 'tc-wps' ),
                    'desc'    => __( 'Enable Auto Height', 'tc-wps' ),
                    'type'    => 'select',
                    'default' => 'false',
                    'options' => array(
                        'true' => 'Yes',
                        'false'  => 'No'
                    )
                )
            ),
            'tc_post_carousel_styling' => array(

              array(
                  'name'    => 'navigation-color',
                  'label'   => __( 'Navigation Color', 'tc-wps' ),
                  'desc'    => __( 'Navigation Color', 'tc-wps' ),
                  'type'    => 'color',
                  'default' => ''
              ),

              array(
                  'name'    => 'pagination-color',
                  'label'   => __( 'Pagination Color', 'tc-wps' ),
                  'desc'    => __( 'Pagination Color', 'tc-wps' ),
                  'type'    => 'color',
                  'default' => ''
              )
            )

        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap-setting-tc-wooslider">';

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}
endif;
