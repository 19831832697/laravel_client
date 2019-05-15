<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    <p>
        用户名:<input type="text" name="user_name" id="user_name">
    </p>
    <p>
        密码:<input type="password" name="user_pwd" id="user_pwd">
    </p>
    <p>
        <input type="button" id="btn" value="登录">
    </p>
</form>
</body>
</html>
<script src="js/jquery-3.1.1.min.js"></script>
<script>
    $(document).ready(function(){
        $(document).on('click','#btn',function(){
            var user_name=$('#user_name').val();
            var user_pwd=$('#user_pwd').val();
            var data={};
            data.user_name=user_name;
            data.user_pwd=user_pwd;
            $.ajax({
                url:"http://lumen.1809a.com/loginDo",
                method:"GET",
                data:data,
                dataType:"jsonp",
                jsonp:"callback",
                success:function(msg){
                    alert(msg);
                }
            })
        })
    })
</script>