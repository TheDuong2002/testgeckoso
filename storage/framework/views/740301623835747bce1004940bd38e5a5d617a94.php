<?php
$apiCore = new \App\Api\Core;
$viewer = $apiCore->getViewer();

$apiMobile = new \App\Api\Mobile;
$isMobile = $apiMobile->isMobile();
?>

<div class="pr clearfix copy_btn_breadcrumb">
    <?php if(!$isMobile): ?>

        <div class="pa copy_btn_wrapper">
            <?php if(isset($refLink) && !empty($refLink)): ?>
                <button class="button text-uppercase copy_btn" onclick="jsbindcateqr()">
                    qr code
                </button>
                <button class="button text-uppercase copy_btn" onclick="copyToClipboardLink()">
                    copy link giới thiệu
                </button>
            <?php endif; ?>

            <?php if(isset($pdfLink) && !empty($pdfLink)): ?>
                <button class="button text-uppercase copy_btn" onclick="gotoPage('<?php echo e($pdfLink); ?>')">
                    <i class="fa fa-file-pdf"></i> pdf
                </button>
            <?php endif; ?>

            <?php if(isset($excelLink) && !empty($excelLink)): ?>
                <button class="button text-uppercase copy_btn" onclick="gotoPage('<?php echo e($excelLink); ?>')">
                    <i class="fa fa-file-excel"></i> excel
                </button>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <ul class="breadcrumb">
        <li><a href="<?php echo e(url('')); ?>">Trang Chủ</a></li>
        <?php if(isset($text2) && !empty($text2)): ?>
            <?php if(isset($text2link) && !empty($text2link)): ?>
            <li><a href="<?php echo e($text2link); ?>"><?php echo e($text2); ?></a></li>
            <?php else: ?>
                <li><?php echo e($text2); ?></li>
            <?php endif; ?>
        <?php endif; ?>
        <?php if(isset($text1) && !empty($text1)): ?>
            <?php if(isset($text1link) && !empty($text1link)): ?>
                <li><a href="<?php echo e($text1link); ?>"><?php echo e($text1); ?></a></li>
            <?php else: ?>
                <li><?php echo e($text1); ?></li>
            <?php endif; ?>
        <?php endif; ?>

    </ul>

    <?php if($isMobile): ?>
        <div class="clearfix text-right">
            <?php if(isset($refLink) && !empty($refLink)): ?>
                <button class="button text-uppercase copy_btn" onclick="jsbindcateqr()">
                    qr code
                </button>
                <button class="button text-uppercase copy_btn" onclick="copyToClipboardLink()">
                    copy link giới thiệu
                </button>
            <?php endif; ?>
            <?php if(isset($pdfLink) && !empty($pdfLink)): ?>
                <button class="button text-uppercase copy_btn" onclick="gotoPage('<?php echo e($pdfLink); ?>')">
                    <i class="fa fa-file-pdf"></i> pdf
                </button>
            <?php endif; ?>
            <?php if(isset($excelLink) && !empty($excelLink)): ?>
                <button class="button text-uppercase copy_btn" onclick="gotoPage('<?php echo e($excelLink); ?>')">
                    <i class="fa fa-file-excel"></i> excel
                </button>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<?php if(isset($refLink) && !empty($refLink)): ?>
<div class="mfp-wrap mfp-close-btn-in mfp-auto-cursor mfp-move-horizontal prpr_pp_wrapper mfp-ready overlay_bg_2 hidden" tabindex="-1" style="overflow: hidden auto;">
    <div class="mfp-container mfp-s-ready mfp-inline-holder">
        <div class="mfp-content">
            <div class="popup_qr">
                <?php echo \QrCode::size(200)->generate($refLink);; ?>

            </div>

            <button title="Close (Esc)" type="button" class="mfp-close" onclick="jsspvideoclose()">×</button>
        </div>
    </div>
</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/modals/breadcrumb.blade.php ENDPATH**/ ?>