<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$crntLanguage=qtranxf_getLanguage();
if ( $related_products ) : ?>

    <section class="product-wrapper">

        <h2>
            <?php esc_html_e( 'Similar products', 'woocommerce' ); ?>
        </h2>
        <div class="related-product-slider">    

            <?php //woocommerce_product_loop_start(); ?>

            <?php foreach ( $related_products as $related_product ) : ?>

            <?php             
                $post_object=get_post($related_product->get_id());
                $productName=$post_object->post_name;
                $productTitle=$post_object->post_title;
                $stockStatus=get_post_meta($related_product->get_id(),'_stock_status',true);
                if($stockStatus=='outofstock'){
                    continue;
                }
           
            /* 

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' );
          */ ?>

            <div class="grid-item">
                <div class="featured-img text-center">
                    <a href="<?php echo site_url().'/product/'.$productName.'?lang='.$crntLanguage; ?>">
                        <?php
                            $getImage='';
                            $image=wp_get_attachment_image_src(get_post_thumbnail_id($related_product->get_id()),'custom-product-image');
                            if(!empty($image)){
                             $getImage=$image[0];
                            }
                            
                            ?>
                            <img width="294" height="294" alt="<?php echo basename($getImage);?>" src="<?php echo $getImage; ?>">
                    </a>
                </div>
                <!-- featured-img -->
                <div class="sec-title">
                    <h3>
                        <a href="<?php echo site_url().'/product/'.$productName.'?lang='.$crntLanguage; ?>">
                            <?php echo get_the_title($related_product->get_id()); ?>
                        </a>
                    </h3>
                    <span>1 <?php echo getTextByLang('Kg',$crntLanguage); ?></span>
                </div>
                <div class="sec-content">
                    <div class="ammount-sec pull-left">
                        <h5>
                            <?php echo $related_product->regular_price; ?> <?php echo CURRENCY_VAL; ?></h5>
                    </div>
                    <!-- ammount-sec -->
                    <div class="cart-sec pull-right">
                        <?php $url=site_url().'/shop/?add-to-cart='.$related_product->get_id(); ?>
                        <a rel="nofollow" href="<?php echo $url ;?>" data-quantity="1" data-product_id="<?php echo $related_product->get_id(); ?>" data-product_sku="" class="button product_type_simple add_to_cart_button ajax_add_to_cart">
                            <?php echo getTextByLang('Add to cart',$crntLanguage); ?>
                        </a>



                        <!--  <a class="button product_type_simple add_to_cart_button ajax_add_to_cart" data-product_sku="" data-product_id="587" data-quantity="1" href="http://clientstagingdev.com/fruitdose/shop/?add-to-cart=587" rel="nofollow">Add to cart</a>-->

                    </div>
                    <!-- cart-sec -->
                </div>
                <!-- sec-content -->
            </div>





            <?php endforeach; ?>

            <?php //woocommerce_product_loop_end(); ?>









        </div>


    </section>

    <?php endif;

wp_reset_postdata();
