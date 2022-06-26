<?php
    $id = $_GET["id"];
        
    $con = mysqli_connect("localhost:3307", "root", "", "phpsitedb");
    $sql = "select * from members where id='$id'";
    $result = mysqli_query($con, $sql);
    $row    = mysqli_fetch_array($result);
    $pass = $_POST["pass"];
    $name = $_POST["name"];

    if(!strcmp($_POST["pass"],"")){
        $pass = $row["pass"];
    }
    if(!strcmp($_POST["name"],"")){
        $name = $row["name"];
    }

    $sql = "update members set pass='$pass', name='$name'";
    $sql .= " where id='$id'";
    mysqli_query($con, $sql);
    
    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'index.php';
	      </script>
	  ";
?>

   
