<?php
$pageTitle = isset($page_title) ? $page_title : '';
$prolist = isset($pro_list) ? $pro_list : '';
$apiCore = new \App\Api\Core();
$viewer = $apiCore->getViewer();
$oldPhotos = '';
?>

@extends('templates.be.master')

@section('content')

    <div>
        <div class="fade-in">
            <form action="{{ url('/admin/page-footer/save') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>{{ $pageTitle }}</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12" id="req-title">
                                        <div class="form-group">
                                            <label class="required">* Tiêu Đề</label>
                                            <input required autofocus name="tile" type="text" autocomplete="off"
                                                   class="form-control" />
                                        </div>

                                        <div class="form-group alert alert-danger hidden">Hãy nhập tiêu đề.</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" id="req-status">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Trạng Thái</label>
                                            <div>
                                                <div class="align-center">
                                                    <select name="status" class="form-control" id="inputState">
                                                        <option value="0">ON</option>
                                                        <option value="1">OFF</option>
                                                    </select>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" id="req-mota">
                                        <div class="form-group">
                                            <label class="font-weight-bold required">* Nội Dung</label>
                                            <textarea id="editor" name="body" class="c-tinymce" rows="5"></textarea>
                                        </div>

                                        <div class="form-group alert alert-danger hidden">Hãy nhập nội dung.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm mb-1">
                                    <i class="fa fa-check-circle mr-1"></i>
                                    Xác Nhận
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script type="text/javascript" src="{{ url('public/js/back_end/news_add.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/{{$apiCore->getKey('tinymce')}}/tinymce/5/tinymce.min.js"></script>

    <script type="text/javascript">
        jQuery(document).ready(function () {
            //tinymce
            tinymce.init({
                selector: 'textarea.c-tinymce',
                plugins: 'code print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern help',
                toolbar: 'formatselect | bold italic strikethrough forecolor backcolor permanentpen | link image media | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent | removeformat | addcomment',
                image_advtab: true,
                height: 400,
                //local upload
                images_upload_handler: function (blobInfo, success, failure) {
                    var xhr, formData;

                    xhr = new XMLHttpRequest();
                    xhr.withCredentials = true;
                    xhr.open('POST', '{{url('admin/tinymce/upload')}}');

                    xhr.onload = function() {
                        var json;

                        if (xhr.status != 200) {
                            failure('HTTP Error: ' + xhr.status);
                            return;
                        }

                        json = JSON.parse(xhr.responseText);

                        if (!json || typeof json.location != 'string') {
                            failure('Invalid JSON: ' + xhr.responseText);
                            return;
                        }

                        success(json.location);
                    };

                    formData = new FormData();
                    formData.append('_token', '{{csrf_token()}}');
                    formData.append('file', blobInfo.blob(), blobInfo.filename());

                    xhr.send(formData);
                },
            });
        });

    </script>
@stop
{{-- @section('script')
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection --}}
