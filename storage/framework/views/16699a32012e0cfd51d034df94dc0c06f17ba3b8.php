<?php
$apiCore = new \App\Api\Core();
$viewer = $apiCore->getViewer();
?>



<?php $__env->startSection('content'); ?>

<div class="alert alert-warning">
    <div>Xin chào <?php echo e($viewer->getTitle()); ?>!</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.be.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/pages/be/index.blade.php ENDPATH**/ ?>