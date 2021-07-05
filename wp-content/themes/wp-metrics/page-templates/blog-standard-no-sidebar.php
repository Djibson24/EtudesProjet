<?php defined( 'ABSPATH' ) or exit();
/**
 * Template Name: Blog Standard No Sidebar
 * @package WPMetrics
 */
get_header();
wpmetrics_set_theme_option( 'posts_layout', 'standard' );
wpmetrics_set_theme_option( 'posts_sidebar', 'no' );
query_posts( array(
    'post_type'         => 'post',
    'post_status'       => 'publish',
    'posts_per_page'    => get_option( 'posts_per_page' ),
    'paged'             => get_query_var( 'paged' ),
) );
get_template_part( 'template-parts/helper', 'archive' );
wp_reset_query();
get_footer();
