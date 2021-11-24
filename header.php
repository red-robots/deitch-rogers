<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php bloginfo("template_url") ?>/css/jquery.fancybox.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<?php if ( is_singular(array('post')) ) { 
global $post;
$post_id = $post->ID;
$thumbId = get_post_thumbnail_id($post_id); 
$featImg = wp_get_attachment_image_src($thumbId,'full'); ?>
<!-- SOCIAL MEDIA META TAGS -->
<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
<meta property="og:url"		content="<?php echo get_permalink(); ?>" />
<meta property="og:type"	content="article" />
<meta property="og:title"	content="<?php echo get_the_title(); ?>" />
<meta property="og:description"	content="<?php echo (get_the_excerpt()) ? strip_tags(get_the_excerpt()):''; ?>" />
<?php if ($featImg) { ?>
<meta property="og:image"	content="<?php echo $featImg[0] ?>" />
<?php } ?>
<!-- end of SOCIAL MEDIA META TAGS -->
<?php } ?>
<script>
var siteURL = '<?php echo get_site_url();?>';
var currentURL = '<?php echo get_permalink();?>';
var params={};location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi,function(s,k,v){params[k]=v});
</script>
<?php wp_head(); ?>
</head>
<?php 
$banner = get_field("banner"); 
$body = ($banner) ? 'has-banner':'';

$hb = get_field("header_cta_button","option");
$btnTarget = ( isset($hb['target']) && $hb['target'] ) ? $hb['target'] : '_self';
$btnName = ( isset($hb['title']) && $hb['title'] ) ? $hb['title'] : '';
$btnLink = ( isset($hb['url']) && $hb['url'] ) ? $hb['url'] : '';
?>
<body <?php body_class($body);?>>
<div id="page" class="site cf">
	<div id="overlay"></div>
	<a class="skip-link sr" href="#content"><?php esc_html_e( 'Skip to content', 'bellaworks' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="wrapper">
      <div class="flexwrap">
  			<div id="site-logo">
  				<a href="<?php bloginfo('url'); ?>"><?php get_template_part('parts/logo') ?></a>
  			</div>

        <a class="mobile-menu" id="menutoggle" href="#mobile-menu"><span class="bar"></span><i>Menu</i></a>

        <div id="siteNav" class="outerNav">
    			<nav id="site-navigation" class="main-navigation animated fadeIn" role="navigation">
            <?php wp_nav_menu( array( 'theme_location' => 'primary', 'container'=>false, 'menu_id' => 'primary-menu','link_before'=>'<span>','link_after'=>'</span>',) ); ?>
          </nav>
          <?php if ($btnName && $btnLink) { ?>
          <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="top-cta-btn btn-contact animated fadeInDown"><span><?php echo $btnName ?></span></a>
          <?php } ?>
        </div>
        <div class="menu-overlay"></div>
      
  		</div>
    </div>	
	</header>
  <div id="navOverlay"></div>

	<?php get_template_part('parts/hero'); ?>

	<div id="content" class="site-content fw">
