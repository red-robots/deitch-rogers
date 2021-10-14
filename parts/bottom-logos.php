<?php
$form = get_field("footer_contact_form_section","option");
$bottom_logos = ( isset($form['bottom_logo']) && $form['bottom_logo'] ) ? $form['bottom_logo'] : '';
if($bottom_logos) { ?>
<div id="bottom-logos" class="bottom-logos fw">
  <div class="wrapper">
    <?php foreach ($bottom_logos as $b) { ?>
     <span>
      <img src="<?php echo $b['url'] ?>" alt="<?php echo $b['title'] ?>">
     </span> 
    <?php } ?>
  </div>
</div>
<?php } ?>

