<?php
$bottom_logos = get_field("bottom_logo_group","option");
if($bottom_logos) { ?>
<div id="bottom-logos" class="bottom-logos fw">
  <div class="wrapper">
    <?php foreach ($bottom_logos as $b) { ?>
     <span>
      <img src="<?php echo $b['url'] ?>" alt="<?php echo $b['title'] ?>" class="wow fadeInUp">
     </span> 
    <?php } ?>
  </div>
</div>
<?php } ?>

