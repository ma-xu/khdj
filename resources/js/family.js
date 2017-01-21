
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
        window.location.href="/jiacheng/index.php/family/filterdistrict?p1="+p1;//页面跳转并传参 
     
    });

    $('#streetId').change(function(){ 
        var streetid=$(this).children('option:selected').val();//这就是selected的值 
        var districtid=$('#districtId').val();
        //var districtUrl="/community/filterstreet";
        window.location.href="/jiacheng/index.php/family/filterstreet?p1="+streetid+"&&p2="+districtid;//页面跳转并传参 
     
    });

    $('#communityId').change(function(){ 
        var communityid=$(this).children('option:selected').val();//这就是selected的值 
        var districtid=$('#districtId').val();
        var streetid=$('#streetId').val();
        window.location.href="/jiacheng/index.php/family/filtercommunity?p1="+streetid+"&&p2="+districtid+"&&p3="+communityid;//页面跳转并传参 
     
    });
    $('#insert_district_id').change(function(){
        //alert(1);
        //return;
        //var pd=$('#districtId option:selected').val(); 
        var pd=$(this).children('option:selected').val();
        //alert(pd);
        var changeURL="/jiacheng/index.php/family/getStreet";
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
                $('#insert_street_id').append(html);
                $('#insert_street_id').selectpicker('refresh');
                
            }
        });
         
    });
    $('#insert_street_id').change(function(){
        //alert(1);
        //return;
        
        var pf=$(this).children('option:selected').val();
       
        var changeURL="/jiacheng/index.php/family/getCommunity";
        $.ajax({
            type:"POST",
            url:changeURL,
            data:{"streetid":pf},
            dataType: "json",
            async:true,
            success:function(data){  
                //alert(data);

                html="";
                for(var i=0;i<data.length;i++)
                    html+="<option value="+data[i].id+">"+data[i].name+"</option>";
                $('#insert_community_id').html(html);
                $('#insert_community_id').selectpicker('refresh');
                
           },
           error:function(){
               alert('wrong');
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
function insert_family(){
    var code=$('#insert_family_code').val();
    var name=$('#insert_family_name').val();
    var location=$('#insert_family_location').val();
    //var streetId = $('#insert_street_id').val();
    //var districtId=$('#insert_district_id').val();
    var communityId=$('#insert_community_id').val();
    var insertURL = "/jiacheng/index.php/family/insertFamily";
    $.ajax({
        type:"POST",
        url:insertURL,
        data:{"code":code,"name":name,"communityId":communityId,"location":location},
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
function edit_family(id){
    
    $("#editView").show();
    $("#edit_family_id").val(id);
    //var editURL = "<?php echo site_url('district/getById')?>"
    var editURL = "/jiacheng/index.php/family/getById";
    $.ajax({
        type:"POST",
        url:editURL,
        data:{"id":id},
        dataType: "json",
        async:true,
        success:function(data){  
           
            $("#edit_family_code").val(data['family'].code);
            $("#edit_family_name").val(data['family'].name);
            $("#edit_family_location").val(data['family'].location);
             $("#edit_community_id").selectpicker('val', data['family'].community);
            //bootstrap-select 提供的方法
            $('#edit_district_id').selectpicker('val', data['street'].district);
              $('#edit_street_id').selectpicker('val', data['street'].id);

        },
        error:function(){
            alert('wrong');
        }
    });
     
}

/**
 * 保存修改的社区信息
 * @returns {undefined}
 */
function update_family(){
    var id=$('#edit_family_id').val();
    var newCode=$('#edit_family_code').val();
    var newName = $('#edit_family_name').val();
    var communityId = $('#edit_community_id').val();
    var newLocation = $('#edit_family_location').val();
    var updateURL = "/jiacheng/index.php/family/updateFamily";
    $.ajax({
        type:"POST",
        url:updateURL,
        data:{"id":id,"newCode":newCode,"newName":newName,"communityId":communityId,"newLocation":newLocation},
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
function delete_family(id){
    layer.confirm(
        '确定删除此条？', 
        {
            btn: ['确定','取消'] //按钮
        }, 
        function(){
            var deleteURL = "/jiacheng/index.php/family/deleteFamily";
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