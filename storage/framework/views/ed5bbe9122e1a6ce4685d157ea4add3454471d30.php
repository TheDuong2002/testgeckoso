<?php
$apiCore = new \App\Api\Core;
$viewer = $apiCore->getViewer();

$apiMobile = new \App\Api\Mobile;
$isMobile = $apiMobile->isMobile() ? 1 : 0;

$pageTitle = (isset($page_title)) ? $page_title : $apiCore->getSetting('site_title');
$siteTitle = $apiCore->getSetting('site_title');
$keywords = $apiCore->getSetting('site_seo');
$description = (isset($description)) ? $description : $apiCore->getSetting('site_short_description');

$maxSize = $apiCore->getMaxSize();
$maxSizeText = $apiCore->getMaxSizeText();

$siteLogo = $apiCore->getSetting('site_logo');
$hotline = $apiCore->getSetting('site_hotline');
$tuvan = $apiCore->getSetting('site_tuvan');
$siteEmail = $apiCore->getSetting('site_email');
$sitePhone = $apiCore->getSetting('site_phone');
$siteAddress = $apiCore->getSetting('site_address');
$siteAbout = $apiCore->getSetting('site_short_description');
$siteMST = $apiCore->getSetting('site_mst');
$siteCompany = $apiCore->getSetting('site_company');

$apiFE = new \App\Api\FE;
$cates = $apiFE->getProductCategories(6);
$dataShowPageFooter = $apiFE->showPageInfoFE();
?>

<style type="text/css">
    <?php if(!$isMobile): ?>
    .footer-contact {
        position: relative;
        clear: both;
    }
    <?php else: ?>
    #footer-menu li {
        margin-left: 0;
        margin-right: 20px;
    }
    <?php endif; ?>
    .footer_info i {
        font-size: 16px;
        float: left;
        width: 20px;
        text-align: center;
        color: #aaa;
        margin-right: 10px;
    }
    .footer_info .footer_text {
        color: #000;
        position: relative;
        top: -5px;
    }
</style>

