@extends('admin.master')
@section('title','Quản lí nhóm')
@section('label','Quản lí nhóm')
@section('content')
    <section id="content">
        <div class="container">
            <table class="table table-bordered table-hover">
                <caption><h2>Danh sách nhóm:</h2></caption>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_addgroup">Thêm nhóm</button>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Tên nhóm</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody id="listgroup">
                
                @foreach($data as $value)
                    <tr id="{{$value['id']}}">
                        <td>{{$value['id']}}</td>
                        <td>{{$value['name']}}</td>
                        <td>{{$value['description']}}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-detailgroup" data-toggle="modal" data-target="#Modal_detailgroup" value="{{$value['id']}}">Chi tiết</button>
                            <button type="button" class="btn btn-primary btn-updategroup" data-toggle="modal" data-target="#Modal_update_group"  value="{{$value['id']}}">Sửa</button>
                            <button type="button" class="btn btn-danger btn-delgroup" value="{{$value['id']}}">Xóa</button>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div> 
    </section>

    <!-- modal thêm nhóm -->
    <div class="modal fade" id="Modal_addgroup" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thêm nhóm</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <form method="post" action="" id="addgroup">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="">Tên nhóm</label>
                            <input type="text" class="form-control" name="txtname">
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <textarea class="form-control" name="txtdes" placeholder="mô tả"></textarea>
                        </div>
                         <div class="form-group">
                            <label for="">Phòng</label>
                            <select name="txtphong" class="form-control">
                                <option value="">--chọn--</option>
                                @foreach($data_room as $value)
                                 <option value="{{$value['id']}}">{{$value['name']}}</option>
                                @endforeach()
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select name="txtstatus" class="form-control">
                                <option value="">--chọn--</option>
                                <option value="1">Hoạt động</option>
                                <option value="0">Không hoạt động</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-addgroup">Thêm nhóm</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal update -->

    <div class="modal fade" id="Modal_update_group" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sửa nhóm</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <form method="post" action="" id="form-updategroup">
                        {{csrf_field()}}
                        <input type="hidden" class="form-control" name="txtid"  id="txtid">
                        <div class="form-group">
                            <label for="">Tên nhóm</label>
                            <input type="text" class="form-control" name="txtname"  id="txtname">
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <textarea class="form-control" name="txtdes" id="txtdes" placeholder="mô tả"></textarea>
                        </div>
                          <div class="form-group">
                            <label for="">Phòng</label>
                            <select name="txtphong" id="txtphong" class="form-control">
                                {{--<option value="">--chọn--</option>--}}
                                {{--@foreach($data_room as $value)--}}
                                 {{--<option value="{{$value['id']}}">{{$value['name']}}</option>--}}
                                {{--@endforeach()--}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div id="txtstatuss"></div>
                        </div>
                        <button type="submit" class="btn btn-success btnupdategroup">Sửa nhóm</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{--modal detail--}}
    <div class="modal fade" id="Modal_detailgroup" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Chi tiết nhóm</h4>
                </div>
                <div class="modal-body">
                    <table border="0">
                        <tr>
                            <td><h4>ID:</h4></td>
                            <td><h4 id="txt_idd"></h4></td>
                        </tr>
                        <tr>
                            <td><h4>Tên Nhóm:</h4></td>
                            <td><h4 id="txtnamee"></h4></td>
                        </tr>
                        <tr>
                            <td><h4>Phòng:</h4></td>
                            <td><h4 id="txtphongg"></h4></td>
                        </tr>
                        <tr>
                            <td><h4>Mô tả:</h4></td>
                            <td><h4 id="txtmota"></h4></td>
                        </tr>
                        <tr>
                            <td><h4>Trạng thái:</h4></td>
                            <td>
                                <h4 id="txttt"></h4>
                            </td>
                        </tr>
                        <tr>
                            <td><h4>Người tạo:</h4></td>
                            <td><h4>{{Auth::user()->name}}</h4></td>
                        </tr>
                        <tr>
                            <td><h4>Ngày tạo:</h4></td>
                            <td><h4 id="txtcreat"></h4></td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endsection