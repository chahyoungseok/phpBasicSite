<?php
    $num = $_GET["num"];
    $userid = $_GET["userid"];
    $friend_id = $_GET["friend_id"];

    $con = mysqli_connect("localhost:3307","root","","phpsitedb");
    $sql = "select * from members where id='$userid'";
    $result = mysqli_query($con, $sql);
    
    $row = mysqli_fetch_array($result);
    $myfriends = $row["myfriends"];
    $my_num = $row["num"];

    if(strpos($myfriends,",".$num)){
        $myfriends = str_replace(",".$num,"",$myfriends);
    }
    else{
        if($num!=$myfriends){
            $myfriends = str_replace($num.",","",$myfriends);
        }
        else{
            $myfriends = str_replace($num,"",$myfriends);
        }
    }

    $sql = "update members set myfriends='$myfriends'";
    $sql .= " where id='$userid'";

    mysqli_query($con, $sql);

    $confirm_sql = "select * from members where num=$num";
    $confirm_result = mysqli_query($con, $confirm_sql);
    
    $confirm_row = mysqli_fetch_array($confirm_result);

    $myfriends = $confirm_row["myfriends"];
    $myfriends_ary = explode(",",$myfriends);
    $status = false;

    for($i=0;$i<count($myfriends_ary);$i++){
        if($myfriends_ary[$i] == $my_num){
            $status = true;
        }
    }

    if($status){
        $update_sql = "select * from members where id='$userid'";
        $update_result = mysqli_query($con, $update_sql);
        $update_row = mysqli_fetch_array($update_result);
        $recommendfriends = $update_row["recommendfriends"];

        if($recommendfriends==null){
            $recommendfriends = $num;
        }
        else{
            $recommendfriends = $recommendfriends.",".$num;
        }

        $sql = "update members set recommendfriends='$recommendfriends'";
        $sql .= " where id='$userid'";

        mysqli_query($con, $sql);
    
    }
    else{
        $update_sql = "select * from members where num=$num";
        $update_result = mysqli_query($con, $update_sql);
        $update_row = mysqli_fetch_array($update_result);
        $recommendfriends = $update_row["recommendfriends"];
        
        if(strpos($recommendfriends,",".$my_num)){
            $recommendfriends = str_replace(",".$my_num,"",$recommendfriends);
        }
        else{
            if($my_num!=$recommendfriends){
                $recommendfriends = str_replace($my_num.",","",$recommendfriends);
            }
            else{
                $recommendfriends = str_replace($my_num,"",$recommendfriends);
            }
        }
        $sql = "update members set recommendfriends='$recommendfriends'";
        $sql .= " where num='$num'";

        mysqli_query($con, $sql);
    }

    $deleteMsg_sql = "delete from message where (my_id='$userid' and opponent_id='$friend_id') or (my_id='$friend_id' and opponent_id='$userid')";
    mysqli_query($con,$deleteMsg_sql);
    
    $msgfri_sql = "select * from members where id='$userid'";
    $msgfri_result = mysqli_query($con,$msgfri_sql);
    $msgfri_row = mysqli_fetch_array($msgfri_result);
    $msgfri = $msgfri_row["messagefriends"];
    $msgfri_ary = explode(",",$msgfri);

    for($u=0;$u<count($msgfri_ary);$u++){
       if($msgfri_ary[$u]==$friend_id){
           if(strpos($msgfri,",".$friend_id)){
                $msgfri = str_replace(",".$friend_id,"",$msgfri);
            }
            else{
                if($userid!=$msgfri){
                    $msgfri = str_replace($friend_id.",","",$msgfri);
                }
                else{
                    $msgfri = str_replace($friend_id,"",$msgfri);
                }
            }
            $msgfri_sql2 = "update members set messagefriends='$msgfri'";
            $msgfri_sql2 .= " where id='$userid'";

            mysqli_query($con, $msgfri_sql2);
           
            $msgfri_sql3 = "select * from members where id='$friend_id'";
            $msgfri_result3 = mysqli_query($con,$msgfri_sql3);
            $msgfri_row3 = mysqli_fetch_array($msgfri_result3);
            $msgfri3 = $msgfri_row3["messagefriends"];
           
           if(strpos($msgfri3,",".$userid)){
                $msgfri3 = str_replace(",".$userid,"",$msgfri3);
            }
            else{
                if($userid!=$msgfri3){
                    $msgfri3 = str_replace($userid.",","",$msgfri3);
                }
                else{
                    $msgfri3 = str_replace($userid,"",$msgfri3);
                }
            }
            $msgfri_sql4 = "update members set messagefriends='$msgfri3'";
            $msgfri_sql4 .= " where id='$friend_id'";

            mysqli_query($con, $msgfri_sql4);
       }
    }


    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'friends_form.php';
	      </script>
	  ";
?>