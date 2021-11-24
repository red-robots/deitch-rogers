<?php
/**
 * The template for displaying all pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bellaworks
 */

get_header(); ?>

<div id="primary" class="content-area-full content-default single-team">
	<main id="main" class="site-main wrapper" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

      <?php  
      $mainpic = get_field("photo_large");
      $toptext = get_field("toptext");
      $top_buttons = get_field("top_buttons");
      $buttons = array();
      $top_class = ($mainpic && $toptext) ? 'half':'full';
      ?>
      <div class="top <?php echo $top_class ?>">
        <div class="flexwrap">
          <div class="fcol left animated fadeInLeft">
            <div class="inner">
              <h1 class="page-title"><?php the_title(); ?></h1>
              <?php if ($toptext || $top_buttons) { ?>
                <?php if ($toptext) { ?>
                <div class="text"><?php echo anti_email_spam($toptext) ?></div>
                <?php } ?>
                
                <?php if ($top_buttons) { ?>
                <div class="button-group">
                  <?php foreach ($top_buttons as $b) { 
                    $btn = $b['button'];
                    $btnTitle = (isset($btn['title']) && ($btn['title'])) ? ($btn['title']) : '';
                    $btnLink = (isset($btn['url']) && ($btn['url'])) ? ($btn['url']) : '';
                    $btnTarget = (isset($btn['target']) && ($btn['target'])) ? ($btn['target']) : '_self';
                    $style = $b['button_style'];
                    $btnClass = ($style=='outline') ? 'btn-outline':'btn-green';
                    if( $btnTitle && $btnLink ) { ?>
                      <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="btn <?php echo $btnClass ?>"><?php echo $btnTitle ?></a>
                    <?php } ?>
                  <?php } ?>
                </div>
                <?php } ?>
              <?php } ?>
            </div>
          </div>
          <?php if ($mainpic) { ?>
          <div class="fcol right photo animated fadeInRight">
            <div class="img" style="background-image:url('<?php echo $mainpic['url'] ?>')">
              <img src="<?php echo $mainpic['url'] ?>" alt="<?php echo $mainpic['title'] ?>" class="actual-image">
            </div>
          </div>
          <?php } ?>
        </div>
      </div>

      <?php $smallpic = get_field("photo"); ?>
      <div class="entry-content wow fadeIn <?php echo ($smallpic) ? 'haspic':'nopic' ?>">
        <?php if ($smallpic) { ?>
          <span class="profpic" style="background-image:url('<?php echo $smallpic['url'] ?>')">
            <img src="<?php echo get_images_dir('square.png') ?>" alt="">
          </span>
        <?php } ?>
        <?php the_content(); ?>
      </div>

		<?php endwhile; ?>

    <?php 
      $show_logo = true;
      $global_Opt = get_field("global_form_opt",54);
      include( locate_template('parts/global-form-options.php') ); 
    ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php 
  $show_logo = true;
  include( locate_template('parts/contact-form.php') ); 
?>

<?php
get_footer();
