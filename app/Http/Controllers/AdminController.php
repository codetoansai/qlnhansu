<?php

namespace App\Http\Controllers;

use App\Group;
use App\GroupEmp;
use App\Http\Requests\RoomRequest;
use App\Room;
//use Faker\Provider\ka_GE\DateTime;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use File;
use App\Employes;
use DB;
use Input;

class AdminController extends Controller
{


//--------------------get list room

    public function getListRoom(){

        $data=Room::select('id','name','description','status')->where('status',1)->get()->toArray();

        return view('admin.pages.phongban',compact('data'));
    }

//--------------------add room

    public function postAddRoom(Request $req){
        $validator = Validator::make($req->all(), [
            'name'=>'required|unique:phong,name',
            'description'=>'required',
            'status'=>'required'
        ],[
            'name.required'=>'Tên phòng không được để trống',
            'name.unique'=>'Tên không được để trùng',
            'description.required'=>'Mô tả không được để trống',
            'status.required'=>'Trạng thái không được để trống'
        ]);
        if ($validator->passes()) {
            $name=$req->name;
            $status=$req->status;
            $description=$req->description;
            $room=new Room();
            $room->name=$name;
            $room->description=$description;
            $room->status=$status;
            $room->created_by=Auth::user()->id;
           if($room->save()){
               return response()->json([
                   'item'=>$room,
                   'status'=>200,
                   'success'=>'Thêm thành công'
               ]);
           }
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    //---------------------------del room

    public function getDelRoom($id){
        $room=Room::findOrFail($id);

        DB::table('nhom')
            ->join('phong', 'phong.id', '=', 'nhom.id_phong')
            ->where('phong.id',$id)
            ->delete();

        DB::table('nhanvien')
            ->join('phong', 'phong.id', '=', 'nhanvien.id_room')
            ->where('phong.id',$id)
            ->update(['id_room'=>0]);

       if($room->delete()){
           return response()->json([
               'success'=>'Xóa thành công',
               'status'=>200
           ]);
       }
    }

    // -----------------------get data edit room

    public function getEditRoom($id){
        $room=Room::findOrFail($id);
        return response()->json([
            'item'=>$room,
            'success'=>'thành công'
        ]);
    }

    // -----------------post data edit room

    public function postEditRoom($id,Request $req){
        $validator = Validator::make($req->all(), [
            'name'=>'required',
            'description'=>'required',
            'status'=>'required'
        ],[
            'name.required'=>'Tên phòng không được để trống',
            'description.required'=>'Mô tả không được để trống',
            'status.required'=>'Trạng thái không được để trống'
        ]);
        if ($validator->passes()) {
            $name=$req->name;
            $status=$req->status;
            $description=$req->description;
            $room=Room::findOrFail($id);
            $room->name=$name;
            $room->description=$description;
            $room->status=$status;
            $room->created_by=Auth::user()->id;
            if($room->update()){
                return response()->json([
                    'item'=>$room,
                    'status'=>200,
                    'success'=>'Sửa thành công'
                ]);
            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    //---------------------get detail room
    public function getDeltail($id){
      $data=Room::findOrFail($id);
        return response()->json(['success'=>'thanh cong','item'=>$data]);
    }


//-------------------------get list group

    public function getListGroup(){

         $data=Group::select('id','name','status','description')->where('status',1)->get()->toArray();
         $data_room=Room::select('id','name')->where('status',1)->get()->toArray();
         return view('admin.pages.nhomnhanvien',compact('data','data_room'));
    }

//------------------------------add group

public function postAddGroup(Request $req){
    $validator = Validator::make($req->all(), [
        'txtname'=>'unique:nhom,name',
        'txtdes'=>'required',
        'txtphong'=>'required',
        'txtstatus'=>'required'
    ],[
        'txtname.required'=>'Tên nhóm không được để trống',
        'txtname.unique'=>'Tên nhóm không được để trùng',
        'txtdes.required'=>'Mô tả không được để trống',
        'txtphong.required'=>'Phòng không được để trống',
        'txtstatus.required'=>'Trạng thái không được để trống'
    ]);
    if ($validator->passes()) {
        $name=$req->txtname;
        $status=$req->txtstatus;
        $description=$req->txtdes;
        $id_p=$req->txtphong;
        $group=new Group();
        $group->name=$name;
        $group->description=$description;
        $group->id_phong=$id_p;
        $group->status=$status;
        $group->created_by=Auth::user()->id;
        if($group->save()){
            return response()->json([
                'item'=>$group,
                'status'=>200,
                'success'=>'Thêm nhóm thành công'
            ]);
        }

    }
    return response()->json(['error'=>$validator->errors()->all()]);
}

//-----------------delete group

public function getDelGroup($id){
    $group=Group::findOrFail($id);
    $data = DB::table('nhom_nhanvien')
        ->join('nhom', 'nhom.id', '=', 'nhom_nhanvien.id_nhom')
        ->select('nhom_nhanvien.id')
        ->where('nhom.id',$id)
        ->delete();
    if($group->delete()){
        return response()->json([
            'success'=>'Xóa thành công',
            'status'=>200
        ]);
    }
}

//------------------get data edit group

public function getEditGroup($id){
    $group=Group::find($id);
    $room=Room::select('id','name')->get();
    return response()->json([
        'item'=>$group,
        'item_room'=>$room,
        'success'=>'thành công'
    ]);

}
//----------------post data edit group

    public function postEditGroup($id,Request $req){
        $validator = Validator::make($req->all(), [
            'txtname'=>'required',
            'txtdes'=>'required',
            'txtstatus'=>'required',
            'txtphong'=>'required',
        ],[
            'txtname.required'=>'Tên nhóm không được để trống',
            'txtdes.required'=>'Mô tả không được để trống',
            'txtstatus.required'=>'Trạng thái không được để trống',
             'txtphong.required'=>'Phòng không được để trống',
        ]);

        if ($validator->passes()) {
            $name=$req->txtname;
            $status=$req->txtstatus;
            $description=$req->txtdes;
            $id_p=$req->txtphong;
            $group=Group::findOrFail($id);
            $group->name=$name;
            $group->description=$description;
            $group->status=$status;
            $group->id_phong=$id_p;
            $group->created_by=Auth::user()->id;
            if($group->update()){
                return response()->json([
                    'item'=>$group,
                    'status'=>200,
                    'success'=>'Sửa thành công'
                ]);
            }

        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

//---------------------get detail group

public function getDetailGroup($id){
    $data = DB::table('nhom')
        ->join('phong', 'phong.id', '=', 'nhom.id_phong')
        ->select('nhom.*', 'phong.name as ph')
        ->where('nhom.id',$id)
        ->get();
    return response()->json(['success'=>'thanh cong','item'=>$data]);
}


//-------------------get list employ

    public function getListNv(){
        $data_group=Group::select('id','name')->get()->toArray();
        $data_room=Room::select('id','name')->get()->toArray();
        $data=Employes::select('id','name','position','phone','image')->where('status',1)->get()->toArray();
        return view('admin.pages.nhanvien',compact('data_room','data','data_group'));
    }

//-------------------add employ

    public function postAddNv(Request $req){

        $validator = Validator::make($req->all(), [
            'txtname'=>'required',
            'txtphong'=>'required',
            'txtnhom'=>'required',
            'txtcv'=>'required',
            'txtluong'=>'required|integer',
            'txtemail'=>'required|email|unique:nhanvien,email',
            'txtdc'=>'required',
//            'txtimage'=>'image|mimes:jpg,png',
            'txtsdt'=>'required|integer',
            'txtstatus'=>'required'
        ],[
            'txtname.required'=>'Tên nhóm không được để trống',
            'txtphong.required'=>'Tên phòng không được để trống',
            'txtnhom.required'=>'Tên nhóm không được để trống',
            'txtcv.required'=>'Chức vụ không được để trống',
            'txtluong.required'=>'Lương không được để trống',
            'txtluong.integer'=>'Lương phải là số',
            'txtemail.required'=>'Email không được để trống',
            'txtemail.email'=>'Email không đúng định dạng',
            'txtemail.unique'=>'Email không được trùng',
            'txtdc.required'=>'Địa chỉ không được để trống',
            'txtsdt.required'=>'Số điện thoại không được để trống',
            'txtsdt.integer'=>'Số điện thoại phải là số',
//            'txtimage.required'=>'Image không được để trống',
//             'txtimage.image'=>'Image không đúng định dạng',
//             'txtimage.mimes'=>'Image phải có định dạng jpg hoặc png',
            'txtstatus.required'=>'Trạng thái không được để trống'
        ]);
        if ($validator->passes()) {

            $nv=new Employes();

            $file=$req->file('txtimage');

            $nv->name=$req->txtname;
            $nv->id_room=$req->txtphong;
//            $nv->id_group=$req->txtnhom;
            $nv->position=$req->txtcv;
            $nv->salary=$req->txtluong;
            $nv->email=$req->txtemail;
            $nv->phone=$req->txtsdt;
            $nv->address=$req->txtdc;
            $nv->status=$req->txtstatus;
            $nv->created_by=Auth::user()->id;
           
            if(strlen($file)>0){
            $filename=time().'.'.$file->getClientOriginalExtension();
            $path="uploads/admin/nhanvien/";
            $file->move($path,$filename);
              $nv->image=$filename;
             }
             else{
                 $nv->image="default.png";
             }
            $nv->save();
            $id=$nv->id;
            $arr=$req->txtnhom;
            foreach ($arr as $value){
                $GE=new GroupEmp();
                $GE->id_nhom=$value;
                $GE->id_nhanvien=$id;
                $GE->created_by=Auth::user()->id;
                $GE->save();
            }

            return response()->json([
                    'item'=>$nv,
                    'status'=>200,
                    'success'=>'Thêm nhân viên thành công'
                ]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

// ------------------Delete emp
    public function getDelNv($id){

      $emp=Employes::findOrFail($id);
      $data = DB::table('nhom_nhanvien')
            ->join('nhanvien', 'nhanvien.id', '=', 'nhom_nhanvien.id_nhanvien')
            ->select('nhom_nhanvien.id')
            ->where('nhanvien.id',$id)
            ->delete();
        if($emp->delete()){
            return response()->json([
                'success'=>'Xóa thành công',
                'status'=>200,
                'item'=>$data
            ]);
        }
    }

// -------------------Get data edit emp

public function getEditNv($id){

    $emp=Employes::findOrFail($id);
    $data_room=Room::select('id','name')->get();

//    $data_group=DB::table('nhom')
//        ->join('phong', 'phong.id', '=', 'nhom.id_phong')
//        ->join('nhanvien', 'nhanvien.id_room', '=', 'phong.id')
//        ->select('nhom.id as id','nhom.name as name')
//        ->where('nhanvien.id',$id)
//        ->get();

    $data_group_id = DB::table('nhom_nhanvien')
        ->join('nhom', 'nhom.id', '=', 'nhom_nhanvien.id_nhom')
        ->join('nhanvien', 'nhanvien.id', '=', 'nhom_nhanvien.id_nhanvien')
        ->select('nhom.id as id','nhom.name as name')
        ->where('nhanvien.id',$id)
        ->get();
    return response()->json([
        'item'=>$emp,
        'item_room'=>$data_room,
//        'item_group'=>$data_group,
        'item_group_id'=>$data_group_id,
        'success'=>'thành công'
    ]);

}

//-------------------POST data edit emp

public function postEditNv($id,Request $req){

        $validator = Validator::make($req->all(), [
            'txtname'=>'required',
            'txtphong'=>'required',
//            'txtnhom'=>'required',
            'txtcv'=>'required',
            'txtluong'=>'required|integer',
            'txtemail'=>'required|email',
            'txtdc'=>'required',
            // 'txtimage'=>'required',
//            'txtimage'=>'image|mimes:jpg,png',
            'txtsdt'=>'required',
            'txtstatus'=>'required'
        ],[
            'txtname.required'=>'Tên  không được để trống',
            'txtphong.required'=>'Tên phòng không được để trống',
//            'txtnhom.required'=>'Tên nhóm không được để trống',
            'txtcv.required'=>'Chức vụ không được để trống',
            'txtluong.required'=>'Lương không được để trống',
            'txtluong.integer'=>'Lương phải là số',
            'txtemail.required'=>'Email không được để trống',
            'txtemail.email'=>'Email không đúng định dạng',
            // 'txtemail.unique'=>'Email không được trùng',
            'txtdc.required'=>'Địa chỉ không được để trống',
            'txtsdt.required'=>'Số điện thoại không được để trống',
            // 'txtimage.required'=>'Image không được để trống',
            // 'txtimage.image'=>'Image không đúng định dạng',
//            'txtimage.image'=>'Image không đúng định dạng',
//            'txtimage.mimes'=>'Image phải có định dạng jpg hoặc png',
            'txtstatus.required'=>'Trạng thái không được để trống'
        ]);
        if ($validator->passes()) {

            $nv= Employes::findOrFail($id);

            $file=$req->file('txtimage');

            $nv->name=$req->txtname;
            $nv->id_room=$req->txtphong;
//            $nv->id_group=$req->txtnhom;
            $nv->position=$req->txtcv;
            $nv->salary=$req->txtluong;
            $nv->email=$req->txtemail;
            $nv->phone=$req->txtsdt;
            $nv->address=$req->txtdc;
            $nv->status=$req->txtstatus;
            $nv->created_by=Auth::user()->id;
           
            if(strlen($file)>0){
                $filename=time().'.'.$file->getClientOriginalExtension();
                $path="uploads/admin/nhanvien/";
                $file->move($path,$filename);
                  $nv->image=$filename;
             }
             else{
                 $nv->image=$req->txtimagecurrent;
             }
            $nv->update();
            $id=$nv->id;
            $arr=$req->txtnhom;
            foreach ($arr as $value){
                DB::table('nhom_nhanvien')
                    ->join('nhanvien', 'nhanvien.id', '=', 'nhom_nhanvien.id_nhanvien')
                    ->where('nhanvien.id',$id)
                    ->update(['id_nhom'=>$value]);

            }

            return response()->json([
                'item'=>$nv,
                'status'=>200,
                'success'=>'Sửa nhân viên thành công'
            ]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);

 }



public function getChangeSlt($id){

    $group = DB::table('nhom')
        ->join('phong', 'phong.id', '=', 'nhom.id_phong')
        ->select('nhom.id', 'nhom.name')
        ->where('phong.id','=',$id)
        ->get()->all();
    return response()->json([
        'status'=>200,
        'item'=>$group,
        'success'=>"thành công"
    ]);
}

//----------------tìm kiếm nhân viên

public function getDataSearch($name=" "){

    if($name==" "){
        $data=Employes::all();
    }
    else{
        $data=Employes::where('name','like','%'.$name.'%')
            ->orWhere('position','like','%'.$name.'%')
            ->orWhere('phone','like','%'.$name.'%')->get();
    }
           return response()->json([
               'status'=>200,
               'item'=>$data,
               'success'=>"thành công"
           ]);

}

public function getDataSort($sx){
    if($sx==1){
      $data=Employes::orderBy('name','ASC')->get();
        return response()->json([
            'success'=>'Thành công',
            'item'=>$data
        ]);
    }
    else if($sx==2){
        $data=Employes::orderBy('created_at','DESC')->get();
        return response()->json([
            'success'=>'Thành công',
            'item'=>$data
        ]);
    }
    else{
        return response()->json([
           'error'=>'Lỗi',
        ]);
    }
}

}
