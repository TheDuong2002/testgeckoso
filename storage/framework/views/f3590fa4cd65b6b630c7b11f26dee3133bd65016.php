<?php
$apiCore = new \App\Api\Core;
$viewer = $apiCore->getViewer();

$apiMobile = new \App\Api\Mobile;
$isMobile = $apiMobile->isMobile() ? 1 : 0;

$dkTC = request()->session()->get('SIGNUP_SUCCESS');
if (!empty($dkTC)) {
    request()->session()->forget('SIGNUP_SUCCESS');
}

$dnTC = request()->session()->get('LOGIN_SUCCESS');
if (!empty($dnTC)) {
    request()->session()->forget('LOGIN_SUCCESS');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $__env->make('templates.ttv.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldPushContent('style'); ?>
</head>

<body class="lazy_icons min_cqty_0 btnt4_style_2 zoom_tp_2 css_scrollbar template-index cart_pos_side kalles_toolbar_true hover_img2 swatch_style_rounded swatch_list_size_small label_style_rectangular wrapper_cus header_full_false header_sticky_true hide_scrolld_true des_header_9 rtl_false h_transparent_false h_tr_top_false h_banner_false top_bar_true catalog_mode_false cat_sticky_false spcdt4_true lazyload" >

<div id="ld_cl_bar" class="op__0 pe_none"></div>
<div id="nt_wrapper">
    <?php echo $__env->make('templates.ttv.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div id="nt_content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php echo $__env->make('templates.ttv.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>

<?php echo $__env->make('templates.ttv.modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('templates.ttv.bot-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->yieldPushContent('js'); ?>

<a class="push_side pr cb chp db" href="javascript:void(0)" data-id="#nt_cart_canvas" id="cart_side_open"></a>

<div id="shopify-section-cart_widget" class="shopify-section">
    <div id="nt_cart_canvas" class="nt_fk_canvas dn">
        <form action="" method="post" novalidate="" class="nt_mini_cart flex column h__100 btns_cart_1">
            <div class="mini_cart_header flex fl_between al_center">
                <button type="button" class="button button_primary text-uppercase btn-cart" onclick="openPage('<?php echo e(url('/gio-hang')); ?>');">gi??? h??ng</button>
                <i class="close_pp pegk pe-7s-close ts__03 cd"></i>
            </div>
            <div class="mini_cart_wrap" id="frm-cart_side">

            </div>
        </form>
    </div>
</div>

</body>

<div class="push-sale-hihi push-right" id="site-message">
    <div class="row al_center no-gutters fl_nowrap pr bg-success text-white font-italic">

    </div>
</div>

<div class="push-sale-hihi push-right" id="add-to-cart">
    <div class="row al_center no-gutters fl_nowrap pr bg-success text-white font-italic">
        <i class="fa fa-check mr-2"></i>
        B???n ???? th??m <b class="spc ml__5 mr__5"></b> s???n ph???m v??o <a class="ml__5 text-fff text-bold" href="<?php echo e(url('gio-hang')); ?>">gi??? h??ng!</a>
    </div>
</div>

<div class="push-sale-hihi push-right" id="add-to-love">
    <div class="row al_center no-gutters fl_nowrap pr bg-danger text-white font-italic">
        <i class="fa fa-heart text-white mr-2"></i>
        C???m ??n b???n ???? y??u th??ch s???n ph???m!
    </div>
</div>

<div class="push-sale-hihi" id="push-push-push">
    <div class="row al_center no-gutters fl_nowrap pr ">
        <div class="col-auto popup_slpr_thumb mr__10">
            <a href="/products/copy-of-premium-first-aid-kit" class="db pr oh link_p_1">
                <img width="50" class="border-dark"
                    src="//cdn.shopify.com/s/files/1/0270/2098/4401/products/33.2-570x570_65x.jpg?v=1590371735"
                    srcset="//cdn.shopify.com/s/files/1/0270/2098/4401/products/33.2-570x570_65x.jpg?v=1590371735 1x,//cdn.shopify.com/s/files/1/0270/2098/4401/products/33.2-570x570_130x.jpg?v=1590371735 2x"
                    alt="sales popup"
                />
            </a>
        </div>
        <div class="col popup_slpr_info">
            <span class="db mb__5 fs__12">
                <span class="cb fs__13 client_name text-success font-weight-bold">Alex (Texas)</span>
                <span class="client_action"> purchased </span>
            </span>
            <a href="/products/copy-of-premium-first-aid-kit"
               class="pp_slpr_title db mb__5 fs__13 tu link_p_2 text-break" <?php if($isMobile): ?> style="max-width: 250px" <?php endif; ?>>
                Surgical Face Mask
            </a>
            <div class="pp_slpr_ago fs__12">
                <span class="pp_slpr_time">10 gi??y tr?????c</span>
            </div>
            <div class="pp_slpr_ago fs__12 text-right" onclick="jQuery('#push-push-push').fadeOut(123);">
                <span class="pp_slpr_time text-uppercase cursor-pointer">????ng</span>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function () {
        <?php if(!empty($dkTC)): ?>
        pushMessage("Ch??o <?php echo e($dkTC); ?>, c???m ??n b???n ???? ????ng k??!");
        <?php elseif(!empty($dnTC)): ?>
        pushMessage("Ch??o <?php echo e($dnTC); ?>, th???t vui khi ???????c g???p l???i b???n!");
        <?php endif; ?>
    });
</script>

</html>
<?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/templates/front_end/master.blade.php ENDPATH**/ ?>