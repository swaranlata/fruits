<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>
    <script>
        var SITE_URL = '<?php echo site_url(); ?>';

    </script>
    </div>
    <!-- wrapper -->
    <?php wp_footer(); ?>
    <footer class="footer-wrapper text-center">
        <span><?php echo get_custom('copyright_text',$post->ID); ?></span>
    </footer>

    <?php   $crntLanguage=qtranxf_getLanguage(); ?>
    <!-- Login Form -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog">
        <div class="modal-dialog form-wrap" role="document">
            <div class="modal-content mCustomScrollbar">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-section">
                        <div class="sec-title text-center mrgn-btm-sm">
                            <h3>
                                <?php echo getTextByLang('LOG IN TO YOUR ACCOUNT',$crntLanguage); ?>
                            </h3>
                            <p>
                                <?php echo getTextByLang('You need to sign in or sign up before continuing.',$crntLanguage); ?>
                            </p>
                        </div>
                        <!-- sec-title -->
                        <form id="loginForm" method="post">
                            <div style="display:none;" id="loginResponse"></div>
                            <input type="hidden" value="login" name="action" />
                            <input type="hidden" value="<?php echo qtranxf_getLanguage(); ?>" name="lang" />
                            <div class="form-group relative">
                                <input type="email" name="email" class="form-control" id="email">
                                <label class="effect"><?php echo getTextByLang('Email',$crntLanguage); ?></label>
                            </div>
                            <div class="form-group relative">
                                <input name="password" type="password" class="form-control" id="pwd">
                                <label class="effect"><?php echo getTextByLang('Password',$crntLanguage); ?></label>
                            </div>
                            <span class="show text-right mrgn-btm-sm">
                                <a href="javascript:void(0);" class="forgotPasswordPopup"><?php echo getTextByLang('Forgot password',$crntLanguage); ?>?</a></span>
                            <button type="submit" class="show btn btn-default"><?php echo getTextByLang('Log in',$crntLanguage); ?></button>
                            <span class="show text-center"><?php echo getTextByLang('Don’t have an account',$crntLanguage); ?>? 
                         <!--       <a data-toggle="modal" data-dismiss="modal" data-poplink=".signupLink" href="javascript:void(0);" class="signin signup popLink"><?php //echo getTextByLang('Register here',$crntLanguage); ?></a>--> 
                                <a href="javascript:void(0);" class="signin signup"> <?php echo getTextByLang('Register here',$crntLanguage); ?></a></span>
                        </form>

                    </div>
                    <!-- form-section -->
                </div>
            </div>
        </div>
    </div>
    <?php
 $getFirstBasket=getFirstBasket(); 
 $getFirstPost= get_post($getFirstBasket['basketId']);  
