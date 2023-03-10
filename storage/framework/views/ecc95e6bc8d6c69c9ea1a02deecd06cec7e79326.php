<?php
$pageTitle = (isset($page_title)) ? $page_title : "";

$apiCore = new \App\Api\Core();
$viewer = $apiCore->getViewer();
?>



<?php $__env->startSection('content'); ?>

    <style type="text/css">
        .frm-search .form-group > div {
            float: left;
            margin-bottom: 20px;
        }
    </style>

    <div>
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-menu">
                        <button class="btn btn-primary  btn-sm mb-1" onclick="openPage('<?php echo e(url('admin/event/add')); ?>')" >
                            <i class="fa fa-plus-circle mr-1"></i>
                            Tạo Bài
                        </button>
                    </div>

                    <div class="frm-search">
                        <form action="<?php echo e(url('admin/events')); ?>" method="get" >
                            <div class="card">
                                <div class="card-header">
                                    <strong>Tìm Kiếm</strong>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <div class="btn-group">
                                                        <button id="btn-filter" type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="true" class="dropdown-toggle btn btn-info">
                                                            <?php if(count($params) && isset($params['filter'])): ?>
                                                                <?php if($params['filter'] == 'mo_ta'): ?>
                                                                    Mô Tả
                                                                <?php else: ?>
                                                                    Tiêu Đề
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                Tiêu Đề
                                                            <?php endif; ?>
                                                        </button>
                                                        <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu" x-placement="top-start" style="position: absolute; transform: translate3d(0px, -173px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                            <button onclick="filterBy('name')" type="button" tabindex="0" class="dropdown-item">Tiêu Đề</button>
                                                            <button onclick="filterBy('mo_ta')" type="button" tabindex="0" class="dropdown-item">Mô Tả</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="text" id="filter-keyword" name="keyword" placeholder="Từ Khóa" class="form-control" value="<?php echo e(count($params) && isset($params['keyword']) ? $params['keyword'] : ""); ?>" autocomplete="off" />
                                                <input type="hidden" id="filter-by" name="filter" value="<?php echo e(count($params) && isset($params['filter']) ? $params['filter'] : "name"); ?>" />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <select id="filter-active" name="active" class="form-control">
                                                <option value="">Tất Cả Trạng Thái</option>
                                                <option <?php if (count($params) && isset($params['active']) && (int)$params['active'] == 1):?>selected="selected"<?php endif;?> value="1">Cho Xem</option>
                                                <option <?php if (count($params) && isset($params['active']) && (int)$params['active'] == 2):?>selected="selected"<?php endif;?> value="2">Tắt Xem</option>
                                            </select>
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
                                        <th>tiêu đề</th>
                                        <th>lượt xem</th>
                                        <th>nổi bật</th>
                                        <th>trạng thái</th>
                                        <th></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php foreach($items as $item):

                                    ?>
                                    <tr id="item-<?php echo e($item->id); ?>">
                                        <td class="text-capitalize"><?php echo $item->toHTML(['avatar' => true, 'fe' => true]);?></td>

                                        <td><?php echo e($item->view_count); ?></td>

                                        <td>
                                            <?php if($item->featured): ?>
                                                <img class="cursor-pointer" src="<?php echo e(url('public/images/icons/ic_tick_red.png')); ?>"
                                                     onclick="itemFeatured(<?php echo e($item->id); ?>, 0)"
                                                />
                                            <?php else: ?>
                                                <img class="cursor-pointer" src="<?php echo e(url('public/images/icons/ic_tick_dark.png')); ?>"
                                                     onclick="itemFeatured(<?php echo e($item->id); ?>, 1)"
                                                />
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <select class="form-control" onchange="updateStatus(this, 'active')" data-id="<?php echo e($item->id); ?>">
                                                <option <?php if ($item->active):?>selected="selected"<?php endif;?> value="1">Cho Xem</option>
                                                <option <?php if (!$item->active):?>selected="selected"<?php endif;?> value="0">Tắt Xem</option>
                                            </select>
                                        </td>

                                        <td>
                                            <div class="align-right">
                                                <button class="btn btn-info btn-sm mb-1"
                                                        title="Sửa" data-original-title="Sửa"
                                                        onclick="openPage('<?php echo e(url('admin/event/add?id=' . $item->id)); ?>')"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm mb-1"
                                                        title="Xóa" data-original-title="Xóa"
                                                        onclick="deleteItem(<?php echo e($item->id); ?>)"
                                                >
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="gks_pagination">
                            <?php echo e($items->appends(request()->query())->links()); ?>

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

    <script type="text/javascript" src="<?php echo e(url('public/js/back_end/events.js')); ?>"></script>

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

<?php echo $__env->make('templates.be.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\geckosotest\resources\views/pages/back_end/events/index.blade.php ENDPATH**/ ?>