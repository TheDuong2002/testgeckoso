<?php
$apiCore = new \App\Api\Core;
$viewer = $apiCore->getViewer();

$apiMobile = new \App\Api\Mobile;
$isMobile = $apiMobile->isMobile() ? 1 : 0;

$apiFE = new \App\Api\FE;
$provinces = $apiFE->getProvinces();
$districts = [];
$wards = [];
$persons = [];

$overFee = $apiCore->parseToInt($apiCore->getSetting('payment_ship_free_cart'));
$freeShip = false;

$priceAll = 0;
$totalQuantity = 0;

$ids = "";
$quanHuyen = '';
$phuongXa = '';

if ($viewer) {
    $districts = $apiFE->getDistrictsByProvinceId($viewer->province_id);
    $wards = $apiFE->getWardsByDistrictId($viewer->district_id);
    $persons = $viewer->getPersons();

    if (count($districts)) {
        $arr = [];
        foreach ($districts as $district) {
            $arr[] = [
                'id' => $district->id,
                'title' => $district->title,
            ];
        }
        $quanHuyen = json_encode($arr);
    }

    if (count($wards)) {
        $arr = [];
        foreach ($wards as $ward) {
            $arr[] = [
                'id' => $ward->id,
                'title' => $ward->title,
            ];
        }
        $phuongXa = json_encode($arr);
    }
}

$URLCart = url('chinh-sach-thanh-toan');
?>



