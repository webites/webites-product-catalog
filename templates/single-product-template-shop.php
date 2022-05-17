<?php get_header( ); ?>



    <?php 
    $imageon = get_option('wbcp_display_display_image'); 
    $title = get_the_title();
    ?>

    <?php $meta = get_option('wbcp_display_meta');  
        if ( $meta == "on" ) {
        $colors = get_post_meta( $post->ID, 'wb_products_colors', true );
        $dimensions = get_post_meta( $post->ID, 'wb_products_dim', true );
        $sku = get_post_meta( $post->ID, 'wb_products_sku', true );
        $series = get_post_meta( $post->ID, 'wb_products_series', true );
        $type = get_post_meta( $post->ID, 'wb_products_type', true );
        $price = get_post_meta( $post->ID, 'wb_products_price', true );
        }
    ?>

    <?php if ($imageon == "on") {
        ?>
        <section class="container wb-shop-product">

            <div class="product-image">
                <?php if (has_post_thumbnail( )) {
                    the_post_thumbnail( 'large' );
                } ?>
            </div>

            <div class="product-info">
                <h1><?php echo esc_html($title) ?></h1>
                <?php if ( $meta == "on" ) { echo "<bdi class='price'>". esc_html($price) ."</bdi>"; } ?>
                <p>
                    <?php if(has_excerpt()) { the_excerpt(); } ?>
                </p>
                <?php if ( $meta == "on" ){ ?>
                <ul class="metadata"><h2><?php _e( "Info:", "wb-product-catalog") ?></h2>
                    <?php if($colors) {
                    echo '<li><strong>'. __( "Colors:", "wb-product-catalog") . ' </strong>'. esc_html($colors) .'</li>';
                    } ?>
                    <?php if($dimensions) {
                    echo '<li><strong>'. __( "Dimensions:", "wb-product-catalog") . ' </strong>'. esc_html($dimensions) .'</li>';
                    } ?>
                    <?php if($sku) {
                    echo '<li><strong>'. __( "SKU:", "wb-product-catalog") . ' </strong>'. esc_html($sku) .'</li>';
                    } ?>
                    <?php if($series) {
                    echo '<li><strong>'. __( "Series:", "wb-product-catalog") . ' </strong>'. esc_html($series) .'</li>';
                    } ?>
                    <?php if($type) {
                    echo '<li><strong>'. __( "Type:", "wb-product-catalog") . ' </strong>'. esc_html($type) .'</li>';
                    } ?>
                </ul>
                <?php } ?>

                <?php $cattags = get_option('wbcp_display_cat_and_tag'); ?>
                <?php if ($cattags == "on") { ?>
                <div class="shop-tax-cat">
                    <?php echo get_the_term_list( get_the_id(), 'products-cat',  "<h2>". __('Product categories', 'wb-product-catalog') . " </h2><ul><li>","</li><li>" ,"</li></ul>" ); ?>
                </div>
                <div class="shop-tax-tag">
                    <?php echo get_the_term_list( get_the_id(), 'products-tag',  "<h2>". __('Product tags', 'wb-product-catalog') . " </h2><ul><li>","</li><li>" ,"</li></ul>" ); ?>
                </div>
                <?php } ?>

            </div>

        </section>
        <?php
    } else {
        ?>

        <section class="container wb-shop-product">

            <div class="product-info">
            
            <h1><?php echo esc_html($title); ?></h1>
                <?php if ( $meta == "on" ) { echo "<bdi class='price'>".esc_html($price)."</bdi>"; } ?>
                <p>
                    <?php if(has_excerpt()) { the_excerpt(); } ?>
                </p>
                <?php if ( $meta == "on" ){ ?>
                <ul class="metadata"><h2><?php _e( "Info:", "wb-product-catalog") ?></h2>
                    <?php if($colors) {
                    echo '<li><strong>'. __( "Colors:", "wb-product-catalog") . ' </strong>'. esc_html($colors) .'</li>';
                    } ?>
                    <?php if($dimensions) {
                    echo '<li><strong>'. __( "Dimensions:", "wb-product-catalog") . ' </strong>'. esc_html($dimensions) .'</li>';
                    } ?>
                    <?php if($sku) {
                    echo '<li><strong>'. __( "SKU:", "wb-product-catalog") . ' </strong>'. esc_html($sku) .'</li>';
                    } ?>
                    <?php if($series) {
                    echo '<li><strong>'. __( "Series:", "wb-product-catalog") . ' </strong>'. esc_html($series) .'</li>';
                    } ?>
                    <?php if($type) {
                    echo '<li><strong>'. __( "Type:", "wb-product-catalog") . ' </strong>'. esc_html($type) .'</li>';
                    } ?>
                </ul>
                <?php } ?>

                <?php $cattags = get_option('wbcp_display_cat_and_tag'); ?>
                <?php if ($cattags == "on") { ?>
                <div class="shop-tax-cat">
                    <?php echo get_the_term_list( get_the_id(), 'products-cat',  "<h2>". __('Product categories', 'wb-product-catalog') . " </h2><ul><li>","</li><li>" ,"</li></ul>" ); ?>
                </div>
                <div class="shop-tax-tag">
                    <?php echo get_the_term_list( get_the_id(), 'products-tag',  "<h2>". __('Product tags', 'wb-product-catalog') . " </h2><ul><li>","</li><li>" ,"</li></ul>" ); ?>
                </div>
                <?php } ?>
            
            </div>

            

        </section>  

        <?php

    }
    ?>

<div class="entry-content">
    <?php the_content(); ?>
</div>





<?php get_footer(); ?>

