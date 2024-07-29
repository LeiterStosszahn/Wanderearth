<?php
    $conn = mysqli_connect("localhost", "root", "748.Website", "wanderearth");
     if (!$conn) {
        die("连接失败: " . mysqli_connect_error());
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>查看订单</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="images/ico.ico" rel="shortcut icon">
    <style type="text/css">
    	body{ text-align: center; }
        td{ width: 80px; }
        .nots {color: red;}
        .yess {color: green;}
    </style>
</head>
<body>
    <div>
        <form method="post">
            查看密码：<input id="password" name="password" type="text" type="password"><input id="see" name="see" type="submit" value="查看" />
            </div>
            <hr>
        </form>
        <form method="post" action="change.php" target="_blank">
            <div>
            <table align="center" style="text-align: left;" border=1>
                <tr>
                    <th>编号</th>
                    <th>姓</th>
                    <th>名</th>
                    <th>英文姓</th>
                    <th>英文名</th>
                    <th>识别编码</th>
                    <th>通讯编码</th>
                    <th>方案选择</th>
                    <th>中文职位</th>
                    <th>英文职位</th>
                    <th>姓名</th>
                    <th>地址</th>
                    <th>电话</th>
                    <th>邮箱</th>
                    <th>QQ或微信</th>
                    <th>是否发货</th>
                    <th>修改发货状态</th>
                </tr>
                
                <?php
                /*验证密码*/
                $checkpass = "8a5ff283835cb21a079cbee578ca712726330c78";/*ripemd160加密后的密码，修改“”内部分*/
                @$hashpass = hash('ripemd160', $_POST["password"]);
                if($hashpass == $checkpass){
                    /*遍历数据库*/
                    $sql = "SELECT ID, secondname, firstname, esecondname, efirstname, CNG, code, tagtype, jobc, jobe, name, ad, num, email, other, post FROM iforder";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>" . $row["ID"]. "</td><td>" . $row["secondname"]. "</td><td>" . $row["firstname"]. "</td><td>" . $row["esecondname"]. "</td><td>" . $row["efirstname"]. "</td><td>" . $row["CNG"]. "</td><td>" . $row["code"]. "</td><td>";
                        /*判断方案*/
                        $tagtype = $row["tagtype"];
                        $var=explode("+",$tagtype);
                        if(isset($var[0])){ 
                            if($var[0]=="胸牌方案一"){echo "<span class=\"nots\">";}
                            elseif($var[0]=="胸牌方案二"){echo "<span class=\"yess\">";}
                            else{echo "<span>";}
                            echo $var[0]. "</span>";
                        }
                        if(isset($var[1])){
                            if($var[1]=="胸牌方案一"){echo "<span class=\"nots\">";}
                            elseif($var[1]=="胸牌方案二"){echo "<span class=\"yess\">";}
                            else{echo "<span>";}
                            echo "<br>".$var[1]. "</span>";
                        }
                        if(isset($var[2])){
                            if($var[2]=="胸牌方案一"){echo "<span class=\"nots\">";}
                            elseif($var[2]=="胸牌方案二"){echo "<span class=\"yess\">";}
                            else{echo "<span>";}
                            echo "<br>".$var[2]. "</span>";
                        }
                        /*输出剩余部分*/
                        echo "</td><td>". $row["jobc"]. "</td><td>" . $row["jobe"]. "</td><td>" . $row["name"]. "</td><td>" . $row["ad"]. "</td><td>" . $row["num"]. "</td><td>" . $row["email"]. "</td><td>" . $row["other"]. "</td><td>";
                        /*判断是否发货*/
                        if($row["post"]==0){
                            echo "<span class=\"nots\">否</span></td><td>";
                        } else {
                            echo "<span class=\"yess\">是</td><td>";
                        }
                        echo "<input id=\"change\" name=\"change\" type=\"submit\" value=\"". $row["ID"] ."-" .  $row["post"]  ."\" onclick=\"location.reload(true)\"></td><tr>";
                    }
                    mysqli_close($conn);
                } else {
                    echo "密码错误！";
                }
                ?>
            </table>
        </form>
    </div>
</body>
</html>