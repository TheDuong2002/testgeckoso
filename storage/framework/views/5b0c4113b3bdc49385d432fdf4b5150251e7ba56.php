<?php

$activePage = isset($active_page) ? $active_page : '';

$apiCore = new \App\Api\Core();

$viewer = $apiCore->getViewer();
?>



<?php $__env->startSection('content'); ?>

    <style type="text/css">
        .frm-search .form-group>div {
            float: left;
        }
    </style>
    <?php if(session('msg')): ?>
        <div class="alert alert-success" role="alert">
            <?php echo e(session('msg')); ?>

        </div>
    <?php endif; ?>
    <div class="alert alert-danger" style="text-align: center" role="alert">
        <p>Trong danh sách banner chỉ cho phép bật một trạng thái của một danh mục banner. Khi bạn bật trạng thái của tất cả, web sẽ tự động
            lấy danh mục banner đầu tiên</p>
    </div>
    <div>
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-menu">
                        <button class="btn btn-primary btn-sm mb-1" onclick="add_dm_banner()">
                            <i class="fa fa-plus-circle mr-1"></i>
                            Tạo danh mục banner
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <strong><?php echo e($pageTitle); ?></strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                <tr>
                                    <th>Tiêu đề</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="row-tr">
                                        <td><a href=""><?php echo e($item->date_add); ?></a></td>
                                        <td> <?php if($item->status == 0): ?>
                                                <a  href="<?php echo e(url('/admin/banner/update-satatus', $item->id)); ?>" class="btn btn-success">ON</a>
                                            <?php elseif($item->status == 1): ?>
                                                <a  href="<?php echo e(url('/admin/banner/update-satatus', $item->id)); ?>" class="btn btn-danger">OFF</a>
                                            <?php endif; ?></td>
                                        <td>
                                            <div class="align-right">
                                                <a href="<?php echo e(url('/admin/banner/detail', $item->id )); ?>" class="btn btn-info btn-sm mb-1"
                                                   title="chi tiết danh mục" data-original-title="Sửa"><i class="fa fa-edit"></i></a>
                                                <a href="<?php echo e(url('/admin/banner/delete', $item->id)); ?>"  class="btn btn-danger btn-sm mb-1"
                                                   title="Xóa" data-original-title="Xóa"> <i class="fa fa-trash"></i></a>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_banner_add"  class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">TẠO DANH MỤCH BANNER</h4>
                </div>
                <form action="<?php echo e(url('/admin/banners/save')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group" id="req-title">
                            <input required type="text" name="date_add" autocomplete="off" class="form-control" />
                            <div class="alert alert-danger hidden">Hãy nhập quyền truy cập.</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
                        <button type="submit" class="btn btn-primary">Xác Nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo e(url('public/js/back_end/banner.js')); ?>"></script>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            <?php if(!empty($message)): ?>
            <?php if($message == 'ITEM_ADDED'): ?>
            showMessage(gks.successADD);
            <?php elseif($message == 'ITEM_EDITED'): ?>
            showMessage(gks.successEDIT);
            <?php elseif($message == 'ITEM_DELETED'): ?>
            showMessage(gks.successDEL);
            <?php elseif($message == 'ITEM_UPDATED'): ?>
            showMessage(gks.successUPDATE);
            <?php endif; ?>
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('templates.be.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/pages/back_end/banner/index.blade.php ENDPATH**/ ?>