<?php
    $num = $_GET["num"];
    $page = $_GET["page"];

    $title = $_POST["title"];
    $content = $_POST["content"];
          
    $con = mysqli_connect("localhost:3307", "root", "", "phpsitedb");
    $sql = "update photos set title='$title', content='$content' ";
    $sql .= " where num=$num";
    mysqli_query($con, $sql);

    mysqli_close($con);     

    echo "
	      <script>
	          location.href = 'photo_list_form.php?page=$page';
	      </script>
	  ";
?>

   