<?php $__env->startSection('content'); ?>
    <style type="text/css">
        .mau_thiep_temp,
        .upload_preview {
            clear: both;
            position: relative;
        }
        .upload_preview .img-item,
        .mau_thiep_temp .img-item {
            float: left;
            margin-right: 5px;
        }
        .upload_preview .img-preview,
        .mau_thiep_temp .img-preview {
            max-width: 170px;
            max-height: 300px;
        }

        .mfp-ajax-holder .mfp-content, .mfp-inline-holder .mfp-content {
            width: auto;
        }
        <?php if($isMobile): ?>
        .mfp-content {
            position: absolute;
            left: 0;
            top: 50%;
            margin-top: -150px;
        }
        <?php endif; ?>

        .mini_cart_actions {
            margin-top: 0;
        }

        #shopify-section-cart-template input[type=email],
        #shopify-section-cart-template input[type=text] {
            height: 35px;
            border-radius: 5px !important;
            color: #000 !important;
        }

        textarea {
            border-radius: 5px !important;
            color: #000 !important;
        }

        .price .number_format {
            <?php if($isMobile): ?>
            font-size: 16px;
            <?php else: ?>
            font-size: 18px;
        <?php endif; ?>
}

        .cart_countdown {
            display: inline-block;
            margin-bottom: 30px;
            background-color: #fcb800;
            font-size: 15px;
            font-weight: 500;
            border-radius: 4px;
        }

        .cart_countdown.dn {
            display: none !important;
        }

        .height_80px {
            height: 80px;
        }
    </style>

    <div id="shopify-section-us_heading" class="shopify-section page_section_heading">
        <div class="page-head tc pr oh page_bg_img page_head_us_heading">
            <?php echo $__env->make('modals.backdrop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <div id="shopify-section-cart-template" class="shopify-section cart_page_section container mb__60">
        <?php echo $__env->make('modals.breadcrumb', [
           'text1' => 'gi??? h??ng',
        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if(!count($products)): ?>
            <div class="empty_cart_page tc" style="margin-top: 20px !important;">
                <?php if($saved): ?>
                    <?php //$cart = $apiCore->getItem('cart', $saved); ?>
                    <style type="text/css">
                        .empty_cart_page>i:after {
                            display: none;
                        }
                    </style>
                    <i class="fa fa-check text-success mb__30 fs__90"></i>
                    <h4 class="cart_page_heading mg__0 mb__20 tu fs__30 text-success">?????t h??ng th??nh c??ng!!!</h4>
                    
                    
                    
                    <div class="cart_page_txt text-bold">C???m ??n b???n ???? l???a ch???n s???n ph???m v?? tin t?????ng ch??ng t??i.</div>
                <?php else: ?>
                    <i class="las la-shopping-bag pr mb__30 fs__90"></i>
                    <h4 class="cart_page_heading mg__0 mb__20 tu fs__30">Gi??? h??ng tr???ng!!!</h4>
                    <div class="cart_page_txt">H??y ch???n nh???ng s???n ph???m t???t nh???t c???a ch??ng t??i v???i gi?? h???p l?? nh???t.</div>
                <?php endif; ?>
                <div class="mt__30"></div>
                <p class="mb__15">
                    <?php if($viewer): ?>
                    <a class="button tu mr__5 mb__5" href="<?php echo e(url('/tai-khoan?t=dhdd')); ?>">xem ????n h??ng ???? ?????t</a>
                    <?php endif; ?>
                    <a class="button button_primary tu mr__5 mb__5" href="<?php echo e(url('/san-pham')); ?>">ti???p t???c mua h??ng</a>
                </p>
            </div>
        <?php else: ?>

            <form action="" method="post" class="frm_cart_page pr oh" autocomplete="off" id="frm-cart">
                <?php echo csrf_field(); ?>
                <div class="cart_header">
                    <div class="row al_center">
                        <div class="col-5 text-uppercase frm-label">s???n ph???m</div>
                        <?php if(!$isMobile): ?>
                            <div class="col-3 text-uppercase frm-label tc">gi??</div>
                            <div class="col-2 text-uppercase frm-label tc">s??? l?????ng</div>
                            <div class="col-2 text-uppercase frm-label tc tr_md">th??nh ti???n</div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="cart_items">
                    <?php
                    foreach ($products as $p):
                    $sale = null;

                    if ($viewer) {
                        $product = $apiCore->getItem('product', $p->product_id);

                        $quantity = $p->quantity;
                        $priceMain = $p->price_main;
                        $priceOne = $p->price_pay;
                        $priceDiscount = $p->discount;

                    } else {
                        $product = $p;

                        $cartQty = (Session::get('USR_CART_QTY'));

                        $quantity = 1;
                        if ($cartQty && count($cartQty) && isset($cartQty[$product->id])) {
                            $quantity = (int)$cartQty[$product->id];
                        }

                        $priceMain = $product->price_main;
                        $priceOne = $product->price_pay;
                        $priceDiscount = $product->discount;
                    }

                    $priceRow = $priceOne * $quantity;
                    $priceAll += $priceRow;
                    $totalQuantity += $quantity;
                    $ids .= $product->id . "_" . $quantity . ";";

                    //shipping
                    if ($overFee > 0 && $priceAll >= $overFee) {
                        //free
                        $freeShip = true;
                    } else {
                        $priceAll = $priceAll + $shippingFee;
                    }

                    ?>
                    <?php if($isMobile): ?>
                        <table class="table mb__10 cart_item c_ite" id="c_ite_<?php echo e($product->id); ?>" data-id="<?php echo e($product->id); ?>">
                            <tr>
                                <td colspan="3" class="clearfix pr">
                                    <div class="float-left mr__10">
                                        <a href="<?php echo e($product->getHref(true)); ?>">
                                            <img class="width_height_80" src="<?php echo e($product->getAvatar()); ?>" />
                                        </a>
                                    </div>
                                    <div class="overflow-hidden height_80px pr">
                                        <a href="<?php echo e($product->getHref(true)); ?>">
                                            <?php echo e($product->getTitle()); ?>

                                        </a>
                                        <div class="pa" style="bottom: 0; right: 0;">
                                            <a href="javascript:void(0)" onclick="jscartdhx(<?php echo e($product->id); ?>);jscartdhvalid(false);"
                                               class="cart_ac_remove ttip_nt tooltip_top_right"
                                            >
                                                <span class="tt_txt">X??a kh???i gi??? h??ng</span>
                                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                                     stroke-width="2" fill="none" stroke-linecap="round"
                                                     stroke-linejoin="round" class="css-i6dzq1">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 33.33%;">
                                    <div class="frm-label text-uppercase fs-12">????n gi??</div>
                                </td>
                                <td class="text-center" style="width: 33.33%;">
                                    <div class="frm-label text-uppercase fs-12">s??? l?????ng</div>
                                </td>
                                <td class="text-center" style="width: 33.33%;">
                                    <div class="frm-label text-uppercase fs-12">th??nh ti???n</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 33.33%;">
                                    <div class="cart_meta_prices price">
                                        <div class="cart_price">
                                            <?php if($priceOne!= $priceMain): ?>
                                                <del class="price_old">
                                                    <span class="number_format"><?php echo e($priceMain); ?></span>
                                                    <span class="currency_format">???</span>
                                                </del>
                                            <?php endif; ?>
                                            <strong class="fs-16">
                                                <span class="number_format"><?php echo e($priceOne); ?></span>
                                                <span class="currency_format">???</span>
                                            </strong>

                                            <input type="hidden" name="ite_one" value="<?php echo e($priceOne); ?>" />
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center mini_cart_actions" style="width: 33.33%;">
                                    <div class="quantity pr mr__10 qty__true" style="margin: 0 auto;">
                                        <input type="number" class="input-text qty text tc qty_pr_js"
                                               step="1" min="1" max="9999" name="quantity"
                                               size="4" pattern="[0-9]*" inputmode="numeric"
                                               value="<?php echo e($quantity); ?>"  onkeyup="jscartdhmq(<?php echo e($product->id); ?>)"
                                        >
                                        <div class="qty tc fs__14">
                                            <a onclick="jscartdhmu(<?php echo e($product->id); ?>);jscartdhvalid(false);"
                                               class="plus  cb pa pr__15 tr r__0" href="javascript:void(0)">
                                                <i class="facl facl-plus"></i>
                                            </a>
                                            <a onclick="jscartdhmu(<?php echo e($product->id); ?>);jscartdhvalid(false);"
                                               class="minus  cb pa pl__15 tl l__0" href="javascript:void(0)">
                                                <i class="facl facl-minus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center" style="width: 33.33%;">
                                <span class="cart-item-price price fwm cd">
                                    <strong class="color-money fs-16">
                                        <span class="number_format one_total"><?php echo e($priceRow); ?></span>
                                        <span class="currency_format">???</span>
                                    </strong>
                                </span>
                                </td>
                            </tr>
                        </table>
                    <?php else: ?>
                        <div class="cart_item cart_item_32289063698513 c_ite" id="c_ite_<?php echo e($product->id); ?>" data-id="<?php echo e($product->id); ?>">
                            <div class="ld_cart_bar"></div>
                            <div class="row al_center mb__10">
                                <div class="col-12 col-md-12 col-lg-5">
                                    <div class="page_cart_info flex al_center">
                                        <a href="<?php echo e($product->getHref(true)); ?>">
                                            <img
                                                class="w__100 lz_op_ef lazyautosizes lazyloaded width_height_80"
                                                src="<?php echo e($product->getAvatar('profile')); ?>"
                                                data-widths="[120, 240]" data-sizes="auto" alt=""
                                                data-srcset="<?php echo e($product->getAvatar('profile')); ?>"
                                                sizes="120px"
                                                srcset="<?php echo e($product->getAvatar('profile')); ?>">
                                        </a>
                                        <div class="mini_cart_body ml__15">
                                            <h5 class="mini_cart_title mg__0 mb__5">
                                                <a href="<?php echo e($product->getHref(true)); ?>"><?php echo e($product->getTitle()); ?></a>
                                            </h5>
                                            <div class="mini_cart_meta"></div>
                                            <div class="mini_cart_tool mt__10">
                                                <a href="javascript:void(0)" onclick="jscartdhx(<?php echo e($product->id); ?>);jscartdhvalid(false);"
                                                   class="cart_ac_remove ttip_nt tooltip_top_right"
                                                >
                                                    <span class="tt_txt">X??a kh???i gi??? h??ng</span>
                                                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor"
                                                         stroke-width="2" fill="none" stroke-linecap="round"
                                                         stroke-linejoin="round" class="css-i6dzq1">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path
                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-3 tc">
                                    <div class="cart_meta_prices price">
                                        <div class="cart_price">
                                            <?php if($priceOne!= $priceMain): ?>
                                                <del class="price_old">
                                                    <span class="number_format"><?php echo e($priceMain); ?></span>
                                                    <span class="currency_format">???</span>
                                                </del>
                                            <?php endif; ?>
                                            <strong class="fs-16">
                                                <span class="number_format"><?php echo e($priceOne); ?></span>
                                                <span class="currency_format">???</span>
                                            </strong>

                                            <input type="hidden" name="ite_one" value="<?php echo e($priceOne); ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-2 tc mini_cart_actions">
                                    <div class="quantity pr mr__10 qty__true" style="margin: 0 auto;">
                                        <input type="number" class="input-text qty text tc qty_pr_js"
                                               step="1" min="1" max="9999" name="quantity"
                                               size="4" pattern="[0-9]*" inputmode="numeric"
                                               value="<?php echo e($quantity); ?>"  onkeyup="jscartdhmq(<?php echo e($product->id); ?>)"
                                        >
                                        <div class="qty tc fs__14">
                                            <a onclick="jscartdhmu(<?php echo e($product->id); ?>);jscartdhvalid(false);"
                                               class="plus  cb pa pr__15 tr r__0" href="javascript:void(0)">
                                                <i class="facl facl-plus"></i>
                                            </a>
                                            <a onclick="jscartdhmu(<?php echo e($product->id); ?>);jscartdhvalid(false);"
                                               class="minus  cb pa pl__15 tl l__0" href="javascript:void(0)">
                                                <i class="facl facl-minus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-2 tc tr_lg">
                                <span class="cart-item-price price fwm cd">
                                    <strong class="color-money fs-16">
                                        <span class="number_format one_total"><?php echo e($priceRow); ?></span>
                                        <span class="currency_format">???</span>
                                    </strong>
                                </span>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="cart__footer mt__20 mb__80">
                    <?php if($isMobile): ?>
                        <div class="row">
                            <div class="col-12 order-1">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <label class="frm-label">t???ng ti???n h??ng:</label>
                                        </td>
                                        <td class="text-right">
                                            <strong class="text-black fs-18">
                                                <span class="number_format" id="cart_all"><?php echo e($priceAll); ?></span>
                                                <span class="currency_format">???</span>
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr class="hidden ma_giam_gia">
                                        <td>
                                            <label class="frm-label">gi???m gi?? ?????c bi???t:</label>
                                        </td>
                                        <td class="text-right">
                                            <strong class="text-black fs-18">
                                                <span class="number_format" id="cart_discount">0</span>
                                                <span class="currency_format">???</span>
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="frm-label">ph?? giao h??ng:</label>
                                        </td>
                                        <td class="text-right">
                                            <strong class="fs-18">
                                                <span class="number_format <?php if($freeShip): ?> line_through <?php endif; ?>" id="cart_shipping"><?php echo e($shippingFee); ?></span>
                                                <span class="currency_format">???</span>
                                            </strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="frm-label">t???ng thanh to??n:</label>
                                        </td>
                                        <td class="text-right">
                                            <strong class="color-money fs-18">
                                                <span class="number_format text-bold" id="cart_total"><?php echo e($priceAll); ?></span>
                                                <span class="currency_format">???</span>
                                            </strong>
                                        </td>
                                    </tr>
                                </table>

                                <table class="table">
                                    <tr class="hidden">
                                        <td>
                                            <div>
                                                <label class="frm-label fs-11">M?? gi???m gi?? ?????c bi???t</label>
                                            </div>
                                            <div id="ele-referer">
                                                <input class="text-center text-uppercase" type="text" name="ref_code" onkeypress="pressNoSpace(event)"
                                                       <?php if(!empty($refCode)): ?> value="<?php echo e($refCode); ?>" <?php endif; ?>
                                                />
                                            </div>
                                        </td>
                                    </tr>
                                    <?php if(!$viewer): ?>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="frm-label fs-11 required">H??? T??n <span class="required">*</span></label>
                                                </div>
                                                <div id="ele-name">
                                                    <input class="text-center" required type="text" name="name" autocomplete="off" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="frm-label fs-11 required">??i???n Tho???i <span class="required">*</span></label>
                                                </div>
                                                <div id="ele-phone">
                                                    <input class="text-center" required type="text" name="phone" autocomplete="off"
                                                           onkeypress="return isInputPhone(event, this)"
                                                           oncopy="return false;" oncut="return false;" onpaste="return false;"
                                                    />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <label class="frm-label fs-11">?????a ch??? email</label>
                                                </div>
                                                <div id="ele-email">
                                                    <input class="text-center" type="email" name="email" />
                                                </div>
                                            </td>
                                        </tr>
                                    <?php else: ?>

                                        <?php if(count($persons)): ?>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <label class="frm-label fs-11 text-black-50">g???i t???ng</label>
                                                    </div>
                                                    <div class="mt__15">
                                                        <select name="person_id" class="form-control" onchange="jscartgetdate(this)">
                                                            <option value="">Kh??ng T???ng Cho Ai</option>
                                                            <?php $__currentLoopData = $persons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($person->id); ?>"><?php echo e($person->getRelationship() ? $person->getRelationship()->getTitle() . ': ' . $person->getTitle() : $person->getTitle()); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>

                                                        <select name="date_id" class="form-control mt__15 hidden">

                                                        </select>

                                                        <div class="">
                                                            <div class="row">
                                                                <div class="col-md-6 mt__15">
                                                                    <input onclick="jscartdcnh(1)" checked="checked" name="dia_chi_1" type="checkbox" class="mr__5 width_height_20" style="margin: 0; cursor: pointer;" />
                                                                    <label>D??ng ?????a ch??? c???a t??i</label>
                                                                </div>
                                                                <div class="col-md-6 mt__15">
                                                                    <input onclick="jscartdcnh(2)" name="dia_chi_2" type="checkbox" class="mr__5 width_height_20" style="margin: 0; cursor: pointer;" />
                                                                    <label>D??ng ?????a ch??? ng?????i ???????c t???ng</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <tr>
                                        <td>
                                            <div>
                                                <label class="frm-label fs-11 required">?????a ch??? nh???n h??ng <span class="required">*</span></label>
                                            </div>
                                            <div id="ele-address" class="mb__10">
                                                <input class="text-center" required type="text" name="address" value="<?php echo e($viewer ? $viewer->address : ''); ?>" />
                                            </div>
                                            <div id="frm-address">
                                                <div class="mb__10" id="ele-province">
                                                    <select required name="province_id" class="form-control select-css" onchange="jscartaddressopts(this, 'district');jscartdhvalid(false);jscartdhcal();">
                                                        <option value="">H??y ch???n t???nh / th??nh</option>
                                                        <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($viewer && $viewer->province_id == $ite->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($ite->id); ?>"><?php echo e($ite->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </div>
                                                <div class="mb__10" id="ele-district">
                                                    <select required name="district_id" class="form-control select-css" onchange="jscartaddressopts(this, 'ward');">
                                                        <option value="">H??y ch???n qu???n / huy???n</option>
                                                        <?php if(count($districts)): ?>
                                                            <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option <?php if($viewer && $viewer->district_id == $ite->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($ite->id); ?>"><?php echo e($ite->title); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                                <div class="mb__10" id="ele-ward">
                                                    <select required name="ward_id" class="form-control select-css" onchange="jscartdhvalid(false);">
                                                        <option value="">H??y ch???n ph?????ng / x??</option>
                                                        <?php if(count($wards)): ?>
                                                            <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option <?php if($viewer && $viewer->ward_id == $ite->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($ite->id); ?>"><?php echo e($ite->title); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="hidden">
                                        <td>
                                            <div>
                                                <label class="frm-label fs-11">giao h??ng</label>
                                            </div>
                                            <div class="mb__10">
                                                <div class="cart_ship gh_thuong active" onclick="jscartshipment('gh_thuong');jscartdhvalid(false);jscartdhcal();">
                                                    <img src="<?php echo e(url('public')); ?>/images/shipping.png" />
                                                    <div>giao h??ng<br/>th?????ng</div>
                                                </div>
                                            </div>
                                            <div class="mb__10">
                                                <div class="cart_ship gh_nhanh" onclick="jscartshipment('gh_nhanh');jscartdhvalid(false);jscartdhcal();">
                                                    <img src="<?php echo e(url('public')); ?>/images/shipping_fast.png" />
                                                    <div>giao h??ng<br/>nhanh</div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                <label class="frm-label fs-11">ph????ng th???c thanh to??n</label>
                                            </div>
                                            <div class=" mb__10">
                                                <div class="cart_payment cod active" onclick="jscartpttt('cod')">
                                                    <img src="<?php echo e(url('public')); ?>/images/cod.png" />
                                                    <div>ti???n m???t khi<br/>nh???n h??ng</div>
                                                </div>
                                            </div>
                                            <div class=" mb__10">
                                                <div class="cart_payment banking" onclick="jscartpttt('banking')">
                                                    <img src="<?php echo e(url('public')); ?>/images/banking.png" />
                                                    <div>chuy???n kho???n<br/>ng??n h??ng</div>
                                                </div>
                                            </div>
                                            <div class=" mb__10 hidden">
                                                <div class="cart_payment vnpay" onclick="jscartpttt('vnpay')">
                                                    <img src="<?php echo e(url('public')); ?>/images/vnpay.jpg" />
                                                    <div>thanh to??n<br/>vnpay</div>
                                                </div>
                                            </div>
                                            <div class=" mb__10 hidden">
                                                <div class="cart_payment zalopay" onclick="jscartpttt('zalopay')">
                                                    <img src="<?php echo e(url('public')); ?>/images/zalopay.png" />
                                                    <div>thanh to??n<br/>zalopay</div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row" id="req-wish">
                                                <div class="col-md-3">
                                                    <label class="frm-label fs-11">c??u ch??c</label>
                                                    <div>
                                                        <input onclick="jscartcc(this)" name="cau_chuc_co_san" type="checkbox" class="mr__5 width_height_20" style="margin: 0;cursor: pointer;" /> Ch???n c??u ch??c c?? s???n
                                                    </div>
                                                </div>
                                                <div class="col-md-9 mt__15">
                                                    <div class="cau_chuc tu_viet">
                                                        <textarea placeholder="H??y vi???t c??u ch??c b???n mu???n..." name="cau_chuc_tu_viet" class="form-control min_height_100px" rows="3" cols="3"></textarea>
                                                    </div>
                                                    <div class="cau_chuc co_san hidden">
                                                        <select name="cate_wish_template" onchange="jscartcscc(this)" class="form-control">
                                                            <?php if(count($templates)): ?>
                                                                <option value="">H??y ch???n ch??? ?????</option>
                                                                <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($ite->id); ?>"><?php echo e($ite->getTitle()); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="0">Kh??c</option>
                                                            <?php endif; ?>
                                                        </select>

                                                        <select name="cate_wish_id" onchange="jscartcsccget(this)" class="form-control mt__10"></select>

                                                        <div class="cau_chuc_temp mt__10"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="row" id="req-card">
                                                <div class="col-md-3">
                                                    <label class="frm-label fs-11">m???u thi???p</label>
                                                    <div>
                                                        <input onclick="jscartmt(this)" name="mau_thiep_co_san" type="checkbox" class="mr__5 width_height_20" style="margin: 0;cursor: pointer;" /> Ch???n m???u thi???p c?? s???n
                                                    </div>
                                                </div>
                                                <div class="col-md-9 mt__15">
                                                    <div class="mau_thiep tu_viet">
                                                        <input type="file" name="mau_thiep[]" id="mau_thiep_tu_viet" multiple />

                                                        <div class="alert alert-danger hidden mt__10">Vui l??ng kh??ng upload h??nh l???n h??n <b class="max-size-text"></b>.</div>

                                                        <div class="upload_preview mt__10"></div>
                                                    </div>
                                                    <div class="mau_thiep co_san hidden">
                                                        <select name="cate_card_template" onchange="jscartcsmt(this)" class="form-control">
                                                            <?php if(count($templates)): ?>
                                                                <option value="">H??y ch???n ch??? ?????</option>
                                                                <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($ite->id); ?>"><?php echo e($ite->getTitle()); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="0">Kh??c</option>
                                                            <?php endif; ?>
                                                        </select>

                                                        <select name="cate_card_id" onchange="jscartcsmtget(this)" class="form-control mt__10"></select>

                                                        <div class="mau_thiep_temp mt__10"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                <?php echo $__env->make('modals.payment_account', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                                <table class="table">
                                    <tr>
                                        <td class="clearfix">
                                            <div class="float-left mr__10">
                                                <input required type="checkbox" class="mr__5 width_height_20" style="margin: 0; cursor: pointer;">
                                            </div>
                                            <div class="overflow-hidden">
                                                <label for="cart_agree">
                                                    <a class="text-site text-bold" href="<?php echo e($URLCart); ?>" target="_blank">
                                                        T??i ???? ?????c v?? ?????ng ?? c??c ch??nh s??ch c???a c??ng ty.
                                                    </a>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button type="submit" name="checkout" class="btn_checkout button button_primary tu mt__10 mb__10 width_full">
                                                x??c nh???n ?????t h??ng
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div>
                                                <textarea name="note" class="cart-note__input min_height_100px" placeholder="Ghi ch?? ????n h??ng..."></textarea>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="row">
                            <div class="col-12 col-md-7 cart_actions tl_md tc order-md-2 order-2 mb__50">
                                <div class="row hidden">
                                    <div class="col-md-3 mt__15">
                                        <label class="frm-label fs-11">M?? gi???m gi?? ?????c bi???t</label>
                                    </div>
                                    <div class="col-md-9 mt__15" id="ele-referer">
                                        <input class="text-center text-uppercase" type="text" name="ref_code" onkeypress="pressNoSpace(event)"
                                               <?php if(!empty($refCode)): ?> value="<?php echo e($refCode); ?>" <?php endif; ?>
                                        />
                                    </div>
                                </div>
                                <?php if(!$viewer): ?>
                                    <div class="row">
                                        <div class="col-md-3 mt__15">
                                            <label class="frm-label fs-11 required">H??? T??n <span class="required">*</span></label>
                                        </div>
                                        <div class="col-md-9 mt__15" id="ele-name">
                                            <input class="text-center" required type="text" name="name" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 mt__15">
                                            <label class="frm-label fs-11 required">??i???n Tho???i <span class="required">*</span></label>
                                        </div>
                                        <div class="col-md-9 mt__15" id="ele-phone">
                                            <input class="text-center" required type="text" name="phone" autocomplete="off"
                                                   onkeypress="return isInputPhone(event, this)"
                                                   oncopy="return false;" oncut="return false;" onpaste="return false;"
                                            />
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-md-3 mt__15">
                                            <label class="frm-label fs-11">?????a ch??? email</label>
                                        </div>
                                        <div class="col-md-9 mt__15" id="ele-email">
                                            <input  class="text-center" type="email" name="email" />
                                        </div>
                                    </div>
                                <?php else: ?>

                                    <?php if(count($persons)): ?>
                                        <div class="row">
                                            <div class="col-md-3 mt__15">
                                                <label class="frm-label fs-11 text-black-50">g???i t???ng</label>
                                            </div>
                                            <div class="col-md-9 mt__15">
                                                <select name="person_id" class="form-control" onchange="jscartgetdate(this)">
                                                    <option value="">Kh??ng T???ng Cho Ai</option>
                                                    <?php $__currentLoopData = $persons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($person->id); ?>"><?php echo e($person->getRelationship() ? $person->getRelationship()->getTitle() . ': ' . $person->getTitle() : $person->getTitle()); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>

                                                <select name="date_id" class="form-control mt__15 hidden">

                                                </select>

                                                <div class="">
                                                    <div class="row">
                                                        <div class="col-md-6 mt__15">
                                                            <input onclick="jscartdcnh(1)" checked="checked" name="dia_chi_1" type="checkbox" class="mr__5 width_height_20" style="margin: 0; cursor: pointer;" />
                                                            <label>D??ng ?????a ch??? c???a t??i</label>
                                                        </div>
                                                        <div class="col-md-6 mt__15">
                                                            <input onclick="jscartdcnh(2)" name="dia_chi_2" type="checkbox" class="mr__5 width_height_20" style="margin: 0; cursor: pointer;" />
                                                            <label>D??ng ?????a ch??? ng?????i ???????c t???ng</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-md-3 mt__15">
                                        <label class="frm-label fs-11 required">?????a ch??? nh???n h??ng <span class="required">*</span></label>
                                    </div>
                                    <div class="col-md-9 mt__15" id="ele-address">
                                        <input class="text-center" required type="text" name="address" value="<?php echo e($viewer ? $viewer->address : ''); ?>" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mt__15"></div>
                                    <div class="col-md-9 mt__15" id="frm-address">
                                        <div class="row">
                                            <div class="col-md-4" id="ele-province">
                                                <select required name="province_id" class="form-control select-css" onchange="jscartaddressopts(this, 'district');jscartdhvalid(false);jscartdhcal();">
                                                    <option value="">H??y ch???n t???nh / th??nh</option>
                                                    <?php $__currentLoopData = $provinces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option <?php if($viewer && $viewer->province_id == $ite->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($ite->id); ?>"><?php echo e($ite->title); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4" id="ele-district">
                                                <select required name="district_id" class="form-control select-css" onchange="jscartaddressopts(this, 'ward');">
                                                    <option value="">H??y ch???n qu???n / huy???n</option>
                                                    <?php if(count($districts)): ?>
                                                        <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($viewer && $viewer->district_id == $ite->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($ite->id); ?>"><?php echo e($ite->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4" id="ele-ward">
                                                <select required name="ward_id" class="form-control select-css" >
                                                    <option value="">H??y ch???n ph?????ng / x??</option>
                                                    <?php if(count($wards)): ?>
                                                        <?php $__currentLoopData = $wards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($viewer && $viewer->ward_id == $ite->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($ite->id); ?>"><?php echo e($ite->title); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row hidden">
                                    <div class="col-md-3 mt__15">
                                        <label class="frm-label fs-11">giao h??ng</label>
                                    </div>
                                    <div class="col-md-9 mt__15">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="cart_ship gh_thuong active" onclick="jscartshipment('gh_thuong');jscartdhvalid(false);jscartdhcal();">
                                                    <img src="<?php echo e(url('public')); ?>/images/shipping.png" />
                                                    <div>giao h??ng<br/>th?????ng</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="cart_ship gh_nhanh" onclick="jscartshipment('gh_nhanh');jscartdhvalid(false);jscartdhcal();">
                                                    <img src="<?php echo e(url('public')); ?>/images/shipping_fast.png" />
                                                    <div>giao h??ng<br/>nhanh</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 mt__15">
                                        <label class="frm-label fs-11">ph????ng th???c thanh to??n</label>
                                    </div>
                                    <div class="col-md-9 mt__15">
                                        <div class="row">
                                            <div class="col-md-6 mb__10">
                                                <div class="cart_payment cod active" onclick="jscartpttt('cod')">
                                                    <img src="<?php echo e(url('public')); ?>/images/cod.png" />
                                                    <div>ti???n m???t khi<br/>nh???n h??ng</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb__10">
                                                <div class="cart_payment banking" onclick="jscartpttt('banking')">
                                                    <img src="<?php echo e(url('public')); ?>/images/banking.png" />
                                                    <div>chuy???n kho???n<br/>ng??n h??ng</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb__10 hidden">
                                                <div class="cart_payment vnpay" onclick="jscartpttt('vnpay')">
                                                    <img src="<?php echo e(url('public')); ?>/images/vnpay.jpg" />
                                                    <div>thanh to??n<br/>vnpay</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb__10 hidden">
                                                <div class="cart_payment zalopay" onclick="jscartpttt('zalopay')">
                                                    <img src="<?php echo e(url('public')); ?>/images/zalopay.png" />
                                                    <div>thanh to??n<br/>zalopay</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="req-wish">
                                    <div class="col-md-3 mt__15">
                                        <label class="frm-label fs-11">c??u ch??c</label>
                                        <div>
                                            <input onclick="jscartcc(this)" name="cau_chuc_co_san" type="checkbox" class="mr__5 width_height_20" style="margin: 0;cursor: pointer;" /> Ch???n c??u ch??c c?? s???n
                                        </div>
                                    </div>
                                    <div class="col-md-9 mt__15">
                                        <div class="cau_chuc tu_viet">
                                            <textarea placeholder="H??y vi???t c??u ch??c b???n mu???n..." name="cau_chuc_tu_viet" class="form-control min_height_100px" rows="3" cols="3"></textarea>
                                        </div>
                                        <div class="cau_chuc co_san hidden">
                                            <select name="cate_wish_template" onchange="jscartcscc(this)" class="form-control">
                                                <?php if(count($templates)): ?>
                                                    <option value="">H??y ch???n ch??? ?????</option>
                                                    <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($ite->id); ?>"><?php echo e($ite->getTitle()); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="0">Kh??c</option>
                                                <?php endif; ?>
                                            </select>

                                            <select name="cate_wish_id" onchange="jscartcsccget(this)" class="form-control mt__10"></select>

                                            <div class="cau_chuc_temp mt__10"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="req-card">
                                    <div class="col-md-3 mt__15">
                                        <label class="frm-label fs-11">m???u thi???p</label>
                                        <div>
                                            <input onclick="jscartmt(this)" name="mau_thiep_co_san" type="checkbox" class="mr__5 width_height_20" style="margin: 0;cursor: pointer;" /> Ch???n m???u thi???p c?? s???n
                                        </div>
                                    </div>
                                    <div class="col-md-9 mt__15">
                                        <div class="mau_thiep tu_viet">
                                            <input type="file" name="mau_thiep[]" id="mau_thiep_tu_viet" multiple />

                                            <div class="alert alert-danger hidden mt__10">Vui l??ng kh??ng upload h??nh l???n h??n <b class="max-size-text"></b>.</div>

                                            <div class="upload_preview mt__10"></div>
                                        </div>
                                        <div class="mau_thiep co_san hidden">
                                            <select name="cate_card_template" onchange="jscartcsmt(this)" class="form-control">
                                                <?php if(count($templates)): ?>
                                                    <option value="">H??y ch???n ch??? ?????</option>
                                                    <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($ite->id); ?>"><?php echo e($ite->getTitle()); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="0">Kh??c</option>
                                                <?php endif; ?>
                                            </select>

                                            <select name="cate_card_id" onchange="jscartcsmtget(this)" class="form-control mt__10"></select>

                                            <div class="mau_thiep_temp mt__10"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt__15">
                                        <?php echo $__env->make('modals.payment_account', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-5 tr_md tc order-md-4 order-1 ">
                                <div class="row text-right">
                                    <div class="col-md-7 mb__10 text-right">
                                        <label class="frm-label">t???ng ti???n h??ng:</label>
                                    </div>
                                    <div class="col-md-5 mb__10 text-right">
                                        <strong class="text-black fs-18">
                                            <span class="number_format" id="cart_all"><?php echo e($priceAll); ?></span>
                                            <span class="currency_format">???</span>
                                        </strong>
                                    </div>
                                </div>
                                <div class="row hidden">
                                    <div class="col-md-6 mb__10"></div>
                                    <div class="col-md-6 mb__10" id="ele-coupon">
                                        <input class="text-center text-uppercase" type="text" name="coupon" onkeypress="pressNoSpace(event)" placeholder="nh???p m?? khuy???n m??i" />
                                    </div>
                                </div>
                                <div class="row text-right hidden ma_giam_gia">
                                    <div class="col-md-7 mb__10 text-right">
                                        <label class="frm-label">gi???m gi?? ?????c bi???t:</label>
                                    </div>
                                    <div class="col-md-5 mb__10 text-right">
                                        <strong class="text-black fs-18">
                                            <span class="number_format" id="cart_discount">0</span>
                                            <span class="currency_format">???</span>
                                        </strong>
                                    </div>
                                </div>
                                <div class="row text-right">
                                    <div class="col-md-7 mb__10 text-right">
                                        <label class="frm-label">ph?? giao h??ng:</label>
                                    </div>
                                    <div class="col-md-5 mb__10 text-right">
                                        <strong class="fs-18">
                                            <span class="number_format <?php if($freeShip): ?> line_through <?php endif; ?>" id="cart_shipping"><?php echo e($shippingFee); ?></span>
                                            <span class="currency_format">???</span>
                                        </strong>
                                    </div>
                                </div>
                                <div class="row text-right">
                                    <div class="col-md-7 mb__10 text-right">
                                        <label class="frm-label">t???ng thanh to??n:</label>
                                    </div>
                                    <div class="col-md-5 mb__10 text-right">
                                        <strong class="color-money fs-18">
                                            <span class="number_format text-bold" id="cart_total"><?php echo e($priceAll); ?></span>
                                            <span class="currency_format">???</span>
                                        </strong>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <p class="pr dib mb__5">
                                    <input required type="checkbox" class="mr__5 width_height_20" style="margin: 0; cursor: pointer;">
                                    <label for="cart_agree">
                                        <a class="text-site text-bold" href="<?php echo e($URLCart); ?>" target="_blank">
                                            T??i ???? ?????c v?? ?????ng ?? c??c ch??nh s??ch c???a c??ng ty.
                                        </a>
                                    </label>
                                </p>
                                <div class="clearfix"></div>
                                <button type="submit" name="checkout" class="btn_checkout button button_primary tu mt__10 mb__10">
                                    x??c nh???n ?????t h??ng
                                </button>
                                <div class="clearfix"></div>
                                <div class="row">
                                    <div class="col-md-4 mb__10"></div>
                                    <div class="col-md-8 mb__10">
                                        <textarea name="note" class="cart-note__input min_height_100px" placeholder="Ghi ch?? ????n h??ng..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="hidden">
                    <input type="hidden" name="ids" value="<?php echo e($ids); ?>" id="frm-ids" />
                    <input type="hidden" name="total_order" value="0" />

                    <input type="hidden" name="total_all" value="<?php echo e($priceAll); ?>" />
                    <input type="hidden" name="total_paid" value="<?php echo e($priceAll); ?>" />
                    <input type="hidden" name="total_paid_no_ship" value="<?php echo e($priceAll); ?>" />
                    <input type="hidden" name="payment_by" value="cod" />

                    <input type="hidden" name="percent_discount" value="0" />
                    <input type="hidden" name="total_discount" value="0" />


                    <input type="hidden" name="discount_gg" value="0" />

                    <input type="hidden" name="discount_km" value="0" />

                    <input type="hidden" name="over_cart" value="<?php echo e($overFee); ?>" />
                    <input type="hidden" name="ghn_fee" value="<?php echo e($shippingFee); ?>" />
                    <input type="hidden" name="free_city" value="<?php echo e($freeCity); ?>" />
                    <input type="hidden" name="express" value="" />

                    <input type="hidden" name="address_1" value="<?php echo e($viewer ? $viewer->address : ''); ?>" />
                    <input type="hidden" name="ward_id_1" value="<?php echo e($viewer ? $viewer->ward_id : ''); ?>" />
                    <input type="hidden" name="district_id_1" value="<?php echo e($viewer ? $viewer->district_id : ''); ?>" />
                    <input type="hidden" name="province_id_1" value="<?php echo e($viewer ? $viewer->province_id : ''); ?>" />
                    <input type="hidden" name="quan_huyen_1" value="<?php echo e($quanHuyen); ?>" />
                    <input type="hidden" name="phuong_xa_1" value="<?php echo e($phuongXa); ?>" />

                    <input type="hidden" name="address_2" />
                    <input type="hidden" name="ward_id_2" />
                    <input type="hidden" name="district_id_2" />
                    <input type="hidden" name="province_id_2" />
                    <input type="hidden" name="quan_huyen_2" />
                    <input type="hidden" name="phuong_xa_2" />
                </div>
            </form>
        <?php endif; ?>
    </div>

    <div class="mfp-wrap mfp-close-btn-in mfp-auto-cursor mfp-move-horizontal prpr_pp_wrapper mfp-ready overlay_bg_2 hidden" tabindex="-1" style="overflow: hidden auto;">
        <div class="mfp-container mfp-s-ready mfp-inline-holder">
            <div class="mfp-content">
                <div class="popup_gks">
                    <table class="table">
                        <thead>
                        <tr>
                            <td>
                                <div class="overflow-hidden text-uppercase text-bold"><?php echo e($apiCore->getSetting('text_dh_confirm_text_title')); ?></div>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="popup_gks_body"><?php echo nl2br($apiCore->getSetting('text_dh_confirm_text_body'))?></div>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td class="text-right">
                                <button class="button text-uppercase" onclick="jsbindpopupclose()">kh??ng</button>
                                <button class="button button_primary text-uppercase" onclick="jscartdhpopupok()">x??c nh???n</button>
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            jscartdhcal();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('templates.front_end.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/pages/front_end/users/cart.blade.php ENDPATH**/ ?>