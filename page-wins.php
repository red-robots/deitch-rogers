<?php
/**
 * Template Name: Wins
 */
get_header();
global $post; 
$post_id = $post->ID;
$counter = 1;
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main">

    <div class="wrapper">
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
    </div>

    <?php  /* ROW 2 ==> MAIN TEXT */
    $row2_text = get_field("row2_text");
    if($row2_text) { ?>
    <div class="s2-regular-text full-text-block wow fadeInUp">
      <div class="wrapper">
        <?php echo anti_email_spam($row2_text) ?>
      </div>
    </div>
    <?php } ?>

    <?php
      $paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
      $args = array(
        'posts_per_page'   => 10,
        'post_type'        => 'wins',
        'post_status'      => 'publish',
        'paged'            => $paged
      );
      $wins = new WP_Query($args);
      if ( $wins->have_posts() ) { ?>
        <div id="cpt-feeds" class="s2-regular-text full-text-block wow fadeInUp">
          <div class="wrapper">
          <?php while ( $wins->have_posts() ) : $wins->the_post(); ?>
            <article id="post-<?php the_ID(); ?>" class="post-entry wow fadeIn">
              <h3 class="post-title"><?php the_title() ?></h1>
              <div class="post-excerpt"><?php the_content('Read More &rarr;'); ?></div>
            </article>
          <?php endwhile; wp_reset_postdata(); ?>
          </div>

          <?php
          $total_pages = $wins->max_num_pages;
          if ($total_pages > 1){ ?>
          <div id="pagination" class="pagination">
            <div class="wrapper">
              <?php
                $pagination = array(
                    'base' => @add_query_arg('pg','%#%'),
                    'format' => '?paged=%#%',
                    'current' => $paged,
                    'total' => $total_pages,
                    'prev_text' => __( '&laquo;', 'red_partners' ),
                    'next_text' => __( '&raquo;', 'red_partners' ),
                    'type' => 'plain'
                );
                echo paginate_links($pagination);
              ?>
            </div>  
          </div>
          <?php } ?>

        </div>
      <?php } ?>

    <?php /* ROW 3 (FLEXIBLE CONTENT) */ ?>
    <?php if( have_rows('row3_content') ) { ?>

      <?php $n=1; while ( have_rows('row3_content') ) : the_row(); ?>
        
        <?php 
        /* Title, Brief Description and Image */
        if( get_row_layout() == 'title_brief_image' ) { 
          $title = get_sub_field('title'); 
          $short_description = get_sub_field('short_description'); 
          $buttons = get_sub_field('buttons'); 
          $image = get_sub_field('image'); 
          $image_position = get_sub_field("image_position");
          $pos = ($image_position) ? ' image-'.$image_position : "";
          $buttons = get_sub_field("buttons");
          $section =  ($image && ($title || $short_description) ) ? ' half':' full'; 
          if( $image || ($title || $short_description) ) { 
          $oddeven = ($n % 2 == 0) ? 'even':'odd'; 
          $first = ($n==1) ? ' first':'';
          ?>
          <div class="image-text-section flexcontent <?php echo $oddeven.$section.$first.$pos ?>">
            <?php if ($image) { ?>
            <div class="flexwrap full">
              <div class="fcol image parallax-image-block wow fadeIn" style="background-image:url('<?php echo $image['url'] ?>')">
              </div>  
            </div>
            <?php } ?>
            <div class="text-content wrapper">
              <div class="flexwrap">

                <?php if ($image) { ?>
                <div class="fcol image hidden" style="background-image:url('<?php echo $image['url'] ?>')">
                  <img src="<?php echo get_images_dir('square.png') ?>" alt="" class="img-helper">
                </div>
                <?php } ?>

                <?php if ($title || $short_description) { ?>
                  <div class="fcol text wow fadeInUp">
                    <div class="info">
                      <?php if ($title) { ?>
                        <h2 class="h2"><?php echo $title ?></h3>
                      <?php } ?>
                      <?php if ($short_description) { ?>
                        <?php echo anti_email_spam($short_description); ?>
                      <?php } ?>

                      <?php if ($buttons) { ?>
                        <div class="button-group">
                          <?php foreach ($buttons as $b) { 
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
              </div>
            </div>
          </div>
          <?php $n++; $counter++; } ?>
        <?php }

        /* Long Description (Fullwidth Text) */
        else if( get_row_layout() == 'long_description_fullwidth_text' ) { 
          if( $full_text = get_sub_field('full_text') ) {  ?>
          <div class="full-text-block flexcontent">
            <div class="wrapper">
              <?php echo $full_text ?>
            </div>
          </div>
          <?php } ?>
        <?php } 

        /* Icon, Title and Text */
        else if( get_row_layout() == 'icon_title_text' ) { 
          $textWithIcons = get_sub_field('content');
          if($textWithIcons) { ?>
          <div class="text-with-icons fw flexcontent wow fadeInUp">
            <div class="wrapper">
              <div class="wrap2">
                <div class="flexwrap">
                <?php foreach ($textWithIcons as $e) { 
                  $icon = $e['icon'];
                  $title = $e['title'];
                  $text = $e['text'];
                  $button = $e['button']; 
                  $btnTarget = ( isset($button['target']) && $button['target'] ) ? $button['target'] : '_self';
                  $btnTitle = ( isset($button['title']) && $button['title'] ) ? $button['title'] : '';
                  $btnLink = ( isset($button['url']) && $button['url'] ) ? $button['url'] : '';
                  if( $title || $text ) { ?>
                  <div class="twi wow fadeInUp">
                    <?php if ($icon) { ?>
                      <div class="icon">
                        <span style="background-image:url(<?php echo $icon['url'] ?>)"></span>
                      </div>
                    <?php } ?>
                    <?php if ($title) { ?>
                      <h3 class="title"><?php echo $title ?></h3>
                    <?php } ?>
                    <?php if ($text) { ?>
                      <div class="text"><?php echo anti_email_spam($text) ?></div>
                    <?php } ?>
                    <?php if ($btnTitle && $btnLink) { ?>
                    <div class="button">
                      <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="btn-link"><?php echo $btnTitle ?></a>
                    </div>
                    <?php } ?>
                  </div>
                  <?php } ?>
                <?php } ?>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        <?php } 
        
        /* Get Justice Now */
        else if( get_row_layout() == 'get_justice' ) { 
          $title = get_sub_field('title');
          $text = get_sub_field('text');
          $icons = get_sub_field('icons');
          if($title || $text) { ?>
            <div id="getjustice" class="full-text-block fw wow fadeInUp">
              <div class="wrapper">

                <?php if ($text) { 
                  $iconDivClass = ($title && $text ) ? 'half':'full';
                  ?>
                  <div class="contact-section <?php echo $iconDivClass ?>">
                    <div class="flexwrap">

                      <?php if ($title) { ?>
                      <div class="cs-col titlecol"><h3 class="title-green h1"><?php echo $title ?></h3></div>
                      <?php } ?>

                      <?php if ($text) { ?>
                      <div class="cs-col contact <?php echo ($icons) ? 'has-icons':'' ?>">
                        <div class="contact-inner">
                          <?php if ($icons) { ?>
                            <div class="icons">
                              <div class="pad">
                              <?php foreach ($icons as $img) { ?>
                                <div class="icondiv">
                                  <img src="<?php echo $img['url'] ?>" alt="" class="icon" />
                                </div>
                              <?php } ?>
                              </div>
                            </div>
                          <?php } ?>
                          <div class="textcol"><?php echo anti_email_spam($text) ?></div>
                        </div>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          <?php } ?> 
        <?php } 


        /* Image + Logo and Detailed Form */
        else if( get_row_layout() == 'detailed_form' ) { 
          $image = get_sub_field('df_featured_image');
          $logo = get_sub_field('df_logo');
          $text = get_sub_field('df_text');
          $df_form = get_sub_field('df_form');
          $image_position = get_sub_field('df_position');
          $df_pos = ($image_position) ? ' image-'.$image_position:'';
          $df_class = ($df_form && ($image ||$text) ) ? 'half' : 'full';
          if($df_form || ($image ||$text) ) { ?>
          <div class="detailedForm fw <?php echo $df_class.$df_pos ?>">
            <div class="flexwrap">
              <?php if ($image || $text) { ?>
                <div class="fcol left wow fadeIn">
                  <?php if ($image) { ?>
                  <div class="image" style="background-image:url('<?php echo $image['url'] ?>')">
                    <?php if ($logo) { ?>
                     <img src="<?php echo $logo['url'] ?>" alt="" class="logo-overlay">
                    <?php } ?>
                    <img src="<?php echo get_images_dir('square.png') ?>" alt="" class="img-helper">
                  </div>
                  <?php } ?>

                  <?php if ($text) { ?>
                  <div class="text"><div class="wrap"><?php echo anti_email_spam($text); ?></div></div>
                  <?php } ?>
                </div>
              <?php } ?>

              <?php if ($df_form) { ?>
                <div class="fcol right wow fadeIn">
                  <div class="wrap">
                    <?php echo $df_form; ?>
                  </div>
                </div>  
              <?php } ?>
            </div>
          </div>
          <?php } ?>

        <?php } ?>

      <?php endwhile; ?>

    <?php } ?>


    <?php /* Contact Form */ ?>
    <?php include( locate_template('parts/contact-form-post-type.php') ); ?>
    
		
	</main>
</div>
<script type="text/javascript">
jQuery(document).ready(function($){
  if( $("#cpt-feeds .more-link").length ) {
    $("#cpt-feeds .more-link").each(function(){
      $(this).wrapAll('<div class="morediv"></div>');
    });
  }
});
</script>
<?php
get_footer();