?>
        <input type="hidden" value="<?php echo site_url().'/product/'.$getFirstPost->post_name.'/?lang='.$crntLanguage;?>" id="firstBasket" />
        <!-- Signin Form -->
        <div class="modal fade" id="signin" tabindex="-1" role="dialog">
            <div class="modal-dialog form-wrap" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-section">
                            <div class="sec-title text-center mrgn-btm-sm">
                                <h3>
                                    <?php echo getTextByLang('Register a new ACCOUNT',$crntLanguage); ?>
                                </h3>
                                <p>
                                    <?php echo getTextByLang('You need to sign in or sign up before continuing.',$crntLanguage); ?>
                                </p>
                            </div>
                            <!-- sec-title -->
                            <form id="signupForm" method="post">
                                <div style="display:none;" id="signupResponse"></div>
                                <input type="hidden" value="signup" name="action" />
                                <input type="hidden" value="<?php echo qtranxf_getLanguage(); ?>" name="lang" />
                                <div class="form-group relative">
                                    <input type="text" class="form-control char_error" name="name" id="text">
                                    <label class="effect"><?php echo getTextByLang('Username',$crntLanguage); ?></label>
                                </div>
                                <div class="form-group relative">
                                    <input type="email" name="email" class="form-control" id="signupEmail">
                                    <label class="effect"><?php echo getTextByLang('Email',$crntLanguage); ?></label>
                                </div>
                                <div class="form-group relative">
                                    <input type="tel" name="phoneNumber" maxLength="15" class="form-control numberOnly" id="tel">
                                    <label class="effect"><?php echo getTextByLang('Phone Number',$crntLanguage); ?></label>
                                </div>
                                <div class="form-group relative">
                                    <input name="password" type="password" class="form-control" id="signupPassword">
                                    <label class="effect"><?php echo getTextByLang('Password',$crntLanguage); ?></label>
                                </div>
                                <div class="form-group relative">
                                    <input name="confirm_password" type="password" class="form-control" id="signupPwd">
                                    <label class="effect"><?php echo getTextByLang('Confirm Password',$crntLanguage); ?></label>
                                </div>
                                <!-- <span class="show reg text-center mrgn-btm-sm">Registration Confirmation will be emailed to you</span>-->
                                <button type="submit" class="show btn btn-default"><?php echo getTextByLang('Register',$crntLanguage); ?></button>
                                <span class="show text-center"><?php echo getTextByLang('Already have an account',$crntLanguage); ?>?
                                    <a href="javascript:void(0);" class="login"><?php echo getTextByLang('Sign in here',$crntLanguage); ?></a></span>
                                <!--  <a data-toggle="modal" data-dismiss="modal" data-poplink=".loginLink" href="javascript:void(0);" class="login popLink"><?php echo getTextByLang('Sign in here',$crntLanguage); ?></a></span>-->
                            </form>

                        </div>
                        <!-- form-section -->
                    </div>
                </div>
            </div>
        </div>


        <!-- Changle Password -->
        <div class="modal fade" id="account" tabindex="-1" role="dialog">
            <div class="modal-dialog form-wrap" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-section">
                            <div class="sec-title text-center mrgn-btm-sm">
                                <h3>Change Password</h3>
                            </div>
                            <div id="changeResp" style="display:none; "></div>
                            <!-- sec-title -->
                            <form id="changePassword" method="post">
                                <div class="form-group relative">
                                    <input type="password" name="old_password" class="form-control" id="pwd1">
                                    <label class="effect">Type Current Password</label>
                                </div>
                                <div class="form-group relative">
                                    <input type="password" name="new_password" class="form-control" id="pwd2">
                                    <label class="effect">Type New Password</label>
                                </div>
                                <div class="form-group relative">
                                    <input type="password" name="confirm_password" class="form-control" id="pwd3">
                                    <label class="effect">Retype New Password</label>
                                </div>
                                <button type="submit" class="show btn btn-default">Change Password</button>
                            </form>

                        </div>
                        <!-- form-section -->
                    </div>
                </div>
            </div>
        </div>


        <!-- Forgot Password -->


        <div class="modal fade" id="fPassword" tabindex="-1" role="dialog">
            <div class="modal-dialog form-wrap" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-section">
                            <div class="sec-title text-center mrgn-btm-sm">
                                <h3>
                                    <?php echo getTextByLang('Forgot Password',$crntLanguage); ?>
                                </h3>
                            </div>
                            <div id="forgotResp" style="display:none; "></div>
                            <!-- sec-title -->
                            <form id="forgotPassword" method="post">
                                <input type="hidden" name="action" value="forgot_password" />
                                <input type="hidden" name="lang" value="<?php echo $crntLanguage; ?>" />
                                <div class="form-group relative">
                                    <input type="text" name="email" class="form-control" id="emaildata">
                                    <label class="effect"><?php echo getTextByLang('Email',$crntLanguage); ?></label>
                                </div>
                                <button type="submit" class="show btn btn-default"><?php echo getTextByLang('Submit',$crntLanguage); ?></button>
                            </form>

                        </div>
                        <!-- form-section -->
                    </div>
                </div>
            </div>
        </div>



        <div class="modal-popup modal fade" id="storage" tabindex="-1" role="dialog">
            <div class="modal-dialog form-wrap" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="content-section">
                            <div class="sec-title text-center">
                                <h3>
                                    <?php echo getTextByLang('Storage Facts',qtranxf_getLanguage()); ?>
                                </h3>
                                <p class="stora"></p>
                            </div>
                            <!-- sec-title -->
                        </div>
                        <!-- form-section -->
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-popup modal fade" id="nutrition" tabindex="-1" role="dialog">
            <div class="modal-dialog form-wrap" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="content-section">
                            <div class="sec-title text-center">
                                <h3>
                                    <?php echo getTextByLang('Nutrition Facts',qtranxf_getLanguage()); ?>
                                </h3>
                                <p class="nutritionDetails"></p>
                            </div>
                            <!-- sec-title -->
                        </div>
                        <!-- form-section -->
                    </div>
                </div>
            </div>
        </div>



        <div class="modal-popup modal fade" id="storage_fact_items" tabindex="-1" role="dialog">
            <div class="modal-dialog form-wrap" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="content-section">
                            <div class="sec-title text-center">
                                <h3>
                                    <?php echo getTextByLang('Storage Facts',qtranxf_getLanguage()); ?>
                                </h3>
                                <p class="storage_fact_items"></p>
                            </div>
                            <!-- sec-title -->
                        </div>
                        <!-- form-section -->
                    </div>
                </div>
            </div>
        </div>


        <div class="modal-popup modal fade" id="nutirtion_fact_items" tabindex="-1" role="dialog">
            <div class="modal-dialog form-wrap" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="content-section">
                            <div class="sec-title text-center">
                                <h3>
                                    <?php echo getTextByLang('Nutrition Facts',qtranxf_getLanguage()); ?>
                                </h3>
                                <p class="nutirtion_fact_items"></p>
                            </div>
                            <!-- sec-title -->
                        </div>
                        <!-- form-section -->
                    </div>
                </div>
            </div>
        </div>

        <div class="loadingUserLoader" style="display: none;">
            <div class="Userpreloader">
            </div>
        </div>


        </body>

        </html>
