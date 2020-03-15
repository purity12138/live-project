ini_set('date.timezone','Asia/Shanghai');
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
