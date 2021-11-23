<?php 
$global_form_option = get_field("global_form_opt");
$global_form_content = ( isset($global_form_option) && $global_form_option=='none' ) ? false : true;
$global_ctas = get_field("global_ctas","option");  
$global_buttons = ( isset($global_ctas['buttons']) && $global_ctas['buttons'] ) ? $global_ctas['buttons'] : '';

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
  $formClass = ( ( ($gravityFormTitle || $gravityFormTopText) || $shortcode && do_shortcode($shortcode) ) && $global_form_content ) ? 'half':'full';
  if($gravityFormTitle || $gravityFormTopText || $shortcode || do_shortcode($shortcode) || $global_form_content ) { ?>
    <div id="bottom-contact-form" class="imageTextBlock reverse fw wow fadeIn <?php echo $class.$form_image_pos ?>">
      <div class="wrapper">
        <div class="flexwrap">
          <?php if ($formImage) { ?>
          <div class="fcol image wow fadeIn">
            <div class="img parallax-image-block" style="background-image:url('<?php echo $formImage['url'] ?>')"></div>
            <img src="<?php echo get_images_dir('square.png') ?>" alt="" class="helper">
          </div>
          <?php } ?>

          <?php if ( $gravityFormTitle || $gravityFormTopText) { ?>
          <div class="fcol text fcol-content-middle">
            <div class="formblock">
              <div id="contactform" class="inner wow fadeInUp">
                <?php if ($gravityFormTitle) { ?>
                 <h3 class="title h1"><?php echo $gravityFormTitle ?></h3> 
                <?php } ?>

                <?php if ($gravityFormTopText) { ?>
                <div class="top-form-text">
                  <?php echo anti_email_spam($gravityFormTopText) ?>
                </div>
                <?php } ?>

                <?php if ( $global_form_content=='cta' && $global_buttons ) { ?>
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
                <?php } else { ?>

                  <?php if($global_form_content=='form' && do_shortcode($shortcode) ) { ?>
                  <div class="form-wrap">
                    <?php echo do_shortcode($shortcode); ?>
                  </div>
                  <?php } ?>

                <?php } ?>

                <?php if ($gravityFormBottomText) { ?>
                <div class="bottom-form-text">
                  <small class="smtxt"><?php echo anti_email_spam($gravityFormBottomText) ?></small>
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

<?php if ($form_disable=='yes') { ?>
<div class="bottom-padtop">
  <?php get_template_part('parts/bottom-logos'); ?>
</div>
<?php } else { ?>
  <?php get_template_part('parts/bottom-logos'); ?>
<?php } ?>