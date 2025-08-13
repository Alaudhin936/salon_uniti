<?php switch(Route::currentRouteName()):
    case ('footer_dark'): ?>
    <footer class="footer footer-dark">
        <?php break; ?>
    
    <?php case ('footer_fixed'): ?>
    <footer class="footer footer-fixed">
       <?php break; ?>

    <?php default: ?>
        <footer class="footer">
<?php endswitch; ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 p-0 footer-left">
          <p class="mb-0">Copyright © 2025 Salon Unitii. All rights reserved.</p>
        </div>
      </div>
    </div>
  </footer>

<?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/layout/footer.blade.php ENDPATH**/ ?>