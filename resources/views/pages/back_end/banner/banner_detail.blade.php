<?php

$activePage = isset($active_page) ? $active_page : '';

$apiCore = new \App\Api\Core();

$viewer = $apiCore->getViewer();
?>

@extends('templates.be.master')

@section('content')

    <style type="text/css">
        .frm-search .form-group > div {
            float: left;
        }
    </style>
    @if (session('msg'))
        <div class="alert alert-success" role="alert">
            {{ session('msg') }}
        </div>
    @endif

    <div>
        <div class="fade-in">
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-menu">
                        <button class="btn btn-primary btn-sm mb-1" onclick="add_attr_banner()">
                            <i class="fa fa-plus-circle mr-1"></i>
                            Tạo thuộc tính banner
                        </button>
                        <button class="btn btn-primary btn-sm mb-1" onclick="openPage('{{url('/admin/banners')}}')" >
                            <i class="fa fa-list mr-1"></i>
                            Danh sách
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ $Tile.":  ".$parent_baner->date_add }}</strong>
                        </div>

                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                <tr>
                                    <th> desktop</th>

                                    <th> mobile</th>
                                    <th>link</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $item )
                                    <tr class="row-tr">
                                        <td><img src="{{url('public/uploaded/banner/'.$item->img_banner_mt)}}" width="100" alt=""></td>
                                        <td><img src="{{url('public/uploaded/banner/'.$item->img_banner_dt)}}" width="100" alt=""></td>
                                        <td> <a href="">{{isset($item->link) ? $item->link : ''}}</a></td>
                                        <td>
                                            <div class="align-right">
                                                <a onclick="view_attr_banner({{$item->chi_id}})" href=""
                                                   class="btn btn-info btn-sm mb-1"
                                                   title="Sửa" data-original-title="Sửa"><i class="fa fa-edit"></i></a>
                                                <a href="{{ url('/admin/banners/attribute/delete', $item->chi_id) }}"
                                                   class="btn btn-danger btn-sm mb-1"
                                                   title="Xóa" data-original-title="Xóa"> <i
                                                        class="fa fa-trash"></i></a>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_banner_add_attr" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">TẠO THUỘC TÍNH BANNER</h4>
                </div>
                <form action="{{url('/admin/banners/attribute/save',$parent_baner->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                         <div class="form-group"  >
                             <input type="hidden" value="{{$parent_baner->id}}" name="parent_id">
                             <input style="text-align: center"  type="text" name="parent_id" disabled value="{{$parent_baner->date_add}}" class="form-control"/>
                         </div>
                        <div class="form-group" id="req-title">
                            <label class="text-label required">*Banner desktop</label>
                            <input required type="file" name="img_banner_mt" autocomplete="off" class="form-control"/>
                            <div class="alert alert-danger hidden">Hãy nhập quyền truy cập.</div>
                        </div>
                        <div class="form-group" id="req-title">
                            <label class="text-label required">*Banner mobile</label>
                            <input required type="file" name="img_banner_dt" autocomplete="off" class="form-control"/>
                            <div class="alert alert-danger hidden">Hãy nhập quyền truy cập.</div>
                        </div>
                        <div class="form-group" id="req-title">
                            <label class="text-label required">*Link</label>
                            <input required type="text" name="link" autocomplete="off" class="form-control"/>
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
    <div id="modal_banner_up_attr" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">SỬA THUỘC TÍNH BANNER</h4>
                </div>
                <form action="{{url('/admin/banners/attribute/save_update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="body_banner_attr">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Không</button>
                        <button type="submit" class="btn btn-primary">Xác Nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ url('public/js/back_end/banner.js') }}"></script>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            @if (!empty($message))
            @if ($message == 'ITEM_ADDED')
            showMessage(gks.successADD);
            @elseif ($message == 'ITEM_EDITED')
            showMessage(gks.successEDIT);
            @elseif ($message == 'ITEM_DELETED')
            showMessage(gks.successDEL);
            @elseif ($message == 'ITEM_UPDATED')
            showMessage(gks.successUPDATE);
            @endif
            @endif
        });
    </script>
@stop

