<?php
header("Content-Type: text/html;charset = utf-8");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blogdemo2db";
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, 'utf8');
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
//验证本次是否已预约
  $sql="SELECT *
      FROM appointment
      WHERE identify ='".$_GET['id']."'
      and period_id ='".$_GET['period_id']."'
      ";
  $result = mysqli_query($conn,$sql);
  if($row=mysqli_fetch_array($result)){
      echo "<script>alert('本期已进行过预约 不可再次预约')</script>";
      $jud=0;
  }
//验证三期内是否含有预约成功
  $pre=[$_GET['period_id']-1,$_GET['period_id']-2,$_GET['period_id']-3];
  for($i=0;$i<count($pre);$i++){
      $sql="SELECT *
      FROM appointment
      WHERE identify ='".$_GET['id']."'
      and period_id ='".$pre[$i]."'
      and win ='".'1'."'";
      $result = mysqli_query($conn,$sql);
      if($row=mysqli_fetch_array($result)){
          echo "<script>alert('三期内含有中签预约 不可再次预约')</script>";
          $jud=0;
          break;
      }
  }


   $conn->close();
?>
