<?php
//验证身份证是否有效
function validateIDCard($IDCard) {
    if (strlen($IDCard) == 18) {
        return check18IDCard($IDCard);
    } elseif ((strlen($IDCard) == 15)) {
        $IDCard = convertIDCard15to18($IDCard);
        return check18IDCard($IDCard);
    } else {
        return false;
    }
}

//计算身份证的最后一位验证码,根据国家标准GB 11643-1999
function calcIDCardCode($IDCardBody) {
    if (strlen($IDCardBody) != 17) {
        return false;
    }
    
    //加权因子
    $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
    //校验码对应值
    $code = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
    $checksum = 0;
    
    for ($i = 0; $i < strlen($IDCardBody); $i++) {
        $checksum += substr($IDCardBody, $i, 1) * $factor[$i];
    }
    
    return $code[$checksum % 11];
}

// 将15位身份证升级到18位
function convertIDCard15to18($IDCard) {
    if (strlen($IDCard) != 15) {
        return false;
    } else {
        // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
        if (array_search(substr($IDCard, 12, 3), array('996', '997', '998', '999')) !== false) {
            $IDCard = substr($IDCard, 0, 6) . '18' . substr($IDCard, 6, 9);
        } else {
            $IDCard = substr($IDCard, 0, 6) . '19' . substr($IDCard, 6, 9);
        }
    }
    $IDCard = $IDCard . calcIDCardCode($IDCard);
    return $IDCard;
}

// 18位身份证校验码有效性检查
function check18IDCard($IDCard) {
    if (strlen($IDCard) != 18) {
        return false;
    }
    
    $IDCardBody = substr($IDCard, 0, 17); //身份证主体
    $IDCardCode = strtoupper(substr($IDCard, 17, 1)); //身份证最后一位的验证码
    
    if (calcIDCardCode($IDCardBody) != $IDCardCode) {
        return false;
    } else {
        return true;
    }
}
function check_phone($phone){
    $check = '/^(1(([35789][0-9])|(47)))\d{8}$/';
    if (preg_match($check, $phone)) {
        return true;
    } 
    else {
        return false;
    }
}

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


$indentify=$_GET['id'];
$tel=$_GET['tel'];
$number=$_GET['num'];
$name=$_GET['name'];
$peroid_id=$_GET['period_id'];
$jud=1;
if(validateIDCard($indentify)){
    
}
else{
    echo "<script>alert('身份证无效')</script>";
    $jud=0;
}
if(check_phone($tel)){
    
}
else{
    echo "<script>alert('手机号无效')</script>";
    $jud=0;
}
if($_GET['num']>$_GET['max']){
    echo "预约数量超过可预约最大数量";
    $jud=0;
}
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