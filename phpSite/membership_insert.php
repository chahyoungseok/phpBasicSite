<?php
    $id   = $_POST["id"];
    $pass = $_POST["pass"];
    $name = $_POST["name"];
              
    $con = mysqli_connect("localhost:3307", "root", "", "phpsitedb");

	$sql = "insert into members(id, pass, name, point, recommend_index) ";
	$sql .= "values('$id', '$pass', '$name', 0, 1)";

	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>

   
