$(document).ready(function() {
    $(".login").delay(4000).slideUp();
    // $(".print-error-msg").delay(4000).slideUp();
});


//------------------Add room----------------
   function addRoom() {
       // $(".btn-addroom").click(function(e) {
       //     e.preventDefault();
           var addForm = $("#addroom");
           var formData = addForm.serialize();
           $.ajax({
               url: '/ql_admin/phong/them',
               type: 'POST',
               data: formData,
               dataType: 'json',
               success: function(data) {
                   // console.log(data);
                   $("#addroom").trigger('reset');
                   if (data.error) {
                       printErrorMsg(data.error);
                   }
                   if (data.success) {
                       // console.log(data.item);
                       alert(data.success);
                       $('#Modal_add').modal('hide');
                       if(data.item.status==1){

                           var tr = $("<tr/>",{
                               id:data.item.id
                           });
                           tr.append($("<td />", {
                               text: data.item.id
                           })).append($("<td />", {
                               text: data.item.name
                           })).append($("<td />", {
                               text: data.item.description
                           })).append($("<td />", {
                               html:'<button type="button" class="btn btn-success btn-detailroom" data-toggle="modal" data-target="#Modal_detailroom" value="'+data.item.id+'">Chi tiết</button>'+" "+'<button type="button" class="btn btn-primary btn-updateroom" data-toggle="modal" data-target="#Modal_update" value="'+data.item.id+'">Sửa </button>'+" "+'<button type="button" class="btn btn-danger btn-delroom" value="'+data.item.id+'">Xóa</button>'
                           }))
                           $("#room-list").append(tr);
                       }
                   }
               },
           });

       // });
   }


    // -------------- Delete room-----------------

    $("body").delegate(".btn-delroom","click",function(e) {
        e.preventDefault();
        if (confirm("Bạn có muốn xóa không ?")) {
            var idroom = $(this).val();
            $.ajax({
                url: '/ql_admin/phong/xoa/' + idroom,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    if (data.error) {
                        alert(data.error)
                    }
                    if (data.success) {
                        alert(data.success);
                        $("tr#"+idroom).remove();
                    }
                },
            });
        }
        return false;

    });

    //--------------- GET data Update room-----------------

    $("body").delegate(".btn-updateroom","click",function(e) {
        e.preventDefault();
        var idroom = $(this).val();
        $("#Modal_updateroom").modal("show");
        $.ajax({
            url: '/ql_admin/phong/sua/' + idroom,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data.error) {
                    alert(data.error)
                }
                if (data.success) {
                    // console.log(data.item);
                    $("#txtname").val(data.item.name);
                    $("#txtdes").val(data.item.description);
                    $("#txtid").val(idroom);
                    if (data.item.status == 1) {
                        $("#txtstatuss").replaceWith(
                            '<select name="status" id="txtstatus" class="form-control"><option value="1" selected >Hoạt động</option>\n' +
                            '<option value="0">Không hoạt động</option></select>'
                        );
                    }
                }
            },
        });
    });

    //-------------POST update room
