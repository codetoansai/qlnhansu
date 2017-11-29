@extends('admin.master')
@section('title','Quản lí nhân viên')
@section('label','Quản lí nhân viên')
@section('content')

    <section id="content">
        <div class="container">
          <div class="pull-right" style="margin-right: 100px">
              <form class="form-inline" method="post" action="" id="formsearch">
                  {{csrf_field()}}
                  <div class="form-group">
                         <label for="">Tìm kiếm:</label>
                         <input type="text" id="txt_search" class="form-control" /><button type="submit" class="btn-search" style="border: transparent;background-color:#000;color:#fff;width: 40px;height:34px;border-radius: 0 5px 5px 0; position: relative; top:2px"><span class="glyphicon glyphicon-search"></span></button>
                  </div>
                  <div class="form-group">
                      <label for="pwd">Sắp xếp:</label>
                      <select name="txtsx" id="txtsx" class="form-control" >
                          <option>--chọn--</option>
                          <option value="2">--Thời gian--</option>
                          <option value="1">--Theo tên--</option>
                      </select>
                  </div>
              </form>
          </div>
            <table class="table table-bordered table-hover">
                <caption><h2>Danh sách nhân viên:</h2></caption>
                <button type="button" class="btn btn-primary btn-add-nv" data-toggle="modal" data-target="#Modal_addNv">Thêm nhân viên</button><br />

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Chức vụ</th>
                    <th>Sdt</th>
                    <th>Ảnh</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody id="listemploy">
                @foreach ($data as $value)
                <tr id="{{$value['id']}}"> 
                    <td>{{$value['id']}}</td>
                    <td>{{$value['name']}}</td>
                    <td>{{$value['position']}}</td>
                    <td>{{$value['phone']}}</td>

                        <td>@if($value['image']!=null)<img src="/uploads/admin/nhanvien/{{$value['image']}}" width="100px"> @endif</td>

                    <td>
                        <button type="button" class="btn btn-primary btn-updateNv" data-toggle="modal" data-target="#Modal_updateNv" value="{{$value['id']}}">Sửa</button>
                        <button type="button" class="btn btn-danger btn-del-emp" value="{{$value['id']}}">Xóa</button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- modal thêm nhân viên -->

    <div class="modal fade" id="Modal_addNv" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Thêm nhân viên</h4>
                </div> 
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <form method="post" action="" id="formaddnv" enctype="multipart/form-data" class="smart-form" role="form">
                       {{csrf_field()}}
                        <div class="form-group">
                            <label for="">Tên</label>
                            <input type="text" class="form-control" name="txtname">
                        </div>
                        <div class="form-group">
                            <label for="">Phòng</label>
                            <select name="txtphong" id="txtphong" class="form-control" >
                                <option value="">--chọn--</option>
                                @foreach($data_room as $value)
                                    <option value="{{$value['id']}}">{{$value['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Nhóm</label>
                            <select name="txtnhom[]" class="form-control" id="txtnhom" multiple>
                                <option value="">--chọn--</option>
                                {{--@foreach($data_group as $value)--}}
                                    {{--<option value="{{$value['id']}}">{{$value['name']}}</option>--}}
                                {{--@endforeach--}}
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Chức vụ</label>
                            <input type="text" class="form-control" name="txtcv">
                        </div>
                        <div class="form-group">
                            <label for="">Lương</label>
                            <input type="text" class="form-control" name="txtluong">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="txtemail">
                        </div>
                        <div class="form-group">
                            <label for="">Sdt</label>
                            <input type="text" class="form-control" name="txtsdt">
                        </div>
                        <div class="form-group">
                            <label for="">Địa chỉ</label>
                            <input type="text" class="form-control" name="txtdc">
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="txtimage" id="txtimage" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>            
                            <select name="txtstatus" class="form-control">
                                <option value="">--Chọn--</option>
                                <option value="1">Đang làm việc</option>
                                <option value="0">Đã nghỉ</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-addnv">Thêm nhân viên</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal update -->

    <div class="modal fade" id="Modal_updateNv" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sửa nhân viên</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>
                    <form method="post" id="formeditemp" enctype="multipart/form-data">
                         {{csrf_field()}}
                          <input type="hidden" class="form-control" name="txtid"  id="txtid">
                        <div class="form-group">
                            <label for="">Tên</label>
                            <input type="text" class="form-control" name="txtname" id="txtname">
                        </div>

                        <div class="form-group">
                            <label for="">Phòng</label>
                             <select name="txtphong" id="txtroom" class="form-control">
                                {{--<option value="">--chọn--</option>--}}
                               {{--@foreach($data_room as $value)--}}
                                    {{--<option value="{{$value['id']}}">{{$value['name']}}</option>--}}
                                {{--@endforeach--}}
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Nhóm</label>
                            <select name="txtnhom[]" id="txtgroup" class="form-control" multiple>
                                {{--<option value="">--chọn--</option>--}}
                                {{--@foreach($data_group as $value)--}}
                                    {{--<option value="{{$value['id']}}">{{$value['name']}}</option>--}}
                                {{--@endforeach--}}
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="">Chức vụ</label>
                            <input type="text" class="form-control" name="txtcv" id="txtcv">
                        </div>
                        <div class="form-group">
                            <label for="">Lương</label>
                            <input type="text" class="form-control" name="txtluong" id="txtluong">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" class="form-control" name="txtemail" id="txtemail">
                        </div>
                        <div class="form-group">
                            <label for="">Sdt</label>
                            <input type="text" class="form-control" name="txtsdt" id="txtsdt">
                        </div>
                        <div class="form-group">
                            <label for="">Địa chỉ</label>
                            <input type="text" class="form-control" name="txtdc" id="txtdc">
                        </div>
                         <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="txtimage" id="txtimage" accept="image/*">
                        </div>
                         <div class="form-group">
                            <input type="hidden" class="form-control" name="txtimagecurrent" id="txtimagecurrent">
                        </div>
                         <div class="form-group">
                            <img src="" alt="img" id="img">
                        </div>
                        <div class="form-group">
                            <label for="">Status</label>
                             <div id="txtstatuss"></div>
                        </div>
                        <button type="submit" class="btn btn-success btn-editNv">Sửa nhân viên</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @endsection