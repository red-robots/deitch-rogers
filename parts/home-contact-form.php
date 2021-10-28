<?php
$form_title = get_field("global_form_title","option"); 
$form_text = get_field("global_form_text","option"); 
$gravityFormId = get_field("global_the_form","option"); 
$form_disclosure = get_field("global_disclosure","option"); 
$form_image = get_field("global_form_image","option"); 
$shortcode = '';
if($gravityFormId) {
  $shortcode = '[gravityform id="'.$gravityFormId.'" title="false" description="false" ajax="true"]';
}
$bottom_logos = ( isset($form['bottom_logo']) && $form['bottom_logo'] ) ? $form['bottom_logo'] : '';

// $form = get_field("footer_contact_form_section","option");
// $form_title = ( isset($form['contact_form_title']) && $form['contact_form_title'] ) ? $form['contact_form_title'] : '';
// $form_text = ( isset($form['contact_form_text']) && $form['contact_form_text'] ) ? $form['contact_form_text'] : '';
// $featured_image = ( isset($form['featured_image']) && $form['featured_image'] ) ? $form['featured_image'] : '';
// $bottom_logos = ( isset($form['bottom_logo']) && $form['bottom_logo'] ) ? $form['bottom_logo'] : '';

$class = ( $form_image && ( $form_title || $form_text) ) ? 'half':'full';
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
      <div class="fcol text">
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
      <?php } ?>
    </div>
  </div>
</div>
<?php } ?>

<?php if ( isset($show_logo) && $show_logo ) { ?>
  <?php get_template_part('parts/bottom-logos'); ?>
<?php } ?>
