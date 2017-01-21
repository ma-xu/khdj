<!DOCTYPE html>
<html>

<head>
    <!--左侧导航开始-->
    <?php include 'include/resources.php';?>
    <!--左侧导航结束-->
    <script src="<?=base_url().'resources/js/district.js'?>"></script>
    
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
                            <h4 class="modal-title">添加行政区</h4>
                        </div>
                        <div class="modal-body ui-front" style="min-height: 200px;">
                            
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">区名：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="insert_district_name">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <div class="col-sm-offset-3 col-sm-8">
                                        <button class="btn  btn-warning" style="margin-top: 10px;margin-bottom:10px;" onclick="insert_district()">保存</button>
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
                            <h4 class="modal-title">修改行政区</h4>
                        </div>
                        <div class="modal-body ui-front" style="min-height: 200px;">
                            
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">区名：</label>

                                    <div class="col-sm-8">
                                        <input class="form-control" id="district_name">
                                        <input type="hidden" id="district_id">
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <div class="col-sm-offset-3 col-sm-8">
                                        <button class="btn  btn-warning" style="margin-top: 10px;margin-bottom:10px;" onclick="update_district()">修改</button>
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
                        <h5>行政区&nbsp;&nbsp;&nbsp;&nbsp;总行政区数：<?php echo $total_counts;?></h5>
                        
                    </div>
                    <div class="ibox-content">
                        <div class="row"> 
                            
                            <div class="btn-group col-sm-8">
                                <button type="button" class="btn btn-primary" onclick="insert_show()">添加</button>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <input type="text" placeholder="请输入关键词" class="input-sm form-control"> <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-primary"> 搜索</button> </span>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover" id='district_table'>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>区名</th>
                                        <th>操作</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($districts as $district):?> 
                                    <tr>
                                        <td><?php echo $district['id'];?></td>
                                        <td><?php echo $district['name'];?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <button type="button" class="btn btn-warning" onclick="edit_district(<?php echo $district['id'];?>)">修改</button>
                                                <button type="button" class="btn btn-danger" onclick="delete_district(<?php echo $district['id'];?>)">删除</button>
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
