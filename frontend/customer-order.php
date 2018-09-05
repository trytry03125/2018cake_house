<?php
session_start();
require_once('../connection/connection.php');
// $query=$db->query("SELECT*FROM order_details WHERE customer_orders_id=".$_GET['detail']);
// $data=$query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cake House 帶給你最天然健康的幸福滋味">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>Cake House : 帶給你最天然健康的幸福滋味</title>

    <?php require_once('template/head_files.php'); ?>

</head>

<body>

<?php require_once('template/navbar.php'); ?>

    <div id="all">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                        <li><a href="../index.php">首頁</a>
                        </li>
                        <li><a href="javascript:history.back()">我的訂單</a>
                        </li>
                        <?php
                        $query=$db->query("SELECT*FROM customer_orders WHERE customer_orders_id=".$_GET['detail']);
                        $data=$query->fetchAll(PDO::FETCH_ASSOC);
                        foreach($data as $customer_orders){}
                        ?>
                        <li>訂單<?php echo$customer_orders['order_no']; ?></li>
                    </ul>

                </div>

                <div class="col-md-3">
                    <!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->
                    <div class="panel panel-default sidebar-menu">

                        <div class="panel-heading">
                            <h3 class="panel-title">會員專區</h3>
                        </div>

                        <div class="panel-body">

                            <ul class="nav nav-pills nav-stacked">
                                <li class="active">
                                    <a href="customer-orders.php"><i class="fa fa-list"></i> 我的訂單</a>
                                </li>
                                <li>
                                    <a href="customer-account.php"><i class="fa fa-user"></i> 我的資料</a>
                                </li>
                                <li>
                                    <a href="logout.php"><i class="fa fa-sign-out"></i> 登出</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <!-- /.col-md-3 -->

                    <!-- *** CUSTOMER MENU END *** -->
                </div>

                <div class="col-md-9" id="customer-order">
                    <div class="box">
                        <h1>訂單<?php echo$customer_orders['order_no']; ?></h1>

                        <p class="lead">訂單 <?php echo$customer_orders['order_no']; ?> 於 <strong><?php echo$customer_orders['order_date']; ?></strong> 成立，目前狀態為
                            <strong>
                                <?php if($customer_orders['status']==0){ ?>
                                <span class="label label-info">待付款</span>

                                <?php }else if($customer_orders['status']==1){ ?>
                                <span class="label label-success">貨物已送達</span>

                                <?php }else if($customer_orders['status']==2){ ?>
                                <span class="label label-danger">取消訂單</span>

                                <?php }else if($customer_orders['status']==3){ ?>
                                <span class="label label-warning">出貨中</span>

                                <?php }else if($customer_orders['status']==4){ ?>
                                <span class="label label-warning">運送中</span>
                                <?php } ?>
                            </strong>
                        </p>
                        <p class="text-muted">有任何問題請 <a href="contact.php">聯絡我們</a>, 我們將盡快回覆您</p>

                        <hr>

                        <?php
                        $query=$db->query("SELECT*FROM order_details WHERE customer_orders_id=".$_GET['detail']);
                        $data=$query->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="3">產品名稱</th>
                                        <th>數量</th>
                                        <th>單價</th>
                                        <th>小計</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    <?php
                                    $sum=0;
                                    foreach($data as $order_detail){
                                    ?>
                                    <tr>
                                        <td colspan="2">
                                            <a href="#">
                                                <img src="../uploads/products/<?php echo$order_detail['picture']; ?>" alt="">
                                            </a>
                                        </td>
                                        <td><a href="#"><?php echo$order_detail['name']; ?></a>
                                        </td>
                                        <td><?php echo$order_detail['quantity']; ?></td>
                                        <td>$NT<?php echo$order_detail['price']; ?></td>
                                        <?php $total_price=$order_detail['quantity']*$order_detail['price']; ?>
                                        <td>$NT<?php echo $total_price; ?></td>
                                    </tr>
                                    <?php
                                    $sum += $total_price;
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-left">訂單總計</th>
                                        <th>$NT<?php echo $sum; ?></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-left">運費</th>
                                        <th>
                                            $NT<?php
                                            $query=$db->query("SELECT*FROM customer_orders WHERE customer_orders_id=".$_GET['detail']);
                                            $data=$query->fetchAll(PDO::FETCH_ASSOC);
                                            foreach($data as $delivery_method){};
                                            if($delivery_method['delivery']=='宅配'){
                                                $shipping_price=100;
                                            }else if($delivery_method['delivery']=='超商取貨'){
                                                $shipping_price=150;
                                            }else if($delivery_method['delivery']=='貨到付款'){
                                                $shipping_price=200;
                                            }

                                            if($sum >= 2000){
                                            $shipping = 0;
                                            }else{
                                            $shipping= $shipping_price;
                                            }
                                            echo $shipping;
                                            ?>
                                        </th>
                                    </tr>
                                   
                                    <tr>
                                        <th colspan="5" class="text-left">合計</th>
                                        <th>$NT<?php echo $sum+$shipping; ?></th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                        <!-- /.table-responsive -->

                        <div class="row addresses">
                            <div class="col-md-12">
                                <h2>收件者資訊</h2>
                                <p><?php echo$_SESSION['member']['name']; ?>
                                    <br><?php echo$_SESSION['member']['mobile']; ?>
                                    <br><?php echo$_SESSION['member']['zipcode']; ?>
                                    <br><?php echo$_SESSION['member']['county']; ?>
                                    <br><?php echo$_SESSION['member']['district']; ?>
                                    <br><?php echo$_SESSION['member']['address']; ?></p>
                            </div>
                            
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


       <?php require_once('template/footer.php'); ?>



</body>

</html>
