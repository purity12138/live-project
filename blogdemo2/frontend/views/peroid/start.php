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
$sql="SELECT *
    FROM peroid
    WHERE test ='".'1'."'
    ";
$result = mysqli_query($conn,$sql);
if($row=mysqli_fetch_array($result)){
    $id=$row[0];
    $id++;
}
$sql="SELECT *
    FROM peroid
    WHERE id ='".$id."'
    ";
$result = mysqli_query($conn,$sql);
if($row=mysqli_fetch_array($result)){
    $sql="UPDATE peroid SET test = 1 WHERE id = '".$id."'
    ";
    if ($conn->query($sql) === TRUE) {
        echo "已开启下一个预约计划,或者已经存在两个同时进行的预约，请关闭其中一个后重新操作";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
else{
    echo '已无行的预约计划，请到后台去新建一个';
}
$conn->close();
