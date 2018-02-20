<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
global $post;
$crntLanguage=qtranxf_getLanguage();
 $CURRENCY_VAL='KD';
if($crntLanguage=='ar'){
    $CURRENCY_VAL='د.ك';
}
define(CURRENCY_VAL,$CURRENCY_VAL);
?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?> class="no-js">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php /* if(get_page_template_slug()=='template-home.php'){
      ?>
        <!-- <title>FruitDose</title>-->
        <?php 
}else{
    ?>

        <title>
            <?php echo wp_title(); ?>
        </title>

        <?php 
} */ ?>

        <?php wp_head(); ?>
        <style>
            .shipping {
                display: none !important;
            }

        </style>
    </head>

    <body <?php body_class(); ?>>
        <div class="preloader">
            <div id="loader"></div>
        </div>
        <div class="wrapper" id="data_lang" data-lang-val="<?php echo qtranxf_getLanguage(); ?>">
            <header class="header">
                <div class="header-wrapper" id="myHeader">
                    <div class="container clearfix">
                        <div class="logo-wrap pull-left">
                            <a href="<?php echo site_url(); ?>" class="logo">
                                <?php
                            $custom_logo_id = get_theme_mod( 'custom_logo' );
                            $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                            $logo='';
                            if(isset($image) and !empty($image)){
                               $logo=$image[0]; 
                            }?>
                                    <img src="<?php echo $logo; ?>" alt="<?php echo basename($logo); ?>" />
                            </a>
                        </div>
                        <!-- logo-wrap -->
                        <div class="header-right-sec pull-right">
                            <div class="d-block j-content clearfix">
                                <div class="menu-sec-wrap text-right align-center pull-left">
                                    <div class="header-top">
                                        <ul class="list-inline">
                                            <li>
                                                <a href="<?php echo get_custom('google_play_store',$post->ID); ?>" target="_blank">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/google-play.png" alt="google-play.png" />    
                                            </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo get_custom('apple_store_link',$post->ID); ?>" target="_blank">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/app-store.png" alt="app-store.png" />
                                            </a>
                                            </li>
                                            <li>
                                                <form>
                                                    <div class="form-group">
                                                        <select class="form-control changeLanguage">
                                                        <option <?php if($crntLanguage=='en'){
    echo 'selected';
    
} ?> value="en">English</option>
                                                        <option <?php if($crntLanguage=='ar'){
    echo 'selected';
    
} ?> value="ar">العربية</option>
                                                    </select>
                                                    </div>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- header-top -->
                                    <div class="header-bottom">
                                        <div class="d-flex j-content">
                                            <div class="header-menu pull-left align-center">
                                                <nav class="main-navigation" id="site-navigation">
                                                    <div class="primary-menu">
                                                        <?php 
                                                           $params = array(
                                                                'theme_location' => 'primary',
                                                                'menu_id' => 'menu-main-menu',
                                                                'menu_class'=>'main-menu',
                                                               'container'=>''

                                                            );
                                                            wp_nav_menu($params);
                                                        ?>
                                                        

                                                        <!-- main-menu -->
                                                    </div>
                                                    <!-- primary-menu -->
                                                </nav>
                                                <!-- main-navigation -->
                                            </div>
                                            <!-- header-menu -->
                                            <div class="search-form pull-left align-center">
                                                <?php include (TEMPLATEPATH . '/searchform.php'); ?>
                                            </div>
                                            <!-- search-form -->
                                        </div>
                                    </div>
                                    <!-- header-bottom -->
                                </div>
                                <!-- menu-sec-wrap -->
                                <?php 
                                        global $woocommerce;
                                        $cartCount= $woocommerce->cart->cart_contents;
                                  ?>
                                <div class="cart-sec align-center pull-left">
                                    <div id="btn-cart" class="fr">
                                        <a href="<?php echo site_url().'/cart'; ?>" title="Cart" class="cart-contents">
                                                 <i class="la la-shopping-cart" aria-hidden="true"></i>
                                                  <span class="cart-item-number"><?php echo count($cartCount); ?></span>                                         
                                            </a>
                                    </div>
                                </div>
                                <!-- cart-sec -->
                            </div>
                        </div>
                        <!-- header-right-sec -->
                    </div>
                    <!-- container -->
                    <div class="sticky-header-wrap">
                        <div class="container">
                            <div class="logo-wrap pull-left">
                                <a href="<?php echo site_url(); ?>" class="logo">
                                    <?php
                                $custom_logo_id = get_theme_mod( 'custom_logo' );
                                $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                                $logo='';
                                if(isset($image) and !empty($image)){
                                   $logo=$image[0]; 
                                }?>
                                        <img src="<?php echo $logo; ?>" alt="<?php echo basename($logo); ?>" />
                                </a>
                            </div>
                            <!-- logo-wrap -->
                            <div class="header-right-sec pull-right">
                                <div class="d-block j-content clearfix">
                                    <div class="menu-sec-wrap text-right align-center pull-left">
                                        <div class="header-menu">
                                            <nav class="main-navigation" id="site-navigation1">
                                                <div class="primary-menu">
                                                    <?php 
                                               $params = array(
                                                    'theme_location' => 'primary',
                                                    'menu_id' => 'menu-main-menu2',
                                                    'menu_class'=>'main-menu',
                                                   'container'=>''

                                                );
                                                wp_nav_menu($params);
                                            ?>

                                                    <!-- main-menu -->
                                                </div>
                                                <!-- primary-menu -->
                                            </nav>
                                            <!-- main-navigation -->
                                        </div>
                                        <!-- header-menu -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- container -->
                    </div>
                    <!-- sticky-header -->
                </div>
                <!-- header-wrapper -->
            </header>
            <div class="responsive-header">
                <div class="responsive-logo-wrapper d-flex j-content clearfix">
                    <div class="header-logo pull-left align-center">
                        <a href="<?php echo site_url(); ?>" class="logo">
                            <?php
                            $custom_logo_id = get_theme_mod( 'custom_logo' );
                            $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                            $logo='';
                            if(isset($image) and !empty($image)){
                               $logo=$image[0]; 
                            }?>
                                <img src="<?php echo $logo; ?>" alt="<?php echo basename($logo); ?>" />
                        </a>
                    </div>
                    <div class="header-top pull-right align-center">
                        <ul class="list-inline">
                            <li>
                                <a href="<?php echo get_custom('google_play_store',$post->ID); ?>" target="_blank">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/google-play.png" alt="google-play.png" />    
                                            </a>
                            </li>
                            <li>
                                <a href="<?php echo get_custom('apple_store_link',$post->ID); ?>" target="_blank">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/app-store.png" alt="app-store.png" />
                                            </a>
                            </li>
                            <li>
                                <form>
                                    <div class="form-group">
                                        <select class="form-control changeLanguage">
                                                        <option <?php if($crntLanguage=='en'){
    echo 'selected';
    
} ?> value="en">English</option>
                                                        <option <?php if($crntLanguage=='ar'){
    echo 'selected';
    
} ?> value="ar">العربية</option>
                                                    </select>
                                    </div>
                                </form>
                            </li>
                            <li>
                                <div class="search-form align-center">
                                    <?php include (TEMPLATEPATH . '/searchform.php'); ?>
                                </div>
                            </li>
                            <li>
                                <div class="cart-sec align-center">
                                    <div id="btn-cart1" class="fr">
                                        <a href="<?php echo site_url().'/cart'; ?>" title="Cart sss" class="cart-contents">
										 <i class="la la-shopping-cart" aria-hidden="true"></i>
										  <span class="cart-item-number"><?php echo esc_html( trim( WC()->cart->get_cart_contents_count() ) ); ?></span>                                         
									</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- header-top -->
                </div>
                <div class="responsive-menu sticky-header">
                    <nav class="main-navigation">
                        <div class="primary-menu">
                            <?php 
                               $params = array(
                                    'theme_location' => 'primary',
                                    'menu_id' => 'menu-main-menu1',
                                    'menu_class'=>'main-menu',
                                   'container'=>''

                                );
                                wp_nav_menu($params);
                            ?>

                            <!-- main-menu -->
                        </div>
                        <!-- primary-menu -->
                    </nav>
                </div>
                <!-- responsive-menu -->
            </div>
