
/**
 * //废除! 通过form表单来search
 * 通过区id,街道名查找
 * @returns {undefined}
 */
 /*
function search(){
    var districtId = $("#districtId").val();
    var streetName = $("#streetName").val();
    var selectURL = "street/getSearch";
    
    var editURL = '<?php echo site_url('street/getSearch')?>';
    //var searchURL = "street/getSearch";
    $.ajax({
        type:"POST",
        url:searchURL,
        data:{"districtId":districtId,"streetName":streetName},
        dataType: "json",
        async:true,
        success:function(data){  
            alert(data);
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert(XMLHttpRequest.status);
            alert(XMLHttpRequest.readyState);
            alert(textStatus);
        }
    }); 
    
    
}
*/
//监听区的变化
$(document).ready(function(){ 
$('#districtId').change(function(){ 
var p1=$(this).children('option:selected').val();//这就是selected的值 

//var districtUrl="/street/filterdistrict";
window.location.href="/jiacheng/index.php/street/filterdistrict?p1="+p1;//页面跳转并传参 
 
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
 * 添加街道
 * @returns {undefined}
 */
function insert_street(){
    var name=$("#insert_street_name").val();
    var districtId = $("#insert_district_id").val();
    var insertURL = "/jiacheng/index.php/street/insertStreet";
    $.ajax({
        type:"POST",
        url:insertURL,
        data:{"name":name,"districtId":districtId},
        dataType: "json",
        async:true,
        success:function(data){  
            if(data>=0){
                close_view();
                layer.msg('保存成功',{time: 1200}); 
            }
            else{
                close_view();
                layer.msg('保存失败',{time: 1200});  
            }
            setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
                window.location.reload();//页面刷新
            },1500); 
        }
    });
}

/**
 * 通过id显示编辑街道
 * @param {type} id
 * @returns {undefined}
 */
function edit_street(id){
    $("#editView").show();
    $("#edit_street_id").val(id);
    //var editURL = "<?php echo site_url('district/getById')?>"
    var editURL = "street/getById";
    $.ajax({
        type:"POST",
        url:editURL,
        data:{"id":id},
        dataType: "json",
        async:true,
        success:function(data){  
            $("#edit_street_name").val(data.name);
            //bootstrap-select 提供的方法
            $('#edit_district_id').selectpicker('val', data.district);
        }
    }); 
}

/**
 * 保存修改的街道信息
 * @returns {undefined}
 */
function update_street(){
    var id=$("#edit_street_id").val();
    var newName = $("#edit_street_name").val();
    var districtId = $("#edit_district_id").val();
    var updateURL = "/jiacheng/index.phps/treet/updateStreet";
    $.ajax({
        type:"POST",
        url:updateURL,
        data:{"id":id,"newName":newName,"districtId":districtId},
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
            },1500);  
        }
    }); 
}

/**
 * 删除街道
 * @param {type} id
 * @returns {undefined}
 */
function delete_street(id){
    layer.confirm(
        '确定删除此条？', 
        {
            btn: ['确定','取消'] //按钮
        }, 
        function(){
            var deleteURL = "/jiacheng/index.phpstreet/deleteStreet";
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