<?php
$apiFE = new \App\Api\FE();
$apiMobile = new \App\Api\Mobile;
$isMobile = $apiMobile->isMobile();

$products = $apiFE->getProducts(['limit' => 10, 'random' => 1, 'is_best_seller' => 1]);
?>

<style data-shopify>
    .nt_se_1590633365311 {
        margin-top: 60px !important;
        margin-right: !important;
        margin-bottom: 50px !important;
        margin-left: !important;
    }

    .nt_se_1590633365311 .medizin_laypout {
        border-color: #4e97fd
    }

    .nt_se_1590633365311 .loop-product-stock .sold-bar {
        background-image: -webkit-linear-gradient(215deg, #4e97fd 0%, #77ccfd 100%);
        background-image: linear-gradient(235deg, #4e97fd 0%, #77ccfd 100%);
        border-radius: 4px;
    }

    .price .number_format {
        font-size: 17px;
    }

    .price .currency_format {
        font-size: 10px !important;
    }
</style>

<?php if(count($products)): ?>
    <div id="shopify-section-1590633365311"
         class="shopify-section nt_section type_prs_countd_deal type_carousel tp_se_cdt">

        <div class="nt_se_1590633365311 container ">
            <div class="medizin_laypout">
                <div class="product-cd-header in_flex wrap al_center fl_center tc ">
                    <h6 class="product-cd-heading section-title text-uppercase">sản phẩm bán chạy</h6>





                </div>
                <div
                    class="products nt_products_holder row fl_center row_pr_1 js_carousel nt_slider nt_cover ratio1_1 position_8 space_ prev_next_3 btn_owl_1 dot_owl_1 dot_color_1 btn_vi_2 equal_nt"
                    data-flickity='{"imagesLoaded": 0,"adaptiveHeight": 0, "contain": 1, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": 1,"pageDots": false, "autoPlay" : 0, "pauseAutoPlayOnHover" : true, "rightToLeft": false }'>
                    <?php
                    $count = 0;
                    foreach ($products as $product):
                    $count++;
                    ?>
                        <?php if($isMobile): ?>
                            <div
                                class="col-lg-15 col-md-3 col-12 pr_animated done mt__10 pr_grid_item product nt_pr desgin__1 ">
                                <div class="product-inner pr droplets_width_sm index_sale_item">
                                    <div class="product-info mb__15">
                                        <h3 class="product-title pr fs__14 mg__0 fwm">
                                            <a class="cd chp" href="<?php echo e($product->getHref(true)); ?>"><?php echo e($product->getTitle()); ?></a>
                                        </h3>
                                        <span class="price dib mb__5">
                                        <?php if($product->price_main != $product->price_pay): ?>
                                            <del class="price_old">
                                                <span class="number_format"><?php echo e($product->price_main); ?></span>
                                                <span class="currency_format">₫</span>
                                            </del>
                                        <?php endif; ?>
                                            <ins>
                                                <span class="number_format"><?php echo e($product->price_pay); ?></span>
                                                <span class="currency_format">₫</span>
                                            </ins>
                                        </span>
                                    </div>
                                    <div class="cat_grid_item__overlay item__position nt_bg_lz lazyload center product-custom"
                                         data-bgset="<?php echo e($product->getAvatar()); ?>">
                                        <?php if($product->is_new || $product->is_best_seller): ?>
                                            <div class="hot_best ts__03 pa">
                                                <?php if($product->is_new): ?>
                                                    <div class="hot_best_text is_new">mới</div>
                                                <?php endif; ?>
                                                <?php if($product->is_best_seller): ?>
                                                    <div class="hot_best_text is_hot">bán chạy</div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($product->price_main != $product->price_pay): ?>
                                            <div class="discount_percent ts__03 pa">
                                                <div class="discount_percent_text">giảm <?php echo e($product->discount); ?>%</div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <div
                                class="col-lg-15 col-md-3 col-6 pr_animated done mt__10 pr_grid_item product nt_pr desgin__1 ">
                                <div class="product-inner pr droplets_width_sm index_sale_item">
                                    <div class="product-info mb__15">
                                        <h3 class="product-title pr fs__14 mg__0 fwm">
                                            <a class="cd chp" href="<?php echo e($product->getHref(true)); ?>"><?php echo e($product->getTitle()); ?></a>
                                        </h3>
                                        <span class="price dib mb__5">
                                        <?php if($product->price_main != $product->price_pay): ?>
                                        <del class="price_old">
                                            <span class="number_format"><?php echo e($product->price_main); ?></span>
                                            <span class="currency_format">₫</span>
                                        </del>
                                            <?php endif; ?>
                                        <ins>
                                            <span class="number_format"><?php echo e($product->price_pay); ?></span>
                                            <span class="currency_format">₫</span>
                                        </ins>
                                    </span>
                                    </div>
                                    <div class="cat_grid_item__overlay item__position nt_bg_lz lazyload center product-custom"
                                         data-bgset="<?php echo e($product->getAvatar()); ?>">
                                        <?php if($product->is_new || $product->is_best_seller): ?>
                                            <div class="hot_best ts__03 pa">
                                                <?php if($product->is_new): ?>
                                                    <div class="hot_best_text is_new">mới</div>
                                                <?php endif; ?>
                                                <?php if($product->is_best_seller): ?>
                                                    <div class="hot_best_text is_hot">bán chạy</div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if($product->price_main != $product->price_pay): ?>
                                            <div class="discount_percent ts__03 pa">
                                                <div class="discount_percent_text">giảm <?php echo e($product->discount); ?>%</div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/widgets/front_end/best_seller_products.blade.php ENDPATH**/ ?>