<?php
$apiFE = new \App\Api\FE;
$apiMobile = new \App\Api\Mobile;
$isMobile = $apiMobile->isMobile();

if (!isset($products) || !count($products)) {
    return;
}

?>

<style>
    .dev_view_cat.dev_desktop a.view_3 {
        border-color: #222
    }

    .dev_view_cat.dev_desktop a.view_3:before {
        background: #222;
        box-shadow: 13px 0 0 #222, 26px 0 0 #222, 39px 0 0 #222
    }

    .dev_view_cat.dev_tablet a.view_3 {
        border-color: #222
    }

    .dev_view_cat.dev_tablet a.view_3:before {
        background: #222;
        box-shadow: 13px 0 0 #222, 26px 0 0 #222, 39px 0 0 #222
    }

    .dev_view_cat.dev_mobile a.view_6 {
        border-color: #222
    }

    .dev_view_cat.dev_mobile a.view_6:before {
        background: #222;
        box-shadow: 13px 0 0 #222, 13px 0 0 #222
    }
</style>

<div class="container container_cat pop_default cat_default mb__60">
    <div class="cat_toolbar row fl_center al_center mt__30">








        <div class="cat_view col-auto hidden">
            <div class="dn dev_desktop dev_view_cat">
                <a rel="nofollow" data-no-instant="" href="#" data-dev="dk" data-col="6"
                   class="pr mr__10 cat_view_page view_6"></a>
                <a rel="nofollow" data-no-instant="" href="#" data-dev="dk" data-col="4"
                   class="pr mr__10 cat_view_page view_4"></a>
                <a rel="nofollow" data-no-instant="" href="#" data-dev="dk" data-col="3"
                   class="pr mr__10 cat_view_page view_3"></a><a rel="nofollow" data-no-instant="" href="#"
                                                                 data-dev="dk" data-col="15"
                                                                 class="pr mr__10 cat_view_page view_15"></a><a
                    rel="nofollow" data-no-instant="" href="#" data-dev="dk" data-col="2"
                    class="pr cat_view_page view_2"></a></div>
            <div class="dn dev_tablet dev_view_cat">
                <a rel="nofollow" data-no-instant="" href="#" data-dev="tb" data-col="6"
                   class="pr mr__10 cat_view_page view_6"></a>
                <a rel="nofollow" data-no-instant="" href="#" data-dev="tb" data-col="4"
                   class="pr mr__10 cat_view_page view_4"></a>
                <a rel="nofollow" data-no-instant="" href="#" data-dev="tb" data-col="3"
                   class="pr cat_view_page view_3"></a>
            </div>
            <div class="flex dev_mobile dev_view_cat">
                <a rel="nofollow" data-no-instant="" href="#" data-dev="mb" data-col="12"
                   class="pr mr__10 cat_view_page view_12"></a>
                <a rel="nofollow" data-no-instant="" href="#" data-dev="mb" data-col="6"
                   class="pr cat_view_page view_6"></a>
            </div>
        </div>































    </div>

    <div class="filter_area_js filter_area lazypreload lazyloaded"
         data-include="/collections/women?sort_by=best-selling&amp;section_id=nt_filter" data-currentinclude="">
        <div id="shopify-section-nt_filter" class="shopify-section nt_ajaxFilter"><h3
                class="mg__0 tu bgb cw visible-sm fs__16 pr">Filter<i
                    class="close_pp pegk pe-7s-close fs__40 ml__5"></i></h3>
            <div class="cat_shop_wrap">
                <div class="cat_fixcl-scroll">
                    <div class="cat_fixcl-scroll-content css_ntbar">
                        <div class="row wrap_filter">
                            <div class="col-12 col-md-3 widget blockid_color">
                                <h5 class="widget-title">By Color</h5>
                                <div class="loke_scroll">
                                    <ul class="nt_filter_block nt_filter_color css_ntbar">
                                        <li><a href="/collections/women/color-black?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag color black">
                                                <div class="filter-swatch"><span
                                                        class="lazyload bg_color_black"></span></div>
                                                black</a></li>
                                        <li><a href="/collections/women/color-cyan?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag color cyan">
                                                <div class="filter-swatch"><span
                                                        class="lazyload bg_color_cyan"></span></div>
                                                cyan</a></li>
                                        <li><a href="/collections/women/color-green?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag color green">
                                                <div class="filter-swatch"><span
                                                        class="lazyload bg_color_green"></span></div>
                                                green</a></li>
                                        <li><a href="/collections/women/color-grey?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag color grey">
                                                <div class="filter-swatch"><span
                                                        class="lazyload bg_color_grey"></span></div>
                                                grey</a></li>
                                        <li><a href="/collections/women/color-pink?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag color pink">
                                                <div class="filter-swatch"><span
                                                        class="lazyload bg_color_pink"></span></div>
                                                pink</a></li>
                                        <li><a href="/collections/women/color-pink-clay?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag color pink clay">
                                                <div class="filter-swatch"><span
                                                        class="lazyload bg_color_pink-clay"></span></div>
                                                pink clay</a></li>
                                        <li><a href="/collections/women/color-sliver?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag color sliver">
                                                <div class="filter-swatch"><span
                                                        class="lazyload bg_color_sliver"></span></div>
                                                sliver</a></li>
                                        <li><a href="/collections/women/color-white?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag color white">
                                                <div class="filter-swatch"><span
                                                        class="lazyload bg_color_white"></span></div>
                                                white</a></li>
                                        <li><a href="/collections/women/color-white-cream?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag color white cream">
                                                <div class="filter-swatch"><span
                                                        class="lazyload bg_color_white-cream"></span></div>
                                                white cream</a></li>
                                        <li><a href="/collections/women/color-beige?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag color beige">
                                                <div class="filter-swatch"><span
                                                        class="lazyload bg_color_beige"></span></div>
                                                beige</a></li>
                                        <li><a href="/collections/women/color-blue?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag color blue">
                                                <div class="filter-swatch"><span
                                                        class="lazyload bg_color_blue"></span></div>
                                                blue</a></li>
                                        <li><a href="/collections/women/color-brown?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag color brown">
                                                <div class="filter-swatch"><span
                                                        class="lazyload bg_color_brown"></span></div>
                                                brown</a></li>
                                    </ul>
                                </div>
                            </div>
                            <style>
                                .cat_filter {
                                    opacity: 1;
                                    pointer-events: auto
                                }

                                .type_toolbar_filter {
                                    display: block
                                }
                            </style>
                            <div class="col-12 col-md-3 widget block_1581914074326">
                                <h5 class="widget-title">By Price</h5>
                                <div class="loke_scroll">
                                    <ul class="nt_filter_block nt_filter_styleck css_ntbar">
                                        <li><a href="/collections/women/price-50-150?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag price $50-$150">$50-$150</a>
                                        </li>
                                        <li><a href="/collections/women/price-7-50?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag price $7-$50">$7-$50</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <style>
                                .cat_filter {
                                    opacity: 1;
                                    pointer-events: auto
                                }

                                .type_toolbar_filter {
                                    display: block
                                }
                            </style>
                            <div class="col-12 col-md-3 widget block_1581913909406">
                                <h5 class="widget-title">By Size</h5>
                                <div class="loke_scroll">
                                    <ul class="nt_filter_block nt_filter_styleck css_ntbar">
                                        <li><a href="/collections/women/size-l?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag size l">l</a>
                                        </li>
                                        <li><a href="/collections/women/size-m?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag size m">m</a>
                                        </li>
                                        <li><a href="/collections/women/size-s?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag size s">s</a>
                                        </li>
                                        <li><a href="/collections/women/size-uk-2?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag size uk 2">uk
                                                2</a></li>
                                        <li><a href="/collections/women/size-uk3?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag size uk3">uk3</a>
                                        </li>
                                        <li><a href="/collections/women/size-uk4?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag size uk4">uk4</a>
                                        </li>
                                        <li><a href="/collections/women/size-xl?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag size xl">xl</a>
                                        </li>
                                        <li><a href="/collections/women/size-xs?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag size xs">xs</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <style>.cat_filter {
                                    opacity: 1;
                                    pointer-events: auto
                                }

                                .type_toolbar_filter {
                                    display: block
                                }</style>
                            <div class="col-12 col-md-3 widget blockid_brand">
                                <h5 class="widget-title">By Brand</h5>
                                <div class="loke_scroll">
                                    <ul class="nt_filter_block nt_filter_styleck css_ntbar">
                                        <li><a href="/collections/women/vendor-ck?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag vendor ck">ck</a>
                                        </li>
                                        <li><a href="/collections/women/vendor-h-m?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag vendor h&amp;m">h&amp;m</a>
                                        </li>
                                        <li><a href="/collections/women/vendor-kalles?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag vendor kalles">kalles</a>
                                        </li>
                                        <li><a href="/collections/women/vendor-levis?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag vendor levi's">levi's</a>
                                        </li>
                                        <li><a href="/collections/women/vendor-monki?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag vendor monki">monki</a>
                                        </li>
                                        <li><a href="/collections/women/vendor-nike?sort_by=best-selling"
                                               aria-label="Narrow selection to products matching tag vendor nike">nike</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <style>.cat_filter {
                                    opacity: 1;
                                    pointer-events: auto
                                }

                                .type_toolbar_filter {
                                    display: block
                                }</style>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-12">
            <div id="shopify-section-collection_page" class="shopify-section tp_se_cdt">
                <div class="nt_svg_loader dn"></div>
                <div class="products nt_products_holder row fl_center row_pr_1 cdt_des_1 round_cd_false nt_cover ratio_nt position_8 space_30 nt_default">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-md-3 col-12 pr_animated done mt__30 pr_grid_item product nt_pr desgin__1">
                            <div class="product-inner pr">
                                <div class="product-image pr oh lazyloaded product-custom" >
                                    <span class="tc nt_labels pa pe_none cw"></span>
                                    <a class="db" href="<?php echo e($product->getHref(true)); ?>">
                                        <div class="pr_lazy_img main-img nt_img_ratio nt_bg_lz lazyloaded"
                                             data-id="14246008717451"
                                             data-bgset="<?php echo e($product->getAvatar()); ?>"
                                             data-parent-fit="width" data-wiis="" data-ratio="0.7837837837837838"
                                             style="padding-top: 127.586%; background-image: url('<?php echo e($product->getAvatar()); ?>');">
                                            <picture style="display: none;">
                                                <source
                                                    data-srcset="<?php echo e($product->getAvatar()); ?>"
                                                    sizes="270px"
                                                    srcset="<?php echo e($product->getAvatar()); ?>">
                                                <img alt="" class="lazyautosizes lazyloaded" data-sizes="auto"
                                                     data-ratio="0.7837837837837838" sizes="270px"></picture>
                                        </div>
                                    </a>
                                    <div class="hover_img pa pe_none t__0 l__0 r__0 b__0 op__0">
                                        <div class="pr_lazy_img back-img pa nt_bg_lz lazyloaded"
                                             data-id="14246008750219"
                                             data-bgset="<?php echo e($product->getAvatar()); ?>"
                                             data-parent-fit="width" data-wiis="" data-ratio="0.7837837837837838"
                                             style="padding-top: 127.586%; background-image: url('<?php echo e($product->getAvatar()); ?>');">
                                            <picture style="display: none;">
                                                <source
                                                    data-srcset="<?php echo e($product->getAvatar()); ?>"
                                                    sizes="270px"
                                                    srcset="<?php echo e($product->getAvatar()); ?>">
                                                <img alt="" class="lazyautosizes lazyloaded" data-sizes="auto"
                                                     data-ratio="0.7837837837837838" sizes="270px"></picture>
                                        </div>
                                    </div>
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
                                    <div class="nt_add_w ts__03 pa ">
                                        <div class="product-love sp-love-<?php echo e($product->id); ?>" onclick="jssplove(this, <?php echo e($product->id); ?>)">
                                            <?php if($product->isLoved()): ?>
                                                <i class="fas fa-heart active" title="Đã Yêu Thích SP"></i>
                                            <?php else: ?>
                                                <i class="fas fa-heart" title="Thêm SP Yêu Thích"></i>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="hover_button op__0 tc pa flex column ts__03">
                                        <a href="javascript:void(0)" data-id="4540696920203" onclick="jscartdh(<?php echo e($product->id); ?>)"
                                           class="pr pr_atc cd br__40 bgw tc dib cb chp ttip_nt tooltip_top_left"
                                           rel="nofollow"><span class="tt_txt text-capitalize">thêm vào giỏ</span><i
                                                class="iccl iccl-cart"></i><span class="text-capitalize">thêm vào giỏ</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-info mt__15">
                                    <h3 class="product-title pr fs__14 mg__0 fwm"><a
                                            class="cd chp" href="<?php echo e($product->getHref(true)); ?>"><?php echo e($product->getTitle()); ?></a></h3>
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
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>

    <div class="view-more mt__100">
        <div class="more-pagination">
            <?php echo e($products->appends(request()->query())->links()); ?>

        </div>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/widgets/front_end/pagination_products.blade.php ENDPATH**/ ?>