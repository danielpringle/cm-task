<?php
/**
 *
 * @package dpuk\cleverMarketing
 * @since  1.0.0
 * @author  Dan Pringle
 * @license GPL-2.0+
 * @link    https://www.danielpringle.co.uk/
 */
namespace dpuk\cleverMarketing;

// Add landing page body class to the head
add_filter( 'body_class', __NAMESPACE__ . '\genesis_sample_add_body_class' );
function genesis_sample_add_body_class( $classes ) {

	$classes[] = 'clever-marketing';

	return $classes;

}
// Remove Skip Links
remove_action ( 'genesis_before_header', 'genesis_skip_links', 5 );

// Dequeue Skip Links Script
add_action( 'wp_enqueue_scripts', 'genesis_sample_dequeue_skip_links' );
function genesis_sample_dequeue_skip_links() {
	wp_dequeue_script( 'skip-links' );
}

// Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Remove site header elements
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

// Remove navigation
remove_theme_support( 'genesis-menus' );

// Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// Remove footer widgets
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

// Remove site footer elements
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
//remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Remove page title
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// Remove site inner wrap
//add_filter( 'genesis_structural_wrap-site-inner', '__return_empty_string' );

// Remove edit link
add_filter ( 'genesis_edit_post_link' , '__return_false' );


// Remove 'site-inner' from structural wrap
add_theme_support( 'genesis-structural-wraps', array( 'header', 'footer-widgets', 'footer' ) );

//* Add class to .site-inner
add_filter('genesis_attr_site-inner', __NAMESPACE__ . '\clever_attributes_st_inner');
function clever_attributes_st_inner($attributes) {
	$attributes['class'] .= ' full';
	return $attributes;
}


/**
 * Script to enqueue fonts in a theme
 * @return void
 */
