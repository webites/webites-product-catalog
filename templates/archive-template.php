<?php get_header( ); ?>
<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>
<?php 
if ( have_posts() ) {
    echo '<section class="wb-archive-loop">
    <div class="wb-archive-loop_container">';
	while ( have_posts() ) {
		the_post(); 

        echo '<article class="item">';
        echo '<a class="link" href="' . get_the_permalink() . '"><h2>' . get_the_title() . '</h2></a>';
        the_post_thumbnail( 'medium' );
        echo '<a class="button" href="' . get_the_permalink() . '">' . __( "Read more", "wb-product-catalog" ). '</a>';
        echo '</article>';


	} 
    echo "</div></section>";?>
    <div class="pagination">
        <div class="nav-previous alignleft"><?php previous_posts_link( __( "Older posts", "wb-product-catalog") ); ?></div>
        <div class="nav-next alignright"><?php next_posts_link( __( "Newer posts", "wb-product-catalog") ); ?></div>
    </div>
    <?php
} else {
    echo "<h1>" . _e( "No posts", "wb-product-catalog" );
}
?>



<?php get_footer(); ?>