function updateRoom() {
    // $("body").delegate(".btn-editroom","click",function(e) {
    //     e.preventDefault();
        var idroom = $("#txtid").val();
        var updateForm = $("#updateroom");
        var formData = updateForm.serialize();
        $.ajax({
            url: '/ql_admin/phong/sua/' + idroom,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                if (data.error) {
                    printErrorMsg(data.error);
                }
                if (data.success) {
                    // console.log(data.item);
                    alert(data.success);
                    $('#Modal_updateroom').modal('hide');
                    if(data.item.status==1){

                        var tr = $("<tr/>",{
                            id:data.item.id
                        });
                        tr.append($("<td />", {
                            text: data.item.id
                        })).append($("<td />", {
                            text: data.item.name
                        })).append($("<td />", {
                            text: data.item.description
                        })).append($("<td />", {
                            html:'<button type="button" class="btn btn-success btn-detailroom" data-toggle="modal" data-target="#Modal_detailroom" value="'+data.item.id+'">Chi tiết</button>'+" "+'<button type="button" class="btn btn-primary btn-updateroom" data-toggle="modal" data-target="#Modal_update" value="'+data.item.id+'">Sửa </button>'+" "+'<button type="button" class="btn btn-danger btn-delroom" value="'+data.item.id+'">Xóa</button>'
                        }))
                        $("#room-list tr#"+data.item.id).replaceWith(tr);
                    }
                    else{
                        $("tr#"+idroom).remove();
                    }

                }
            },
        });

    // });
}

    //------------------get detail room

    $("body").delegate(".btn-detailroom","click",function (e) {
        e.preventDefault();
        var idroom = $(this).val();
        // alert(idroom);
        $.ajax({
            url: '/ql_admin/phong/chitiet/' + idroom,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                if (data.success) {
                    // console.log(data.item);
                    $("#txtidd").html(data.item.id);
                    $("#txtnamee").html(data.item.name);
                    $("#txtmota").html(data.item.description);
                    if(data.item.status==1){
                        $("#txttt").html("Hoạt động");
                    }
                    else{
                        $("#txttt").html("Không hoạt động");
                    }
                    $("#txtcreat").html(data.item.created_at);
                }
            },
        });
    });


    // --------------------add group employees

 function addGroup() {
     // $(".btn-addgroup").click(function(e) {
     //     e.preventDefault();
         var addForm = $("#addgroup");
         var formData = addForm.serialize();
         $.ajax({
             url: '/ql_admin/nhom/them',
             type: 'POST',
             data: formData,
             dataType: 'json',
             success: function(data) {
                 // console.log(data);
                 $("#addgroup").trigger('reset');
                 if (data.error) {
                     printErrorMsg(data.error);
                 }
                 if (data.success) {
                     // console.log(data.item);
                     alert(data.success);
                     $('#Modal_addgroup').modal('hide');
                     if(data.item.status==1){

                         var tr = $("<tr/>",{
                             id:data.item.id
                         });
                         tr.append($("<td />", {
                             text: data.item.id
                         })).append($("<td />", {
                             text: data.item.name
                         })).append($("<td />", {
                             text: data.item.description
                         })).append($("<td />", {
                             html:'<button type="button" class="btn btn-success btn-detailgroup" data-toggle="modal" data-target="#Modal_detailgroup" value="'+data.item.id+'">Chi tiết</button>'+" "+'<button type="button" class="btn btn-primary btn-updategroup" data-toggle="modal" data-target="#Modal_update_group"  value="'+data.item.id+'">Sửa</button>'+" "+'<button type="button" class="btn btn-danger btn-delgroup" value="'+data.item.id+'">Xóa</button>'
                         }))
                         $("#listgroup").append(tr);
                     }
                 }
             },
         });
     // });
 }

    //-------------------------Delete group

    $("body").delegate(".btn-delgroup","click",function(e) {
        e.preventDefault();
        if (confirm("Bạn có muốn xóa không ?")) {
            var idgroup = $(this).val();
            $.ajax({
                url: '/ql_admin/nhom/xoa/' + idgroup,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);
                    if (data.error) {
                        alert(data.error)
                    }
                    if (data.success) {
                        alert(data.success);
                        $("tr#"+idgroup).remove();
                    }
                },
            });
        }
        return false;

    });

    //------------------get data edit group

    $("body").delegate(".btn-updategroup","click",function(e) {
        e.preventDefault();
        var idgroup = $(this).val();
        $.ajax({
            url: '/ql_admin/nhom/sua/' + idgroup,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                if (data.success) {
                    console.log(data.item);
                    console.log(data.item_room);
                    var id_p=data.item.id_phong;

                    $("#txtname").val(data.item.name);
                    $("#txtdes").val(data.item.description);
                    $("#txtid").val(idgroup);

                    select = '<select name="txtphong" class="form-control " id="txtphong" >';
                    $.each(data.item_room, function(i,data)
                    {
                       if(data.id==id_p){
                           select +='<option selected value="'+data.id+'">'+data.name+' </option>';
                       }
                       else{
                           select +='<option  value="'+data.id+'">'+data.name+' </option>';
                       }
                    });
                    select += '</select>';
                    $("#txtphong").html(select);


                   if (data.item.status == 1) {
                        $("#txtstatuss").replaceWith(
                            '<select name="txtstatus" id="txtstatus" class="form-control"><option value="1" selected >Hoạt động</option>\n' +
                            '<option value="0">Không hoạt động</option></select>'
                        );
                    }
                }
            },
        });
    });

    //-------------- post data edit group

   function updateGroup() {
       // $(".btnupdategroup").click(function(e) {
       //     e.preventDefault();
           var idgroup = $("#txtid").val();
           var updateForm = $("#form-updategroup");
           var formData = updateForm.serialize();
           $.ajax({
               url: '/ql_admin/nhom/sua/' + idgroup,
               type: 'POST',
               data: formData,
               dataType: 'json',
               success: function(data) {
                   // console.log(data);
                   $("#form-updategroup").trigger('reset');
                   if (data.error) {
                       printErrorMsg(data.error);
                   }
                   if (data.success) {

                       console.log(data.item);
                       alert(data.success);
                       $('#Modal_update_group').modal('hide');
                       if(data.item.status==1){

                           var tr = $("<tr/>",{
                               id:data.item.id
                           });
                           tr.append($("<td />", {
                               text: data.item.id
                           })).append($("<td />", {
                               text: data.item.name
                           })).append($("<td />", {
                               text: data.item.description
                           })).append($("<td />", {
                               html:'<button type="button" class="btn btn-success btn-detailgroup" data-toggle="modal" data-target="#Modal_detailgroup" value="'+data.item.id+'">Chi tiết</button>'+" "+'<button type="button" class="btn btn-primary btn-updategroup" data-toggle="modal" data-target="#Modal_update_group"  value="'+data.item.id+'">Sửa</button>'+" "+'<button type="button" class="btn btn-danger btn-delgroup" value="'+data.item.id+'">Xóa</button>'
                           }))
                           $("#listgroup tr#"+data.item.id).replaceWith(tr);
                       }
                       else{
                           $("tr#"+idgroup).remove();
                       }

                   }
               },
           });

       // });
   }
