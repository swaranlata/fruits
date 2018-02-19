<?php
/**
 * Twenty Sixteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

/**
 * Twenty Sixteen only works in WordPress 4.4 or later.
 */   
session_cache_limiter ('private, must-revalidate');    
$cache_limiter = session_cache_limiter();
session_cache_expire(60);
//date_default_timezone_set("Asia/Calcutta");
define('FROM_MAIL','swaran.lata@imarkinfotech.com');
define('FROM_NAME','Swaran Lata');
/*define('CUSTOM_ADMIN_URL',site_url().'/'.get_option('whl_page'));*/
define('CUSTOM_ADMIN_URL',admin_url());
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentysixteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * Create your own twentysixteen_setup() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentysixteen
	 * If you're building a theme based on Twenty Sixteen, use a find and replace
	 * to change 'twentysixteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentysixteen' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 *  @since Twenty Sixteen 1.2
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );
    add_image_size('custom-product-image',294, 294,true);

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'twentysixteen' ),
		'social'  => __( 'Social Links Menu', 'twentysixteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', twentysixteen_fonts_url() ) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // twentysixteen_setup
add_action( 'after_setup_theme', 'twentysixteen_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'twentysixteen_content_width', 840 );
}
add_action( 'after_setup_theme', 'twentysixteen_content_width', 0 );

/**
 * Registers a widget area.
 *
 * @link https://developer.wordpress.org/reference/functions/register_sidebar/
 *
 * @since Twenty Sixteen 1.0
 */
/*function wpdocs_theme_name_styles() {
    wp_enqueue_style( 'fa-file', 'https://fonts.googleapis.com/css?family=Arimo:400,700', array(), '1.0.0', false );
    wp_enqueue_style( 'font-file', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '1.0.0', false );
    wp_enqueue_style( 'awesome-file', get_template_directory_uri() . '/css/line-awesome.min.css', array(), '1.0.0', false );
    wp_enqueue_style( 'bootstrap-file', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0.0', false );
    wp_enqueue_style( 'style-file', get_template_directory_uri() . '/css/style.css', array(), '1.0.0', false );
     wp_enqueue_script('min-js',get_template_directory_uri() . '/js/jquery-3.2.1.min.js',array(),array(),true);
     wp_enqueue_script('bootstrap-js',get_template_directory_uri() . '/js/bootstrap.min.js',array(),array(),true);
     wp_enqueue_script('custom-js',get_template_directory_uri() . '/js/custom.js',array(),array(),true);
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_styles' );*/


function my_enqueue($hook) {
    wp_enqueue_script('my_custom_script_data','/wp-content/themes/fruits/adminfiles/dev.js',array(),array(),true);    
    wp_enqueue_script('my_custom_ui','https://code.jquery.com/ui/1.12.1/jquery-ui.js',array(),array(),true);    
    wp_enqueue_style( 'admin_css','/wp-content/themes/fruits/adminfiles/admin-style.css', false, '1.0.0' );
    wp_enqueue_style( 'fa-icon_css','/wp-content/themes/fruits/adminfiles/font-awesome.min.css', false, '1.0.0' );
}
 
add_action('admin_enqueue_scripts', 'my_enqueue');


function twentysixteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentysixteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 1', 'twentysixteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Bottom 2', 'twentysixteen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Appears at the bottom of the content on posts and pages.', 'twentysixteen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentysixteen_widgets_init' );

