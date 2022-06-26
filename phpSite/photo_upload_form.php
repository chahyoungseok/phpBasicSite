<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>무료사진다운로드 사이트</title>
<link rel="stylesheet" type="text/css" href="./css/index_style.css?good">
<link rel="stylesheet" type="text/css" href="./css/photo.css?good">
<script>
    
  function check_input() {
      if (!document.photo_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.photo_form.subject.focus();
          return;
      }
      if (!document.photo_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.photo_form.content.focus();
          return;
      }
      if (!document.photo_form.upfile.value)
      {
          alert("사진을 업로드하세요!");    
          document.photo_form.upfile.focus();
          return;
      }
      document.photo_form.submit();
   }
</script>
</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
   	<div id="photo_box" >
	    <h3 id="board_title">
	    		Photo Upload
        </h3>
	    <form  name="photo_form" method="post" action="photo_insert.php" enctype="multipart/form-data">
	    	 <ul id="photo_form">
				<li>
					<span><?=$username?>! 이미지를 업로드하고 공유해보세요!</span><br><br>
                    <span><input style="height:25px;" type="file" name="upfile"></span>
			    </li>
                 <li id="text_area">
                    <span>사진선택이 다됬다면 사진의 제목이랑 내용을 입력해주세요!</span><br><br>
                    <span><input name="subject" type="text" placeholder=" 제목을 입력해주세요"></span><br><br>
	    			<span>
	    				<textarea style="resize:none; height:70px;" name="content" placeholder=" 내용을 입력해주세요"></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">완료</button></li>
				<li><button type="button" onclick="location.href='photo_list_form.php'">목록</button></li>
			</ul>
	    </form>
	</div>
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
