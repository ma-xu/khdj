<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<html lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>加成健康 - 登录</title>
    <link href="<?=base_url().'resources/css/bootstrap.min.css'?>" rel="stylesheet">
    <link href="<?=base_url().'resources/css/font-awesome.min93e3.css?v=4.4.0'?>" rel="stylesheet">
    <link href="<?=base_url().'resources/css/animate.min.css'?>" rel="stylesheet">
    <link href="<?=base_url().'resources/css/style.min.css'?>" rel="stylesheet">
    <link href="<?=base_url().'resources/css/login.min.css'?>" rel="stylesheet">

    
   
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if(window.top!==window.self){window.top.location=window.location};
    </script>

</head>

<body class="signin">
    <div class="signinpanel">
        <div class="row">
            <div class="col-sm-7">
                <div class="signin-info">
                    <div class="logopanel m-b">
                        <h1>[ 加成 ]</h1>
                    </div>
                    <div class="m-b"></div>
                    <h4>欢迎使用 <strong>加成健康后台管理</strong></h4>
                    <ul class="m-b">
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势一</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势二</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势三</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势四</li>
                        <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> 优势五</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-5">
                <form method="post" action="<?=site_url('login/index')?>">
                    <h4 class="no-margins">登录：</h4>
                    <p class="m-t-md">登录到加成健康后台</p>
                    <input type="text" class="form-control uname" placeholder="用户名" name="username"/>
                    <input type="password" class="form-control pword m-b" placeholder="密码" name="password"/>
                    <a href="#">忘记密码了？</a>
                    <button class="btn btn-success btn-block">登录</button>
                </form>
            </div>
        </div>
        <div class="signup-footer">
            <div class="pull-left">
                &copy; 2015 All Rights Reserved. H+
            </div>
        </div>
    </div>
</body>

</html>