<?php

/**
 * Plugin Name:       weBites Free Product Catalog 
 * Plugin URI:        https://webites.pl
 * Description:       Free plugin from weBites.pl - Do product catalog on your company website. Plugin is all free.
 * Version:           1.1.0
 * Requires at least: 5.9.3
 * Requires PHP:      7.3
 * Author:            weBites
 * Author URI:        https://webites.pl
 * License:           GPL v2 or later
 * Text Domain:       wb-product-catalog
 * Domain Path:       /languages
 */

function wb_free_catalog_custom_post_types_product_catalog() {
    register_post_type( "products",
   array(
      'labels' => array(
       'name' => __("Products", "wb-product-catalog"),    
       'singular_name' => __("Product", "wb-product-catalog")
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => __("products", "wb-product-catalog")),
     ) ); 
    } 
add_action('init', 'wb_free_catalog_custom_post_types_product_catalog');

function wb_free_catalog_custom_tax_product_catalog() {

      register_taxonomy(
        'products',
        'products',
          array(
              'label' => __("Products categories", "wb-product-catalog"),
              'sort' => true,
              'hierarchical' => true,
              'args' => array( 'orderby' => 'term_order' ),
              'rewrite' => array( 'slug' => __("products-categories", "wb-product-catalog") )
          )
      );      
    }


add_action( 'init', 'wb_free_catalog_custom_tax_product_catalog' );