<?php

use App\Api\Core;

$pageTitle = (isset($page_title)) ? $page_title : "";

$apiCore = new Core();
$viewer = $apiCore->getViewer();
?>

@extends('templates.be.master')

@section('content')

    <div>
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-menu">
                        <button class="btn btn-primary btn-sm mb-1" onclick="addItem()">
                            <i class="fa fa-plus-circle mr-1"></i>
                            Tạo Nhóm Khách Hàng
                        </button>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <strong>{{$pageTitle}}</strong>
                            <div class="c-header-right font-weight-bold">
                                <span>Tổng Cộng: <?= count($data) ?> </span>
                                <span class="number_format"></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                <tr>
                                    <th>tên nhóm</th>

                                    <th>Chức năng</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data as $row):
                                    $subs = $row->getUserSubCategories(); ?>
                                <tr class="row-tr" data-id="{{$row->id}}">
                                    <td class="row-parent">
                                        @if (count($subs))
                                            <div class="frm-parent">
                                                <a href="javascript:void(0)" onclick="toggleItem({{$row->id}}, 0)">
                                                    + {{$row->title}}
                                                </a>
                                            </div>
                                        @else
                                            + {{$row->title}}
                                        @endif
                                    </td>
                                    <td class="align-right">
                                        <button class="btn btn-primary btn-sm mb-1"
                                                title="Tạo Nhóm Con" data-original-title="Tạo Nhóm Con"
                                                onclick="add_sub_user_cate({{$row->id}})"
                                        >
                                            <i class="fa fa-plus-circle"></i>
                                        </button>
                                        <button class="btn btn-info btn-sm mb-1 update-user-cate"
                                                title="Sửa" data-original-title="Sửa"
                                                data-title="{{$row->title}}" data-id="{{$row->id}}"
                                        >
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm mb-1"
                                                title="Xóa" data-original-title="Xóa"
                                                data-id="{{$row->id}}"
                                                onclick="user_cate_delete({{$row->id}})"
                                        >
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @if ($subs && count($subs))
                                        <?php foreach ($subs as $sub):
                                        $childs = $sub->getUserSubCategories();
                                        ?>
                                    <tr class="row-tr sub-{{$row->id}}" data-id="{{$sub->id}}">
                                        <td class="row-parent">
                                            @if (count($childs))
                                                <div class="frm-parent" style="padding-left: 50px;">
                                                    <a href="javascript:void(0)"
                                                       onclick="toggleItem({{$row->id}}, {{$sub->id}})">
                                                        ++ {{$sub->title}}
                                                    </a>
                                                </div>
                                            @else
                                                <div style="padding-left: 50px;">++ {{$sub->title}}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="align-right">
                                                <button class="btn btn-info btn-sm mb-1 update-sub-user-cate"
                                                        title="Sửa" data-original-title="Sửa"
                                                        data-title="{{$sub->title}}" data-id="{{$sub->id}}"
                                                >
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm mb-1"
                                                        title="Xóa" data-original-title="Xóa"
                                                        onclick="delete_sub_item({{$sub->id}})"
                                                >
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php endforeach; ?>
                                @endif

                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{--modal--}}
    <div id="modal_user_cate_add" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">TẠO NHÓM KHÁCH HÀNG</h4>
                </div>
                <form action="{{url('/admin/user/category/save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group" id="req-title">
                            <input required type="text" name="title" class="form-control"/>
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
    {{--model delete user cate--}}
    <div id="model_user_cate_delete" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">XÁC NHẬN</h4>
                </div>
                <form onsubmit="return handleDeleteItem();" id="frm_user_cate_delete">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="item_id" id="id_delete" class="href_delete">
                        <p>Bạn có chắc chắn muốn xóa nhóm khách hàng này không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
                        <button type="submit" class="btn btn-primary">Xác Nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{--model add sub user cate--}}
    <div id="model_user_cate_add_sub" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">TẠO NHÓM CON</h4>
                </div>
                <form onsubmit="event.preventDefault(); return  user_cate_add_sub();" id="frm_user_cate_add_sub">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_item" id="id_item" class="id_item">
                        <div class="form-group" id="req-title">
                            <input required autofocus type="text" name="title" autocomplete="off" class="form-control"/>
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
{{--   model update sub user cate    --}}
    <div id="model_user_cate_update" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">CẬP NHẬT NHÓM KHÁCH HÀNG</h4>
                </div>
                <form onsubmit="event.preventDefault(); return  user_cate_update();" id="frm_user_cate_add_sub">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_item" id="id_item" class="id_item">
                        <div class="form-group" id="req-title">
                            <input required id="edit_user_cate_title"  type="text" name="title" autocomplete="off" class="form-control"/>
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
{{--model popup delete sub use cater--}}
    <div id="model_user_cate_sub_delete" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">XÁC NHẬN </h4>
                </div>
                <form onsubmit="return handle_delete_sub_item();" id="form_user_cate_sub_delete">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_item" id="id_delete" class="href_delete">
                        <p>Bạn có chắc chắn muốn xóa nhóm con này không?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
                        <button type="submit" class="btn btn-primary">Xác Nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="model_sub_user_cate_update" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">CẬP NHẬT NHÓM CON</h4>
                </div>
                <form onsubmit="event.preventDefault(); return  sub_user_cate_update();" id="frm_user_cate_update_sub">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_item" id="id_item" class="id_item">
                        <div class="form-group" id="req-title">
                            <input required id="edit_sub_user_cate_title"  type="text" name="title" autocomplete="off" class="form-control"/>
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
    <script type="text/javascript" src="{{url('public/js/back_end/user_categoris.js')}}"></script>

@stop
