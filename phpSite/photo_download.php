<?php
    $userid = $_GET["userid"];
    $photo_num = $_GET["photo_num"];
    $download_hit = $_GET["download_hit"];
    $status = true;
    
    $con = mysqli_connect("localhost:3307","root","","phpsitedb");
    $download_hit = $download_hit +1;
    $sql = "update photos set download_hit=$download_hit";
    $sql .= " where num='$photo_num'";
    mysqli_query($con,$sql);
//여기까지가 다운로드 횟수 증가

    $sql = "select * from members where id='$userid'";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    $mydownload = $row["mydownload"];

    $mydownload_ary = explode(",",$mydownload);

    for($i=0;$i<count($mydownload_ary);$i++){
        
        if($mydownload_ary[$i]==$photo_num){
            $status = false;
        }
    }
    
    if($status){
        if($mydownload == 0 or $mydownload ==null){
            $mydownload = $photo_num;
        }
        else{
            $mydownload = $mydownload.",".$photo_num;
        }

        $sql = "update members set mydownload='$mydownload'";
        $sql .= " where id='$userid'";
        mysqli_query($con,$sql);

        $real_name = $_GET["real_name"];
        $file_name = $_GET["file_name"];
        $file_type = $_GET["file_type"];
        $file_path = "./data/".$real_name;

        $ie = preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || 
            (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0') !== false && 
                strpos($_SERVER['HTTP_USER_AGENT'], 'rv:11.0') !== false);

        if( $ie ){
             $file_name = iconv('utf-8', 'euc-kr', $file_name);
        }

        if( file_exists($file_path) )
        { 
            $fp = fopen($file_path,"rb"); 
            Header("Content-type: application/x-msdownload"); 
            Header("Content-Length: ".filesize($file_path));     
            Header("Content-Disposition: attachment; filename=".$file_name);   
            Header("Content-Transfer-Encoding: binary"); 
            Header("Content-Description: File Transfer"); 
            Header("Expires: 0");       
        } 

        if(!fpassthru($fp)) {
            fclose($fp); 
        }
    }
    else{
        echo "<script>
            alert('오늘 이미 다운로드 한 사진입니다. 내일 다운로드 해주시기 바랍니다.');
            history.go(-1);
        </script>";
    } 
?>

  
