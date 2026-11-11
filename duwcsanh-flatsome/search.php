<?php get_header(); ?>
<div class="news-shell news-body">
<header class="news-archive"><h1>Kết quả tìm kiếm</h1><p>Từ khóa: <?php echo esc_html( get_search_query() ); ?></p></header>
<?php if ( have_posts() ) : ?><div class="news-grid"><?php while ( have_posts() ) { the_post(); dan_news_card( get_post() ); } ?></div>
<?php the_posts_pagination( array( 'prev_text' => 'Trang trước', 'next_text' => 'Trang sau' ) ); else : ?><p>Chưa có bài phù hợp. Hãy thử từ khóa khác ở ô tìm kiếm.</p><?php endif; ?></div><?php get_footer(); ?>
