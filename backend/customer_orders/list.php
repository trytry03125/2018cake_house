<?php
 require_once('../function/login_check.php');
 require('../../connection/connection.php');
 $limit = 5;
if (isset($_GET["page"])) {
   $page  = $_GET["page"]; 
  } else {
     $page=1;
     };
$start_from = ($page-1) * $limit;
$query = $db->query("SELECT * FROM customer_orders WHERE status=".$_GET['status']." ORDER BY order_date DESC LIMIT ".$start_from.",".$limit);
$data = $query->fetchAll(PDO::FETCH_ASSOC);
$totalrows =count($data);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="../css/theme.css" type="text/css"> </head>

<body>
<?php require_once('../function/backend_nav.php');?>
  <div class="py-5">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="">訂單管理-
          <?php switch($_GET['status']){

                  case 0;
                  echo "新訂單";
                  break;
                  case 1;
                  echo "已付款訂單";
                  break;
                  case 2;
                  echo "已出貨訂單";
                  break;
                  case 3;
                  echo "交易完成訂單";
                  break;
                  case 99;
                  echo "取消訂單";
                  break;
                 }
              ?>
          </h1>
        </div>
      </div>
    </div>
  </div>
  <div class="py-5 text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-left">
          <ul class="breadcrumb" style="margin-bottom: 0px; margin-top: 0px;">
            <li class="breadcrumb-item">
              <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item active">訂單管理</li>
          </ul>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
        <?php if($totalrows > 0) {?>
          <table class="table">
            <thead>
              <tr>
                <th>訂單編號</th>
                <th>訂單日期</th>
                <th>總金額</th>  
                <th>付款狀態</th>
                <th>姓名</th>
                <th>電話</th>
                <th>地址</th>
                <th>備註</th>
                <th width="20%">操作</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($data as $customer_orders){?>
              <tr>
                <td><?php echo $customer_orders['order_no'];?></td>
                <td><?php echo $customer_orders['order_date'];?></td>
                <td><?php echo $customer_orders['total_price'];?></td>
                <td><?php echo $customer_orders['status'];?></td>
                <td><?php echo $customer_orders['name'];?></td>
                <td><?php echo $customer_orders['phone'];?></td>
                <td><?php echo $customer_orders['zipcode'];?><?php echo $customer_orders['county'];?><?php echo $customer_orders['district'];?><?php echo $customer_orders['address'];?></td>
                <td><?php echo $customer_orders['memo'];?></td>
                <td>
                  <a href="../order_details/list.php?customer_orders_id=<?php echo $customer_orders['customer_orders_id'];?>" class="btn btn-outline-primary">檢視訂單明細</a>
                  <a href="edit.php?customer_orders_id=<?php echo $customer_orders['customer_orders_id'];?>" class="btn btn-outline-primary">編輯</a>
                </td>
              </tr>
              <?php }?>
            </tbody>
          </table>
              <?php }else{ ?>
              <p>目前無訂單</p>
              <?php } ?>
        </div>
      </div>

      <?php  if($totalrows > 0){
            $sth = $db->query("SELECT * FROM customer_orders WHERE status=".$_GET['status']." ORDER BY order_date ASC ");
            $data_count = count($sth ->fetchAll(PDO::FETCH_ASSOC));
            $total_pages = ceil($data_count / $limit); // 無條件進位
           ?>
      <div class="row">
        <div class="col-md-12">
          <ul class="pagination">
          <?php   if($page > 1){ ?>
            <li class="page-item">
             <!-- 頁數超過一 上一頁可連結 -->
              <a class="page-link" href="list.php?status=<?php echo$_GET['status']; ?>&&&page=<?php echo $page-1;?>">
                <span>«</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <?php }else{ ?>
            <!-- 頁數沒超過 1 上一頁按鈕不可做連結 -->
              <li>
                <span  class="page-link">«</span>
              </li>
              <?php } ?>
            <?php for ($i=1; $i<=$total_pages; $i++) { ?>
            <li class="page-item">
              <a class="page-link" href="list.php?status=<?php echo$_GET['status']; ?>&&&page=<?php echo $i;?>"><?php echo $i;?></a>
              </li>
            <?php }?>
            <?php if($page < $total_pages){ ?>
            <li class="page-item">
              <a class="page-link" href="list.php?status=<?php echo$_GET['status']; ?>&&&page=<?php echo $page+1;?>">
                <span>»</span>
              </a>
            </li>
              <?php }else{ ?>
                <li>
                  <span class="page-link">»</span>
                </li>
                <?php } ?>
          </ul>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>

  <div class="py-5 bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-3 text-center">
          <p>© Copyright 2018 MacroViz - All rights reserved.</p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
</body>
</html>