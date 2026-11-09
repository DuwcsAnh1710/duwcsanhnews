<?php
defined( 'ABSPATH' ) || exit;

add_action( 'wp_enqueue_scripts', static function () {
    wp_enqueue_style( 'dan-magazine', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
} );
add_action( 'after_setup_theme', static function () {
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style.css' );
} );
add_filter( 'query_loop_block_query_vars', static function ( $args, $block ) {
    $query = $block->context['query'] ?? array();
    if ( ( $query['sticky'] ?? '' ) === 'ignore' ) {
        $args['ignore_sticky_posts'] = true;
    }
    if ( ! empty( $query['danCategory'] ) ) {
        $args['category_name'] = sanitize_title( $query['danCategory'] );
    }
    if ( ! empty( $query['danRelated'] ) ) {
        $current = get_queried_object_id();
        $args['category__in'] = wp_get_post_categories( $current ) ?: array( 0 );
        $args['post__not_in'] = array( $current );
    }
    return $args;
}, 10, 2 );
add_shortcode( 'dan_share', static function () {
    return '<p><a href="' . esc_url( 'mailto:?subject=' . rawurlencode( get_the_title() ) . '&body=' . rawurlencode( get_permalink() ) ) . '">Chia sẻ qua email ↗</a></p>';
} );
