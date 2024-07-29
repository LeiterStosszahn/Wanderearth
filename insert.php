<?php
/*验证邀请码*/
$checkpass = "ca31c2e59ee75b070a57810c40a304321b192407";/*ripemd160加密后的密码，修改“”内部分*/
$hashpass = hash('ripemd160', $_POST["invit"]);
if($hashpass == $checkpass){
    $conn = mysqli_connect("localhost", "root", "748.Website", "wanderearth");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "INSERT INTO iforder (secondname, firstname, esecondname, efirstname, CNG, code, tagtype, jobc, jobe, name, ad, num, email, other) VALUES ('$_POST[secondname]', '$_POST[firstname]', '$_POST[esecondname]', '$_POST[efirstname]', '$_POST[CNG]', '$_POST[ncode]', '$_POST[tagtype]', '$_POST[jobc]', '$_POST[jobe]', '$_POST[nname]', '$_POST[ad]', '$_POST[num]', '$_POST[email]', '$_POST[other]')";
    if (mysqli_query($conn, $sql)) {
        echo "新记录插入成功";
        echo "<script>alert(\"提交成功\");window.opener=null;window.open('','_self');window.close();</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
} else {
    echo "<script>alert(\"邀请码错误!\");window.opener=null;window.open('','_self');window.close();</script>";
}
?>