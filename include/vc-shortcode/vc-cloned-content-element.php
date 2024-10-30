<?php
/*
Element Description: Directory
*/

// Element Class
class vcClondedContent extends WPBakeryShortCode {

    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'ccp_cloned_content_mapping' ) );
        add_shortcode( 'vc_cloned_content', array( $this, 'ccp__cloned_content_html' ) );
    }

    // Element Mapping
    public function ccp_cloned_content_mapping() {

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        // Map the block with vc_map()
        vc_map(
            array(
                'name' => __('Cloned Content', 'text-domain'),
                'base' => 'vc_cloned_content',
                'class' => 'wpc-text-class',
                'description' => __('Element to display cloned content', 'text-domain'),
                'category' => __('Cloned Content', 'text-domain'),
                'icon' => plugin_dir_url( __FILE__ ) . '/assets/clone-icon.png',
                'params' => array(

                    array(
                        'type' => 'textfield',
                        'holder' => '',
                        'class' => 'title-class',
                        'heading' => __( 'Enter Slug', 'text-domain' ),
                        'param_name' => 'page_slug',
                        'value' => __( '', 'text-domain' ),
                        'description' => __('Paste or enter the slug of the page/post you wish to clone.', 'text-domain'),
                        'admin_label' => true,
                        'weight' => 0,
                    ),
                    array(
                        'type' => '',
                        'holder' => 'p',
                        'class' => 'title-class',
                        'heading' => __( 'Format Tip', 'text-domain' ),
                        'param_name' => 'desc_1',
                        'value' => __( '', 'text-domain' ),
                        'description' => __('Parent - /page-slug/ <br>Child - /parent-slug/page-slug/', 'text-domain'),
                        'admin_label' => false,
                        'weight' => 0,
                    ),

                ),
            )
        );

    }

    // Element HTML
    public function ccp__cloned_content_html( $atts ) {

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'page_slug'   => '',
                ),
                $atts
            )
        );

        // Fill $html var with data
        ob_start();
        ?>
        <div class="cloned-content">
        <?php
        $page = get_page_by_path( $page_slug);
        $currentpage = get_query_var('pagename');

        // Checks to see if page slug is blank and exists
        if (!$page_slug == '' && !$page == '' ) {
            if ($page_slug !== "/$currentpage/" && $page_slug !== "$currentpage") {
                $your_query = new WP_Query( "pagename=$page_slug" );
                $page_id = $page->ID;
                while ( $your_query->have_posts() ) : $your_query->the_post();
                the_content();
                $shortcodes_custom_css = get_post_meta( $page_id, '_wpb_shortcodes_custom_css', true );
                    if ( ! empty( $shortcodes_custom_css ) ) {
                        $shortcodes_custom_css = strip_tags( $shortcodes_custom_css );
                        echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
                        echo $shortcodes_custom_css;
                        echo '</style>';
                    }
                endwhile;
                wp_reset_postdata();
            } else {
                echo "<p class='ccp-error' style='text-align: center;'>Cannot clone slug that is the same as the current page.</p>";
            }
        } else {
            echo "<p class='ccp-error' style='text-align: center;'>Cloned Content slug not found. Please check to make sure you entered it correctly.</p>";
        }
        ?>
        </div>
        <?php
        return ob_get_clean();
    }

} // End Element Class


// Element Class Init
new vcClondedContent();
