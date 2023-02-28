<?php
$apiCore = new \App\Api\Core;
$viewer = $apiCore->getViewer();

$apiMobile = new \App\Api\Mobile;
$isMobile = $apiMobile->isMobile() ? 1 : 0;

$maxSize = $apiCore->getMaxSize();
$maxSizeText = $apiCore->getMaxSizeText();

$pageTitle = (isset($page_title)) ? $page_title : $apiCore->getSetting('site_title');

?>

<meta charset="utf-8">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta name="generator" content="Geckoso">
<meta name="description" content="<?php echo e($pageTitle); ?>">
<meta name="author" content="Geckoso">
<meta name="keyword" content="<?php echo e($pageTitle); ?>">
<title><?php echo e($pageTitle); ?></title>

<link rel="shortcut icon" href="<?php echo e(url('public/images/logo/favicon.ico')); ?>" type="image/x-icon" />
<link rel="apple-touch-icon" href="<?php echo e(url('public/images/logo/apple-touch-icon.png')); ?>" />
<link rel="apple-touch-icon" sizes="57x57" href="<?php echo e(url('public/images/logo/apple-touch-icon-57x57.png')); ?>" />
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo e(url('public/images/logo/apple-touch-icon-72x72.png')); ?>" />
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo e(url('public/images/logo/apple-touch-icon-76x76.png')); ?>" />
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo e(url('public/images/logo/apple-touch-icon-114x114.png')); ?>" />
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(url('public/images/logo/apple-touch-icon-120x120.png')); ?>" />
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo e(url('public/images/logo/apple-touch-icon-144x144.png')); ?>" />
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo e(url('public/images/logo/apple-touch-icon-152x152.png')); ?>" />
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(url('public/images/logo/apple-touch-icon-180x180.png')); ?>" />

<link href="<?php echo e(url('public/themes/be/css/coreui/vendors/flag-icon-css/css/flag-icon.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(url('public/themes/be/css/coreui/vendors/css/style.css')); ?>" rel="stylesheet">
<link href="<?php echo e(url('public/themes/be/css/coreui/vendors/pace-progress/css/pace.min.css')); ?>" rel="stylesheet">

<link href="<?php echo e(url('public/libraries/select2/select2.min.css')); ?>" rel="stylesheet">

<link href="<?php echo e(url('public/libraries/font-awesome/css/all.css')); ?>" rel="stylesheet">

<link href="<?php echo e(url('public/css/app.css')); ?>" rel="stylesheet" />

<link href="<?php echo e(url('public/css/be/custom.css')); ?>" rel="stylesheet" />


<script src="<?php echo e(url('public/themes/be/js/jquery.min.js')); ?>" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.js"></script>

<script type="text/javascript">
    var gks = {
        baseURL: '<?php echo e(url('')); ?>',
        loading: 'Đang xử lý...',
        loadingUPLOADPHOTO: '<?php echo e(url('public/images/loading_img.jpg')); ?>',
        successADD: 'Đã thêm thành công!',
        successEDIT: 'Đã sửa thành công!',
        successDEL: 'Đã xóa thành công!',
        successUPDATE: 'Đã cập nhật thành công!',
        successCHANGE: 'Đã cập nhật thành công!',
        saveERR: "Không thể kết nối. Vui lòng thử lại sau.",
        notFound: "Không tìm thấy dữ liệu phù hợp.",
        deleteConfirm: "Bạn có chắc muốn xóa không?",
        loadingIMG: '<div class="js_loading"><img src="<?php echo e(url('public/images/loading.gif')); ?>"></div>',
        maxSize: '<?php echo e($maxSize); ?>',
        maxSizeText: '<?php echo e($maxSizeText); ?>',
        tempTK: '<?php echo e(csrf_token()); ?>',
        importExcelOnly: "Vui lòng chỉ import excel file.",
        isMobile: '<?php echo e($isMobile); ?>',
        user: '<?php echo e($viewer && $viewer->id ? $viewer->id : 0); ?>',
        timeOutFocus: 888,
    };
</script>

<?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/templates/be/layouts/head.blade.php ENDPATH**/ ?>