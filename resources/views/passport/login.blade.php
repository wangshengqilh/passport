<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PassPort</title>
</head>
<body>
<form class="form-horizontal" method="post" action="/logininfo">
    {{csrf_field()}}
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">账号</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="username" style="width: 200px">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="pwd" id="inputPassword3" placeholder="Password" style="width: 200px">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" id="sub" class="btn btn-primary">登录</button>
        </div>
    </div>
</form>
</body>
</html>
{{--
<script src="./jquery-3.3.1.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#sub').click(function () {
        var account_name=$('#inputEmail3').val();
        if(account_name == ''){
            alert('请输入用户名');
            return false;
        }
        var psd=$('#inputPassword3').val();
        if(psd == ''){
            alert('请输入密码');
            return false;
        }

        $.ajax({
            data:'account='+account_name+'&pwd='+psd,
            url:"{{url('/logininfo')}}",
            dataType:'json',
            type:'post',
            success:function(json_info){
                alert(json_info);
            },
            error:function () {
                alert(501)
            }
        })
    })
</script>--}}
