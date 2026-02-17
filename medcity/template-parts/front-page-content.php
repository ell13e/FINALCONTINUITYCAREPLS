<?php
/**
 * Front page content — Medcity homepage sections (CCS).
 * No blocks: pre-built layout like CTA theme.
 *
 * @package CCS_Theme
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$t = get_template_directory_uri();
$contact_url = home_url( '/contact-us/' );
$about_url  = home_url( '/about-us/' );
$services_url = home_url( '/our-services/' );
?>

<section class="slider">
	<div class="slick-carousel m-slides-0" data-slick='{"slidesToShow": 1, "arrows": true, "dots": false, "speed": 700,"fade": true,"cssEase": "linear"}'>
		<div class="slide-item align-v-h">
			<div class="bg-img"><img src="<?php echo esc_url( $t ); ?>/assets/images/sliders/1.jpg" alt="slide img"></div>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
						<div class="slide__content">
							<h2 class="slide__title">Your Team, Your Time, Your Life</h2>
							<p class="slide__desc">Continuity Care Services — regulated, rated and reliable home care across Maidstone &amp; Kent.</p>
							<ul class="features-list list-unstyled mb-0 d-flex flex-wrap">
								<li class="feature-item"><div class="feature__icon"><i class="icon-heart"></i></div><h2 class="feature__title">Person-centred care</h2></li>
								<li class="feature-item"><div class="feature__icon"><i class="icon-medicine"></i></div><h2 class="feature__title">Quality assured</h2></li>
								<li class="feature-item"><div class="feature__icon"><i class="icon-heart2"></i></div><h2 class="feature__title">Local &amp; reliable</h2></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="slide-item align-v-h">
			<div class="bg-img"><img src="<?php echo esc_url( $t ); ?>/assets/images/sliders/2.jpg" alt="slide img"></div>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
						<div class="slide__content">
							<h2 class="slide__title">Home Care in Maidstone &amp; Kent</h2>
							<p class="slide__desc">We deliver quality of care in a courteous, respectful, and compassionate manner.</p>
							<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn__primary btn__rounded"><span>Contact us</span> <i class="icon-arrow-right"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="contact-info py-0">
	<div class="container">
		<div class="row row-no-gutter boxes-wrapper">
			<div class="col-sm-12 col-md-4">
				<div class="contact-box d-flex">
					<div class="contact__icon"><i class="icon-call3"></i></div>
					<div class="contact__content">
						<h2 class="contact__title">Get in touch</h2>
						<p class="contact__desc">Contact our friendly team for care enquiries or support.</p>
						<a href="tel:01622689047" class="phone__number"><i class="icon-phone"></i> <span>01622 689 047</span></a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="contact-box d-flex">
					<div class="contact__icon"><i class="icon-location"></i></div>
					<div class="contact__content">
						<h2 class="contact__title">Visit us</h2>
						<p class="contact__desc">The Maidstone Studios, New Cut Road, Maidstone, Kent, ME14 5NZ</p>
						<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn__white btn__outlined btn__rounded"><span>Contact us</span><i class="icon-arrow-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-sm-12 col-md-4">
				<div class="contact-box d-flex">
					<div class="contact__icon"><i class="icon-heart2"></i></div>
					<div class="contact__content">
						<h2 class="contact__title">Our services</h2>
						<p class="contact__desc">Regulated, rated and reliable home care.</p>
						<a href="<?php echo esc_url( $services_url ); ?>" class="btn btn__white btn__outlined btn__rounded"><span>Our Services</span><i class="icon-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="about-layout2 pb-0">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-7 offset-lg-1">
				<div class="heading-layout2">
					<h3 class="heading__title mb-60">Your Team, Your Time, Your Life.</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-5">
				<div class="text-with-icon">
					<div class="text__icon"><i class="icon-doctor"></i></div>
					<div class="text__content">
						<p class="heading__desc font-weight-bold color-secondary mb-30">Our goal is to deliver quality of care in a courteous, respectful, and compassionate manner. We hope you will allow us to care for you and strive to be the first and best choice for home care.</p>
						<a href="<?php echo esc_url( $about_url ); ?>" class="btn btn__secondary btn__rounded mb-70"><span>About Us</span> <i class="icon-arrow-right"></i></a>
					</div>
				</div>
				<div class="video-banner-layout2 bg-overlay">
					<img src="<?php echo esc_url( $t ); ?>/assets/images/about/2.jpg" alt="About Continuity Care Services" class="w-100" loading="lazy">
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-7">
				<div class="about__text bg-white">
					<p class="heading__desc mb-30">We deliver quality of care in a courteous, respectful, and compassionate manner. We hope you will allow us to care for you and to be the first and best choice for home care in Maidstone &amp; Kent.</p>
					<p class="heading__desc mb-30">We will work with you to develop individualised care plans. We are committed to being the region’s premier home care provider, offering person-centred care that inspires confidence and quality of life.</p>
					<ul class="list-items list-unstyled">
						<li>We conduct assessments to understand your needs and determine the right support for you.</li>
						<li>Our expert care team manage a broad range of care and support needs.</li>
						<li>We offer a wide range of care and support, from personal care to companionship and specialist care.</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="notes border-top pt-60 pb-60">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-6">
				<div class="note font-weight-bold">
					<i class="far fa-file-alt color-primary"></i>
					<span>Your Team, Your Time, Your Life.</span>
					<a href="<?php echo esc_url( $about_url ); ?>" class="btn btn__link btn__secondary"><span>About Us</span><i class="icon-arrow-right"></i></a>
				</div>
			</div>
			<div class="col-sm-12 col-md-12 col-lg-6">
				<div class="info__meta d-flex flex-wrap justify-content-between align-items-center">
					<div class="testimonials__rating">
						<div class="testimonials__rating-inner d-flex align-items-center">
							<span class="total__rate">Continuity Care Services</span>
							<div><span class="overall__rate">Regulated, rated and reliable</span><span> home care across Maidstone &amp; Kent.</span></div>
						</div>
					</div>
					<a href="<?php echo esc_url( $contact_url ); ?>" class="btn btn__primary btn__rounded"><span>Contact us</span> <i class="icon-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>
