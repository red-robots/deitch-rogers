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
        <div class="hero-col left">
          <div class="hero-content">
            <div class="inside">
              <?php if ($large_text) { ?>
              <div class="large-text wow fadeIn">
                <?php echo $large_text ?>
              </div>
              <?php } ?>

              <?php if ($small_text) { ?>
              <div class="small-text wow fadeIn">
                <?php echo $small_text ?>
              </div>
              <?php } ?>

              <?php if ($left_buttons) { ?>
              <div class="buttons  wow fadeInDown">
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
              $has_logo = ( isset($img['has_logo']) && $img['has_logo']=='yes' ) ? true : false;
              if($front_img) { ?>
              <div class="block sudden">
                <?php echo $open_link ?>
                  <span class="front img" style="background-image:url('<?php echo $front_img['url'] ?>')">
                    <?php if ($has_logo) { ?>
                      <span class="logo-white">
                        <?php get_template_part('parts/logo-white') ?>
                      </span>
                    <?php } ?>
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
  <div id="homerow2" class="section-with-icons fw <?php echo $row2_class ?>">
    <div class="wrapper">
      <div class="flexwrap">

        <?php for($i=1; $i<3; $i++) { ?>
          <?php  
          $row2_icon = ( isset($row2_group['col'.$i.'_icon']) && $row2_group['col'.$i.'_icon'] ) ? $row2_group['col'.$i.'_icon'] : '';
          $row2_title = ( isset($row2_group['col'.$i.'_title']) && $row2_group['col'.$i.'_title'] ) ? $row2_group['col'.$i.'_title'] : '';
          $row2_content = ( isset($row2_group['col'.$i.'_content']) && $row2_group['col'.$i.'_content'] ) ? $row2_group['col'.$i.'_content'] : '';
          ?>
          <?php if ($row2_content) { ?>
          <div class="col-icons wow fadeInUp <?php echo ($i==1) ? 'left':'right'; ?>">
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
      <div class="itb-col text wow fadeInUp">
        <div class="inner">
          <?php if ($row4_title) { ?>
           <h3 class="title h1"><?php echo $row4_title ?></h3> 
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
              <div class="cs-col titlecol"><h3 class="title-green h1"><?php echo $row5_large_title ?></h3></div>
            <?php } ?>

            <?php if ($row5_contact_info) { ?>
            <div class="cs-col contact <?php echo ($row5_icons) ? 'has-icons':'' ?>">
              <div class="contact-inner">
                <?php if ($row5_icons) { ?>
                  <div class="icons">
                    <div class="pad">
                    <?php foreach ($row5_icons as $img) { 
                      if($img['icon']) { ?>
                        <div class="icondiv">
                          <img src="<?php echo $img['icon']['url'] ?>" alt="" class="icon" />
                        </div>
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
      <div class="itb-col image wow fadeInRight" style="background-image:url('<?php echo $row6_image['url'] ?>')">
        <img src="<?php echo get_images_dir('rectangle.png') ?>" alt="">
      </div>
      <?php } ?>

      <?php if ( $row6_title || $row6_quote ) { ?>
      <div class="itb-col text wow fadeInLeft">
        <div class="inner">
          <?php if ($row6_title) { ?>
           <h3 class="title h1"><?php echo $row6_title ?></h3> 
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


  <?php  
  $row7_features = get_field("row7_features");
  if($row7_features) { ?>
  <div id="homerow7" class="features-with-icons fw">
    <div class="wrapper">
      <?php foreach ($row7_features as $e) {
        $icon = $e['icon']; 
        $title = $e['title']; 
        $text = $e['text']; 
        $button = $e['button']; 
        $btnTarget = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';
        $btnTitle = (isset($button['title']) && $button['title']) ? $button['title'] : '';
        $btnLink = (isset($button['url']) && $button['url']) ? $button['url'] : '';
        $class = ( $icon && $text ) ? 'half':'full';
        ?>
        <div class="features <?php echo $class ?> wow fadeIn">
          <div class="flexwrap">
            <?php if ($icon) { ?>
             <div class="featcol graphic">
               <img src="<?php echo $icon['url'] ?>" alt="">
             </div> 
            <?php } ?>

            <?php if ($title || $text) { ?>
             <div class="featcol textwrap">
              <?php if ($title) { ?>
                <h2 class="h2"><?php echo $title ?></h2>
              <?php } ?>
              <?php if ($text) { ?>
                <div class="text"><?php echo $text ?></div>
              <?php } ?>
              <?php if ( $btnTitle && $btnLink ) { ?>
                <div class="button">
                  <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="btn btn-orange"><?php echo $btnTitle ?></a>
                </div>
              <?php } ?>
             </div> 
            <?php } ?>
          </div>
        </div> 
      <?php } ?>
    </div>
  </div>
  <?php } ?>


  <?php  
  $video = get_field("row8_video_link");
  $videoId = '';
  $vimeo_video_id = '';
  if($video) {   
    if (strpos($video, '/youtu.be/') !== false) {
      $parts = explode("/",$video);
      $videoId = end($parts);
    }
    else if (strpos($video, 'youtube.com') !== false) {
      $parts = parse_url($video);
      parse_str($parts['query'], $query);
      $videoId = (isset($query['v']) && $query['v']) ? $query['v'] : '';
    }
    else if (strpos($video, 'vimeo.com') !== false) {
      $vimeo_video_id = basename($video);
    }
  ?>
  <div id="homerow8" class="home-video-section fw">
    <div class="wrapper">
      <div class="videoEmbedWrap">
        <?php if($videoId) { ?>
          <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $videoId?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <?php } else if($vimeo_video_id) { ?>
          <iframe id="vimeoVideoFrame" src="https://player.vimeo.com/video/<?php echo $vimeo_video_id?>?title=0&byline=0&portrait=0" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
          <script src="https://player.vimeo.com/api/player.js"></script>
        <?php } ?>
        <img src="<?php echo get_images_dir('rectangle.png'); ?>" alt="" class="video-helper">
      </div>
    </div>
  </div>
  <?php } ?>


  <?php  
  $row9_image = get_field("row9_image");
  $row9_title = get_field("row9_title");
  $row9_quote = get_field("row9_quote");
  $row9_class = ( $row9_image && ( $row9_title || $row9_quote) ) ? 'half':'full';
  if ( $row9_image || ( $row9_title || $row9_quote) ) { ?>
  <div id="homerow9" class="image-text-block fw wow fadeIn <?php echo $row9_class ?>">
    <div class="flexwrap">
      <?php if ($row9_image) { ?>
      <div class="itb-col image wow fadeIn" style="background-image:url('<?php echo $row9_image['url'] ?>')">
        <img src="<?php echo get_images_dir('rectangle.png') ?>" alt="">
      </div>
      <?php } ?>

      <?php if ( $row9_title || $row9_quote ) { ?>
      <div class="itb-col text wow fadeInUp">
        <div class="inner">
          <?php if ($row9_title) { ?>
           <h3 class="title h1"><?php echo $row9_title ?></h3> 
          <?php } ?>

          <?php if ($row9_quote) { ?>
          <div class="text">
            <?php echo $row9_quote ?>
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
$args = array(
  'posts_per_page'   => -1,
  'post_type'        => 'team',
  'post_status'      => 'publish'
);
$team = new WP_Query($args);
if ( $team->have_posts() ) { 
  $count = $team->found_posts;
?>
<div id="homerowTeams" class="team-columns fw wow fadeIn count-<?php echo $count ?>">
  <div class="wrapper">
    <div class="flexwrap">
    <?php $n=1; while ( $team->have_posts() ) : $team->the_post(); ?>
      <?php  
      $photo = get_field('photo'); 
      $shortBio = get_field('short_bio'); 
      $largeText = ( isset($shortBio['large_text']) && $shortBio['large_text'] ) ? $shortBio['large_text'] : '';
      $smallText = ( isset($shortBio['small_text']) && $shortBio['small_text'] ) ? $shortBio['small_text'] : '';
      ?>
      <div class="team wow fadeInUp" data-wow-delay="0.<?php echo $n?>s">
        <div class="photo <?php echo ($photo) ? 'yes':'no' ?>">
          <?php if ($photo) { ?>
          <span class="img" style="background-image:url('<?php echo $photo['url'] ?>')"></span> 
          <?php } ?>
          <img src="<?php echo get_images_dir('square.png') ?>" alt="" class="helper">
        </div>
        <div class="info">
          <h3 class="name"><?php the_title(); ?></h3>
          <?php if ($largeText) { ?>
          <div class="text-lg"><?php echo $largeText ?></div>
          <?php } ?>
          <?php if ($smallText) { ?>
          <div class="text-sm"><?php echo $smallText ?></div>
          <?php } ?>

          <div class="button">
            <a href="<?php echo get_permalink(); ?>" class="more">Read More</a>
          </div>
        </div>
      </div>
    <?php $n++; endwhile; wp_reset_postdata(); ?>
    </div>
  </div>
</div>
<?php } ?>


<?php  
  $show = false;
  if($show) {
    $row10_image = get_field("row10_image");
    $row10_title = get_field("row10_title");
    $row10_text = get_field("row10_text");
    $row10_class = ( $row10_image && ( $row10_title || $row10_text) ) ? 'half':'full';
    if ( $row10_image || ($row10_title || $row10_text) ) { ?>
    <div id="homerow10" class="image-text-block reverse fw wow fadeIn <?php echo $row10_class ?>">
      <div class="flexwrap">
        <?php if ($row10_image) { ?>
        <div class="itb-col image wow fadeIn" style="background-image:url('<?php echo $row10_image['url'] ?>')">
          <img src="<?php echo get_images_dir('rectangle.png') ?>" alt="">
        </div>
        <?php } ?>

        <?php if ( $row10_title || $row10_text) { ?>
        <div class="itb-col text">
          <div class="inner">
            <?php if ($row10_title) { ?>
             <h3 class="title h1"><?php echo $row10_title ?></h3> 
            <?php } ?>

            <?php if ($row10_text) { ?>
            <div class="text">
              <?php echo $row10_text ?>
            </div>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <?php } ?>
  <?php } ?>

  <div id="homerow10">
    <?php 
      $show_logo = false;
      include( locate_template('parts/home-contact-form.php') ); 
    ?>
  </div>

  <?php  
  $row11_image = get_field("row11_image");
  $row11_title = get_field("row11_title");
  $row11_text = get_field("row11_text");
  $row11_button = get_field("row11_button");
  $row11_btnTitle = (isset($row11_button['title']) && ($row11_button['title'])) ? ($row11_button['title']) : '';
  $row11_btnLink = (isset($row11_button['url']) && ($row11_button['url'])) ? ($row11_button['url']) : '';
  $row11_btnTarget = (isset($row11_button['target']) && ($row11_button['target'])) ? ($row11_button['target']) : '_self';
  $row11_class = ( $row11_image && ( $row11_title || $row11_text) ) ? 'half':'full';
  if ( $row4_image || ($row11_title || $row11_text) ) { ?>
  <div id="homerow11" class="image-text-block fw wow fadeIn <?php echo $row11_class ?>">
    <div class="flexwrap">
      <?php if ($row11_image) { ?>
      <div class="itb-col image wow fadeIn" style="background-image:url('<?php echo $row11_image['url'] ?>')">
        <img src="<?php echo get_images_dir('rectangle.png') ?>" alt="">
      </div>
      <?php } ?>

      <?php if ($row11_title || $row11_text) { ?>
      <div class="itb-col text wow fadeInUp">
        <div class="inner">
          <?php if ($row11_title) { ?>
           <h3 class="title h1"><?php echo $row11_title ?></h3> 
          <?php } ?>

          <?php if ($row11_text) { ?>
          <div class="text">
            <?php echo $row11_text ?>
          </div>
          <?php } ?>

          <?php if( $row11_btnTitle && $row11_btnLink ) { ?>
          <div class="button">
            <a href="<?php echo $row11_btnLink ?>" target="<?php echo $row11_btnTarget ?>" class="btn btn-link expand"><?php echo $row11_btnTitle ?></a>
          </div>
          <?php } ?>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>


  <?php 
  $row12_group = get_field("row12_group");
  $row12_col1_icon = ( isset($row12_group['col1_icon']) && $row12_group['col1_icon'] ) ? $row12_group['col1_icon'] : '';
  $row12_col2_icon = ( isset($row12_group['col2_icon']) && $row12_group['col2_icon'] ) ? $row12_group['col2_icon'] : '';
  $row12_col1_title = ( isset($row12_group['col1_title']) && $row12_group['col1_title'] ) ? $row12_group['col1_title'] : '';
  $row12_col2_title = ( isset($row12_group['col2_title']) && $row12_group['col2_title'] ) ? $row12_group['col2_title'] : '';
  $row12_col1_content = ( isset($row12_group['col1_content']) && $row12_group['col1_content'] ) ? $row12_group['col1_content'] : '';
  $row12_col2_content = ( isset($row12_group['col2_content']) && $row12_group['col2_content'] ) ? $row12_group['col2_content'] : '';
  
  $row2_class = ( $row2_col1_content && $row2_col2_content ) ? 'columns-2':'columns-1';
  if( $row2_col1_content || $row2_col2_content ) { ?>
  <div id="homerow12" class="section-with-icons fw <?php echo $row2_class ?> wow fadeIn">
    <div class="wrapper">
      <div class="flexwrap">

        <?php for($i=1; $i<3; $i++) { ?>
          <?php  
          $row12_icon = ( isset($row12_group['col'.$i.'_icon']) && $row12_group['col'.$i.'_icon'] ) ? $row12_group['col'.$i.'_icon'] : '';
          $row12_title = ( isset($row12_group['col'.$i.'_title']) && $row12_group['col'.$i.'_title'] ) ? $row12_group['col'.$i.'_title'] : '';
          $row12_content = ( isset($row12_group['col'.$i.'_content']) && $row12_group['col'.$i.'_content'] ) ? $row12_group['col'.$i.'_content'] : '';
          $row12Btn = ( isset($row12_group['col'.$i.'_button']) && $row12_group['col'.$i.'_button'] ) ? $row12_group['col'.$i.'_button'] : '';
          $row12BtnTitle = (isset($row12Btn['title']) && ($row12Btn['title'])) ? ($row12Btn['title']) : '';
          $row12BtnLink = (isset($row12Btn['url']) && ($row12Btn['url'])) ? ($row12Btn['url']) : '';
          $row12BtnTarget = (isset($row12Btn['target']) && ($row12Btn['target'])) ? ($row12Btn['target']) : '_self';
          ?>
          <?php if ($row12_content) { ?>
          <div class="col-icons wow fadeInUp <?php echo ($i==1) ? 'left':'right'; ?>" data-wow-delay="0.<?php echo $i ?>s">
            <div class="inner">
              <?php if ($row12_icon) { ?>
               <div class="icon"><span style="background-image:url('<?php echo $row12_icon['url'] ?>')"></span></div> 
              <?php } ?>

              <?php if ($row12_title) { ?>
               <h3 class="h1"><?php echo $row12_title ?></h3> 
              <?php } ?>

              <?php if ($row12_content) { ?>
                <div class="content">
                  <?php echo $row12_content ?>
                </div>

                <?php if( $row12BtnTitle && $row12BtnLink ) { ?>
                  <a href="<?php echo $row12BtnLink ?>" target="<?php echo $row12BtnTarget ?>" class="btn btn-link expand"><?php echo $row12BtnTitle ?></a>
                <?php } ?>
              <?php } ?>
            </div>
          </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php } ?>


  <?php get_template_part('parts/bottom-logos'); ?>


<?php
get_footer();
