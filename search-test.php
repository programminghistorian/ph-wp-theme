<?php get_header(); ?>
<?php
$page = $wp_query->query_vars;
print_r($page);

$mySearch = new WP_Query("s=$s & showposts=-1");
$num = $mySearch->post_count;
?>
    <h1>Search Results for &#8220;<?php echo @$_GET['s']; ?>&#8221; (<?php echo $num; ?> total)</h1>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<article>
    <header>
        <p class="kicker"><?php echo ucwords(get_post_type(get_the_ID())); ?></p>
        <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
    </header>
    <div class="content"><?php the_excerpt(); ?></div>
</article>
<?php endwhile; ?>
<nav id="pagination">
    <ul>
        <li id="older"><?php next_posts_link(__('&laquo;Older Entries')); ?></li>
        <li id="newer"><?php previous_posts_link(__('Newer Entries&raquo;')); ?></li>
    </ul>
</nav>

<?php else: ?>
<div id="not-found">
<h1>Article Not Found</h1>
</div>
<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
