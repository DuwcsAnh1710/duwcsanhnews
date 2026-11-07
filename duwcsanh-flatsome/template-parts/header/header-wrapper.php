<?php defined( 'ABSPATH' ) || exit; ?>
<div class="news-shell">
<div class="news-topbar">
    <div class="news-topbar-date">
        <svg class="news-icon-clock" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
        <span><?php echo esc_html( dan_vietnamese_date() ); ?></span>
    </div>
    <div class="news-topbar-tagline">Tạp chí văn hóa &amp; đời sống người trẻ Việt</div>
</div>
<div class="news-mast">
    <a class="news-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <span class="news-wordmark">DuwcsAnh<span>NEWS</span></span>
    </a>
    <form class="news-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
        <input type="search" name="s" aria-label="Từ khóa tìm kiếm" placeholder="Tìm bài viết…" value="<?php echo esc_attr( get_search_query() ); ?>">
        <button type="submit" aria-label="Tìm kiếm">
            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        </button>
    </form>
</div>
<nav class="news-nav" aria-label="Chuyên mục">
    <a class="news-sticky-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="DuwcsAnh NEWS - Về đầu trang">
        <span class="news-sticky-logo">DuwcsAnh<span>NEWS</span></span>
    </a>
    <div class="news-nav-items">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" <?php if ( is_front_page() || is_home() ) echo 'aria-current="page"'; ?>>Trang chủ</a><?php
        if ( has_nav_menu( 'primary' ) ) {
            wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'depth' => 1 ) );
        } else {
            foreach ( dan_sections() as $term ) {
                $is_active = is_category( $term->term_id ) || ( is_single() && has_category( $term->term_id ) );
                printf( '<a href="%s" %s>%s</a>', esc_url( get_category_link( $term ) ), $is_active ? 'aria-current="page"' : '', esc_html( $term->name ) );
            }
        }
        ?>
    </div>
    <div class="news-sticky-tools">
        <form class="news-sticky-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
            <input type="search" name="s" aria-label="Tìm kiếm nhanh" placeholder="Tìm kiếm…" value="<?php echo esc_attr( get_search_query() ); ?>">
            <button type="submit" aria-label="Tìm kiếm">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </button>
        </form>
    </div>
</nav></div>
