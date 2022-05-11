<?php get_header( ); ?>

<div class="entry-title">
<h1 style="text-align:center;"><?php echo get_the_title(); ?></h1>
</div>

<div class="post-image">
    <?php
        if (has_post_thumbnail( )) {
            the_post_thumbnail( 'thumbnail' );
        } 

    $available = get_post_meta( $post->ID, 'wb_products_available', true );

    if($available == "on" ) {
        ?>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="post-available-icon-yes">
            <path d="M0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256zM371.8 211.8C382.7 200.9 382.7 183.1 371.8 172.2C360.9 161.3 343.1 161.3 332.2 172.2L224 280.4L179.8 236.2C168.9 225.3 151.1 225.3 140.2 236.2C129.3 247.1 129.3 264.9 140.2 275.8L204.2 339.8C215.1 350.7 232.9 350.7 243.8 339.8L371.8 211.8z"/>
        </svg>
        <p class="post-available-text-yes">
            <?php _e("Available", "wb-product-catalog"); ?>
        </p>
        <?php
    } else { ?>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="post-available-icon-no">
            <path d="M512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM99.5 144.8C77.15 176.1 64 214.5 64 256C64 362 149.1 448 256 448C297.5 448 335.9 434.9 367.2 412.5L99.5 144.8zM448 256C448 149.1 362 64 256 64C214.5 64 176.1 77.15 144.8 99.5L412.5 367.2C434.9 335.9 448 297.5 448 256V256z"/>
        </svg>
        <p class="post-available-text-no">
            <?php _e("Not available", "wb-product-catalog"); ?>
        </p>
        <?php
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

