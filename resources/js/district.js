
/**
 * 通过id显示编辑行政区(名字)
 * @param {type} id
 * @returns {undefined}
 */
function edit_district(id){
    $("#editView").show();
    $("#district_id").val(id);
    //var editURL = "<?php echo site_url('district/getById')?>"
    var editURL = "district/getById"
    $.ajax({
        type:"POST",
        url:editURL,
        data:{"id":id},
        dataType: "json",
        async:true,
        success:function(data){  
            $("#district_name").val(data.name);
        }
    }); 
}

/**
 * 保存编辑行政区信息
 * @returns {undefined}
 */
function update_district(){
    var id=$("#district_id").val();
    var newName = $("#district_name").val();
    var updateURL = "district/updateName";
    $.ajax({
        type:"POST",
        url:updateURL,
        data:{"id":id,"newName":newName},
        dataType: "json",
        async:true,
        success:function(data){  
            if(data>0){
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
 * 添加行政区
 * @returns {undefined}
 */
function insert_district(){
    var name=$("#insert_district_name").val();
    var insertURL = "district/insertDistrict";
    $.ajax({
        type:"POST",
        url:insertURL,
        data:{"name":name},
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
            /*setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
                window.location.reload();//页面刷新
            },1500); */
            html  ='';
            html +='  <tr>';
            html+='       <td>1</td>';
             html+='        <td>2</td>';
             html+='       <td>';
              html+='          <div class="btn-group btn-group-sm">';
             html+='               <button type="button" class="btn btn-warning" onclick="edit_district(1)">修改</button>';
             html+='                  <button type="button" class="btn btn-danger" onclick="delete_district(1)">删除</button>';
             html+='              </div>';
             html+='          </td>';
            html+='       </tr>';
            
           $("#district_table").append(html);
        }
    });
}


/**
 * 通过ID删除行政区
 * @param {type} id
 * @returns {undefined}
 */
function delete_district(id){
    layer.confirm(
        '确定删除此条？', 
        {
            btn: ['确定','取消'] //按钮
        }, 
        function(){
            var deleteURL = "district/deleteDistrict"
            $.ajax({
                type:"POST",
                url:deleteURL,
                data:{"id":id},
                dataType: "json",
                async:true,
                success:function(data){  
                    if(data>0){
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

