<?php
/**
 * Template Name: Expertise Child Page
 */
get_header(); ?>
<div id="primary" class="content-area">
	<main id="main" class="site-main wrapper">

		<?php while ( have_posts() ) : the_post(); ?>
      <header class="entry-title" style="display:none"><h1 class="page-title"><?php the_title(); ?></h1></header>
    <?php endwhile; ?>  

      <?php /* ROW 1 */
      $row1_photo = get_field("row1_photo");
      $row1_title = get_field("row1_title");
      $row1_text = get_field("row1_text");
      $row1_buttons = get_field("row1_buttons");
      $row1_class = ( $row1_text || $row1_photo ) ? 'half':'full';
      if( $row1_text || $row1_photo ) { ?>
      <div class="s1-text-image <?php echo $row1_class ?>">
        <div class="flexwrap">

          <?php if ($row1_text) { ?>
            <div class="fcol text wow fadeInLeft">
              <div class="inside">
                <div class="info">
                    <?php if ($row1_title) { ?>
                     <h2 class="title"><?php echo $row1_title ?></h2> 
                    <?php } ?>
                    <?php echo anti_email_spam($row1_text); ?>
                </div>
                <?php if ($row1_buttons) { ?>
                <div class="button-group  wow fadeInDown">
                  <?php foreach ($row1_buttons as $b) { 
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
            </div>
            <?php } ?>

            <?php if ($row1_photo) { ?>
            <div class="fcol image wow fadeInRight">
              <div class="img" style="background-image:url('<?php echo $row1_photo['url'] ?>')">
                <img src="<?php echo $row1_photo['url'] ?>" alt="<?php echo $row1_photo['title'] ?>">
              </div>
            </div>
            <?php } ?>

        </div>
      </div>
      <?php } ?>

      <?php  /* ROW 2 */
      $row2_text = get_field("row2_text");
      if($row2_text) { ?>
      <div class="s2-regular-text full-text-block wow fadeInUp">
        <div class="wrapper">
          <?php echo anti_email_spam($row2_text) ?>
        </div>
      </div>
      <?php } ?>


      <?php /* ROW 3 (FLEXIBLE CONTENT) */ ?>
      <?php if( have_rows('row3_content') ) { ?>

        <?php while ( have_rows('row3_content') ) : the_row(); ?>
          
          <?php if( get_row_layout() == 'row_3_content' ) { 
            $title = get_sub_field('title'); 
            $descriptio = get_sub_field('short_description'); 
            $buttons = get_sub_field('buttons'); 
            $image = get_sub_field('image'); 
            ?>
          <?php } ?>

        <?php endwhile; ?>

      <?php } ?>
		
	</main>
</div>
<?php
get_footer();
