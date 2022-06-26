<?php
    $num   = $_GET["num"];

    $reply = $_POST["reply"];
    $hidden_id  = $_POST["hidden_id"];
              
    $con = mysqli_connect("localhost:3307", "root", "", "phpsitedb");

	$sql = "insert into reply(photoid, id, content, recommend) ";
	$sql .= "values($num, '$hidden_id', '$reply', 0)";

	mysqli_query($con, $sql);
    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'photo_view_form.php?num=$num&page=1';
	      </script>
	  ";
?>

   
