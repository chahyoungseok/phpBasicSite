<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>무료사진다운로드 사이트</title>
<link rel="stylesheet" type="text/css" href="./css/index_style.css?good">
<link rel="stylesheet" type="text/css" href="./css/friends.css?good">

    
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
   	<div id="friends_box">
	    <h3 id="member_title">
	    	친구목록
		</h3>
	    <ul id="member_list">
				<li>
					<span class="col1">아이디</span>
					<span class="col2">이름</span>
					<span class="col3">메세지 추가</span>
                    <span class="col4">삭제</span>
                    <span class="col5">친구게시물 바로가기</span>
				</li>
		<li>
		<?php
            $con = mysqli_connect("localhost:3307","root","","phpsitedb");
            $sql = "select * from members where id='$userid'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);
            $myfriends = $row["myfriends"];
            
            if($myfriends!=null or $myfriends!=""){
                $myfriends_ary = explode(",",$myfriends);
                for($i=0;$i<count($myfriends_ary);$i++){
                    $friend_sql = "select * from members where num=$myfriends_ary[$i]";
                    $friend_result = mysqli_query($con,$friend_sql);
                    $friend_row = mysqli_fetch_array($friend_result);
                ?>
                    <span class="col1"><?=$friend_row["id"]?></span>
                    <span class="col2"><?=$friend_row["name"]?></span>
                    <?php
                        $messagefriends = $row["messagefriends"];
                        $messagefriends_ary = explode(",",$messagefriends);
                        $friend_status = true;
                        for($k=0;$k<count($messagefriends_ary);$k++){
                            if($messagefriends_ary[$k]==$friend_row["id"]){
                                $friend_status = false;
                            }
                        }
                    
                    if($friend_status){
                    ?>
                    <span class="col3"><a href="message_add_friend.php?my_id=<?=$userid?>&opponent_id=<?=$friend_row["id"]?>"><img src="./img/message_add.png" width="20px"; height="20px";></a></span>
                    <?php
                        }else{
                    ?>
                    <span class="col3"><a href="message_view_form.php?opponentid=<?=$friend_row["id"]?>"><img src="./img/message_go.png" width="20px"; height="20px";></a></span>
                    <?php
                        }
                            ?>
                    <span class="col4"><button type="button" onclick="location.href='friends_delete.php?num=<?=$friend_row["num"]?>&userid=<?=$userid?>&friend_id=<?=$friend_row["id"]?>'">삭제</button></span>
                    <span class="col5"><button type="button" onclick="location.href='myphoto_list_form.php?id=<?=$friend_row["id"]?>&page=1'">바로가기</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </li>
                <li>
                <?php
                }
                ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* 여기는 친구목록이에요! 친구목록을 통해 친구를 관리해봐요!
            <?php
            }
            else{
               ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>현재 등록된 친구가 없습니다!</span><br>
                    
            <?php
            }
            ?>  
		</li>

	    </ul>
        <h3 id="member_title">추천친구</h3>
        <ul id="member_list">
            <li>
	           <span class="col6">아이디</span>
	           <span class="col7">이름</span>
	           <span class="col8">친구 추가</span>
                <span class="col9">친구게시물 바로가기</span>
            </li>
        <li>
		<?php
            $con = mysqli_connect("localhost:3307","root","","phpsitedb");
            $sql = "select * from members where id='$userid'";
            $result = mysqli_query($con,$sql);
            $row = mysqli_fetch_array($result);
            $recommendfriends = $row["recommendfriends"];
            
            if($recommendfriends!=null or $recommendfriends!=""){
                $recommendfriends_ary = explode(",",$recommendfriends);
                for($i=0;$i<count($recommendfriends_ary);$i++){
                    $recommend_sql = "select * from members where num=$recommendfriends_ary[$i]";
                    $recommend_result = mysqli_query($con,$recommend_sql);
                    $recommend_row = mysqli_fetch_array($recommend_result);
                ?>
                    <span class="col6"><?=$recommend_row["id"]?></span>
                    <span class="col7"><?=$recommend_row["name"]?></span>
                    <span class="col8"><button type="button" onclick="location.href='friends_add.php?id=<?=$userid?>&photoid=<?=$recommend_row["id"]?>&num=0'">친구추가</button></span>
                    <span class="col9"><button type="button" onclick="location.href='myphoto_list_form.php?id=<?=$recommend_row["id"]?>&page=1'">바로가기</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                </li>
                <li>
                <?php
                }
                ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;* 상대방은 친구추천을 해놓은 상태에요! 원한다면 게시물 확인후에 친구추천을 걸어주세요!
            <?php
            }
            else{
               ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>현재 추천 친구가 없습니다!</span><br>
                    
            <?php
            }
            ?>  
		</li>
        </ul>
	</div>
</section> 
<footer>
    
    <?php include "footer.php";?>
</footer>
</body>
</html>