<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>무료사진다운로드 사이트</title>
<link rel="stylesheet" type="text/css" href="./css/index_style.css?good">
<link rel="stylesheet" type="text/css" href="./css/messageView.css?good">
<script>
    function messageSend(){
        if(!document.message_form.content.value){
            alert("메세지가 입력되지 않았습니다.");
            return;
        }
        
        document.message_form.submit();
    }
    
</script>
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
   	
        <div id="message_box" style="margin-bottom : 40px; margin-top : 50px; padding : 5px; border:5px solid #C0C0E0; border-radius: 4px 4px 4px 4px;text-align: center;">
	    <?php
            $opponentid = $_GET["opponentid"];
        ?>
        <h3>
	    	Conversation of <?=$opponentid?>
		</h3>
        <ul id="message_list">
            <?php
                $con = mysqli_connect("localhost:3307", "root", "", "phpsitedb");
                $sql = "select * from message where (my_id='$userid' and opponent_id='$opponentid') or (my_id='$opponentid' and opponent_id='$userid') ";
                $result = mysqli_query($con,$sql);
                $total_messaeg = mysqli_num_rows($result);
                for($i=0;$i<$total_messaeg;$i++){
                    mysqli_data_seek($result,$i);
                    $row = mysqli_fetch_array($result);
                    
                    if($row["my_id"]==$userid){
                        ?>
                        <li>
                            <div class="message_my"><?=$row["content"]?></div>
                        </li>
                    <?php
                    }
                    else{
                            ?>
                        <li>
                            <div class="message_opponent"><?=$row["content"]?></div>
                        </li>
                        <?php
                    }
            ?>
            <?php
                }   
                ?>
        </ul>
        <hr>
        <form method="post" name="message_form" action="sendmessage.php?myid=<?=$userid?>&opponentid=<?=$opponentid?>">
            <ul class="buttons">
                <li><input name="content" type="text" placeholder="메세지를 입력하세요"><br></li>
                <li><button type="button" onclick="messageSend()" style="margin-top:5px;">전송</button></li>
            </ul>
        </form>
	</div>
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
