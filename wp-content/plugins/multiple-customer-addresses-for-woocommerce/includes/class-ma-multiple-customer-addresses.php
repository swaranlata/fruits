<?php
if (!defined('ABSPATH')) {
    exit;
}
class MA_Multi_Cus_Add {
	const VERSION = MA_MULTI_ADD_VERSION;
	protected static $plugin_slug = 'multiple-customer-addresses-for-woo';
	protected static $instance = null;
	private function __construct() {
                add_action( 'init', array($this,'manage_address_endpoints') );
                add_filter( 'query_vars', array($this,'manage_address_query_vars'), 0 );
                add_filter( 'woocommerce_account_menu_items', array($this,'add_manage_address_link_my_account') );
                add_action( 'woocommerce_account_ma-manage-address_endpoint', array($this,'multiple_shipping_addresses') );
                add_filter( 'the_title', array($this,'manage_address_endpoint_title') );
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'woocommerce_before_my_account', array( $this, 'rewrite_edit_url_on_my_account' ), 25 );
		add_shortcode( 'woo_multiple_customer_address', array( $this, 'multiple_shipping_addresses' ) );
		add_action( 'template_redirect', array( $this, 'save_multiple_shipping_addresses' ) );
		add_action( 'woocommerce_before_checkout_form', array( $this, 'before_checkout_form' ) );
		add_action( 'woocommerce_created_customer', array( $this, 'created_customer_save_shipping_as_default' ) );
		add_filter( 'woocommerce_checkout_fields', array( $this, 'add_dd_to_checkout_fields' ) );
		add_action( 'wp_ajax_alt_change', array( $this, 'ajax_checkout_change_shipping_address' ) );
		add_action( 'wp_ajax_nopriv_alt_change', array( $this, 'ajax_checkout_change_shipping_address' ) );
		add_filter( 'woocommerce_checkout_get_value', array( $this, 'wma_checkout_get_value' ), 10, 2 );
	}
        public function manage_address_endpoints()
        {
            add_rewrite_endpoint( 'ma-manage-address', EP_ROOT | EP_PAGES );
        }

        public function manage_address_query_vars($vars)
        {
            $vars[] = 'ma-manage-address';
            return $vars;
        }
        public function add_manage_address_link_my_account($items)
        {
            $new_items = array();
            $new_items['ma-manage-address'] = __('Manage Addresses','ma-multiple-address');
            return self::my_custom_insert_after_helper( $items, $new_items, 'edit-address' );
        }
        public function my_custom_insert_after_helper($items, $new_items, $after)
        {
            $position = array_search( $after, array_keys( $items ) ) + 1;
            $array = array_slice( $items, 0, $position, true );
            $array += $new_items;
            $array += array_slice( $items, $position, count( $items ) - $position, true );

            return $array;
        }
        public function manage_address_endpoint_title($title)
        {
            $crntLanguage=qtranxf_getLanguage();
            global $wp_query;
            $is_endpoint = isset( $wp_query->query_vars['ma-manage-address'] );

            if ( $is_endpoint && ! is_admin() && is_main_query() && in_the_loop() && is_account_page() ) {
                    // New page title.
                    $title = __( 'Manage Addresses', 'ma-multiple-address' );
                    remove_filter( 'the_title', array($this,'manage_address_endpoint_title') );
            }

            return $title;
        }
        public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}
	private static function single_activate() {
		global $woocommerce;
        $crntLanguage=qtranxf_getLanguage();

		$page_id = woocommerce_get_page_id( 'multiple_shipping_addresses' );

		if ( $page_id == - 1 ) {
			// get the checkout page
			$account_id = woocommerce_get_page_id( 'myaccount' );

			// add page and assign
			$page = array(
				'menu_order'     => 0,
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
				'post_author'    => 1,
				'post_content'   => '[woo_multiple_customer_address]',
				'post_name'      => 'multiple-shipping-addresses',
				'post_parent'    => $account_id,
				'post_title'     => __( 'Manage Your Addresses', self::$plugin_slug ),
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'post_category'  => array( 1 )
			);

			$page_id = wp_insert_post( $page );

			update_option( 'woo_multiple_customer_address_page_id', $page_id );
		}
	}
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	public function enqueue_styles() {
		wp_enqueue_style( self::$plugin_slug . '-plugin-styles', MA_MULTI_ADD_MAIN_URL.'assets/css/public.css', array());
	}
	public function enqueue_scripts() {
		wp_enqueue_script( 'wc-country-select', WP_CONTENT_URL . '/plugins/woocommerce/assets/js/frontend/country-select.min.js', array( 'jquery' ));
		wp_enqueue_script( self::$plugin_slug . '-plugin-script', MA_MULTI_ADD_MAIN_URL.'assets/js/public.js', array( 'jquery' ));
		wp_localize_script( self::$plugin_slug . '-plugin-script', 'MAMCA_Ajax', array(
				'ajaxurl'               => admin_url( 'admin-ajax.php' ),
				'id'                    => 0,
				'wc_multiple_addresses' => wp_create_nonce( 'wc-multiple-addresses-ajax-nonce' )
			)
		);
	}
	public function rewrite_edit_url_on_my_account() {
		$page_id  = wc_get_page_id( 'multiple_shipping_addresses' );
		$page_url = get_permalink( $page_id );
		?>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				$('.woocommerce-account .col-2.address .title a').attr('href', '<?php echo $page_url; ?>');
			});
		</script>
	<?php
	}
	public function wma_checkout_get_value($null, $input) {
		global $wma_current_address;

		if ( ! empty( $wma_current_address ) ) {
			foreach ($wma_current_address as $key => $value) {
				if ( $input == $key ) {
					return $value;
				}
			}
		}
	}
	public function multiple_shipping_addresses() {
		global $woocommerce;
        $crntLanguage=qtranxf_getLanguage();
		$GLOBALS['wma_current_address'] = '';

		if ( version_compare( WOOCOMMERCE_VERSION, '2.1', '<' ) ) {
			require_once $woocommerce->plugin_path() .'/classes/class-wc-checkout.php';
		} else {
			require_once $woocommerce->plugin_path() . '/includes/class-wc-checkout.php';
		}

		$user     = wp_get_current_user();
		$checkout = WC()->checkout();
		$shipFields = $checkout->checkout_fields['shipping'];
        $shipFields['shipping_first_name']['required']=0;
        $shipFields['shipping_last_name']['required']=0;
        $shipFields['shipping_address_type']['label']=getTextByLang('Address Type',$crntLanguage);
        $shipFields['shipping_address_type']['placeholder']=getTextByLang('Address Type',$crntLanguage);
        $shipFields['shipping_address_type']['type']='select';
        $shipFields['shipping_address_type']['class']=array('selectAddressType');
        $shipFields['shipping_address_type']['required']=1;
        $shipFields['shipping_company']['required']=1;
        $shipFields['shipping_building']['priority']=20;
        $shipFields['shipping_address_type']['options']=array(''=>getTextByLang('Select',$crntLanguage),'0'=>getTextByLang('Home',$crntLanguage),'1'=>getTextByLang('Apartment',$crntLanguage),'2'=>getTextByLang('Office',$crntLanguage));
        $shipFields['shipping_company']['label']=getTextByLang('Area',$crntLanguage);
        $shipFields['shipping_company']['placeholder']=getTextByLang('Area',$crntLanguage);
        $shipFields['shipping_first_name']['placeholder']=getTextByLang('First Name',$crntLanguage);
        $shipFields['shipping_last_name']['placeholder']=getTextByLang('Last Name',$crntLanguage);
        $shipFields['shipping_address_1']['label']=getTextByLang('Block',$crntLanguage);
        $shipFields['shipping_city']['label']=getTextByLang('Street',$crntLanguage);
        $shipFields['shipping_city']['placeholder']=getTextByLang('Street',$crntLanguage);
        $shipFields['shipping_state']['label']=getTextByLang('Avenue',$crntLanguage);
        $shipFields['shipping_state']['placeholder']=getTextByLang('Avenue',$crntLanguage);
        $shipFields['shipping_state']['type']='text';
        $shipFields['shipping_house']['label']=getTextByLang('House',$crntLanguage);
        $shipFields['shipping_house']['placeholder']=getTextByLang('House',$crntLanguage);
        $shipFields['shipping_house']['required']='0';
        $shipFields['shipping_house']['class']=array('form-row-wide','house');
        $shipFields['shipping_apartment_number']['label']=getTextByLang('Apartment Number',$crntLanguage);
        $shipFields['shipping_apartment_number']['placeholder']=getTextByLang('Apartment Number',$crntLanguage);
        $shipFields['shipping_apartment_number']['required']='0';
        $shipFields['shipping_apartment_number']['class']=array('form-row-wide');
        $shipFields['shipping_floor']['label']=getTextByLang('Floor',$crntLanguage);
        $shipFields['shipping_floor']['placeholder']=getTextByLang('Floor',$crntLanguage);
        $shipFields['shipping_floor']['required']='0';
        $shipFields['shipping_floor']['class']=array('form-row-wide');
        $shipFields['shipping_office']['label']=getTextByLang('Office',$crntLanguage);
        $shipFields['shipping_office']['placeholder']=getTextByLang('Office',$crntLanguage);
        $shipFields['shipping_office']['required']='0';
        $shipFields['shipping_office']['class']=array('form-row-wide');
        $shipFields['shipping_phone']['label']=getTextByLang('Phone Number',$crntLanguage);
        $shipFields['shipping_phone']['required']='1';
        $shipFields['shipping_phone']['maxLength']='15';
        $shipFields['shipping_postcode']['maxLength']='7';
        $shipFields['shipping_postcode']['class']=array(' form-row-wide','numberOnly');
        $shipFields['shipping_phone']['placeholder']=getTextByLang('Phone Number',$crntLanguage);
        $shipFields['shipping_phone']['priority']=100;
        $shipFields['shipping_phone']['class']=array(' form-row-wide','numberOnly');  
        $shipFields['shipping_building']['label']=getTextByLang('Building',$crntLanguage);
        $shipFields['shipping_building']['placeholder']=getTextByLang('Building',$crntLanguage);
        $shipFields['shipping_building']['required']='0';
        $shipFields['shipping_building']['class']=array(' form-row-wide');   
        $shipFields['shipping_building']['required']='0';
        $shipFields['shipping_building']['class']=array('form-row-wide');
        $shipFields['shipping_avenue']['label']=getTextByLang('Avenue',$crntLanguage);
        $shipFields['shipping_address_1']['placeholder']='Block';
        $shipFields['shipping_avenue']['required']='1';
        $shipFields['shipping_postcode']['required']='1';
        $shipFields['shipping_postcode']['class']=array('numberOnly');
        $shipFields['shipping_postcode']['placeholder']=getTextByLang('Postcode',$crntLanguage);
        $shipFields['shipping_avenue']['placeholder']=getTextByLang('Avenue',$crntLanguage);
        $shipFields['shipping_avenue']['priority']=55;
        $shipFields['shipping_avenue']['class']=array(' form-row-wide');
        $shipFields['shipping_additional_directions']['label']=getTextByLang('Additional Directions',$crntLanguage);
        $shipFields['shipping_additional_directions']['required']='0';
        $shipFields['shipping_additional_directions']['type']='textarea';
        $shipFields['shipping_additional_directions']['priority']='1';
        $shipFields['shipping_additional_directions']['class']=array(' form-row-wide');
        unset($shipFields['shipping_address_2']);
        unset($shipFields['shipping_state']); 
		if ( $user->ID == 0 ) {
			return;
		}
		$otherAddr = get_user_meta( $user->ID, 'wc_multiple_shipping_addresses', true );
		echo '<div class="woocommerce">';
		echo '<form action="" method="post" id="address_form">';
        echo '<div class="form-row">
                <input type="hidden" name="shipping_account_address_action" value="save" />
                <input type="submit" name="set_addresses" value="' .getTextByLang('Save Addresses',$crntLanguage). '" class="button alt" />
                <a class="add_address button button-info" href="#">' .getTextByLang('Add another',$crntLanguage) . '</a>
            </div>';
		if ( ! empty( $otherAddr ) ) {
			echo '<div id="addresses">';

			global $wma_current_address;
            $counterId=0;
			foreach ( $otherAddr as $idx => $address ) {
				$wma_current_address = $address;
                $deleteClass='<a href="#" class="delete button" style="float: right;">'.getTextByLang('Delete',$crntLanguage) .'</a>';
				echo '<div class="shipping_address address_block" id="shipping_address_' . $idx . '">';
				echo '<div  style="margin-bottom:20px;"><h3 style="display: inline;">'.$address['label'].'</h3><a href="javascript:void(0);" style="float: right;"  class="editAdd button">'.getTextByLang('Edit',$crntLanguage) .'</a>'.$deleteClass.'</div>';
				do_action( 'woocommerce_before_checkout_shipping_form', $checkout );
                $label['id'] = 'label';
                $label['label'] = __( 'Label', self::$plugin_slug );
                woocommerce_form_field( 'label[]', $label, $address['label'] );
                
				foreach ($shipFields as $key => $field ) {
                    if($wma_current_address['shipping_address_type']=='2'){
                            if($key=='shipping_house' || $key=='shipping_apartment_number'){
                               // continue;
                            }                                            
                        }elseif($wma_current_address['shipping_address_type']=='1'){
                            if($key=='shipping_house' || $key=='shipping_office'){
                             //   continue;
                            }                                          
                        }else{
                         if($key=='shipping_apartment_number' || $key=='shipping_office' || $key=='shipping_floor' || $key=='shipping_building' ){
                                //continue;
                            }                         
                        } 
                   if ( 'shipping_alt' == $key || 'shipping_first_name' == $key || 'shipping_last_name' == $key || 'shipping_country'==$key) {
						continue; 
					}
					$val = '';
					if ( isset( $address[ $key ] ) ) {
						$val = $address[ $key ];
					}
					$field['id'] = $key;
					$key .= '[]';
					woocommerce_form_field( $key, $field, $val );
				}
				if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) {
					$is_checked = $address['shipping_address_is_default'] == 'true' ? "checked" : "";
					echo '<input type="checkbox" class="default_shipping_address" ' . $is_checked . ' value="' . $address['shipping_address_is_default'] . '"> ' . __( 'Mark this shipping address as default', self::$plugin_slug );
					echo '<input type="hidden" class="hidden_default_shipping_address" name="shipping_address_is_default[]" value="' . $address['shipping_address_is_default'] . '" />';
				}
				do_action( 'woocommerce_after_checkout_shipping_form', $checkout );
				echo '</div>';
                
			$counterId++;
            }
			echo '</div>';
		} else {

			echo '<div id="addresses" class="setAdd"><p class="form-row " id="label_field" data-priority=""><label for="label" class="">'.getTextByLang('Address Title',$crntLanguage).'</label><input type="text" class="input-text " name="label[]" id="label" placeholder="'.getTextByLang('Address Title',$crntLanguage).'" value="" required></p>';
            foreach ( $shipFields as $key => $field ) :
				$field['id'] = $key;
				$key .= '[]';
				//woocommerce_form_field( $key, $field, $checkout->get_value( $field['id'] ) );
				woocommerce_form_field( $key, $field,'' );
			endforeach;

			if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) {
				echo '<input type="checkbox" class="default_shipping_address" checked value="true"> ' . __( 'Mark this shipping address as default', self::$plugin_slug );
				echo '<input type="hidden" class="hidden_default_shipping_address" name="shipping_address_is_default[]" value="true" />';
			}

			echo '</div>';
		}
		echo '<div class="form-row">
                <input type="hidden" name="shipping_account_address_action" value="'.getTextByLang('Save',$crntLanguage).'" />
                <input type="button" name="" value="'.getTextByLang('Save Addresses',$crntLanguage).'" class="button alt" onclick="saveData()">
                <input type="submit" id="actualButon"  name="set_addresses" value="'.getTextByLang('Save Addresses',$crntLanguage).'" class="button alt"  style="display:none;"/>
                <a class="add_address button button-info" href="#">'.getTextByLang('Add another',$crntLanguage).'</a>
            </div>';
		echo '</form>';
		echo '</div>';   
		?>
		<script type="text/javascript">
			var tmpl = '<div class="shipping_address address_block"><div style="margin-bottom:20px;"><h3 style="display: inline;"><?php echo getTextByLang('Add new Address',$crntLanguage); ?></h3><a href="#" class="delete button" style="float: right;"><?php echo getTextByLang('Delete',$crntLanguage); ?></a></div>';

                tmpl += '<?php $label['id'] = 'label';
                $label['label'] = getTextByLang('Address Label',$crntLanguage);
                $row = woocommerce_form_field( 'label[]', $label, '' );
                echo str_replace("\n", "\\\n", str_replace("'", "\'", $row));
                ?>';

			tmpl += '<?php foreach ($shipFields as $key => $field) :
				if ( 'shipping_alt' == $key ) {
					continue;
				}
				$field['return'] = true;
				$val = '';
				$field['id'] = $key;
				$key .= '[]';
				$row = woocommerce_form_field( $key, $field, $val );
				echo str_replace("\n", "\\\n", str_replace("'", "\'", $row));
			endforeach; ?>';

			<?php if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>
				tmpl += '<input type="checkbox" class="default_shipping_address" value="false"> <?php _e( "Mark this shipping address as default", self::$plugin_slug ); ?>';
				tmpl += '<input type="hidden" class="hidden_default_shipping_address" name="shipping_address_is_default[]" value="false" />';
			<?php endif; ?>

			tmpl += '</div>';
            var len=jQuery('#addresses').children().length;
            if(len=='1'){
              jQuery('.editAdd').next().hide();  
            }
			jQuery(".add_address").click(function (e) {
				e.preventDefault();

				jQuery("#addresses").append(tmpl);
                
				jQuery('html,body').animate({
						scrollTop: jQuery('#addresses .shipping_address:last').offset().top},
					'slow');
                jQuery('#shipping_phone').attr('maxLength','15');
                jQuery('#shipping_postcode').attr('maxLength','7');
                jQuery('.country_to_state').parent().hide();
			});

			jQuery(".delete").live("click", function (e) {
				e.preventDefault();
                jQuery(this).parents("div.address_block").remove();                
                toastr.info("Please don't forgot to click on the Save Addresses button to save the latest update.");
                var len=jQuery('#addresses').children().length;
                if(len=='1'){
                  jQuery('.editAdd').next().hide();  
                }				
			});

			jQuery(document).ready(function () {
                jQuery('#shipping_phone').attr('maxLength','15');
                jQuery('#shipping_postcode').attr('maxLength','7');
				jQuery(document).on("click", ".default_shipping_address", function () {
					if (this.checked) {
						jQuery("input.default_shipping_address").not(this).removeAttr("checked");
						jQuery("input.default_shipping_address").not(this).val("false");
						jQuery("input.hidden_default_shipping_address").val("false");
						jQuery(this).next().val('true');
						jQuery(this).val('true');
					}
					else {
						jQuery("input.default_shipping_address").val("false");
						jQuery("input.hidden_default_shipping_address").val("false");
					}
				});

				jQuery("#address_form").submit(function () {
					var valid = true;
					jQuery("input[type=text],select").each(function () {
						if (jQuery(this).prev("label").children("abbr").length == 1 && jQuery(this).val() == "") {
							jQuery(this).focus();
							valid = false;
							return false;
						}
					});
					return valid;
				});
			});
		</script>
	<?php
	}
	public function save_multiple_shipping_addresses() {
          $crntLanguage=qtranxf_getLanguage();
		if (isset($_POST['shipping_account_address_action'] ) && $_POST['shipping_account_address_action'] == 'save' ) {
			unset( $_POST['shipping_account_address_action'] );
            $addresses  = array();
			$is_default = false;
			foreach ( $_POST as $key => $values ) {
				if ( $key == 'shipping_address_is_default' ) {
					foreach ( $values as $idx => $val ) {
						if ( $val == 'true' ) {
							$is_default = $idx;
						}
					}
				}
				if ( ! is_array( $values ) ) {
					continue;
				}

				foreach ( $values as $idx => $val ) {
					$addresses[ $idx ][ $key ] = $val;
				}
			}

			$user = wp_get_current_user();

			if ( $is_default !== false ) {
				$default_address = $addresses[ $is_default ];
				foreach ( $default_address as $key => $field ) :
					if ( $key == 'shipping_address_is_default' ) {
						continue;
					}
					update_user_meta( $user->ID, $key, $field );
				endforeach;
			}
			update_user_meta( $user->ID, 'wc_multiple_shipping_addresses', $addresses );

			if ( version_compare( WOOCOMMERCE_VERSION, '2.1', '<' ) ) {
				global $woocommerce;
				$woocommerce->add_message(getTextByLang('Addresses have been saved',$crntLanguage));
			} else {
				wc_add_notice(getTextByLang('Addresses have been saved',$crntLanguage), $notice_type = 'success' );
			}

			$page_id = woocommerce_get_page_id( 'myaccount' );
			wp_redirect( get_permalink( $page_id ) );
			exit;
		}
	}
	public function before_checkout_form() {
		global $woocommerce;
        $crntLanguage=qtranxf_getLanguage();
		$page_id = woocommerce_get_page_id( 'multiple_shipping_addresses' );
		if ( is_user_logged_in() ) {
			echo '<p class="woocommerce-info woocommerce_message">
	                ' . __( 'If you have more than one shipping address, then you may choose a default one here.', self::$plugin_slug ) . '
	                <a class="button" href="' . get_permalink( $page_id ) . '">' . __( 'Configure Address', self::$plugin_slug ) . '</a>
	              </p>';
		}
	}

	public function array_unshift_assoc( &$arr, $key, $val ) {
		$arr         = array_reverse( $arr, true );
		$arr[ $key ] = $val;

		return array_reverse( $arr, true );
	}

	public function created_customer_save_shipping_as_default( $current_user_id ) {
		global $woocommerce;
        $crntLanguage=qtranxf_getLanguage();
		if ( $current_user_id == 0 ) {
			return;
		}

		$checkout        = $woocommerce->checkout->posted;
		$default_address = array();
		if ( $checkout['shiptobilling'] == 0 ) {
			$default_address[0]['shipping_country']    = $checkout['shipping_country'];
			$default_address[0]['shipping_first_name'] = $checkout['shipping_first_name'];
			$default_address[0]['shipping_last_name']  = $checkout['shipping_last_name'];
			$default_address[0]['shipping_company']    = $checkout['shipping_company'];
			$default_address[0]['shipping_address_1']  = $checkout['shipping_address_1'];
			$default_address[0]['shipping_address_2']  = $checkout['shipping_address_2'];
			$default_address[0]['shipping_city']       = $checkout['shipping_city'];
			$default_address[0]['shipping_state']      = $checkout['shipping_state'];
			$default_address[0]['shipping_postcode']   = $checkout['shipping_postcode'];
		} elseif ( $checkout['shiptobilling'] == 1 ) {
			$default_address[0]['shipping_country']    = $checkout['billing_country'];
			$default_address[0]['shipping_first_name'] = $checkout['billing_first_name'];
			$default_address[0]['shipping_last_name']  = $checkout['billing_last_name'];
			$default_address[0]['shipping_company']    = $checkout['billing_company'];
			$default_address[0]['shipping_address_1']  = $checkout['billing_address_1'];
			$default_address[0]['shipping_address_2']  = $checkout['billing_address_2'];
			$default_address[0]['shipping_city']       = $checkout['billing_city'];
			$default_address[0]['shipping_state']      = $checkout['billing_state'];
			$default_address[0]['shipping_postcode']   = $checkout['billing_postcode'];
		}
		$default_address[0]['shipping_address_is_default'] = 'true';
		update_user_meta( $current_user_id, 'wc_multiple_shipping_addresses', $default_address );
	}

	public function add_dd_to_checkout_fields( $fields ) {
		global $current_user;
        $crntLanguage=qtranxf_getLanguage();

		$otherAddrs = get_user_meta( $current_user->ID, 'wc_multiple_shipping_addresses', true );
		if ( ! $otherAddrs ) {
			return $fields;
		}

		$addresses    = array();
		$addresses[0] =getTextByLang('Choose an address...',$crntLanguage);
		for ( $i = 1; $i <= count( $otherAddrs ); ++$i ) {
                    if (!empty($otherAddrs[$i - 1]['label'])) {
                        $addresses[ $i ] = $otherAddrs[$i - 1]['label'];
                    } else {
                        $addresses[ $i ] = $otherAddrs[ $i - 1 ]['shipping_first_name'] . ' ' . $otherAddrs[ $i - 1 ]['shipping_last_name'] . ', ' . $otherAddrs[ $i - 1 ]['shipping_postcode'] . ' ' . $otherAddrs[ $i - 1 ]['shipping_city'];
                    }
		}

		$alt_field = array(
			'label'    =>getTextByLang('Your addresses',$crntLanguage),
			'required' => false,
			'class'    => array( 'form-row' ),
			'clear'    => true,
			'type'     => 'select',
			'options'  => $addresses
		);

		$fields['shipping'] = $this->array_unshift_assoc( $fields['shipping'], 'shipping_alt', $alt_field );
		$fields['billing'] = $this->array_unshift_assoc( $fields['billing'], 'billing_alt', $alt_field );

		return $fields;
	}

	public function ajax_checkout_change_shipping_address() {

		// check nonce
		$nonce = $_POST['wc_multiple_addresses'];
		if ( ! wp_verify_nonce( $nonce, 'wc-multiple-addresses-ajax-nonce' ) ) {
			die ( 'Busted!' );
		}

		$address_id = $_POST['id'] - 1;
		if ( $address_id < 0 ) {
			return;
		}

		// get address
		global $current_user;
		$otherAddr = get_user_meta( $current_user->ID, 'wc_multiple_shipping_addresses', true );

		global $woocommerce;
		$addr                          = $otherAddr[ $address_id ];
		$addr['shipping_country_text'] = $woocommerce->countries->countries[ $addr['shipping_country'] ];
		$response                      = json_encode( $addr );

		// response output
		header( "Content-Type: application/json" );
		echo $response;

		exit;
	}
}