            <div id="main_content">
            <div id="latest">
                
<?php
    $con = mysqli_connect("localhost:3307", "root", "", "phpsitedb");
    $sql = "select * from photos order by recommend DESC LIMIT 1";
    $result = mysqli_query($con, $sql);
    
    
    if (!$result){
        echo "아직 추천할만한 사진이 없습니다!";
    }
    else
    {
        $row = mysqli_fetch_array($result);
    ?>
    <h4>추천을 많이받은 사진&nbsp; <img src="./img/recommend_icon.png" width="15px"; height="15px;"> : <?=$row["recommend"]?></h4> 
    <ul>
    <?php
        //여기서부터 4줄이 고정댓글에 대한 배열을 불러옴
        if($row["fix_reply"]!=0){
            $fix_reply =$row["fix_reply"];
            $fix_sql = "select * from reply where num=$fix_reply";
            $fix_result = mysqli_query($con, $fix_sql);
            $fix_row = mysqli_fetch_array($fix_result);
        }
        
        if($row["recommend"]!=0)
        {
            $file_path = "./data/".$row["file_copied"];
?>
            <li>
                <a href="photo_view_form.php?num=<?=$row["num"]?>&page=1"><img src ="<?=$file_path?>" width="300px"; height="150px";></a>
                <div class="clear"></div>
                <span>제목 : <?=$row["title"]?></span> / 
                <span>아이디 : <?=$row["id"]?></span>
                <?php
                    if($row["fix_reply"] !=0){
                ?>
                <div class="clear"></div>
                <span>고정댓글 : <?=$fix_row["content"]?> &nbsp;<img src="./img/recommend_icon.png" width="15px"; height="15px;"> : <?=$fix_row["recommend"]?></span>
                <?php
                    }
                    else{
                ?>
                    <div class="clear"></div>
                    <span>고정댓글 : 아직 고정댓글이 없습니다.</span>
                <?php   
                    }
                        ?>
            </li>
<?php
        }
        else{
            echo "아직 추천할만한 사진이 없습니다!";
        }
    }
?>
                </ul>
            </div>
            <div id="point_rank">
                <h4>조회수 많이받은 사진순위 <img src="./img/eyes.png" width=15px; height="15px";></h4>
                <ul>
<?php
    $rank = 1;
    $sql = "select * from photos order by hit desc limit 5";
    $result = mysqli_query($con, $sql);

    if (!$result)
        echo "회원 DB 테이블(members)이 생성 전이거나 아직 가입된 회원이 없습니다!";
    else
    {
        while( $row = mysqli_fetch_array($result) )
        {
            $title  = $row["title"];        
            $id    = $row["id"];
            $hit = $row["hit"];
?>
            <a href="photo_view_form.php?num=<?=$row["num"]?>&page=1">
                <li>
                    <span><?=$rank?>위</span>
                    <span><?=$title?></span>
                    <span><?=$id?></span>
                    <span><?=$hit?></span>
                </li>
            </a>
<?php
            $rank++;
        }
    }

    mysqli_close($con);
?>
                </ul>
            </div>
        </div>