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

  if($jud==1){
      do {
          $code=rand(10000, 99999);
          $sql="SELECT *
      FROM appointment
      WHERE serial ='".$_GET['id']."'
      and win <> '".'0'."'
      ";
          $result = mysqli_query($conn,$sql);
      }while($row=mysqli_fetch_array($result));

      $sql = "INSERT INTO appointment (name, identify, tel, number, period_id, serial) values
      ('".$name."','".$indentify."', '".$tel."', '".$number."', '".$peroid_id."', '".$code."')";
      if ($conn->query($sql) === TRUE) {
          echo "<script>alert('预约成功，你的预约编号为$code')</script>";
      } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
      }
  }

   $conn->close();
?>
