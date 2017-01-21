<!DOCTYPE html>
<html>

<head>

    <?php include 'resources.php';?>
    
</head>

<body>
    <div style="display: -webkit-box;">
        <form role="form" style="width:90%;margin :0 auto;" method="post" action="<?=site_url('mobile/login/login')?>">
            <div class="form-group">
                <div class="btn btn-warning btn-lg btn-block">加成健康登录</div>
            </div>

            <div class="form-group" style="margin-top:50px;">
                <label>用户名</label>
                <input placeholder="请输入用户名或手机号" class="form-control" name="username">
            </div>
            <div class="form-group">
                <label>密码</label>
                <input type="password" placeholder="请输入密码" class="form-control" name="password">
            </div>

            <div class="form-group" style="margin-top:50px;">
                <div class="text-center col-md-6 col-md-offset-3 col-xs-8 col-xs-offset-2">
                    <button type="submit" class="btn btn-warning btn-block">登&nbsp;&nbsp;录</button>
                </div>
            </div>

        </form>
    </div>
    <div class="form-group" style="width:90%;margin :0 auto;margin-top:30px;">
        <h5>还不是会员？</h5>
        <p>您可以<a href="<?=site_url('mobile/login/reigisterView')?>">注册一个新账户</a></p>
    </div
</body>

</html>
