<?php
$apiCore = new \App\Api\Core;
$viewer = $apiCore->getViewer();

$apiMobile = new \App\Api\Mobile;
$isMobile = $apiMobile->isMobile();

$backdropBG = $apiCore->getSetting('site_logo_ngang');

$backdropBG = (isset($bannerBG) && !empty($bannerBG)) ? $bannerBG : $backdropBG;

if ($isMobile) {
    $backdropBG = (isset($bannerBGMobi) && !empty($bannerBGMobi)) ? $bannerBGMobi : '';
}
?>

<?php if(!empty($backdropBG)): ?>
<div class="parallax-inner nt_parallax_false nt_bg_lz pa t__0 l__0 r__0 b__0 lazyloaded"
     data-bgset="<?php echo e($backdropBG); ?>" data-ratio="7.68" data-parent-fit="cover" style="background-image: url('<?php echo e($backdropBG); ?>');">
</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/modals/backdrop.blade.php ENDPATH**/ ?>