<?php
$apiCore = new \App\Api\Core();
$siteTitle = $apiCore->getSetting('site_title');
$siteLogo = $apiCore->getSetting('site_logo');
$viewer = $apiCore->getViewer();
?>

<style type="text/css">
    ul.c-sidebar-nav i {
        font-size: 12px;
        margin-right: 5px;
        text-align: center;
        width: 15px;
    }

    .parent_title {
        color: #fff !important;
    }
</style>

<div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
    <div class="c-sidebar-brand">
        <a href="<?php echo e(url('')); ?>">
            <img class="c-sidebar-brand-full" src="<?php echo e($siteLogo); ?>"
                 width="45" height="45" alt="<?php echo e($siteTitle); ?>"/>
            <img class="c-sidebar-brand-minimized" src="<?php echo e($siteLogo); ?>"
                 width="45" height="45" alt="<?php echo e($siteTitle); ?>"/>
        </a>
    </div>

    <ul class="c-sidebar-nav" data-drodpown-accordion="true">
        <?php if($viewer->isAllowed('staff_user_view')
            || $viewer->isAllowed("staff_level_view")
        ): ?>
            <li class="c-sidebar-nav-title parent_title">
                <i class="fa fa-user"></i>
                Nhân Sự
            </li>
        <?php endif; ?>

        <?php if($viewer->isAllowed('staff_level_view')): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/levels')); ?>">
                    <i class="fa fa-user-lock"></i>
                    Quyền Truy Cập
                </a>
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed('user_supplier_view')): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/suppliers')); ?>">
                    <i class="fa fa-warehouse"></i>
                    Nhà Cung Cấp
                </a>
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("staff_user_view")): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/staffs')); ?>">
                    <i class="fa fa-list"></i>
                    Danh Sách
                </a>
            </li>
        <?php endif; ?>


        <?php if($viewer->isAllowed("product_category_view")
            || $viewer->isAllowed("product_brand_view")
            || $viewer->isAllowed("product_view")
            || $viewer->isAllowed("product_dgcg_view")
            || $viewer->isSupplier()
        ): ?>
            <li class="c-sidebar-nav-title parent_title">
                <i class="fa fa-boxes"></i>
                Sản Phẩm
            </li>
        <?php endif; ?>

        <?php if($viewer->isAllowed("product_category_view")): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/product-categories')); ?>">
                    <i class="fa fa-box"></i>
                    Nhóm Sản Phẩm
                </a>
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("product_brand_view") || $viewer->isSupplier()): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/product-brands')); ?>">
                    <i class="fa fa-project-diagram"></i>
                    Thương Hiệu
                </a>
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("product_view") || $viewer->isSupplier()): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/products')); ?>">
                    <i class="fa fa-list"></i>
                    Danh Sách
                </a>
            </li>
        <?php endif; ?>

        <?php if($viewer->isAllowed("system_category_view")
            || $viewer->isAllowed("wish_view")
            || $viewer->isAllowed("card_template_view")
        ): ?>
            <li class="c-sidebar-nav-title parent_title">
                <i class="fa fa-list"></i>
                template
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("system_category_view")): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/system-categories')); ?>">
                    <i class="fa fa-object-group"></i>
                    Nhóm Chủ Đề
                </a>
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("wish_view")): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/wishes')); ?>">
                    <i class="fa fa-address-card"></i>
                    Câu Chúc
                </a>
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("card_template_view")): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/cards')); ?>">
                    <i class="fa fa-credit-card"></i>
                    Mẫu Thiệp
                </a>
            </li>
        <?php endif; ?>

        <?php if($viewer->isAllowed("order_view")
            || $viewer->isAllowed("order_config")
            || $viewer->isSupplier()
        ): ?>
            <li class="c-sidebar-nav-title parent_title">
                <i class="fa fa-cart-plus"></i>
                Đơn Hàng
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("order_view") || $viewer->isSupplier()): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/orders')); ?>">
                    <i class="fa fa-list"></i>
                    Danh Sách
                </a>
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("order_config")): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/order-settings')); ?>">
                    <i class="fa fa-cogs"></i>
                    Tùy Chỉnh
                </a>
            </li>
        <?php endif; ?>

        <?php if($viewer->isAllowed("client_view")): ?>
            <li class="c-sidebar-nav-title parent_title">
                <i class="fa fa-users"></i>
                Khách Hàng
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("client_view")): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/clients')); ?>">
                    <i class="fa fa-list"></i>
                    Danh Sách
                </a>
            </li>
        <?php endif; ?>
            <?php if($viewer->isAllowed("client_view")): ?>
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link" href="<?php echo e(url('/admin/user/category/list')); ?>">
                        <i class="fa fa-list"></i>
                       Nhóm khách hàng
                    </a>
                </li>
            <?php endif; ?>
        <?php if($viewer->isAllowed("setting_home")
            || $viewer->isAllowed("setting_config")
            || $viewer->isAllowed("setting_about")
            || $viewer->isAllowed("setting_policy")
            || $viewer->isAllowed("setting_tu_van")
            || $viewer->isAllowed("setting_tin_tuc")
            || $viewer->isAllowed("setting_contact")
        ): ?>
            <li class="c-sidebar-nav-title parent_title">
                <i class="fa fa-cog"></i>
                Quản Lý Chung
            </li>
        <?php endif; ?>

        <?php if($viewer->isAllowed("setting_home")): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/config')); ?>">
                    <i class="fa fa-home"></i>
                    trang chủ
                </a>
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("setting_config")): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/settings')); ?>">
                    <i class="fa fa-cogs"></i>
                    Tùy Chỉnh
                </a>
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("setting_about")): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/setting?s=about_us')); ?>">
                    <i class="fa fa-info"></i>
                    Giới Thiệu
                </a>
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("setting_policy")): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('/admin/banners')); ?>">
                    <i class="fa fa-list-ol"></i>
                    Banner
                </a>
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("setting_policy")): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('/admin/page-footer')); ?>">
                    <i class="fa fa-list-ol"></i>
                    Các chính Sách
                </a>
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("setting_tu_van")): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/events')); ?>">
                    <i class="fa fa-info"></i>
                    Góc Tư Vấn
                </a>
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("setting_tin_tuc")): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/news')); ?>">
                    <i class="fa fa-info"></i>
                    Tin Tức
                </a>
            </li>
        <?php endif; ?>
        <?php if($viewer->isAllowed("setting_contact")): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/contacts')); ?>">
                    <i class="fa fa-file-contract"></i>
                    Liên Hệ
                </a>
            </li>
        <?php endif; ?>

        <?php if($viewer->isSuperAdmin()): ?>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="<?php echo e(url('admin/texts')); ?>">
                    <i class="fa fa-file-word"></i>
                    Text Chữ
                </a>
            </li>
        <?php endif; ?>
    </ul>

    <button class="c-sidebar-minimizer c-class-toggler hidden" type="button" data-target="_parent"
            data-class="c-sidebar-unfoldable"></button>
</div>
<?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/templates/be/layouts/sidebar.blade.php ENDPATH**/ ?>