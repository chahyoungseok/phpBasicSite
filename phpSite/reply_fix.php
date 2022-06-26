<?php
    $num = $_GET["num"];
    $replynum = $_GET["replynum"];

    $con = mysqli_connect("localhost:3307","root","","phpsitedb");
    $sql = "update photos set fix_reply='$replynum'";
    $sql .= " where num=$num";
    $result = mysqli_query($con, $sql);

    mysqli_close($con);     

    echo "
	      <script>
            alert('해당 댓글이 고정되었습니다.');
	          location.href = 'photo_view_form.php?num=$num&page=1';
	      </script>
	  ";
?>