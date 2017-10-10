//前端登录
var login={
    check:function () {
       var username= $('input[name="username"]').val();
       var password= $('input[name="userpass"]').val();
        if(!username){
            return dialog.error("用户名不能为空！");
        }
        if(!password){
            return dialog.error("密码不能为空！");
        }
        //异步请求
        $.ajax( {
            url:'/index.php?m=Home&c=Login&a=check',// 跳转到 action
            data:{
                'username':username,
                'password':password
            },
            type:'post',
            dataType:'json',
            success:function(result) {

                if(result.status == 0) {
                    return dialog.error(result.message);
                }
                if(result.status == 1) {
                    return dialog.success(result.message, '/index.php?m=home&c=index');
                }
            },
            error : function() {
                alert("异常！");
            }
        });
    }
}