//-------------------get detail group

$("body").delegate(".btn-detailgroup","click",function (e) {
    e.preventDefault();
    var idgroup = $(this).val();
    // alert(idgroup);
    $.ajax({
        url: '/ql_admin/nhom/chitiet/' + idgroup,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // console.log(data);
            if (data.success) {
                console.log(data.item[0]);
                $("#txt_idd").html(data.item[0].id);
                $("#txtnamee").html(data.item[0].name);
                $("#txtmota").html(data.item[0].description);
                $("#txtphongg").html(data.item[0].ph);
                if(data.item[0].status==1){
                    $("#txttt").html("Hoạt động");
                }
                else{
                    $("#txttt").html("Không hoạt động");
                }
                $("#txtcreat").html(data.item[0].created_at);
            }
        },
    });
});


//----------------Add employee

    // $(".btn-add-nv").click(function (e) {
    //     e.preventDefault();
    //     $(".print-error-msg").css('display', 'none');
    // });

function addEmp() {
    // $(".btn-addnv").click(function(e) {
    //     e.preventDefault();

        var form_data = new FormData($("#formaddnv")[0]);
        $.ajax({
            url: '/ql_admin/nhanvien/them',
            type: 'POST',
            data: form_data,
            // dataType: 'json',
            // async: false,
            processData: false,
            contentType: false,
            success: function(data) {
                // console.log(data);

                if (data.error) {
                    printErrorMsg(data.error);
                }
                if (data.success) {
                    console.log(data.arr);
                    // console.log(data.id);
                    alert(data.success);
                    $("#formaddnv").trigger('reset');
                    $('#Modal_addNv').modal('hide');

                    if(data.item.status==1){

                        var tr = $("<tr/>",{
                            id:data.item.id
                        });
                        tr.append($("<td />", {
                            text: data.item.id
                        })).append($("<td />", {
                            text: data.item.name
                        })).append($("<td />", {
                            text: data.item.position
                        })).append($("<td />", {
                            text: data.item.phone
                        })).append($("<td />", {
                            html:'<img src="uploads/admin/nhanvien/'+data.item.image+'" width="100px"/>'
                        })).append($("<td />", {
                            html:'<button type="button" class="btn btn-primary btn-updateNv" data-toggle="modal" data-target="#Modal_updateNv"  value="'+data.item.id+'">Sửa</button>'+" "+'<button type="button" class="btn btn-danger btn-del-emp" value="'+data.item.id+'">Xóa</button>'
                        }))
                        $("#listemploy").append(tr);
                    }
                }
            },
        });
    // });
}



