<html><body>
<?php
require "auth.php";
require "password.php";
check_cors();

if($auth)
{
  if(strlen($pwhash) > 0)
  {
    require_once("../../vendor/qrcode.php");
    $qr = QRCode::getMinimumQRCode($pwhash, QR_ERROR_CORRECT_LEVEL_Q);
    $qr->printHTML("10px");
    echo "<br>Raw API Token: <code>" . $pwhash . "</code>";
  }
  else
  {
  ?><p>没有设置密码？<?php
  }
}
else
{
?><p>授权失败!</p><?php
}
?>
</body>
</html>
