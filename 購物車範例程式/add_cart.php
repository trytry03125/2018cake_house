<?php
session_start();
$is_existed = "false";
//判斷商品是否重覆
if(isset($_SESSION['Cart']) && $_SESSION['Cart'] != null){
  for($i = 0 ; $i < count($_SESSION['Cart']); $i++){
    if($_POST['productID'] == $_SESSION['Cart'][$i]['productID']){
      $is_existed = "true";
      goto_previousPage($is_existed);
    }
  }
}
if($is_existed == "false"){
  //將接收的商品資料存到$temp陣列
  $temp['productID']    = $_POST['productID'];
  $temp['name']         = $_POST['name'];
  $temp['picture']      = $_POST['picture'];
  $temp['price']        = $_POST['price'];
  $temp['quantity']     = $_POST['quantity'];
  //將陣列資料加入到session Cart中
  $_SESSION['Cart'][] = $temp;
  goto_previousPage($is_existed);
}
  function goto_previousPage($is_existed){
    $url= explode('?',$_SERVER['HTTP_REFERER']);
    $location = $url[0];
    $location.= "?productID=".$_POST['productID'];
    $location.= "&Existed=".$is_existed;

    header(sprintf('Location: %s ', $location));
  }
 ?>
