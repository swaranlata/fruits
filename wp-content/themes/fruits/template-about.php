<?php
/* Template Name: Information Pages */
get_header();
$crntLanguage=qtranxf_getLanguage();
global $post;
?>
    <div class="page-title-bar clearfix" style="background: url(<?php echo get_the_post_thumbnail_url($post->ID,'full'); ?>)">
        <h1>
            <?php echo $post->post_title; ?>
        </h1>
    </div>
    <!-- page-title-bar -->
    <div class="main">
        <div class="content">
            <section class="section-content-wrap post">
                <div class="container">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 device-mrgn-btm">
                            <div class="content-sec">
                                <?php echo wpautop($post->post_content); ?>
                            </div>
                            <!-- content-sec -->
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                            <div class="img-sec">
                                <img src=" <?php echo get_field( 'content_image',$post->ID); ?>" alt="
                                <?php echo basename(get_field('content_image',$post->ID));  ?>" />
                            </div>
                            <!-- img-sec -->
                        </div>
                    </div>
                </div>
                <!-- container -->
            </section>
        </div>
        <!-- content -->
    </div>
    <!-- main -->
    <?php get_footer(); ?>
