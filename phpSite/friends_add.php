<?php
    $id = $_GET["id"];
    $num = $_GET["num"];
    $photoid = $_GET["photoid"];
    $status = true;

    $con = mysqli_connect("localhost:3307","root","","phpsitedb");

    $friend_sql = "select * from members where id='$photoid'";
    $friend_result = mysqli_query($con,$friend_sql);
    $friend_row = mysqli_fetch_array($friend_result);
    $photonum = $friend_row["num"];


    $sql = "select * from members where id='$id'";
    $result = mysqli_query($con, $sql);
    
    $row = mysqli_fetch_array($result);

    $myfriends = $row["myfriends"];
    $myfriends_ary = explode(",",$myfriends);
    
    for($i=0;$i<count($myfriends_ary);$i++){
        if($myfriends_ary[$i] == $photonum){
            $status = false;
        }
    }

    if($status){
        if($myfriends==null or $myfriends==""){
            $myfriends = $photonum;
        }
        else{
            $myfriends = $myfriends.",".$photonum;
        }

        $sql = "update members set myfriends='$myfriends'";
        $sql .= " where id='$id'";

        mysqli_query($con, $sql);
    //여기는 댓글 추천갯수 업데이트 하는것
        
        $remove_sql = "select * from members where id='$id'";
        $remove_result = mysqli_query($con,$remove_sql);
        $remove_row = mysqli_fetch_array($remove_result);
        $recommendfriends = $remove_row["recommendfriends"];
        $recommendfriends_ary = explode(",",$recommendfriends);
        $recommend_status = true;
        for($k=0;$k<count($recommendfriends_ary);$k++){
            if($recommendfriends_ary[$k] == $photonum){
                $recommend_status = false;
            }
        }
        
        if(!$recommend_status){
            if(strpos($recommendfriends,",".$photonum)){
            $recommendfriends = str_replace(",".$photonum,"",$recommendfriends);
            }
            else{
                if($photonum!=$recommendfriends){
                    $recommendfriends = str_replace($photonum.",","",$recommendfriends);
                }
                else{
                    $recommendfriends = str_replace($photonum,"",$recommendfriends);
                }
            }
            $remove_sql2 = "update members set recommendfriends='$recommendfriends'";
            $remove_sql2 .= " where id='$id'";

            mysqli_query($con, $remove_sql2);
        }
        else{
            $add_sql = "select * from members where id='$photoid'";
            $add_result = mysqli_query($con,$add_sql);
            $add_row = mysqli_fetch_array($add_result);
            
            $recommendfriends = $add_row["recommendfriends"];
            
            if($recommendfriends==null or $recommendfriends==""){
                $recommendfriends = $remove_row["num"];
            }
            else{
                $recommendfriends = $recommendfriends.",".$remove_row["num"];
            }
            
            $updateAdd_sql = "update members set recommendfriends='$recommendfriends'";
            $updateAdd_sql .= " where id='$photoid'";

            mysqli_query($con, $updateAdd_sql);
        }

        mysqli_close($con);     
        
        if($num==0){
            echo "
              <script>
                  location.href = 'friends_form.php';
              </script>
          ";
        }
        else{
            echo "
              <script>
                  location.href = 'photo_view_form.php?num=$num&page=1';
              </script>
          ";
        }
    }
    else{
        mysqli_close($con);     

        echo "
              <script>
                  alert('이미 친구가 되어있습니다.');
                  location.href = 'photo_view_form.php?num=$num&page=1';
              </script>
          ";
    }
    
?>