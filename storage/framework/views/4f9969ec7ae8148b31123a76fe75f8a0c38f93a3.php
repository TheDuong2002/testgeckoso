<?php
$apiFE = new \App\Api\FE();
$apiCore = new \App\Api\Core();
$apiMobile = new \App\Api\Mobile;
$isMobile = $apiMobile->isMobile();

$eventFeatured = $apiFE->getEvents(['featured' => 1, 'only_one' => 1, 'random' => 1]);
$events = $apiFE->getEvents(['not_featured' => 1, 'limit' => 3, 'random' => 1]);
?>

<style data-shopify>
    .nt_se_159021986237513 {
        margin-top: 30px !important;
        margin-right: !important;
        margin-bottom: 30px !important;
        margin-left: !important;
    }

    #event_featured .nt_promotion_html {
        /*top: 50%;*/
        /*left: 11%;*/
        /*transform: translate(-11%, -50%);*/
    }

    #event_featured .nt_promotion_html, #event_featured .nt_promotion_html > *, #event_featured .nt_promotion_html .btn_icon_true:after {
        color: #222222
    }

    #event_featured .nt_promotion > a:after {
        background-color: #000;
        opacity: 0.0
    }

    #event_featured .nt_bg_lz {
        padding-top: 59.60264900662252%;
    }
</style>

<div id="shopify-section-159021986237513" class="shopify-section nt_section type_banner2 type_packery">
    <div class="nt_se_159021986237513 container home_custom">
        <div class="row al_center fl_center title_10 ">
            <div class="col-auto col-md">
                <h3 class="dib tc section-title fs__24 text-uppercase">bài viết & giới thiệu</h3>
            </div>
        </div>

        <div class="mt__30 nt_banner_holder row fl_center js_packery cat_space_30" data-packery='{ "itemSelector": ".cat_space_item","gutter": 0,"percentPosition": true,"originLeft": true }'>
            <div class="grid-sizer"></div>
            <?php if($eventFeatured): ?>
            <div class="cat_space_item col-lg-3 col-md-3 col-12 pr_animated done" id="event_featured">
                <div class="banner_hzoom nt_promotion oh pr">
                    <div class="nt_bg_lz pr_lazy_img lazyload item__position "
                         data-bgset="<?php echo e($eventFeatured->getAvatar()); ?>"
                         data-sizes="auto" data-parent-fit="cover">
                    </div>
                    <a href="<?php echo e($eventFeatured->getHref(true)); ?>" class="pa t__0 l__0 r__0 b__0"></a>
                    <div class="nt_promotion_html t__0 l__0 tl pe_none">
                        <?php if(!$isMobile): ?>
                            <h3 class="mt__10 "><?php echo e($eventFeatured->getTitle()); ?></h3>
                        <?php else: ?>
                            <div class="">
                                <h3><?php echo e($eventFeatured->getTitle()); ?></h3>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if(count($events)): ?>
            <div class="cat_space_item col-lg-3 col-md-3 col-12 pr_animated done">
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mb__20">
                        <a href="<?php echo e($ite->getHref(true)); ?>">
                            <?php if(!$isMobile): ?>
                                <div class="pr clearfix">
                                    <div class="float-left mr__10">
                                        <img width="100" height="75" class="ttkt_img" src="<?php echo e($ite->getAvatar('normal')); ?>" />
                                    </div>
                                    <div class="overflow-hidden">
                                        <div class="ttkt_tc_title"><?php echo e($ite->getShortTitle(90)); ?></div>
                                    </div>
                                </div>
                            <?php else: ?>
                            <div class="row">
                                <div class="col-sm-3 mb__5">
                                    <img width="100" height="75" class="ttkt_img" src="<?php echo e($ite->getAvatar('normal')); ?>" />
                                </div>
                                <div class="col-sm-9 mb__5">
                                    <div class="tc">
                                        <h3><?php echo e($ite->getTitle()); ?></h3>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            <div class="cat_space_item col-lg-6 col-md-6 col-12 pr_animated done vd_wrapper">
                <?php if(!$isMobile): ?>
                    <div class="float-right ml__10">
                        <?php for($i=1;$i<=4;$i++): ?>
                            <?php if(!empty($apiCore->getSetting('video_' . $i))):
                            $vd = $apiCore->getSetting('video_' . $i);
                            $arr = array_filter(explode("/", $vd));
                            ?>
                            <div class="media_thumbnail mb__10 vd_thumb_<?php echo e($i); ?> <?php if($i == 1): ?> hidden <?php endif; ?>" onclick="jsbindhomevideo(<?php echo e($i); ?>)">
                                <img width="100" height="75" src="http://img.youtube.com/vi/<?php echo e($arr[count($arr)]); ?>/hqdefault.jpg" />
                            </div>
                            <?php endif;?>
                        <?php endfor; ?>
                    </div>
                    <div class="overflow-hidden text-center">
                        <?php for($i=1;$i<=4;$i++): ?>
                            <?php if(!empty($apiCore->getSetting('video_' . $i))): ?>
                            <div class="media_body vd_<?php echo e($i); ?> <?php if($i > 1): ?> hidden <?php endif; ?>" data-src="<?php echo e($apiCore->getSetting('video_' . $i)); ?>">
                                <iframe width="400" height="250" src="<?php echo e($apiCore->getSetting('video_' . $i)); ?>" frameborder="0" allowfullscreen>
                                </iframe>
                            </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                <?php else: ?>
                    <div class="overflow-hidden">
                        <?php for($i=1;$i<=4;$i++): ?>
                            <?php if(!empty($apiCore->getSetting('video_' . $i))): ?>
                                <div class="media_body vd_<?php echo e($i); ?>" data-src="<?php echo e($apiCore->getSetting('video_' . $i)); ?>">
                                    <iframe width="400" height="250" src="<?php echo e($apiCore->getSetting('video_' . $i)); ?>" frameborder="0" allowfullscreen>
                                    </iframe>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/widgets/front_end/news_and_videos.blade.php ENDPATH**/ ?>