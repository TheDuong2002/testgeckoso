<?php
$apiFE = new \App\Api\FE();
$apiMobile = new \App\Api\Mobile;
$isMobile = $apiMobile->isMobile();

$brands = $apiFE->getBrands(['limit' => 6, 'random' => 1]);
?>

<style data-shopify>
    .nt_se_1590291296324 {
        margin-top: 30px !important;
    }
</style>

<?php if(count($brands)): ?>
<div id="shopify-section-1590291296324" class="shopify-section nt_section type_brand_list type_carousel">
    <div class="nt_se_1590291296324 container">
        <div class="row al_center fl_center title_10 mb__30">
            <div class="col-auto col-md"><h3 class="dib tc section-title fs__24 text-uppercase">thương hiệu</h3></div>
            <div class="col-auto"><a href="<?php echo e(url('thuong-hieu')); ?>">Xem nhiều hơn</a></div>
        </div>
        <div class="mt__30 nt_banner_holder row equal_nt nt_contain position_8 al_center cat_space_0">
            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cat_space_item col-lg-2 col-md-6 col-6 brand_item nt_1590291296324-0 tc">
                <a href="<?php echo e($brand->getHref()); ?>" class="db">
                    <img src="<?php echo e($brand->getAvatar()); ?>"
                        data-widths="[180, 360, 540, 720, 900, 1080, 1296, 1512, 1728, 2048]" data-sizes="auto"
                        class="lz_op_ef w__100 lazyautosizes lazyloaded" alt="<?php echo e($brand->getTitle()); ?>"
                        style="max-width: 150px;"
                    />
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/widgets/front_end/active_brands.blade.php ENDPATH**/ ?>