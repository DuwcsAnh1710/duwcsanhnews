<?php
// If Front page is a Static Page with UX Builder / page content, render the Page content
if ( is_page() ) {
    get_header();
    while ( have_posts() ) {
        the_post();
        the_content();
    }
    get_footer();
    return;
}

get_header(); $stories = dan_recent( array( 'numberposts' => 9 ) ); ?>
<div class="news-shell news-body">
    <div class="news-section-head news-lead-head">
        <h1 class="news-section-title">Tiêu điểm hôm nay</h1>
        <span class="news-section-sub"><?php echo esc_html( dan_vietnamese_date() ); ?></span>
    </div>

    <div class="news-cover">
        <div class="news-cover-main">
            <?php if ( $stories ) dan_news_card( array_shift( $stories ), 'feature' ); ?>
        </div>
        <div class="news-secondary">
            <?php foreach ( array_splice( $stories, 0, 2 ) as $story ) dan_news_card( $story ); ?>
        </div>
        <aside class="news-aside" aria-label="Ban biên tập chọn">
            <h2>Ban biên tập chọn</h2>
            <ol>
                <?php foreach ( dan_recent( array( 'post__in' => get_option( 'sticky_posts' ) ?: array( 0 ), 'numberposts' => 4 ) ) as $pick ) :
                    $pick_cats = get_the_category( $pick->ID );
                ?>
                <li>
                    <div class="aside-item-body">
                        <?php if ( $pick_cats ) : ?>
                            <span class="aside-cat"><?php echo esc_html( $pick_cats[0]->name ); ?></span>
                        <?php endif; ?>
                        <a href="<?php echo esc_url( get_permalink( $pick ) ); ?>"><?php echo esc_html( get_the_title( $pick ) ); ?></a>
                        <span class="aside-time"><?php echo esc_html( dan_reading_time( $pick->ID ) ); ?></span>
                    </div>
                </li>
                <?php endforeach; ?>
            </ol>
        </aside>
    </div>

    <section class="news-block">
        <div class="news-section-head">
            <h2 class="news-section">Đọc tiếp</h2>
        </div>
        <div class="news-grid">
            <?php foreach ( $stories as $story ) dan_news_card( $story ); ?>
        </div>
    </section>

    <?php foreach ( dan_sections() as $term ) : ?>
    <section class="news-block">
        <div class="news-section-head">
            <h2 class="news-section"><a href="<?php echo esc_url( get_category_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a></h2>
            <a class="news-section-more" href="<?php echo esc_url( get_category_link( $term ) ); ?>">Xem chuyên mục</a>
        </div>
        <div class="news-grid">
            <?php foreach ( dan_recent( array( 'category' => $term->term_id, 'numberposts' => 3 ) ) as $story ) dan_news_card( $story ); ?>
        </div>
    </section>
    <?php endforeach; ?>
</div>
<?php get_footer(); ?>
