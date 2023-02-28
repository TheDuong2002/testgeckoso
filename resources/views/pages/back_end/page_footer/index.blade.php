<?php

$activePage = isset($active_page) ? $active_page : '';

$apiCore = new \App\Api\Core();

$viewer = $apiCore->getViewer();
?>

@extends('templates.be.master')

@section('content')

    <style type="text/css">
        .frm-search .form-group>div {
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
                        <a class="btn btn-primary btn-sm mb-1" href="{{ url('/admin/page-footer/add') }}">  <i class="fa fa-plus-circle mr-1"></i>
                            Tạo chính sách</a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <strong>{{ $pageTitle }}</strong>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                <tr>
                                    <th>Tile</th>
                                    <th>Trạng thái</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $item )
                                    <tr class="row-tr">
                                        <td><a href="{{ url('/p_footer_infor',$item->href ) }}">{{ $item->tile }}</a></td>
                                        <td> @if ($item->status == 0)
                                                <a href="{{ url('/admin/page-footer/update-satatus', $item->id) }}" class="btn btn-success">ON</a>
                                            @elseif ($item->status == 1)
                                                <a href="{{ url('/admin/page-footer/update-satatus', $item->id) }}" class="btn btn-danger">OFF</a>
                                            @endif</td>
                                        <td>
                                            <div class="align-right">
                                                <a href="{{ url('/admin/page-footer/edit', $item->id) }}" class="btn btn-info btn-sm mb-1"
                                                   title="Sửa" data-original-title="Sửa"><i class="fa fa-edit"></i></a>
                                                <a href="{{ url('/admin/page-footer/delete', $item->id) }}"  class="btn btn-danger btn-sm mb-1"
                                                   title="Xóa" data-original-title="Xóa"> <i class="fa fa-trash"></i></a>
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


    <script type="text/javascript" src="{{ url('public/js/back_end/clients.js') }}"></script>

    <script type="text/javascript">
        jQuery(document).ready(function() {
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