<footer id="nt_footer" class="bgbl footer-1">
    <div id="shopify-section-footer_top" class="shopify-section footer__top type_instagram">
        <div class="footer__top_wrap footer_sticky_false footer_collapse_true nt_bg_overlay pr oh pt__20">
            <div class="container pr z_100">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-12 mb__20 order-lg-1 order-1">
                        <?php if($isMobile): ?>
                        <aside class="widget widget_text widget_logo">
                            <div class="textwidget widget_footer">
                                <div class="footer-contact footer_info">
                                    <p>
                                        <a class="db" href="<?php echo e(url('/')); ?>">
                                            <img
                                                class="w__100 mb__15 lazyload lz_op_ef footer_site_logo"
                                                src="<?php echo e($siteLogo); ?>"
                                                data-src="<?php echo e($siteLogo); ?>"
                                                data-widths="[135, 270]" data-sizes="auto"
                                                alt="<?php echo e($siteTitle); ?>">
                                        </a>
                                    </p>
                                    <p>
                                        <i class="fa fa-building"></i>
                                        <span class="footer_text"><?php echo e($siteCompany); ?></span>
                                    </p>
                                    <p>
                                        <i class="fa facl-info"></i>
                                        <span class="footer_text"><?php echo e("Mã số doanh nghiệp: " . $siteMST); ?></span>
                                    </p>
                                    <p>
                                        <i class="fa fa-map-marked"></i>
                                        <span><a href="http://maps.vietbando.com/maps/?t=1&st=0&sk=<?php echo e($siteAddress); ?>" target="_blank"><span class="footer_text"><?php echo e($siteAddress); ?></span></a></span>
                                    </p>
                                    <p>
                                        <i class="fa fa-inbox"></i>
                                        <span><a href="mailto:<?php echo e($siteEmail); ?>"><span class="footer_text"><?php echo e($siteEmail); ?></span></a></span>
                                    </p>
                                    <p>
                                        <i class="fa fa-phone"></i>
                                        <span><a href="tel:<?php echo e($tuvan); ?>"><span class="footer_text"><?php echo e($tuvan); ?></span></a></span>
                                    </p>
                                </div>
                            </div>
                        </aside>
                        <?php else: ?>
                            <aside class="widget widget_text widget_logo">
                                <div class="textwidget widget_footer">
                                    <div class="footer-contact">
                                        <div class="float-left mr__10">
                                            <p>
                                                <a class="db" href="<?php echo e(url('/')); ?>">
                                                    <img
                                                        class="w__100 mb__15 lazyload lz_op_ef footer_site_logo"
                                                        src="<?php echo e($siteLogo); ?>"
                                                        data-src="<?php echo e($siteLogo); ?>"
                                                        data-widths="[135, 270]" data-sizes="auto"
                                                        alt="<?php echo e($siteTitle); ?>">
                                                </a>
                                            </p>
                                        </div>

                                        <div class="overflow-hidden">
                                            <div class="footer_info mt__10">
                                                <p>
                                                    <i class="fa fa-building"></i>
                                                    <span class="footer_text"><?php echo e($siteCompany); ?></span>
                                                </p>
                                                <p>
                                                    <i class="fa facl-info"></i>
                                                    <span class="footer_text"><?php echo e("Mã số doanh nghiệp: " . $siteMST); ?></span>
                                                </p>
                                                <p>
                                                    <i class="fa fa-map-marked"></i>
                                                    <span><a href="http://maps.vietbando.com/maps/?t=1&st=0&sk=<?php echo e($siteAddress); ?>" target="_blank"><span class="footer_text"><?php echo e($siteAddress); ?></span></a></span>
                                                </p>
                                                <p>
                                                    <i class="fa fa-inbox"></i>
                                                    <span><a href="mailto:<?php echo e($siteEmail); ?>"><span class="footer_text"><?php echo e($siteEmail); ?></span></a></span>
                                                </p>
                                                <p>
                                                    <i class="fa fa-phone"></i>
                                                    <span><a href="tel:<?php echo e($tuvan); ?>"><span class="footer_text"><?php echo e($tuvan); ?></span></a></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        <?php endif; ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 mb__20 order-lg-2 order-2"></div>
                    <div class="col-lg-3 col-md-3 col-12 mb__20 order-lg-3 order-3">
                        <aside class="widget widget_nav_menu"
                               <?php if($isMobile): ?> onclick="jsbindmobifooter(this)" <?php endif; ?>
                        >
                            <div class="menu_footer widget_footer">
                                <ul class="menu">
                                    <li class="menu-item text-capitalize">
                                        <a href="<?php echo e(url('lien-he')); ?>">liên hệ</a>
                                    </li>
                                    <?php $__currentLoopData = $dataShowPageFooter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="menu-item text-capitalize">
                                            <a href="<?php echo e(url('/p_footer_infor',$item->href )); ?>"><?php echo e($item->tile); ?></a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="shopify-section-footer_bot" class="shopify-section footer__bot">
        <div class="footer__bot_wrap pt__20 pb__20">
            <div class="container pr tc">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12 col_1">Copyright © 2020 <a href="https://geckoso.com/" class="text-danger"><?php echo e($siteTitle); ?></a></div>
                    <div class="col-lg-6 col-md-12 col-12 col_2">
                        <ul id="footer-menu" class="clearfix">
                            <li class="menu-item"><a class="text-capitalize" href="<?php echo e(url('gioi-thieu')); ?>">về chúng tôi</a></li>
                            <li class="menu-item"><a class="text-capitalize" href="<?php echo e(url('lien-he')); ?>">liên hệ</a></li>
                            <li class="menu-item"><a class="text-capitalize" href="<?php echo e(url('goc-tu-van')); ?>">góc tư vấn</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/templates/ttv/footer.blade.php ENDPATH**/ ?>