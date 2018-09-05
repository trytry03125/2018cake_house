<?php
$to      = "trytry03125@gmail.com";

  		$header  = 'Content-type: text/html; charset=iso-8859-1'."\r\n";
  		$header .= "From: service@gmail.com";

  		$subject = "[Cake House] 客戶意見";
  		$body    = "您有一封來自 ".$_POST['name']." 客戶意見,<br><br>";
  		$body   .= "內容如下<br>";
  		$body   .= "<table>
                    <tr><td>姓名:</td><td>".$_POST['name']."</td></tr>
                    <tr><td>聯絡電話:</td><td>".$_POST['mobile']."</td></tr>
                    <tr><td>E-mail:</td><td>".$_POST['email']."</td></tr>
                    <tr><td>詢問內容:</td><td>".$_POST['message']."</td></tr>
                    </table><br>";
        $body   .= "請您盡快與客戶聯繫";
          


          mail($to, $subject, $body, $header);

          $to2      = $_POST['email'];

  		$header2  = 'Content-type: text/html; charset=iso-8859-1'."\r\n";
  		$header2 .= "From: service@gmail.com";

  		$subject2 = "[Cake House] 意見回復";
  		$body2    = "您有一封來自Cake House意見回復,<br><br>";
  		$body2  .= "內容如下<br>";
        $body2   .= "test";
          


          mail($to2, $subject2, $body2, $header2);
?>