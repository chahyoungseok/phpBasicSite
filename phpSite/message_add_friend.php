<?php
    $my_id = $_GET["my_id"];
    $opponent_id = $_GET["opponent_id"];

    $con = mysqli_connect("localhost:3307","root","","phpsitedb");

    $message_sql = "select * from members where id='$my_id'";
    $message_result = mysqli_query($con,$message_sql);
    $message_row = mysqli_fetch_array($message_result);
    $messagefriends = $message_row["messagefriends"];
    
    if($messagefriends==null or $messagefriends==""){
        $messagefriends = $opponent_id;
    }
    else{
        $messagefriends = $messagefriends.",".$opponent_id;
    }
    
    $sql = "update members set messagefriends='$messagefriends'";
    $sql .= " where id='$my_id'";
    mysqli_query($con, $sql);
    mysqli_close($con); 
    
    echo "
          <script>
              location.href = 'friends_form.php?';
          </script>
    ";
?>