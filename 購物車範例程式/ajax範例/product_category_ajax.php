<?php
session_start();
require_once("../connection/database.php");
$sth = $db->query("SELECT * FROM product_category");
$categories = $sth->fetchAll(PDO::FETCH_ASSOC);
if(isset($_POST['product_categoryID']) && $_POST['product_categoryID'] != null){
  $sth2 = $db->query("SELECT * FROM product WHERE product_categoryID =".$_POST['product_categoryID']." ORDER BY createdDate DESC");
  $products = $sth2->fetchAll(PDO::FETCH_ASSOC);
}else{
  $sth2 = $db->query("SELECT * FROM product");
  $products = $sth2->fetchAll(PDO::FETCH_ASSOC);
}
 ?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>product - Cake House</title>
	<?php require_once("template/files.php"); ?>
</head>
<body>
	<div id="page">
		<?php require_once("template/header.php"); ?>
		<div id="body">
			<div class="header">
				<div>
					<h1>Products</h1>
				</div>
			</div>
			<div class="wrapper">
				<ol class="breadcrumb">
				  <li><a href="../index.php"><i class="fa fa-home" aria-hidden="true"></i></a></li>
				  <li class="active"><a href="#">蛋糕</a></li>
				</ol>

          <select id="category" name="category">
            <option value="0">全部商品</option>
            <?php foreach($categories as $row){ ?>
            <option value="<?php echo $row['product_categoryID']; ?>"><?php echo $row['category']; ?></option>
            <?php } ?>
          </select>

				<ul class="Category">
					<li><a href="product_no_category.php">全部商品</a></li>
					<?php foreach($categories as $row){ ?>
					<li><a href="product_category.php?product_categoryID=<?php echo $row['product_categoryID']; ?>"><?php echo $row['category']; ?></a></li>
					<?php } ?>
				</ul>
        <div class="row">
            <div class="col-md-4">
            </div><div class="col-md-4">
            </div>
            <div class="col-md-4">
                <form action="" class="search-form">
                    <div class="form-group has-feedback">
                		<label for="search" class="sr-only">搜尋產品</label>
                		<input type="text" class="form-control" name="search" id="search" placeholder="搜尋產品">
                  		<span class="glyphicon glyphicon-search form-control-feedback"></span>
                	</div>
                </form>
            </div>
        </div>
        <ul id="Products">

				</ul>
			</div>
		</div>
		<?php require_once("template/footer.php"); ?>
	</div>
  <script type="text/javascript">
    $(function(){
      console.log('select='+$('#category').val());
      $.ajax({
        type: 'POST',                     //GET or POST
        url: "category.php",  //請求的頁面
        data: { product_categoryID: $('#category').val() },
        dataType : 'json',
        success: function(result){   //處理回傳成功事件，當請求成功後此事件會被呼叫
            //var myObj = $.parseJSON(result);
            for(var i = 0; i < result.length; i++){
              $('#Products').append('<li><a href=\"product_content.php?productID='+ result[i]['productID']+'\"><img src="../uploads/products/'+ result[i]['picture']+'\" width="200" height="150" alt=""></a><a href=\"product_content.php?productID='+ result[i]['productID']+'\"><h2>'+ result[i]['name']+'</h2></a></li>');
    				}
            console.log(result[0]['name']);

        }
      });
      $('#category').change(function(){
        $.ajax({
          type: 'POST',                     //GET or POST
          url: "category.php",  //請求的頁面
          data: { product_categoryID: $('#category').val() },
          dataType : 'json',
          success: function(result){   //處理回傳成功事件，當請求成功後此事件會被呼叫
            $('#Products').empty();
            for(var i = 0; i < result.length; i++){
              $('#Products').append('<li><a href=\"product_content.php?productID='+ result[i]['productID']+'\"><img src="../uploads/products/'+ result[i]['picture']+'\" width="200" height="150" alt=""></a><a href=\"product_content.php?productID='+ result[i]['productID']+'\"><h2>'+ result[i]['name']+'</h2></a></li>');
            }
              console.log(result[0]['name']);

          }
        });
      });

    });
  </script>
</body>
</html>
