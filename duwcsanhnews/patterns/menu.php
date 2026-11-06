<?php
/**
 * Title: Điều hướng chuyên mục
 * Slug: duwcsanhnews/menu
 * Inserter: no
 */
?>
<?php
$links = array( get_comment_delimited_block_content( 'core/navigation-link', array( 'label' => 'Trang chủ', 'url' => home_url( '/' ) ), null ) );
foreach (array('doi-song','nghe-nghiep','van-hoa','di-kham-pha','an-uong') as $slug) {
    $term = get_category_by_slug($slug);
    if ($term) {
        $links[] = get_comment_delimited_block_content('core/navigation-link', array('label' => $term->name, 'url' => get_category_link($term), 'kind' => 'taxonomy', 'type' => 'category', 'id' => $term->term_id), null);
    }
}
echo get_comment_delimited_block_content('core/navigation', array('ariaLabel' => 'Chuyên mục'), implode("\n", $links));
?>
