$(".form-login-button").click(function(){
	$(".form-login-button").removeClass("active");
    $(this).addClass("active");
});

// $(".addTask").click(function () {
//    console.log({{$task->id}});
// })

function editTask(id) {
    // console.log("task-"+id);
    $(".task-"+id).removeAttr('disabled value').attr('placeholder','Cập nhật công việc ?');
    $(".editTask-"+id).hide();
    $(".cancelEditTask-"+id).show();
    $(".confirmEditTask-"+id).show();
    $(".task-ddd-"+id).addClass("clicked")
}

function confirmEditTask(id) {
    var name = $("#task-content-"+id).val();
    // console.log(name);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    $.ajax({
        method: 'put',
        url: '/dashboard/editTask/' + id,
        dataType : "json",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: {
            name: name,
        },
        success:function (res) {
            // console.log(res);
            // $(".content-msg").append(res.msg).show();
            if(res.status== 'success') {
                $.confirm({
                    title: 'Thông báo!',
                    content: 'Bạn có chắc chắn muốn thay đổi công việc?',
                    buttons: {
                        'Đồng ý': function () {
                        $.confirm({
                            title:'Thông báo!',
                            content:'<span class="text-success"><strong class="fa fa-check"></strong>' + res.msg + '</span>',
                            buttons: {
                                Ok: function () {
                                    location.reload();
                                }
                            }
                        })
                        },
                        'Hủy bỏ': function () {

                        },
                    }
                });
            }else {
                $.confirm({
                    title: 'Thông báo!',
                    content: '<span class="text-danger"><strong class="fa fa-close"></strong>' + res.name + '</span>',
                    buttons: {
                        Ok: function () {

                        },
                    }
                });
            }
        },
        errors:function (res) {
            // console.log(res);
            $.confirm({
                title: 'Thông báo!',
                content: '<span class="text-success"><strong class="fa fa-check"></strong>'+res.msg+'</span>',
                buttons: {
                    Ok: function () {
                        location.reload();
                    },
                }
            });
        }
    });

}

function deleteTask(id) {

    $.confirm({
        title:'Thông báo!',
        content:'Bạn có chắc muốn xóa công việc này không?'+'<input class="task-id" value="'+id+'" hidden />',
        buttons:{
            'Đồng ý': function() {
                    var id = this.$content.find('.task-id').val();
                    // console.log(id);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                    });
                    $.ajax({
                        method: 'delete',
                        url: '/dashboard/deleteTask/'+ id,
                        success:function(res) {
                            // console.log(res);
                            if(res.status == 'success') {
                                $.confirm({
                                    title: 'Thông báo!',
                                    content: res.msg,
                                    buttons: {
                                        Ok: function () {
                                            location.reload();
                                        },
                                    }
                                });
                            }else {
                                $.confirm({
                                    title: 'Thông báo!',
                                    content: 'Xóa sản phẩm thất bại',
                                    buttons: {
                                        Ok: function () {
                                            location.reload();
                                        },
                                    }
                                });
                            }
                        }
                    })
                },
            'Hủy bỏ': function () {

            }
        },

    })
   
}