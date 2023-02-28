<?php
$apiCore = new \App\Api\Core;
$viewer = $apiCore->getViewer();

$apiMobile = new \App\Api\Mobile;
$isMobile = $apiMobile->isMobile();

$apiFE = new \App\Api\FE;
$products = $apiFE->getProducts([
    'pagination' => 1,
    'page' => (isset($params['page']) && (int)$params['page']) ? (int)$params['page'] : 1,
//    'limit' => 1,
]);
?>



<?php $__env->startSection('content'); ?>
    <style type="text/css">
        .active_menu {
            opacity: 1 !important;
            visibility: visible !important;
            top: 70px !important;
        }
    </style>

    <div id="shopify-section-us_heading" class="shopify-section page_section_heading">
        <div class="page-head tc pr oh page_bg_img page_head_us_heading">
            <?php echo $__env->make('modals.backdrop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div class="container mb__50">
        <?php echo $__env->make('modals.breadcrumb', [
            'text1' => 'sản phẩm',
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

    <script type="text/javascript">
        jQuery(document).ready(function () {
            <?php if(isset($active) && (int)$active): ?>
                <?php if($isMobile): ?>
                    setTimeout(function () {
                        jQuery('#mobi_menu')[0].click();
                        jsbindmobimenuside('menu_2');
                    }, 1888);
                <?php else: ?>
                    jQuery('#menu_san_pham').addClass('active_menu');
                    setTimeout(function () {
                        jQuery('#menu_san_pham').removeClass('active_menu');
                    }, 3888);
                <?php endif; ?>
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.front_end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/pages/front_end/products/index.blade.php ENDPATH**/ ?>