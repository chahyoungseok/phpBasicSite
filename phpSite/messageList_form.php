<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>무료사진다운로드 사이트</title>
<link rel="stylesheet" type="text/css" href="./css/index_style.css?good">
<link rel="stylesheet" type="text/css" href="./css/messageList.css?good">

</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
   	<div id="message_box" style="margin-bottom : 40px; margin-top : 50px; padding : 5px; border:5px solid #C0C0E0; border-radius: 40px 40px 40px 40px;text-align: center;">
	    <h3>
	    	Message List
		</h3>
	    <ul id="message_list">
            <?php
                $con = mysqli_connect("localhost:3307","root","","phpsitedb");
                $sql = "select * from members where id='$userid'";
                $result = mysqli_query($con,$sql);
                $row = mysqli_fetch_array($result);
                $message_friend = $row["messagefriends"];
                if($message_friend!=null and $message_friend!=""){
                    
                    $message_friend_ary = explode(",",$message_friend);

                    for($i=0;$i<count($message_friend_ary);$i++){
                        $opponentid = $message_friend_ary[$i];
            ?>
            <li>
                <div style="margin : 15px 60px 15px 60px; border:1px solid #E1E1F9; border-radius: 20px 20px 20px 20px;text-align: center;"><a href="message_view_form.php?opponentid=<?=$opponentid?>"><?=$opponentid?></a></div>
            </li>
            <?php
                    }
                }
                else{
            ?>
                <div style="margin:20px 40px 20px 40px;">메세지 상대가 없습니다.</div>
            <?php
                }
                    ?>
	   </ul>
	</div>
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
