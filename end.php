//end。php

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
$sql="SELECT * FROM peroid WHERE test ='".'1'."'";
$result = mysqli_query($conn,$sql);
if($row=mysqli_fetch_array($result)){
    $id=$row[0];
    $count=$row[4];
    $sql="UPDATE peroid SET test = 2 WHERE test ='".'1'."'";
    if ($conn->query($sql) === TRUE) {
        echo "已结束当前进行中的预约，进行抽签操作";
    }
    $sql="SELECT * FROM appointment WHERE period_id ='".$id."'";
    $result = mysqli_query($conn,$sql);
    while($row=mysqli_fetch_array($result)){
        if($row[3]<$count){
            $count--;
            $sql="UPDATE appointment SET win ='".$row[3]."'WHERE id ='".$row[0]."'";
            if ($conn->query($sql) === TRUE) {
                echo $row[7]."获得".$row[3]."个口罩购买资格</br>";
            }
        }
        else{
            $sql="UPDATE appointment SET win ='".$count."'WHERE id ='".$row[0]."'";
            if ($conn->query($sql) === TRUE) {
                echo $row[7]."获得".$count."个口罩购买资格</br>";
            }
            break;
        }
    }
}
$conn->close();