if ( ! function_exists( 'twentysixteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Sixteen.
 *
 * Create your own twentysixteen_fonts_url() function to override in a child theme.
 *
 * @since Twenty Sixteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentysixteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
	}

	/* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Montserrat:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentysixteen' ) ) {
		$fonts[] = 'Inconsolata:400';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;  

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentysixteen_javascript_detection', 0 );

/**
 * Enqueues scripts and styles.
 *
 * @since Twenty Sixteen 1.0
 */
function twentysixteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentysixteen-fonts', twentysixteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Theme stylesheet.
	wp_enqueue_style( 'twentysixteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie', 'conditional', 'lt IE 10' );

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentysixteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentysixteen-style' ), '20160816' );
	wp_style_add_data( 'twentysixteen-ie7', 'conditional', 'lt IE 8' );

	// Load the html5 shiv.
	wp_enqueue_script( 'twentysixteen-html5', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3' );
	wp_script_add_data( 'twentysixteen-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentysixteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20160816', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentysixteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20160816' );
	}

	wp_enqueue_script( 'twentysixteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160816', true );

	wp_localize_script( 'twentysixteen-script', 'screenReaderText', array(
		'expand'   => __( 'expand child menu', 'twentysixteen' ),
		'collapse' => __( 'collapse child menu', 'twentysixteen' ),
	) ); 
    
    wp_enqueue_style( 'fa-file', 'https://fonts.googleapis.com/css?family=Arimo:400,700', array(), '1.0.0','all');
    wp_enqueue_style( 'font-file', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '1.0.0','all');
    wp_enqueue_style( 'awesome-file', get_template_directory_uri() . '/css/line-awesome.min.css', array(), '1.0.0','all');
    wp_enqueue_style( 'animate-css', get_template_directory_uri() . '/css/animate.css', array(), '1.0.0', 'all');
    wp_enqueue_style( 'slick-file', get_template_directory_uri() . '/css/slick.css', array(), '1.0.0', 'all');
    wp_enqueue_style( 'slimmenu-file', get_template_directory_uri() . '/css/slimmenu.min.css', array(), '1.0.0', 'all');
    wp_enqueue_style( 'toastr-file', get_template_directory_uri() . '/css/toastr.min.css', array(), '1.0.0', 'all');
    wp_enqueue_style( 'bootstrap-file', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0.0', 'all');
    wp_enqueue_style( 'jq-file', get_template_directory_uri() . '/admin-templates/css/jquery-ui.css', array(), '1.0.0', 'all');
    wp_enqueue_style( 'style-file', get_template_directory_uri() . '/css/style.css', array(), '1.0.0', 'all');
    
     wp_enqueue_script('min-js',get_template_directory_uri() . '/js/jquery-3.2.1.min.js',array(),array(),true);
     wp_enqueue_script('validate-js','/wp-content/themes/fruits/js/jquery.validate.js',array(),array(),true); 
     wp_enqueue_script('wow-js','/wp-content/themes/fruits/js/wow.min.js',array(),array(),true);
     wp_enqueue_script('viewportchecker-js','/wp-content/themes/fruits/js/viewportchecker.js',array(),array(),true);
     wp_enqueue_script('slick-js',get_template_directory_uri() . '/js/slick.js',array(),array(),true);
     wp_enqueue_script('slimmenu-js',get_template_directory_uri() . '/js/jquery.slimmenu.min.js',array(),array(),true);
     wp_enqueue_script('tosatr-js',get_template_directory_uri() . '/js/toastr.min.js',array(),array(),true);
     wp_enqueue_script('bootstrap-js',get_template_directory_uri() . '/js/bootstrap.min.js',array(),array(),true);
     wp_enqueue_script('custom-js',get_template_directory_uri() . '/js/custom.js',array(),array(),true);
     wp_enqueue_script('jq-js',get_template_directory_uri() . '/admin-templates/js/jquery-ui.js',array(),array(),true);
}
add_action( 'wp_enqueue_scripts', 'twentysixteen_scripts' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array (Maybe) filtered body classes.
 */
function twentysixteen_body_classes( $classes ) {
	// Adds a class of custom-background-image to sites with a custom background image.
	if ( get_background_image() ) {
		$classes[] = 'custom-background-image';
	}

	// Adds a class of group-blog to sites with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of no-sidebar to sites without active sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'twentysixteen_body_classes' );

/**
 * Converts a HEX value to RGB.
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function twentysixteen_hex2rgb( $color ) {
	$color = trim( $color, '#' );

	if ( strlen( $color ) === 3 ) {
		$r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
		$g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
		$b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
	} else if ( strlen( $color ) === 6 ) {
		$r = hexdec( substr( $color, 0, 2 ) );
		$g = hexdec( substr( $color, 2, 2 ) );
		$b = hexdec( substr( $color, 4, 2 ) );
	} else {
		return array();
	}

	return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 * @since Twenty Sixteen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentysixteen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	840 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 62vw, 840px';

	if ( 'page' === get_post_type() ) {
		840 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	} else {
		840 > $width && 600 <= $width && $sizes = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 61vw, (max-width: 1362px) 45vw, 600px';
		600 > $width && $sizes = '(max-width: ' . $width . 'px) 85vw, ' . $width . 'px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentysixteen_content_image_sizes_attr', 10 , 2 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails
 *
 * @since Twenty Sixteen 1.0
 *
 * @param array $attr Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function twentysixteen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( 'post-thumbnail' === $size ) {
		is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 984px) 60vw, (max-width: 1362px) 62vw, 840px';
		! is_active_sidebar( 'sidebar-1' ) && $attr['sizes'] = '(max-width: 709px) 85vw, (max-width: 909px) 67vw, (max-width: 1362px) 88vw, 1200px';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentysixteen_post_thumbnail_sizes_attr', 10 , 3 );

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Twenty Sixteen 1.1
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
    function twentysixteen_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
    add_filter( 'widget_tag_cloud_args', 'twentysixteen_widget_tag_cloud_args' );

    function pr($array = null) {
        echo "<pre>";
        print_r($array);
        echo "</pre>";
        die;
    }

    function response($success = null, $result = null, $error = null) {
    echo json_encode(array(
    'success' => $success,
    'result' => $result,
    'error' => $error),JSON_UNESCAPED_UNICODE);
    die;
    }




    function convert_array($array = null) {
    $finalArray = json_decode(json_encode($array), true);
    return $finalArray;
    }

    function AuthUser($id = null, $error_type = null) {
        global $wpdb;
        $query='SELECT * FROM `im_users` WHERE `ID`="'.$id.'"';
        $results = $wpdb->get_row($query);
        $array = convert_array($results);
        if(empty($array)){
            if ($error_type == 'string') {
                response(0, null, 'You are not authorise to access this content.');
            } else {
                response(0, $error_type, 'You are not authorise to access this content.');
            }
        }else{
            return $array;
        }    
    }

    function checkPhoneValid($phone=null){
        if(!empty($phone)){
          if(!is_numeric($phone)){
            response(0, null, 'Please enter valid Phone number.');    
          }  
        }        
    }

    /* Get User Profile */
    function getUserProfile($user_id=null){
        
    }

    function getTextByLang($text=null,$lang=null){
        $languages=get_field('language', 'option');
        if($lang=='ar'){
           $langSelected='arabic'; 
        }else{
           $langSelected='english';
        }        
        if(!empty($languages)){
           foreach($languages as $k=>$v){
               if($v['english_text']==$text){
                   $langText=$v[$langSelected];
                   break;
               }
           } 
           return $langText;
        }
        return $text;
    }

    /* Valid Email Format Check*/
    function CheckValidEmail($email=null){
        $status=1;
        if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email))
        { 
         $status=0; 
        }  
        return $status;
    }

    /* Get User Details */
    function getUserDetails($id=null){
        $user=get_user_by('id',$id);
        if(!empty($user)){
            $user=convert_array($user);
            $data['userId']=$user['ID'];
            $data['name']=$user['data']['display_name'];
            $data['phoneNumber']=get_user_meta($user['ID'],'phoneNumber',true);
            $data['email']=$user['data']['user_email'];
            $data['isPushNotification']=get_user_meta($user['ID'],'pushNotification',true);
            return $data;           
        }
    }

    /* login */
    function login($data=null,$opType=null){
        $credentials['user_login']=$data['email'];
        $credentials['user_password']=$data['password'];
        $loginResponse=wp_signon($credentials);
        if(!empty($loginResponse)){       
           $loginResponse=convert_array($loginResponse);  
           if(isset($loginResponse['ID']) and !empty($loginResponse['ID'])){
               if($opType=='app'){
                   if(!empty($data['deviceType'])){                     
                      update_user_meta($loginResponse['ID'], "deviceType", $data['deviceType']); 
                   }
                   if(!empty($data['deviceToken'])){
                      update_user_meta($loginResponse['ID'], "deviceToken", $data['deviceToken']); 
                   }
                   return $loginResponse['ID'];  
               }else{
                  return $loginResponse['ID'];   
               }              
           }else{
               if($opType=='app'){
                 return false;
               }else{
                   return false;
               } 
           }
        }else{
            return false;
        }
    }
    
    /* Signup */
    function signup($data=null,$opType=null){
        $username = $data['email'];            
        $user_id = wp_create_user($data['email'], $data['password'], $data['email']);
        wp_update_user(array(
             'ID' => $user_id,
             'display_name' => $data['name'],
        ));
        $emailTemplate=file_get_contents(get_stylesheet_directory_uri().'/email-template.php');
        $emailTemplate=str_replace('[NAME]',ucwords($data['name']),$emailTemplate);
        $message=getTextByLang('You are successfully registered with the website.',$data['lang']).getTextByLang('Your login credentials are mentioned below.',$data['lang']).'<br><br> '.getTextByLang('Email',$data['lang']).' : '.$data['email'].'<br> '.getTextByLang('Password',$data['lang']).' : '.$data['password']; 
       /* $message='You are successfully registered with the website.Your login credentials are mentioned below.<br><br> Email : '.$data['email'].'<br> Password : '.$data['password']; */
        $adminMessage='New User has been registered with the website.You can view the user information from admin panel.<br><br> <strong>Url</strong>: '.CUSTOM_ADMIN_URL;
        $emailTemplate=str_replace('[MESSAGE]',$message,$emailTemplate);
        send_email($data['email'],getTextByLang('Registration Successfull',$data['lang']),$emailTemplate);           
        $adminTemp=file_get_contents(get_stylesheet_directory_uri().'/email-template.php');
        $adminTemp=str_replace('[NAME]',FROM_NAME,$adminTemp);
        $adminTemp=str_replace('[MESSAGE]',$adminMessage,$adminTemp);
        send_email(FROM_MAIL,'New Registration',$adminTemp);
        update_user_meta($user_id, "first_name",$data['name']); 
        update_user_meta($user_id, "phoneNumber",$data['phoneNumber']); 
        update_user_meta($user_id, "tokenfield",randomString(8)); 
        if($opType=='app'){
            update_user_meta($user_id, "deviceToken", $data['deviceToken']);
            update_user_meta($user_id, "deviceType", $data['deviceType']); 
            update_user_meta($user_id, "pushNotification",1);  
            return $user_id;
        }else{
           return $user_id; 
        } 
    }

    /* Send Email */
    function send_email($email=null,$subject=null,$content=null){
        $headers[] = 'From: '.FROM_NAME.' <'.FROM_MAIL.'>';
        $headers[] = 'Content-Type: text/html; charset=UTF-8';
        wp_mail($email,$subject,$content,$headers); 
    }

    /* Reset password */
    function resetPassword($data=null,$opType=null){
        $loggedInUser=AuthUser($data['userId'],'string');
        $loggedInUser=convert_array($loggedInUser);
        $checkOldPassword= wp_check_password($data['currentPassword'],$loggedInUser['user_pass'],$data['userId']);
        if(!empty($checkOldPassword)){
           return true;
        }else{
           return false;
        }

     }

    /* Edit User Profile*/
    function editUserProfile($data=null,$opType=null){
        wp_update_user(array(
             'ID' => $data['userId'],
             'display_name' => $data['name'],
        ));
        update_user_meta($data['userId'], "phoneNumber", $data['phoneNumber']);
        update_user_meta($data['userId'], "first_name", $data['name']);
        return true;
    }


    /* Add Billing Address */
    function addBillingAddressOld($data=null,$opType=null){
        global $wpdb;
        if(empty($data['addressType'])){//home
            $query='insert into `im_billing_details`(`userId`,`addressTitle`,`area`,`addressType`,`block`,`street`,`avenue`,`house`,`additionalDirections`,`postalCode`,`phoneNumber`) values("'.$data['userId'].'","'.$data['addressTitle'].'","'.$data['area'].'","'.$data['addressType'].'","'.$data['block'].'","'.$data['street'].'","'.$data['avenue'].'","'.$data['house'].'","'.$data['additionalDirections'].'","'.$data['postalCode'].'","'.$data['phoneNumber'].'")';
            $wpdb->query($query);
            
        }elseif($data['addressType']=='2'){//office
            $wpdb->query('insert into `im_billing_details`(`userId`,`addressTitle`,`area`,`addressType`,`block`,`street`,`avenue`,`building`,`floor`,`office`,`additionalDirections`,`postalCode`,`phoneNumber`) values("'.$data['userId'].'","'.$data['addressTitle'].'","'.$data['area'].'","'.$data['addressType'].'","'.$data['block'].'","'.$data['street'].'","'.$data['avenue'].'","'.$data['building'].'","'.$data['floor'].'","'.$data['office'].'","'.$data['additionalDirections'].'","'.$data['postalCode'].'","'.$data['phoneNumber'].'")');             
        }else{//apartment            
            $wpdb->query('insert into `im_billing_details`(`userId`,`addressTitle`,`area`,`addressType`,`block`,`street`,`avenue`,`building`,`floor`,`apartmentNumber`,`additionalDirections`,`postalCode`,`phoneNumber`) values("'.$data['userId'].'","'.$data['addressTitle'].'","'.$data['area'].'","'.$data['addressType'].'","'.$data['block'].'","'.$data['street'].'","'.$data['avenue'].'","'.$data['building'].'","'.$data['floor'].'","'.$data['apartmentNumber'].'","'.$data['additionalDirections'].'","'.$data['postalCode'].'","'.$data['phoneNumber'].'")');
            
        }
        return true;
    }

    function addBillingAddress($data=null,$opType=null){
        $finalData['shipping_first_name']=getUserName($data['userId']);
        $finalData['shipping_last_name']='';
        $finalData['shipping_company']=$data['area'];
        $finalData['shipping_country']=$data['userId'];
        $finalData['shipping_address_1']=$data['block'];
        $finalData['shipping_city']=$data['street'];
        $finalData['shipping_postcode']=$data['postalCode'];
        $finalData['shipping_address_type']=$data['addressType'];
        $finalData['shipping_house']=$data['house'];
        $finalData['shipping_apartment_number']=$data['apartmentNumber'];
        $finalData['shipping_floor']=$data['floor'];
        $finalData['shipping_phone']=$data['phoneNumber'];
        $finalData['shipping_building']=$data['building'];
        $finalData['shipping_avenue']=$data['avenue'];
        $finalData['shipping_office']=$data['office'];
        $finalData['shipping_additional_directions']=$data['additionalDirections'];
        $finalData['shipping_address_is_default']='false';
        $finalData['label']=$data['addressTitle'];
        $address=get_user_meta($data['userId'],'wc_multiple_shipping_addresses',true);
        if(!is_array($address)){
            $address=unserialize($address);
        }
        if(!empty($address)){
           array_push($address,$finalData);
          // $address=serialize($address);
        }else{
          $address[0]=$finalData;
          //$address=serialize($address);
        } 
        update_user_meta($data['userId'],'wc_multiple_shipping_addresses',$address);
        return true;
    }

    /* Edit Billing Address */
    function editBillingAddressOld($data=null,$opType=null){
       global $wpdb;
       if(empty($data['addressType'])){//home
            $query='update `im_billing_details` set `addressTitle`="'.$data['addressTitle'].'", `area`="'.$data['area'].'",`addressType`="'.$data['addressType'].'",`block`="'.$data['block'].'",`street`="'.$data['street'].'",`avenue`="'.$data['avenue'].'",`house`="'.$data['house'].'",`additionalDirections`="'.$data['additionalDirections'].'",`postalCode`="'.$data['postalCode'].'",`phoneNumber`="'.$data['phoneNumber'].'" where `id`="'.$data['addressId'].'"'; 
            $wpdb->query($query);
            
        }elseif($data['addressType']=='1'){//appartment
             $query='update `im_billing_details` set `addressTitle`="'.$data['addressTitle'].'", `area`="'.$data['area'].'",`addressType`="'.$data['addressType'].'",`block`="'.$data['block'].'",`street`="'.$data['street'].'",`avenue`="'.$data['avenue'].'",`building`="'.$data['building'].'",`floor`="'.$data['floor'].'",`apartmentNumber`="'.$data['apartmentNumber'].'",`additionalDirections`="'.$data['additionalDirections'].'",`postalCode`="'.$data['postalCode'].'",`phoneNumber`="'.$data['phoneNumber'].'" where `id`="'.$data['addressId'].'"'; 
            $wpdb->query($query);
        }else{//office
           $query='update `im_billing_details` set `addressTitle`="'.$data['addressTitle'].'", `area`="'.$data['area'].'",`addressType`="'.$data['addressType'].'",`block`="'.$data['block'].'",`street`="'.$data['street'].'",`avenue`="'.$data['avenue'].'",`building`="'.$data['building'].'",`floor`="'.$data['floor'].'",`office`="'.$data['office'].'",`additionalDirections`="'.$data['additionalDirections'].'",`postalCode`="'.$data['postalCode'].'",`phoneNumber`="'.$data['phoneNumber'].'" where `id`="'.$data['addressId'].'"'; 
            $wpdb->query($query);            
        }
        return true;
    }
    /* Get Billing Address */
    function getBillingAddressesOld($userId=null,$opType=null){
        global $wpdb;
        $records=$wpdb->get_results('select * from `im_billing_details` where `userId`="'.$userId.'" order by id desc',ARRAY_A);
        $finalArray=array();
        if(!empty($records)){
           foreach($records as $k=>$v){
               $finalArray[$k]['addressId']=$v['id'];
               $finalArray[$k]['addressTitle']=$v['addressTitle'];
               $finalArray[$k]['area']=$v['area'];
               $finalArray[$k]['addressType']=$v['addressType'];
               $finalArray[$k]['block']=$v['block'];
               $finalArray[$k]['street']=$v['street'];
               $finalArray[$k]['avenue']=$v['avenue'];
               $finalArray[$k]['building']=$v['building'];
               $finalArray[$k]['floor']=$v['floor'];
               $finalArray[$k]['apartmentNumber']=$v['apartmentNumber'];
               $finalArray[$k]['additionalDirections']=$v['additionalDirections'];
               $finalArray[$k]['office']=$v['office'];
               $finalArray[$k]['house']=$v['house'];
               $finalArray[$k]['phoneNumber']=$v['phoneNumber'];
               $finalArray[$k]['postalCode']=$v['postalCode'];
           } 
        }
        return $finalArray;
    }

    function getBillingAddresses($userId=null,$opType=null){
        $address=get_user_meta($userId,'wc_multiple_shipping_addresses',true);
        if(!is_array($address)){
            $address=unserialize($address);
        }
        $finalArray=array();
        if(!empty($address)){
           foreach($address as $k=>$v){
               $count=$k+1;
               $finalArray[$k]['addressId']="$count";
               if(!isset($v['label'])){
                   $v['label']='';
                }
               $finalArray[$k]['addressTitle']=$v['label'];
               $finalArray[$k]['area']=$v['shipping_company'];
               $finalArray[$k]['addressType']=$v['shipping_address_type'];
               $finalArray[$k]['block']=$v['shipping_address_1'];
               $finalArray[$k]['street']=$v['shipping_city'];
               $finalArray[$k]['avenue']=$v['shipping_avenue'];
               $finalArray[$k]['building']=$v['shipping_building'];
               $finalArray[$k]['floor']=$v['shipping_floor'];
               $finalArray[$k]['apartmentNumber']=$v['shipping_apartment_number'];
               $finalArray[$k]['additionalDirections']=$v['shipping_additional_directions'];
               $finalArray[$k]['office']=$v['shipping_office'];
               $finalArray[$k]['house']=$v['shipping_house'];
               $finalArray[$k]['phoneNumber']=$v['shipping_phone'];
               $finalArray[$k]['postalCode']=$v['shipping_postcode'];
           } 
        }
        rsort($finalArray);
        return $finalArray;        
    }

    function editBillingAddress($data=null,$opType=null){
        $address=get_user_meta($data['userId'],'wc_multiple_shipping_addresses',true);
        if(!is_array($address)){
            $address=unserialize($address);
        }
        $finalData['shipping_first_name']=getUserName($data['userId']);
        $finalData['shipping_last_name']='';
        $finalData['shipping_company']=$data['area'];
        $finalData['shipping_country']=$data['userId'];
        $finalData['shipping_address_1']=$data['block'];
        $finalData['shipping_city']=$data['street'];
        $finalData['shipping_postcode']=$data['postalCode'];
        $finalData['shipping_address_type']=$data['addressType'];
        $finalData['shipping_house']=$data['house'];
        $finalData['shipping_apartment_number']=$data['apartmentNumber'];
        $finalData['shipping_floor']=$data['floor'];
        $finalData['shipping_phone']=$data['phoneNumber'];
        $finalData['shipping_building']=$data['building'];
        $finalData['shipping_avenue']=$data['avenue'];
        $finalData['shipping_office']=$data['office'];
        $finalData['shipping_additional_directions']=$data['additionalDirections'];
        $finalData['shipping_address_is_default']='false';
        $finalData['label']=$data['addressTitle'];
        $address[$data['addressId']]=$finalData;
        update_user_meta($data['userId'],'wc_multiple_shipping_addresses',$address);
        return true;
    }
   
    /* get Slider Images */
    function getSliderImages(){
        $args = array(
             'post_type'  => 'sliders',
             'post_status'  => 'publish',
             'orderby' => 'date',
             'order' => 'DESC'
            );
        $sliders = get_posts($args);
        $images=array();
        if(!empty($sliders)){
            foreach($sliders as $k=>$v){
              $images[$k]['sliderId']=(string)$v->ID;  
              $images[$k]['sliderImage']=get_the_post_thumbnail_url($v->ID);  
            }
        }
        return $images;
    }
    
    function getAllAreas(){
        $args = array(
             'post_type'  => 'areas',
             'post_status'  => 'publish',
             'orderby' => 'date',
             'order' => 'DESC',
            'posts_per_page'=>-1
            );
        $areas = get_posts($args);
        $areasArray=array();
        if(!empty($areas)){
            foreach($areas as $k=>$v){
              $areasArray[$k]=$v->post_title;  
            }
        }
        return $areasArray;
    }

    function getCartCount($userId=null){
        global $wpdb;
        $getRow=$wpdb->get_results('select `id` from `im_cart` where `userId`="'.$userId.'"');
        $count="0";
        if(!empty($getRow)){
           $count=count($getRow); 
        }
        return "$count";
    }

    /* Add to cart */
    function addToCart($data=null,$opType=null){
        global $wpdb;
        $getRow=$wpdb->get_row('select `id` from `im_cart` where `userId`="'.$data['userId'].'" and `productId`="'.$data['productId'].'"');
        if(!empty($getRow)){
          return false;   
        }else{
          $wpdb->query('insert into `im_cart`(`userId`,`productId`,`type`,`price`,`quantity`) values("'.$data['userId'].'","'.$data['productId'].'","'.$data['type'].'","'.$data['price'].'","'.$data['quantity'].'")');
          return true;  
        }
        
    }

    /* delete cart */
    function deleteCart($data=null,$opType=null){
        global $wpdb;
        $getRow=$wpdb->get_row('select `id` from `im_cart` where `userId`="'.$data['userId'].'" and `productId`="'.$data['productId'].'"',ARRAY_A);
        if(!empty($getRow)){
          $wpdb->query('delete from `im_cart` where `id`="'.$getRow['id'].'"');
          return true;    
        }else{
          return false;  
        }
    }

    /* Get cart products*/
    function getCartProducts($userId=null,$opType=null){
        global $wpdb;
        $getRows=$wpdb->get_results('select * from `im_cart` where `userId`="'.$userId.'"',ARRAY_A);
        $pro=array();
        if(!empty($getRows)){
           foreach($getRows as $k=>$v){
             $pro[]=$v['productId'];  
           } 
        }
        if(!empty($pro)){
            $args = array(
             'post_type' => 'product',
             'post__in'=>$pro
            );
            $query = new WP_Query($args);
            $alldata=array();
            $k=0;
            while ($query->have_posts()) : $query->the_post();
                 global $product;
                 $id = $product->get_id();        
                 $alldata[$k]['basketId']="$id"; 
                 $alldata[$k]['title']=get_the_title(); 
                 $alldata[$k]['isCartItem']=isCartItem($id,$userId); 
                 $alldata[$k]['description']=strip_tags(get_the_content()); 
                 $alldata[$k]['price']=$product->get_regular_price(); 
                 $alldata[$k]['minQuantity']='1';
                 $getCartProductDetails = getCartProductDetails($userId,$id);
                 $alldata[$k]['quantity']=$getCartProductDetails['quantity'];//user ordered qunatity
                 $alldata[$k]['type']=$getCartProductDetails['type']; 
                /*if(!empty(get_post_meta($id,'_stock',true)) || get_post_meta($id,'_stock',true)>0 ){
                  $alldata[$k]['maxQuantity']=get_post_meta($id,'_stock',true);  
                }else{
                  $alldata[$k]['maxQuantity']="10";  
                }  */  
                 $alldata[$k]['maxQuantity']=(string) get_field('enter_max_quantity_user_can_buy',$id);           
                 $getImage='';
                 $image=wp_get_attachment_image_src(get_post_thumbnail_id($id),'full');
                 if(!empty($image)){
                     $getImage=$image[0];
                 }
                 $alldata[$k]['firstImage']=$getImage; 
                 $attachment_ids = $product->get_gallery_attachment_ids();
                $image_link=array();
                if(!empty($attachment_ids)){
                     foreach( $attachment_ids as $attachment_id ) {
                         $image_link[] = wp_get_attachment_url($attachment_id);
                     }
                }
                $alldata[$k]['allImages']=$image_link; 
                $k++;
                endwhile;
                return $alldata;
         }else{
            return false;
        }
  
        /*
        $alldata=array();
        if(!empty($getRows)){
          foreach($getRows as $k=>$v){
             $product = new WC_Product($v['productId']); 
             $id = $product->get_id();            
             $alldata[$k]['basketId']="$id"; 
             $alldata[$k]['title']=$product->get_title(); 
             $alldata[$k]['type']=$v['type']; 
             $alldata[$k]['isCartItem']=isCartItem($id,$userId); 
             $alldata[$k]['description']=$product->get_description(); 
             $alldata[$k]['price']=$product->get_sale_price(); 
             $alldata[$k]['minQuantity']='0';
             $alldata[$k]['maxQuantity']=get_post_meta($id,'_stock',true);
             $alldata[$k]['quantity']=get_post_meta($id,'_stock',true);
             $getImage='';
             $image=wp_get_attachment_image_src(get_post_thumbnail_id($id),'full');
             if(!empty($image)){
                 $getImage=$image[0];
             }
             $alldata[$k]['firstImage']=$getImage; 
             $attachment_ids = $product->get_gallery_attachment_ids();
             $image_link=array();
             if(!empty($attachment_ids)){
                 foreach( $attachment_ids as $attachment_id ) {
                     $image_link[] = wp_get_attachment_url($attachment_id);
                 }
             }
             $alldata[$k]['allImages']=$image_link; 
           }  
          return $alldata;
        }else{
          return false;  
        } */
    }

    /* Get cart product details */
    function getCartProductDetails($userId=null,$productId=null){
        global $wpdb;
        $getRows=$wpdb->get_row('select * from `im_cart` where `userId`="'.$userId.'" and `productId`="'.$productId.'"',ARRAY_A);
        if(!empty($getRows)){
          return $getRows;  
        }        
    }
    /* Get address List */
    function getAddressList($userId=null,$opType=null){
        $data=getBillingAddresses($userId,$opType);
        $finalArray=array();
        if(!empty($data)){
            foreach($data as $k=>$v){
               $finalArray[$k]['addressId']= $v['addressId'];
               $finalArray[$k]['addressTitle']= $v['addressTitle'];
            }
        }
        return $finalArray;
    }   

    /* Add Catering*/
    function addCatering($data=null,$opType=null){
        global $wpdb;
        if($opType=='app'){
           $wpdb->query('insert into `im_caterings`(`name`,`email`,`phoneNumber`,`userId`,`description`,`numberOfAttendees`,`dateOfEvent`,`price`) values("'.$data['name'].'","'.$data['email'].'","'.$data['phoneNumber'].'","'.$data['userId'].'","'.$data['description'].'","'.$data['numberOfAttendees'].'","'.date('Y-m-d',$data['dateOfEvent']).'","0")'); 
        }else{
           $wpdb->query('insert into `im_caterings`(`name`,`email`,`phoneNumber`,`userId`,`description`,`numberOfAttendees`,`dateOfEvent`,`price`) values("'.$data['name'].'","'.$data['email'].'","'.$data['phoneNumber'].'","'.$data['userId'].'","'.$data['description'].'","'.$data['numberOfAttendees'].'","'.date('Y-m-d',$data['dateOfEvent']).'","'.$data['price'].'")'); 
        }
        $message=getTextByLang('Your catering message has been received.We will get back to you shortly.',$data['lang']); 
        $adminMessage='New Catering message has been received.You can view the information from admin panel.<br><br> <strong>Url</strong> : '.CUSTOM_ADMIN_URL;
        $emailTemplate=file_get_contents(get_stylesheet_directory_uri().'/email-template.php');
        $emailTemplate=str_replace('[NAME]',ucwords($data['name']),$emailTemplate);
        $emailTemplate=str_replace('[MESSAGE]',$message,$emailTemplate);
        send_email($data['email'],'Catering Message Sent',$emailTemplate);            
        $adminTemp=file_get_contents(get_stylesheet_directory_uri().'/email-template.php');
        $adminTemp=str_replace('[NAME]',FROM_NAME,$adminTemp);
        $adminTemp=str_replace('[MESSAGE]',$adminMessage,$adminTemp);
        send_email(FROM_MAIL,getTextByLang('Catering Message Received',$data['lang']),$adminTemp);  
        return true;
    }

    /* change Date format*/
    function inputChangeDate($inputDate=null){
      $date=str_replace('/','-',$inputDate);
      $date=date('m/d/Y',strtotime($date));
      return $date;
    }

    function getProducts($type=null,$userId=null,$offset=null){
        global $wpdb;
        $offset=$offset*20;
        if(!empty($type)){//basket
            $terms=16;
        }else{//kilo single fruit
            $terms=15; 
        }
        $args = array(
            'post_type' => 'product',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' =>$terms
                )
            )
        );
        $query = new WP_Query($args);
        $alldata=array();
        $k=0;
        while ($query->have_posts()) : $query->the_post();
            global $product;
            $id = $product->get_id();   
            $checkStockAvail=get_post_meta($id,'_stock_status',true);
            if($checkStockAvail!='outofstock'){
                $alldata[$k]['basketId']="$id"; 
                $alldata[$k]['languages']=''; 
                $alldata[$k]['type']="$type"; 
                $alldata[$k]['title']=get_the_title(); 
                $alldata[$k]['isCartItem']=isCartItem($id,$userId); 
                $alldata[$k]['description']=strip_tags(get_the_content()); 
                $alldata[$k]['price']=$product->get_regular_price(); 
                $alldata[$k]['minQuantity']='1';
                $alldata[$k]['quantity']='1';
                $alldata[$k]['maxQuantity']=(string) get_field('enter_max_quantity_user_can_buy',$id);
                /* $alldata[$k]['maxQuantity']=get_post_meta($id,'_stock',true);*/
                /*$alldata[$k]['quantity']=get_post_meta($id,'_stock',true);*/
                $getImage='';
                //$image=wp_get_attachment_image_src(get_post_thumbnail_id($id),'full');
                $image=wp_get_attachment_image_src(get_post_thumbnail_id($id),'custom-product-image');
                if(!empty($image)){
                 $getImage=$image[0];
                }
                $alldata[$k]['firstImage']=$getImage; 
                $attachment_ids = $product->get_gallery_attachment_ids();
                $image_link=array();
                if(!empty($attachment_ids)){
                 foreach( $attachment_ids as $attachment_id ) {
                     $image_link[] = wp_get_attachment_url($attachment_id);
                 }
                }
                $alldata[$k]['allImages']=$image_link; 
                $k++;
            }             
            endwhile;
            if(!empty($alldata)){
            $alldata = array_slice($alldata,$offset,20); 
            }
            return $alldata;
    }

    function getProductFacts($type=null,$offset=null){
        global $wpdb;
        $offset=$offset*20; 
        $args = array(
            'post_type' => 'product',
            'post_status'=>'publish',          
            'product_cat'=>'single-fruit'           
        );
        $query = new WP_Query($args);
        $alldata=array();
        $k=0;
        while ($query->have_posts()) : $query->the_post();
             global $product;
             $id = $product->get_id();  
             $checkStockAvail=get_post_meta($id,'_stock_status',true);
             if($checkStockAvail!='outofstock'){
                 $alldata[$k]['title']=get_the_title(); 
                 $getBasketType=getProCat($id);                 
                 if(!empty($type)){//1-storage fact
                   $alldata[$k]['description']=preg_replace( "/\r|\n/", "", strip_tags(get_field('storage_facts',$id)));
                 }else{//0-nutrition fact
                   $alldata[$k]['description']=preg_replace( "/\r|\n/","",strip_tags(get_field('nutrition_facts',$id)));
                 }         
                $getImage='';
                $image=wp_get_attachment_image_src(get_post_thumbnail_id($id),'full');
                if(!empty($image)){
                $getImage=$image[0];
                }
                $alldata[$k]['image']=$getImage; 
                $k++;
             }
            endwhile;
            if(!empty($alldata)){
            $alldata = array_slice($alldata,$offset,20); 
            }
            return $alldata;
    }

    function getProCat($product=null){
        $terms = get_the_terms($product,'product_cat' );
        foreach ($terms as $term) {
            $product_cat_id = $term->term_id;
            break;
        }
        return $product_cat_id;       
    }

    /* Get All orders */
    function getAllOrders($userId=null,$opType=null,$offset=null){
         $offset=$offset*20;  
         $customer_orders = get_posts(
            array(
               'numberposts' => -1,
               'meta_key'    => '_customer_user',
               'meta_value'  => $userId,
               'post_type'   => wc_get_order_types(),
               'post_status' => array_keys(wc_get_order_statuses())
            )
         );
        $orders=array();
        if(!empty($customer_orders)){
            $k=0;
            foreach($customer_orders as $key=>$v){
                $orderDetails = wc_get_order($v->ID);
                $orderData = $orderDetails->get_data(); 
               /* echo '<pre>';
                print_r($orderDetails);
                pr($orderData);*/
                $items=$orderDetails->get_items();                
                $itemsPro=$orderDetails->get_items(); 
                $orderData['date_created']=convert_array($orderData['date_created']);
                $date=date('h:i A, d M Y',strtotime($orderData['date_created']['date']));      
                $orders[$k]['price']=$orderData['total'];
                $allItems=array();
                $itemCount=0;
                if(!empty($items)){                   
                    foreach($items as $kP=> $item) 
                    {   
                        $product_id = $item['product_id'];
                        $product_qty = $item['quantity'];
                        $productDesc=get_post($product_id);
                        $orders[$k]['subprice']=get_post_meta($product_id,'_regular_price',true);
                        $orders[$k]['name']="";
                        $orders[$k]['status']=ucfirst($orderData['status']);
                        $orders[$k]['quantity']= (string) $product_qty;
                        $orders[$k]['dateTime']=$date;
                        $getImage='';
                        $image=wp_get_attachment_image_src(get_post_thumbnail_id($product_id),'full');
                        if(!empty($image)){
                          $getImage=$image[0];
                        }
                        $orders[$k]['image']=$getImage;
                        $orders[$k]['orderNo']=str_replace('wc_order_','',$orderData['order_key']);
                        $orders[$k]['orderNo']=(string) $v->ID;
                        $allItems[$itemCount]['name']=get_the_title($product_id);
                        $product_qty = $item['quantity'];                                
                        $productDesc=get_post($product_id);
                        $cat=getProCat($product_id);
                        $allItems[$itemCount]['quantity']=(string) $product_qty;                          
                        $allItems[$itemCount]['price']=(string)get_post_meta($product_id,'_regular_price',true);
                        $allItems[$itemCount]['total']=$orderData['total'];
                        $itemCount++;
                    } 
                } 
                $orders[$k]['details']['orderNo']=str_replace('wc_order_','',$orderData['order_key']);
                $orders[$k]['details']['orderNo']=(string) $v->ID;
                $orders[$k]['details']['date_created']=convert_array($orderData['date_created']);
                $orders[$k]['details']['transactionTime']=$date;
                $orders[$k]['details']['paymentMethod']=ucfirst($orderData['payment_method']);
                $addressId=get_post_meta($v->ID,'deliveryAddress',true);
                $alladd=getAddressDetails($userId,$addressId);
                if(empty(getAddressDetails($userId,$addressId))){                   
                    $adTi=get_post_meta($v->ID,'order_address',true);
                    $shippingPhpne=get_post_meta($v->ID,'_shipping_phone',true);
                    if(!empty($adTi)){
                        $alladd['addressId']="$addressId";
                        $alladd['addressTitle']=$adTi;
                        $alladd['area']='';
                        $alladd['addressType']='';
                        $alladd['block']='';
                        $alladd['street']='';
                        $alladd['building']='';
                        $alladd['avenue']='';
                        $alladd['floor']='';
                        $alladd['apartmentNumber']='';
                        $alladd['office']='';
                        $alladd['house']='';
                        $alladd['phoneNumber']="$shippingPhpne";
                        $alladd['postalCode']='';
                    }else{
                        $alladd['addressId']="0";
                        $alladd['addressTitle']='';
                        $alladd['area']='';
                        $alladd['addressType']='';
                        $alladd['block']='';
                        $alladd['street']='';
                        $alladd['building']='';
                        $alladd['avenue']='';
                        $alladd['floor']='';
                        $alladd['apartmentNumber']='';
                        $alladd['office']='';
                        $alladd['house']='';
                        $alladd['phoneNumber']='';
                        $alladd['postalCode']='';
                    }
                    
                }
                
                $getAddressDetails= $alladd;
                $orders[$k]['details']['address']=$getAddressDetails;
                $orders[$k]['details']['items']=$allItems;
                             
            $k++;}
        }
        if(!empty($orders)){
            $orders = array_slice($orders,$offset,20); 
        }
        return $orders;
    }    

    /* Is Cart Added */
    function isCartItem($productId=null,$userId=null){
        global $wpdb;
        $getRows=$wpdb->get_row('select * from `im_cart` where `userId`="'.$userId.'" and `productId`="'.$productId.'"',ARRAY_A);
        if(!empty($getRows)){
          return "1";  
        }
        return "0";  
        
    }

    function getCateringRecordsFilters($type=null){
        global $wpdb;
        if($type=='yearly'){
           $row=$wpdb->get_results('select * from `im_caterings` where YEAR(created) = YEAR(CURDATE())',ARRAY_A); 
        }elseif($type=='last-month'){
           $row=$wpdb->get_results('select * from `im_caterings` WHERE YEAR(created) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(created) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)',ARRAY_A);
        }elseif($type=='current-month'){
           $row=$wpdb->get_results('select * from `im_caterings` WHERE MONTH(created) = MONTH(CURRENT_DATE())
AND YEAR(created) = YEAR(CURRENT_DATE())',ARRAY_A);
        }elseif($type=='last-7-days'){
           $row=$wpdb->get_results('select * from `im_caterings` where  YEAR(created) = YEAR(CURRENT_DATE()) and created >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)',ARRAY_A);
        }else{
           $row=$wpdb->get_results('select * from `im_caterings`',ARRAY_A); 
        }
        
        pr($row);
        
    }

    

    /* delete Billing address */
    function deleteBillingAddress($addressId=null,$userId=null,$opType=null){
        $address=get_user_meta($userId,'wc_multiple_shipping_addresses',true);
        $finalArray=array();
        if(!is_array($address)){
            $address=unserialize($address);
        }
        unset($address[$addressId]);
        $address=array_values($address);
        update_user_meta($userId,'wc_multiple_shipping_addresses',$address);
        /* global $wpdb;
        $wpdb->query('delete from `im_billing_details` where `id`="'.$addressId.'"');*/
        return true;
    }

    /* GEt User name*/
    function getUserName($user_id=null){
        global $wpdb;
        $query='select `display_name` from `im_users` where `ID`="'.$user_id.'"';
        $result=$wpdb->get_row($query,ARRAY_A);
        $name='';
        if(!empty($result)){
           $name = $result['display_name'];
        }
        return $name;
    }
    
    /*check time ago */
    function getTiming($time){
       $time = time() - $time; // to get the time since that moment
       $time = ($time<1)? 1 : $time;
       $tokens = array (
           31536000 => 'year',
           2592000 => 'month',
           604800 => 'week',
           86400 => 'day',
           3600 => 'hour',
           60 => 'minute',
           1 => 'second'
       );
       foreach ($tokens as $unit => $text) {
           if ($time < $unit) continue;
           $numberOfUnits = floor($time / $unit);
           return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'').' ago';
       }

    }

    /* Get address details by id */
    function getAddressDetails($userId=null,$addressId=null){
        $address=get_user_meta($userId,'wc_multiple_shipping_addresses',true);
        $finalArray=array();
        if(!is_array($address)){
            $address=unserialize($address);
        }
        if(!empty($address)){
           foreach($address as $k=>$v){
               if($k==$addressId-1){
                   $count=$k+1;
                   $finalArray['addressId']="$count";
                   /*$finalArray['addressId']="$count";*/
                   if(!isset($v['label'])){
                       $v['label']='';
                    }
                   $finalArray['addressTitle']=$v['label'];
                   $finalArray['area']=$v['shipping_company'];
                   $finalArray['addressType']=$v['shipping_address_type'];
                   $finalArray['block']=$v['shipping_address_1'];
                   $finalArray['street']=$v['shipping_city'];
                   $finalArray['avenue']=$v['shipping_avenue'];
                   $finalArray['building']=$v['shipping_building'];
                   $finalArray['floor']=$v['shipping_floor'];
                   $finalArray['apartmentNumber']=$v['shipping_apartment_number'];
                   $finalArray['additionalDirections']=$v['shipping_additional_directions'];
                   $finalArray['office']=$v['shipping_office'];
                   $finalArray['house']=$v['shipping_house'];
                   $finalArray['phoneNumber']=$v['shipping_phone'];
                   $finalArray['postalCode']=$v['shipping_postcode'];
              }
           }
            return $finalArray;
        }else{
            $array=array();
            return $array;
        }
       
      /*   global $wpdb;
      $address=$wpdb->get_row('select * from `im_billing_details` where `id`="'.$addressId.'" and `userId`="'.$userId.'"',ARRAY_A); return $address;*/
       
    }
    
    function confirmOrderBkup($data=null,$opType=null){
        global $woocommerce;
        global $wpdb;
        if(empty($data['paymentType'])){
          response(0,null,getTextByLang('We are in process with the Knet.',$data['lang']));
        } 
        $getAddressDetails= getAddressDetails($data['userId'],$data['deliveryAddress']);        
        if(empty($getAddressDetails)){
          response(0,null,getTextByLang('No Address Found.',$data['lang']));
        }
        $userDetails=getUserDetails($data['userId']);
        $address = array(
            'first_name' => $userDetails['name'],
            'last_name'  => '',
            'company'    => $getAddressDetails['area'],
            'email'      => $userDetails['email'],
            'phone'      => $getAddressDetails['phoneNumber'],
            'address_1'  => $getAddressDetails['block'],
            'address_2'  => '',
            'city'       => $getAddressDetails['street'],
            'state'      => $getAddressDetails['avenue'],
            'postcode'   => $getAddressDetails['postalCode'],
            'country'    => ''
        );	 
        $order = wc_create_order(array('customer_id'=>$data['userId']));	
        if(!empty($data['itemsList'])){
           foreach($data['itemsList'] as $k=>$v){                
                $cate= getProCat($v['itemId']);
                if($cate==15){//single fruit   
                    $order->add_product(get_product($v['itemId']),$v['quantity']);
            /*        $stockAvailability=get_post_meta($v['itemId'],'_stock',true);
                    $updatedStock=$stockAvailability-$v['quantity'];
                    update_post_meta($v['itemId'],'_stock',$updatedStock);*/  
                }else{//basket
                    $order->add_product(get_product($v['itemId']),$v['quantity']);
                    $productItems=get_field('select_product',$v['itemId']);
                    if(!empty($productItems)){
                        foreach($productItems as $k=>$v){
                            $fruitID=$v['fruit_name'][0]->ID;
                            $fruitWeight=$v['weight'];
                           /* $stockAvailability=get_post_meta($fruitID,'_stock',true);
                            $updatedStock=$stockAvailability-$fruitWeight;
                            update_post_meta($fruitID,'_stock',$updatedStock);*/
                        }
                    }
                }                
           } 
        }    
        update_post_meta($order->id,'deliveryAddress',$data['deliveryAddress']);
        update_post_meta($order_id, '_cart_weight',$v['quantity'] );
        // Use the product IDs to add	
        $order->set_address($address,'billing');
        $order->set_address($address,'shipping');	
        $payment_gateways = WC()->payment_gateways->payment_gateways();
        if(!empty($data['paymentType'])){
         // $payment_gateways = 'cod';  
            $payment_gateways = 'Cash';  
        }        
        $order->set_payment_method($payment_gateways);	
        $order->calculate_totals($data['totalPayble']);
        $order->update_status( 'Completed', 'Order created dynamically - ', TRUE);        
        $allOrderId=$order->id;
        $orderDetails = wc_get_order($allOrderId);
        $orderData = $orderDetails->get_data(); 
        $items=$orderDetails->get_items(); 
        $orders=array();
        $allOrderInfo=array();
        $allOrderInfo['orderNo']=str_replace('wc_order_','',$orderData['order_key']);
        $allOrderInfo['orderNo']=(string) $allOrderId;
        $orderData['date_created']=convert_array($orderData['date_created']);
        $date=date('d M Y h:i A',strtotime($orderData['date_created']['date']));
        $allOrderInfo['transactionTime']=$date;
        $allOrderInfo['paymentMethod']='Cash';
        $allOrderInfo['address']=$getAddressDetails;
        $url=site_url().'/api/getItems.php?orderId='.$order->id.'&lang='.$data['lang'];
        $getOrdersDetails=json_decode(file_get_contents($url),true);
        $allOrderInfo['items']=$getOrdersDetails['data'];
        $wpdb->query('delete from `im_cart` where `userId`="'.$data['userId'].'"');
        return $allOrderInfo;
    }

    function confirmOrder($data=null,$opType=null){
        global $woocommerce;
        global $wpdb;
        if(empty($data['paymentType'])){
          response(0,null,getTextByLang('We are in process with the Knet.',$data['lang']));
        } 
        $getAddressDetails= getAddressDetails($data['userId'],$data['deliveryAddress']);        
        if(empty($getAddressDetails)){
          response(0,null,getTextByLang('No Address Found.',$data['lang']));
        }
        $userDetails=getUserDetails($data['userId']);
        $address = array(
            'first_name' => $userDetails['name'],
            'last_name'  => '',
            'company'    => $getAddressDetails['area'],
            'email'      => $userDetails['email'],
            'phone'      => $getAddressDetails['phoneNumber'],
            'address_1'  => $getAddressDetails['block'],
            'address_2'  => '',
            'city'       => $getAddressDetails['street'],
            'state'      => $getAddressDetails['avenue'],
            'postcode'   => $getAddressDetails['postalCode'],
            'country'    => ''
        );	 
        $order = wc_create_order(array('customer_id'=>$data['userId']));	
        if(!empty($data['itemsList'])){
           foreach($data['itemsList'] as $k=>$v){                
                $cate= getProCat($v['itemId']);
                if($cate==15){//single fruit   
                    $order->add_product(get_product($v['itemId']),$v['quantity']);
                }else{//basket
                    $order->add_product(get_product($v['itemId']),$v['quantity']);
                    $productItems=get_field('select_product',$v['itemId']);
                    if(!empty($productItems)){
                        foreach($productItems as $k=>$v){
                            $fruitID=$v['fruit_name'][0]->ID;
                            $fruitWeight=$v['weight'];
                        }
                    }
                }                
           } 
        }    
        update_post_meta($order->id,'deliveryAddress',$data['deliveryAddress']);
        update_post_meta($order->id,'shipping_address_type',$getAddressDetails['addressType']);
        update_post_meta($order->id,'shipping_building',$getAddressDetails['building']);
        update_post_meta($order->id,'shipping_floor',$getAddressDetails['floor']);
        update_post_meta($order->id,'shipping_apartment_number',$getAddressDetails['apartmentNumber']);
        update_post_meta($order->id,'shipping_additional_directions',$getAddressDetails['additionalDirections']);
        update_post_meta($order->id,'shipping_office',$getAddressDetails['office']);
        update_post_meta($order->id,'shipping_house',$getAddressDetails['house']);
        update_post_meta($order->id,'order_address',$getAddressDetails['addressTitle']);
        update_post_meta($order_id, '_cart_weight',$v['quantity'] );
        // Use the product IDs to add	
        $order->set_address($address,'billing');
        $order->set_address($address,'shipping');	
        $payment_gateways = WC()->payment_gateways->payment_gateways();
        if(!empty($data['paymentType'])){
          $payment_gateways = 'Cash';  
        }        
        $order->set_payment_method($payment_gateways);	
        $order->calculate_totals($data['totalPayble']);
        $order->update_status( 'Completed', 'Order created dynamically - ', TRUE);        
        $allOrderId=$order->id;
        $orderDetails = wc_get_order($allOrderId);
        $orderData = $orderDetails->get_data(); 
        $items=$orderDetails->get_items(); 
        $orders=array();
        $allOrderInfo=array();
        $allOrderInfo['orderNo']=str_replace('wc_order_','',$orderData['order_key']);
        $allOrderInfo['orderNo']=(string) $allOrderId;
        $orderData['date_created']=convert_array($orderData['date_created']);
        $date=date('h:i A, d M Y',strtotime($orderData['date_created']['date']));
        $allOrderInfo['transactionTime']=$date;
        $allOrderInfo['paymentMethod']='Cash';
        $allOrderInfo['address']=$getAddressDetails;
        $url=site_url().'/api/getItems.php?orderId='.$order->id.'&lang='.$data['lang'];
        $getOrdersDetails=json_decode(file_get_contents($url),true);
        $allOrderInfo['items']=$getOrdersDetails['data'];
        /*$url=site_url().'/api/getItems.php?orderId='.$order->id.'&lang=en';
        $getOrdersDetails=json_decode(file_get_contents($url),true);
        $allOrderInfo['enitems']=$getOrdersDetails['data'];
        $url=site_url().'/api/getItems.php?orderId='.$order->id.'&lang=ar';
        $getOrdersDetails=json_decode(file_get_contents($url),true);
        $allOrderInfo['aritems']=$getOrdersDetails['data'];*/
        $wpdb->query('delete from `im_cart` where `userId`="'.$data['userId'].'"');
        return $allOrderInfo;
    }



     /* Add Notifications*/
    function insert_notification($userId=null,$moduleId=null,$opponentId=null,$title=null){
        global $wpdb;
        $wpdb->query('insert into `im_notifications`(`userId`,`created`,`type`,`title`,`moduleId`,`opponentId`) values("'.$userId.'","'.date('Y-m-d H:i:s').'","0","'.$title.'","'.$moduleId.'","'.$opponentId.'")');
        if(!empty($opponentId)){
          pushMessageNotification($opponentId,$title);                    
        } 
             
    }

    /* Email Notifications */
    function sendEmailNotification($userId=null,$opponentId=null,$type=null,$moduleId=null,$title=null,$opType=null){       
        $senderName=getUserName($userId);
        $senderEmail=getUserEmail($userId);
        $receiverName=getUserName($opponentId);
        $receiverEmail=getUserEmail($opponentId);
        $emailTemplate=file_get_contents(get_stylesheet_directory_uri().'/email-template.php');
        $emailTemplate=str_replace('[NAME]',ucwords($receiverName),$emailTemplate);
        $emailTemplate=str_replace('[MESSAGE]',$title,$emailTemplate);
        $headers[] = 'From: '.$senderName.' <'.$senderEmail.'>';
        $headers[] = 'Content-Type: text/html; charset=UTF-8';
        wp_mail($receiverEmail,'Photoravel',$emailTemplate, $headers);  
     }

 /* start Push Notifications */
    function pushMessageNotification($user_id,$message){
        global $wpdb;
        $tokens = trim(get_user_meta($user_id,'deviceToken',true));
        $deviceName = get_user_meta($user_id,'deviceType',true);
        $pushNotification = 1;
        if(!empty($tokens) and !empty($pushNotification))
        {
            if($deviceName=='android')
            {
                $res=sendMessageAndroid($tokens,$message);
                return $res;
            }else{
                $res=sendMessageIos($tokens,$message);
                return $res;
            }
        } 
    } 

    function sendMessageIos($token_id,$checkNotification){
        $title = "Fruitdose";
        $description = strip_tags($checkNotification);
        //FCM api URL	
        $url = 'https://fcm.googleapis.com/fcm/send';
        //api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
        $server_key='AAAAXX69PxE:APA91bH1xLzSY-CkmOWGq9PKD5H1nUglbusxzOtF0AAVR1fs2We3wLVRY2A7A1Ze3E3OnPNn9J0OU6VFVqlRfC0GrvJN2K9UYjYpoC5JSkhuVeu_L5oTWWftP8Lgd9x4AyCBz2Us9Ct2';
        //header with content_type api key
        $fields = array (
            'to' => $token_id,
            "content_available"  => true,
            "priority" =>  "high",
            'notification' => array( 
            "sound"=>  "default",
            "badge"=>  "12",
            'title' => "$title",
            'body' => "$description",
        )
        );
        //header with content_type api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$server_key
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

    function sendMessageAndroid($token_id,$checkNotification){
        $title = "Fruitdose";
        $description = $checkNotification;

        //FCM api URL	
        $url = 'https://android.googleapis.com/gcm/send';
        //api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
        $server_key = 'AAAAXX69PxE:APA91bH1xLzSY-CkmOWGq9PKD5H1nUglbusxzOtF0AAVR1fs2We3wLVRY2A7A1Ze3E3OnPNn9J0OU6VFVqlRfC0GrvJN2K9UYjYpoC5JSkhuVeu_L5oTWWftP8Lgd9x4AyCBz2Us9Ct2';

        //header with content_type api key
        $fields = array (
        'to' => $token_id,
        "content_available"  => true,
        "priority" =>  "high",
        'notification' => array( 
        "sound"=>  "default",
        "badge"=>  "12",
        'title' => "$title",
        'body' => "$description",
        )
        );
        //header with content_type api key
        $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$server_key
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }


    add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

    function my_custom_checkout_field_display_admin_order_meta($order){
        $paymentMethod=get_post_meta( $order->id, '_payment_method', true );
       echo '<input type="hidden" id="checkBillingAddress" value="no"/><p class="paymentMethod"><strong>'.__('Payment Method').':</strong> <br/>' .strtoupper($paymentMethod) . '</p>';
    }

    add_action('wp_ajax_save_catering','save_catering');
    add_action('wp_ajax_nopriv_save_catering','save_catering');

    function save_catering(){
        global $wpdb;
        $wpdb->query('update `im_caterings` set `price`="'.$_POST['price'].'" where `id`="'.$_POST['id'].'"');
        $emailTemplate=file_get_contents(get_stylesheet_directory_uri().'/email-template.php');
        $catering=$wpdb->get_row('select * from `im_caterings` where `id`="'.$_POST['id'].'"',ARRAY_A);
        $emailTemplate=str_replace('[NAME]',ucwords($catering['name']),$emailTemplate);
        $message='Admin updated the '.$_POST['price'].' KD price for your catering order.';  
        $emailTemplate=str_replace('[MESSAGE]',$message,$emailTemplate);
        send_email($catering['email'],'Catering Price Added',$emailTemplate);
        echo json_encode(array('status'=>'true','message'=>'Catering price updated successfully.'));
        die;
    }   
 

    add_action('wp_ajax_get_catering_message','get_catering_message');
    add_action('wp_ajax_nopriv_get_catering_message','get_catering_message');
    function get_catering_message(){
        global $wpdb;
        $row=$wpdb->get_row('select * from `im_caterings` where `id`="'.$_POST['id'].'"',ARRAY_A);
        $row['neweventdate']=date('d/m/Y',strtotime($row['dateOfEvent']));
        echo json_encode(array('status'=>'true','data'=>$row));
        die;
    }

    /* Get Notification Count*/
    function getNotificationCount($userId=null){
        global $wpdb;
        $count=0;
        $records=$wpdb->get_results('select `id` from `im_notifications` where `opponentId`="'.$userId.'" and `status`="0"',ARRAY_A);        
        if(!empty($records)){
            $count=count($records);
        }
        return "$count";
    }

    /* start Admin Panel */
    add_action('init', 'sliders');
    function sliders() {
        register_post_type('sliders', array(
            'labels' => array(
                'name' => __("App Slider"),
                'singular_name' => __("Sliders"),
                'all_items' => __("All Sliders"),
                'edit_item' => __("Edit Slider"),
                'add_new' => __("Add New")
            ),
            'rewrite' => array('slug' => 'sliders', 'with_front' => true),
            'capability_type' => 'post',
            'public' => true,
            'hierarchical' => true,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'author',
            ),
            'menu_position' =>60

                )
        );
        register_taxonomy('sliders', 'questions', array('label' => __("Slider Categories"), 'show_ui' => true, 'show_admin_column' => true, 'rewrite' => false, 'hierarchical' => true,));
    }
    
    add_action('init', 'websliders');
    function websliders() {
        register_post_type('websliders', array(
            'labels' => array(
                'name' => __("Web Slider"),
                'singular_name' => __("Sliders"),
                'all_items' => __("All Images"),
                'edit_item' => __("Edit Image"),
                'add_new' => __("Add New")
            ),
            'rewrite' => array('slug' => 'websliders', 'with_front' => true),
            'capability_type' => 'post',
            'public' => true,
            'hierarchical' => true,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
                'author',
            ),
            'menu_position' =>60

                )
        );
        register_taxonomy('websliders', 'questions', array('label' => __("Slider Categories"), 'show_ui' => true, 'show_admin_column' => true, 'rewrite' => false, 'hierarchical' => true,));
    }

     /* Frontend Functions */
    function webSlidersImages(){
        $args = array(
             'post_type'  => 'websliders',
             'post_status'  => 'publish',
             'orderby' => 'date',
             'order' => 'DESC'
            );
        $sliders = get_posts($args);
        $images=array();
        if(!empty($sliders)){
            foreach($sliders as $k=>$v){
              $images[$k]['sliderId']=(string)$v->ID;  
              $images[$k]['sliderImage']=get_the_post_thumbnail_url($v->ID,'full');  
              $images[$k]['sliderTitle']=$v->post_title;  
              $images[$k]['sliderContent']=$v->post_content;  
            }
        }
        return $images;        
    }
    /* end  Frontend Functions */

    add_action('init', 'areas');
    function areas() {
        register_post_type('areas', array(
            'labels' => array(
                'name' => __("All Areas"),
                'singular_name' => __("Areas"),
                'all_items' => __("All Areas"),
                'edit_item' => __("Edit Area"),
                'add_new' => __("Add New")
            ),
            'rewrite' => array('slug' => 'areas', 'with_front' => true),
            'capability_type' => 'post',
            'public' => true,
            'hierarchical' => true,
            'menu_position' =>80,
            'supports' => array(
                'title',
                'editor',
               // 'thumbnail',
               // 'author',
            )
           )
        );
        register_taxonomy('areas', 'questions', array('label' => __("Slider Categories"), 'show_ui' => true, 'show_admin_column' => true, 'rewrite' => false, 'hierarchical' => true,));
    }


    if( function_exists('acf_add_options_page') ) {	
        acf_add_options_page(array(
            'page_title' 	=> 'Language Settings',
            'menu_title'	=> 'Language Settings',
            'menu_slug' 	=> 'language-settings',
            'capability'	=> 'edit_posts',
            'redirect'		=> false
        ));
    }

    function custom_menu_page_removing() {
        remove_menu_page('upload.php');
        remove_menu_page('themes.php');
        remove_menu_page('edit-comments.php');
        remove_menu_page('plugins.php');
        remove_menu_page('tools.php');
        remove_menu_page('edit.php');
    }

    add_action( 'admin_menu', 'custom_menu_page_removing' );


    add_action('admin_menu', 'admin_custom_menus');

    function admin_custom_menus(){
       add_menu_page('Catering', 'Catering', 'manage_options', 'catering', 'cateringMessage','dashicons-portfolio',10);
      add_menu_page('export', 'export Messages', 'manage_options', 'export_csv', 'export_csv','dashicons-portfolio',10);
     
       add_submenu_page('catering','Catering Add','Add Catering Order', 'manage_options','catering-add','cateringAddOrder');
       add_submenu_page('catering','Catering Reports','Reports', 'manage_options','catering-reports','cateringReports');
       add_menu_page('Reports', 'Reports', 'manage_options', 'reports', 'reports','dashicons-editor-table',30);
       add_submenu_page('woocommerce','New Orders','New Orders', 'manage_options','new-orders','newOrders');
        add_submenu_page('woocommerce','Processing Orders','In process Orders', 'manage_options','process-orders','processOrders'); 
       add_submenu_page('woocommerce','Completed Orders','Completed Orders', 'manage_options','complete-orders','completedOrders');
       add_submenu_page('woocommerce','Refunded Orders','Refunded Orders', 'manage_options','refunded-orders','refundedOrders');
        
       add_submenu_page('woocommerce','Replaced Orders','Replaced Orders', 'manage_options','replace-orders','replacedOrders');
       add_submenu_page('woocommerce','Cancelled Orders','Cancelled Orders', 'manage_options','canceled-orders','canceledOrders');
       add_submenu_page('edit.php?post_type=product','Basket','Basket', 'manage_options','basket','basket'); add_submenu_page('edit.php?post_type=product','Products','Products', 'manage_options','productt','products');
        add_menu_page('Basic Settings', 'Basic Settings', 'manage_options', 'basic-settings', 'basicSettings','dashicons-admin-generic',10);
       
    } 

    function cateringAddOrder(){
       include('admin-templates/addCatering.php');  
    }

    function basket(){
       wp_redirect(site_url().'/wp-admin/edit.php?s&post_status=all&post_type=product&action=-1&product_cat=basket&product_type&filter_action=Filter&paged=1&action2=-1');
       die;   
    }
    function basicSettings(){
       wp_redirect(site_url().'/wp-admin/options-general.php?page=custom_options_plus');
       die;   
    }
    function reports(){
       wp_redirect(site_url().'/wp-admin/admin.php?page=wc-reports');
       die;   
    }

    function products(){
       wp_redirect(site_url().'/wp-admin/edit.php?s&post_status=all&post_type=product&action=-1&product_cat=single-fruit&product_type&filter_action=Filter&paged=1&action2=-1');
       die;   
    }

    add_action( 'admin_menu', 'remove_menu_pages', 999);
    function remove_menu_pages() {
      global $current_user;
      $remove_submenu = remove_submenu_page('woocommerce', 'wc-addons');
      $remove_submenu = remove_submenu_page('woocommerce', 'wc-status');
      $remove_submenu = remove_submenu_page('woocommerce', 'wc-settings'); 
    }

    add_action( 'added_post_meta', 'mp_sync_on_product_save', 10, 4 );
    add_action( 'updated_post_meta', 'mp_sync_on_product_save', 10, 4 );
    function mp_sync_on_product_save( $meta_id, $post_id, $meta_key, $meta_value ) {
        if ( $meta_key == '_edit_lock' ) { // we've been editing the post
            if ( get_post_type( $post_id ) == 'product' ) { // we've been editing a product
                $product = wc_get_product( $post_id );
                update_post_meta($post_id,'_backorders','yes');
            }
        }
    }

    function newOrders(){
         wp_redirect(site_url().'/wp-admin/edit.php?post_status=wc-pending&post_type=shop_order');
       die; 
        /*include('admin-templates/newOrders.php'); */
    }
    function cateringReports(){
        include('admin-templates/cateringReports.php'); 
    }
    function processOrders(){
    
       wp_redirect(site_url().'/wp-admin/edit.php?post_status=wc-processing&post_type=shop_order');
       die; 
    }
    function refundedOrders(){
       wp_redirect(site_url().'/wp-admin/edit.php?post_status=wc-refunded&post_type=shop_order');
        die;
    }
    function replacedOrders(){         
       include('admin-templates/replacedOrders.php'); 
    }
    function completedOrders(){
       wp_redirect(site_url().'/wp-admin/edit.php?post_status=wc-completed&post_type=shop_order');
       die;
    }
     function canceledOrders(){
         wp_redirect(site_url().'/wp-admin/edit.php?post_status=wc-cancelled&post_type=shop_order');
         die; 
     }
    

    function cateringMessage(){
       include('admin-templates/cateringMessage.php'); 
    }
    function rename_header_to_logo( $translated, $original, $domain ) {
        $strings = array(
            'WooCommerce' => 'All Orders'
        );
        if ( isset( $strings[$original] ) && is_admin() ) {
            $translations = &get_translations_for_domain( $domain );
            $translated = $translations->translate( $strings[$original] );
        }
        return $translated;
    }
    add_filter( 'gettext', 'rename_header_to_logo', 10, 3 );
    function wpex_wc_register_post_statuses() {
        register_post_status( 'wc-shipping-progress', array(
            'label'                     => _x( 'Bad Order', 'WooCommerce Order status', 'text_domain' ),
            'public'                    => true,
            'exclude_from_search'       => false,
            'show_in_admin_all_list'    => true,
            'show_in_admin_status_list' => true,
            'label_count'               => _n_noop( 'Approved (%s)', 'Approved (%s)', 'text_domain' )
        ) );
    }
    add_filter( 'init', 'wpex_wc_register_post_statuses' );
    // Add New Order Statuses to WooCommerce
    function wpex_wc_add_order_statuses( $order_statuses ) {
        $order_statuses['wc-bad-order'] = _x( 'Bad Order', 'WooCommerce Order status', 'text_domain' );        
        return $order_statuses;
    }
    add_filter( 'wc_order_statuses', 'wpex_wc_add_order_statuses' );
    /*Renaming Order status start */
    function wc_renaming_order_status( $order_statuses ) {
        foreach ( $order_statuses as $key => $status ) {
            $new_order_statuses[ $key ] = $status;
            if ( 'wc-completed' === $key ) {
                $order_statuses['wc-processing'] = _x('In Process', 'Order status', 'woocommerce' );
                $order_statuses['wc-completed'] = _x('Delievered/Completed', 'Order status', 'woocommerce' );
                $order_statuses['wc-bad-order'] = _x('Bad Order/Replace', 'Order status', 'woocommerce' );
                $order_statuses['wc-refunded'] = _x('Bad Order/Refund', 'Order status', 'woocommerce' );
                $order_statuses['wc-cancelled'] = _x('Cancelled', 'Order status', 'woocommerce' );
            }
        }
        return $order_statuses;
    }
    add_filter( 'wc_order_statuses', 'wc_renaming_order_status' );

    /*Renaming Order status end */
    add_action( 'after_setup_theme', 'my_after_setup_theme' );
    function my_after_setup_theme() {
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
    }





    function misha_remove_order_statuses( $wc_statuses_arr ){
	// On Hold
        if( isset( $wc_statuses_arr['wc-on-hold'] ) ){
            unset( $wc_statuses_arr['wc-on-hold'] );
        }
        // Failed
        if( isset( $wc_statuses_arr['wc-failed'] ) ){
            unset( $wc_statuses_arr['wc-failed'] );
        }
        
        // Cancelled
        if( isset( $wc_statuses_arr['wc-cancelled'] ) ){
           // unset( $wc_statuses_arr['wc-cancelled'] );
        }
	    return $wc_statuses_arr; // return result statuses
    }
    add_filter( 'wc_order_statuses', 'misha_remove_order_statuses' );

    /**
    * Display field value on the order edit page
    */
     function action_woocommerce_admin_order_data_after_order_details($post_id, $wccm_before_checkout ) { 
          $reason = get_post_meta($_REQUEST['post'],'reason',true);
          if(empty($reason)){
             $reason=''; 
          }
      ?>
    <p class="form-field form-field-wide">
        <label for="order_date">Reason:</label>
        <textarea id="reasonMessage" name="reason"><?php echo $reason; ?></textarea>
    </p>
    <?php
      }

         
    add_action( 'woocommerce_admin_order_data_after_order_details', 'action_woocommerce_admin_order_data_after_order_details', 10, 1 );

    add_action( 'woocommerce_process_shop_order_meta', 'woocommerce_process_shop_order', 10, 2 );
    function woocommerce_process_shop_order ( $post_id, $post ) {
        if(!empty($_POST['reason'])){
          update_post_meta($post_id,'reason',$_POST['reason']);  
        }
    }


    add_filter( 'woocommerce_checkout_fields' , 'dropdown' );
    // Our hooked in function - $fields is passed via the filter!
    function dropdown( $fields ) {       
        $fields['shipping']['shipping_address_type']['label']='Address Type';
        $fields['shipping']['shipping_address_type']['placeholder']='Address Type';
        $fields['shipping']['shipping_address_type']['type']='select';
        $fields['shipping']['shipping_address_type']['priority']=19;
        $fields['shipping']['shipping_address_type']['options']=array('0'=>'Home','1'=>'Apartment','2'=>'Office');
        $fields['shipping']['shipping_company']['label']='Area';
        $fields['shipping']['shipping_address_1']['label']='Block';
        $fields['shipping']['shipping_city']['label']='Street';
        $fields['shipping']['shipping_city']['placeholder']='Street';
        $fields['shipping']['shipping_state']['label']='Avenue';
        $fields['shipping']['shipping_state']['placeholder']='Avenue';
        $fields['shipping']['shipping_state']['type']='text';
        $fields['shipping']['shipping_house']['label']='House';
        $fields['shipping']['shipping_house']['placeholder']='House';
        $fields['shipping']['shipping_house']['required']='0';
        $fields['shipping']['shipping_house']['class']=array('form-row-wide');
        $fields['shipping']['shipping_apartment_number']['label']='Apartment Number';
        $fields['shipping']['shipping_apartment_number']['placeholder']='Apartment Number';
        $fields['shipping']['shipping_apartment_number']['required']='0';
        $fields['shipping']['shipping_apartment_number']['class']=array('form-row-wide');
        $fields['shipping']['shipping_floor']['label']='Floor';
        $fields['shipping']['shipping_floor']['placeholder']='Floor';
        $fields['shipping']['shipping_floor']['required']='0';
        $fields['shipping']['shipping_floor']['class']=array('form-row-wide');
        $fields['shipping']['shipping_office']['label']='Office';
        $fields['shipping']['shipping_office']['placeholder']='Office';
        $fields['shipping']['shipping_office']['required']='0';
        $fields['shipping']['shipping_office']['class']=array('form-row-wide');
        $fields['shipping']['shipping_phone']['label']='Phone Number';
        $fields['shipping']['shipping_phone']['required']='1';
        $fields['shipping']['shipping_phone']['required']='1';
        $fields['shipping']['shipping_phone']['priority']=100;
        $fields['shipping']['shipping_phone']['class']=array(' form-row-wide');  
        $fields['shipping']['shipping_building']['label']='Building';
        $fields['shipping']['shipping_building']['placeholder']='Building';
        $fields['shipping']['shipping_postcode']['required']='0';
        $fields['shipping']['shipping_building']['required']='0';
        $fields['shipping']['shipping_building']['class']=array(' form-row-wide');   
        $fields['shipping']['shipping_building']['label']='Building';
        $fields['shipping']['shipping_building']['placeholder']='Building';
        $fields['shipping']['shipping_building']['required']='1';
        $fields['shipping']['shipping_building']['class']=array('form-row-wide');
        $fields['shipping']['shipping_avenue']['label']='Avenue';
        $fields['shipping']['shipping_address_1']['placeholder']='Block';
        $fields['shipping']['shipping_avenue']['required']='1';
        $fields['shipping']['shipping_avenue']['placeholder']='Avenue';
        $fields['shipping']['shipping_avenue']['priority']=55;
        $fields['shipping']['shipping_avenue']['class']=array(' form-row-wide');
        $fields['shipping']['shipping_additional_directions']['label']='Additional Directions';
        $fields['shipping']['shipping_additional_directions']['required']='0';
        $fields['shipping']['shipping_additional_directions']['type']='textarea';
        $fields['shipping']['shipping_additional_directions']['priority']='1';
        $fields['shipping']['shipping_additional_directions']['class']=array(' form-row-wide');
        unset($fields['shipping']['shipping_address_2']);
        unset($fields['shipping']['shipping_state']);
        $fields['billing']['billing_address_type']['label']='Address Type';
        $fields['billing']['billing_address_type']['placeholder']='Address Type';
        $fields['billing']['billing_address_type']['type']='select';
        $fields['billing']['billing_address_type']['priority']=19;
        $fields['billing']['billing_address_type']['options']=array('0'=>'Home','1'=>'Apartment','2'=>'Office');
        $fields['billing']['billing_company']['label']='Area';
        $fields['billing']['billing_address_1']['label']='Block';
        $fields['billing']['billing_city']['label']='Street';
        $fields['billing']['billing_city']['placeholder']='Street';
        $fields['billing']['billing_state']['label']='Avenue';
        $fields['billing']['billing_state']['placeholder']='Avenue';
        $fields['billing']['billing_state']['type']='text';
        $fields['billing']['billing_house']['label']='House';
        $fields['billing']['billing_house']['placeholder']='House';
        $fields['billing']['billing_house']['required']='0';
        $fields['billing']['billing_house']['class']=array('form-row-wide');
        $fields['billing']['billing_apartment_number']['label']='Apartment Number';
        $fields['billing']['billing_apartment_number']['placeholder']='Apartment Number';
        $fields['billing']['billing_apartment_number']['required']='0';
        $fields['billing']['billing_apartment_number']['class']=array('form-row-wide');
        $fields['billing']['billing_floor']['label']='Floor';
        $fields['billing']['billing_floor']['placeholder']='Floor';
        $fields['billing']['billing_floor']['required']='0';
        $fields['billing']['billing_floor']['class']=array('form-row-wide');
        $fields['billing']['billing_office']['label']='Office';
        $fields['billing']['billing_office']['placeholder']='Office';
        $fields['billing']['billing_office']['required']='0';
        $fields['billing']['billing_office']['class']=array('form-row-wide');
        $fields['billing']['billing_phone']['label']='Phone Number';
        $fields['billing']['billing_phone']['required']='1';
        $fields['billing']['billing_phone']['required']='1';
        $fields['billing']['billing_phone']['priority']=100;
        $fields['billing']['billing_phone']['class']=array(' form-row-wide');  
        $fields['billing']['billing_building']['label']='Building';
        $fields['billing']['billing_building']['placeholder']='Building';
        $fields['billing']['billing_postcode']['required']='0';
        $fields['billing']['billing_building']['required']='0';
        $fields['billing']['billing_building']['class']=array(' form-row-wide');   
        $fields['billing']['billing_building']['label']='Building';
        $fields['billing']['billing_building']['placeholder']='Building';
        $fields['billing']['billing_building']['required']='1';
        $fields['billing']['billing_building']['class']=array('form-row-wide');
        $fields['billing']['billing_avenue']['label']='Avenue';
        $fields['billing']['billing_address_1']['placeholder']='Block';
        $fields['billing']['billing_avenue']['required']='1';
        $fields['billing']['billing_avenue']['placeholder']='Avenue';
        $fields['billing']['billing_avenue']['priority']=55;
        $fields['billing']['billing_avenue']['class']=array(' form-row-wide');
        $fields['billing']['billing_additional_directions']['label']='Additional Directions';
        $fields['billing']['billing_additional_directions']['required']='0';
        $fields['billing']['billing_additional_directions']['type']='textarea';
        $fields['billing']['billing_additional_directions']['priority']='1';
        $fields['billing']['billing_additional_directions']['class']=array(' form-row-wide');
        unset($fields['billing']['billing_address_2']);
        unset($fields['billing']['billing_state']);
        return $fields;
    }

    add_action( 'wp_ajax_delete_catering_message', 'delete_catering_message' );
    add_action( 'wp_ajax_nopriv_delete_catering_message', 'delete_catering_message' ); 
    function delete_catering_message(){
        global $wpdb;
        $wpdb->query('delete from `im_caterings` where `id`="'.$_POST['id'].'"');
        echo json_encode(array('status'=>'true','message'=>'Catering message deleted successfully.'));
        die;
    }

    add_action( 'wp_ajax_get_address_details', 'get_address_details' );
    add_action( 'wp_ajax_nopriv_get_address_details', 'get_address_details' );
    
    function get_address_details(){
        $userId=$_POST['userId'];
        $addressId=$_POST['addressId'];
        $data=getAddressDetails($userId,$addressId);
        echo json_encode($data);
        die;
    }
    
   
    add_action( 'wp_ajax_save_price', 'save_price' );
    add_action( 'wp_ajax_nopriv_save_price', 'save_price' );

    function save_price(){        
        $price=$_POST['price'];
        if(!is_numeric($price)){
           echo json_encode(array('status'=>'false','message'=>'Stock updated successfully.'));
           die; 
        } 
        update_post_meta($_POST['id'],'_regular_price',$price);
        update_post_meta($_POST['id'],'_price',$price);
        echo json_encode(array('status'=>'true','message'=>'Price updated successfully.'));
        die;
    }

    add_action( 'wp_ajax_save_stock', 'save_stock' );
    add_action( 'wp_ajax_nopriv_save_stock', 'save_stock' );

    function save_stock(){        
        $stock=$_POST['stock'];
        if(!is_numeric($stock)){
           echo json_encode(array('status'=>'false','message'=>'Stock updated successfully.'));
           die; 
        } 
        update_post_meta($_POST['id'],'_stock',$stock);
        echo json_encode(array('status'=>'true','message'=>'Stock updated successfully.'));
        die;
    }

    add_action( 'wp_ajax_get_category_select_box', 'get_category_select_box' );
    add_action( 'wp_ajax_nopriv_get_category_select_box', 'get_category_select_box' ); 
    function get_category_select_box(){
        $taxonomy = 'product_cat';
        $getDataByTaxonomy = get_terms($taxonomy, array('hide_empty' => false));	
        $select='<select name="categoryList" id="categoryList" class="categoryList"><option value="">Select Category</option><option value="all">All</option>';
        if(!empty($getDataByTaxonomy)){
          foreach($getDataByTaxonomy as $result) {	
            $select .='<option value="'.str_replace(' ','-',strtolower($result->name)).'">'.$result->name.'</option>';    
          }  
        }
        $select.='</select>';
        echo $select;
        die;
    }


    add_action( 'wp_ajax_get_address', 'get_address' );
    add_action( 'wp_ajax_nopriv_get_address', 'get_address' );
    function get_address(){
        $address=getAddressList($_POST['userId'],'app');
        $temp='<select name="selectedAddress" class="getAddressId">';
        if(!empty($address)){            
            foreach($address as $k=>$v){
                $temp.='<option value="'.$v['addressId'].'">'.$v['addressTitle'].'</option>';   
            }           
        }else{
           $temp.='<option value="">No Address Found.</option>';    
        }
        $temp.='</select>';
        echo $temp;
        die;       
    }

    // Removes the WooCommerce filter, that is validating the quantity to be an int
    remove_filter('woocommerce_stock_amount', 'intval');

    // Add a filter, that validates the quantity to be a float
    add_filter('woocommerce_stock_amount', 'floatval');


    function reorder_admin_menu( $__return_true ) {
    return array(         
         'index.php', // Dashboard        
         'edit.php', // Posts
         'upload.php', // Media
         'themes.php', // Appearance
         'separator1', // --Space--
         'edit-comments.php', // Comments 
         'users.php', // Users
        'edit.php?post_type=page', // Pages 
         'separator2', // --Space--
         'plugins.php', // Plugins
        
         'tools.php', // Tools
         'options-general.php', // Settings
         
        
   );
}
    add_filter( 'custom_menu_order', 'reorder_admin_menu' );
    add_filter( 'menu_order', 'reorder_admin_menu' );
    
    add_action('admin_head', 'mytheme_remove_help_tabs'); 
    function mytheme_remove_help_tabs() { 
        $screen = get_current_screen();
        $screen->remove_help_tabs();
    }

    function my_login_logo() { 
       $custom_logo_id = get_theme_mod( 'custom_logo' );
       $image = site_url().'/wp-content/uploads/2017/11/admin_logo.png';
    ?>
            <style type="text/css">
                #login h1 a {
                    background-image: url(<?php echo $image; ?>);
                    background-size: 100% !important;
                    width: 120px !important;
                    height: 100px !important;
                }

                body.login.login-action-login.wp-core-ui.locale-en-us {
                    background: url(<?php echo site_url();
                    ?>/wp-content/uploads/2017/12/admin_bg.jpg) !important;
                    background-size: cover !important;
                    position: relative;
                }

                body.login.login-action-login.wp-core-ui.locale-en-us:after {
                    position: absolute;
                    content: "";
                    top: 0;
                    height: 100%;
                    width: 100%;
                    background: rgba(0, 0, 0, 0.2);
                    z-index: -1;
                }

                /* .login #backtoblog a, .login #nav a { color: #fff !important; }
            .login #backtoblog a:focus, .login #nav a:focus, .login #backtoblog a:hover, .login #nav a:hover { color: #2cc0d9 !important; }*/

            </style>
            <?php }
    add_action( 'login_enqueue_scripts', 'my_login_logo' );


    add_filter( 'post_row_actions', 'my_disable_quick_edit', 10, 2 );
    add_filter( 'page_row_actions', 'my_disable_quick_edit', 10, 2 );
    function my_disable_quick_edit( $actions = array(), $post = null ) {

        // Remove the Quick Edit link
        if ( isset( $actions['inline hide-if-no-js'] ) ) {
            unset( $actions['inline hide-if-no-js'] );
        }

        // Return the set of links without Quick Edit
        return $actions;

    }

    function example_add_dashboard_widgets() {
   /* wp_add_dashboard_widget(
             'example_dashboard_widget',         // Widget slug.
             'New Orders',         // Title.
             'example_dashboard_widget_function'
        
    );	*/
        add_meta_box( 'example_dashboard_widget', 'New Orders', 'example_dashboard_widget_function', 'dashboard', 'side', 'low' );
    }
    add_action( 'wp_dashboard_setup', 'example_add_dashboard_widgets' );



    /**
    * Create the function to output the contents of our Dashboard Widget.
    */
    function example_dashboard_widget_function() {
       require 'admin-templates/dashboard.php'; 

    }


    remove_action('welcome_panel', 'wp_welcome_panel');
    
    add_filter( 'screen_options_show_screen', '__return_false' ); 

    function my_custom_pages_columns($columns) {
        unset(
            $columns['comments']
        );
        return $columns;
    }
    add_filter( 'manage_pages_columns', 'my_custom_pages_columns' );

    function remove_extra_user_column($columns) {
        unset($columns['role']);
        unset($columns['posts']);
        return $columns;
    }
    add_filter('manage_users_columns' , 'remove_extra_user_column');  

    add_filter('manage_edit-product_columns', 'my_columns');
    function my_columns($columns) {
        unset($columns['sku']);
        unset($columns['product_tag']);
        unset($columns['featured']);
        unset($columns['language']);
        unset($columns['product_type']);
        return $columns;
    }
    add_filter('manage_edit-sliders_columns', 'remove_extra_slider_column');
    function remove_extra_slider_column($columns) {
        unset($columns['publisher']);
        unset($columns['author']);
        unset($columns['language']);
        return $columns;
    }
    add_filter('manage_edit-websliders_columns', 'remove_extra_websliders_column');
    function remove_extra_websliders_column($columns) {
        unset($columns['publisher']);
        unset($columns['author']);
        unset($columns['language']);
        return $columns;
    }
    add_filter('manage_edit-areas_columns', 'remove_extra_areas_column');
    function remove_extra_areas_column($columns) {
        unset($columns['publisher']);
        unset($columns['author']);
        unset($columns['language']);
        return $columns;
    }
    add_filter('manage_edit-shop_order_columns', 'remove_order_extra_columns');
    function remove_order_extra_columns($columns) {
        unset($columns['customer_message']);
        unset($columns['order_notes']);
        unset($columns['shipping_address']);
        $final=$columns;
        $final['billing_address']='Address';
        return $final;
    }
    



    add_action( 'manage_product_posts_custom_column', 'wpso23858236_product_column_offercode', 10, 2 );

    function wpso23858236_product_column_offercode( $column, $postid ) {
        if ( $column == 'price' ) {
            echo '<span class="edit_price" data-id="'.$postid.'">Edit</span><div class="saveDiv"></div>';
        }
        $stockAvailability=get_post_meta($postid,'_stock_status',true);
        if($column == 'is_in_stock'){
            if($stockAvailability=='instock'){
              echo '<span class="edit_stock" data-id="'.$postid.'">Edit</span><div class="saveStockDiv"></div>';  
            }            
        }
    }
    
    add_action('wp_ajax_add_catering_message','add_catering_message');
    add_action('wp_ajax_nopriv_add_catering_message','add_catering_message'); 
    function add_catering_message(){
        $data=$_POST;
        $date=strtotime(inputChangeDate($data['dateOfEvent']));
        $currentUser=get_current_user_id();
        $role='';
        if(!empty($currentUser)){
            $userData=get_user_by('id',$currentUser);  
            $role=$userData->roles[0];            
        }
        if($role!='administrator'){
            $date=strtotime(inputChangeDate($data['dateOfEvent']));
            $weekDate= strtotime(date('Y-m-d', strtotime('+1 Week')));
            if($weekDate>$date){
              response(0,null,'Date must be one week before the event date.'); 
            } 
         }
        $data['dateOfEvent']=$date;
        $addCatering=addCatering($data,'web');
        if(!empty($addCatering)){
           response(1,null,getTextByLang('Catering message added successfully.',$data['lang']));   
        }
    }


    add_action('wp_ajax_update_stock','update_stock');
    add_action('wp_ajax_nopriv_update_stock','update_stock'); 
    function update_stock(){
        update_post_meta($_POST['id'],'_stock_status',$_POST['dataval']);
        //update_post_meta($_POST['id'],'_stock',1);
        if($_POST['dataval']=='outofstock'){
            //update_post_meta($_POST['id'],'_stock',0);  
            $emailTemplate=file_get_contents(get_stylesheet_directory_uri().'/email-template.php');
            $emailTemplate=str_replace('[NAME]','Admin',$emailTemplate);
            $message='Product has been marked Out Of Stock.You can view the products.<br><a href="'.site_url().'/wp-admin/edit.php?post_type=product'.'">Clck Here</a>';  
            $emailTemplate=str_replace('[MESSAGE]',$message,$emailTemplate);
            send_email(FROM_MAIL,'Out of Stock Notification',$emailTemplate);
         }
        echo json_encode(array('status'=>'true'));
        die;
    }


    add_action('wp_ajax_get_pro_name','get_pro_name');
    add_action('wp_ajax_nopriv_get_pro_name','get_pro_name');
    function update_shipping_address(){
      pr($_POST);  
    }



    add_action('wp_ajax_get_pro_name','get_pro_name');
    add_action('wp_ajax_nopriv_get_pro_name','get_pro_name');
    function get_pro_name(){        
        $product = wc_get_product($_POST['id']);
        echo $product->get_title();
        die;
    }

   /* add_action( 'load-index.php', 'the_function', 1, 0 );
    function the_function(){
       include('admin-templates/dashboard.php'); 
    }*/
    add_action( 'woocommerce_before_save_order_items', 'so42270384_woocommerce_before_save_order_items', 10, 2 );
    function so42270384_woocommerce_before_save_order_items($order_id,$items) {
        update_post_meta($order_id,'_billing_additional_directions',$items['_billing_additional_directions']);
        update_post_meta($order_id,'_billing_building',$items['_billing_building']);
        update_post_meta($order_id,'_billing_office',$items['_billing_office']);
        update_post_meta($order_id,'_billing_floor',$items['_billing_floor']);
        update_post_meta($order_id,'_billing_apartment_number',$items['_billing_apartment_number']);
        update_post_meta($order_id,'_billing_house',$items['_billing_house']);
        update_post_meta($order_id,'addressType',$items['addressType']);
        $orderPost=get_post($order_id);        
        if($items['order_status']=='wc-completed' and trim($orderPost->post_status) !='wc-completed'){            
                $orderDetails = wc_get_order($order_id);
                $orderData = $orderDetails->get_data(); 
                $items=$orderDetails->get_items();                
                if(!empty($items)){                   
                    foreach($items as $kP=> $item) 
                    {   
                        $product_id = $item['product_id'];
                        $product_qty = $item['quantity'];
                        $cate= getProCat($item['product_id']);
                        if($cate==16){//basket
                            $productItems=get_field('select_product',$product_id);
                            if(!empty($productItems)){
                                foreach($productItems as $k=>$v){
                                    $fruitID=$v['fruit_name'][0]->ID;
                                    $fruitWeight=$v['weight'];
                                    $stockAvailability=get_post_meta($fruitID,'_stock',true);
                                    $updatedStock=$stockAvailability-$fruitWeight;
                                    update_post_meta($fruitID,'_stock',$updatedStock);
                                }
                            }
                        }
                    } 
                } 
            
        }
            
            
         
          /*   */
    }


   /* add_action( 'woocommerce_before_save_order_items', 'so42270384_woocommerce_before_save_order_items', 10, 2 );
    function so42270384_woocommerce_before_save_order_items( $order_id, $items ) {
        $itemsData['_shipping_first_name']=$items['_billing_first_name'];
        $itemsData['_shipping_last_name']=$items['_billing_last_name'];
        $itemsData['_shipping_last_name']=$items['_billing_company'];
        $itemsData['_shipping_address_1']=$items['_billing_address_1'];
        $itemsData['_shipping_address_2']=$items['_billing_address_2'];
        $itemsData['_shipping_city']=$items['_billing_city'];
        $itemsData['_shipping_postcode']=$items['_billing_postcode'];
        $itemsData['_shipping_country']=$items['_billing_country'];
        $itemsData['_shipping_state']=$items['_billing_state'];
        $itemsData['_shipping_additional_directions']=$items['_billing_additional_directions'];
        $itemsData['_shipping_building']=$items['_billing_building'];
        $itemsData['_shipping_office']=$items['_billing_office'];
        $itemsData['_shipping_floor']=$items['_billing_floor'];
        $itemsData['_shipping_apartment_number']=$items['_billing_apartment_number'];
        $itemsData['_shipping_house']=$items['_billing_house'];
        $itemsData['_shipping_email']=$items['_billing_email'];
        $itemsData['_shipping_phone']=$items['_billing_phone'];
        $itemsData['_shipping_house']=$items['_billing_house'];
       echo $user_id=get_post_meta($order_id,'_customer_user',true);die;
        foreach($itemsData as $k=>$v){
           update_post_meta($order_id,$k,$v);  
           update_user_meta($user_id,$k,$v);  
        }    
    }
*/

    add_filter( 'woocommerce_get_price_html', 'custom_price_html', 100, 2 );
    function custom_price_html( $price, $product ){
        return '<label class="price_label">'.getTextByLang('Price/Kg',qtranxf_getLanguage()) .': </label>'. str_replace( '<ins>', ' Now:<ins>', $price );
    } 
 

    add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
    function remove_dashboard_widgets () {         
          remove_meta_box( 'dashboard_quick_press',   'dashboard', 'side' );      //Quick Press widget
          remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );      //Recent Drafts
          remove_meta_box( 'dashboard_primary',       'dashboard', 'side' );      //WordPress.com Blog
          remove_meta_box( 'dashboard_secondary',     'dashboard', 'side' );      //Other WordPress News
          remove_meta_box( 'dashboard_incoming_links','dashboard', 'normal' );    //Incoming Links
          remove_meta_box( 'dashboard_plugins',       'dashboard', 'normal' );    //Plugins
          remove_meta_box( 'dashboard_activity',   'dashboard', 'normal' );      //Quick Press widget
          remove_meta_box( 'dashboard_right_now',   'dashboard', 'normal' );      //Quick Press widget
    }

   
    add_action('in_admin_footer', 'foot_monger');  

    function foot_monger () {  
        global $wpdb;
        $billing_additional_directions='';
        $billing_building='';
        $billing_office='';
        $billing_appartment='';
        $billing_house='';
        $billing_floor='';
        if(isset($_GET['action']) and $_GET['action']=='edit'){                       
         $billing_address_type=(string) get_post_meta($_GET['post'],'addressType',true);
         $billing_additional_directions=get_post_meta($_GET['post'],'_billing_additional_directions',true);
         $billing_building=get_post_meta($_GET['post'],'_billing_building',true);
         $billing_office=get_post_meta($_GET['post'],'_billing_office',true);
         $billing_appartment=get_post_meta($_GET['post'],'_billing_apartment_number',true);
         $billing_house=get_post_meta($_GET['post'],'_billing_house',true);                         
         $billing_floor=get_post_meta($_GET['post'],'_billing_floor',true);                         
        }       
                       

    ?>
            <div class="loadingAdminLoader" style="display:none;">
                <div class="Adminpreloader">
                </div>
            </div>
            <?php 
        $dashBoardUrl=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if((isset($_GET['post_type']) and $_GET['post_type']=='shop_order') or (isset($_GET['page']) and $_GET['page']=='replace-orders') or ($dashBoardUrl==site_url().'/wp-admin/index.php')){
                    ?>
            <div class="modal fade" id="productList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Stock Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body stockMessageAvailability">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a href="<?php echo site_url().'/wp-admin/edit.php?post_type=product';?>" class="btn btn-primary">Redirect to product page</a>
                        </div>
                    </div>
                </div>
            </div>
            <link rel='stylesheet' id='bootstrap-file-css' href='<?php echo site_url(); ?>/wp-content/themes/fruits/css/bootstrap.min.css?ver=1.0.0' type='text/css' />
            <script type='text/javascript' src='<?php echo site_url(); ?>/wp-content/themes/fruits/js/bootstrap.min.js?ver=4.8.4'></script>
            <?php

                }?>


                <style>
                    #postexcerpt,#tagsdiv-product_tag{
                        display: none;
                    }
                    #collapse-menu{
                        display: none;
                    }
                    .plugin-update{
                        display: none;
                    }
                    #wp-admin-bar-language,
                    .on-hold-orders,
                    .low-in-stock {
                        display: none !important;
                    }

                    /* #toplevel_page_edit-post_type-acf-field-group{
                    display:none;
                }*/

                    /*#menu-settings{
                    display:none;
                }*/

                    /*#postbox-container-2{
                    display: none;
                }*/

                    /* .sku{
                    display: none !important;
                }
                #sku{
                    display: none !important;
                }#product_tag{
                    display: none !important;
                }
                .column-product_tag{
                    display: none !important;
                } #featured{
                    display: none !important;
                } .featured {
                    display: none !important;
                } .product_type {
                    display: none !important;
                } #product_type{
                    display: none !important;
                }*/

                    .post-type-product .wc-category-search {
                        display: none !important;
                    }

                    .post-type-product #dropdown_product_type {
                        display: none !important;

                    }

                    .edit-php .select2-container {
                        display: none !important;
                    }

                    .post-type-product #post-query-submit {
                        display: none !important;

                    }

                    .add-coupon {
                        display: none !important;
                    }

                    .add-order-fee {
                        display: none !important;
                    }

                    .post-type-shop_order .categoryList {
                        display: none !important;
                    }

                    .add-order-shipping {
                        display: none !important;
                    }

                    .border_error {
                        border: 1px solid red !important;
                    }

                    .post-type-product .tablenav-pages {
                        display: none !important;
                    }

                    #wp-admin-bar-archive, #wp-admin-bar-wpseo-menu{
                        display: none;
                    }

                    #wp-admin-bar-new-content {
                        display: none;
                    }

                    #wp-admin-bar-comments {
                        display: none;
                    }

                    #wp-admin-bar-updates {
                        display: none;
                    }

                    table.meta {
                        display: none !important;
                    }

                    .refund-items {
                        display: none !important;
                    }

                    ._transaction_id_field {
                        display: none !important;
                    }

                    #woocommerce_dashboard_status .handlediv {
                        display: none;
                    }

                    #example_dashboard_widget .handlediv {
                        display: none;
                    }
                    #postbox-container-2{
                        width:100% !important;
                    }

                </style>
                <script type='text/javascript'>
                    function showAddress(type) {
                        jQuery('select[name^="addressType"] option[value="' + type + '"]').attr("selected", "selected");
                        if (type == '0') {
                            jQuery('._billing_floor_field').hide();
                            jQuery('._billing_office_field').hide();
                            jQuery('._billing_building_field').hide();
                            jQuery('._billing_apartment_number_field').hide();
                            jQuery('._billing_house_field').show();
                        } else if (type == '1') {
                            jQuery('._billing_office_field').hide();
                            jQuery('._billing_house_field').hide();
                            jQuery('._billing_apartment_number_field').show();
                            jQuery('._billing_floor_field').show();
                            jQuery('._billing_building_field').show();
                        } else if (type == '2') {
                            jQuery('._billing_apartment_number_field').hide();
                            jQuery('._billing_house_field').hide();
                            jQuery('._billing_building_field').show();
                            jQuery('._billing_floor_field').show();
                            jQuery('._billing_office_field').show();

                        }

                    }
                    jQuery('.update-nag').hide();
                    jQuery('.user-new-php #role').parent().parent().show();
                    jQuery('#toplevel_page_woocommerce ul li:last').hide();
                    jQuery('#dropdown_product_type').next().hide();
                    jQuery('#dropdown_product_type').prev().hide();
                    jQuery('.post-type-shop_order #categoryList').hide();
                    jQuery('.user-first-name-wrap th label').html('Full Name');
                    jQuery('#dashboard-widgets-wrap').prev().hide();
                    jQuery('.on-hold-orders').remove();
                    jQuery('.low-in-stock').remove();
                    jQuery('.loadingAdminLoader').show();
                    jQuery(window).load(function() {
                        jQuery('.loadingAdminLoader').hide();
                    });
                    jQuery('#menu-item-794').children().attr('href','javascript:void(0)');
                    jQuery(document).ready(function() {
                        jQuery('.loadingAdminLoader').hide();
                        jQuery('.upgrade').hide();
                        jQuery('.processing').each(function(e, v) {
                            var url = jQuery(this).attr('href');
                            jQuery(this).attr('data-attr-val', url);
                            jQuery(this).attr('href', 'javascript:void(0)');
                            jQuery(this).addClass('checkProcessingState');
                        });
                        jQuery('#dashboard-widgets-wrap').prev().hide();
                        jQuery('#toplevel_page_catering ul li:nth-child(3)').hide();
                        jQuery('.toplevel_page_export_csv').hide();
                        jQuery('.add-line-item').trigger('click');
                        jQuery(document).on('click', '#order_line_items .item', function() {
                            jQuery(this).removeClass('selected');
                            jQuery('.wc-order-item-bulk-edit').remove();

                        });
                        jQuery('.on-hold-orders').remove();
                        jQuery('.low-in-stock').remove();
                        <?php    
            if(isset($_GET['post']) and isset($_GET['action'])){
            if(!empty($_GET['post']) and $_GET['action']=='edit'){
            $postDetails=get_post($_GET['post']);
            if($postDetails->post_type=='shop_order'){
            if($postDetails->post_status=='wc-completed'){
            ?>
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li.wp-first-item').removeClass('current');
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li:nth-child(5)').addClass('current');
                        <?php
            }elseif($postDetails->post_status=='wc-refunded'){
            ?>
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li.wp-first-item').removeClass('current');
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li:nth-child(7)').addClass('current');
                        <?php  
            }elseif($postDetails->post_status=='wc-processing'){
            ?>
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li.wp-first-item').removeClass('current');
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li:nth-child(4)').addClass('current');
                        <?php 
            }elseif($postDetails->post_status=='wc-cancelled'){
            ?>
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li.wp-first-item').removeClass('current');
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li:nth-child(8)').addClass('current');
                        <?php  
            }elseif($postDetails->post_status=='wc-pending'){
            ?>
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li.wp-first-item').removeClass('current');
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li:nth-child(3)').addClass('current');
                        <?php  
            }
            }                
            }

            }
            if(isset($_GET['post_status']) and isset($_GET['post_type'])){
            if($_GET['post_type']=='shop_order'){
            if($_GET['post_status']=='wc-completed'){
            ?>
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li.wp-first-item').removeClass('current');
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li:nth-child(5)').addClass('current');
                        <?php
            }
                elseif($_GET['post_status']=='wc-refunded'){
            ?>
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li.wp-first-item').removeClass('current');
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li:nth-child(6)').addClass('current');
                        <?php  
            }
                elseif($_GET['post_status']=='wc-pending'){
            ?>
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li.wp-first-item').removeClass('current');
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li:nth-child(3)').addClass('current');
                        <?php 
            }
                elseif($_GET['post_status']=='wc-processing'){
            ?>
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li.wp-first-item').removeClass('current');
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li:nth-child(4)').addClass('current');
                        <?php 
            }elseif($_GET['post_status']=='wc-cancelled'){
            ?>
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li.wp-first-item').removeClass('current');
                        jQuery('.post-type-shop_order #toplevel_page_woocommerce ul li:nth-child(8)').addClass('current');
                        <?php  
            }
            }

            }
            if(isset($_GET['page']) and $_GET['page']=='wc-reports'){
            ?>

                        jQuery('.all-orders_page_wc-reports .woo-nav-tab-wrapper a:last').hide();


                        <?php
            if(isset($_GET['tab'])){
            if($_GET['tab']!='customers'){
            ?>
                        jQuery('.all-orders_page_wc-reports .subsubsub li:last').hide();
                        jQuery('.all-orders_page_wc-reports  ul.chart-legend li:last-child').hide();
                        jQuery('.all-orders_page_wc-reports  ul.chart-legend li:last-child').prev().hide();
                        <?php
            }                   
            }else{
            ?>
                        jQuery('.all-orders_page_wc-reports .subsubsub li:last').hide();
                        jQuery('.all-orders_page_wc-reports  ul.chart-legend li:last-child').hide();
                        jQuery('.all-orders_page_wc-reports  ul.chart-legend li:last-child').prev().hide();
                        <?php
            } 
            if(isset($_GET['report']) and $_GET['report']=='sales_by_product'){
            ?>
                        jQuery('li.chart-widget .section').hide();
                        jQuery('li.chart-widget .section_title').hide();
                        jQuery('.chart-widgets li h4:first').show();
                        <?php
            }
            }
            if(isset($_GET['post_type']) and $_GET['post_type']=='shop_order'){
               if($_GET['post_status']=='wc-processing'){
                    $customer_orders =$wpdb->get_results('select * from `im_posts` where `post_status`="wc-processing" and `post_type`="shop_order" and `post_status`!="trash" order by ID desc');
                    $totalprice=0;
                    if(!empty($customer_orders)){
                       foreach($customer_orders as $k=>$v){
                           $user=get_user_by('id',$v->post_author);  
                           $orderDetails = wc_get_order($v->ID);
                           $orderData = $orderDetails->get_data(); 
                           $totalprice+=$orderData['total'];
                       }
                    }
                   ?>
                        jQuery('.wp-list-table').prev().prev().append('<p class="amountAssigned"> <strong>Total Amount </strong>: <?php echo $totalprice; ?> KD</p>');
                        <?php
                   
               }elseif($_GET['post_status']=='wc-completed'){
                   $customer_orders =$wpdb->get_results('select * from `im_posts` where `post_status`="wc-completed" and `post_type`="shop_order"  and `post_status`!="trash"  order by ID desc');
                    $totalpriceComplete=0;
                    if(!empty($customer_orders)){
                       foreach($customer_orders as $k=>$v){
                           $user=get_user_by('id',$v->post_author);  
                           $orderDetails = wc_get_order($v->ID);
                           $orderData = $orderDetails->get_data(); 
                           $totalpriceComplete+=$orderData['total'];
                       }
                    }?>
                        jQuery('.wp-list-table').prev().prev().append('<p class="amountAssigned"> <strong>Total Amount </strong>: <?php echo $totalpriceComplete; ?> KD</p>');
                        <?php   

               }
                 elseif($_GET['post_status']=='wc-refunded'){
                    $customer_orders =$wpdb->get_results('select * from `im_posts` where `post_status`="wc-refunded" and `post_type`="shop_order"  and `post_status`!="trash" order by ID desc');
                    $totalpriceCheck=0;
                    if(!empty($customer_orders)){
                       foreach($customer_orders as $k=>$v){
                           $user=get_user_by('id',$v->post_author);  
                           $orderDetails = wc_get_order($v->ID);
                           $orderData = $orderDetails->get_data(); 
                           $totalpriceCheck+=$orderData['total'];
                       }
                    }?>
                        jQuery('.wp-list-table').prev().prev().append('<p class="amountAssigned"> <strong>Total Amount </strong>: <?php echo $totalpriceCheck; ?> KD</p>');
                        <?php


               }
                 elseif($_GET['post_status']=='wc-cancelled'){
                    $customer_orders =$wpdb->get_results('select * from `im_posts` where `post_status`="wc-cancelled" and `post_type`="shop_order"  and `post_status`!="trash"  order by ID desc');
                    $totalprice=0;
                    if(!empty($customer_orders)){
                       foreach($customer_orders as $k=>$v){
                           $user=get_user_by('id',$v->post_author);  
                           $orderDetails = wc_get_order($v->ID);
                           $orderData = $orderDetails->get_data(); 
                           $totalprice+=$orderData['total'];
                       }
                    }?>
                        jQuery('.wp-list-table').prev().prev().append('<p class="amountAssigned"> <strong>Total Amount </strong>: <?php echo $totalprice; ?> KD</p>');
                        <?php


               }
                 else{
                 $customer_orders =$wpdb->get_results('select * from `im_posts` where `post_type`="shop_order"  and `post_status`!="trash"  order by ID desc');
                    $totalprice=0;
                    if(!empty($customer_orders)){
                       foreach($customer_orders as $k=>$v){
                           $user=get_user_by('id',$v->post_author);  
                           $orderDetails = wc_get_order($v->ID);
                           $orderData = $orderDetails->get_data(); 
                           $totalprice+=$orderData['total'];
                       }
                    }?>
                        jQuery('.wp-list-table').prev().prev().append('<p class="amountAssigned"> <strong>Total Amount </strong>: <?php echo $totalprice; ?> KD</p>');
                        <?php  
               }
            }
            ?>
                        jQuery('#order_total a').children().html('Amount');
                        jQuery('.column-order_total a').children().html('Amount');
                        <?php
               if(isset($_GET['page']) and $_GET['page']=='custom_options_plus'){
                   ?>
                        jQuery('#toplevel_page_basic-settings').addClass('current');
                        <?php
               } 
       
           ?>
                        var checkDataVal = jQuery('#new-custom-option').prev().val();
                        if (checkDataVal == '') {
                            jQuery('#new-custom-option').parent().hide();
                        }
                        jQuery('#cop-import-form').prev().prev().hide();
                        jQuery('#icon-tools').next().html('Settings');
                        jQuery('#cop-import-form').prev().hide();
                        jQuery('#cop-import-form').hide();
                        jQuery('#cop-export').prev().prev().hide();
                        jQuery('#cop-export').prev().hide();
                        jQuery('#cop-export').hide();
                        jQuery('#wp-admin-bar-archive').hide();
                        jQuery('.refund-items').parent().parent().hide();

                        jQuery('#dropdown_product_type').next().hide();
                        jQuery('#dropdown_product_type').prev().hide();
                        jQuery('#toplevel_page_woocommerce ul li:last').hide();
                        <?php  if($_GET['page']=='wc-reports'){
            ?>
                        jQuery('#toplevel_page_woocommerce').removeClass('wp-has-current-submenu');
                        jQuery('#toplevel_page_reports').removeClass('wp-not-current-submenu');
                        jQuery('#toplevel_page_reports').addClass('current');
                        <?php
            }
           ?>
                        jQuery('.user-new-php #role').parent().parent().show();
                        jQuery('.user-edit-php .user-role-wrap').hide();
                        jQuery('.user-edit-php .user-display-name-wrap').hide();
                        jQuery('.user-edit-php .user-nickname-wrap').hide();
                        if (jQuery('body').hasClass('post-type-product')) {
                            jQuery('#wp-content-media-buttons').hide();
                        }
                        jQuery('#createuser').prev().hide();
                        jQuery('#url').parent().parent().hide();
                        jQuery('#new_role').parent().hide();
                        jQuery('#createuser table tr:last').hide();
                        jQuery('#welcome-panel').prev().hide();
                        jQuery('#woocommerce_dashboard_status h2 span').html('Order Status');
                        jQuery('.add-coupon').html('');
                        jQuery(document).on('click', '.calculate-action', function() {
                            jQuery('.add-coupon').hide();
                        });
                        jQuery("#draggable").draggable({
                            axis: "y",
                            drag: function(event, obj) {
                                if (obj.position.top > 0) {
                                    obj.position.top = 0;
                                }
                            },

                        });
                        jQuery('.order_data_column_container .order_data_column:nth-child(3)').hide();
                        jQuery('#dropdown_product_type option:nth-child(3)').hide();
                        jQuery('#catalog-visibility').hide();
                        jQuery('#wp-admin-bar-updates').hide();
                        jQuery('#wp-admin-bar-comments').hide();
                        jQuery('#wp-admin-bar-new-content').hide();
                        jQuery('.add-order-fee').hide();
                        jQuery('.add-order-shipping').hide();
                        jQuery('.add-coupon').hide();
                        jQuery('#woocommerce-order-downloads').hide();
                        jQuery('#postcustom').hide();
                        jQuery('#my-shipping').parent().hide();
                        jQuery('#my-coupons').parent().hide();
                        jQuery('#my-misc').parent().hide();
                        jQuery('#product_cat-adder').hide();
                        jQuery('#dropdown_product_type').hide();
                        jQuery('#dropdown_product_type option:nth-child(4)').hide();
                        jQuery('#menu-posts-areas .dashicons-before').removeClass('dashicons-admin-post').addClass('dashicons-grid-view');
                        jQuery('#menu-posts-sliders .dashicons-before').removeClass('dashicons-admin-post').addClass('dashicons-align-left');
                        jQuery('#toplevel_page_language-settings .dashicons-before').removeClass('dashicons-admin-generic').addClass('dashicons-translation');
                        jQuery('#toplevel_page_edit-post_type-acf-field-group').hide();
                        jQuery('#menu-settings').hide();
                        jQuery('#fieldset-billing').next().html('');
                        jQuery('#fieldset-billing').prev().html('');
                        jQuery('#qtranslate_highlight_enabled').parent().parent().parent().parent().hide();
                        jQuery('#qtranslate_highlight_enabled').parent().parent().parent().parent().prev().html('');
                        jQuery('#woocommerce-product-data').find('span>span').hide();
                        jQuery('#footer-left').hide();
                        jQuery('.user-url-wrap').hide();
                        jQuery('.user-description-wrap').hide();
                        jQuery('.user-description-wrap').parent().parent().prev().html('');
                        jQuery('.user-rich-editing-wrap').parent().parent().hide();
                        jQuery('.user-user-login-wrap').parent().parent().prev().html('');
                        jQuery('.user-profile-picture').hide();
                        jQuery('#fieldset-shipping').hide();
                        jQuery('#fieldset-billing').hide();
                        jQuery('#qtranxs-meta-box-lsb').hide();
                        jQuery('.shipping_tab').hide();
                        jQuery('.linked_product_tab').hide();
                        jQuery('.advanced_tab').hide();
                        jQuery('._backorders_field').hide();
                        jQuery('._sold_individually_field').hide();
                        jQuery('.attribute_tab').hide();
                        jQuery('._sku_field').hide();
                        jQuery('._sale_price_field').hide();
                        jQuery('#footer-upgrade').hide();
                        jQuery('#billing_address').html('Address');
                        jQuery('table tfoot tr th.column-billing_address').html('Address');
                        jQuery('.update-nag').hide();
                        jQuery('#menu-dashboard ul li:nth-child(3)').hide();
                        jQuery('#menu-posts-product ul li:nth-child(5)').hide();
                        jQuery('#menu-posts-product ul li:nth-child(4)').hide();
                        jQuery('#menu-posts-product ul li:nth-child(6)').hide();
                        jQuery('#toplevel_page_edit-post_type-acf-field-group ul li:nth-child(3)').hide();
                        jQuery('#toplevel_page_edit-post_type-acf-field-group ul li:nth-child(4)').hide();
                        jQuery('#toplevel_page_edit-post_type-acf-field-group ul li:nth-child(6)').hide();
                        jQuery('#tabs a').hide();
                        jQuery('#export-wo-pb-btn').hide();
                        jQuery('#tabs a:first').show();
                        jQuery('.woocommerce-Price-currencySymbol').html('KD ');

                        jQuery(document).on('click', '.order_data_column_container .order_data_column:nth-child(2) .edit_address', function() {
                            var checkBillingAddress = jQuery('#checkBillingAddress').val();
                            if (checkBillingAddress == 'yes') {
                                return false;
                            } else {
                                jQuery('#checkBillingAddress').val('yes');
                            }
                            jQuery('.load_customer_billing').hide();
                            jQuery('.paymentMethod').hide();
                            jQuery('._billing_last_name_field').after('<p class="form-field _billing_adresstype_field "><label for="_billing_house">Address Type</label><select name="addressType" class="adminAddress"><option value="">Select Address Type</option><option value="0">Home</option><option value="1">Appartment</option><option value="2">Office</option></select></p>');
                            jQuery('#_billing_company').prev().html('Area');
                            jQuery('#_billing_address_1').prev().html('Block');
                            jQuery('#_billing_state').prev().html('Avenue');
                            jQuery('#_billing_city').prev().html('Street');
                            jQuery('._billing_state_field').after('<p class="form-field _billing_house_field "><label for="_billing_house">House</label><input type="text" class="short" style="" name="_billing_house" id="_billing_house" value="<?php echo @$billing_house;?>" placeholder=""> </p>');
                            jQuery('._billing_state_field').after('<p class="form-field _billing_apartment_number_field "><label for="_billing_apartment_number_field">Apartment Number</label><input type="text" class="short" value="<?php echo @$billing_appartment;?>" name="_billing_apartment_number" id="_billing_apartment_number" value="" placeholder=""> </p>');
                            jQuery('._billing_state_field').after('<p class="form-field _billing_floor_field "><label for="_billing_floor_field">Floor</label><input type="text" class="short" style="" name="_billing_floor" id="_billing_floor" value="<?php echo @$billing_floor;?>" placeholder=""></p>');
                            jQuery('._billing_state_field').after('<p class="form-field _billing_office_field "><label for="_billing_office_field">Office</label><input type="text" class="short" style="" name="_billing_office" id="_billing_office" value="<?php echo @$billing_office;?>" placeholder=""> </p>');
                            jQuery('._billing_state_field').after('<p class="form-field _billing_building_field "><label for="_billing_building_field">Building</label><input type="text" class="short" style="" name="_billing_building" id="_billing_building" value="<?php echo @$billing_building;?>" placeholder=""> </p>');
                            jQuery('._billing_state_field').after('<p class="form-field _billing_additional_directions_field "><label for="_billing_additional_directions_field">Additional Directions</label><input type="text" class="short" style="" name="_billing_additional_directions" id="_billing_additional_directions" value="<?php echo @$billing_additional_directions;?>" placeholder=""> </p>');
                            showAddress('<?php echo @$billing_address_type;?>');



                        });
                        jQuery(document).on('change', '.adminAddress', function() {
                            jQuery('.loadingAdminLoader').show();
                            var $this = jQuery(this).val();
                            if ($this == '0') {
                                jQuery('._billing_floor_field').hide();
                                jQuery('._billing_office_field').hide();
                                jQuery('._billing_building_field').hide();
                                jQuery('._billing_apartment_number_field').hide();
                                jQuery('._billing_house_field').show();
                            } else if ($this == '1') {
                                jQuery('._billing_office_field').hide();
                                jQuery('._billing_house_field').hide();
                                jQuery('._billing_apartment_number_field').show();
                                jQuery('._billing_floor_field').show();
                                jQuery('._billing_building_field').show();
                            } else if ($this == '2') {
                                jQuery('._billing_apartment_number_field').hide();
                                jQuery('._billing_house_field').hide();
                                jQuery('._billing_building_field').show();
                                jQuery('._billing_floor_field').show();
                                jQuery('._billing_office_field').show();

                            }
                            jQuery('.loadingAdminLoader').hide();
                        });



                        jQuery(document).on('change', '#customer_user', function() {
                            jQuery('.loadingAdminLoader').show();
                            var customerId = jQuery(this).val();
                            jQuery.ajax({
                                url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                                data: {
                                    action: 'get_address',
                                    userId: customerId
                                },
                                type: 'post',
                                success: function(resp) {
                                    jQuery('.loadingAdminLoader').hide();
                                    jQuery('.order_data_column_container .order_data_column:nth-child(2) span').html(resp);
                                }
                            });
                        });
                        jQuery(document).on('change', '.getAddressId', function() {
                            jQuery('.loadingAdminLoader').show();
                            var customerId = jQuery('#customer_user').val();
                            var addressId = jQuery(this).val();
                            jQuery.ajax({
                                url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                                data: {
                                    action: 'get_address_details',
                                    userId: customerId,
                                    addressId: addressId
                                },
                                type: 'post',
                                dataType: 'json',
                                success: function(resp) {
                                    jQuery('.loadingAdminLoader').hide();
                                    jQuery('#_billing_company').val(resp.area);
                                    jQuery('#_billing_address_1').val(resp.block);
                                    jQuery('#_billing_city').val(resp.street);
                                    jQuery('#_billing_state').val(resp.avenue);
                                    jQuery('#_billing_additional_directions').val(resp.additionalDirections);
                                    jQuery('#_billing_building').val(resp.building);
                                    jQuery('#_billing_office').val(resp.office);
                                    jQuery('#_billing_floor').val(resp.floor);
                                    jQuery('#_billing_apartment_number').val(resp.apartmentNumber);
                                    jQuery('#_billing_house').val(resp.house);
                                    jQuery('#_shipping_company').val(resp.area);
                                    jQuery('#_shipping_address_1').val(resp.block);
                                    jQuery('#_shipping_city').val(resp.street);
                                    jQuery('#_shipping_state').val(resp.avenue);
                                    jQuery('#_shipping_additional_directions').val(resp.additionalDirections);
                                    jQuery('#_shipping_building').val(resp.building);
                                    jQuery('#_shipping_office').val(resp.office);
                                    jQuery('#_shipping_floor').val(resp.floor);
                                    jQuery('#_shipping_apartment_number').val(resp.apartmentNumber);
                                    jQuery('#_shipping_house').val(resp.house);
                                    console.log(resp);
                                }
                            });
                        });
                        jQuery(document).on('click', '.viewCateringMessage', function() {
                            jQuery('.loadingAdminLoader').show();
                            var id = jQuery(this).attr('data-id');
                            jQuery.ajax({
                                url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                                data: {
                                    action: 'get_catering_message',
                                    id: id
                                },
                                type: 'post',
                                dataType: 'json',
                                success: function(resp) {
                                    jQuery('.loadingAdminLoader').hide();
                                    jQuery('#cater-name').html(resp.data.name);
                                    jQuery('#cater-email').html(resp.data.email);
                                    jQuery('#cater-phone').html(resp.data.phoneNumber);
                                    jQuery('#cater-msg').html(resp.data.description);
                                    jQuery('#cater-price').html(resp.data.price + 'د.ك');
                                    jQuery('#cater-number').html(resp.data.numberOfAttendees);
                                    jQuery('#cater-date').html(resp.data.neweventdate);
                                    jQuery('#viewDesc').modal('show');
                                }
                            });
                        });
                        jQuery(document).on('click', '.editCateringMessage', function() {
                            jQuery('.loadingAdminLoader').show();
                            var id = jQuery(this).attr('data-id');
                            jQuery.ajax({
                                url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                                data: {
                                    action: 'get_catering_message',
                                    id: id
                                },
                                type: 'post',
                                dataType: 'json',
                                success: function(resp) {
                                    jQuery('.loadingAdminLoader').hide();
                                    jQuery('#edit-name').html(resp.data.name);
                                    jQuery('#edit-email').html(resp.data.email);
                                    jQuery('#edit-date').html(resp.data.neweventdate);
                                    jQuery('#catId').val(resp.data.id);
                                    jQuery('#edit-price').val(resp.data.price);
                                    jQuery('#EditCateringMessage').modal('show');
                                }
                            });
                        });
                        jQuery(document).on('click', '.deleteCateringMessage', function() {
                            jQuery('.loadingAdminLoader').show();
                            var id = jQuery(this).attr('data-id');
                            $this = jQuery(this);
                            var text = confirm('Are you sure you want to delete?');
                            console.log(text);
                            if (text == false) {
                                return false;
                            }
                            jQuery.ajax({
                                url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                                data: {
                                    action: 'delete_catering_message',
                                    id: id
                                },
                                type: 'post',
                                dataType: 'json',
                                success: function(resp) {
                                    jQuery('.loadingAdminLoader').hide();
                                    if (resp.status == 'true') {
                                        $this.parent().parent().remove();
                                        jQuery('.cateringResp').show();
                                        jQuery('.cateringResp').delay(3000).fadeOut();
                                    }
                                }
                            });
                        });
                        jQuery(document).on('click', '.saveCatering', function() {
                            jQuery('.loadingAdminLoader').show();
                            var id = jQuery('#catId').val();
                            var price = jQuery('#edit-price').val();
                            jQuery.ajax({
                                url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                                data: {
                                    action: 'save_catering',
                                    id: id,
                                    price: price
                                },
                                type: 'post',
                                dataType: 'json',
                                success: function(resp) {
                                    jQuery('.loadingAdminLoader').hide();
                                    jQuery('.' + id).html(price + 'KD');
                                    jQuery('.cateMessage').html('<div class="alert alert-success alert-dismissable">' + resp.message + '</div>');
                                    jQuery('.cateMessage').delay(3000).fadeOut();
                                    setTimeout(function() {
                                        jQuery('#EditCateringMessage').modal('hide');
                                    }, 4000);
                                }
                            });
                        });
                        jQuery('#output_preview_csv tr').each(function() {
                            if (!jQuery.trim(jQuery(this).text())) jQuery(this).remove();
                        });
                        jQuery('.user-new-php #role').parent().parent().show();
                        jQuery(document).on('click', '.edit_price', function() {
                            jQuery('.saveDiv').hide();
                            jQuery('.edit_price').show();
                            var id = jQuery(this).attr('data-id');
                            jQuery(this).next().html('<input type="text" name="priceVal"/><a data-id="' + id + '" class="save_price" href="javascript:void(0);">save</a>');
                            jQuery(this).next().show();
                            jQuery(this).hide();
                        });
                        jQuery(document).on('click', '.save_price', function() {
                            var id = jQuery(this).attr('data-id');
                            var price = jQuery(this).prev().val();
                            if (price == '') {
                                jQuery(this).prev().addClass('border_error');
                                return false;
                            }
                            jQuery('.loadingAdminLoader').show();
                            jQuery(this).prev().removeClass('border_error');
                            var currency = jQuery('.woocommerce-Price-currencySymbol').html();
                            $this = jQuery(this);
                            jQuery.ajax({
                                data: {
                                    id: id,
                                    price: price,
                                    action: 'save_price'
                                },
                                url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                                dataType: 'json',
                                type: 'post',
                                success: function(resp) {
                                    jQuery('.loadingAdminLoader').hide();
                                    if (resp.status == 'true') {
                                        $this.parent().prev().prev().html('<span class="woocommerce-Price-currencySymbol">' + currency + '</span>' + price);
                                        $this.parent().prev().show();
                                        $this.parent().hide();

                                    } else {
                                        $this.prev().addClass('border_error');
                                        return false;
                                    }
                                }
                            });

                        });
                        jQuery(document).on('click', '.edit_stock', function() {
                            jQuery('.saveStockDiv').hide();
                            jQuery('.edit_stock').show();
                            var id = jQuery(this).attr('data-id');
                            jQuery(this).next().html('<input type="text" name="stockVal"/><a data-id="' + id + '" class="save_stock" href="javascript:void(0);">save</a>');
                            jQuery(this).next().show();
                            jQuery(this).hide();
                        });
                        jQuery(document).on('click', '.save_stock', function() {
                            var id = jQuery(this).attr('data-id');
                            var stock = jQuery(this).prev().val();
                            if (stock == '') {
                                jQuery(this).prev().addClass('border_error');
                                return false;
                            }
                            jQuery('.loadingAdminLoader').show();
                            jQuery(this).prev().removeClass('border_error');
                            $this = jQuery(this);
                            jQuery.ajax({
                                data: {
                                    id: id,
                                    stock: stock,
                                    action: 'save_stock'
                                },
                                url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                                dataType: 'json',
                                type: 'post',
                                success: function(resp) {
                                    jQuery('.loadingAdminLoader').hide();
                                    if (resp.status == 'true') {
                                        $this.parent().prev().show();
                                        $this.parent().hide();
                                        text = $this.parent().parent().attr('class');
                                        text = text.replace(' ', ' .');
                                        demo = $this.parent().parent().children().html();
                                        var a = $this.parent().parent().first().contents().filter(function() {
                                            return this.nodeType == 3;
                                        }).remove();
                                        $this.parent().prev().prev().html(demo + '<span class="stockClass">(' + stock + ')</span>');
                                    } else {
                                        $this.prev().addClass('border_error');
                                        return false;
                                    }
                                }
                            });

                        });
                        jQuery.ajax({
                            url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                            data: {
                                action: 'get_category_select_box'
                            },
                            type: 'post',
                            success: function(response) {
                                jQuery('.search-box').prepend(response);
                            }

                        });
                        jQuery(document).on('change', '#categoryList', function() {
                            jQuery('.loadingAdminLoader').show();
                            var cat = jQuery(this).val();
                            if (cat == 'all') {
                                window.location.href = '<?php echo site_url(); ?>/wp-admin/edit.php?post_type=product';
                            } else {
                                window.location.href = '<?php echo site_url(); ?>/wp-admin/edit.php?s&post_status=all&post_type=product&action=-1&product_cat=' + cat + '&product_type&filter_action=Filter&paged=1&action2=-1';
                            }
                        });

                        jQuery('table.dataTable tr.odd').css('background', 'none');
                        jQuery('table.dataTable tr.odd td.sorting_1').css('background', 'none');
                        jQuery('table.dataTable tr.even td.sorting_1').css('background', 'none');
                        var orderstatus = jQuery('#order_status').val();
                        if (orderstatus == 'wc-bad-order' || orderstatus == 'wc-refunded') {
                            jQuery('#reasonMessage').attr('required', true);
                        } else {
                            jQuery('#reasonMessage').removeAttr('required');
                        }
                        jQuery(document).on('change', '#order_status', function() {
                            var orderstatus = jQuery(this).val();
                            if (orderstatus == 'wc-bad-order' || orderstatus == 'wc-refunded') {
                                jQuery('#reasonMessage').attr('required', true);
                            } else {
                                jQuery('#reasonMessage').removeAttr('required');
                            }
                        });
                        jQuery(document).on('click', '#exportCsv', function() {
                            var type = jQuery(this).attr('data-val');
                            jQuery.ajax({
                                data: {
                                    type: type,
                                    action: 'export_csv'
                                },
                                url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                                dataType: 'json',
                                type: 'post',
                                success: function(resp) {

                                }
                            });
                        });
                        jQuery(document).on('change', '.manageStock', function() {
                            jQuery('.loadingAdminLoader').show();
                            var id = jQuery(this).attr('data-val');
                            var dataval = jQuery(this).val();
                            jQuery.ajax({
                                data: {
                                    id: id,
                                    dataval: dataval,
                                    action: 'update_stock'
                                },
                                url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                                dataType: 'json',
                                type: 'post',
                                success: function(resp) {
                                    jQuery('.loadingAdminLoader').hide();
                                    if (resp.status == 'true') {
                                        alert('Stock Status updation is in process.');
                                        window.location.href = '<?php echo site_url(); ?>/wp-admin/edit.php?post_type=product';
                                    } else {

                                    }
                                }
                            });



                        });

                        jQuery(document).on('click', '.notDelete', function() {
                            alert('No records founds to delete.');
                            return false;

                        });
                        jQuery(document).on('click', '.deleteAllCatering', function() {

                            var test = confirm('Are you sure to delete all catering records?');
                            if (test == false) {
                                return false;
                            }
                            jQuery('.loadingAdminLoader').show();
                            jQuery.ajax({
                                data: {
                                    action: 'deleteAllCatering'
                                },
                                url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                                dataType: 'json',
                                type: 'post',
                                success: function(resp) {
                                    jQuery('.loadingAdminLoader').hide();
                                    if (resp.status == 'true') {
                                        alert('All Records has been deleted.');
                                        window.location.href = '<?php echo site_url(); ?>/wp-admin/admin.php?page=catering';
                                    } else {

                                    }
                                }
                            });

                        });


                        jQuery(document).on('click', '.save_order', function() {
                            var post_id = jQuery('#post_ID').val();
                            jQuery.ajax({
                                url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                                data: {
                                    action: 'update_shipping_address',
                                    post_id: post_id
                                },
                                type: 'post',
                                success: function(response) {

                                }

                            });
                        });
                        jQuery(document).on('click', '.checkProcessingState', function() {
                            jQuery('.loadingAdminLoader').show();
                            var order_id = jQuery(this).parent().parent().parent().attr('id');
                            var processingUrl = jQuery(this).attr('data-attr-val');
                            jQuery.ajax({
                                url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                                data: {
                                    action: 'checkStockProcessing',
                                    post_id: order_id,
                                    processingUrl:processingUrl
                                },
                                type: 'post',
                                dataType: 'json',
                                success: function(response) {
                                    jQuery('.loadingAdminLoader').hide();
                                    if (response.status == 'false') {
                                        jQuery('.stockMessageAvailability').html(response.message);
                                        jQuery('#productList').modal('show');
                                    } else {
                                        //console.log(processingUrl);
                                        window.location.href = processingUrl;
                                    }
                                }

                            });
                        });

                        jQuery('span.duplicate').hide();
                        jQuery('.user-last-name-wrap').hide();
                        jQuery('.user-first-name-wrap th label').html('Full Name');
                        /*  jQuery('.wc-order-item-bulk-edit').show();
                               jQuery('.bulk-delete-items').hide();
                               jQuery('.bulk-decrease-stock').show();
                               jQuery('.bulk-increase-stock').hide();         
                        */
                        jQuery(document).on('change', '#order_status', function() {
                            jQuery('.loadingAdminLoader').show();
                            var test = jQuery(this).val();
                            var orderId = jQuery('#post_ID').val();
                            if (test == 'wc-processing') {
                                jQuery.ajax({
                                    url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                                    data: {
                                        action: 'check_stock_status_at_the_time_of_status_change',
                                        orderId: orderId
                                    },
                                    type: 'post',
                                    dataType: 'json',
                                    success: function(response) {
                                        jQuery('.loadingAdminLoader').hide();
                                        if (response.status == 'false') {
                                            alert(response.message);
                                            return false;
                                        }
                                    }

                                });
                            } else {
                                jQuery('.loadingAdminLoader').hide();
                            }
                        });
                        jQuery(document).on('click', '.maxQu', function() {
                            jQuery('.maxQu').next().hide();
                            jQuery(this).next().show();
                            jQuery(this).next().show();
                        });
                        jQuery(document).on('click', '.save_quantity', function() {
                            var id = jQuery(this).attr('data-id');
                            var quantity = jQuery(this).prev().val();
                            if (quantity == '') {
                                jQuery(this).prev().addClass('border_error');
                                return false;
                            }
                            jQuery('.loadingAdminLoader').show();
                            jQuery(this).prev().removeClass('border_error');
                            $this = jQuery(this);
                            jQuery.ajax({
                                data: {
                                    id: id,
                                    quantity: quantity,
                                    action: 'save_quantity'
                                },
                                url: '<?php echo site_url(); ?>/wp-admin/admin-ajax.php',
                                dataType: 'json',
                                type: 'post',
                                success: function(resp) {
                                    jQuery('.loadingAdminLoader').hide();
                                    if (resp.status == 'true') {
                                        $this.val(quantity);
                                        $this.prev().val(quantity);
                                        $this.parent().prev().prev().html(quantity);
                                        $this.parent().hide();
                                    }
                                }
                            });

                        });
                    });
                   /* jQuery('.index-php #postbox-container-2').hide();*/
                    jQuery('.index-php #postbox-container-3').hide();
                    jQuery('.index-php #postbox-container-4').hide();

                </script>
                <?php   } 
    /* end Admin Panel */
     function outputCsv($fileName, $assocDataArray)
    {
        ob_clean();
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false);
        header('Content-Type: text/csv');
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Disposition: attachment;filename=' . $fileName);    
        if(isset($assocDataArray['0'])){
            $fp = fopen('php://output', 'w');
            fputcsv($fp, array_keys($assocDataArray['0']));
            foreach($assocDataArray AS $values){
                fputcsv($fp, $values);
            }
            fclose($fp);
        }
        ob_flush();
    }

    function getLastNDaysData($days, $format = 'Y-m-d'){
    $m = date("m"); $de= date("d"); $y= date("Y");
    $dateArray = array();
    for($i=0; $i<=$days-1; $i++){
        $dateArray[] = date($format, mktime(0,0,0,$m,($de-$i),$y)); 
    }
    return array_reverse($dateArray);
}
    /* start frontend funciton */
    add_action('wp_ajax_ajax_dashboard', 'ajax_dashboard');
    add_action('wp_ajax_nopriv_ajax_dashboard', 'ajax_dashboard');
    function ajax_dashboard(){
        require 'admin-templates/ajax_dashboard.php'; 
        die;
    }


    add_action('wp_ajax_save_quantity', 'save_quantity');
    add_action('wp_ajax_nopriv_save_quantity', 'save_quantity');
    function save_quantity(){
        global $wpdb;
        update_post_meta($_POST['id'],'enter_max_quantity_user_can_buy',$_POST['quantity']);
        echo json_encode(array('status'=>'true'));
        die;
    }

    add_action('wp_ajax_deleteAllCatering', 'deleteAllCatering');
    add_action('wp_ajax_nopriv_deleteAllCatering', 'deleteAllCatering');
    function deleteAllCatering(){
        global $wpdb;
        $wpdb->query('truncate table `im_caterings`');
        echo json_encode(array('status'=>'true'));
        die;
    }


    add_action('wp_ajax_check_stock_status_at_the_time_of_status_change', 'check_stock_status_at_the_time_of_status_change');
    add_action('wp_ajax_nopriv_check_stock_status_at_the_time_of_status_change', 'check_stock_status_at_the_time_of_status_change'); 


    function check_stock_status_at_the_time_of_status_change(){
                $orderDetails = wc_get_order($_POST['orderId']);
                $orderData = $orderDetails->get_data(); 
                $items=$orderDetails->get_items();                
                $itemsPro=$orderDetails->get_items(); 
                $orderData['date_created']=convert_array($orderData['date_created']);
                $date=date('d M Y h:i A',strtotime($orderData['date_created']['date']));      
                $orders[$k]['price']=$orderData['total'];
                $allItems=array();
                $itemCount=0;
                $quantity=0;
                $final_Array=array();
                if(!empty($items)){                   
                    foreach($items as $kP=> $item) 
                    {   
                        $product_id = $item['product_id'];
                        $product_qty = $item['quantity'];
                        $cate= getProCat($product_id);
                        $final_Array[$product_id]=0;
                        if($cate==15){//single fruit   
                            $final_Array[$product_id] += $product_qty;
                    /*      $stockAvailability=get_post_meta($v['itemId'],'_stock',true);
                            $updatedStock=$stockAvailability-$v['quantity'];
                            update_post_meta($v['itemId'],'_stock',$updatedStock);*/  
                        }else{//basket
                            $productItems=get_field('select_product',$product_id);
                            if(!empty($productItems)){
                                foreach($productItems as $k=>$v){
                                    $fruitID=$v['fruit_name'][0]->ID;                                    
                                    $fruitWeight=$v['weight'];
                                    $final_Array[$fruitID]+= $fruitWeight*$item['quantity'];
                                   /*$stockAvailability=get_post_meta($fruitID,'_stock',true);
                                    $updatedStock=$stockAvailability-$fruitWeight;
                                    update_post_meta($fruitID,'_stock',$updatedStock);*/
                                }
                            }
                        } 
                   } 
                } 
                $temp=0;
                if(!empty($final_Array)){
                    foreach($final_Array as $k=>$v){
                        $stockAvailability=get_post_meta($k,'_stock',true);
                        $cate= getProCat($k);
                        if($cate==15){
                           if($stockAvailability<$v){
                                $temp=1;
                            }  
                        }                        
                    }
                }
                if(!empty($temp)){
                    echo json_encode(array('status'=>'false','message'=>'Kindly update the stock to process the order.'));
                    die; 
                 }
      }

    
    add_action('wp_ajax_export_csv', 'export_csv');
    add_action('wp_ajax_nopriv_export_csv', 'export_csv'); 

    function export_csv(){  
        $arr = getLastNDaysData(7);
        global $wpdb;
        $type='';
        if(isset($_GET['type'])){
          $type=$_GET['type'];  
        }
        if($type=='yearly'){
           $row=$wpdb->get_results('select `id`,`name`,`email`,`phoneNumber`,`description`,`price`,`numberOfAttendees`,`dateOfEvent`,`created` from `im_caterings` where YEAR(created) = YEAR(CURDATE())',ARRAY_A); 
        }elseif($type=='last-month'){
           $row=$wpdb->get_results('select `id`,`name`,`email`,`phoneNumber`,`description`,`price`,`numberOfAttendees`,`dateOfEvent`,`created` from `im_caterings` WHERE YEAR(created) = YEAR(CURRENT_DATE - INTERVAL 1 MONTH) AND MONTH(created) = MONTH(CURRENT_DATE - INTERVAL 1 MONTH)',ARRAY_A);
        }elseif($type=='last-7-days'){
           $row=$wpdb->get_results('select `id`,`name`,`email`,`phoneNumber`,`description`,`price`,`numberOfAttendees`,`dateOfEvent`,`created` from `im_caterings` where  YEAR(created) = YEAR(CURRENT_DATE()) and created >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)',ARRAY_A);
        }elseif($type=='catering-reports'){
            $startDate=date('Y-m-d',strtotime($_GET['start_date']));
            $end_date=date('Y-m-d',strtotime($_GET['end_date'])); 
            $row=$wpdb->get_results('select * from `im_caterings` WHERE created BETWEEN "'.$startDate.'" and "'.$end_date.'"',ARRAY_A);            
        }
        else{
           $row=$wpdb->get_results('select `id`,`name`,`email`,`phoneNumber`,`description`,`price`,`numberOfAttendees`,`dateOfEvent`,`created` from `im_caterings` WHERE MONTH(created) = MONTH(CURRENT_DATE())
        AND YEAR(created) = YEAR(CURRENT_DATE())',ARRAY_A);
        }        
        outputCsv('data.csv', $row);
        exit;
    }


    add_filter( 'manage_product_posts_columns', 'set_custom_edit_book_columns' );
    add_action( 'manage_product_posts_custom_column' , 'custom_book_column', 10, 2 );

    function set_custom_edit_book_columns($columns) {
        unset( $columns['author'] );
        $columns['publisher'] = __( 'Hide Stock', 'your_text_domain' );
        $columns['maxAmount'] = __( 'Max Amount', 'your_text_domain' );
        return $columns;
    }

    function custom_book_column( $column, $post_id ) {
        switch ( $column ) {
            case 'publisher' :
                $getStockStatus=get_post_meta($post_id,'_stock_status',true);
                if($getStockStatus=='instock'){
                    $inchecked='checked';
                    $outchecked='';
                }else{
                    $inchecked='';
                    $outchecked='checked'; 
                }
                echo '<input class="manageStock" '.$inchecked.' data-val="'.$post_id.'" type="radio" value="instock" name="stock_'.$post_id.'">No<input type="radio" '.$outchecked.' data-val="'.$post_id.'"  value="outofstock" class="manageStock" name="stock_'.$post_id.'">Yes';
                break;
            case 'maxAmount' :
                $getMaxQuantity=get_field('enter_max_quantity_user_can_buy',$post_id);
                echo '<span class="maxQuantityValue">'.$getMaxQuantity.'</span>  <a href="javascript:void(0)" class="maxQu">Edit</a>
                <div style="display:none;"> <input type="number" name="quanity" value="'.$getMaxQuantity.'"/>
                <a data-id="'.$post_id.'" class="save_quantity" href="javascript:void(0);">save</a></div>';
                break;

        }
    }

    add_action( 'show_user_profile', 'extra_user_profile_fields' );
    add_action( 'edit_user_profile', 'extra_user_profile_fields' );

    function extra_user_profile_fields( $user ) { ?>
                <table class="form-table">
                    <tr>
                        <th><label for="address"><?php _e("Phone Number"); ?></label></th>
                        <td>
                            <input type="text" maxlength="15" name="phoneNumber" id="phoneNumber" value="<?php echo get_user_meta($user->ID, 'phoneNumber',true); ?>" class="regular-text" /><br />
                            <span class="description"><?php _e("Please enter your phone number."); ?></span>
                        </td>
                    </tr>

                </table>
                <?php }

    add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
    add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

    function save_extra_user_profile_fields( $user_id ) {
            if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
            update_user_meta($user_id,'phoneNumber', $_POST['phoneNumber'] ); 
        
    }



    
    add_filter('manage_posts_columns', 'thumbnail_column');
    function thumbnail_column($columns) {
      $new = array();
      foreach($columns as $key => $title) {
        if ($key=='cb') // Put the Thumbnail column before the Author column
          $new['publisher'] = 'publisher';
          $new[$key] = $title;
        }
        return $new;
    }




    add_action('wp_ajax_reset_password', 'web_reset');
    add_action('wp_ajax_nopriv_reset_password', 'web_reset');

    function web_reset(){
        $get=get_user_by('email',$_POST['email']);
        if(!empty($get)){
            $get=convert_array($get);
            if($_POST['newPassword']==$_POST['confirmPassword']){
                update_user_meta($get['ID'],'tokenfield',randomString(8));
                wp_set_password($_POST['newPassword'],$get['ID']);
                
                echo json_encode(array('status'=>'true','message'=>'Password has been reset.'));
                die; 
            }

        }else{
             echo json_encode(array('status'=>'false','message'=>'No Email found.'));
             die;                
        }  
        
    }

    add_action('wp_ajax_login', 'weblogin');
    add_action('wp_ajax_nopriv_login', 'weblogin');

    function weblogin(){
        $data=$_POST;
        if(!email_exists($data['email'])){
             response(0,null,getTextByLang('Email is not registered with us.',$data['lang']));
        } 
        $loginUser=login($data,'web');
        if(!empty($loginUser)){
           response(1,null,'test'); 
        }else{
           response(0,null,getTextByLang("Wrong Password",$data['lang']));  
        }
        
    }

    add_action('wp_ajax_signup','websignup');
    add_action('wp_ajax_nopriv_signup','websignup');

    function websignup(){
        $data=$_POST;
        if (email_exists($data['email'])) {
            response(0, null, getTextByLang('Email already exists.',$data['lang']));
        }
        $userSignup=signup($data,'web');
        if(!empty($userSignup)){
          response(1,null,getTextByLang('User registered successfully.',$data['lang']));   
        }else{
          response(0,null,getTextByLang('View More',$data['lang']));  
        }
    }



    function randomString($length = 6) {
        $str = "";
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
        $rand = mt_rand(0, $max);
        $str .= $characters[$rand];
        }
        return $str;
    }

    
    add_action('wp_ajax_forgot_password','forgot_password');
    add_action('wp_ajax_nopriv_forgot_password','forgot_password');

    function forgot_password(){ 
        $email=get_user_by('email',$_POST['email']);
        if(!empty($email)){  
            $email=convert_array($email);
            $id=$email['data']['ID'];
            $token=get_user_meta($id,'tokenfield',true);
            $emailTemplate=file_get_contents(get_stylesheet_directory_uri().'/email-template.php');
            $emailTemplate=str_replace('[NAME]',ucwords(getUserName($email['data']['ID'])),$emailTemplate);
            $message=getTextByLang('To reset password click on the link',$_POST['lang']).'<a href="'.site_url().'/reset-password/?token='.$token.'&email='.$email['data']['user_email'].'"> '.getTextByLang('Click Here',$_POST['lang']).'</a>. '.getTextByLang('This link helps you to reset your password',$_POST['lang']).'.';  
            $emailTemplate=str_replace('[MESSAGE]',$message,$emailTemplate);
            send_email($email['data']['user_email'],'Reset Password',$emailTemplate);
            update_user_meta($email->ID,'tokenfield',randomString(8));
           echo json_encode(array('status'=>'true','message'=>getTextByLang('Reset password link has been sent to your email.',$_POST['lang']))); 
            die;
        }else{
            echo json_encode(array('status'=>'false','message'=>getTextByLang('Please check your entered Email Id.',$_POST['lang']))); 
            die;
        }
    }

    function getFirstBasket(){
        global $wpdb;
        $terms=16;
        $args = array(
            'post_type' => 'product',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' =>$terms
                )
            )
        );
        $query = new WP_Query($args);
        $alldata=array();
        $k=0;
        while ($query->have_posts()) : $query->the_post();            
            global $product;
            $id = $product->get_id();   
            $checkStockAvail=get_post_meta($id,'_stock_status',true);
            if($checkStockAvail!='outofstock'){
                if($k!=0){
                    break;
                }
                $alldata['basketId']="$id"; 
                $alldata['title']=get_the_title(); 
                $alldata['description']=strip_tags(get_the_content()); 
                $alldata['price']=$product->get_regular_price(); 
                $getImage='';
                $image=wp_get_attachment_image_src(get_post_thumbnail_id($id),'full');
                if(!empty($image)){
                 $getImage=$image[0];
                }
                $alldata['firstImage']=$getImage; 
                $k++;
            }             
            endwhile;
            return $alldata;        
    }

    // Cart contents are updated when products are added to the cart via AJAX (place it in functions.php)
    add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );
    function woocommerce_header_add_to_cart_fragment( $fragments ) {
        ob_start();
    ?>
                <a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
         <i class="la la-shopping-cart" aria-hidden="true"></i><span class="cart-item-number"><?php echo esc_html( trim( WC()->cart->get_cart_contents_count() ) ); ?></span>
        </a>
                <?php
        $fragments['a.cart-contents'] = ob_get_clean();
        return $fragments;
    }

    if ( !function_exists( 'wc_delete_product_transients' ) ) { 
        require_once '/includes/wc-product-functions.php'; 
    } 

    // The post id. 
    $post_id = -1; 

    // NOTICE! Understand what this does before running. 
    $result = wc_delete_product_transients($post_id); 

    function storage_fact_details($data=null){
       $url=site_url().'/api/webstorage.php?type=storage_facts&product='.$data['proId'].'&lang='.$data['lang'];
       return $getOrdersDetails=file_get_contents($url); 
    }
   function nutirtion_fact_details($data=null){
       $url=site_url().'/api/webstorage.php?type=nutrition_facts&product='.$data['proId'].'&lang='.$data['lang'];
       return $getOrdersDetails=file_get_contents($url); 
    }

    add_action('wp_ajax_storage_fact','storage_fact');
    add_action('wp_ajax_nopriv_storage_fact','storage_fact');

    function storage_fact(){
        $getOrdersDetails=storage_fact_details($_POST);
        if(!empty($getOrdersDetails)){
            echo json_encode(array('status'=>'true','data'=>$getOrdersDetails));
            die;
        }else{
            echo json_encode(array('status'=>'false'));
            die;
        }
    }

    add_action('wp_ajax_storage_fact_items','storage_fact_items');
    add_action('wp_ajax_nopriv_storage_fact_items','storage_fact_items');

    function storage_fact_items(){
        $productItems=get_field('select_product',$_POST['proId']);
        $ar=array();
        $html='';
        if(!empty($productItems)){
            foreach($productItems as $k=>$v){
                $fruitID=$v['fruit_name'][0]->ID;   
                $final['proId']=$fruitID;
                $final['lang']=$_POST['lang'];
                $ar[$k]['st']=storage_fact_details($final);
                $ar[$k]['rt']=get_the_title($fruitID);
                $html.='<span>'.get_the_title($fruitID).'</span>'.storage_fact_details($final).'</span>';
            }
        }
        echo json_encode(array('status'=>'true','data'=>$html));
        die;   
    }
    
    add_action('wp_ajax_nutirtion_fact_items','nutirtion_fact_items');
    add_action('wp_ajax_nopriv_nutirtion_fact_items','nutirtion_fact_items');

    function nutirtion_fact_items(){
        $productItems=get_field('select_product',$_POST['proId']);
        $ar=array();
        $html='';
        if(!empty($productItems)){
            foreach($productItems as $k=>$v){
                $fruitID=$v['fruit_name'][0]->ID;   
                $final['proId']=$fruitID;
                $final['lang']=$_POST['lang'];
                $ar[$k]['st']=nutirtion_fact_details($final);
                $ar[$k]['rt']=get_the_title($fruitID);
                $html.='<span>'.get_the_title($fruitID).'</span>'.nutirtion_fact_details($final).'</span>';
            }
        }
        echo json_encode(array('status'=>'true','data'=>$html));
        die;   
    }

    add_action('wp_ajax_cart_count_web','cart_count_web');
    add_action('wp_ajax_nopriv_cart_count_web','cart_count_web');
    function cart_count_web(){
         global $woocommerce;
        $cartCount= $woocommerce->cart->cart_contents;
        echo count($cartCount);
        die;
    }

    add_action('wp_ajax_nutrition_fact','nutrition_fact');
    add_action('wp_ajax_nopriv_nutrition_fact','nutrition_fact');

    function nutrition_fact(){
        $url=site_url().'/api/webstorage.php?type=nutrition_facts&product='.$_POST['proId'].'&lang='.$_POST['lang'];
        $getOrdersDetails=file_get_contents($url);
        if(!empty($getOrdersDetails)){
            echo json_encode(array('status'=>'true','data'=>$getOrdersDetails));
            die;
        }else{
            echo json_encode(array('status'=>'false'));
            die;
        }
    }

    function baztag_func( $atts, $content = "" ) {
        return home_url();
    }

    add_shortcode( 'baztag', 'baztag_func' );

    
    add_action( 'woocommerce_edit_account_form', 'my_woocommerce_edit_account_form' );
    add_action( 'woocommerce_save_account_details', 'my_woocommerce_save_account_details' );

    function my_woocommerce_edit_account_form() {

    $user_id = get_current_user_id();
    $user = get_userdata( $user_id );

    if ( !$user )
    return;

    $phone=get_user_meta($user_id, "phoneNumber",true); 

    ?>





                    <?php

    }

    function my_woocommerce_save_account_details( $user_id ) {
        if(!empty($_POST['phoneNumber'])){
         update_user_meta($user_id, "phoneNumber",$_POST['phoneNumber']);   
        }  

    }
    function action_woocommerce_save_account_details_errors( $array ) { 
       
       if(!empty($_POST['password_current']) and !empty($_POST['password_1'])){
            $data=get_user_by('email',$_POST['account_email']);
            $_POST['account_first_name']=get_user_meta($data->ID,'first_name',true);
            $_POST['account_last_name']=get_user_meta($data->ID,'last_name',true);
        }
        unset($_POST['account_email']);

    }; 

    // add the action 
    add_action( 'woocommerce_save_account_details_errors', 'action_woocommerce_save_account_details_errors', 10, 1 ); 

    
    function custom_my_account_menu_items( $items ) {
        $crntLanguage=qtranxf_getLanguage();
        $items['ma-manage-address']=getTextByLang('Manage Addresses',$crntLanguage);
        unset($items['downloads']);
        unset($items['edit-address']);
        return $items;
    }
    add_filter( 'woocommerce_account_menu_items', 'custom_my_account_menu_items' );
    
   

