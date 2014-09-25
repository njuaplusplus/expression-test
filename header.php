<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title>
<?php if (is_home() || is_front_page()) {
	if(pex_text('_seo_home_title')){
		echo pex_text('_seo_home_title').' '.get_opt('_seo_serapartor').' ';
	}
} elseif (is_category()) {
	echo pex_text('_seo_category_title'); wp_title('&laquo; '.get_opt('_seo_serapartor').' ', TRUE, 'right');
} elseif (is_tag()) {
	echo pex_text('_seo_tag_title'); wp_title('&laquo; '.get_opt('_seo_serapartor').' ', TRUE, 'right');
} elseif (is_search()) {
	echo pex_text('_search_tag_title');
	echo the_search_query();
	echo '&laquo; '.get_opt('_seo_serapartor').' ';
} elseif (is_404()) {
	echo '404 '; wp_title(' '.get_opt('_seo_serapartor').' ', TRUE, 'right');
} else {
	echo wp_title(' '.get_opt('_seo_serapartor').' ', TRUE, 'right');
} 
echo bloginfo('name');
?>
</title>

<?php
global $post;
if(is_singular() && isset($post)){
	if($post->post_type=='portfolio'){
		$image = pexeto_get_portfolio_preview_img($post);
	}elseif(has_post_thumbnail($post->ID)){
		$image = pexeto_get_featured_image_url($post->ID);
	}

	if(isset($image)){ ?>
	<!-- facebook meta tag for image -->
    <meta property="og:image" content="<?php echo $image; ?>"/>
    <!-- Google+ meta tag for image -->
    <meta itemprop="image" content="<?php echo $image; ?>">
<?php }

} ?>


<!-- Description meta-->
<meta name="description" content="<?php if ((is_home() || is_front_page()) && get_opt('_seo_description')) { echo (get_opt('_seo_description')); }else{ bloginfo('description');}?>" />
<!-- Mobile Devices Viewport Resset-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- <meta name="viewport" content="initial-scale=1.0, user-scalable=1" /> -->
<?php if(get_opt('_seo_keywords')){ ?>
<!-- Keywords-->
<meta name="keywords" content="<?php echo get_opt('_seo_keywords'); ?>" />
<?php } ?>




<?php 
//remove SEO indexation and following for the selected archives pages
if(is_archive() || is_search()){
	$pages=pex_get_multiopt('_seo_indexation');
	if((is_category() && in_array('category', $pages))
	|| (is_author() && in_array('author', $pages))
	|| (is_tag() && in_array('tag', $pages))
	|| (is_date() && in_array('date', $pages))
	|| (is_search() && in_array('search', $pages))){ ?>
	<!-- Disallow contain indexation on this page to remove duplicate content problems -->
	<meta name="googlebot" content="noindex,nofollow" />
	<meta name="robots" content="noindex,nofollow" />
	<meta name="msnbot" content="noindex,nofollow" />
	<?php }
}
?>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_opt('_favicon'); ?>" />
<!--Google fonts-->
<?php if(get_opt('_enable_google_fonts')!='off'){
$fonts=pexeto_get_google_fonts();
foreach($fonts as $font){
	?>
<link href='<?php echo $font; ?>' rel='stylesheet' type='text/css' />
<?php }
}

//INCLUDE THE STYLES
$cssuri = get_template_directory_uri().'/css/';
wp_enqueue_style('pexeto-pretty-photo', $cssuri.'prettyPhoto.css');
wp_enqueue_style('pexeto-stylesheet', get_bloginfo('stylesheet_url'));
wp_enqueue_style('pexeto-css-loader', $cssuri.'cssLoader.php');

//INCLUDE THE SCRIPTS
$jsuri=get_template_directory_uri().'/js/';
wp_enqueue_script('jquery');
wp_enqueue_script('underscore');

wp_enqueue_script("pexeto-main", $jsuri.'main.js', array("jquery", "underscore"));

$enable_cufon=get_opt('_enable_cufon');
if($enable_cufon=='on'){
	if(get_opt('_custom_cufon_font')!=''){
		$font_file=get_opt('_custom_cufon_font');
	}else{
		$font_file=get_template_directory_uri().'/js/fonts/'.get_opt('_cufon_font');
	}
	wp_enqueue_script("pexeto-cufon", $jsuri.'cufon-yui.js');
	wp_enqueue_script("pexeto-cufon-font", $font_file);
}

$slider_layout=false;
if(is_single() && get_post_type() == PEXETO_PORTFOLIO_POST_TYPE && isset($post)){
	$layout = get_post_meta($post->ID, 'action_value', true);
	if($layout == 'slider_full_height' || $layout == 'slider_full_width'){
		$slider_layout = true;
	}
}


