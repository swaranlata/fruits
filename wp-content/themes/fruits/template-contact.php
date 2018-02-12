<?php
/* Template Name: Contact Us */
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
    <div class="main contact-info-wrapper">
        <div class="content">
            <section class="contact-info-wrap post">
                <div class="container">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6 col-md-7 col-lg-7 device-mrgn-btm">
                            <div class="comtact-info-sec">
                                <div class="contact-info mrgn-btm-sm">
                                    <h3>
                                        <span><?php echo getTextByLang('Address',$crntLanguage); ?></span>
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="106.986px" height="145.532px" viewBox="0 0 106.986 145.532" enable-background="new 0 0 106.986 145.532" xml:space="preserve">
<g>
	<path fill="#39BB3D" stroke="#39BB3D" stroke-miterlimit="10" d="M106.279,41.455L91.826,27.001H54.691V24.34
		c5.492-1.117,9.649-5.975,9.649-11.798C64.34,5.9,58.927,0.5,52.292,0.5c-6.645,0-12.042,5.4-12.042,12.042
		c0,5.814,4.138,10.681,9.633,11.798v2.661H30.944c-4.162,0-7.565,3.389-7.565,7.562v6.892h-8.222L0.707,55.9l14.45,14.454h34.725
		v50.594H37.84v9.629h-7.232v14.456h43.363v-14.456h-7.234v-9.629H54.691V70.354h21.348c4.164,0,7.565-3.387,7.565-7.559V55.9h8.222
		L106.279,41.455z M45.058,12.542c0-3.988,3.246-7.218,7.233-7.218c3.979,0,7.226,3.23,7.226,7.218c0,3.991-3.247,7.222-7.226,7.222
		C48.304,19.764,45.058,16.534,45.058,12.542L45.058,12.542z M69.146,135.397v4.812H35.427v-4.812H69.146z M61.925,130.577H42.652
		v-4.809h19.273V130.577z M78.781,62.794c0,1.514-1.224,2.751-2.742,2.751H17.148L7.515,55.9l9.633-9.635h58.891
		c1.518,0,2.742,1.239,2.742,2.753V62.794z M83.604,51.091v-2.073c0-4.176-3.401-7.563-7.565-7.563H28.206v-6.892
		c0-1.515,1.223-2.751,2.738-2.751h58.891l9.637,9.643l-9.637,9.637H83.604z M83.604,51.091"/>
</g>
</svg>
                                    </h3>
                                    <address><?php echo get_custom('address'); ?></address>
                                </div>
                                <!-- contact-info -->
                                <div class="contact-info mrgn-btm-sm">
                                    <h3>
                                        <span><?php echo getTextByLang('Email',$crntLanguage); ?></span>
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="88.786px" height="72.463px" viewBox="0 0 88.786 72.463" enable-background="new 0 0 88.786 72.463" xml:space="preserve">
<g>
	<g>
		<g>
			<path fill="#39BB3D" d="M77.037,0h-65.29C5.269,0,0.001,5.269,0.001,11.747v48.969c0,6.477,5.268,11.747,11.746,11.747h65.29
				c6.479,0,11.749-5.271,11.749-11.747V11.747C88.786,5.269,83.516,0,77.037,0z M81.611,60.716c0,2.52-2.051,4.572-4.574,4.572
				h-65.29c-2.522,0-4.575-2.053-4.575-4.572V11.747c0-2.522,2.053-4.575,4.575-4.575h65.29c2.522,0,4.574,2.053,4.574,4.575V60.716
				z"/>
		</g>
	</g>
	<g>
		<g>
			<path fill="#39BB3D" d="M88.137,9.691C87,8.067,84.766,7.672,83.141,8.809l-38.75,27.124L5.642,8.809
				C4.02,7.672,1.785,8.067,0.648,9.691c-1.135,1.622-0.74,3.856,0.882,4.993l40.806,28.563c0.618,0.434,1.335,0.649,2.055,0.649
				c0.721,0,1.439-0.216,2.058-0.649l40.805-28.563C88.876,13.548,89.272,11.313,88.137,9.691z"/>
		</g>
	</g>
</g>
</svg>

                                    </h3>
                                    <a href="mailto:<?php echo get_custom('notification_email'); ?>" target="_blank">
                                        <?php echo get_custom('notification_email'); ?>
                                    </a>
                                </div>
                                <!-- contact-info -->
                                <div class="contact-info">
                                    <h3>
                                        <span><?php echo getTextByLang('Contact no',$crntLanguage); ?></span>
                                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="75.229px" height="77.357px" viewBox="0 0 75.229 77.357" enable-background="new 0 0 75.229 77.357" xml:space="preserve">
