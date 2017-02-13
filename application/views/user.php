<!DOCTYPE html>
<html>

<head>
    <!--左侧导航开始-->
    <?php include 'include/resources.php';?>
    <!--左侧导航结束-->
    <script src="<?=base_url().'resources/js/user.js'?>"></script>
    
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
    <div id="wrapper">
        <!--添加弹出层开始-->
        <div id="insertView" style="display: none;">
            <div class="modal in" style="overflow: auto; display: block; padding-right: 6px;" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="close_view()">×</a>
                            <h4 class="modal-title">添加用户</h4>
                        </div>
                        <div class="modal-body ui-front" style="min-height: 400px;">
                            
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">用户姓名：</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="insert_user_name">
                                    </div>
                                </div>
                                 <div class="form-group" style="padding-top: 30px;">
                                    <label class="col-sm-4 control-label">性别：</label>
                                    <div class="col-sm-8">

                                       男&nbsp;<input type="radio"  name="sex" value="男" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       女&nbsp;<input type="radio"  name="sex" value="女" />
                                    </div>
                                 </div>
                                <div class="form-group" style="padding-top: 30px;">
                                    <label class="col-sm-4 control-label">年龄：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="insert_user_age">
                                    </div>
                                </div>
                                 <div class="form-group" style="padding-top: 30px;">
                                    <label class="col-sm-4 control-label">电话号码：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="insert_user_mobile">
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top: 30px;">
                                    <label class="col-sm-4 control-label">家庭名称：</label>

                                    <div class="col-sm-8">
                                        <select class="selectpicker" id="insert_family_id" data-style="btn-success" data-width="100%">
                                            <option>请选择家庭</option>
                                            <?php foreach($families as $family):?> 
                                            <option value="<?php echo $family['id'];?>" >
                                                <?php echo $family['name'];?>
                                            </option>
                                             <?php endforeach;?> 
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top: 30px;">
                                    <label class="col-sm-4 control-label">社区专享码：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="insert_user_staffcode">
                                    </div>
                                </div>
                                
                                <div class="form-group" >
                                    <div class="col-sm-offset-5 col-sm-4">
                                        <button class="btn  btn-warning " style="margin-top: 10px;margin-bottom:10px;" onclick="insert_user()">保存</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop in"></div>
        </div>
        <!--添加弹出层结束-->
        <!--修改弹出层开始-->
        <div id="editView" style="display: none;">
            <div class="modal in" style="overflow: auto; display: block; padding-right: 6px;" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <a type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="close_view()">×</a>
                            <h4 class="modal-title">修改信息</h4>
                        </div>
                        <div class="modal-body ui-front" style="min-height: 420px;">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">姓名：</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" id="edit_user_name">
                                        <input type="hidden" id="edit_user_id">
                                    </div>
                                </div>
                                 <div class="form-group" style="padding-top: 30px;">
                                    <label class="col-sm-3 control-label">性别：</label>
                                    <div class="col-sm-8">
                                       
                                       男&nbsp;<input type="radio"  id='sex1' name="sex" value="男" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                       女&nbsp;<input type="radio"  id='sex2' name="sex" value="女" />
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top: 30px;">
                                    <label class="col-sm-3 control-label">年龄：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="edit_user_age">
                                        
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top: 30px;">
                                    <label class="col-sm-3 control-label">手机号：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="edit_user_mobile">
                                    </div>
                                </div>
                                 <div class="form-group" style="padding-top: 30px;">
                                    <label class="col-sm-3 control-label">家庭名称：</label>
                                    <div class="col-sm-8">
                                        <select class="selectpicker" id="edit_family_id" data-style="btn-success" data-width="100%">                        
                                            <?php foreach($families as $family):?> 
                                            <option value="<?php echo $family['id'];?>" ><?php echo $family['name'];?></option>
                                             <?php endforeach;?> 
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top: 30px;">
                                    <label class="col-sm-3 control-label">账户：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="edit_user_username">
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top: 30px;">
                                    <label class="col-sm-3 control-label">密码：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="edit_user_password">
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top: 30px;">
                                    <label class="col-sm-3 control-label">社区专享码：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="edit_user_staffcode">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <div class="col-sm-offset-5 col-sm-4">
                                        <button class="btn  btn-warning" style="margin-top: 10px;margin-bottom:10px;" onclick="update_user()">修改</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-backdrop in"></div>
        </div>
        <!--修改弹出层结束-->
        
        
        <!--左侧导航开始-->
        <?php include 'include/left.php';?>
        <!--左侧导航结束-->
        <!--右侧部分开始-->
        <div id="page-wrapper" class="gray-bg dashbard-1">
            <!--左侧导航开始-->
            <?php include 'include/top.php';?>
            <!--左侧导航结束-->
            <div class="row J_mainContent" id="content-main">
            <!--内容开始-->
              
            <div>
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>用户管理&nbsp;&nbsp;&nbsp;&nbsp;用户总数：<?php echo $total_counts;?></h5>
                      
                    </div>
                    <div class="ibox-content">
                        <div class="row"> 
                            <div class="btn-group col-sm-7">
                                <button type="button" class="btn btn-primary" onclick="insert_show()">添加</button>
                            </div>
                            
                                <div class="row col-sm-5">
                                     <form method="post" action="<?=site_url('User/getSearch')?>">
                                    <div class="col-sm-6">
                                        <select class="selectpicker" id="familyId" name="districtId" data-style="btn-success" data-width="100%">
                                            <option value="0">请选择家庭</option>
                                            <?php foreach($families as $family):?> 
                                            <?php if($choseid!=''&&$family['id']==$choseid){ ?>
                                            <option value="<?php echo $family['id'];?>" selected>
                                                <?php echo $family['name'];?>
                                            </option>
                                           <?php }else{ ?>
                                            <option value="<?php echo $family['id'];?>">
                                                <?php echo $family['name'];?>
                                            </option>
                                            <?php } ?>
                                             <?php endforeach;?> 
                                        </select>
                                    </div>
                                   
                                    <div class="col-sm-6">
                                       
                                        <div class="input-group ">
                                            <input type="text" placeholder="专享码" id="staffcode" name="staffcode" class="input-sm form-control"> 
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-sm btn-primary" > 搜索</button> 
                                            </span>
                                        </div>
                                        
                                    </div>
                                    </form>
                                </div> 
                            
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>用户名</th>
                                        <th>性别</th>
                                        <th>年龄</th>
                                        <th>手机号</th>
                                        <th>家庭类型</th>
                                        <th>账户</th>
                                        <th>密码</th>
                                        <th>社区专享码</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $user):?> 
                                    <tr>
                                        
                                        <td><?php echo $user['id'];?></td>
                                        <td><?php echo $user['name'];?></td>
                                        <td><?php echo $user['sex'];?></td>
                                        <td><?php echo $user['age'];?></td>
                                        <td><?php echo $user['mobile'];?></td>
                                        <td><?php echo $user['familyName'];?></td>
                                        <td><?php echo $user['username'];?></td>
                                        <td><?php echo $user['password'];?></td>
                                        <td><?php echo $user['staffcode'];?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn btn-warning" onclick="edit_user(<?php echo $user['id'];?>)">修改</button>
                                                <button type="button" class="btn btn-danger" onclick="delete_user(<?php echo $user['id'];?>)">删除</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        </div>
                </div>
                
            </div>
            <!--内容结束-->
            </div>
            <!--左侧导航开始-->
            <?php include 'include/footer.php';?>
            <!--左侧导航结束-->
        </div>
        <!--右侧部分结束-->
    </div>
   
    
</body>


</html>
