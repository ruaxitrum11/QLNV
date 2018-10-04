$(".form-login-button").click(function(){
	$(".form-login-button").removeClass("active");
    $(this).addClass("active");
});

// $(".addTask").click(function () {
//    console.log({{$task->id}});
// })

function editTask(id) {
    // console.log("task-"+id);
    $(".task-"+id).removeAttr('disabled value');
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
        url: '/dashboard/editTask',
        dataType: 'json',
        data: {
            user_id: id,
            name: name,
        },
        success:function (res) {
            $(".content-msg").append(res.msg);
        },
        fail:function (res) {
            console.log(res);
            $(".content-msg").append(res.msg);
        }
    });

}