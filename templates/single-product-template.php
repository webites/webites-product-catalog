<?php get_header( ); ?>

<div class="entry-title">
<h1 style="text-align:center;"><?php echo get_the_title(); ?></h1>
</div>

<div class="post-image">
    <?php
        if (has_post_thumbnail( )) {
            the_post_thumbnail( 'medium' );
        } 
    ?>
</div>

<?php
    $colors = get_post_meta( $post->ID, 'wb_products_colors', true );
    $dimensions = get_post_meta( $post->ID, 'wb_products_dim', true );
    $sku = get_post_meta( $post->ID, 'wb_products_sku', true );
    $series = get_post_meta( $post->ID, 'wb_products_series', true );
    $type = get_post_meta( $post->ID, 'wb_products_type', true );
    $price = get_post_meta( $post->ID, 'wb_products_price', true );
    $available = get_post_meta( $post->ID, 'wb_products_available', true );
?>

<div class="post-tax">
    <div class="post-tax-cat">
         <?php echo get_the_term_list( get_the_id(), 'products-cat',  "<h2>". __('Product categories', 'wb-product-catalog') . " </h2><ul><li>","</li><li>" ,"</li></ul>" ); ?>
    </div>

    <div class="post-tax-tag">
         <?php echo get_the_term_list( get_the_id(), 'products-tag',  "<h2>". __('Product tags', 'wb-product-catalog') . " </h2><ul><li>","</li><li>" ,"</li></ul>" ); ?>
    </div>


</div>

<?php 
    if ( $colors || $dimensions || $sku || $series || $type || $price ) {
        ?>

            <div class="post-meta">

            <?php if($colors) {

                ?> <div class="post-meta-box meta-colours">
                    <h2>Colours</h2>
                    <p class="meta-p"><?php echo esc_html($colors); ?></p>
                </div>

            <?php
            } ?>

            <?php if($dimensions) {

            ?> <div class="post-meta-box meta-dimensions">
                <h2>Dimensions</h2>
                <p class="meta-p"><?php echo esc_html($dimensions); ?></p>
            </div>

            <?php
            } ?>

            
            <?php if($sku) {

            ?> <div class="post-meta-box meta-sku">
                <h2>SKU</h2>
                <p class="meta-p"><?php echo esc_html($sku); ?></p>
            </div>

            <?php
            } ?>

            
            <?php if($series) {

            ?> <div class="post-meta-box meta-series">
                <h2>Series</h2>
                <p class="meta-p"><?php echo esc_html($series); ?></p>
            </div>

            <?php
            } ?>

            
            <?php if($type) {

                ?> <div class="post-meta-box meta-type">
                    <h2>Type</h2>
                    <p class="meta-p"><?php echo esc_html($type); ?></p>
                </div>

            <?php
            } ?>

            
            <?php if($price) {

            ?> <div class="post-meta-box meta-price">
                <h2>Price</h2>
                <p class="meta-p"><?php echo esc_html($price); ?></p>
            </div>

            <?php
            } ?>



            </div>

        <?php
    }
?>



<div class="entry-content">
    <?php the_content(); ?>
</div>


<?php get_footer(); ?>