// for shipping fields
add_filter("woocommerce_checkout_fields", "new_shiping_order_fields");

function new_shiping_order_fields($fields) {   
   $crntLanguage=qtranxf_getLanguage();
   $order = array(   
       "billing_alt", 
      /* "billing_first_name", 
       "billing_last_name", */
       "billing_address_type",
       "billing_company", 
       "billing_country", 
       "billing_address_1", 
       "billing_city", 
       "billing_postcode",
       "billing_phone",
       "billing_email",      
       "billing_house",
       "billing_apartment_number",
       "billing_floor",
       "billing_office",
       "billing_building",
       "billing_avenue",
       "billing_additional_directions",
   );
   foreach( $order as $field ) {
       $ordered_fields[$field] = $fields["billing"][$field];
   }
    $ordered_fields['billing_alt']['label']=getTextByLang('Address Title',$crntLanguage);
    $ordered_fields['billing_company']['label']=getTextByLang('Area',$crntLanguage);
    $ordered_fields['billing_address_1']['label']=getTextByLang('Block',$crntLanguage);
    $ordered_fields['billing_city']['label']=getTextByLang('Street',$crntLanguage);
    $ordered_fields['billing_postcode']['label']=getTextByLang('Postcode',$crntLanguage);
    $ordered_fields['billing_phone']['label']=getTextByLang('Phone Number',$crntLanguage);
    $ordered_fields['billing_house']['label']=getTextByLang('House',$crntLanguage);
    $ordered_fields['billing_apartment_number']['label']=getTextByLang('Apartment',$crntLanguage);
    $ordered_fields['billing_floor']['label']=getTextByLang('Floor',$crntLanguage);
    $ordered_fields['billing_office']['label']=getTextByLang('Office',$crntLanguage);
    $ordered_fields['billing_building']['label']=getTextByLang('Building',$crntLanguage);
    $ordered_fields['billing_avenue']['label']=getTextByLang('Avenue',$crntLanguage);
    $ordered_fields['billing_additional_directions']['label']=getTextByLang('Additional Directions',$crntLanguage);
    $ordered_fields['billing_building']['required']=0;
    $ordered_fields['billing_alt']['required']=1;
    $ordered_fields['billing_email']['class']=array('form-row-wide');
    $ordered_fields['billing_additional_directions']['priority']=1000;
    $ordered_fields['billing_address_type']['options']=array(''=>getTextByLang('Select',$crntLanguage),'0'=>getTextByLang('Home',$crntLanguage),'1'=>getTextByLang('Apartment',$crntLanguage),'2'=>getTextByLang('Office',$crntLanguage));;
   $ordered_fields['billing_address_type']['required']=1;
   $ordered_fields['billing_country']['required']=0;
   $fields["billing"] = $ordered_fields;
   return $fields;  
}
 add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
 function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 9; // 4 related products
	//$args['columns'] = 2; // arranged in 2 columns
	return $args;
}

    add_filter('add_to_cart_fragments', 'woostore_header_add_to_cart_fragment');
    function woostore_header_add_to_cart_fragment(  ) {
        global $woocommerce;
        $cartCount= $woocommerce->cart->cart_contents;  
        if(!empty(count($cartCount))){
            $html='<span class="cartShoopingCount"><span class="cart-item-number">'.count($cartCount). '</span></span>';
        }else{
            $html='';
        }
        /*$fragments['#btn-cart'] = '*/
        $fragments['.fr'] = '
        <div id="btn-cart" class="fr cart-contents">
            <a href="'.$woocommerce->cart->get_cart_url().'" title="'.__('View your shopping cart', 'woothemes').'">
                <span>'.sprintf(_n('%d item &ndash; ', '%d items &ndash; ', count($cartCount), 'woothemes'), count($cartCount)) .count($cartCount) . '</span>
            </a>
        </div>
        ';
       
        $fragments['.cart-contents']='<div id="btn-cart" class="fr">
            <a href="'.$woocommerce->cart->get_cart_url().'" title="'.__('View your shopping cart', 'woothemes').'">
            <i class="la la-shopping-cart" aria-hidden="true"></i>
               '.$html.' 
            </a>
        </div>';
        return $fragments;
    }

    add_filter( 'woocommerce_billing_fields', 'wc_optional_billing_fields', 10, 1 );
    function wc_optional_billing_fields( $address_fields ) {
        $address_fields['billing_address_1']['required'] = false;
        $address_fields['billing_address_2']['required'] = false;
        return $address_fields;
    }

    add_action('wp_ajax_myajax', 'myajax');
    add_action('wp_ajax_nopriv_myajax', 'myajax');
    function myajax() {        
        $product_id = $_POST['proId'];
        WC()->cart->add_to_cart($product_id);
        echo json_encode(array('status'=>'true'));
        die;
    }


    // Add your custom order status action button (for orders with "processing" status)
    add_filter( 'woocommerce_admin_order_actions', 'add_custom_order_status_actions_button', 100, 2 );
    function add_custom_order_status_actions_button( $actions, $order ) {
        // Display the button for all orders that have a 'processing' status        
        $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
        if ( !$order->has_status( array( 'cancelled' ) ) ) {
            $order_id = method_exists( $order, 'get_id' ) ? $order->get_id() : $order->id;
            /*$actions['parcial'] = array(
                'url'       => wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=cancelled&order_id=' . $order_id ), 'woocommerce-mark-order-status' ),
                'name'      => __( 'Cancelled', 'woocommerce' ),
                'action'    => "view parcial", // keep "view" class for a clean button CSS
            );*/
        }
        if($order->status=='completed'){
            $actions['refund'] = array(
                'url'       => wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=refunded&order_id=' . $order_id ), 'woocommerce-mark-order-status' ),
                'name'      => __( 'Refund', 'woocommerce' ),
                'action'    => "refund", // keep "view" class for a clean button CSS
            );
            $actions['replace'] = array(
                'url'       => wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=bad-order&order_id=' . $order_id ), 'woocommerce-mark-order-status' ),
                'name'      => __( 'Replace', 'woocommerce' ),
                'action'    => "replace", // keep "view" class for a clean button CSS
            );    
        }elseif($order->status=='pending'){
            unset($actions['completed']);
            unset($actions['replace']);
            unset($actions['refund']);
            $actions['parcial'] = array(
                'url'       => wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=cancelled&order_id=' . $order_id ), 'woocommerce-mark-order-status' ),
                'name'      => __( 'Cancelled', 'woocommerce' ),
                'action'    => "view parcial", // keep "view" class for a clean button CSS
            );
        }elseif($order->status=='processing'){
            $actions['parcial'] = array(
                'url'       => wp_nonce_url( admin_url( 'admin-ajax.php?action=woocommerce_mark_order_status&status=cancelled&order_id=' . $order_id ), 'woocommerce-mark-order-status' ),
                'name'      => __( 'Cancelled', 'woocommerce' ),
                'action'    => "view parcial", // keep "view" class for a clean button CSS
            );
            unset($actions['replace']);
            unset($actions['refund']);
            
        }elseif($order->status=='refunded'){
            unset($actions['replace']);
            unset($actions['refund']); 
            unset($actions['completed']); 
            unset($actions['processing']); 
        }      
        return $actions;
    }
    // Set Here the WooCommerce icon for your action button
    add_action( 'admin_head', 'add_custom_order_status_actions_button_css' );
    function add_custom_order_status_actions_button_css() {
        echo '<style>.view.parcial::after { font-family: woocommerce; content: "\e005" !important; }</style>';
    }

    add_action('wp_ajax_checkStockProcessing', 'checkStockProcessing');
    add_action('wp_ajax_nopriv_checkStockProcessing', 'checkStockProcessing');  
    function checkStockProcessing(){
        $orderIDWithPost=$_POST['post_id'];
        $order_id=str_replace('post-','',$orderIDWithPost);
        $orderDetails = wc_get_order($order_id);
        $counter=0;
        $arr=array();
        foreach ($orderDetails->get_items() as $items_key => $items_value) {  
               $productID= $items_value['product_id']; //this works
               $cate = getProCat($productID);
               if($cate==15){//single fruit   
                    $arr[$productID] += $items_value['quantity'];        
               }else{//basket
                   $productItems=get_field('select_product',$productID);
                    if(!empty($productItems)){
                        foreach($productItems as $k=>$v){
                            $fruitID=$v['fruit_name'][0]->ID;
                            $arr[$fruitID] += $v['weight'];
                        }
                    }
              }

       }
        $temp=0;
        if(!empty($arr)){
           foreach($arr as $k=>$v){
               $stockAvailability=get_post_meta($k,'_stock',true);
               $stockAvailabilityStatus=get_post_meta($k,'_stock_status',true);
               if($stockAvailability<$v || $stockAvailabilityStatus=='outofstock'){
                  $temp=1; 
               }
           }

        }  
        if(!empty($temp)){
            echo json_encode(array('status'=>'false','message'=>'Kindly update the stock of the products.'));
            die;
        }else{
             echo json_encode(array('status'=>'true','message'=>'test'));
            die;
        }

    }

    //Disable Plugin Update
    function filter_plugin_updates( $value ) {
        unset( $value->response['woocommerce/woocommerce.php'] );
        unset( $value->response['wps-hide-login/wps-hide-login.php'] );
        unset( $value->response['multiple-customer-addresses-for-woocommerce/ma-multiple-customer-addresses.php'] );
        return $value;
    }
    add_filter( 'site_transient_update_plugins', 'filter_plugin_updates' );
    function fruits_preprocess_breadcrumb(&$variables) {
            array_pop($variables['breadcrumb']);
  
    }

    add_filter('avia_breadcrumbs_trail', 'avia_breadcrumbs_args_mod', 10, 2);
    function avia_breadcrumbs_args_mod($trail, $args){
        
        print_r($args);
        pr($trail);
        unset($trail[0]);
        return $trail;
    }


    function mysite_pending($order_id) {
       $orderDetails = wc_get_order($order_id);
       $userId=get_current_user_id();
       $title='Order status has been changed to Pending status.';
       insert_notification($userId,$order_id,$orderDetails->customer_id,$title); 
    }

    function mysite_processing($order_id) {
       $orderDetails = wc_get_order($order_id);
       $userId=get_current_user_id();
       $title='Order status has been changed to Processing status.';
       insert_notification($userId,$order_id,$orderDetails->customer_id,$title);        
    }
    function mysite_completed($order_id) {
       $orderDetails = wc_get_order($order_id);
       $userId=get_current_user_id();
       $title='Order status has been changed to Completed status.';
       insert_notification($userId,$order_id,$orderDetails->customer_id,$title); 
    }
    function mysite_refunded($order_id) {
       $orderDetails = wc_get_order($order_id);
       $userId=get_current_user_id();
       $title='Order status has been changed to Refunded.';
       insert_notification($userId,$order_id,$orderDetails->customer_id,$title); 
    }
    function mysite_cancelled($order_id) {
       $orderDetails = wc_get_order($order_id);
       $userId=get_current_user_id();
       $title='Order status has been changed to Completed status.';
       insert_notification($userId,$order_id,$orderDetails->customer_id,$title); 
    }

    add_action( 'woocommerce_order_status_pending', 'mysite_pending');
    add_action( 'woocommerce_order_status_processing', 'mysite_processing');
    add_action( 'woocommerce_order_status_completed', 'mysite_completed');
    add_action( 'woocommerce_order_status_refunded', 'mysite_refunded');
    add_action( 'woocommerce_order_status_cancelled', 'mysite_cancelled');
    
    add_filter('woocommerce_admin_order_actions','wdm_verify_product_limitation',5,2);
    function wdm_verify_product_limitation( $actions, $the_order ){
        $the_order=json_decode($the_order,true);
        if ($the_order['status']=='pending') {   
            unset($actions['complete']);
            unset($actions['refund']);
            unset($actions['replace']);
        }elseif($the_order['status']=='processing'){
           unset($actions['refund']);
           unset($actions['replace']); 
           unset($actions['processing']); 
        }
        return $actions;
    }

     
    /* end frontend funciton */

    add_action('user_register','my_function');
    function my_function($user_id){
        update_user_meta($user_id,'admin_color','midnight');
      
    }

   /* function sort_dashboard_widgets() {
        global $wp_meta_boxes;   
        $dah=$wp_meta_boxes['dashboard']['normal']['core'];
        unset($wp_meta_boxes['dashboard']['normal']['high']);
        unset($wp_meta_boxes['dashboard']['normal']['default']);
        unset($wp_meta_boxes['dashboard']['normal']['low']);
        unset($wp_meta_boxes['dashboard']['side']['core']);
        $wp_meta_boxes['dashboard']['normal']['core']=$dah;

    }
    add_action('wp_dashboard_setup', 'sort_dashboard_widgets');*/
