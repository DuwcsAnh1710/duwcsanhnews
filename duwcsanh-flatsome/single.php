<?php get_header(); while ( have_posts() ) : the_post();
$cats = get_the_category();
$current_url = get_permalink();
$current_title = get_the_title();
$prev_post = get_previous_post();
$next_post = get_next_post();
?>
<div id="news-progress-bar" class="news-progress-bar" aria-hidden="true"></div>

<div class="news-shell">
    <nav class="news-breadcrumb" aria-label="Đường dẫn trang">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a>
        <span class="sep">/</span>
        <?php if ( $cats ) : ?>
            <a href="<?php echo esc_url( get_category_link( $cats[0] ) ); ?>"><?php echo esc_html( $cats[0]->name ); ?></a>
            <span class="sep">/</span>
        <?php endif; ?>
        <span class="current"><?php echo esc_html( wp_trim_words( $current_title, 10 ) ); ?></span>
    </nav>
</div>

<article id="news-article-reader" class="news-reading">
    <header class="news-article-header">
        <div class="news-meta">
            <?php if ( $cats ) : ?>
                <a class="news-category-badge" href="<?php echo esc_url( get_category_link( $cats[0] ) ); ?>"><?php echo esc_html( $cats[0]->name ); ?></a>
            <?php endif; ?>
            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd.m.Y' ) ); ?></time>
            <span class="news-read-time"><?php echo esc_html( dan_reading_time( get_the_ID() ) ); ?></span>
        </div>

        <h1><?php the_title(); ?></h1>

        <?php if ( has_excerpt() ) : ?>
            <p class="news-intro"><?php echo esc_html( get_the_excerpt() ); ?></p>
        <?php endif; ?>

        <div class="news-byline-bar">
            <div class="news-by">
                <span class="by-label">Thực hiện:</span>
                <strong><?php the_author_posts_link(); ?></strong>
            </div>
            <div class="news-reader-controls" role="group" aria-label="Tùy chọn đọc bài">
                <span class="reader-ctrl-label">Cỡ chữ</span>
                <button type="button" class="btn-reader-font" data-size="sm" aria-label="Cỡ chữ nhỏ" title="Cỡ chữ nhỏ">A-</button>
                <button type="button" class="btn-reader-font is-active" data-size="md" aria-label="Cỡ chữ mặc định" title="Cỡ chữ mặc định">A</button>
                <button type="button" class="btn-reader-font" data-size="lg" aria-label="Cỡ chữ lớn" title="Cỡ chữ lớn">A+</button>
                <span class="reader-ctrl-sep" aria-hidden="true"></span>
                <button type="button" id="btn-reader-paper" class="btn-reader-mode" aria-pressed="false" title="Chuyển đổi nền giấy ấm dịu mắt">Nền dịu mắt</button>
            </div>
        </div>
    </header>

    <?php if ( has_post_thumbnail() ) :
        $thumb_caption = get_the_post_thumbnail_caption();
    ?>
        <figure class="news-reading-thumb">
            <?php the_post_thumbnail( 'large' ); ?>
            <?php if ( $thumb_caption ) : ?>
                <figcaption><?php echo wp_kses_post( str_replace( '·', '—', $thumb_caption ) ); ?></figcaption>
            <?php endif; ?>
        </figure>
    <?php endif; ?>

    <div id="news-reading-body" class="news-text"><?php the_content(); wp_link_pages(); ?></div>

    <footer class="news-article-footer">
        <div class="news-share-box">
            <span class="share-title">Chia sẻ bài viết này</span>
            <div class="news-share-actions">
                <button type="button" class="btn-share btn-copy" data-url="<?php echo esc_url( $current_url ); ?>" title="Sao chép liên kết">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                    <span class="btn-text">Sao chép liên kết</span>
                </button>
                <a class="btn-share btn-fb" href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . rawurlencode( $current_url ) ); ?>" target="_blank" rel="noopener noreferrer" title="Chia sẻ lên Facebook">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                    <span>Facebook</span>
                </a>
                <a class="btn-share btn-email" href="<?php echo esc_url( 'mailto:?subject=' . rawurlencode( $current_title ) . '&body=' . rawurlencode( $current_url ) ); ?>" title="Gửi qua Email">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    <span>Email</span>
                </a>
            </div>
        </div>

        <?php if ( $prev_post || $next_post ) : ?>
        <nav class="news-post-nav" aria-label="Điều hướng bài viết">
            <div class="post-nav-item post-nav-prev">
                <?php if ( $prev_post ) : ?>
                    <span class="post-nav-label">Bài viết trước</span>
                    <a href="<?php echo esc_url( get_permalink( $prev_post ) ); ?>"><?php echo esc_html( get_the_title( $prev_post ) ); ?></a>
                <?php endif; ?>
            </div>
            <div class="post-nav-item post-nav-next">
                <?php if ( $next_post ) : ?>
                    <span class="post-nav-label">Bài viết tiếp theo</span>
                    <a href="<?php echo esc_url( get_permalink( $next_post ) ); ?>"><?php echo esc_html( get_the_title( $next_post ) ); ?></a>
                <?php endif; ?>
            </div>
        </nav>
        <?php endif; ?>
    </footer>

    <?php if ( comments_open() || get_comments_number() ) comments_template(); ?>
</article>

<div class="news-shell">
    <section class="news-block">
        <div class="news-section-head">
            <h2 class="news-section">Cùng chuyên mục</h2>
            <?php if ( $cats ) : ?>
                <a class="news-section-more" href="<?php echo esc_url( get_category_link( $cats[0] ) ); ?>">Xem thêm <?php echo esc_html( $cats[0]->name ); ?></a>
            <?php endif; ?>
        </div>
        <div class="news-grid">
            <?php foreach ( dan_recent( array( 'category__in' => wp_get_post_categories( get_the_ID() ), 'post__not_in' => array( get_the_ID() ), 'numberposts' => 3 ) ) as $story ) dan_news_card( $story ); ?>
        </div>
    </section>
</div>
<?php endwhile; get_footer(); ?>
