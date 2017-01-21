<!DOCTYPE html>
<html>

<head>
    <!--左侧导航开始-->
    <?php include 'include/resources.php';?>
    <!--左侧导航结束-->
    <script src="<?=base_url().'resources/js/community.js'?>"></script>
    
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
                            <h4 class="modal-title">添加社区</h4>
                        </div>
                        <div class="modal-body ui-front" style="min-height: 280px;">
                            
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">行政区：</label>
                                    <div class="col-sm-8">
                                        <select class="selectpicker" id="insert_district_id" data-style="btn-success" data-width="100%">
                                            <option>请选择区</option>
                                            <?php foreach($districts as $district):?> 
                                            <option value="<?php echo $district['id'];?>" >
                                                <?php echo $district['name'];?>
                                            </option>
                                             <?php endforeach;?> 
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group" style="padding-top: 40px;">
                                    <label class="col-sm-4 control-label">请选择街道：</label>
                                    <div class="col-sm-8">
                                        <select class="selectpicker" id="insert_street_id" data-style="btn-success" data-width="100%">
                                            <option>请选择街道</option>
                                           
                                        </select>
                                    </div>
                                 </div>
                                <div class="form-group" style="padding-top: 40px;">
                                    <label class="col-sm-4 control-label">社区名：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="insert_community_name">
                                    </div>
                                </div>
                                 <div class="form-group" style="padding-top: 40px;">
                                    <label class="col-sm-4 control-label">诊所地址：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="insert_community_location">
                                    </div>
                                </div>
                                
                                <div class="form-group" >
                                    <div class="col-sm-offset-8 col-sm-3">
                                        <button class="btn  btn-warning" style="margin-top: 10px;margin-bottom:10px;" onclick="insert_community()">保存</button>
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
                            <h4 class="modal-title">修改社区</h4>
                        </div>
                        <div class="modal-body ui-front" style="min-height: 280px;">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">行政区：</label>
                                    <div class="col-sm-8">
                                        <select class="selectpicker" id="edit_district_id" data-style="btn-success" data-width="100%">                        
                                            <?php foreach($districts as $district):?> 
                                            <option value="<?php echo $district['id'];?>" ><?php echo $district['name'];?></option>
                                             <?php endforeach;?> 
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group" style="padding-top: 40px;">
                                    <label class="col-sm-3 control-label">街道：</label>
                                    <div class="col-sm-8">
                                        <select class="selectpicker" id="edit_street_id" data-style="btn-success" data-width="100%">                        
                                            <?php foreach($streets as $street):?> 
                                            <option value="<?php echo $street['id'];?>" ><?php echo $street['name'];?></option>
                                             <?php endforeach;?> 
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top: 40px;">
                                    <label class="col-sm-3 control-label">社区名：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="edit_community_name">
                                        <input type="hidden" id="edit_community_id">
                                    </div>
                                </div>
                                <div class="form-group" style="padding-top: 40px;">
                                    <label class="col-sm-3 control-label">诊所地址：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="edit_community_location">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <div class="col-sm-offset-3 col-sm-8">
                                        <button class="btn  btn-warning" style="margin-top: 10px;margin-bottom:10px;" onclick="update_community()">修改</button>
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
                        <h5>社区管理&nbsp;&nbsp;&nbsp;&nbsp;社区总数：<?php echo $total_counts;?></h5>
                      
                    </div>
                    <div class="ibox-content">
                        <div class="row"> 
                            <div class="btn-group col-sm-6">
                                <button type="button" class="btn btn-primary" onclick="insert_show()">添加</button>
                            </div>
                            
                                <div class="row col-sm-6">
                                     <form method="post" action="<?=site_url('Community/getSearch')?>">
                                    <div class="col-sm-4">
                                        <select class="selectpicker" id="districtId" name="districtId" data-style="btn-success" data-width="100%">
                                            <option value="0">请选择区</option>
                                            <?php foreach($districts as $district):?> 
                                            <?php if($choseid1!=''&&$district['id']==$choseid1){ ?>
                                            <option value="<?php echo $district['id'];?>" selected>
                                                <?php echo $district['name'];?>
                                            </option>
                                           <?php }else{ ?>
                                            <option value="<?php echo $district['id'];?>">
                                                <?php echo $district['name'];?>
                                            </option>
                                            <?php } ?>
                                             <?php endforeach;?> 
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="selectpicker" id="streetId" name="streetId" data-style="btn-success" data-width="100%">
                                            <option value="0">请选择街道</option>
                                            <?php foreach($streets as $street):?> 
                                            <?php if($choseid2!=''&&$street['id']==$choseid2){ ?>
                                            <option value="<?php echo $street['id'];?>" selected>
                                                <?php echo $street['name'];?>
                                            </option>
                                           <?php }else{ ?>
                                            <option value="<?php echo $street['id'];?>">
                                                <?php echo $street['name'];?>
                                            </option>
                                            <?php } ?>
                                             <?php endforeach;?> 
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                       
                                        <div class="input-group ">
                                            <input type="text" placeholder="社区名" id="communityName" name="communityName" class="input-sm form-control"> 
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
                                        <th>社区名</th>
                                        <th>街道名</th>
                                        <th>隶属区名</th>
                                        <th>诊所地址</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($communities as $community):?> 
                                    <tr>
                                        
                                        <td><?php echo $community['id'];?></td>
                                        <td><?php echo $community['name'];?></td>
                                         <td><?php echo $community['streetName'];?></td>
                                        <td><?php echo $community['districtName'];?></td>
                                        <td><?php echo $community['location'];?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn btn-warning" onclick="edit_community(<?php echo $community['id'];?>)">修改</button>
                                                <button type="button" class="btn btn-danger" onclick="delete_community(<?php echo $community['id'];?>)">删除</button>
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
