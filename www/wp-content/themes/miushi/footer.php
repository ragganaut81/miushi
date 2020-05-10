<?php
  $theme      = get_template_directory();
  $theme_uri  = get_template_directory_uri();
?>

<footer class="footer">
  <div class="container">
    <div class="footer__top"></div>
    <div class="footer__bottom">
      <div class="row">
        <div class="footer__copyright col-2">МИЮШИ © 2017</div>
        <div class="footer__privacy col-4">Соглашение на обработку персональных данных</div>
        <div class="footer__social col-6">
          <a href="#">
            <div class="footer__social-icon footer__social-icon--inst">
              <?php echo file_get_contents($theme_uri."/images/svg/instagram.svg"); ?>
            </div>
          </a>
          <a href="#">
            <div class="footer__social-icon footer__social-icon--vk">
              <?php echo file_get_contents($theme_uri."/images/svg/vk.svg"); ?>
            </div>
          </a>
          <a href="#">
            <div class="footer__social-icon footer__social-icon--fb">
              <?php echo file_get_contents($theme_uri."/images/svg/facebook.svg"); ?>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>

</body>
</html>
