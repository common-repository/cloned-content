<?php

// Before VC Init

add_action( 'vc_before_init', 'ccp_vc_before_init_actions' );
function ccp_vc_before_init_actions() {

// Require new custom Element

include( plugin_dir_path( __FILE__ ) . '/vc-shortcode/vc-cloned-content-element.php');

}

// Creates shortcode element

function ccp_shortcode_cloned_content( $ccp_atts_shortcode ) {
  echo "<div class='cloned-content'>";
  $ccp_atts_shortcode = shortcode_atts( array(
                     'page' => '',
         ), $ccp_atts_shortcode            );

  $page_slug = $ccp_atts_shortcode['page'];
  $page = get_page_by_path( $page_slug);
  $currentpage = get_query_var('pagename');

  // Checks to see if page slug is blank and exists

  if (!$page_slug == '' && !$page == '') {
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
  echo "</div>";
}
add_shortcode('cloned-content','ccp_shortcode_cloned_content');
