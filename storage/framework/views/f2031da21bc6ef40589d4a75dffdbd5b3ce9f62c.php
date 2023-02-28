<?php
$apiCore = new \App\Api\Core;
$viewer = $apiCore->getViewer();
$body = $apiCore->getSetting('about_us');

if (!empty($body)) {
    $body = str_replace('../public/uploaded/tinymce', url('') . '/public/uploaded/tinymce', $body);
}
?>



<?php $__env->startSection('content'); ?>
    <div id="shopify-section-us_heading" class="shopify-section page_section_heading">
        <div class="page-head tc pr oh page_bg_img page_head_us_heading">
            <?php echo $__env->make('modals.backdrop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div class="container mb__50">
        <?php echo $__env->make('modals.breadcrumb', [
            'text1' => 'về chúng tôi',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="row">
            <div class="col-md-12">
                <?php echo $body;?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.front_end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/pages/front_end/info/about_us.blade.php ENDPATH**/ ?>