//--------------delete employee

$("body").delegate(".btn-del-emp","click",function(e){
      e.preventDefault();
    if (confirm("Bạn có muốn xóa không ?")) {
        var idemp = $(this).val();
        $.ajax({
            url: '/ql_admin/nhanvien/xoa/' + idemp,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                if (data.error) {
                    alert(data.error)
                }
                if (data.success) {
                    alert(data.success);
                    $("tr#"+idemp).remove();
                }
            },
        });
    }
    return false;

});

// ---------------Get data emp

    $("body").delegate(".btn-updateNv","click",function(e) {
        e.preventDefault();
        var idemp = $(this).val();
        $.ajax({
            url: '/ql_admin/nhanvien/sua/' + idemp,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // console.log(data);
                if (data.success) {
                    console.log(data.item_group_id);
                    $("#txtid").val(data.item.id);
                    $("#txtname").val(data.item.name);
                    $("#txtcv").val(data.item.position);
                    $("#txtluong").val(data.item.salary);
                    $("#txtemail").val(data.item.email);
                    $("#txtsdt").val(data.item.phone);
                    $("#txtdc").val(data.item.address);
                    $("#txtimagecurrent").val(data.item.image);
                      $("#img").attr({src:"uploads/admin/nhanvien/"+data.item.image,height:"100px"});
                    $("#txtid").val(idemp);

                    var id_room=data.item.id_room;

                    select = '<select name="txtphong" class="form-control " id="txtroom" >';
                    $.each(data.item_room, function(i,data)
                    {
                        if(data.id==id_room){
                            select +='<option selected value="'+data.id+'">'+data.name+' </option>';
                        }
                        else{
                            select +='<option  value="'+data.id+'">'+data.name+' </option>';
                        }
                    });
                    select += '</select>';
                    $("#txtroom").html(select);


                    select1 = '<select name="txtnhom[]" class="form-control" id="txtgroup" multiple >';
                    // $.each(data.item_group, function(i,datagr)
                    // {
                            $.each(data.item_group_id, function(i,data)
                            {
                                // if(datagr.id==data.id){
                                    select1 +='<option selected value="'+data.id+'">'+data.name+' </option>';
                                // }
                                // else{
                                //     select1 +='<option  value="'+data.id+'">'+data.name+' </option>';
                                // }
                            });

                    // });
                    select1 += '</select>';

                    $("#txtgroup").html(select1);


                   if (data.item.status == 1) {
                        $("#txtstatuss").replaceWith(
                            '<select name="txtstatus" id="txtstatus" class="form-control"><option value="1" selected >Đang làm việc</option>\n' +
                            '<option value="0">Đã nghỉ</option></select>'
                        );
                    }
                }
            },
        });
    });


    // post data edit employee

   function updateEmp() {
       // $(".btn-editNv").click(function(e) {
       //     e.preventDefault();
           var idemp = $("#txtid").val();
           var form_data = new FormData($("#formeditemp")[0]);
           $.ajax({
               url: '/ql_admin/nhanvien/sua/' + idemp,
               type: 'POST',
               data: form_data,
               // dataType: 'json',
               // async: false,
               processData: false,
               contentType: false,
               success: function(data) {
                   // console.log(data);
                   $("#formeditemp").trigger('reset');
                   if (data.error) {
                       printErrorMsg(data.error);
                   }
                   if (data.success) {
                       // console.log(data.item);
                       alert(data.success);
                       $('#Modal_updateNv').modal('hide');
                       if(data.item.status==1){

                           var tr = $("<tr/>",{
                               id:data.item.id
                           });
                           tr.append($("<td />", {
                               text: data.item.id
                           })).append($("<td />", {
                               text: data.item.name
                           })).append($("<td />", {
                               text: data.item.position
                           })).append($("<td />", {
                               text: data.item.phone
                           })).append($("<td />", {
                               html:'<img src="uploads/admin/nhanvien/'+data.item.image+'" height="100px"/>'
                           })).append($("<td />", {
                               html:'<button type="button" class="btn btn-primary btn-updateNv" data-toggle="modal" data-target="#Modal_updateNv"  value="'+data.item.id+'">Sửa</button>'+" "+'<button type="button" class="btn btn-danger btn-del-emp" value="'+data.item.id+'">Xóa</button>'
                           }))
                           $("#listemploy tr#"+data.item.id).replaceWith(tr);
                       }
                       else{
                           $("tr#"+idemp).remove();
                       }

                   }
               },
           });

       // });
   }

