
/**
 * //废除! 通过form表单来search
 * 通过区id,社区名查找
 * @returns {undefined}
 */
 
//监听区的变化
$(document).ready(function(){ 
    $('#familyId').change(function(){ 
        var p1=$(this).children('option:selected').val();//这就是selected的值 

        //var districtUrl="/street/filterdistrict";
        window.location.href="/jiacheng/index.php/user/filterfamily?p1="+p1;//页面跳转并传参 
     
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
function insert_user(){
    var name=$('#insert_user_name').val();
    //var sex = document.getElementsByName("sex"); 
    var sex=$("input[name='sex']:checked").val(); 
    //alert(sex);
    var age=$('#insert_user_age').val();
    var mobile=$('#insert_user_mobile').val();
    var familyId=$('#insert_family_id').val();
    var staffcode=$("#insert_user_staffcode").val();
    //var password=$("#insert_user_password").val();
    var insertURL = "/jiacheng/index.php/user/insertUser";
    $.ajax({
        type:"POST",
        url:insertURL,
        data:{"name":name,"sex":sex,"age":age,"mobile":mobile,"familyId":familyId,"staffcode":staffcode},
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
function edit_user(id){
    
    $("#editView").show();
    $("#edit_user_id").val(id);
    //var editURL = "<?php echo site_url('district/getById')?>"
    var editURL = "/jiacheng/index.php/user/getById";
    $.ajax({
        type:"POST",
        url:editURL,
        data:{"id":id},
        dataType: "json",
        async:true,
        success:function(data){  
            $("#edit_user_name").val(data['user'].name);
            if(data['user'].sex=='男')
               $("#sex1").attr("checked", "checked"); 
            else
               $("#sex2").attr("checked", "checked"); 
            $("#edit_user_age").val(data['user'].age);
            $("#edit_user_mobile").val(data['user'].mobile);
            $("#edit_user_staffcode").val(data['user'].staffcode);
            $("#edit_user_username").val(data['user'].username);
            $("#edit_user_password").val(data['user'].password);
            //bootstrap-select 提供的方法
            $('#edit_family_id').selectpicker('val', data['user'].family);
              

        }
    });
     
}

/**
 * 保存修改的社区信息
 * @returns {undefined}
 */
function update_user(){
    var id=$("#edit_family_id").val();
    var newName = $("#edit_user_name").val();
    var sex = $("input[name='sex']:checked").val();
    var age= $("#edit_user_age").val();
    var familyId = $("#edit_family_id").val();
    var mobile=$("#edit_user_mobile").val();
    var staffcode=$("#edit_user_staffcode").val();
    var username = $("#edit_user_username").val();
    var password = $("#edit_user_password").val();
    var updateURL = "/jiacheng/index.php/user/updateUser";
    $.ajax({
        type:"POST",
        url:updateURL,
        data:{"id":id,"newName":newName,"sex":sex,"age":age,"mobile":mobile,"familyId":familyId,"staffcode":staffcode,"username":username,"password":password},
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
function delete_user(id){
    layer.confirm(
        '确定删除此条？', 
        {
            btn: ['确定','取消'] //按钮
        }, 
        function(){
            var deleteURL = "/jiacheng/index.php/user/deleteUser";
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