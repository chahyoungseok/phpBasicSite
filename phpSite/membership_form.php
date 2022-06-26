<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>무료사진다운로드 사이트</title>
<link rel="stylesheet" type="text/css" href="./css/index_style.css?good">
<link rel="stylesheet" type="text/css" href="./css/membership.css?good">
<script>
    function check_input()
    {
      if (!document.member_form.id.value) {
          alert("아이디를 입력하세요!");    
          document.member_form.id.focus();
          return;
      }

      if (!document.member_form.pass.value) {
          alert("비밀번호를 입력하세요!");    
          document.member_form.pass.focus();
          return;
      }

      if (!document.member_form.pass_confirm.value) {
          alert("비밀번호확인을 입력하세요!");    
          document.member_form.pass_confirm.focus();
          return;
      }

      if (!document.member_form.name.value) {
          alert("이름을 입력하세요!");    
          document.member_form.name.focus();
          return;
      }

      if (document.member_form.pass.value != 
            document.member_form.pass_confirm.value) {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
          document.member_form.pass.focus();
          document.member_form.pass.select();
          return;
      }

      document.member_form.submit();
   }

   function reset_form() {
      document.member_form.id.value = "";  
      document.member_form.pass.value = "";
      document.member_form.pass_confirm.value = "";
      document.member_form.name.value = "";
      document.member_form.id.focus();
      return;
   }

   function check_id() {
     window.open("membership_check_id.php?id=" + document.member_form.id.value,
         "IDcheck",
          "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
   }
</script>
</head>
<body> 
	<header>
    	<?php include "header.php";?>
    </header>
    <section>
        <div id="main_content">
            <div id="join_box">
          	<form  name="member_form" method="post" action="membership_insert.php">
			    <h2>MemberShip</h2>
    		    	<div class="form id">
				        <div class="col1">ID : </div>
				        <div class="col2">
							<input type="text" name="id" placeholder="  Please enter your ID">
				        </div>  
				        <div class="col3">
				        	<a href="#"><img src="./img/checkButton.png" 
				        		onclick="check_id()"></a>
				        </div>                 
			       	</div>
			       	<div class="clear"></div>

			       	<div class="form">
				        <div class="col1">PW : </div>
				        <div class="col2">
							<input type="password" name="pass" placeholder="  Please enter your PW ">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <div class="col1">PW Confirm : </div>
				        <div class="col2">
							<input type="password" name="pass_confirm" placeholder="  Please enter your PW Confirm">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="form">
				        <div class="col1">Name : </div>
				        <div class="col2">
							<input type="text" name="name" placeholder="  Please enter your Name ">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>
			       	<div class="bottom_line"> </div>
			       	<div class="buttons">
	                	<img style="cursor:pointer" src="./img/save_button.png" width="40px"; height="40px"; onclick="check_input()">&nbsp;
                  		<img id="reset_button" style="cursor:pointer" src="./img/cancel_button.png" width="40px"; height="40px";
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