if (is_page_template('template-grid-gallery.php') || $slider_layout) { 
	//load the scripts for the portfolio gallery template
	wp_register_script("pexeto-iscroll", $jsuri.'iscroll.js');
	wp_enqueue_script("pexeto-grid-gallery", $jsuri.'grid-gallery.js', array("jquery", "pexeto-main"));
} 

if(is_page_template('template-full-width-slideshow.php') || is_page_template('template-full-height-slideshow.php')){
	wp_enqueue_script("pexeto-full-slideshow", $jsuri.'slideshow.js', array("jquery", "pexeto-main"));
}

wp_head(); ?>


<?php 
$sociable_lightbox=get_opt('_sociable_lightbox')=='on'?'true':'false'; 
$logo_height=get_opt('_logo_height')||116;
$disable_right_click=get_opt('_disable_click')=='on'?'true':'false';
?>
<script type="text/javascript">
PEXETO.ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>";
PEXETO.enableCufon="<?php echo $enable_cufon; ?>";
<?php $desaturate=get_opt('_home_desaturate')=='off'?'false':'true'; ?>
PEXETO.desaturateServices=<?php echo $desaturate; ?>;
PEXETO.lightboxOptions = <?php echo json_encode(pexeto_get_lightbox_options()); ?>;
PEXETO.disableRightClick=<?php echo $disable_right_click; ?>;
PEXETO.rightClickMessage="<?php echo str_replace("\r\n", "\\n", addslashes(pex_text('_click_message'))) ; ?>";
jQuery(document).ready(function($){
	PEXETO.initSite();
});
</script>
	
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<!--[if lte IE 7]>
<link href="<?php echo get_template_directory_uri(); ?>/css/style_ie7.css" rel="stylesheet" type="text/css" />  
<![endif]-->
<!--[if lte IE 8]>
<link href="<?php echo get_template_directory_uri(); ?>/css/style_ie8.css" rel="stylesheet" type="text/css" />  
<![endif]-->

</head>
<body <?php body_class(); ?>>

<?php 
$bgimage = null;
if(isset($post)){
$bgimage = get_post_meta($post->ID, 'full_bg_value', true);
}
if(!$bgimage){
	$bgimage=get_opt('_fullwidth_bg_image');
}
if($bgimage && !is_page_template('template-full-width-slideshow.php')){ 
	?>
<img class="bg-image" src="<?php echo $bgimage; ?>" />
<?php if(get_opt('_bg_top_pattern')!='off'){?>
<div class="bg-image-pattern"></div>
<?php } ?>
<script type="text/javascript">
jQuery(document).ready(function($){
	PEXETO.setResizingBg();
});
</script>
<?php } ?>
<div id="main-container">
<!--HEADER -->
	<div id="header">
		<div id="logo-container"><a href="<?php echo home_url(); ?>"></a></div>
		<?php if(get_opt('_display_tagline')!='off'){ ?>
		<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
		<?php } ?>
 		<div id="navigation-container">
 			 <div id="small-res-menu-wraper">
 				<div id="small-res-menu-button"><p href=""><span></span><?php echo pex_text('_menu_text'); ?></p></div>
 			<div id="small-res-menu">
				<?php wp_nav_menu(array('theme_location' => 'pexeto_main_menu', 'fallback_cb'=>'pexeto_no_menu')); ?>
				</div></div>
			<div id="menu-container">
	        	<div id="menu">
				<?php wp_nav_menu(array('theme_location' => 'pexeto_main_menu', 'fallback_cb'=>'pexeto_no_menu')); ?>
				</div>
	        </div> 

	        	<?php 
			//PRINT THE SOCIABLE ICONS
			if(get_opt('_show_footer_icons')=='on'){
				$icon_links=explode(PEXETO_SEPARATOR, get_option('_icon_links'));
				$icon_imgs=explode(PEXETO_SEPARATOR, get_option('_icon_urls'));
				$icon_titles=explode(PEXETO_SEPARATOR, get_option('_icon_titles'));
				array_pop($icon_links);
				array_pop($icon_imgs);
				array_pop($icon_titles);
				?>
				<div id="header-social-icons"><ul>
				<?php for($i=0; $i<sizeof($icon_links); $i++){
				$title=$icon_titles[$i]?' title="'.$icon_titles[$i].'"':'';
					?>
				<li><a href="<?php echo $icon_links[$i];?>" target="_blank" <?php echo $title; ?>><div><img src="<?php echo $icon_imgs[$i]; ?>" alt="" /></div></a></li>
				<?php } ?>
				</ul></div>
				<?php 
			}
			?>

    	</div> 
	    <div class="clear"></div>       
	    <div id="navigation-line"></div>
	</div> <!-- end #header -->
