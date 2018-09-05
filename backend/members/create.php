<?php
require_once('../function/login_check.php'); 
require('../../connection/connection.php');?>
<?php 
if(isset($_POST['AddFrom']) && $_POST['AddFrom'] == "INSERT"){
  $sql= "INSERT INTO members
            (account,
            password,
            name,
            phone,
            birthday,
            genter,
            email,
            county,
            zipcode,
            address) VALUES (
            :account,
            :password,
            :name,
            :phone,
            :birthday,
            :genter,
            :email,
            :county,
            :zipcode,
            :address)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":account", $_POST['account'], PDO::PARAM_STR);
  $sth ->bindParam(":password", $_POST['password'], PDO::PARAM_STR);
  $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
  $sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
  $sth ->bindParam(":birthday", $_POST['birthday'], PDO::PARAM_STR);
  $sth ->bindParam(":genter", $_POST['genter'], PDO::PARAM_STR);
  $sth ->bindParam(":email", $_POST['email'], PDO::PARAM_STR);
  $sth ->bindParam(":county", $_POST['county'], PDO::PARAM_STR);
  $sth ->bindParam(":zipcode", $_POST['zipcode'], PDO::PARAM_STR);
  $sth ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
  $sth ->execute();

  header('Location: list.php');
}
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
          <h1 class="">會員管理</h1>
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
              <a href="#">主控台</a>
            </li>
            <li class="breadcrumb-item">會員管理</li>
            <li class="breadcrumb-item active">新增</li>
          </ul>
          <a href="list.php" class="btn btn-outline-primary m-2">回上一頁</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form class="" action="create.php" method="POST" data-toggle="validator"> 
            <div class="form-group form-row">
              <label class="col-sm-2 col-form-label">帳號</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="account" data-error="請輸入帳號" required>
                <div class="help-block with-errors alert-danger"></div>
                </div>
            </div>
            <div class="form-group form-row">
              <label class="col-sm-2 col-form-label">密碼</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="password" data-error="請輸入密碼" required>
                <div class="help-block with-errors alert-danger"></div>
              </div>
            </div>
            <div class="form-group form-row">
              <label class="col-sm-2 col-form-label">姓名</label>  
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" data-error="請輸入姓名" required>
                <div class="help-block with-errors alert-danger"></div>
              </div>
            </div>
            <div class="form-group form-row">
              <label class="col-sm-2 col-form-label">電話</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="phone" data-error="請輸入電話" required>
                <div class="help-block with-errors alert-danger"></div>
              </div>
            </div>
            <div class="form-group form-row">
              <label class="col-sm-2 col-form-label">生日</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="birthday">
              </div>
            </div>
            <div class="form-group form-row">
              <label class="col-sm-2 col-form-label">性別</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="genter" data-error="請輸入性別" required>
                <div class="help-block with-errors alert-danger"></div>
              </div>
            </div>
            <div class="form-group form-row">
              <label class="col-sm-2 col-form-label">電子郵件</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="email" data-error="請輸入電子郵件" required>
                <div class="help-block with-errors alert-danger"></div>
              </div>
            </div>
            <div class="form-group form-row">
              <label class="col-sm-2 col-form-label">國家</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="county">
              </div>
            </div>
            <div class="form-group form-row">
              <label class="col-sm-2 col-form-label">郵遞區號</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="zipcode">
              </div>
            </div>
            <div class="form-group form-row">
              <label class="col-sm-2 col-form-label">地址</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="address" data-error="請輸入地址" required>
                <div class="help-block with-errors alert-danger"></div>
              </div>
            </div>
            <div class="col-md-12 text-right">
              <input type="reset" class="btn btn-primary" value="取消並回上一頁">
              <button type="submit" class="btn btn-primary">確認送出</button>
              <input type="hidden" name="created_at" value="<?php date('Y-m-d H-i-s'); ?>">
              <input type="hidden" name="AddFrom" value="INSERT" >
            </div>
          </form>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12"> </div>
      </div>
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
  <script src="../../js/validator.js"></script>
</body>

</html>