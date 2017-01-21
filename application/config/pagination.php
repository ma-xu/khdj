<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//下面是一个参数列表，你可以通过初始化方法来定制你喜欢的显示效果。
 
$config['num_links'] = 2;
//放在你当前页码的前面和后面的“数字”链接的数量。比方说值为 2 就会在每一边放置 2 个数字链接，就像此页顶端的示例链接那样。

$config['use_page_numbers'] = TRUE;
//默认分页URL中是显示每页记录数,启用use_page_numbers后显示的是当前页码，如下：
 
$config['full_tag_open'] = '<ul class="pagination" style="margin-top:-5px;">';
//把打开的标签放在所有结果的左侧。
 
$config['full_tag_close'] = '</ul>';
//把关闭的标签放在所有结果的右侧。

//自定义起始链接
 
$config['first_link'] = '首页';
//你希望在分页的左边显示“第一页”链接的名字。如果你不希望显示，可以把它的值设为 FALSE 。
 
$config['first_tag_open'] = '<li>';
//“第一页”链接的打开标签。
 
$config['first_tag_close'] = '</li>';
//“第一页”链接的关闭标签。

//自定义结束链接
 
$config['last_link'] = '尾页';
//你希望在分页的右边显示“最后一页”链接的名字。如果你不希望显示，可以把它的值设为 FALSE 。
 
$config['last_tag_open'] = '<li>';
//“最后一页”链接的打开标签。
 
$config['last_tag_close'] = '</li>';
//“最后一页”链接的关闭标签。

//自定义“下一页”链接
 
$config['next_link'] = '>';
//你希望在分页中显示“下一页”链接的名字。如果你不希望显示，可以把它的值设为 FALSE 。
 
$config['next_tag_open'] = '<li>';
//“下一页”链接的打开标签。
 
$config['next_tag_close'] = '</li>';
//“下一页”链接的关闭标签。

//自定义“上一页”链接
 
$config['prev_link'] = '<';
//你希望在分页中显示“上一页”链接的名字。如果你不希望显示，可以把它的值设为 FALSE 。
 
$config['prev_tag_open'] = '<li>';
//“上一页”链接的打开标签。
 
$config['prev_tag_close'] = '</li>';
//“上一页”链接的关闭标签。

//“当前页”链接的打开标签。
 
$config['cur_tag_open'] = '<li class="active"><a href="#">';
//“当前页”链接的打开标签。
 
$config['cur_tag_close'] = '<span class="sr-only">（current）</span></a></li>';
//“当前页”链接的关闭标签。

//自定义“数字”链接
 
$config['num_tag_open'] = '<li>';
//“数字”链接的打开标签。
 
$config['num_tag_close'] = '</li>';
//“数字”链接的关闭标签。

//$config['first_link'] = '首页';
//$config['last_link'] = '尾页';
//$config['next_link'] = '下一页';
//$config['prev_link'] = '上一页';
$config['per_page']=6;