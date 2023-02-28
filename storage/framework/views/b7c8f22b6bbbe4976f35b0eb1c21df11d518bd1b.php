<?php
$apiCore = new \App\Api\Core;
$viewer = $apiCore->getViewer();

?>



<?php $__env->startSection('content'); ?>
    <div id="shopify-section-us_heading" class="shopify-section page_section_heading">
        <div class="page-head tc pr oh page_bg_img page_head_us_heading">
            <?php echo $__env->make('modals.backdrop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div class="container mb__50">
        <?php echo $__env->make('modals.breadcrumb', [
            'text1' => 'thương hiệu',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="block-deals-of-opt2">
            <div class="block-content">
                <?php echo $__env->make('widgets.front_end.listing_brands', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo $__env->make('widgets.front_end.best_seller_products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo $__env->make('widgets.front_end.new_products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.front_end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/pages/front_end/brands/index.blade.php ENDPATH**/ ?>