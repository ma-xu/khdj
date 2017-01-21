<!DOCTYPE html>
<html>

<head>
    <!--左侧导航开始-->
    <?php include 'include/resources.php';?>
    <!--左侧导航结束-->
    <script src="<?=base_url().'resources/js/street.js'?>"></script>
    
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
                            <h4 class="modal-title">添加街道</h4>
                        </div>
                        <div class="modal-body ui-front" style="min-height: 200px;">
                            
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">行政区：</label>
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
                                    <label class="col-sm-3 control-label">街道名：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="insert_street_name">
                                    </div>
                                </div>
                                
                                <div class="form-group" >
                                    <div class="col-sm-offset-3 col-sm-8">
                                        <button class="btn  btn-warning" style="margin-top: 10px;margin-bottom:10px;" onclick="insert_street()">保存</button>
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
                            <h4 class="modal-title">修改街道</h4>
                        </div>
                        <div class="modal-body ui-front" style="min-height: 200px;">
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
                                    <label class="col-sm-3 control-label">街道名：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="edit_street_name">
                                        <input type="hidden" id="edit_street_id">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <div class="col-sm-offset-3 col-sm-8">
                                        <button class="btn  btn-warning" style="margin-top: 10px;margin-bottom:10px;" onclick="update_street()">修改</button>
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
                        <h5>街道管理&nbsp;&nbsp;&nbsp;&nbsp;总街道数：<?php echo $total_counts;?></h5>
                      
                    </div>
                    <div class="ibox-content">
                        <div class="row"> 
                            <div class="btn-group col-sm-8">
                                <button type="button" class="btn btn-primary" onclick="insert_show()">添加</button>
                            </div>
                            
                                <div class="row col-sm-4">
                                    <div class="col-sm-6">
                                        <select class="selectpicker" id="districtId" name="districtId" data-style="btn-success" data-width="100%">
                                            <option value="0">请选择区</option>
                                            <?php foreach($districts as $district):?> 
                                            <?php if($choseid!=''&&$district['id']==$choseid){ ?>
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
                                    <div class="col-sm-6">
                                        <form method="post" action="<?=site_url('street/getSearch')?>">
                                        <div class="input-group ">
                                            <input type="text" placeholder="街道名" id="streetName" name="streetName" class="input-sm form-control"> 
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-sm btn-primary" > 搜索</button> 
                                            </span>
                                        </div>
                                        </form>
                                    </div>
                                </div> 
                            
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>街道名</th>
                                        <th>隶属区名</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($streets as $street):?> 
                                    <tr>
                                        
                                        <td><?php echo $street['id'];?></td>
                                        <td><?php echo $street['name'];?></td>
                                        <td><?php echo $street['districtName'];?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn btn-warning" onclick="edit_street(<?php echo $street['id'];?>)">修改</button>
                                                <button type="button" class="btn btn-danger" onclick="delete_street(<?php echo $street['id'];?>)">删除</button>
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
