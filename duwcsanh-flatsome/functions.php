<?php
defined( 'ABSPATH' ) || exit;

function dan_sections() {
    return get_categories( array( 'slug' => array( 'doi-song', 'nghe-nghiep', 'van-hoa', 'di-kham-pha', 'an-uong' ), 'hide_empty' => false, 'orderby' => 'id' ) );
}

function dan_vietnamese_date() {
    $days = array( 'Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy' );
    $w = (int) wp_date( 'w' );
    return $days[$w] . ', ' . wp_date( 'd/m/Y' );
}

function dan_reading_time( $post_id ) {
    $content = strip_tags( get_post_field( 'post_content', $post_id ) );
    $words = count( preg_split( '/\s+/u', trim( $content ) ) );
    $minutes = max( 1, (int) ceil( $words / 220 ) );
    return $minutes . ' phút đọc';
}

function dan_news_card( $post, $style = '' ) {
    $link = get_permalink( $post );
    $cats = get_the_category( $post->ID );
    ?>
    <article class="news-card <?php echo esc_attr( $style ); ?>">
        <?php if ( has_post_thumbnail( $post ) ) : ?>
        <a class="news-image" href="<?php echo esc_url( $link ); ?>" tabindex="-1" aria-hidden="true"><?php echo get_the_post_thumbnail( $post, 'large' ); ?></a>
        <?php endif; ?>
        <div class="news-copy">
            <div class="news-meta">
                <?php if ( $cats ) : ?><a class="news-category-badge" href="<?php echo esc_url( get_category_link( $cats[0] ) ); ?>"><?php echo esc_html( $cats[0]->name ); ?></a><?php endif; ?>
                <time datetime="<?php echo esc_attr( get_the_date( 'c', $post ) ); ?>"><?php echo esc_html( get_the_date( 'd.m.Y', $post ) ); ?></time>
                <span class="news-read-time"><?php echo esc_html( dan_reading_time( $post->ID ) ); ?></span>
            </div>
            <h2><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( get_the_title( $post ) ); ?></a></h2>
            <?php if ( in_array( $style, array( 'feature', 'wide' ), true ) ) : ?><p class="news-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt( $post ), 38 ) ); ?></p><?php endif; ?>
        </div>
    </article><?php
}

function dan_recent( $args = array() ) {
    return get_posts( array_merge( array( 'numberposts' => 4, 'ignore_sticky_posts' => true ), $args ) );
}

add_filter( 'style_loader_src', function( $src, $handle = '' ) {
    if ( strpos( $src, 'duwcsanh-flatsome/style.css' ) !== false ) {
        $ver = @filemtime( get_stylesheet_directory() . '/style.css' ) ?: '2.0.0';
        $src = add_query_arg( 'ver', $ver, remove_query_arg( 'ver', $src ) );
    }
    return $src;
}, 10, 2 );

// UX Builder Bridge: ensures UX Builder iframe loads page properly
add_filter( 'ux_builder_data', function( $data ) {
    if ( ! empty( $data['post']['id'] ) ) {
        $pid = intval( $data['post']['id'] );
        $p   = get_post( $pid );
        if ( $p && $p->post_type === 'page' ) {
            $data['postUrl']   = home_url( '/?page_id=' . $pid );
            $data['iframeUrl'] = home_url( '/?page_id=' . $pid . '&post_id=' . $pid . '&uxb_iframe=1' );
        }
    }
    return $data;
}, 999 );

if ( ! shortcode_exists( 'text' ) ) {
    add_shortcode( 'text', function( $atts, $content = '' ) {
        if ( function_exists( 'flatsome_render_ux_text_shortcode' ) ) {
            return flatsome_render_ux_text_shortcode( $atts, $content, 'ux_text' );
        }
        return do_shortcode( $content );
    } );
}


