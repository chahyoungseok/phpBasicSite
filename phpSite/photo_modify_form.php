<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>무료사진다운로드 사이트</title>
<link rel="stylesheet" type="text/css" href="./css/index_style.css?good">
<link rel="stylesheet" type="text/css" href="./css/photo.css?good">
<script>
  function check_input() {
      if (!document.photo_form.title.value)
      {
          alert("제목을 입력하세요!");
          document.photo_form.title.focus();
          return;
      }
      if (!document.photo_form.content.value)
      {
          alert("내용을 입력하세요!");    
          document.photo_form.content.focus();
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
   	<div id="photo_box">
	    <h3 id="board_title">
	    		Photo Modify
		</h3>
<?php
	$num  = $_GET["num"];
	$page = $_GET["page"];
	
	$con = mysqli_connect("localhost:3307", "root", "", "phpsitedb");
	$sql = "select * from photos where num=$num";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($result);
	$id       = $row["id"];
	$subject    = $row["title"];
	$content    = $row["content"];		
	$file_name  = $row["file_name"];
        
    $sql_name = "select * from members where id='$id'";
    $result_name = mysqli_query($con, $sql_name);
    $row_name = mysqli_fetch_array($result_name);
    
?>
	    <form  name="photo_form" method="post" action="photo_modify.php?num=<?=$num?>&page=<?=$page?>" enctype="multipart/form-data">
	    	 <ul id="photo_form">
				<li>
					<span><?=$row_name["name"]?>! 사진의 제목이나 내용을 수정할 수 있어요! </span>
				</li>		
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="title" type="text" value="<?=$subject?>"></span>
	    		</li>	    	
	    		<li id="text_area2">	
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea style="resize:none; height:70px;" name="content"><?=$content?></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">수정하기</button></li>
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
