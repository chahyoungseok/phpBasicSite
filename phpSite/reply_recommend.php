<?php
    $id = $_GET["id"];
    $num = $_GET["num"];
    $status = $_GET["status"];
    $replynum = $_GET["replynum"];

    $con = mysqli_connect("localhost:3307","root","","phpsitedb");
    $sql = "select * from reply where num=$replynum";
    $result = mysqli_query($con, $sql);
    
    $row = mysqli_fetch_array($result);

    $reply_recommend = $row["recommend"];

//여기까지가 댓글 추천갯수 알아오는것
    $sql = "select * from members where id='$id'";

    $result = mysqli_query($con, $sql);
    
    $row = mysqli_fetch_array($result);

    $mylike = $row["mylike"];
    $mylike_ary = explode(",",$mylike);

//여기까지가 유저 좋아요 목록 가져오는것

    if($status==1){
        if($mylike==null){
            $mylike = $replynum;
        }
        else{
            $mylike = $mylike.",".$replynum;
        }
        $reply_recommend = $reply_recommend + 1;
    }
    else{
        if(strpos($mylike,",".$replynum)){
            $mylike = str_replace(",".$replynum,"",$mylike);
        }
        else{
            if($replynum!=$mylike){
                $mylike = str_replace($replynum.",","",$mylike);
            }
            else{
                $mylike = str_replace($replynum,"",$mylike);
            }
        }
        $reply_recommend = $reply_recommend - 1;
    }

    session_start();
    $_SESSION["mylike"] = $mylike;

    $sql = "update members set mylike='$mylike'";
    $sql .= " where id='$id'";

    mysqli_query($con, $sql);
//여기는 좋아요목록 업데이트 하는것

    $sql = "update reply set recommend='$reply_recommend'";
    $sql .= " where num='$replynum'";

    mysqli_query($con, $sql);
//여기는 댓글 추천갯수 업데이트 하는것

    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'photo_view_form.php?num=$num&page=1';
	      </script>
	  ";
?>