<g>
	<path fill="#39BB3D" stroke="#39BB3D" stroke-miterlimit="10" d="M64.726,10.502C58.275,4.052,49.697,0.5,40.576,0.5
		c-1.497,0-2.706,1.213-2.706,2.706s1.209,2.709,2.706,2.709c7.676,0,14.895,2.989,20.323,8.413
		c5.428,5.431,8.417,12.646,8.417,20.324c0,1.498,1.212,2.706,2.706,2.706s2.707-1.208,2.707-2.703
		C74.729,25.53,71.178,16.953,64.726,10.502L64.726,10.502z M64.726,10.502"/>
	<path fill="#39BB3D" stroke="#39BB3D" stroke-miterlimit="10" d="M53.595,34.655c0,1.495,1.211,2.703,2.706,2.703
		s2.706-1.208,2.706-2.706c-0.002-10.159-8.269-18.428-18.431-18.428c-1.497,0-2.706,1.21-2.706,2.706
		c0,1.493,1.209,2.706,2.706,2.706C47.755,21.637,53.593,27.477,53.595,34.655L53.595,34.655z M53.595,34.655"/>
	<path fill="#39BB3D" stroke="#39BB3D" stroke-miterlimit="10" d="M47.606,48.453c-4.126-0.214-6.226,2.852-7.235,4.327
		c-0.845,1.233-0.527,2.915,0.705,3.761c1.235,0.844,2.918,0.527,3.763-0.706c1.19-1.74,1.729-2.016,2.462-1.979
		c2.343,0.275,11.566,7.035,12.49,9.147c0.233,0.624,0.224,1.231-0.025,1.978c-0.969,2.869-2.572,4.89-4.636,5.838
		c-1.963,0.902-4.369,0.817-6.957-0.234c-9.66-3.938-18.103-9.434-25.087-16.336c-0.004-0.003-0.007-0.006-0.009-0.008
		C16.19,47.264,10.704,38.834,6.773,29.187c-1.052-2.591-1.136-4.997-0.236-6.959c0.946-2.063,2.968-3.667,5.84-4.632
		c0.743-0.253,1.354-0.263,1.97-0.031c2.12,0.928,8.88,10.149,9.153,12.469c0.039,0.756-0.235,1.294-1.977,2.484
		c-1.234,0.843-1.551,2.525-0.707,3.761c0.842,1.233,2.527,1.55,3.759,0.708c1.475-1.009,4.544-3.101,4.329-7.241
		c-0.234-4.321-8.644-15.773-12.662-17.251c-1.788-0.668-3.668-0.676-5.591-0.031c-4.325,1.458-7.448,4.052-9.034,7.51
		C0.08,23.326,0.131,27.217,1.76,31.226c4.211,10.327,10.096,19.358,17.497,26.853c0.02,0.015,0.037,0.035,0.057,0.053
		c7.485,7.385,16.508,13.266,26.818,17.468c2.063,0.836,4.097,1.259,6.044,1.259c1.829,0,3.582-0.372,5.209-1.119
		c3.456-1.585,6.054-4.709,7.511-9.038c0.645-1.919,0.633-3.797-0.027-5.575C63.386,57.097,51.937,48.686,47.606,48.453
		L47.606,48.453z M47.606,48.453"/>
</g>
</svg>
                                    </h3>
                                    <a href="tel:<?php echo str_replace(' ','',get_custom('contact_no')); ?>" target="_blank">+<?php echo get_custom('contact_no'); ?></a>
                                </div>
                                <!-- contact-info -->
                            </div>
                            <!-- contact-info-sec -->
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
                            <div class="map-sec wow bounceInRight" data-wow-duration="3s" data-wow-delay="0s" id="map">
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </section>
            <!-- contact-info-wrapper -->
        </div>
        <!-- content -->
    </div>
    <!-- main -->
    <?php if(get_page_template_slug()=='template-contact.php'){
    $key='AIzaSyDy0Uz_ZqLD7Ki3SQCDJ7UhHVmjb9WClxQ';
    $address = str_replace(" ", "+", get_custom('address'));
    $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&key=$key");
    $json = json_decode($json);
    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    $array=array('lat'=>$lat,'long'=>$long);
    
?>
    <script src="//maps.googleapis.com/maps/api/js?key=AIzaSyDy0Uz_ZqLD7Ki3SQCDJ7UhHVmjb9WClxQ">


    </script>
    <script>
        var uluru = {
            lat: <?php echo $array['lat']; ?>,
            lng: <?php echo $array['long']; ?>
        };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });

    </script>
    <?php
    
} ?>

        <?php get_footer(); ?>
