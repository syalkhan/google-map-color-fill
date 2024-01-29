<?php
/*
Plugin Name: mapcolorarea
Description: A plugin to add color area in the map.
Version: 1.0
Author: syal khan
*/

// Define the shortcode and specify the callback function
function enqueue_map_scripts() {
    // Enqueue Google Maps API with your API key
    wp_enqueue_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js?key=ENTER_YOUR_API', array(), null, true);

    // Enqueue polyfill.io for additional browser compatibility
    wp_enqueue_script('polyfill', 'https://polyfill.io/v3/polyfill.min.js?features=default');
}

function generate_map_html() {
    // Enqueue custom script and style for the map
    wp_enqueue_script('custom-plugin-script', plugins_url('js/syalmap.js', __FILE__), array('jquery', 'google-maps-api', 'polyfill'), null, true);
    wp_enqueue_style('custom-plugin-style', plugins_url('css/syalmap.css', __FILE__), array(), '1.0', 'all');

    // Localize script to pass data to JavaScript
    wp_localize_script('custom-plugin-script', 'pluginData', array(
        'kmlUrl' => plugins_url('kml/counties6.kml', __FILE__)
    ));

    // Return the HTML for the map
    return '<div id="map" style="height:600px !important;"></div>';
}

function display_map($atts) {
    // Enqueue scripts and generate map HTML
    enqueue_map_scripts();
    return generate_map_html();
}

// Register the shortcode with WordPress
add_shortcode('DISPLAY_SYAL_MAP', 'display_map');




?>
