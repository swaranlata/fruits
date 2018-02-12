<?php
/* Template Name: Fruit Basket */
get_header();
$crntLanguage=qtranxf_getLanguage();
$getProductsList=json_decode(file_get_contents(site_url().'/api/getFruitList.php?lang='.$crntLanguage.'&type=1&offset=0'),true);
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
    <div class="main product-temp-wrap fruit-basket-pad">
        <div class="content">
            <section class="product-wrapper product-sec-wrap">
                <div class="container">
                    <div class="section-title text-center">
                        <span><?php echo get_field('buy_now',$post->ID); ?></span>
                        <h2>
                            <?php echo get_field('mix_fruit_basket',$post->ID); ?>
                        </h2>
                    </div>
                    <!-- section-title -->
                    <div class="fruit-product-sec clearfix">
                        <?php  
                        $count=count($getProductsList['result']);
                             if(!empty($getProductsList['result'])){
                                   foreach($getProductsList['result'] as  $k=>$v){
                                        $productData = get_post($v['basketId']); 
                                        $slug = $productData->post_name;
                                        $class=''; 
                                          if($count=='1'){
                                             $class='center-block'; 
                                          }
                                            ?>
                        <div class="fruit-basket-wrap text-center <?php echo $class; ?>">
                            <div class="fruit-basket-sec">
                                <img src="<?php echo $v['firstImage'];?>" alt="fruit-basket" />
                            </div>
                            <!-- fruit-basket-sec -->
                            <div class="sec-content clearfix">
                                <div class="ammount-sec pull-left">
                                    <h3>
                                        <a href="<?php echo site_url().'/product/'.$slug; ?>">
                                            <?php echo $v['title']; ?>
                                        </a>
                                    </h3>
                                    <div class="units-wrap">
                                        <div class="units pull-left">
                                            <span>1 unit</span>
                                        </div>
                                        <div class="peice pull-left">
                                            <span><?php echo $v['price']; ?><?php echo get_woocommerce_currency_symbol(); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- ammount-sec -->
                                <div class="cart-sec pull-right">
                                    <a rel="nofollow" href="<?php echo site_url(); ?>/shop/?add-to-cart=<?php echo $v['basketId']; ?>" data-quantity="1" data-product_id="<?php echo $v['basketId']; ?>" data-product_sku="" class="button product_type_simple add_to_cart_button ajax_add_to_cart">Add to cart</a>
                                </div>
                                <!-- cart-sec -->
                            </div>
                        </div>
                        <!-- fruit-basket-wrap -->
                        <?php }
                             }?>
                    </div>
                </div>
                <!-- container -->
            </section>
            <!-- product-wrapper -->
        </div>
        <!-- content -->
    </div>
    <!-- main -->
    <?php get_footer(); ?>
