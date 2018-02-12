(function ($) {
    $(document).ready(function () {
        var shipping_alt = $("#shipping_alt");
        var billing_alt = $("#billing_alt");

        shipping_alt.val("0");
        billing_alt.val("0");

        shipping_alt.on("change", function () {
            $.post(
                    MAMCA_Ajax.ajaxurl, {
                        action: 'alt_change',
                        id: $(this).val(),
                        wc_multiple_addresses: MAMCA_Ajax.wc_multiple_addresses
                    }, function (response) {
                $("#shipping_address_type_field select").val(response.shipping_address_type);
                $('#shipping_address_1').val(response.shipping_address_1);
                $('#shipping_address_2').val(response.shipping_address_2);
                $('#shipping_city').val(response.shipping_city);
                $('#shipping_company').val(response.shipping_company);
                $('#shipping_country').val(response.shipping_country).change();
                $("#shipping_country_chosen").find('span').html(response.shipping_country_text);
                $("#shipping_country").val('KW');
                $('#shipping_first_name').val(response.shipping_first_name);
                $('#shipping_last_name').val(response.shipping_last_name);
                $('#shipping_postcode').val(response.shipping_postcode);
                $('#shipping_state').val(response.shipping_state);
                $('#shipping_phone').val(response.shipping_phone);
                $('#shipping_house').val(response.shipping_house);
                $('#shipping_apartment_number').val(response.shipping_apartment_number);
                $('#shipping_floor').val(response.shipping_floor);
                $('#shipping_office').val(response.shipping_office);
                $('#shipping_building').val(response.shipping_building);
                $('#shipping_avenue').val(response.shipping_avenue);
                $('#shipping_additional_directions').val(response.shipping_additional_directions);
                 if(response.shipping_address_type=='0'){
                           $('#shipping_apartment_number_field').hide(); 
                           $('#shipping_house_field').show(); 
                           $('#shipping_floor_field').hide(); 
                           $('#shipping_office_field').hide(); 
                           $('#shipping_building_field').hide(); 
                        }else if(response.shipping_address_type=='1'){
                            $('#shipping_apartment_number_field').show(); 
                            $('#shippingfloor_field').show(); 
                            $('#shipping_office_field').hide(); 
                            $('#shipping_building_field').show();
                            $('#shipping_house_field').hide(); 
                        }else if(response.shipping_address_type=='2'){
                            $$('#shipping_apartment_number_field').hide(); 
                            $('#shipping_floor_field').show(); 
                            $('#shipping_office_field').show(); 
                            $('#shipping_building_field').show();
                            $('#shipping_house_field').hide();                             
                        }       
                var stateName = $('#shipping_state option[value="' + response.shipping_state + '"]').text();
                $("#s2id_shipping_state").find('.select2-chosen').html(stateName).parent().removeClass('select2-default');
            }
            );
            return false;
        });

        billing_alt.on("change", function () {
            $.post(
                    MAMCA_Ajax.ajaxurl, {
                        action: 'alt_change',
                        id: $(this).val(),
                        wc_multiple_addresses: MAMCA_Ajax.wc_multiple_addresses
                    }, function (response) {
                        $("#billing_address_type_field select").val(response.shipping_address_type);
                        if(response.shipping_address_type=='0'){
                           $('#billing_apartment_number_field').hide(); 
                           $('#billing_house').show(); 
                           $('#billing_floor_field').hide(); 
                           $('#billing_office_field').hide(); 
                           $('#billing_building').hide(); 
                        }else if(response.shipping_address_type=='1'){
                            $('#billing_apartment_number').show(); 
                            $('#billing_floor_field').show(); 
                            $('#billing_office_field').hide(); 
                            $('#billing_building').show();
                            $('#billing_house').hide(); 
                        }else if(response.shipping_address_type=='2'){
                            $$('#billing_apartment_number').hide(); 
                            $('#billing_floor_field').show(); 
                            $('#billing_office_field').show(); 
                            $('#billing_building').show();
                            $('#billing_house').hide();                             
                        }
                        
                $('#billing_address_1').val(response.shipping_address_1);
                $('#billing_address_2').val(response.shipping_address_2);
                $('#billing_city').val(response.shipping_city);
                $('#billing_company').val(response.shipping_company);
                $('#billing_country').val('KW');
                $("#billing_country_chosen").find('span').html(response.shipping_country_text);
                $('#billing_first_name').val(response.shipping_first_name);
                $('#billing_last_name').val(response.shipping_last_name);
                $('#billing_postcode').val(response.shipping_postcode);
                $('#billing_state').val(response.shipping_state);
                $('#billing_phone').val(response.shipping_phone);
                $('#billing_house').val(response.shipping_house);
                $('#billing_apartment_number').val(response.shipping_apartment_number);
                $('#billing_floor').val(response.shipping_floor);
                $('#billing_office').val(response.shipping_office);
                $('#billing_building').val(response.shipping_building);
                $('#billing_avenue').val(response.shipping_avenue);
                $('#billing_additional_directions').val(response.shipping_additional_directions);
                var stateName = $('#billing_state option[value="' + response.shipping_state + '"]').text();
                $("#s2id_billing_state").find('.select2-chosen').html(stateName).parent().removeClass('select2-default');
            }
            );
            return false;
        });


        // wc_country_select_params is required to continue, ensure the object exists
        if (typeof wc_country_select_params === 'undefined') {
            return false;
        }

        /* State/Country select boxes */
        var states_json = wc_country_select_params.countries.replace(/&quot;/g, '"'),
                states = $.parseJSON(states_json);

        $(document).on("change", "select.country_to_state, input.country_to_state", function () {
            var country = $(this).val(),
                    $statebox = $(this).closest('div').find('#billing_state, #shipping_state, #calc_shipping_state'),
                    $parent = $statebox.parent(),
                    input_name = $statebox.attr('name'),
                    input_id = $statebox.attr('id'),
                    value = $statebox.val(),
                    placeholder = $statebox.attr('placeholder');

            if (states[ country ]) {
                if (states[ country ].length === 0) {

                    $statebox.parent().hide().find('.chosen-container').remove();
                    $statebox.replaceWith('<input type="hidden" class="hidden" name="' + input_name + '" id="' + input_id + '" value="" placeholder="' + placeholder + '" />');

                    $('body').trigger('country_to_state_changed', [country, $(this).closest('div')]);

                } else {

                    var options = '',
                            state = states[ country ];

                    for (var index in state) {
                        if (state.hasOwnProperty(index)) {
                            options = options + '<option value="' + index + '">' + state[ index ] + '</option>';
                        }
                    }

                    $statebox.parent().show();

                    if ($statebox.is('input')) {
                        // Change for select
                        $statebox.replaceWith('<select name="' + input_name + '" id="' + input_id + '" class="state_select" placeholder="' + placeholder + '"></select>');
                        $statebox = $(this).closest('div').find('#billing_state, #shipping_state, #calc_shipping_state');
                    }

                    $statebox.html('<option value="">' + wc_country_select_params.i18n_select_state_text + '</option>' + options);

                    $statebox.val(value);

                    $('body').trigger('country_to_state_changed', [country, $(this).closest('div')]);

                }
            } else {
                if ($statebox.is('select')) {

                    $parent.show().find('.chosen-container').remove();
                    $statebox.replaceWith('<input type="text" class="input-text" name="' + input_name + '" id="' + input_id + '" placeholder="' + placeholder + '" />');

                    $('body').trigger('country_to_state_changed', [country, $(this).closest('div')]);

                } else if ($statebox.is('.hidden')) {

                    $parent.show().find('.chosen-container').remove();
                    $statebox.replaceWith('<input type="text" class="input-text" name="' + input_name + '" id="' + input_id + '" placeholder="' + placeholder + '" />');

                    $('body').trigger('country_to_state_changed', [country, $(this).closest('div')]);

                }
            }

            $('body').trigger('country_to_state_changing', [country, $(this).closest('div')]);

        }).change();

    });
})(jQuery);