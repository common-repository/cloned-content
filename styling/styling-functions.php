<?php

// Link Cloned Content Backend stylesheet

function ccp_backend_styling() {
    wp_enqueue_style( 'ccp-plugin-styling', plugins_url( '/backend-ccp-styling.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'ccp_backend_styling' );


// Link Cloned Content Backend stylesheet

function ccp_frontend_styling() {
    wp_enqueue_style( 'ccp-plugin-styling', plugins_url( '/frontend-ccp-styling.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'ccp_frontend_styling' );
