<?php
header("Content-Type: text/html;charset=utf-8");
function get_json()
{
  $info = array("lession" => "English", "name" => "Lily");
echo json_encode($info);
}

function post_json()
{
   $in = $_POST["user"]; // 这个时候的info是一个字符串
    $result = json_decode($in); // 这个时候的result已经被还原成对象
    $params = $result->name." ".$result->place; #传递给python脚本的入口参数
    $path = "python post.py "; //需要注意的是：末尾要加一个空格
    passthru($path . $params);

}
post_json();