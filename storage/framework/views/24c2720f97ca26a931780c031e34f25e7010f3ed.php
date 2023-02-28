<?php
$apiCore = new \App\Api\Core;
$viewer = $apiCore->getViewer();

$apiMobile = new \App\Api\Mobile;
$isMobile = $apiMobile->isMobile();

$apiFE = new \App\Api\FE();
$items = $apiFE->getEvents([
    'pagination' => 1,
    'page' => (isset($params['page']) && (int)$params['page']) ? (int)$params['page'] : 1,
//    'limit' => 2,
]);
?>



<?php $__env->startPush('style'); ?>
    <link rel="stylesheet" href="<?php echo e(url('public/css/ttv/bai_viet.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div id="shopify-section-us_heading" class="shopify-section page_section_heading">
        <div class="page-head tc pr oh page_bg_img page_head_us_heading">
            <?php echo $__env->make('modals.backdrop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div class="container mb__50">
        <?php echo $__env->make('modals.breadcrumb', [
            'text1' => 'góc tư vấn',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="row">
            <div class="col-md-12">
                <?php if(count($items)): ?>
                    <div id="shopify-section-blog-template" class="shopify-section nt_section type_isotope">
                        <div class="nt_svg_loader dn"></div>
                        <div class="articles products nt_products_holder row des_cnt_1 nt_cover ratio4_3 position_8 equal_nt">
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <article class="post-384305660043 post_nt_loop post_2 col-lg-6 col-md-6 col-12 mb__40">
                                    <a class="db oh bgd" href="<?php echo e($item->getHref()); ?>">
                                        <div class="nt_bg_lz pr_lazy_img"
                                             data-bgset="<?php echo e($item->getAvatar()); ?>"
                                             data-ratio="1.5"
                                             style="background-image: url('<?php echo e($item->getAvatar()); ?>');">
                                            <picture style="display: none;">
                                                <source
                                                    data-srcset="<?php echo e($item->getAvatar()); ?>"
                                                    sizes="634px"
                                                    srcset="<?php echo e($item->getAvatar()); ?>">
                                                <img alt="" class="lazyautosizes" data-sizes="auto" data-ratio="1.5"
                                                     data-parent-fit="cover" sizes="634px"></picture>
                                        </div>
                                    </a>

                                    <div class="post-content">
                                        <div class="tc cg">
                                            <h2 class="post-title fs__14 ls__2 mt__10 mb__5 tu">
                                                <a class="chp" href="<?php echo e($item->getHref()); ?>"><?php echo e($item->getTitle()); ?></a>
                                            </h2>
                                        </div>

                                        <a href="<?php echo e($item->getHref()); ?>" class="more-link text-uppercase">Xem chi tiết</a>
                                    </div>
                                </article>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <div class="view-more">
                        <div class="more-pagination">
                            <?php echo e($items->appends(request()->query())->links()); ?>

                        </div>
                    </div>

                <?php else: ?>
                    <div class="alert alert-warning">Đang cập nhật...</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.front_end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/pages/front_end/events/index.blade.php ENDPATH**/ ?>