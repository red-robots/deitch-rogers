<?php
$option = ( isset($global_Opt) && $global_Opt ) ? $global_Opt : '';
$form_title = get_field("global_form_title","option"); 
$form_text = get_field("global_form_text","option"); 
$gravityFormId = get_field("global_the_form","option"); 
$form_disclosure = get_field("global_disclosure","option"); 
$bottom_logos = ( isset($form['bottom_logo']) && $form['bottom_logo'] ) ? $form['bottom_logo'] : '';
$form_image = get_field("global_form_image","option"); 
$class = ( $form_image && ( $form_title || $form_text) ) ? 'half':'full';

if($option=='form') {  
  $shortcode = '';
  if($gravityFormId) {
    $shortcode = '[gravityform id="'.$gravityFormId.'" title="false" description="false" ajax="true"]';
  }
  
  if ( $form_image || ($form_title || $form_text) || $bottom_logos ) { ?>
  <div id="bottom-contact-form" class="imageTextBlock reverse fw wow fadeIn <?php echo $class ?>">
    <div class="wrapper">
      <div class="flexwrap">
        <?php if ($form_image) { ?>
        <div class="fcol image wow fadeIn">
          <div class="img parallax-image-block" style="background-image:url('<?php echo $form_image['url'] ?>')"></div>
          <img src="<?php echo get_images_dir('square.png') ?>" alt="" class="helper">
        </div>
        <?php } ?>

        <?php if ( $form_title || $form_text) { ?>
        <div class="fcol text fcol-content-middle">
          <div class="formblock">
            <div id="contactform" class="inner wow fadeInUp">
              <?php if ($form_title) { ?>
               <h3 class="title h1"><?php echo $form_title ?></h3> 
              <?php } ?>

              <?php if ($form_text) { ?>
              <div class="top-form-text">
                <?php echo anti_email_spam($form_text) ?>
              </div>
              <?php } ?>

              <?php if ( $shortcode && do_shortcode($shortcode) ) { ?>
              <div class="form-wrap">
                <?php echo do_shortcode($shortcode); ?>
              </div>
              <?php } ?>

              <?php if ($form_disclosure) { ?>
              <div class="bottom-form-text">
                <small class="smtxt"><?php echo anti_email_spam($form_disclosure) ?></small>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php } ?>

<?php } else if( $option=='cta' ) { ?>

  <?php 
    $global_ctas = get_field("global_ctas","option");  
    $global_buttons = ( isset($global_ctas['buttons']) && $global_ctas['buttons'] ) ? $global_ctas['buttons'] : ''; 
  ?>
  <?php if ( $global_buttons ) { ?>
    <div id="bottom-contact-form" class="imageTextBlock reverse fw wow fadeIn <?php echo $class ?>">
      <div class="wrapper">
        <div class="flexwrap">
          <?php if ($form_image) { ?>
          <div class="fcol image wow fadeIn">
            <div class="img parallax-image-block" style="background-image:url('<?php echo $form_image['url'] ?>')"></div>
            <img src="<?php echo get_images_dir('square.png') ?>" alt="" class="helper">
          </div>
          <?php } ?>

          <?php if ( $form_title || $form_text) { ?>
          <div class="fcol text fcol-content-middle">
            <div class="formblock">
              <div id="contactform" class="inner wow fadeInUp">
                <?php if ($form_title) { ?>
                 <h3 class="title h1"><?php echo $form_title ?></h3> 
                <?php } ?>

                <?php if ($form_text) { ?>
                <div class="top-form-text">
                  <?php echo anti_email_spam($form_text) ?>
                </div>
                <?php } ?>

                <div class="form-wrap">
                  <div class="button-group  wow fadeInDown">
                    <?php foreach ($global_buttons as $b) { 
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
                </div>

                <?php if ($form_disclosure) { ?>
                <div class="bottom-form-text">
                  <small class="smtxt"><?php echo anti_email_spam($form_disclosure) ?></small>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>

<?php } ?>

<?php if ( isset($show_logo) && $show_logo ) { ?>
  <?php get_template_part('parts/bottom-logos'); ?>
<?php } ?>
