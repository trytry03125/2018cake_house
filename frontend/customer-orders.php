<?php
session_start();
require_once('../connection/connection.php');
$query=$db->query("SELECT*FROM customer_orders WHERE members_id=".$_SESSION['member']['members_id']." ORDER BY order_date DESC");
$data=$query->fetchAll(PDO::FETCH_ASSOC);
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
                        <li>我的訂單</li>
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

                <div class="col-md-9" id="customer-orders">

                    <div class="box">
                        <h1>我的訂單</h1>

                        <p class="lead">以下是您的訂單</p>
                        <p class="text-muted">若有任何問題請至 <a href="contact.php">聯絡我們</a>填寫表單</p>

                        <hr>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>訂單編號</th>
                                        <th>訂購日期</th>
                                        <th>總金額</th>
                                        <th>運費</th>
                                        <th>訂單狀態</th>
                                        <th>訂單明細</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data as $customer_orders){ ?>
                                    <tr>
                                        <th><?php echo$customer_orders['order_no']; ?></th>
                                        <td><?php echo$customer_orders['order_date']; ?></td>
                                        <td>$NT<?php echo$customer_orders['total_price']; ?></td>
                                        <td>$NT<?php echo$customer_orders['shipping']; ?></td>
                                        <td>
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
                                        </td>
                                        <td><a href="customer-order.php?detail=<?php echo$customer_orders['customer_orders_id']; ?>" class="btn btn-primary btn-sm">觀看詳細</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                   
                                </tbody>
                            </table>
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
