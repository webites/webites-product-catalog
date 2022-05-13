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

//add styles

function wb_add_style_to_free_catalog_plugin(){
	wp_enqueue_style( 'webites__free_catalog_stylesheet', plugin_dir_url(__FILE__) . 'public/css/style.css', array(), filemtime( plugin_dir_path(__FILE__) . 'public/css/style.css' ), 'all');
}
add_action( 'wp_enqueue_scripts', 'wb_add_style_to_free_catalog_plugin');

//admin styles

function wb_add_style_to_free_catalog_plugin_admin_css(){
	wp_enqueue_style( 'webites__free_catalog_stylesheet_admin', plugin_dir_url(__FILE__) . '/css/style.css', array(), filemtime( plugin_dir_path(__FILE__) . 'css/style.css' ), 'all');
}
add_action( 'admin_enqueue_scripts', 'wb_add_style_to_free_catalog_plugin_admin_css');


 // create CPT - products

function wb_free_catalog_custom_post_types_product_catalog() {
    register_post_type( "products",
   array(
      'labels' => array(
       'name' => __("Products", "wb-product-catalog"),    
       'singular_name' => __("Product", "wb-product-catalog")
      ),
      'public' => true,
      'has_archive' => true,
      'supports' => array("title", "editor", "thumbnail", "excerpt", "custom-fields"),
      'rewrite' => array('slug' => __("products", "wb-product-catalog")),
     ) ); 
    } 
add_action('init', 'wb_free_catalog_custom_post_types_product_catalog');


// create tax - category

