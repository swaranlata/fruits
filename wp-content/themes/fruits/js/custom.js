jQuery(function ($) {

    //Wow
    new WOW().init();

    //Preloader
    var preloader = $('.preloader');
    $(window).load(function () {
        preloader.remove();
    });
    /*$(window).scroll(function(){
        $('.responsive-menu').addClass('fixed');
    });*/

    // Modal Class
    //    $('.popLink').on('click', function (e) {
    //        var thisData = $(this).data('poplink');
    //        setTimeout(function () {
    //            $(thisData).trigger('click');
    //        }, 500);
    //    });

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();
        if (scroll >= 200) {
            $(".responsive-header").addClass("fixed-header");
        } else {
            $(".responsive-header").removeClass("fixed-header");
        }
    });
    $(window).scroll(function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 200) {
            $(".header-wrapper").addClass("fixed-header");
        } else {
            $(".header-wrapper").removeClass("fixed-header");
        }
    });
    // SelectBox
    jQuery('.validate-required select').change(function () {
        if (jQuery(this).children('option:first-child').is(':selected')) {
            jQuery(this).addClass('selectpicker');
        } else {
            jQuery(this).removeClass('selectpicker');
        }
    });
    jQuery('.woocommerce-billing-fields select').addClass('placeholder1');
     jQuery('.woocommerce-billing-fields select').change(function () {
        if (jQuery(this).children('option:first-child').is(':selected')) {
            jQuery(this).addClass('placeholder1');
        } else {
            jQuery(this).removeClass('placeholder1');
        }
    });
    jQuery('#account_email').addClass('char_error numberOnly');
    jQuery('#billing_phone_field input').addClass('numberOnly');
    jQuery('.aboutTab').children().attr('href','javascript:void(0)');
    jQuery(".form-control").on("focusout load", function () {
        if (jQuery(this).val() != "") {
            jQuery(this).siblings("label").addClass("has-content");
        } else {
            jQuery(this).siblings("label").removeClass("has-content");
        }
    });
    $('.breadcrumbs .post-product-archive').attr('href', SITE_URL + '/kilogram');
    //TextArea

    $(function (jQuery) {
        $('.firstCap').on('keypress', function (event) {
            var $this = $(this),
                thisVal = $this.val(),
                FLC = thisVal.slice(0, 1).toUpperCase();
            con = thisVal.slice(1, thisVal.length);
            $(this).val(FLC + con);
        });
    });

    //Slimmenu
    var langVal = $('#data_lang').attr('data-lang-val');
    $('.main-navigation .login a').attr('class', 'loginLink');
    $('.main-navigation .signup a').attr('class', 'signupLink');
    setInterval(function () {
        if (langVal == 'en') {
            $('.woocommerce-Price-currencySymbol').html('KD ');
        } else {
            $('.woocommerce-Price-currencySymbol').html('د.ك ');
        }
    }, 500);
    var billing_alt = $('#billing_alt').val();
    if (billing_alt == '0') {
        $('#billing_alt').val('');
    }
    if (langVal == 'en') {
        $('.woocommerce-Price-currencySymbol').html('KD ');
    } else {
        $('.woocommerce-Price-currencySymbol').html('د.ك ');
    }

    $('#menu-item-794').children().attr('href', 'javascript:void(0)');
    setTimeout(function () {
        $('#menu-item-794').children().attr('href', 'javascript:void(0)');
        $('.breadcrumbs .post-product-archive').attr('href', SITE_URL + '/kilogram');
    }, 1000);
    $('.responsive-header #menu-main-menu1').addClass('slimmenu');
    $('#billing_country').val('KW');
    $('.slimmenu').slimmenu({
        resizeWidth: '992',
        collapserTitle: 'Menu',
        animSpeed: 'medium',
        indentChildren: true,
        childrenIndenter: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        expandIcon: '<i class="fa fa-plus" aria-hidden="true"></i>',
        collapseIcon: '<i class="fa fa-minus" aria-hidden="true"></i>'
    });
    var bodyClass = $('body').hasClass('logged-in');
    if (bodyClass == true) {
        $('.login').hide();
        $('.signup').hide();
    } else {
        $('.my-account').hide();
    }
    var basketUrl = $('#firstBasket').val();
    $('.fruitBasket a').attr('href', basketUrl);
    $(".woocommerce-product-gallery__image a img").hover(function () {
        $(".woocommerce-product-gallery__wrapper div:first-child").find('img').attr("src", $(this).attr('src'))
    });
    $('.country_to_state').parent().hide();
    $('.login a').attr('href', 'javascript:void(0)');
    $('.signup a').attr('href', 'javascript:void(0)');
    $(document).on('click', '.login', function () {
        /* $(this).addClass('current-menu-item');
         $('.signup').removeClass('current-menu-item');*/
        var check = $('body').hasClass('modal-open');
        if (check == false) {
            $('body').addClass('modal-open');
        }
        $('.slimmenu').hide();
        $('#loginResponse').hide();
        $('#loginForm')[0].reset();
        $('#signin').modal('hide');
        $('#login').modal('show');
    });
    $(document).on('click', '.add_address', function () {
        $('#shipping_first_name_field').hide();
        $('#shipping_last_name_field').hide();
    });
    $(document).on('click', '.signup', function () {
        /* $(this).addClass('current-menu-item');
         $('.login').removeClass('current-menu-item');*/
        setTimeout(function () {
            var check = $('body').hasClass('modal-open');
            $('body').addClass('modal-open');

        }, 500);

        $('.slimmenu').hide();
        $('#signupResponse').hide();
        $('#signupForm')[0].reset();
        $('#login').modal('hide');
        $('#signin').modal('show');
    });
    $(document).on('click', '.changePasswordPopup', function () {

        setTimeout(function () {
            var check = $('body').hasClass('modal-open');
            if (check == false) {

                $('body').addClass('modal-open');
            }
        }, 500);
        $('#login').modal('hide');
        $('#account').modal('show');
    });
    $(document).on('click', '.forgotPasswordPopup', function () {
        setTimeout(function () {
            var check = $('body').hasClass('modal-open');
            if (check == false) {
                $('body').addClass('modal-open');
            }
        }, 500);
        $('#login').modal('hide');
        $('#fPassword').modal('show');
    });
    $(document).on('change', '.changeLanguage', function () {
        $('.loadingUserLoader').show();
        var language = $(this).val();
        var currentUrl = window.location.href;
        if (language == 'ar') {
            window.location.href = currentUrl + '/?lang=' + language;
        } else {
            currentUrl = currentUrl.replace('?lang=ar', '?lang=en');
            window.location.href = currentUrl;
        }
    });
    //$('.shipping_address .form-row').hide();
    $('.woocommerce-checkout .woocommerce_message').hide();
    $('.woocommerce-MyAccount-navigation-link--downloads').hide();
    $('#signupForm').validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phoneNumber: {
                required: true,
                number: true
            },
            password: {
                required: true
            },
            confirm_password: {
                required: true,
                equalTo: '#signupPassword'
            }
        },
        messages: {
            password: {
                required: "Please Enter your password."
            },
            email: "Please enter a valid email address"
        },
        submitHandler: function (form) {
            $('.loading_image').show();
            var emailResp = $('#signupEmail').val();
            var responseTest = validateEmail(emailResp);
            if (responseTest == false) {
                $('.loading_image').hide();
                $('#signupEmail').css('border-bottom', '1px solid red !important;');
                return false;
            }
            var formData = $("#signupForm").serializeArray();
            $.ajax({
                data: formData,
                url: SITE_URL + '/wp-admin/admin-ajax.php',
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    $('.loading_image').hide();
                    if (response.success == 1) {
                        $('#signupResponse').show();
                        $('#signupForm')[0].reset();
                        $('#signupResponse').html('<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.error + '</div>');
                        $('#signupResponse').delay(2000).fadeOut();
                        setTimeout(function () {
                            $('#signin').modal('hide');
                        }, 3000);
                    } else {
                        $('#signupResponse').show();
                        $('#signupResponse').html('<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.error + '</div>');
                    }

                }
            });
        }
    });

    $(document).on('keydown', '.char_error', function (e) {
        var key = e.keyCode;
        if (!((key == 8) || (key == 9) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >= 65 && key <= 90))) {
            e.preventDefault();
        }
    });
    $(document).on('keydown', '.numberOnly', function (e) {
        -1 !== $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || (/65|67|86|88/.test(e.keyCode) && (e.ctrlKey === true || e.metaKey === true)) && (!0 === e.ctrlKey || !0 === e.metaKey) || 35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey || 48 > e.keyCode || 57 < e.keyCode) && (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
    });

    $('#loginForm').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true
            }
        },
        messages: {
            password: {
                required: "Please Enter your password."
            },
            email: "Please enter a valid email address"
        },
        submitHandler: function (form) {
            var emailResp = $('#email').val();
            var responseTest = validateEmail(emailResp);
            console.log(responseTest);
            if (responseTest == false) {
                console.log('responseTest');
                $('#email').attr('style', 'border-bottom:1px solid red;');
                return false;
            }
            $('.loadingUserLoader').show();
            var formData = $("#loginForm").serializeArray();
            $.ajax({
                data: formData,
                url: SITE_URL + '/wp-admin/admin-ajax.php',
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    if (response.success == 1) {
                        $('#login').modal('hide');
                        $('.loadingUserLoader').hide();
                        window.location.href = SITE_URL;
                    } else {
                        $('.loadingUserLoader').hide();
                        $('#loginResponse').show();
                        $('#loginResponse').html('<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.error + '</div>');
                    }

                }
            });
        }
    });
    $('#cateringForm').validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phoneNumber: {
                required: true,
                number: true
            },
            description: {
                required: true
            },
            numberOfAttendees: {
                required: true
            },
            dateOfEvent: {
                required: true
            }
        },
        submitHandler: function (form) {
            $('.loadingUserLoader').show();
            var formData = $("#cateringForm").serializeArray();
            $.ajax({
                data: formData,
                url: SITE_URL + '/wp-admin/admin-ajax.php',
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    $('.loadingUserLoader').hide();
                    if (response.success == 1) {
                        $('#cateringResp').show();
                        $('#cateringResp').html('<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.error + '</div>');
                        $('#cateringForm')[0].reset();
                        setTimeout(function () {
                            $('#cateringForm')[0].reset();
                            $('#cateringResp').delay(2000).fadeOut();
                            location.reload();
                        }, 4000);
                    } else {
                        $('#cateringResp').show();
                        $('#cateringResp').html('<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.error + '</div>');
                        setTimeout(function () {
                            $('#cateringResp').delay(2000).fadeOut();
                        }, 4000);
                    }

                }
            });
        }
    });
    $('#eventDate').datepicker({
        minDate: 0,
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        yearRange: "-100:+0",
        dateFormat: "dd/mm/yy"

    });
    $('#changePassword').validate({
        rules: {
            old_password: {
                required: true
            },
            new_password: {
                required: true

            },
            confirm_password: {
                required: true,
                equalTo: '#pwd2'
            }
        },
        submitHandler: function (form) {
            var formData = $("#changePassword").serializeArray();
            $('.loadingUserLoader').show();
            $.ajax({
                data: formData,
                url: SITE_URL + '/wp-admin/admin-ajax.php',
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    $('.loadingUserLoader').hide();
                    if (response.success == 1) {
                        $('#forgotResp').show();
                        $('#forgotResp').html('<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.error + '</div>');
                        $('#addCateringMessage')[0].reset();
                        setTimeout(function () {
                            $('#forgotResp').delay(2000).fadeOut();
                        }, 4000);
                    } else {
                        $('#forgotResp').show();
                        $('#forgotResp').html('<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.error + '</div>');
                        //$('#addCateringMessage')[0].reset(); 
                        setTimeout(function () {
                            $('#forgotResp').delay(2000).fadeOut();
                        }, 4000);
                    }

                }
            });
        }
    });
    $('#forgotPassword').validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        submitHandler: function (form) {
            $('.loadingUserLoader').show();
            var formData = $("#forgotPassword").serializeArray();
            $.ajax({
                data: formData,
                url: SITE_URL + '/wp-admin/admin-ajax.php',
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    $('.loadingUserLoader').hide();
                    if (response.status == 'true') {
                        $('#forgotResp').show();
                        $('#forgotResp').html('<div class="alert alert-success alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.message + '</div>');
                        $('#forgotPassword')[0].reset();
                        setTimeout(function () {
                            $('#forgotResp').delay(2000).fadeOut();
                            $('#fPassword').modal('hide');
                        }, 4000);
                    } else {
                        $('#forgotResp').show();
                        $('#forgotResp').html('<div class="alert alert-danger alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.message + '</div>');
                        setTimeout(function () {
                            $('#forgotResp').delay(2000).fadeOut();
                        }, 4000);
                    }

                }
            });
        }
    });

    $('#resetPassword').validate({
        rules: {
            newPassword: {
                required: true
            },
            confirmPassword: {
                required: true,
                equalTo: '#newPassword'

            }
        },
        submitHandler: function (form) {
            $('.loadingUserLoader').show();
            var formData = $("#resetPassword").serializeArray();
            $.ajax({
                data: formData,
                url: SITE_URL + '/wp-admin/admin-ajax.php',
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    $('.loadingUserLoader').hide();
                    if (response.status == 'true') {
                        $('#response').html('<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>' + response.message + '</div>');
                        $("#resetPassword")[0].reset();
                        $('#response').delay(2000).fadeOut();
                       // location.reload();
                    }

                }
            });
        }
    });
    /*$('.woocommerce-account-fields').hide();*/
    $(document).on('click', '.tryAgain', function () { 
    window.location.href=SITE_URL;
    });
        
        $(document).on('click', '.storage', function () {
        $('.loadingUserLoader').show();
        var proId = $(this).attr('data-id');
        var lang = $('#data_lang').attr('data-lang-val');
        var type = $(this).attr('data-type');
        if (type == 'single') {
            $.ajax({
                data: {
                    proId: proId,
                    lang: lang,
                    action: 'storage_fact'
                },
                url: SITE_URL + '/wp-admin/admin-ajax.php',
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    $('.loadingUserLoader').hide();
                    if (response.status == 'true') {
                        $('#storage').modal('show');
                        $('.stora').html(response.data);
                    } else {
                        $('#storage').modal('show');
                        $('.stora').html(response.data);
                    }

                }
            });
        } else {
            $.ajax({
                data: {
                    proId: proId,
                    lang: lang,
                    action: 'storage_fact_items'
                },
                url: SITE_URL + '/wp-admin/admin-ajax.php',
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    $('.loadingUserLoader').hide();
                    if (response.status == 'true') {
                        $('#storage_fact_items').modal('show');
                        $('.storage_fact_items').html(response.data);
                    } else {
                        $('#storage_fact_items').modal('show');
                        $('.storage_fact_items').html(response.data);
                    }

                }
            });
        }




    });
    $(document).on('click', '.buyNowBtn', function () {
        $('.loadingUserLoader').show();
        var proId = $(this).attr('data-attr-id');
        var lang = $('#data_lang').attr('data-lang-val');
        $.ajax({
            data: {
                proId: proId,
                action: 'myajax'
            },
            url: SITE_URL + '/wp-admin/admin-ajax.php',
            type: 'POST',
            dataType: 'json',
            success: function (response) {
                $('.loadingUserLoader').hide();
                if (response.status == 'true') {
                    window.location.href = SITE_URL + '/checkout?lang=' + lang;
                }

            }
        });
    });
    $(document).on('click', '.nutrition', function () {
        $('.loadingUserLoader').show();
        var proId = $(this).attr('data-id');
        var lang = $('#data_lang').attr('data-lang-val');
        var type = $(this).attr('data-type');
        if (type == 'single') {
            $.ajax({
                data: {
                    proId: proId,
                    lang: lang,
                    action: 'nutrition_fact'
                },
                url: SITE_URL + '/wp-admin/admin-ajax.php',
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    $('.loadingUserLoader').hide();
                    if (response.status == 'true') {
                        $('#nutrition').modal('show');
                        $('.nutritionDetails').html(response.data);
                    } else {
                        $('#nutrition').modal('show');
                        $('.nutritionDetails').html(response.data);
                    }

                }
            });
        } else {
            $.ajax({
                data: {
                    proId: proId,
                    lang: lang,
                    action: 'nutirtion_fact_items'
                },
                url: SITE_URL + '/wp-admin/admin-ajax.php',
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    $('.loadingUserLoader').hide();
                    if (response.status == 'true') {
                        $('#nutirtion_fact_items').modal('show');
                        $('.nutirtion_fact_items').html(response.data);
                    } else {
                        $('#nutirtion_fact_items').modal('show');
                        $('.nutirtion_fact_items').html(response.data);
                    }

                }
            });
        }



    });
    $('.woocommerce-Button').attr('disabled', 'disabled');
    $(document).on('click', '.editPersonel', function () {
        $('#account_first_name').removeAttr('disabled');
        $('#account_last_name').removeAttr('disabled');
        $('#phon').removeAttr('disabled');
        $('.woocommerce-Button').removeAttr('disabled');
        $('#newf').attr('name', '');
        $('#newl').attr('name', '');
    });
    $(document).on('click', '.editChangePassword', function () {
        $('#newf').val($('#account_first_name').val());
        $('#newl').val($('#account_last_name').val());
        $('#newf').attr('name', 'account_first_name');
        $('#newl').attr('name', 'account_last_name');
        $('#passwordChange').show();
        $('.woocommerce-Button').removeAttr('disabled');
    });
    $('#addresses input').attr('disabled', 'disabled');
    $('#addresses select').attr('disabled', 'disabled');
    $('.setAdd input').removeAttr('disabled');
    $('.setAdd select').removeAttr('disabled');
    $(document).on('click', '.editAdd', function () {
        $(this).parent().parent().find('input').removeAttr('disabled');
        $(this).parent().parent().find('select').removeAttr('disabled');
    });
    $(document).on('change', '.selectAddressType .select', function () {
        var typett = $(this).val();
        if (typett == 0) {
            $(this).parent().parent().find('#shipping_house_field').addClass('validate-required');
            $(this).parent().parent().find('#shipping_house_field').show();
            $(this).parent().parent().find('#shipping_office_field').hide();
            $(this).parent().parent().find('#shipping_office_field').removeClass('validate-required');
            $(this).parent().parent().find('#shipping_apartment_number_field').hide();
            $(this).parent().parent().find('#shipping_apartment_number_field').removeClass('validate-required');
            $(this).parent().parent().find('#shipping_floor_field').hide();
            $(this).parent().parent().find('#shipping_floor_field').removeClass('validate-required');
            $(this).parent().parent().find('#shipping_building_field').hide();
            $(this).parent().parent().find('#shipping_building_field').removeClass('validate-required');
        } else if (typett == 1) {
            $(this).parent().parent().find('#shipping_house_field').removeClass('validate-required');
            $(this).parent().parent().find('#shipping_office_field').removeClass('validate-required');
            $(this).parent().parent().find('#shipping_house_field').removeClass('validate-required');
            $(this).parent().parent().find('#shipping_apartment_number_field').addClass('validate-required');
            $(this).parent().parent().find('#shipping_floor_field').addClass('validate-required');
            $(this).parent().parent().find('#shipping_building_field').addClass('validate-required');
            $(this).parent().parent().find('#shipping_house_field').hide();
            $(this).parent().parent().find('#shipping_office_field').hide();
            $(this).parent().parent().find('#shipping_apartment_number_field').show();
            $(this).parent().parent().find('#shipping_floor_field').show();
            $(this).parent().parent().find('#shipping_building_field').show();

        } else if (typett == 2) {
            $(this).parent().parent().find('#shipping_house_field').hide();
            $(this).parent().parent().find('#shipping_office_field').show();
            $(this).parent().parent().find('#shipping_apartment_number_field').hide();
            $(this).parent().parent().find('#shipping_floor_field').show();
            $(this).parent().parent().find('#shipping_building_field').show();
            $(this).parent().parent().find('#shipping_office_field').addClass('validate-required');
            $(this).parent().parent().find('#shipping_floor_field').addClass('validate-required');
            $(this).parent().parent().find('#shipping_building_field').addClass('validate-required');
            $(this).parent().parent().find('#shipping_house_field').removeClass('validate-required');
            $(this).parent().parent().find('#shipping_apartment_number_field').removeClass('validate-required');
        }
    });
    $('#addresses .shipping_address').each(function (index, value) {
        var typett = $(this).find('.select').val();
        if (typett == 0) {
            $(this).find('#shipping_house_field').show();
            $(this).find('#shipping_office_field').hide();
            $(this).find('#shipping_apartment_number_field').hide();
            $(this).find('#shipping_floor_field').hide();
            $(this).find('#shipping_building_field').hide();
        } else if (typett == 1) {
            $(this).find('#shipping_house_field').hide();
            $(this).find('#shipping_office_field').hide();
            $(this).find('#shipping_apartment_number_field').show();
            $(this).find('#shipping_floor_field').show();
            $(this).find('#shipping_building_field').show();
        } else if (typett == 2) {
            $(this).find('#shipping_house_field').hide();
            $(this).find('#shipping_office_field').show();
            $(this).find('#shipping_apartment_number_field').hide();
            $(this).find('#shipping_floor_field').show();
            $(this).find('#shipping_building_field').show();
        }
    });
    var selectData = $('#billing_address_type').val();
     if (selectData == '0') {
         var test=$('#billing_house_field label abbr').hasClass('required');
            if(test!=true){
              $('#billing_house_field label').append('<abbr class="required" title="required">*</abbr>');  
            }
         
     }
    
    $(document).on('change', '#billing_address_type', function () {
        var select = $(this).val();
        $('.loadingUserLoader').show();
        if (select == '0') { //home
            var test=$('#billing_house_field label abbr').hasClass('required');
            if(test!=true){
              $('#billing_house_field label').append('<abbr class="required" title="required">*</abbr>');  
            }
            $('.loadingUserLoader').hide();
            $('#billing_apartment_number_field').hide();
            $('#billing_building_field').removeClass('validate-required');
            $('#billing_building_field').hide();
            $('#billing_office_field').hide();
            $('#billing_office_field').removeClass('validate-required');
            $('#billing_floor_field').hide();
            $('#billing_floor_field').removeClass('validate-required');
            $('#billing_house_field').show();
            $('#billing_house_field').addClass('validate-required');
        } else if (select == '1') { //aprtment
            $('.loadingUserLoader').hide();
            $('#billing_apartment_number_field').show();
            $('#billing_apartment_number_field').addClass('validate-required');
            var test=$('#billing_apartment_number_field label abbr').hasClass('required');
            if(test!=true){
              $('#billing_apartment_number_field label').append('<abbr class="required" title="required">*</abbr>'); 
            }
            
            $('#billing_building_field').show();
            $('#billing_building_field').addClass('validate-required');
            var test=$('#billing_floor_field label abbr').hasClass('required');
            if(test!=true){
              $('#billing_floor_field label').append('<abbr class="required" title="required">*</abbr>');  
            }
            $('#billing_office_field').hide();
            $('#billing_office_field').removeClass('validate-required');
           /* var test= $('#billing_floor_field label').html();
            $('#billing_floor_field label').html(test+'<abbr class="required" title="required">*</abbr>');*/
            $('#billing_floor_field').show();
            $('#billing_floor_field').addClass('validate-required');
            $('#billing_house_field').hide();
            $('#billing_house_field').removeClass('validate-required');
        } else if (select == '2') {
            $('.loadingUserLoader').hide();
            $('#billing_apartment_number_field').hide();
            $('#billing_apartment_number_field').removeClass('validate-required');
            $('#billing_building_field').show();
            $('#billing_office_field').show();
            $('#billing_floor_field').addClass('validate-required');
            $('#billing_office_field').addClass('validate-required');
            $('#billing_building_field').addClass('validate-required');
            var test=$('#billing_floor_field label abbr').hasClass('required');
            if(test!=true){
              $('#billing_floor_field label').append('<abbr class="required" title="required">*</abbr>');  
            }
           /* var test= $('#billing_floor_field label').html();
            $('#billing_floor_field label').html(test+'<abbr class="required" title="required">*</abbr>');*/
            $('#billing_floor_field').show();
            $('#billing_house_field').hide();
        }
    });

    jQuery('.post').addClass("visible").viewportChecker({
        classToAdd: 'visible animated fadeInDown', // Class to add to the elements when they are visible
        offset: 100
    });
    $(document).on('keypress', '.search-field', function (e) {
        var search = $(this).val();
        if (e.which == 13) {
            if (search == '') {
                $(this).attr('style', 'border:1px solid red !important');
                return false;
            }
        }
    });
    $(document).on('click', '.searchFormData', function (event) {
        var search_field = $(this).parent().find('input.search-field').val();
        if (search_field == '') {
            $('input[name="s"]').attr('style', 'border:1px solid red !important');
            return false;
        }
        $('.search-field').css('border', '0');
        var finalSearch = SITE_URL + '/?s=' + search_field;
        window.location.href = finalSearch;
    });


});



jQuery(document).ready(function () {
    jQuery("#custom_carousel").carousel();
    var lang = jQuery('#data_lang').attr('data-lang-val');
    if (lang == 'ar') {
        jQuery('.related-product-slider').slick({
            slidesToShow: 5,
            rtl: true,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: true,
            dots: false,
            prevArrow: '<a class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>',
            nextArrow: '<a class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>',
            responsive: [
                {
                    breakpoint: 1367,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        infinite: true
                    }
    },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
    },
                {
                    breakpoint: 736,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
    },
                {
                    breakpoint: 479,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false
                    }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
        });
    } else {
        jQuery('.related-product-slider').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            arrows: true,
            dots: false,
            prevArrow: '<a class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>',
            nextArrow: '<a class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>',
            responsive: [
                {
                    breakpoint: 1367,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1,
                        infinite: true
                    }
    },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
    },
                {
                    breakpoint: 736,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
    },
                {
                    breakpoint: 479,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false
                    }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
        });
    }




});

function saveData() {
    $('form input').removeAttr('disabled');
    $('form select').removeAttr('disabled');
    $('#actualButon').trigger('click');
}

function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    } else {
        return false;
    }
}
