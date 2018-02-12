<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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
	exit; // Exit if accessed directly
}
$crntLanguage=qtranxf_getLanguage();

?>

    <?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

        <div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php /* ?>
            <div class="container">
                <?php
		/**
		 * woocommerce_before_single_product_summary hook.
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		/*do_action( 'woocommerce_before_single_product_summary' );
	?>

                    <div class="summary entry-summary">
                        <div class="breadcrumbs">
                            <?php if(function_exists('bcn_display')){
                               bcn_display();
                            }?>
                        </div>
                        <!-- breadcrumbs -->
                        <div class="product-detail">
                            <?php
			/**
			 * woocommerce_single_product_summary hook.
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 * @hooked WC_Structured_Data::generate_product_data() - 60
			 */
			 //do_action( 'woocommerce_single_product_summary' );
            /*
        ?>
                        </div>
                        <!-- product-detail -->
                        <div class="know-more-info">
                            <h1>
                                <?php echo getTextByLang('Know More',qtranxf_getLanguage()); ?>
                            </h1>
                            <div class="content">
                                <?php 
                                 the_content(); ?>
                            </div>
                        </div>
                    </div>
                    <!-- .summary -->

            </div>
            <?php */
            
            global $post,$product;
            $attachment_ids = $product->get_gallery_image_ids();
            $count=count($attachment_ids)
            ?>
            <div class="container">
                <div class="single-product">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 device-mrgn-btm">
                            <div class="product-gallery">
                                <div data-interval="0" data-ride="carousel" class="carousel slide" id="custom_carousel">
                                    <?php if ( $attachment_ids && has_post_thumbnail() ) { ?>

                                    <div class="row clearfix">
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 column">
                                            <div class="controls">
                                                <ul class="nav">
                                                    <?php 
                                                        $counter=0;
                                                        foreach ($attachment_ids as $key=>$attachment_id) {
                                                            $active='';
                                                            if($counter=='0'){
                                                              $active='active';  
                                                            }
                                                        $full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
                                                        $thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
                                                        $attributes      = array(
                                                            'title'                   => get_post_field( 'post_title', $attachment_id ),
                                                            'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
                                                            'data-src'                => $full_size_image[0],
                                                            'data-large_image'        => $full_size_image[0],
                                                            'data-large_image_width'  => $full_size_image[1],
                                                            'data-large_image_height' => $full_size_image[2],
                                                        );
                                                        ?>
                                                    <li data-target="#custom_carousel" data-slide-to="<?php echo $counter;?>" class="<?php echo $active; ?>">
                                                        <a href="javascript:void(0);">
                                                                <img src="<?php echo $thumbnail[0]; ?>" alt="<?php echo basename($thumbnail[0]); ?>">
                                                            </a>
                                                    </li>
                                                    <?php $counter++;
                                                        } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 column">
                                            <div class="carousel-inner">
                                                <?php 
                                                    $counterImg=0;
                                                    foreach ($attachment_ids as $key=>$attachment_id) {
                                                        $activeImg='';
                                                        if($counterImg=='0'){
                                                          $activeImg='active';  
                                                        }
                                                    $full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
                                                    $thumbnail       = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
                                                    $attributes      = array(
                                                        'title'                   => get_post_field( 'post_title', $attachment_id ),
                                                        'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
                                                        'data-src'                => $full_size_image[0],
                                                        'data-large_image'        => $full_size_image[0],
                                                        'data-large_image_width'  => $full_size_image[1],
                                                        'data-large_image_height' => $full_size_image[2],
                                                    );
                                                    ?>
                                                <div class="item <?php echo $activeImg; ?>">
                                                    <div class="graph">
                                                        <div class="graph-content">
                                                            <img src="<?php echo $full_size_image[0]; ?>" alt="<?php echo basename($full_size_image[0]); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $counterImg++;
                                                    } ?>
                                            </div>



                                        </div>
                                    </div>

                                    <?php }else{ ?>
                                    <div class="row clearfix">
                                        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 column">
                                            <div class="controls">
                                                <ul class="nav">
                                                    <li class="active">
                                                        <a href="javascript:void(0);">
                                                            <?php if ( has_post_thumbnail() ) { 
                                                                $thumb=get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' );                
                                                                $full=get_the_post_thumbnail_url( $post->ID, 'full' );                
                                                                
                                                                ?>
                                                            <img src="<?php echo $thumb ; ?>" alt="<?php echo $thumb ; ?>">
                                                            <?php } ?>
                                                        </a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 column">
                                            <div class="carousel-inner">
                                                <div class="item active">
                                                    <div class="graph">
                                                        <div class="graph-content">
                                                            <img src="<?php echo $full; ?>" alt="<?php echo basename($full);?>">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <?php
            }
                                        ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                            <div class="breadcrumbs">
                                <?php if(function_exists('bcn_display')){
                               bcn_display();
                            }?>
                            </div>
                            <!-- breadcrumbs -->
                            <div class="product-detail">
                                <h1 class="product_title entry-title">
                                    <?php the_title(); ?>
                                </h1>
                                <div class="price-wrap">
                                    <ul class="list-inline">
                                        <li>
                                            <form class="cart" method="post" enctype="multipart/form-data">
                                                <div class="quantity">
                                                    <label for="quantity_5a5849f6e127c" class="screen-reader-text">
                                                          <?php echo getTextByLang('Kg',$crntLanguage); ?>:
                                                        </label>
                                                    <input type="number" title="Qty" value="1" name="quantity" min="1" class="input-text qty text" id="quantity_5a5849f6e127c">
                                                </div>
                                                <button type="submit" name="add-to-cart" value="<?php echo get_the_ID(); ?>" class="single_add_to_cart_button button alt"> <?php echo getTextByLang('Add to cart',$crntLanguage); ?></button>
                                                
                                                <a class="buyNowBtn" data-attr-id="<?php echo get_the_ID(); ?>" href="javascript:void(0);">
                                                    <?php echo getTextByLang('Buy Now',$crntLanguage); ?>
                                                </a>
                                            </form>
                                        </li>
                                        <li>
                                            <p class="price">

                                                <label class="price_label"><?php echo getTextByLang('Price/Kg',$crntLanguage); ?>: </label>
                                                <span class="woocommerce-Price-amount amount"><?php echo get_post_meta(get_the_ID(),'_regular_price',true); ?><span class="woocommerce-Price-currencySymbol"> KD</span></span>
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                                <!--<div class="cart-section">
                                        <ul class="list-inline">
                                            <li class-"cart-sec">
                                                <a href="#/">Add to Cart</a>
                                            </li>
                                            <li class="buy-sec">
                                                <a href="#/">Buy Now</a>
                                            </li>            
                                        </ul>                
                                    </div>-->
                            </div>
                            <div class="know-more-info">
                                <h1>
                                    <?php echo getTextByLang('Know More',qtranxf_getLanguage()); ?>
                                </h1>
                                <div class="content">
                                    <?php 
                                 the_content(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--  </div>-->
            <div class="container product-fact">
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
                        <div class="row clearfix">
                            <div class="col-md-2 col-sm-2 column">

                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 column">
                                <?php 
                 $productType=getProCat(get_the_ID());
                 if($productType==16){
                     $datatype='basket';
                 }else{
                     $datatype='single';
                 }
                ?>
                                <div class="product-fact-wrap">
                                    <ul class="list-inline">
                                        <li>
                                            <a href="javascript:void(0);" data-type="<?php echo $datatype; ?>" class="storage" data-id="<?php the_ID(); ?>" data-val="storage">
                                                <?php echo getTextByLang('Storage Facts',qtranxf_getLanguage()); ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" data-type="<?php echo $datatype; ?>" class="nutrition" data-id="<?php the_ID(); ?>" data-val="nutrition">
                                                <?php echo getTextByLang('Nutrition Facts',qtranxf_getLanguage()); ?>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <?php
		/**
		 * woocommerce_after_single_product_summary hook.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>



            </div>
        </div>
        <!-- #product-<?php //the_ID(); ?> -->

        <?php do_action( 'woocommerce_after_single_product' ); ?>
