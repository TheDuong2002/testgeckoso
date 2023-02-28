<?php
$apiCore = new \App\Api\Core;
$viewer = $apiCore->getViewer();

$apiFE = new \App\Api\FE;
$others = $apiFE->getEvents(['except' => $item->id, 'random' => 1, 'limit' => 3]);
?>



<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(url('public/css/ttv/bai_viet.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div id="shopify-section-us_heading" class="shopify-section page_section_heading">
        <div class="page-head tc pr oh page_bg_img page_head_us_heading">
            <?php echo $__env->make('modals.backdrop', [
                'bannerBG' => $item->getBanner(),
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div class="container mb__50">
        <?php echo $__env->make('modals.breadcrumb', [
            'text1' => 'góc tư vấn',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="row">
            <div class="col-md-12 mb-2">
                <div class="info_title mb__20">
                    <h1 class="text-uppercase"><?php echo e($item->getTitle()); ?></h1>
                </div>

                <?php if(!empty($item->getAvatar())): ?>
                    <div class="info_avatar">
                        <img src="<?php echo e($item->getAvatar()); ?>" />
                    </div>
                <?php endif; ?>

                <div class="news-description">
                    <?php echo $item->mo_ta;?>
                </div>
            </div>
        </div>

        <?php if(count($others)): ?>
            <div class="col-md-12 mb-2">
                <?php echo $__env->make('widgets.front_end.other_events', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.front_end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/pages/front_end/events/info.blade.php ENDPATH**/ ?>