	</div><!-- #content -->
	
  <?php 
  $footer_logo = get_field("footer_logo","option");
  $copyright = get_field("copyright","option");
  $company = get_field("company","option");
  $address = get_field("address","option");
  $phone = get_field("phone","option");
  $button = get_field("footer_cta_button","option");
  $social_media = get_social_media();
  $foot_class = ($footer_logo && ($address||$phone||$copyright||$company||$button||$social_media||has_nav_menu('footer')) ) ? 'half':'full';
  ?>
  <footer id="colophon" class="site-footer" role="contentinfo">
    <div class="wrapper">
      <div class="flexwrap <?php echo $foot_class ?>">
        <?php if ($footer_logo) { ?>
        <div class="footcol left">
         <img src="<?php echo $footer_logo['url'] ?>" alt="<?php echo $footer_logo['title'] ?>" class="footlogo"> 
        </div>
        <?php } ?>

        <?php if ($address||$phone||$copyright||$social_media||$company||$button||has_nav_menu('footer')) { ?>
        <div class="footcol right">
          <div class="inner">
            <?php if ( $address||$phone||$copyright||$social_media||$company ) { ?>
            <div class="fcol one">
              <?php if ($company) { ?>
              <div class="foot-info company"><?php echo $company ?></div>
              <?php } ?>

              <?php if ($phone) { ?>
              <div class="foot-info phone">CALL US: <?php echo $phone ?></div>
              <?php } ?>

              <?php if ($address) { ?>
              <div class="foot-info address"><?php echo $address ?></div>
              <?php } ?>

              <?php if ($social_media) { ?>
              <div class="social-media">
                <?php foreach ($social_media as $m) { ?>
                  <a href="<?php echo $m['url'] ?>" target="_blank" aria-label="<?php echo $m['type'] ?>"><i class="<?php echo $m['icon'] ?>"></i></a>
                <?php } ?>
              </div>
              <?php } ?>

              <?php if ($copyright) { ?>
              <div class="foot-info copyright desktop">&copy; <?php echo date('Y') . ' '. $copyright ?></div>
              <?php } ?>
            </div>
            <?php } ?>

            <?php if (has_nav_menu('footer')||$button) { ?>
            <div class="fcol two">
              <?php if ($button) { 
                $btnTarget = ( isset($button['target']) && $button['target'] ) ? $button['target'] : '_self';
                $btnName = ( isset($button['title']) && $button['title'] ) ? $button['title'] : '';
                $btnLink = ( isset($button['url']) && $button['url'] ) ? $button['url'] : '';
                if($btnName && $btnLink) { ?>
                <div class="foot-cta">
                  <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="btn btn-green"><?php echo $btnName ?></a>
                </div>
                <?php } ?>
              <?php } ?>

              <?php if ( has_nav_menu('footer') ) { ?>
                <div class="footer-menu-wrap">
                  <?php wp_nav_menu( array( 'theme_location' => 'footer', 'container'=>false, 'menu_id' => 'footer-menu') ); ?>
                </div>
              <?php } ?>
            </div>
            <?php } ?>

            <?php if ($copyright) { ?>
              <div class="foot-info copyright mobile">&copy; <?php echo date('Y') . ' '. $copyright ?></div>
            <?php } ?>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
	</footer><!-- #colophon -->
	
</div><!-- #page -->
<?php wp_footer(); ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-215105180-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-215105180-1');
</script>
</body>
</html>
