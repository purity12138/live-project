<?php
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

?>
