<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>무료사진다운로드 사이트</title>
<link rel="stylesheet" type="text/css" href="./css/index_style.css?good">
<link rel="stylesheet" type="text/css" href="./css/photo.css?good">
<script>
    function reply_input() {
        if(!document.reply_form.reply.value){
            alert("댓글을 입력하세요");
            document.reply_form.reply.focus();
            return;
        }
        document.reply_form.submit();
    }
</script>
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
   	<div id="photo_box">
<?php
    
	$num  = $_GET["num"];
	$page  = $_GET["page"];

	$con = mysqli_connect("localhost:3307", "root", "", "phpsitedb");
	$sql = "select * from photos where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$id      = $row["id"];
        
    ?>
        <?php
	$subject    = $row["title"];
	$content    = $row["content"];
	$file_name    = $row["file_name"];
	$file_type    = $row["file_type"];
	$file_copied  = $row["file_copied"];
	$hit          = $row["hit"];
    $reply  = $row["reply"];
    $fix_reply  = $row["fix_reply"];
	$recommend = $row["recommend"];
    $like_ary = explode(",",$mylike);
    $download_hit = $row["download_hit"];
    $admin_status = false;
    if($id == $userid){
        $admin_status = true;
    }    
        
	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);

	$new_hit = $hit + 1;
	$sql = "update photos set hit=$new_hit where num=$num";   
	mysqli_query($con, $sql);
?>		
	    <ul id="view_content">
			<li>
                <?php
                    $real_name = $file_copied;
					$file_path = "./data/".$real_name;
				    $file_size = filesize($file_path);
                ?>
                <div style="border:1px solid white; float: left;width:50%; margin-right:10px;" id="content_img_bar">
                    <img src="<?=$file_path?>" >
                </div>
                <div style="border:1px solid white; float: left;width:50%;" id="content_img_bar">
                    <span class="col1"><b>제목 :</b> <?=$subject?></span>
                    <span class="recommend_span"> / <img src="./img/Recommendicon.png" width=15px; height=15px; > : <?=$recommend?></span>
                </div>
                <h2>
                    <a href="myphoto_list_form.php?id=<?=$id?>">Photo of <?=$id?></a> 
                    <?php
                        if($id!=$userid and $userid){
                    ?>
                    <a href="friends_add.php?id=<?=$userid?>&photoid=<?=$id?>&num=<?=$num?>">&nbsp;<img src="./img/friend.png" width="20px"; height="20px";></a>
                    <?php
                        }
                         else{
                        ?>
                    &nbsp;&nbsp;&nbsp;
                    <?php
                         }
                             ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="./img/download_icon.png" width="15px"; height="15px;"> : <?=$download_hit?>
                </h2>
                
				<?php
    
                    echo "<br>내용 : $content<br><br>";
					if($file_name and $userid) {
						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='photo_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type&photo_num=$num&userid=$userid&download_hit=$download_hit'><img src='./img/download.png' width=300px; height=45px;><br><br><br><br><br></a>";
			         }
                    else{
                        echo "<br><br><br><br><br><br><br>";
                    }
				?>
			</li>		
	    </ul>
        
        
        <!-- 댓글 -->
<?php        
        $sql = "select * from reply where photoid=$num";
        $result = mysqli_query($con,$sql);
        $reply_id;
        if($userid){
        if(isset($result)){
            $total_reply = mysqli_num_rows($result);
            if($fix_reply!=0){
                for($i=0;$i<$total_reply;$i++){
                    mysqli_data_seek($result, $i);
                    $row = mysqli_fetch_array($result);
                    if($row["num"]==$fix_reply){
                        $fix_id = $row["id"];
                        $fix_content = $row["content"];
                        $fix_recommend = $row["recommend"];
                        break;
                    }
                }
            ?>
            
            <ul id="recommend_form">
                <li>
                    <span class="col1">고정댓글 => <?=$fix_id?> : </span>
                    <span class="col2"><?=$fix_content?></span>
                    <span class="col3"> / <img src="./img/Recommendicon.png" width=15px; height=15px; > : <?=$fix_recommend?></span>
                </li>
            </ul>
        <?php
            echo "<br>";
            }
            for($i=0;$i<$total_reply;$i++){
                mysqli_data_seek($result, $i);
                $row = mysqli_fetch_array($result);

                $reply_id         = $row["id"];
                $content     = $row["content"];
                $photo_recommend     = $row["recommend"];
                
            ?>
            <form id="recommend_form" name="reply_like_form">    
                <ul>
                    <li>
                        <span class="col1"><?=$reply_id?> : </span>
                        <span class="col2"><?=$content?></span>
                        <span class="col3"> / <img src="./img/Recommendicon.png" width=15px; height=15px; > : <?=$photo_recommend?> ,</span>
                        <?php
                            $status = false;
                            for($k=0;$k<count($like_ary);$k++){
                                if($row["num"] == $like_ary[$k]){
                                    $status = true;
                                }
                            }
                            
                            if($status){
                                $status =false;
                                ?>
                                <a href="#"><img src="./img/like_on.png" width=15px; height=15px; onclick="location.href='reply_recommend.php?num=<?=$num?>&id=<?=$userid?>&status=0&replynum=<?=$row["num"]?>'"></a> : 추천하기
                            <?php
                            }
                            else{
                                ?>
                                <a href="#"><img src="./img/like_off.png" width=15px; height=15px; onclick="location.href='reply_recommend.php?num=<?=$num?>&id=<?=$userid?>&status=1&replynum=<?=$row["num"]?>'"></a> : 추천하기
                            <?php
                            }
                            if($admin_status){
                                ?>
                        <a href="#">,&nbsp;<img src="./img/fix_reply.png" width=15px; height=15px;  onclick="location.href='reply_fix.php?num=<?=$num?>&replynum=<?=$row["num"]?>'"></a> : 고정하기
                            <?php
                                }
                            ?>
                    </li>
                </ul>
            </form>
    <?php    
            }
        }
        
     ?> 
        
        <form name="reply_form" method="post" action="reply_insert.php?num=<?=$num?>" enctype="multipart/form-data">
            <input name="hidden_id" type="hidden" value="<?=$userid?>">
            <ul class="buttons">
                <input name="reply" type="text" placeholder="댓글을 입력하세요">
                <li><button type="button" onclick="reply_input()" style="margin-top:5px;">입력</button></li>
            </ul>
        </form>
        
	    <ul class="buttons">
                <li><button onclick="location.href='photo_recommend.php?num=<?=$num?>&recommend=<?=$recommend?>&id=<?=$userid?>'">추천하기</button></li>
				<li><button onclick="location.href='photo_list_form.php?page=<?=$page?>'">목록</button></li>
            <?php
                if($id==$userid or $userpoint >=1000){
            ?>
				<li><button onclick="location.href='photo_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></li>
				<li><button onclick="location.href='photo_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
            <?php
                }
            ?>
				
		</ul>
        
        <?php
        }else{
            ?>
        <br><br><br>
        <?php
        }
            ?>
	</div>
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
