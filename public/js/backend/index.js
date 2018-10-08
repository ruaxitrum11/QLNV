$('.addUser').click(function () {
   $('#register-form').toggle(750);
});

function addUser() {

   var username = $("#username").val();
   var name = $("#name").val();
   var password = $("#password").val();
   var password_confirmation = $("#confirm-password").val();

   // console.log(username);
   //  console.log(password);
   //  console.log(password_confirm);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    $.ajax({
        method: 'post',
        url: '/admin/addUser',
        dataType: "json",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: {
            username: username,
            name : name,
            password : password,
            password_confirmation : password_confirmation
        },
        success:function (res) {
              if(res.username){
                $.confirm({
                    title: 'Thông báo!',
                    content: '<span class="text-danger"><strong class="fa fa-close"></strong>' + res.username + '</span>',
                    // content:'<span class="text-danger"><strong class="fa fa-close"></strong>Tài khoản hoặc mật khẩu không hợp lệ</span>',
                    buttons: {
                        Ok:  function() {

                        },
                    }
                });
            }else if(res.name) {
                  $.confirm({
                      title: 'Thông báo!',
                      content: '<span class="text-danger"><strong class="fa fa-close"></strong>' + res.name+ '</span>',
                      // content:'<span class="text-danger"><strong class="fa fa-close"></strong>Tài khoản hoặc mật khẩu không hợp lệ</span>',
                      buttons: {
                          Ok:  function() {

                          },
                      }
                  });
              }else if(res.password){
                $.confirm({
                    title: 'Thông báo!',
                    content: '<span class="text-danger"><strong class="fa fa-close"></strong>' + res.password+ '</span>',
                    // content:'<span class="text-danger"><strong class="fa fa-close"></strong>Tài khoản hoặc mật khẩu không hợp lệ</span>',
                    buttons: {
                        Ok:  function() {

                        },
                    }
                });
            }else{
                  $.confirm({
                      title: 'Thông báo!',
                      content: '<span class="text-success"><strong class="fa fa-check"></strong>' + res.msg + '</span>',
                      buttons: {
                          Ok:  function() {
                              location.reload();
                          },
                      }
                  });
              }
        }
    });
}

function infoUser(id) {
    window.location.href = '/admin/userInfo/'+id;
}

function updateUser(id) {
    // console.log(id);
    $id = id ;
    $name = $('#name').val();
    // $permission = $('#permission').find(":selected").text();
    $permission_id = $('#permission').find(":selected").val();
    // console.log($permission)
    // console.log($username)
    // console.log($name)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    $.ajax({
        method: 'put',
        url: '/admin/updateUser/'+id,
        dataType: "json",
        contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        data: {
            id : id,
            name : $name,
            permission_id : $permission_id

        },
        success:function (res) {
            if (res.name){
                $.confirm({
                    title: 'Thông báo!',
                    content: res.name,
                    buttons: {
                        Ok: function () {

                        },
                    }
                });
            }else {
                $.confirm({
                    title: 'Thông báo!',
                    content: res.msg,
                    buttons: {
                        Ok: function () {
                            location.reload();
                        },
                    }
                });
            }
        }
    });
}

function deleteUser(id,username){
    // console.log(id);
    // console.log(username);
    $.confirm({
        title: 'Thông báo!',
        content:'Bạn có chắc chắn muốn xóa tài khoản <span style="font-size: 2rem;font-weight: bold;">' + username +'</span><input class="user-id" value="'+id+'" hidden />',
        buttons :{
            'Đồng ý': function () {
                let id = this.$content.find('.user-id').val();
                // console.log(id)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
                $.ajax({
                    method: 'delete',
                    url: '/admin/deleteUser/'+id,
                    dataType: "json",
                    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                    success:function (res) {
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
                                content: res.msg,
                                buttons: {
                                    Ok: function () {
                                        location.reload();
                                    },
                                }
                            });
                        }
                    }
                });
               
            },
            'Hủy bỏ':function () {

            }
        }
    });

}