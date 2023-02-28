<?php
$jsVersion = '20220101';
?>

<?php echo $__env->make('modals.fe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script src="<?php echo e(url('public/libraries/viewer/jquery.magnify.js')); ?>" type="text/javascript"></script>

<script src="<?php echo e(url('public/libraries/sticky/jquery.sticky.js')); ?>" type="text/javascript"></script>

<script src="<?php echo e(url('public/libraries/uni-carousel/jquery.uni-carousel.js')); ?>" type="text/javascript"></script>

<script src="<?php echo e(url('public/js/main.js?v=' . $jsVersion)); ?>" type="text/javascript"></script>

<script src="<?php echo e(url('public/js/ttv/fe/auth.js?v=' . $jsVersion)); ?>" type="text/javascript"></script>
<script src="<?php echo e(url('public/js/ttv/fe/index.js?v=' . $jsVersion)); ?>" type="text/javascript"></script>
<?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/templates/ttv/bot-script.blade.php ENDPATH**/ ?>