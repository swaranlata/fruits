<?php
/* Template Name: Kilograms */
get_header();
$crntLanguage=qtranxf_getLanguage();
$getProductsList=json_decode(file_get_contents(site_url().'/api/getFruitList.php?lang='.$crntLanguage.'&type=0&offset=0'),true);
global $post;
?>
    <section class="banner-wrapper product-banner-wrap">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <div class="item active" style="background: url(<?php echo get_the_post_thumbnail_url($post->ID,'full'); ?>)">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 center-block">
                                <div class="banner_caption text-center">
                                    <h1>
                                        <?php echo $post->post_title; ?>
                                    </h1>
                                    <p>
                                        <?php echo $post->post_content; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- container -->
                </div>
            </div>
        </div>
    </section>
    <!-- banner wrapper -->
    <div class="main product-temp-wrap product-pad">
        <div class="content">
            <section class="product-wrapper product-sec-wrap">
                <div class="container">
                    <div class="section-title text-center">
                        <span><?php echo get_field('buy_now',$post->ID); ?></span>
                        <h2>
                            <?php echo get_field('fresh_fruit_products',$post->ID); ?>
                        </h2>
                    </div>
                    <!-- section-title -->

                    <div class="row">
                        <?php  
                             if(!empty($getProductsList['result'])){
                                   foreach($getProductsList['result'] as  $k=>$v){
                                        $productData = get_post($v['basketId']); 
                                        $slug = $productData->post_name;
                                          
                                            ?>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mrgn-btm-sm wow flipInX" data-delay="0.1s" data-duration="1.0s">
                            <div class="grid-item clearfix">
                                <div class="featured-img text-center">
                                    <a href="<?php echo site_url().'/product/'.$slug; ?>">
                                            <img src="<?php echo $v['firstImage'];?>" alt="<?php echo basename($v['firstImage']);?>" width="294" height="294" />
                                        </a>
                                </div>
                                <!-- featured-img -->
                                <div class="sec-title">
                                    <h3>
                                        <a href="<?php echo site_url().'/product/'.$slug; ?>">
                                            <?php echo $v['title']; ?>
                                        </a>
                                    </h3>
                                    <span>1 Kg</span>
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
                                        <a rel="nofollow" href="<?php echo site_url(); ?>/shop/?add-to-cart=<?php echo $v['basketId']; ?>" data-quantity="1" data-product_id="<?php echo $v['basketId']; ?>" data-product_sku="" class="button product_type_simple add_to_cart_button ajax_add_to_cart">
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
                                } 
                          
                            ?>

                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </section>
            <!-- product-wrapper -->
        </div>
        <!-- content -->
    </div>
    <!-- main -->
    <?php get_footer(); ?>