function wb_free_catalog_custom_tax_product_catalog_cat() {

      register_taxonomy(
        'products-cat',
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


add_action( 'init', 'wb_free_catalog_custom_tax_product_catalog_cat' );

// create tax - tags

function wb_free_catalog_custom_tax_product_catalog_tag() {

    register_taxonomy(
      'products-tag',
      'products',
        array(
            'label' => __("Products tags", "wb-product-catalog"),
            'sort' => true,
            'hierarchical' => false,
            'args' => array( 'orderby' => 'term_order' ),
            'rewrite' => array( 'slug' => __("products-tags", "wb-product-catalog") )
        )
    );      
  }


add_action( 'init', 'wb_free_catalog_custom_tax_product_catalog_tag' );


// PLUGIN TEMPLATES

// single post - product - template



add_filter( 'single_template', 'wb_free_catalog_template_single_product' );

function wb_free_catalog_template_single_product( $page_template )
{
    if ( is_singular( 'products') ) {
        $page_template = dirname( __FILE__ ) . '/templates/single-product-template.php';
    }
    return $page_template;
}

// end single post templates

// category - product - template

$archive_layout = get_option('wbcp_archive_layout');

if ($archive_layout == "grid") {


  add_filter( "taxonomy_template", 'wb_free_catalog_template_category_template');
    function wb_free_catalog_template_category_template ($tax_template) {
      if (is_tax('products-cat')) {
        $tax_template = dirname(  __FILE__  ) . '/templates/archive-template.php';
      }
      return $tax_template;
    }

  add_filter( "taxonomy_template", 'wb_free_catalog_template_tag_template');
    function wb_free_catalog_template_tag_template ($tax_template) {
      if (is_tax('products-tag')) {
        $tax_template = dirname(  __FILE__  ) . '/templates/archive-template.php';
      }
      return $tax_template;
    }

} else {

  
add_filter( "taxonomy_template", 'wb_free_catalog_template_category_template');
function wb_free_catalog_template_category_template ($tax_template) {
  if (is_tax('products-cat')) {
    $tax_template = dirname(  __FILE__  ) . '/templates/archive-no-grid-template.php';
  }
  return $tax_template;
}

// end category temaplate

// tag - product - template

add_filter( "taxonomy_template", 'wb_free_catalog_template_tag_template');
function wb_free_catalog_template_tag_template ($tax_template) {
  if (is_tax('products-tag')) {
    $tax_template = dirname(  __FILE__  ) . '/templates/archive-no-grid-template.php';
  }
  return $tax_template;
}

}


// end tag temaplate



// custom fields


/**
 * Register meta box(es).
 */
function wb_free_products_catalog_meta_box() {
    add_meta_box( 'meta-box-wb-free-catalog',
     __( 'Product parameters', 'wb-product-catalog' ), 
     'wb_free_products_catalog_meta_box_table',
    'products');
}
add_action( 'add_meta_boxes', 'wb_free_products_catalog_meta_box' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function wb_free_products_catalog_meta_box_table( $post ) {

    

    $colors = get_post_meta( $post->ID, 'wb_products_colors', true );
    $dimensions = get_post_meta( $post->ID, 'wb_products_dim', true );
    $sku = get_post_meta( $post->ID, 'wb_products_sku', true );
    $series = get_post_meta( $post->ID, 'wb_products_series', true );
    $type = get_post_meta( $post->ID, 'wb_products_type', true );
    $price = get_post_meta( $post->ID, 'wb_products_price', true );
    
    $available = get_post_meta( $post->ID, 'wb_products_available', true );
    // Display code/markup goes here. Don't forget to include nonces!
    ?>
    <p>
    <div class="wrap">
    <form action="/" method="post">

        <label for="wb_products_colors"><?php _e( 'Colors', 'wb-product-catalog'); ?></label><BR>
        <input type="text" id="wb_products_colors" name="wb_products_colors" value="<?php echo esc_html($colors); ?>"><BR><BR>
        
        <label for="wb_products_dim"><?php _e( 'Dimensions', 'wb-product-catalog'); ?></label><BR>
        <input type="text" id="wb_products_dim" name="wb_products_dim" value="<?php echo esc_html($dimensions); ?>"><BR><BR>
                
        <label for="wb_products_sku"><?php _e( 'SKU', 'wb-product-catalog'); ?></label><BR>
        <input type="text" id="wb_products_sku" name="wb_products_sku" value="<?php echo esc_html($sku); ?>"><BR><BR>
                        
        <label for="wb_products_series"><?php _e( 'Series', 'wb-product-catalog'); ?></label><BR>
        <input type="text" id="wb_products_series" name="wb_products_series" value="<?php echo esc_html($series); ?>"><BR><BR>
                                
        <label for="wb_products_type"><?php _e( 'Type', 'wb-product-catalog'); ?></label><BR>
        <input type="text" id="wb_products_type" name="wb_products_type" value="<?php echo esc_html($type); ?>"><BR><BR>
                                        
        <label for="wb_products_price"><?php _e( 'Price', 'wb-product-catalog'); ?></label><BR>
        <input type="text" id="wb_products_price" name="wb_products_price" value="<?php echo esc_html($price); ?>"><BR><BR>

        <label for="wb_products_available"><?php _e( 'Available', 'wb-product-catalog'); ?></label>
        <input type="checkbox" id="wb_products_available" name="wb_products_available" <?php if($available) { echo 'CHECKED'; } ?>><BR><BR>


        <?php submit_button(); ?>

    </form>
    </div>
    <?php
}


/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function lpfw_save_meta_after_click_save_button( $post_id ) {
    // Save logic goes here. Don't forget to include nonce checks!
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $colours = sanitize_text_field( $_POST['wb_products_colors'] );
        $dimensions = sanitize_text_field( $_POST['wb_products_dim'] );
        $sku = sanitize_text_field( $_POST['wb_products_sku'] );
        $series = sanitize_text_field( $_POST['wb_products_series'] );
        $type = sanitize_text_field( $_POST['wb_products_type'] );
        $price = sanitize_text_field( $_POST['wb_products_price'] );
        $available = sanitize_text_field( $_POST['wb_products_available'] );


        update_post_meta( $post_id, 'wb_products_colors', $colours );
        update_post_meta( $post_id, 'wb_products_dim', $dimensions );
        update_post_meta( $post_id, 'wb_products_sku', $sku );
        update_post_meta( $post_id, 'wb_products_series', $series );
        update_post_meta( $post_id, 'wb_products_type', $type );
        update_post_meta( $post_id, 'wb_products_price', $price );
        update_post_meta( $post_id, 'wb_products_available', $available );

}
}
add_action( 'save_post', 'lpfw_save_meta_after_click_save_button' );


// end custom fields


// options page

function wb_product_catalog_register_plugin_settings() {
  //register our settings
    register_setting( 'wb_product_catalog_plugin_option', 'wbcp_display_display_image' );
    register_setting( 'wb_product_catalog_plugin_option', 'wbcp_display_cat_and_tag' );
    register_setting( 'wb_product_catalog_plugin_option', 'wbcp_display_meta' );
    register_setting( 'wb_product_catalog_plugin_option', 'wbcp_archive_layout' );
}

/**
 * Register a custom menu page.
 */
function wb_product_catalog_option_page_function(){
  add_menu_page( 
      __( 'Catalog options', 'wb-product-catalog' ),
      __( 'Catalog options', 'wb-product-catalog' ),
      'manage_options',
      'catalog-options',
      'wb_product_catalog_option_page_content',
      'dashicons-screenoptions',
      59
  ); 

  add_action( 'admin_init', 'wb_product_catalog_register_plugin_settings' );
}
add_action( 'admin_menu', 'wb_product_catalog_option_page_function' );


/**
* Display a custom menu page
*/
function wb_product_catalog_option_page_content(){
  echo '<div class="wrap">';
  _e( '<h1>Admin Page Test</h1>', 'wb-product-catalog' );  
  $image = get_option('wbcp_display_display_image');
  $cattags = get_option('wbcp_display_cat_and_tag');
  $meta = get_option('wbcp_display_meta');
  $archive_layout = get_option('wbcp_archive_layout');


  ?>
<form method="post" action="options.php">
<?php settings_fields( 'wb_product_catalog_plugin_option' ); ?>
<?php do_settings_sections( 'wb_product_catalog_plugin_option' ); ?>
<table class="form-table">
    <tr valign="top">
    <th scope="row">
    <?php _e('Display product image', 'wb-product-catalog'); ?>
    </th>
    <td>
    <input type="checkbox" 
    name="wbcp_display_display_image"  
    <?php if ($image == 'on') { echo "CHECKED"; } ?> />
    </td>
    </tr>

    <tr valign="top">
    <th scope="row">
    <?php _e('Display categories and tags', 'wb-product-catalog'); ?>
    </th>
    <td>
    <input type="checkbox" 
    name="wbcp_display_cat_and_tag"  
    <?php if ($cattags == 'on') { echo "CHECKED"; } ?> />
    </td>
    </tr>
    
    <tr valign="top">
    <th scope="row">
    <?php _e('Display meta', 'wb-product-catalog'); ?>
    </th>
    <td>
    <input type="checkbox" 
    name="wbcp_display_meta"  
    <?php if ($meta == 'on') { echo "CHECKED"; } ?> />
    </td>
    </tr>

    

    <tr valign="top" style="border-top: 1px solid lightgray;">
    <th scope="row">
    <?php _e('Archive layout', 'wb-product-catalog'); ?>
    </th>
    <td>

    <div class="layout">


    <div class="div-grid">
        <input type="radio" id="grid" name="wbcp_archive_layout" value="grid" <?php if($archive_layout == "grid") { echo "CHECKED"; } ?>>
            <label for="grid">
              <!-- <?php _e( 'Grid', 'wb-product-catalog') ?> -->
              <img src="<?php echo plugin_dir_url(__FILE__) ?>/public/img/grid.png" class="grid-img">
        </label>
    </div>
      

    <div class="div-simple">
        <input type="radio" id="simple" name="wbcp_archive_layout" value="simple" <?php if($archive_layout == "simple") { echo "CHECKED"; } ?>>
            <label for="simple">
              <!-- <?php _e( 'Simple', 'wb-product-catalog') ?> -->
              <img src="<?php echo plugin_dir_url(__FILE__) ?>/public/img/simple.png" class="simple-img">
          </label>
    </div>
      

    </div>
    

    </td>
    </td>
    </tr>
    
</table>

<?php submit_button(); ?>

</form>

<?php
  echo '</div>';
}


	
register_activation_hook( __FILE__, 'wb_catalog_products_default_plugin_option' );

function wb_catalog_products_default_plugin_option(){
  update_option( 'wbcp_display_display_image', "on");
  update_option( 'wbcp_display_cat_and_tag', "on");
  update_option( 'wbcp_display_meta', "on");
}