function clever_marketing_enqueue_fonts() {
    if ( is_page( 'Clever Marketing' ) ) {
		wp_enqueue_style( 'Clever-fonts', '//fonts.googleapis.com/css2?family=Roboto+Slab:300;400;700|Playfair+Display:400;500;600;700&display=swap',
		array(),
		'1.0'
		);
	}
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\clever_marketing_enqueue_fonts' );




 /**
  *	Build our custom loop
  *
  */
 function clever_marketing_loop() {
  $site_url = get_site_url();


  ?>

  <div class="page-container">
   <!-- sticky -->
	<div class="landing-header sticky clearfix">
		<div class="landing-content">
			<div class="logo">
			<img src=" <?php echo temp_URL . 'assets/images/rhw-logo.png'; ?>">
			</div>
			<div class="phone">
				<a href="" target="_blank" rel="noopener" class="image-link">
					<img src="<?php echo temp_URL . 'assets/images/telephone-icon.png'; ?>">
				</a>
				<span style="color: #000000;"><a style="color: #000000;" href="tel:01483302000" target="_blank" rel="noopener">01483 302 000</a></span>
			</div>
		</div>
  	</div>
<!-- Hero section  -->
	<div class="full-width image-holder landing-row clearfix">
		<div class="wrap">
			<div class="image-holder desktop">
				<img src=" <?php echo temp_URL . 'assets/images/hero-image-desktop.png'; ?>">
			</div>
			<div class="image-holder mobile">
				<img src=" <?php echo temp_URL . 'assets/images/hero-image-mobile.png'; ?>">
			</div>
		</div>
  	</div>
<!-- full width section row -->
	<div class="full-width landing-row">

			<div class="landing-content">
			<h1>Commercial Property Solicitors</h1>
			<p>200 years of trusted commercial legal advice</p>
			</div>

  	</div>

<!-- content + form-->
	<div class="landing-row clearfix">
		<div class="landing-content">
			<div class="one-half content">
				<p>Commercial property solicitors, RHW, based in Guildford, Surrey, have been providing trusted company and commercial legal advice for nearly 200 years.</p>
				<p>From acquisition to development, leases to disposal, RHW’s corporate legal team fully understand the commercial property cycle have the knowledge and experience your commercial property needs.</p>

				<div class="button-container hide-desktop clearfix">
					<a class="button" href="#free-consultation">Free Consultation </a>
				</div>

				<p>With a legal team whose business experience adds up to over 100 years, we specialise in all forms of commercial property law, on-hand to work with you on:</p>
					<ul>
						<li>Land acquisition</li>
						<li>Property development</li>
						<li>Commercial leases</li>
						<li>Buying and selling commercial property</li>
					</ul>
				<p>Our experience extends to all forms of commercial property including retail units, factories, warehousing, pubs &amp; bars, restaurants and even medical practices.</p>
				<p>Our commercial property lawyers are able to work with you on your contractual agreements, covering everything from heads of terms to shareholders agreements.</p>
			</div>
			<div class="one-half form">

					<div class="form-content">
						<div class="form-content-wrap">
						<?php
						$contact_form = the_field('contact_form');
						?>
							<?php echo $contact_form ; ?>
						</div>
					</div>
			</div>
		</div>
  	</div>

<!-- content plus video -->
<div class="landing-row clearfix fiftyfifty">
	<div class=fiftyfifty-wrap>
		<div class="landing-content clearfix">
						<div class="one-half carousel">
							<div class= "testimonial-wrap">
							<?php

							add_filter( 'acf_wysiwyg_filters', 'wptexturize'       );
							add_filter( 'acf_wysiwyg_filters', 'convert_smilies'   );
							add_filter( 'acf_wysiwyg_filters', 'convert_chars'     );
							add_filter( 'acf_wysiwyg_filters', 'wpautop'           );
							add_filter( 'acf_wysiwyg_filters', 'shortcode_unautop' );
							add_filter( 'acf_wysiwyg_filters', 'do_shortcode'      );
							add_filter( 'acf_wysiwyg_filters', 'prepend_attachment' );

							$testimonial = the_field('testimonial');

						?>
								<div class="text-area">
									<div class="wrap">
										<?php echo $testimonial ; ?>
									</div>
								</div>
							</div>
 						</div>

						<div class="one-half video">
							<?php	$video = the_field('video');
							?>
							<div class="video-wapper">
								<?php echo $video; ?>
							</div>
						</div>
 		</div>
	</div>
		<div class="button-container clearfix">
						<a class="button" href="#free-consultation">Free Consultation </a>
		</div>
</div>

<!-- full width section row -->
<div class="full-width landing-row">

<div class="landing-content">
<h2>Meet the Corporate Team</h2>
</div>

</div>

<!-- Team -->
<div class="team landing-row">

<div class="landing-content">
	<?php


add_filter( 'acf_wysiwyg_filters', 'wptexturize'       );
add_filter( 'acf_wysiwyg_filters', 'convert_smilies'   );
add_filter( 'acf_wysiwyg_filters', 'convert_chars'     );
add_filter( 'acf_wysiwyg_filters', 'wpautop'           );
add_filter( 'acf_wysiwyg_filters', 'shortcode_unautop' );
add_filter( 'acf_wysiwyg_filters', 'do_shortcode'      );
add_filter( 'acf_wysiwyg_filters', 'prepend_attachment' );

$corporate_team = the_field('corporate_team'); //apply_filters( 'acf_wysiwyg_filters', get_post_meta($post->ID, 'corporate_team', true));


		?>
			<div class="text-area">
				<div class="wrap">
					<?php echo $corporate_team ; ?>
				</div>
			</div>

	</div>
</div>

<!-- full width section row -->
<div class="full-width landing-row">

<div class="landing-content">
	<h2>Related Services</h2>
</div>
</div>

<!--  Services  -->
<div class="related-services landing-row clearfix">

	<div class="landing-content flex-container">
			<div class="one-quarter column">
				<div class="column-wrap">

						<h3>Contractual<br>Agreements</h3>

						<div>
							<span>
								<span></span>
							</span>
							<span>
								<span class="border"></span>
							</span>
						</div>

						<div class="">
							<div class="">
								<ul>
									<li>Heads of terms</li>
									<li>Shareholder’s agreements</li>
									<li>Cross option agreements</li>
									<li>NDAs</li>
									<li>SLAs</li>
								</ul>
							</div>
						</div>

				</div>
			</div>



			<div class="one-quarter column">
				<div class="column-wrap">

						<h3>Commercial<br>Property</h3>

						<div>
							<span>
								<span></span>
							</span>
							<span>
								<span class="border"></span>
							</span>
						</div>

						<div class="">
							<div class="">
								<ul>
									<li>Commercial property development</li>
									<li>Commercial leases</li>
									<li>Commercial property management</li>
									<li>Funding and leasing</li>
								</ul>
							</div>
						</div>

				</div>
			</div>

			<div class="one-quarter column">
				<div class="column-wrap">

						<h3>Buying or Selling a<br>Business</h3>

						<div>
							<span>
								<span></span>
							</span>
							<span>
								<span class="border"></span>
							</span>
						</div>

						<div class="">
							<div class="">
								<ul>
									<li>Heads of terms</li>
									<li>Due diligence</li>
									<li>Sale and Purchase Agreement</li>
									<li>Disclosure letter</li>
								</ul>
							</div>
						</div>

				</div>
			</div>

			<div class="one-quarter column">
				<div class="column-wrap">

						<h3>Mergers and<br>Acquisitions</h3>

						<div>
							<span>
								<span></span>
							</span>
							<span>
								<span class="border"></span>
							</span>
						</div>

						<div class="">
							<div class="">
								<ul>
									<li>Share purchase</li>
									<li>Asset purchase</li>
									<li>Due diligence</li>
									<li>Warranties &amp; Indemnities</li>
								</ul>
							</div>
						</div>

				</div>
			</div>


	</div>

	<div class="button-container">
				<a class="button" href="#free-consultation">Free Consultation </a>
	</div>

</div>

<!-- full width section row -->
<div class="full-width landing-row clearfix">
	<div class="landing-content">
		<h2>Related Topics</h2>
	</div>
</div>

<!-- Related Topics -->
<div class="landing-row clearfix">
<div class="landing-content related-topics">


			<div class="one-third">
				<div class="column-wrap">
						<h3>Commercial Property Development</h3>
						<div class="">
								<div class="img-wrap">
									<img src=" <?php echo temp_URL . 'assets/images/commercial-property-development@2x.png'; ?>">
 								</div>
						</div>
						<div class="">
							<div class="">
								<p>Commercial property development can cover a wide range of activities from undertaking improvements to existing properties to developing a property from scratch through purchasing land, obtaining planning permission and carrying out the construction work.</p>
								<p><a href="#" target="_blank" rel="noopener">Read more…</a></p>
							</div>
						</div>
				</div>
			</div>

			<div class="one-third">
				<div class="column-wrap">
						<h3>Commercial <br/>Leases</h3>
						<div class="">
								<div class="img-wrap">
									<img src=" <?php echo temp_URL . 'assets/images/shareholders-agreements@2x.png'; ?>">
 								</div>
						</div>
						<div class="">
							<div class="">
								<p>Our commercial property team have years of experience drafting and advising on commercial leases. We act for both landlords and tenants of commercial premises and have extensive knowledge and appreciation of the issues involved from both sides of a transaction. We provide clients with clear and relevant advice that is straight forward to understand.</p>
								<p><a href="#" target="_blank" rel="noopener">Read more…</a></p>
							</div>
						</div>
				</div>
			</div>

			<div class="one-third">
				<div class="column-wrap">
						<h3 class="">Buying and Selling Commercial Property</h3>
						<div class="">
								<div class="img-wrap">
									<img src=" <?php echo temp_URL . 'assets/images/buying-and-selling-commercial-property@2x.png'; ?>">
 								</div>
						</div>
						<div class="">
							<div class="">
								<p>Our commercial property team have a wealth of experience advising on the acquisition and disposal of all types of commercial property, both leasehold and freehold, including:</p>
								<p><a href="#" target="_blank" rel="noopener">Read more…</a></p>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- title row -->
<div class="footer landing-row clearfix" id="free-consultation">
	<div class="landing-content">
		<div class="footer-form">

			<div class="form-content">
				<div class="form-content-wrap">
				<?php
				$contact_form = the_field('contact_form');
				?>
					<?php echo $contact_form ; ?>
				</div>
			</div>
		</div>
	</div>
</div>

  <?php
 }
 add_action( 'template_content_area', __NAMESPACE__ . '\clever_marketing_loop' );


 function clever_custom_footer() {

	?>
  <div class=clever-footer-section>
	  <div class="clever-footer-section-wrap">
		 <div class=clever-footer-halfs>
			 <div class="clever-half-phone">
				 <div class="footer-phone">
					 <a href="tel:+44-1483-302-000" target="_blank" rel="noopener" class="image-link">
					 <img class ="desktop" src="<?php echo temp_URL . 'assets/images/telephone-icon.svg'; ?>">
					 <img class ="mobile" src="<?php echo temp_URL . 'assets/images/telephone-icon.png'; ?>">
					 </a>
					 <span><a href="" target="_blank" rel="noopener">01483 302 000</a></span>
				 </div>
			 </div>
			 <div class="clever-half-logo">
				 <img src="<?php echo temp_URL . 'assets/images/rhw-logo-white.svg'; ?>">
			 </div>
		 </div>
		 <div class="clever-footer-credits">
			 <p>&copy; Copyright 2021 rhw Solicitors, Guildford, Surrey. GU1 2AB. All rights reserved.</p>
		 </div>
	 </div>
 </div>

	<?php

 }
 add_action( 'genesis_footer',  __NAMESPACE__ . '\clever_custom_footer', 10  );

 // Build the page
 get_header();
 do_action('template_content_area');
 get_footer();
