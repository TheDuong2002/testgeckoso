<?php
$apiCore = new \App\Api\Core;
$viewer = $apiCore->getViewer();
$apiFE = new \App\Api\FE;

$products = $apiFE->getProducts([
    'pagination' => 1,
    'brand' => $item->id,
    'page' => (isset($params['page']) && (int)$params['page']) ? (int)$params['page'] : 1,
//    'limit' => 1,
]);
?>



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
            'text1' => $item->getTitle(),
            'text2' => 'thương hiệu',
            'text2link' => url('thuong-hieu'),
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="panel-content products-wrapper">
                    <div class="row">
                        <?php if(count($products)): ?>
                            <?php echo $__env->make('widgets.front_end.pagination_products', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php else: ?>
                            <div class="alert alert-warning">Đang Cập Nhật...</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.front_end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/pages/front_end/brands/info.blade.php ENDPATH**/ ?>