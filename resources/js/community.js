
/**
 * //废除! 通过form表单来search
 * 通过区id,社区名查找
 * @returns {undefined}
 */
 
//监听区的变化
$(document).ready(function(){ 
    $('#districtId').change(function(){ 
        var p1=$(this).children('option:selected').val();//这就是selected的值 

        //var districtUrl="/street/filterdistrict";
        window.location.href="/jiacheng/index.php/community/filterdistrict?p1="+p1;//页面跳转并传参 
     
    });

    $('#streetId').change(function(){ 
        var streetid=$(this).children('option:selected').val();//这就是selected的值 
        var districtid=$('#districtId').val();
        //var districtUrl="/community/filterstreet";
        window.location.href="/jiacheng/index.php/community/filterstreet?p1="+streetid+"&&p2="+districtid;//页面跳转并传参 
     
    });

    $('#insert_district_id').change(function(){
        //alert(1);
        //return;
        //var pd=$('#districtId option:selected').val(); 
        var pd=$(this).children('option:selected').val();
        //alert(pd);
        var changeURL="/jiacheng/index.php/community/getStreet";
        $.ajax({
            type:"POST",
            url:changeURL,
            data:{"districtid":pd},
            dataType: "json",
            async:true,
            success:function(data){  
                //alert(data);

                html="";
                for(var i=0;i<data.length;i++)
                    html+="<option value="+data[i].id+">"+data[i].name+"</option>";
                $('#insert_street_id').html(html);
                $('#insert_street_id').selectpicker('refresh');
                
            }
        });
         
    });

});

/**
 * 关闭弹出层
 * @returns {undefined}
 */
function close_view(){
    $("#editView").hide();
    $("#insertView").hide();
} 

/**
 * 弹出添加层
 * @returns {undefined}
 */
function insert_show(){
    $("#insertView").show();
}

/**
 * 添加社区
 * @returns {undefined}
 */
function insert_community(){
    var name=$("#insert_community_name").val();
    var streetId = $("#insert_street_id").val();
    var community_location=$("#insert_community_location").val();
    var insertURL = "/jiacheng/index.php/community/insertCommunity";
    $.ajax({
        type:"POST",
        url:insertURL,
        data:{"name":name,"streetId":streetId,"location":community_location},
        dataType: "json",
        async:true,
        success:function(data){  
            if(data>0){
                close_view();
                layer.msg('保存成功',{time: 1200}); 
            }
            else{
                close_view();
                layer.msg('保存失败',{time: 1200});  
            }
            setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
                window.location.reload();//页面刷新
            },1000); 
        }
    });
}

/**
 * 通过id显示编辑街道
 * @param {type} id
 * @returns {undefined}
 */
function edit_community(id){
    
    $("#editView").show();
    $("#edit_community_id").val(id);
    //var editURL = "<?php echo site_url('district/getById')?>"
    var editURL = "/jiacheng/index.php/community/getById";
    $.ajax({
        type:"POST",
        url:editURL,
        data:{"id":id},
        dataType: "json",
        async:true,
        success:function(data){  
            $("#edit_community_name").val(data['community'].name);
             $("#edit_community_location").val(data['community'].location);
            //bootstrap-select 提供的方法
            $('#edit_district_id').selectpicker('val', data['district'].district);
              $('#edit_street_id').selectpicker('val', data['community'].street);

        }
    });
     
}

/**
 * 保存修改的社区信息
 * @returns {undefined}
 */
function update_community(){
    var id=$("#edit_community_id").val();
    var newName = $("#edit_community_name").val();
    var streetId = $("#edit_street_id").val();
    var newLocation = $("#edit_community_location").val();
    var updateURL = "/jiacheng/index.php/community/updateCommunity";
    $.ajax({
        type:"POST",
        url:updateURL,
        data:{"id":id,"newName":newName,"streetId":streetId,"newLocation":newLocation},
        dataType: "json",
        async:true,
        success:function(data){  
            if(data>=0){
                close_view();
                layer.msg('修改成功',{time: 1200}); 
            }
            else{
                close_view();
                layer.msg('操作失败',{time: 1200});  
            }
            setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
                window.location.reload();//页面刷新
            },1000);  
        }
    }); 
}

/**
 * 删除社区
 * @param {type} id
 * @returns {undefined}
 */
function delete_community(id){
    layer.confirm(
        '确定删除此条？', 
        {
            btn: ['确定','取消'] //按钮
        }, 
        function(){
            var deleteURL = "/jiacheng/index.php/community/deleteCommunity";
            $.ajax({
                type:"POST",
                url:deleteURL,
                data:{"id":id},
                dataType: "json",
                async:true,
                success:function(data){  
                    if(data>=0){
                        close_view();
                        layer.msg('删除成功',{time: 1200}); 
                    }
                    else{
                        close_view();
                        layer.msg('删除失败',{time: 1200});  
                    }
                    setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
                        window.location.reload();//页面刷新
                    },1500); 
                }
            });
        },
        function(){
            layer.close();
        }
    );
        
}