<?php
$pageTitle = (isset($page_title)) ? $page_title : "";

$apiCore = new \App\Api\Core();
$viewer = $apiCore->getViewer();


?>



<?php $__env->startSection('content'); ?>

    <style type="text/css">
        #slides-preview .img-preview {
            position: relative;
            width: 100px;
            height: 120px;
        }

        #slides-preview .img-preview img {
            width: 100px;
            height: 120px;
        }

        #slides-preview .img-preview .fa {
            position: absolute;
            right: 5px;
            top: 5px;
            font-size: 20px;
            background-color: #fff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            text-align: center;
            cursor: pointer;
            border: 1px solid;
        }
    </style>

    <div>
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-menu">
                        <?php if($viewer->isAllowed('card_template_add')): ?>
                        <button class="btn btn-primary btn-sm mb-1" onclick="addItem()">
                            <i class="fa fa-plus-circle mr-1"></i>
                            Tạo Mẫu Thiệp
                        </button>
                        <?php endif; ?>
                    </div>

                    <div class="clearfix mb-4 mt-4">
                        <span class="alert alert-warning">Mẫu thiệp được ACTIVE sẽ được hiển thị ngoài trang chính.</span>
                    </div>

                    <div class="frm-search">
                        <form action="<?php echo e(url('admin/cards')); ?>" method="get" >
                            <div class="card">
                                <div class="card-header">
                                    <strong>Tìm Kiếm</strong>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <div class="btn-group">
                                                        <button id="btn-filter" type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="true" class=" btn btn-info">
                                                            Tên Mẫu Thiệp
                                                        </button>
                                                    </div>
                                                </div>
                                                <input type="text" id="filter-keyword" name="keyword" placeholder="Từ Khóa" class="form-control" value="<?php echo e(count($params) && isset($params['keyword']) ? $params['keyword'] : ""); ?>" autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm mb-1">
                                        <i class="fa fa-search fs-14 mr-1"></i>
                                        Tìm
                                    </button>

                                    <input type="hidden" id="search-order" name="order" value="<?php echo e(count($params) && isset($params['order']) ? $params['order'] : ""); ?>" />
                                    <input type="hidden" id="search-order-by" name="order-by" value="<?php echo e(count($params) && isset($params['order-by']) ? $params['order-by'] : ""); ?>" />
                                </div>
                            </div>
                        </form>
                    </div>

                    <?php if(count($items)): ?>
                        <div class="card-filter margin-bot-20">
                            <div class="float-right">
                                <div class="float-left margin-right-5">
                                    <select onchange="frmOrder(this)" class="form-control">
                                        <option <?php if (count($params) && isset($params['order']) && $params['order'] == 'newest'):?>selected="selected"<?php endif;?> value="newest">Mới Nhất</option>
                                        <option <?php if (count($params) && isset($params['order']) && $params['order'] == 'alphabet'):?>selected="selected"<?php endif;?> value="alphabet">Alphabet</option>
                                        <option <?php if (count($params) && isset($params['order']) && $params['order'] == 'view_count'):?>selected="selected"<?php endif;?> value="view_count">Lượt Xem</option>
                                    </select>
                                </div>

                                <div class="float-left">
                                    <select onchange="frmOrderBy(this)" class="form-control">
                                        <option <?php if (count($params) && isset($params['order-by']) && $params['order-by'] == 'desc'):?>selected="selected"<?php endif;?> value="desc">Giảm Dần</option>
                                        <option <?php if (count($params) && isset($params['order-by']) && $params['order-by'] == 'asc'):?>selected="selected"<?php endif;?> value="asc">Tăng Dần</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <strong><?php echo e($pageTitle); ?></strong>

                                <div class="c-header-right font-weight-bold">
                                    <span>Tổng Cộng: </span>
                                    <span class="number_format"><?php echo e($items->total()); ?></span>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-responsive-sm table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 50%;">tên mẫu thiệp</th>
                                        <th>trạng thái</th>
                                        <th>nhóm chủ đề</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php foreach($items as $item):

                                        $URLs = '';
                                        if (count($item->getSlides())) {
                                            foreach ($item->getSlides() as $photo) {
                                                $URLs .= $photo->id . '__' . $photo->getPhoto() . ';;';
                                            }
                                        }
                                    ?>
                                    <tr class="row-tr" data-id="<?php echo e($item->id); ?>">
                                        <td class="row-parent" id="row-name-<?php echo e($item->id); ?>"
                                            data-name="<?php echo e($item->title); ?>"
                                            data-category="<?php echo e($item->system_category_id); ?>"
                                            data-url="<?php echo e($URLs); ?>"
                                        >
                                            <?php echo e($item->title); ?>

                                        </td>

                                        <td>
                                            <?php if($item->active): ?>
                                                <?php if($viewer->isAllowed('card_template_edit')): ?>
                                                    <a class="badge badge-success text-uppercase" onclick="updateStatus(<?php echo e($item->id); ?>, 'active', 0)" href="javascript:void(0)">
                                                        <i class="fa fa-check text-white mr-1"></i> active
                                                    </a>
                                                <?php else: ?>
                                                    <div class="badge badge-success text-uppercase">
                                                        <i class="fa fa-check text-white mr-1"></i> active
                                                    </div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if($viewer->isAllowed('card_template_edit')): ?>
                                                    <a class="badge badge-secondary text-uppercase text-black-50" onclick="updateStatus(<?php echo e($item->id); ?>, 'active', 1)" href="javascript:void(0)">
                                                        <i class="fa fa-check text-black-50 mr-1"></i> inactive
                                                    </a>
                                                <?php else: ?>
                                                    <div class="badge badge-secondary text-uppercase text-black-50">
                                                        <i class="fa fa-check text-black-50 mr-1"></i> inactive
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if($viewer->isAllowed('card_template_edit')): ?>
                                                <select class="form-control" onchange="updateStatus(<?php echo e($item->id); ?>, 'category', this)">
                                                    <option <?php if(!$item->system_category_id): ?> selected="selected" <?php endif; ?> value="0">Khác</option>
                                                    <?php if(count($categories)): ?>
                                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option <?php if($item->system_category_id == $ite->id): ?> selected="selected" <?php endif; ?> value="<?php echo e($ite->id); ?>"><?php echo e($ite->getTitle()); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            <?php else: ?>
                                                <div><?php echo e($item->getCategory() ? $item->getCategory()->getTitle() : 'Khác'); ?></div>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <div class="align-right">
                                                <?php if($viewer->isAllowed('card_template_edit')): ?>
                                                <button class="btn btn-info btn-sm mb-1"
                                                        title="Sửa" data-original-title="Sửa"
                                                        onclick="editItem(<?php echo e($item->id); ?>)"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <?php endif; ?>

                                                <?php if($viewer->isAllowed('card_template_delete')): ?>
                                                <button class="btn btn-danger btn-sm mb-1"
                                                        title="Xóa" data-original-title="Xóa"
                                                        onclick="deleteItem(<?php echo e($item->id); ?>)"
                                                >
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="clearfix mb-4 mt-4">
                            <span class="alert alert-info notfound"></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    
    <div id="modal_item_update"  class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                </div>
                <form action="<?php echo e(url('admin/card/save')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="frm-label">Nhóm Chủ Đề</label>
                            <select name="system_category_id" class="form-control">
                                <option value="0">Khác</option>
                                <?php if(count($categories)): ?>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($ite->id); ?>"><?php echo e($ite->getTitle()); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group" id="req-title">
                            <label class="frm-label required">* Tên Mẫu Thiệp</label>
                            <input required name="title" type="text" autocomplete="off" class="form-control" />
                            <div class="alert alert-danger hidden"></div>
                        </div>

                        <div class="form-group" id="req-slides">
                            <label class="frm-label required">* Ảnh Mẫu Thiệp</label>
                            <div>
                                <input name="slides[]" id="upload-slides" type="file" accept="image/*" multiple="multiple" />

                                <div class="alert alert-danger hidden mt-3">Vui lòng không upload hình lớn hơn <b class="max-size-text"></b>.</div>
                            </div>
                            <div class="form-group overflow-hidden clearfix" id="slides-preview" style="margin-top: 10px;">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
                        <button type="submit" class="btn btn-primary">Xác Nhận</button>

                        <input type="hidden" name="item_id" />
                        <input type="hidden" name="old_photos" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo e(url('public/js/back_end/cards.js')); ?>"></script>

    <script type="text/javascript">
        jQuery(document).ready(function () {
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

<?php echo $__env->make('templates.be.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/pages/back_end/cards/index.blade.php ENDPATH**/ ?>