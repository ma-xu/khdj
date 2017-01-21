<!DOCTYPE html>
<html>

<head>
    <!--左侧导航开始-->
    <?php include 'resources.php';?>
    <!--左侧导航结束-->
    <script>
    $(document).ready(function(){
        //区的变化
        $('#district_id').change(function(){ 
           //将元素置空
           $("#street_id").html("<option value='0'>请选择</option>");
           $("#street_id").selectpicker('refresh');
           $("#community_id").html("<option value='0'>请选择</option>");
           $("#community_id").selectpicker('refresh');
           $("#family_select_id").html("<option value='0'>请选择</option>");
           $("#family_select_id").selectpicker('refresh');
           
           //
          // var streetURL = "street/getBydistrict";
           var streetURL = "<?php echo site_url('street/getBydistrict')?>";
            $.ajax({
                type:"POST",
                url:streetURL,
                data:{"districtId":$("#district_id").val()},
                dataType: "json",
                async:true,
                success:function(data){  
                    html="<option value='0'>请选择</option>";
                    for(var i in data){
                        street = data[i];
                        html+='<option value="'+street.id+'">'+street.name+'</option>';
                    }
                    $("#street_id").html(html); 
                    $("#street_id").selectpicker('refresh');
                }
            }); 
           
        });
        
        //街道的变化
        $('#street_id').change(function(){ 
            $("#community_id").html("<option value='0'>请选择</option>");
            $("#community_id").selectpicker('refresh');
            $("#family_select_id").html("<option value='0'>请选择</option>");
            $("#family_select_id").selectpicker('refresh');
           
            var communityURL = "<?php echo site_url('community/getByStreet')?>";
            $.ajax({
                type:"POST",
                url:communityURL,
                data:{"streetId":$("#street_id").val()},
                dataType: "json",
                async:true,
                success:function(data){  
                    html="<option value='0'>请选择</option>";
                    for(var i in data){
                        community = data[i];
                        html+='<option value="'+community.id+'">'+community.name+'</option>';
                    }
                    $("#community_id").html(html); 
                    $("#community_id").selectpicker('refresh');
                }
            }); 
            
            
        });
        
        //社区的变化
        $('#community_id').change(function(){
            $("#family_select_id").html("<option value='0'>请选择</option>");
            $("#family_select_id").selectpicker('refresh');
            
            var familyURL = "<?php echo site_url('family/getByCommunity')?>";
            $.ajax({
                type:"POST",
                url:familyURL,
                data:{"communityId":$("#community_id").val()},
                dataType: "json",
                async:true,
                success:function(data){  
                    html="<option value='0'>请选择</option>";
                    for(var i in data){
                        family = data[i];
                        html+='<option value="'+family.id+'">'+family.name+'</option>';
                    }
                    $("#family_select_id").html(html); 
                    $("#family_select_id").selectpicker('refresh');
                }
            });          
        });
        
        //家庭方式radio变化
        $(".family-radio").change(function(){
            var radioValue = $("input[name='family-radio']:checked").val(); 
            //select_family_form new_family_form
            if('select'==radioValue){
                $("#select_family_form").show();
                $("#new_family_form").hide();
                $("#family_select_id").selectpicker('refresh');
            }
            if('new'==radioValue){
                $("#select_family_form").hide();
                $("#new_family_form").show();
            }
        } );
        
        
        
        
        
        
    });
    
    </script>
    
</head>

<body>
    <form method="post" style="width:90%;margin :0 auto;" action="<?php echo site_url('mobile/login/register')?>">
        <div class="form-group">
            <div class="btn btn-warning btn-lg btn-block">加成健康注册</div>
        </div>
        <div class="form-group">
            <label>个人信息</label>  
            <div class="input-group">
                <div class="input-group-addon">&nbsp;&nbsp;姓&nbsp;&nbsp;&nbsp;名&nbsp;&nbsp;</div>
                <input class="form-control"  name="name">
            </div> 
            <div class="input-group">
                <div class="input-group-addon">&nbsp;&nbsp;手&nbsp;&nbsp;&nbsp;机&nbsp;&nbsp;</div>
                <input class="form-control" name="mobile">
            </div>

        </div>
        <div class="form-group">
            <label>登录信息</label>  
            <div class="input-group">
                <div class="input-group-addon">登录帐号</div>
                <input class="form-control" name="username" >
            </div> 
            <div class="input-group">
                <div class="input-group-addon">登录密码</div>
                <input type="password" class="form-control" name="password" >
            </div>

        </div>

        <div class="form-group">

            <label >地址</label>   
            <div class="input-group">
                <div class="input-group-addon">&nbsp;&nbsp;区&nbsp;&nbsp;&nbsp;域&nbsp;&nbsp;</div>
               <!-- <select class="form-control selectpicker" data-style="btn-success">-->
                <select class="form-control selectpicker" id="district_id" data-style="btn-success" >                        
                    <option value='0'>请选择</option>
                    <?php foreach($districts as $district):?> 
                    <option value="<?php echo $district['id'];?>" ><?php echo $district['name'];?></option>
                     <?php endforeach;?> 
                </select>

            </div>

            <div class="input-group">
                <div class="input-group-addon">&nbsp;&nbsp;街&nbsp;&nbsp;&nbsp;道&nbsp;&nbsp;</div>
                <select class="form-control selectpicker" id="street_id" data-style="btn-success">
                    <option value='0'>请选择</option>
                </select>
            </div>

            <div class="input-group">
                <div class="input-group-addon">&nbsp;&nbsp;社&nbsp;&nbsp;&nbsp;区&nbsp;&nbsp;</div>
                <select class="form-control selectpicker" name="communityId" id="community_id" data-style="btn-success">
                    <option value='0'>请选择</option>
                </select>
            </div>
        </div>       
        
        <div class="form-group">
            <label>家庭信息</label> 
            <label><input type="radio" value="select" checked="checked" name="family-radio" class="family-radio">选择家庭</label>
            <label><input type="radio" value="new"  name="family-radio" class="family-radio">新建家庭</label>
            <div class="input-group" id="select_family_form" name="familyId">
                <div class="input-group-addon">选择家庭</div>
                <select class="form-control selectpicker" name="familyId" id="family_select_id" data-style="btn-success">
                    <option value='0'>请选择</option>
                </select>
            </div> 
            <div id="new_family_form" style="display:none;">
                <div class="input-group">
                    <div class="input-group-addon">家庭名称</div>
                    <input class="form-control" name="familyName" placeholder="某某之家">
                </div> 
                <div class="input-group">
                    <div class="input-group-addon">具体地址</div>
                    <input class="form-control" name="familyAddress" >
                </div>
            </div>
        </div> 
        <div class="text-center col-md-6 col-md-offset-3 col-xs-8 col-xs-offset-2">
            <button type="submit" class="btn btn-warning btn-block">注&nbsp;&nbsp;册</button>
        </div>
    </form>
</body>
<script>
    
</script>
</html>
