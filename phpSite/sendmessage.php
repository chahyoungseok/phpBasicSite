<?php
    $myid = $_GET["myid"];
    $opponentid = $_GET["opponentid"];
    
    $content = $_POST["content"];

    $con = mysqli_connect("localhost:3307","root","","phpsitedb");
    $sql = "insert into message(my_id, opponent_id	, content) ";
	$sql .= "values('$myid', '$opponentid', '$content')";

    mysqli_query($con,$sql);
    mysqli_close($con); 
    
    echo "
	      <script>
	          location.href = 'message_view_form.php?opponentid=$opponentid';
	      </script>
	  ";
?>