<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>무료사진다운로드 사이트</title>
<link rel="stylesheet" type="text/css" href="./css/index_style.css?good">
<link rel="stylesheet" type="text/css" href="./css/membership_modify.css?good">
<script>
    function check_input()
   {
      document.modify_form.submit();
   }

   function reset_form()
   {
      document.modify_form.id.value = "";  
      document.modify_form.pass.value = "";
      document.modify_form.name.value = "";
	  
      document.modify_form.id.focus();
      return;
   }

</script>
</head>
<body> 
	<header>
    	<?php include "header.php";?>
    </header>
<?php    
   	$con = mysqli_connect("localhost:3307", "root", "", "phpsitedb");
    $sql    = "select * from members where id='$userid'";
    $result = mysqli_query($con, $sql);
    $row    = mysqli_fetch_array($result);
    
    mysqli_close($con);
?>
	<section>
        <div id="main_content">
      		<div id="modify_box">
          	<form  name="modify_form" method="post" action="membership_modify.php?id=<?=$userid?>">
			    <h2>Changing Information</h2>
    		    	<div class="form id">
				        <div class="col1">ID : </div>
				        <div class="col2">
							<?=$userid?>
				        </div>                 
			       	</div>
			       	<div class="clear"></div>

			       	<div class="form">
				        <div class="col1">PW : </div>
				        <div class="col2">
							<input type="password" name="pass" placeholder="입력을 하지않으면 기존의 비밀번호로 저장됩니다.">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <div class="col1">Name : </div>
				        <div class="col2">
							<input type="text" name="name" placeholder="입력을 하지않으면 기존의 이름으로 저장됩니다.">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="bottom_line"> </div>
			       	<div class="buttons">
	                	<img style="cursor:pointer" src="./img/save_button.png" width=40px; height=40px; onclick="check_input()">&nbsp;
                  		<img id="reset_button" style="cursor:pointer" src="./img/cancel_button.png" width=40px; height=40px;
                  			onclick="reset_form()">
	           		</div>
           	</form>
        	</div>
        </div>
	</section> 
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>

