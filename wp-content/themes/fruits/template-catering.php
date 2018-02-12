<?php
/* Template Name: Catering Service */
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
    <div class="main product-temp-wrap cater-basket-pad">
        <div class="content">
            <section class="product-sec-wrap post">
                <div class="container">
                    <div class="section-title">
                        <h3>
                            <?php echo get_field('tagline',$post->ID); ?>
                        </h3>
                    </div>
                    <!-- section-title -->
                    <div id="cateringResp" style="display:none;"></div>
                    <div class="catering-form-wrap">
                        <form id="cateringForm" method="post">
                            <input type="hidden" name="action" value="add_catering_message" />
                            <input type="hidden" name="price" value="0" />
                            <input type="hidden" name="lang" value="<?php echo $crntLanguage;?>" />
                            <div class="row clearfix">
                                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <label><?php echo getTextByLang('Name',$crntLanguage) ?></label>
                                    <input type="text" name="name" class="form-control char_error" placeholder="<?php echo getTextByLang('Enter Your Name',$crntLanguage) ?>">
                                </div>
                                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <label><?php echo getTextByLang('Email',$crntLanguage) ?></label>
                                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="<?php echo getTextByLang('Enter Your Email',$crntLanguage) ?>">
                                </div>
                                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <label><?php echo getTextByLang('Phone Number',$crntLanguage) ?></label>
                                    <input name="phoneNumber" type="tel" class="form-control numberOnly" maxLength="15" placeholder="<?php echo getTextByLang('Enter Your Phone Number',$crntLanguage) ?>">
                                </div>
                                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <label><?php echo getTextByLang('Description',$crntLanguage) ?></label>
                                    <input name="description" type="text" class="form-control" placeholder="<?php echo getTextByLang('Description',$crntLanguage) ?>">
                                </div>
                                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <label><?php echo getTextByLang('Number of Attendees',$crntLanguage) ?></label>
                                    <input name="numberOfAttendees" type="text" class="form-control numberOnly" placeholder="<?php echo getTextByLang('Eg.',$crntLanguage) ?> 100">
                                </div>
                                <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <label><?php echo getTextByLang('Event Date',$crntLanguage) ?></label>
                                    <input readonly type="text" name="dateOfEvent" class="form-control" id="eventDate" placeholder="30/12/2017">
                                </div>
                                <div class="error">
                                    <span><?php echo getTextByLang('Note: Date must be one week before the event date',$crntLanguage) ?></span>
                                </div>
                                <button type="submit" class="btn btn-primary"><?php echo getTextByLang('Submit',$crntLanguage) ?></button>
                            </div>
                            <!-- row -->
                        </form>
                    </div>
                    <!-- catering-form-wrap -->
                </div>
                <!-- container -->
            </section>
            <!-- product-wrapper -->
        </div>
        <!-- content -->
    </div>
    <!-- main -->




    <?php get_footer(); ?>
