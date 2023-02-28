<?php
$apiCore = new \App\Api\Core;
$viewer = $apiCore->getViewer();

$siteLogo = $apiCore->getSetting('site_logo');
$hotline = $apiCore->getSetting('site_hotline');
$tuvan = $apiCore->getSetting('site_tuvan');
$siteEmail = $apiCore->getSetting('site_email');
$sitePhone = $apiCore->getSetting('site_phone');
$siteAddress = $apiCore->getSetting('site_address');
$siteAbout = $apiCore->getSetting('site_short_description');
?>



<?php $__env->startSection('content'); ?>
    <div id="shopify-section-us_heading" class="shopify-section page_section_heading">
        <div class="page-head tc pr oh page_bg_img page_head_us_heading">
            <?php echo $__env->make('modals.backdrop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div class="container mb__50">
        <?php echo $__env->make('modals.breadcrumb', [
            'text1' => 'liên hệ',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="row">
            <div class="col-md-6">
                <div class="block-deals-of-opt2">
                    <div class="block-title">
                        <h2 class="title text-uppercase">lắng nghe bạn</h2>
                    </div>
                    <div class="block-content" id="frm-send">

                        <?php if(!empty($message)): ?>
                            <div class="alert alert-success mb-2">Cám ơn bạn đã gửi liên hệ. Chúng tôi sẽ phản hồi sớm nhất có thể.</div>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-12 mb-2" id="req-name">
                                <div class="form-group">
                                    <label class="frm-label required">* Họ Tên</label>
                                    <input required type="text" class="form-control" id="frm-name" autocomplete="off" />
                                </div>

                                <div class="alert alert-danger hidden mt-1">Vui lòng nhập họ tên.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2" id="req-phone">
                                <div class="form-group">
                                    <label class="frm-label required">* Điện Thoại</label>
                                    <input required type="text" class="form-control" id="frm-phone" autocomplete="off" />
                                </div>

                                <div class="alert alert-danger hidden mt-1">Vui lòng nhập điện thoại.</div>
                            </div>

                            <div class="col-md-6 mb-2" id="req-email">
                                <div class="form-group">
                                    <label class="frm-label required">* Email</label>
                                    <input required type="email" class="form-control" id="frm-email" autocomplete="off" />
                                </div>

                                <div class="alert alert-danger hidden mt-1">Vui lòng nhập email.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-2" id="req-body">
                                <div class="form-group">
                                    <label class="frm-label required">* Nội Dung</label>
                                    <textarea required class="form-control" id="frm-body" rows="3" cols="3"></textarea>
                                </div>

                                <div class="alert alert-danger hidden">Vui lòng nhập nội dung.</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12" id="req-button">
                                <button type="button" class="button button_primary text-uppercase" onclick="jsbindlh()">xác nhận</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="block-deals-of-opt2">
                    <div class="block-title">
                        <h2 class="title text-uppercase">thông tin liên hệ</h2>
                    </div>
                    <div class="block-content">
                        <p>Chúng tôi muốn nghe ý kiến của bạn về dịch vụ khách hàng, hàng hóa, trang web hoặc bất kỳ chủ đề nào bạn muốn chia sẻ với chúng tôi. Ý kiến và đề xuất của bạn sẽ được đánh giá cao.</p>
                        <p><i class="las la-home fs__16"></i> <?php echo e($siteAddress); ?></p>
                        <p><i class="las la-phone fs__16"></i> <?php echo e($hotline); ?> <?php if(!empty($tuvan)): ?> - <?php echo e($tuvan); ?> <?php endif; ?></p>
                        <p><i class="las la-envelope fs__16"></i> <a href="mailto:<?php echo e($siteEmail); ?>"><?php echo e($siteEmail); ?></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('templates.front_end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/pages/front_end/info/contact_us.blade.php ENDPATH**/ ?>