<?php
/**
 * The template for Home Page
 */
get_header(); 
$large_text = get_field("left_large_text");
$small_text = get_field("left_small_text");
$grid_images = get_field("grid_images");
$left_buttons = get_field("left_buttons");
$hero_class = ( ($large_text || $small_text) && $grid_images ) ? 'half':'full';
?>

<div class="home-hero fw <?php echo $hero_class ?>">
  <div class="fullwrap fw">
    <div class="hero-inner fw">
      <?php if ($large_text || $small_text) { ?>
      <div class="hero-col left">

        <?php if ($large_text) { ?>
        <div class="large-text">
          <?php echo $large_text ?>
        </div>
        <?php } ?>

        <?php if ($small_text) { ?>
        <div class="small-text">
          <?php echo $small_text ?>
        </div>
        <?php } ?>

        <?php if ($left_buttons) { ?>
        <div class="buttons">
          <?php foreach ($left_buttons as $b) { 
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
        
      </div>
      <?php } ?>

      <?php if ( $grid_images ) { ?>
      <div class="hero-col right">
        <div class="masonry">
          <?php foreach ($grid_images as $img) { 
            $front_img = $img['front_image'];
            $back_img = $img['back_image'];
            $back_text = $img['back_text'];
            $btn = $img['button'];
            $target = ( isset($btn['target']) && $btn['target'] ) ? $btn['target'] : '_self';
            $btnLink = ( isset($btn['url']) && $btn['url'] ) ? $btn['url'] : '';
            $btnTitle = ( isset($btn['title']) && $btn['title'] ) ? $btn['title'] : '';
            $open_link = '<div class="card">';
            $close_link = '</div>';
            if($btnLink) {
              $open_link = '<a href="'.$btnLink.'" class="card">';
              $close_link = '</a>';
            }
            if($front_img) { ?>
            <div class="block">
              <?php echo $open_link ?>
                <span class="front img" style="background-image:url('<?php echo $front_img['url'] ?>')">
                </span>
                <?php if($back_img) { ?>
                <span class="back img" style="background-image:url('<?php echo $back_img['url'] ?>')">
                  <?php if ($back_text) { ?>
                    <span class="text"><?php echo $back_text ?></span>
                  <?php } ?>
                </span>
                <?php } ?>  
                <img src="<?php echo get_images_dir('square.png') ?>" alt="">
              <?php echo $close_link ?>
            </div>  
            <?php } ?>  
          <?php } ?>
        </div>
      </div>
      <?php } ?>

    </div>
  </div>
</div>


<div id="primary" class="content-area home-content">
  <?php while ( have_posts() ) : the_post(); ?>
	
	<?php endwhile; ?>	
</div>
<?php
get_footer();
