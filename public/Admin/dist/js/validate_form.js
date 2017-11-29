//------------------Add room
$('#addroom').validate({
    rules : {
        name : {
            required : true,
        },
        description : {
            required : true,
        },
        status:{
            required : true,
        }
    },
    messages : {
        name : {
            required : "Tên không được để trống",
        },
        description : {
            required : "Mô tả không được để trống",
        },
        status:{
            required :"Trạng thái không được để trống"
        }
    },
    submitHandler : function (form) {
        addRoom();
        // updateRoom();
        // console.log("123");
    }
});


// -------------update room

$('#updateroom').validate({
    rules : {
        name : {
            required : true,
        },
        description : {
            required : true,
        },
        status:{
            required : true,
        }
    },
    messages : {
        name : {
            required : "Tên không được để trống",
        },
        description : {
            required : "Mô tả không được để trống",
        },
        status:{
            required :"Trạng thái không được để trống"
        }
    },
    submitHandler : function (form) {
        updateRoom();
    }
});

//------------------Add group


$('#addgroup').validate({
    rules : {
        txtname : {
            required : true,
        },
        txtdes : {
            required : true,
        },
        txtphong:{
            required : true,
        },
        txtstatus:{
            required : true,
        }
    },
    messages : {
        txtname : {
            required : "Tên không được để trống",
        },
        txtdes : {
            required : "Mô tả không được để trống",
        },
        txtphong:{
            required :"Tên phòng không được để trống"
        },
        txtstatus:{
            required :"Trạng thái không được để trống"
        }
    },
    submitHandler : function (form) {
        addGroup();
        // console.log("123");
    }
});

// ---------------------Update Group

$('#form-updategroup').validate({
    rules : {
        txtname : {
            required : true,
        },
        txtdes : {
            required : true,
        },
        txtphong:{
            required : true,
        },
        txtstatus:{
            required : true,
        }
    },
    messages : {
        txtname : {
            required : "Tên không được để trống",
        },
        txtdes : {
            required : "Mô tả không được để trống",
        },
        txtphong:{
            required :"Tên phòng không được để trống"
        },
        txtstatus:{
            required :"Trạng thái không được để trống"
        }
    },
    submitHandler : function (form) {
        updateGroup();
        // console.log("123");
    }
});


//----------------------Add emp


$('#formaddnv').validate({
    rules : {
        txtname : {
            required : true,
        },
        "txtnhom[]" : {
            required : true,
        },
        txtphong:{
            required : true,
        },
        txtcv:{
            required : true,
        },
        txtluong:{
            required : true,
            number:true,
        },
        txtemail:{
            required : true,
            email:true,
        },
        txtsdt:{
            required : true,
            number:true,
        },
        txtdc:{
            required : true,
        },
        // txtimage:{
        //     accept: "image/jpeg, image/pjpeg"
        // },
        txtstatus:{
            required : true,
        }
    },
    messages : {
        txtname : {
            required : "Tên không được để trống",
        },
        "txtnhom[]" : {
            required : "Tên nhóm không được để trống",

        },
        txtphong:{
            required :"Tên phòng không được để trống"
        },
        txtcv:{
            required :"Chức vụ không được để trống"
        },
        txtluong:{
            required :"Lương không được để trống",
            number:"Lương phải là số"
        },
        txtemail:{
            required :"Email không được để trống",
            email:"Email không đúng định dạng"
        },
        txtsdt:{
            required :"Số điện thoại không được để trống",
            number :"Số điện thoại phải là số",
        },
        txtdc:{
            required :"Địa chỉ không được để trống"
        },
        // txtimage:{
        //     accept: "image/jpeg, image/pjpeg"
        // },
        txtstatus:{
            required :"Trạng thái không được để trống"
        }
    },
    submitHandler : function (form) {
        addEmp();
    }
});
// --------------------Update emp

$('#formeditemp').validate({
    rules : {
        txtname : {
            required : true,
        },
        "txtnhom[]" : {
            required : true,
        },
        txtphong:{
            required : true,
        },
        txtcv:{
            required : true,
        },
        txtluong:{
            required : true,
            number:true,
        },
        txtemail:{
            required : true,
            email:true,
        },
        txtsdt:{
            required : true,
            number:true,
        },
        txtdc:{
            required : true,
        },
        // txtimage:{
        //     extension: "jpg|png"
        // },
        txtstatus:{
            required : true,
        }
    },
    messages : {
        txtname : {
            required : "Tên không được để trống",
        },
        "txtnhom[]" : {
            required : "Tên nhóm không được để trống",

        },
        txtphong:{
            required :"Tên phòng không được để trống"
        },
        txtcv:{
            required :"Chức vụ không được để trống"
        },
        txtluong:{
            required :"Lương không được để trống",
            number:"Lương phải là số"
        },
        txtemail:{
            required :"Email không được để trống",
            email:"Email không đúng định dạng"
        },
        txtsdt:{
            required :"Số điện thoại không được để trống",
            number :"Số điện thoại phải là số",
        },
        txtdc:{
            required :"Địa chỉ không được để trống"
        },
        // txtimage:{
        //     extension :"Định dạng ảnh phải là jpg,png"
        // },
        txtstatus:{
            required :"Trạng thái không được để trống"
        }
    },
    submitHandler : function (form) {
        updateEmp();
    }
});



