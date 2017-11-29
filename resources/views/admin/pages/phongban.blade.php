@extends('admin.master')
@section('title','Quản lí phòng ban')
@section('label','Quản lí phòng ban')
@section('content')
    <section id="content">
        <div class="container">
            <table class="table table-bordered table-hover">
                <caption><h2>Danh sách phòng:</h2></caption>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal_add">Thêm phòng</button>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody id="room-list">
                   @foreach($data as $value)
                 <tr id="{{$value['id']}}">
                    <td>{{$value['id']}}</td>
                    <td>{{$value['name']}}</td>
                    <td>{{$value['description']}}</td>
                    <td>
                        <button type="button" class="btn btn-success btn-detailroom" data-toggle="modal" data-target="#Modal_detailroom" value="{{$value['id']}}">Chi tiết</button>
                        <button type="button" class="btn btn-primary btn-updateroom" data-toggle="modal" data-target="#Modal_update"  value="{{$value['id']}}">Sửa</button>
                        <button type="button" class="btn btn-danger btn-delroom" value="{{$value['id']}}">Xóa</button>
                    </td>
                </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- modal thêm phòng -->
    <div class="modal fade" id="Modal_add" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thêm phòng ban</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <form method="post" action="" id="addroom" role="form">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="">Tên phòng</label>
                            <input type="text" class="form-control" name="name" placeholder="Tên phòng">
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <textarea class="form-control" name="description" placeholder="mô tả"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <select name="status" class="form-control">
                                <option value="">--Chon--</option>
                                <option value="1">Hoạt động</option>
                                <option value="0">Không hoạt động</option>
                            </select>

                        </div>
                        <button type="submit" class="btn btn-success btn-addroom">Thêm phòng</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal update -->
    <div class="modal fade" id="Modal_updateroom" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sửa phòng ban</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <form method="post" action="" id="updateroom" role="form">
                        {{csrf_field()}}
                        <input type="hidden" class="form-control" id="txtid" name="txtid">
                        <div class="form-group">
                            <label for="">Tên phòng</label>
                            <input type="text" class="form-control" id="txtname" name="name" placeholder="tên phòng">
                        </div>
                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <textarea class="form-control" name="description" id="txtdes" placeholder="mô tả">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <div id="txtstatuss" name="status"></div>
                           <!--  <select name="txtstatus" id="txtstatus" class="form-control">
                            </select> -->
                        </div>
                        <button type="submit" class="btn btn-success btn-editroom">Sửa phòng</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
{{--modal detail--}}
    <div class="modal fade" id="Modal_detailroom" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Chi tiết phòng</h4>
                </div>
                <div class="modal-body">
                    <table border="0">
                        <tr>
                            <td><h4>ID:</h4></td>
                            <td><h4 id="txtidd"></h4></td>
                        </tr>
                        <tr>
                            <td><h4>Tên phòng:</h4></td>
                            <td><h4 id="txtnamee"></h4></td>
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