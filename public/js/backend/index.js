$('.addUser').click(function () {
   $('#register-form').toggle(750);
});

function addUser() {

   var username = $("#username").val();
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