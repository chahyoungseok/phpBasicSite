<?php
    $num = $_GET["num"];
    $recommend = $_GET["recommend"];
    $id = $_GET["id"];

    $con = mysqli_connect("localhost:3307", "root", "", "phpsitedb");
    $sql = "select * from members where id='$id'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    $recommend_index = $row["recommend_index"];
    
    if($recommend_index == 1){
        $recommend = $recommend +1;
    
        $sql = "update photos set recommend='$recommend'";
        $sql .= " where num=$num";
        mysqli_query($con, $sql);
        
        $sql = "update members set recommend_index=0";
        $sql .= " where id='$id'";
        mysqli_query($con, $sql);
    }
    else{
        echo("
            <script>
            alert('하루에 하나의 게시물에만 추천할수 있습니다!');
            </script>
        ");
    }
    mysqli_close($con);

    echo "
	      <script>
	          location.href = 'photo_view_form.php?num=$num&page=1';
	      </script>
	  ";
?>

   
