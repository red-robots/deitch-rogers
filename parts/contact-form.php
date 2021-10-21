<?php
$form = get_field("footer_contact_form_section","option");
$form_title = ( isset($form['contact_form_title']) && $form['contact_form_title'] ) ? $form['contact_form_title'] : '';
$form_text = ( isset($form['contact_form_text']) && $form['contact_form_text'] ) ? $form['contact_form_text'] : '';
$featured_image = ( isset($form['featured_image']) && $form['featured_image'] ) ? $form['featured_image'] : '';
$bottom_logos = ( isset($form['bottom_logo']) && $form['bottom_logo'] ) ? $form['bottom_logo'] : '';


$class = ( $featured_image && ( $form_title || $form_text) ) ? 'half':'full';
if ( $featured_image || ($form_title || $form_text) || $bottom_logos ) { ?>
<div id="bottom-contact-form" class="imageTextBlock reverse fw wow fadeIn <?php echo $class ?>">
  <div class="wrapper">
    <div class="flexwrap">
      <?php if ($featured_image) { ?>
      <div class="fcol image wow fadeIn">
        <div class="img" style="background-image:url('<?php echo $featured_image['url'] ?>')"></div>
        <img src="<?php echo get_images_dir('rectangle.png') ?>" alt="" class="helper">
      </div>
      <?php } ?>

      <?php if ( $form_title || $form_text) { ?>
      <div class="fcol text">
        <div id="contactform" class="inner wow fadeInUp">
          <?php if ($form_title) { ?>
           <h3 class="title h1"><?php echo $form_title ?></h3> 
          <?php } ?>

          <?php if ($form_text) { ?>
          <div class="text">
            <?php echo $form_text ?>
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
