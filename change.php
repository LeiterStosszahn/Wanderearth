<?php
$con = mysqli_connect("localhost", "root", "748.Website", "wanderearth");
if (!$con) {
    die("连接失败: " . mysqli_connect_error());
}
$posval=$_POST["change"];
$idd = substr($posval,0,strpos($posval, '-'));
$nowo = substr($posval,strpos($posval,'-')+1);
    if($nowo==0){
    	mysqli_query($con,"UPDATE iforder SET post=1 WHERE ID='$idd'");
    	echo "<script>alert(\"修改成功，已发货\");window.opener=null;window.open('','_self');window.close();</script>";
    } else {
    	mysqli_query($con,"UPDATE iforder SET post=0 WHERE ID='$idd'");
    	echo "<script>alert(\"修改成功，未发货\");window.opener=null;window.open('','_self');window.close();</script>";
    }
mysqli_close($con);
?>