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
<?php while ( have_posts() ) : the_post(); ?>
  <div id="homerow1" class="home-hero fw <?php echo $hero_class ?>">
    <div class="fullwrap fw">
      <div class="hero-inner fw">
        <?php if ($large_text || $small_text) { ?>
        <div class="hero-col left wow fadeInLeft">
          <div class="hero-content">
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
        </div>
        <?php } ?>

        <?php if ( $grid_images ) { ?>
        <div class="hero-col right wow fadeIn">
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

  <?php 
  $row2_group = get_field("row2_group");
  $row2_col1_icon = ( isset($row2_group['col1_icon']) && $row2_group['col1_icon'] ) ? $row2_group['col1_icon'] : '';
  $row2_col2_icon = ( isset($row2_group['col2_icon']) && $row2_group['col2_icon'] ) ? $row2_group['col2_icon'] : '';
  $row2_col1_title = ( isset($row2_group['col1_title']) && $row2_group['col1_title'] ) ? $row2_group['col1_title'] : '';
  $row2_col2_title = ( isset($row2_group['col2_title']) && $row2_group['col2_title'] ) ? $row2_group['col2_title'] : '';
  $row2_col1_content = ( isset($row2_group['col1_content']) && $row2_group['col1_content'] ) ? $row2_group['col1_content'] : '';
  $row2_col2_content = ( isset($row2_group['col2_content']) && $row2_group['col2_content'] ) ? $row2_group['col2_content'] : '';
  
  $row2_class = ( $row2_col1_content && $row2_col2_content ) ? 'columns-2':'columns-1';
  if( $row2_col1_content || $row2_col2_content ) { ?>
  <div id="homerow2" class="section-with-icons fw <?php echo $row2_class ?> wow fadeIn">
    <div class="wrapper">
      <div class="flexwrap">

        <?php for($i=1; $i<3; $i++) { ?>
          <?php  
          $row2_icon = ( isset($row2_group['col'.$i.'_icon']) && $row2_group['col'.$i.'_icon'] ) ? $row2_group['col'.$i.'_icon'] : '';
          $row2_title = ( isset($row2_group['col'.$i.'_title']) && $row2_group['col'.$i.'_title'] ) ? $row2_group['col'.$i.'_title'] : '';
          $row2_content = ( isset($row2_group['col'.$i.'_content']) && $row2_group['col'.$i.'_content'] ) ? $row2_group['col'.$i.'_content'] : '';
          ?>
          <?php if ($row2_content) { ?>
          <div class="col-icons <?php echo ($i==1) ? 'left':'right'; ?>">
            <div class="inner">
              <?php if ($row2_icon) { ?>
               <div class="icon"><span style="background-image:url('<?php echo $row2_icon['url'] ?>')"></span></div> 
              <?php } ?>

              <?php if ($row2_title) { ?>
               <h3 class="title"><?php echo $row2_title ?></h3> 
              <?php } ?>

              <?php if ($row2_content) { ?>
                <div class="content">
                  <?php foreach ($row2_content as $r) { 
                    $title = $r['title'];
                    $text = $r['text'];
                    ?>
                    <?php if ($title) { ?>
                    <div class="item">
                      <div class="t1"><?php echo $title ?></div>
                      <?php if ($text) { ?>
                      <div class="t2"><?php echo $text ?></div>
                      <?php } ?>
                    </div> 
                    <?php } ?>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php } ?>


  <?php  
  $row3_content = get_field("row3_content");
  //echo "<pre>";
  //print_r($row3_content);
  if($row3_content) { ?>
  <div id="homerow3" class="section-with-icons fw wow fadeIn">
    <div class="wrapper">
      <div class="flexwrap">
        <?php $j=1; foreach ($row3_content as $row) { 
          $icon = $row['icon'];
          $title = $row['title'];
          $text = $row['text'];
          $button = $row['button'];
          $btnTarget = ( isset($button['target']) && $button['target'] ) ? $button['target'] : '_self';
          $btnTitle = ( isset($button['title']) && $button['title'] ) ? $button['title'] : '';
          $btnLink = ( isset($button['url']) && $button['url'] ) ? $button['url'] : '';
          ?>
          <div class="col-icons">
            <div class="inner">
              <?php if ($icon) { ?>
               <div class="icon"><span style="background-image:url('<?php echo $icon['url'] ?>')"></span></div> 
              <?php } ?>

              <?php if ($title) { ?>
               <h3 class="title"><?php echo $title ?></h3> 
              <?php } ?>

              <?php if ($text) { ?>
              <div class="content">
                <?php echo $text ?>
                <?php if ( $btnTitle && $btnLink ) { ?>
                  <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="btn-link"><?php echo $btnTitle ?></a>
                <?php } ?>
              </div>
              <?php } ?>
            </div>
          </div>
        <?php $j++; } ?>
      </div>
    </div>
  </div>
  <?php } ?>


  <?php  
  $row4_image = get_field("row4_image");
  $row4_title = get_field("row4_title");
  $row4_quote = get_field("row4_quote");
  $row4_class = ( $row4_image && ( $row4_title || $row4_quote) ) ? 'half':'full';
  if ( $row4_image || ( $row4_title || $row4_quote) ) { ?>
  <div id="homerow4" class="image-text-block fw <?php echo $row4_class ?>">
    <div class="flexwrap">
      <?php if ($row4_image) { ?>
      <div class="itb-col image wow fadeIn" style="background-image:url('<?php echo $row4_image['url'] ?>')">
        <img src="<?php echo get_images_dir('rectangle.png') ?>" alt="">
      </div>
      <?php } ?>

      <?php if ( $row4_title || $row4_quote ) { ?>
      <div class="itb-col text wow fadeInRight">
        <div class="inner">
          <?php if ($row4_title) { ?>
           <h3 class="title h2"><?php echo $row4_title ?></h3> 
          <?php } ?>

          <?php if ($row4_quote) { ?>
          <div class="text">
            <?php echo $row4_quote ?>
          </div>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>



  <?php  
  $row5_content = get_field("row5_content");
  $row5_contact = get_field("row5_contact");
  $row5_large_title = ( isset($row5_contact['large_title']) && $row5_contact['large_title'] ) ? $row5_contact['large_title'] : '';
  $row5_contact_info = ( isset($row5_contact['info']) && $row5_contact['info'] ) ? $row5_contact['info'] : '';
  $row5_icons = ( isset($row5_contact['icons']) && $row5_contact['icons'] ) ? $row5_contact['icons'] : '';
  if($row5_content || $row5_contact) { ?>
  <div id="homerow5" class="full-text-block fw wow fadeInUp">
    <div class="wrapper">
      <?php if ($row5_content) { ?>
        <div class="article"><?php echo $row5_content ?></div>
      <?php } ?>

      <?php if ($row5_large_title || $row5_contact_info ) { 
        $row5Class = ($row5_large_title && $row5_contact_info ) ? 'half':'full';
        ?>
        <div class="contact-section <?php echo $row5Class ?>">
          <div class="flexwrap">
            <?php if ($row5_large_title) { ?>
              <div class="cs-col titlecol"><h3 class="title-green"><?php echo $row5_large_title ?></h3></div>
            <?php } ?>

            <?php if ($row5_contact_info) { ?>
            <div class="cs-col contact <?php echo ($row5_icons) ? 'has-icons':'' ?>">
              <div class="contact-inner">
                <?php if ($row5_icons) { ?>
                  <div class="icons">
                    <div class="pad">
                    <?php foreach ($row5_icons as $img) { 
                      if($img['icon']) { ?>
                        <img src="<?php echo $img['icon']['url'] ?>" alt="" class="icon" />
                      <?php } ?>
                    <?php } ?>
                    </div>
                  </div>
                <?php } ?>
                <?php if ($row5_contact_info) { ?>
                  <div class="textcol"><?php echo $row5_contact_info ?></div>
                <?php } ?>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>


  <?php  
  $row6_image = get_field("row6_image");
  $row6_title = get_field("row6_title");
  $row6_quote = get_field("row6_quote");
  $row6_class = ( $row6_image && ( $row6_title || $row6_quote) ) ? 'half':'full';
  if ( $row4_image || ( $row4_title || $row4_quote) ) { ?>
  <div id="homerow6" class="image-text-block reverse fw wow fadeIn <?php echo $row6_class ?>">
    <div class="flexwrap">
      <?php if ($row6_image) { ?>
      <div class="itb-col image wow fadeIn" style="background-image:url('<?php echo $row6_image['url'] ?>')">
        <img src="<?php echo get_images_dir('rectangle.png') ?>" alt="">
      </div>
      <?php } ?>

      <?php if ( $row6_title || $row6_quote ) { ?>
      <div class="itb-col text wow fadeInLeft">
        <div class="inner">
          <?php if ($row6_title) { ?>
           <h3 class="title h2"><?php echo $row6_title ?></h3> 
          <?php } ?>

          <?php if ($row6_quote) { ?>
          <div class="text">
            <?php echo $row6_quote ?>
          </div>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>

<?php endwhile; ?>  

<?php
get_footer();
