<?php
/* Template Name: Homepage */
get_header();
$slider=webSlidersImages();
$crntLanguage=qtranxf_getLanguage();
$getProductsList=json_decode(file_get_contents(site_url().'/api/getFruitList.php?lang='.$crntLanguage.'&type=0&offset=0'),true);

?>
    <section class="banner-wrapper">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <?php if(!empty($slider)){
                                foreach($slider as $k=>$v){
                                    $actClass='';
                                    if($k==0){
                                        $actClass='active';
                                    }
                                    ?>
                <div class="item <?php echo $actClass; ?>" style="background: url(<?php echo $v['sliderImage']; ?>)">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 center-block bounceInDown animated" data-wow-duration="0s" data-wow-delay="5s">
                                <div class="banner_caption text-center">
                                    <h1>
                                        <?php echo $v['sliderTitle']; ?>
                                    </h1>
                                    <p>
                                        <?php echo $v['sliderContent']; ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- container -->
                </div>
                <?php
                                }
                        }?>


            </div>
        </div>
    </section>
    <div class="main">
        <div class="content">
            <section class="product-wrapper post">
                <div class="container">
                    <div class="section-title text-center">
                        <div class="title" title="Products"></div>
                        <h2>
                            <?php echo get_field('products_title',$post->ID); ?>
                        </h2>
                    </div>
                    <!-- section-title -->
                    <div class="view-more-sec text-right">
                        <a href="<?php echo site_url().'/kilogram/';?>" class="view-more">
                            <?php echo getTextByLang('View More',$crntLanguage); ?>
                        </a>
                    </div>
                    <div class="row">
                        <?php if(!empty($getProductsList['result'])){
                                        foreach($getProductsList['result'] as $k=>$v){
                                            $productData = get_post($v['basketId']); 
                                            $slug = $productData->post_name;
                                            ?>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 wow flipInX" data-delay="0.1s" data-duration="1.0s">
                            <div class="grid-item clearfix">
                                <div class="featured-img text-center">
                                    <a href="<?php echo site_url().'/product/'.$slug; ?>">
                                        <?php $image=wp_get_attachment_image_src(get_post_thumbnail_id($productData->ID),'custom-product-image');
                                         //   print_r($image);
                                        if(!empty($image)){
                                         $getImage=$image[0];
                                        } ?>
                                        
                                        
                                            <img src="<?php echo $getImage; ?>" alt="<?php echo basename($getImage); ?>" width="294" height="294" /><!--<img src="<?php echo $v['firstImage']; ?>" alt="<?php echo basename($v['firstImage']); ?>" width="294" height="294" />-->
                                        </a>
                                </div>
                                <!-- featured-img -->
                                <div class="sec-title">
                                    <h3>
                                        <a href="<?php echo site_url().'/product/'.$slug; ?>">
                                            <?php echo $v['title']; ?>
                                        </a>
                                    </h3>
                                    <span>  <?php echo $v['quantity']; ?> <?php echo getTextByLang('Kg',$crntLanguage); ?></span>
                                </div>
                                <div class="sec-content">
                                    <div class="ammount-sec pull-left">
                                        <h5>
                                            <?php echo $v['price']; ?>
                                            <?php echo CURRENCY_VAL; ?>
                                        </h5>
                                    </div>
                                    <!-- ammount-sec -->
                                    <div class="cart-sec pull-right">
                                        <?php $url=site_url().'/shop/?add-to-cart='.$v['basketId']; ?>
                                        <a rel="nofollow" href="<?php echo $url ;?>" data-quantity="1" data-product_id="<?php echo $v['basketId']; ?>" data-product_sku="" class="button product_type_simple add_to_cart_button ajax_add_to_cart">
                                            <?php echo getTextByLang('Add to cart',$crntLanguage); ?>
                                        </a>

                                    </div>
                                    <!-- cart-sec -->
                                </div>
                                <!-- sec-content -->
                            </div>
                            <!-- grid-item -->
                        </div>
                        <?php
                                        }
                                    } ?>


                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </section>
            <!-- product-wrapper -->
            <section class="catering-wrapper book-now-sec text-center post" style="background: url(<?php echo get_field('catering_image',$post->ID); ?>)">
                <div class="container">
                    <h2>
                        <?php echo get_field('catering_services',$post->ID); ?>
                    </h2>
                    <a href="<?php echo site_url().'/catering-service'; ?>" class="book-now"><?php echo get_field('book_now',$post->ID); ?></a>
                </div>
                <!-- container -->
            </section>
            <!-- catering-wrapper -->
            <section class="download-wrapper post">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 wow slideInLeft" data-wow-duration="3s" data-wow-delay="0s">
                            <div class="download-img">
                                <img alt="<?php echo basename(get_field('download_image',$post->ID)); ?>" src="<?php echo get_field('download_image',$post->ID); ?>" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                            <div class="download-content-sec">
                                <h3>
                                    <?php echo get_field('download_title',$post->ID); ?>
                                </h3>
                                <h4>
                                    <?php echo get_field('download_tagline',$post->ID); ?>
                                </h4>
                                <div class="content-sec">
                                    <?php echo get_field('download_text',$post->ID); ?>
                                </div>
                                <ul class="list-inline  wow bounceInUp" data-wow-duration="3s" data-wow-delay="0s">
                                    <li>
                                        <a href="<?php echo get_custom('google_play_store',$post->ID); ?>" target="_blank">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/special-icon1.png" alt="special-icon1.png" />    
                                            </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo get_custom('apple_store_link',$post->ID); ?>" target="_blank">
                                                <img src="<?php echo get_template_directory_uri(); ?>/images/special-icon2.png" alt="special-icon2.png" />
                                            </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                </div>
                <!-- contaimner -->
            </section>
            <!-- download-wrapper -->
            <section class="fruit-basket-wrap book-now-sec text-center post" style="background: url(<?php echo get_field('fruit_basket_image',$post->ID); ?>)">
                <div class="container">
                    <?php 
                          $shop_now=get_field('shop_now',$post->ID);  
                                               
                      ?>

                    <h2>
                        <?php echo get_field('fruit_basket',$post->ID); 
                          $getFirstBasket=getFirstBasket(); 
                          $getFirstPost= get_post($getFirstBasket['basketId']);
                        
                        ?>
                    </h2>
                    <a href="<?php echo site_url().'/product/'.$getFirstPost->post_name.'/?lang='.$crntLanguage;?>" class="book-now">
                        <?php echo $shop_now; ?>
                    </a>
                    <?php                            
                      /*  }*/
                        ?>
                </div>
                <!-- container -->
            </section>
            <!-- fruit-basket-wrap -->
        </div>
        <!-- content -->
    </div>

    <?php get_footer(); ?>
