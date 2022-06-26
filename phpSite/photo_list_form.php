<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>무료사진다운로드 사이트</title>
<link rel="stylesheet" type="text/css" href="./css/index_style.css?good">
<link rel="stylesheet" type="text/css" href="./css/photo.css?good">

</head>
<body> 
<header>
    <?php include "header.php";?>
</header>  
<section>
   	<div id="photo_box" style="margin-bottom : 10px; padding : 5px; border:5px solid #8080C0; border-radius: 40px 40px 40px 40px;text-align: center;">
	    <h3>
	    	Photo List
		</h3>
	    <ul id="photo_list">
				
<?php
	if (isset($_GET["page"]))
		$page = $_GET["page"];
	else
		$page = 1;

	$con = mysqli_connect("localhost:3307", "root", "", "phpsitedb");
	$sql = "select * from photos order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result);

	$scale = 3;
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	$start = ($page - 1) * $scale;      

	$number = $total_record - $start;

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i);
      $row = mysqli_fetch_array($result);
	  $num         = $row["num"];
	  $subject     = $row["title"];
      $hit         = $row["hit"];
      $download_hit = $row["download_hit"];
      $file_name    = $row["file_name"];
	  $file_type    = $row["file_type"];
	  $file_copied  = $row["file_copied"];
      $real_name = $file_copied;
       $file_path = "./data/".$real_name;
       $file_size = filesize($file_path);
       
      if ($row["file_name"])
      	$file_image = "<img src='./img/file.gif'>";
      else
      	$file_image = " ";
       ?>
        <li>
            <div style="border:1px solid white; float: center; height=100%;"><a href="photo_view_form.php?num=<?=$num?>&page=<?=$page?>"><img src="<?=$file_path?>" width="500px"; height="310px";>&nbsp;<br><img src="./img/eyes.png" width=15px; height="15px";> : <?=$hit?> &nbsp;&nbsp;&nbsp;<img src="./img/download_icon.png" width="15px"; height="15px;"> : <?=$download_hit?></a></div>
            </li>
<?php
        
   	   $number--;
   }
   mysqli_close($con);

?>
	    	</ul>
			<ul id="page_num"> 	
<?php
	if ($total_page>=2 && $page >= 2)	
	{
		$new_page = $page-1;
		echo "<li><a href='photo_list_form.php?page=$new_page'>◀ 이전</a> </li>";
	}		
	else 
		echo "<li>&nbsp;</li>";

   	for ($i=1; $i<=$total_page; $i++)
   	{
		if ($page == $i)
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li><a href='photo_list_form.php?page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)		
   	{
		$new_page = $page+1;	
		echo "<li> <a href='photo_list_form.php?page=$new_page'>다음 ▶</a> </li>";
	}
	else 
		echo "<li>&nbsp;</li>";
?>
			</ul>
	</div>
</section> 
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
