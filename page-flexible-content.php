<?php
/**
 * Template Name: Page with Flexible Content
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

      <?php  /* ROW 2 */
      $row2_text = get_field("row2_text");
      if($row2_text) { ?>
      <div class="s2-regular-text full-text-block wow fadeInUp">
        <div class="wrapper">
          <?php echo anti_email_spam($row2_text) ?>
        </div>
      </div>
      <?php } ?>
    </div>


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
          $frame_images = get_sub_field('frame_images');
          $frame_type = ( get_sub_field('frame_type') ) ? get_sub_field('frame_type') : 'frame1';
          $mirror_image_url = ($image) ? $image['url'] : '';
          
          if( ($image || $frame_images) || ($title || $short_description) ) { 
            $oddeven = ($n % 2 == 0) ? 'even':'odd'; 
            $first = ($n==1) ? ' first':'';
            
            $maxImages = 4;
            $frameNumImages['frame1'] = 1;
            $frameNumImages['frame2'] = 2;
            $frameNumImages['frame3'] = 3;
            $frameNumImages['frame4'] = 4;
            $frameNumImages['frame5'] = 4;
            
            $count_images = ($frame_images) ? count($frame_images) : 0;
            
            if( $count_images > $maxImages ) {
              foreach($frame_images as $k=>$v) {
                if($k>=$frameNumImages[$frame_type]) {
                  unset($frame_images[$k]);
                }
              }
            }

            if($count_images==1) {
              $frame_type = 'frame1';
            }
            else if($count_images==2) {
              $frame_type = 'frame2';
            }
            else if( $frame_type=='frame2' && $count_images>2 ) {
              $frame_type = 'frame2';
              if($frame_images) {
                foreach($frame_images as $k=>$v) {
                  if($k>=$frameNumImages[$frame_type]) {
                    unset($frame_images[$k]);
                  }
                }
              }
            }
            else if( ($frame_type=='frame4' || $frame_type=='frame5') && $count_images<$maxImages ) {
              $frame_type = 'frame3';
              if($frame_images) {
                foreach($frame_images as $k=>$v) {
                  if($k>=$frameNumImages[$frame_type]) {
                    unset($frame_images[$k]);
                  }
                }
              }
            }

            if($frame_type!='frame1' && $frame_images ) {
              $mirror_image_url = ($frame_images) ? $frame_images[0]['url'] : '';
            }

            $section =  ($mirror_image_url && ($title || $short_description) ) ? ' half':' full'; 
          
            ?>
            <div class="image-text-section has-collage-field flexcontent <?php echo $oddeven.$section.$first.$pos ?> type_<?php echo $frame_type ?>">

              <?php if($frame_type=='frame1') {  ?>
                
                <?php if ($image) { ?>
                <div class="flexwrap full">
                  <div class="fcol image parallax-image-block wow fadeIn" style="background-image:url('<?php echo $image['url'] ?>')">
                  </div>  
                </div>
                <?php } else { ?>

                  <?php if ($frame_images) { ?>
                  <div class="flexwrap full">
                    <div class="fcol image parallax-image-block wow fadeIn" style="background-image:url('<?php echo $frame_images[0]['url'] ?>')">
                    </div>  
                  </div>
                  <?php } ?>

                <?php } ?>

              <?php } else { ?>

                <?php if ($frame_images) { ?>

                  <?php if ($count_images==1) { ?>
                  <div class="flexwrap full">
                    <div class="fcol image parallax-image-block wow fadeIn" style="background-image:url('<?php echo $frame_images[0]['url'] ?>')">
                    </div>  
                  </div>
                  <?php } else { ?>

                  <div id="framedImages" class="flexwrap full multiple-images count_<?php echo $count_images ?> <?php echo $frame_type ?>">
                    <div class="collage">
                      <div class="images">
                      <?php $ctr=1; foreach ($frame_images as $img) { 
                        $image_helper = get_images_dir('square2.gif');
                        ?>
                        <?php if ($frame_type=='frame3') { ?>
                            
                            <?php if ($ctr==1) { ?>
                              <di class="col1">
                                <div class="image-item img<?php echo $ctr ?>" id="imgid<?php echo $img['ID'] ?>" style="background-image:url('<?php echo $img['url'] ?>')">
                                  <img src="<?php echo $image_helper ?>" alt="" />
                                </div>
                              </di>
                              <div class="col2">
                            <?php } ?>

                            <?php if ($ctr>1) { ?>
                            <div class="image-item img<?php echo $ctr ?>" id="imgid<?php echo $img['ID'] ?>" style="background-image:url('<?php echo $img['url'] ?>')">
                              <img src="<?php echo $image_helper ?>" alt="" />
                            </div>
                            <?php } ?>

                            <?php if ($ctr==$count_images) { ?>
                              </div>
                            <?php } ?>

                        <?php } else { ?>
                          <div class="image-item img<?php echo $ctr ?>" id="imgid<?php echo $img['ID'] ?>" style="background-image:url('<?php echo $img['url'] ?>')">
                            <img src="<?php echo $image_helper ?>" alt="" />
                          </div>
                        <?php } ?>

                      <?php $ctr++; } ?>
                      </div>
                    </div>
                  </div>

                  <?php } ?>
                  
                <?php } ?>

              <?php } ?>

              <div class="text-content text-content-helper wrapper">
                <div class="flexwrap">

                  <?php if ($mirror_image_url) { ?>
                  <div class="fcol mirror-image image hidden" style="background-image:url('<?php echo $mirror_image_url ?>')">
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
          <div id="contact-form"></div>
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
    <?php 
      $gravityFormTitle = get_field("global_form_title","option"); 
      $gravityFormTopText = get_field("global_form_text","option"); 
      $gravityFormId = get_field("global_the_form","option"); 
      $gravityFormBottomText = get_field("global_disclosure","option"); 
      $formImage = get_field("form_image"); 
      $form_disable = get_field("form_disable");
      $show_form = ($form_disable=='yes') ? false : true;
      $formImagePosition = get_field("form_image_position"); 
      $form_image_pos = ($formImagePosition) ? ' image-'.$formImagePosition:'';

      if($show_form) {
        if(empty($formImage)) {
          $formImage = get_field("global_form_image","option"); 
        }
        //[gravityform id="1" title="false" description="false" ajax="true"]
        $shortcode = '';
        if($gravityFormId) {
          $shortcode = '[gravityform id="'.$gravityFormId.'" title="false" description="false" ajax="true"]';
        }
        $formClass = (($gravityFormTitle || $gravityFormTopText) && $shortcode && do_shortcode($shortcode)) ? 'half':'full';
        if($gravityFormTitle || $gravityFormTopText || $shortcode || do_shortcode($shortcode) ) { ?>
          <div id="bottom-contact-form" class="imageTextBlock reverse fw wow fadeIn <?php echo $class.$form_image_pos ?>">
            <div class="wrapper">
              <div class="flexwrap">
                <?php if ($formImage) { ?>
                <div class="fcol image wow fadeIn">
                  <div class="img parallax-image-block" style="background-image:url('<?php echo $formImage['url'] ?>')"></div>
                  <img src="<?php echo get_images_dir('rectangle.png') ?>" alt="" class="helper">
                </div>
                <?php } ?>

                <?php if ( $gravityFormTitle || $gravityFormTopText) { ?>
                <div class="fcol text">
                  <div id="contactform" class="inner wow fadeInUp">
                    <?php if ($gravityFormTitle) { ?>
                     <h3 class="title h1"><?php echo $gravityFormTitle ?></h3> 
                    <?php } ?>

                    <?php if ($gravityFormTopText) { ?>
                    <div class="top-form-text">
                      <?php echo anti_email_spam($gravityFormTopText) ?>
                    </div>
                    <?php } ?>

                    <?php if ( $shortcode && do_shortcode($shortcode) ) { ?>
                    <div class="form-wrap">
                      <?php echo do_shortcode($shortcode); ?>
                    </div>
                    <?php } ?>

                    <?php if ($gravityFormBottomText) { ?>
                    <div class="bottom-form-text">
                      <small class="smtxt"><?php echo anti_email_spam($gravityFormBottomText) ?></small>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php } ?>
      <?php if ($form_disable=='yes') { ?>
      <div class="bottom-padtop">
        <?php get_template_part('parts/bottom-logos'); ?>
      </div>
      <?php } else { ?>
        <?php get_template_part('parts/bottom-logos'); ?>
      <?php } ?>
		
	</main>
</div>
<?php
get_footer();
