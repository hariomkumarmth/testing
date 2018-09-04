Function available here
-------------------------------
1. get_custom_posts
2. get_custom_posts_from_featured_with_offset
3. get_featured_img_without_link
4. get_featured_img_with_link
5. Excerpt Function
----------------------------------
//1
function ept_theme_get_custom_posts($type, $limit = 20, $order = "DESC")
{
    wp_reset_postdata();
    $args = array(
        "posts_per_page" => $limit,
        "post_type" => $type,
        "orderby" => "ID",
        "order" => $order,
    );
    $custom_posts = get_posts($args);
    return $custom_posts;
}
----------------------------2---------------------------------
function ept_theme_get_custom_posts_from_featured_with_offset($type, $limit = 20, $offset, $order = "DESC")
{
    wp_reset_postdata();
    $args = array(
        "posts_per_page" => $limit,
        "offset"=> $offset,
        "category_name" => "featured",
        "post_type" => $type,
        "orderby" => "ID",
        "order" => $order,
    );
    $custom_posts = get_posts($args);
    return $custom_posts;
}
----------------------------3---------------------------------
function ept_theme_get_featured_img_without_link( $cropping_size = "") {
    if ( has_post_thumbnail() ) {
        the_post_thumbnail($cropping_size, array( 'alt' => get_the_title()));
    } else {
        ?>
        <img class="no-thumb" src="<?php echo WEDDINGREVAL_THEME_TEMPLATE_DIR_URL; ?>/images/nopreview.png" alt="<?php the_title(); ?>" />
        <?php
    } //end else                            
} // end function
----------------------------4---------------------------------
function ept_theme_get_featured_img_with_link( $cropping_size = "") {
    if ( has_post_thumbnail() ) {
        ?>
            <a href="<?php the_permalink(); ?>">
                <?php
                    the_post_thumbnail($cropping_size, array( 'alt' => get_the_title()));
                ?>
            </a>
        <?php
    } else {
    ?>
        <a href="<?php the_permalink(); ?>">
           <img class="no-thumb" src="<?php echo THEME_TEMPLATE_DIR_URL; ?>/images/nopreview.png" alt="<?php the_title(); ?>" />
        </a>
    <?php
    } //end else
} // end function
----------------------------5---------------------------------
/* Excerpt Function */
function weddingreval_theme_excerpt_length($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
	array_pop($excerpt);
	$excerpt = implode(" ",$excerpt).'...';
	} else {
		$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
	return $excerpt;
}