//---------------------change select option

$('#txtphong,#txtroom').on('change', function (e) {
    $id_p=$(this).val();
    // alert($(this).val());
    $.ajax({
        url: '/ql_admin/nhanvien/nhom-phong/' + $id_p,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // console.log(data.item);
            if (data.success) {
                // console.log(data.item[0].id);
                select = '<select name="txtnhom[]" class="form-control " id="txtnhom">';
                $.each(data.item, function(i,data)
                {
                    select +='<option value="'+data.id+'">'+data.name+'</option>';
                });
                select += '</select>';
                $("#txtnhom").html(select);

                select1 = '<select name="txtnhom[]" class="form-control " id="txtgroup">';
                $.each(data.item, function(i,data)
                {
                    select1 +='<option value="'+data.id+'">'+data.name+'</option>';
                });
                select1 += '</select>';
                $("#txtgroup").html(select1);
            }
        },
    });

});

//-----------------search emp
$(".btn-search").click(function (e) {
    e.preventDefault();
   var tk=$("#txt_search").val();
       $.ajax({
       url: '/ql_admin/nhanvien/tim-kiem/' + tk,
       type: 'GET',
       dataType: 'json',
       success: function(data) {
           // console.log(data.item);
           if (data.success) {
               // console.log(data.item[0].id);
               tr='';
               $.each(data.item, function(i,data)
               {
                   tr+='<tr id="'+data.id+'" >'+'<td>'+data.id+'</td>'+'<td>'+data.name+'</td>'+'<td>'+data.position+'</td>'+'<td>'+data.phone+'</td>'+'<td><img src="uploads/admin/nhanvien/'+data.image+'" height="100px"/></td>'+'<td><button type="button" class="btn btn-primary btn-updateNv" data-toggle="modal" data-target="#Modal_updateNv"  value="'+data.id+'">Sửa</button>'+" "+'<button type="button" class="btn btn-danger btn-del-emp" value="'+data.id+'">Xóa</button></td>'+'</tr>';

               });
               $("#listemploy").html(tr);
           }
       },
   });


});

 // sort data emp

$("#txtsx").on('change',function (e) {
    e.preventDefault();
    var sx=$("#txtsx").val();
    $.ajax({
        url: '/ql_admin/nhanvien/sap-xep/' + sx,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // console.log(data.item);
            if (data.success) {
                // console.log(data.item[0].id);
                tr='';
                $.each(data.item, function(i,data)
                {
                    tr+='<tr id="'+data.id+'" >'+'<td>'+data.id+'</td>'+'<td>'+data.name+'</td>'+'<td>'+data.position+'</td>'+'<td>'+data.phone+'</td>'+'<td><img src="uploads/admin/nhanvien/'+data.image+'" height="100px"/></td>'+'<td><button type="button" class="btn btn-primary btn-updateNv" data-toggle="modal" data-target="#Modal_updateNv"  value="'+data.id+'">Sửa</button>'+" "+'<button type="button" class="btn btn-danger btn-del-emp" value="'+data.id+'">Xóa</button></td>'+'</tr>';

                });
                $("#listemploy").html(tr);
            }
        },
    });

});

    //------------- show error validate form

    function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $.each(msg, function(key, value) {
            $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
        });
    }
