<?php

// Creates new Cloned Content Admin Column
function ccp_cloned_content_column($defaults) {
    $defaults['cloned_content'] = 'Cloned Content';
    return $defaults;
}
add_filter('manage_posts_columns', 'ccp_cloned_content_column');
add_filter('manage_pages_columns', 'ccp_cloned_content_column');


// Checks to see if content is the parent cloned content
// function ccp_custom_columns_content_test($column_name, $post_ID) {
//   global $post;
//   if( isset($post->post_content) && has_shortcode( $post->post_content, 'cloned-content' ) ) {
//     $url = get_edit_post_link( $post->ID );
//     echo "<a href='$url'>Cloned Content =></a><br>";
//   } elseif ( $post && preg_match( '/vc_cloned_content/', $post->post_content ) ) {
//       $url = get_edit_post_link( $post->ID );
//       echo "<a href='$url'>Cloned Content =></a><br>";
//   } else {
//       // Do nothing
//   }
// }
// add_action('manage_posts_custom_column', 'ccp_custom_columns_content_test', 10, 2);
// add_action('manage_pages_custom_column', 'ccp_custom_columns_content_test', 10, 2);


// Checks to see if content displays cloned content
function ccp_custom_columns_content($column_name, $post_ID) {
  global $post;
  if( isset($post->post_content) && has_shortcode( $post->post_content, 'cloned-content' ) ) {
    $url = get_edit_post_link( $post->ID );
    echo "<a href='$url'>Contains cloned content</a><br>";
  } elseif ( $post && preg_match( '/vc_cloned_content/', $post->post_content ) ) {
      $url = get_edit_post_link( $post->ID );
      echo "<a href='$url'>Contains cloned content</a><br>";
  } else {
      // Do nothing
  }
}
add_action('manage_posts_custom_column', 'ccp_custom_columns_content', 10, 2);
add_action('manage_pages_custom_column', 'ccp_custom_columns_content', 10, 2);
