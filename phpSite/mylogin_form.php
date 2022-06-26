<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>무료사진다운로드 사이트</title>
<link rel="stylesheet" type="text/css" href="./css/index_style.css?good">
<link rel="stylesheet" type="text/css" href="./css/mylogin.css?good">
<script>
    function check_input()
    {
    if (!document.login_form.id.value)
    {
        alert("아이디를 입력하세요");    
        document.login_form.id.focus();
        return;
    }

    if (!document.login_form.pass.value)
    {
        alert("비밀번호를 입력하세요");    
        document.login_form.pass.focus();
        return;
    }
    document.login_form.submit();
}
</script>
</head>
<body> 
	<header>
    	<?php include "header.php";?>
    </header>
	<section>
        <div id="main_content">
      		<div id="login_box">
	    		<div id="login_title">
		    		<span>Login</span>
	    		</div>
	    		<div id="login_form">
          		<form  name="login_form" method="post" action="mylogin.php">		       	
                  	<ul>
                    <li><input type="text" name="id" placeholder="  Please enter your ID" ></li>
                    <li><input type="password" id="pass" name="pass" placeholder="  Please enter your PW" ></li>
                  	</ul>
                  	<div id="login_btn">
                      	<a href="#"><img src="./img/login.png" width=40px; height=40px; onclick="check_input()"></a>
                  	</div>		    	
           		</form>
        		</div>
    		</div>
        </div>
	</section> 
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>

