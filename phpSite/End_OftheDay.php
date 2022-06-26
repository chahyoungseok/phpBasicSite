<?php
          
    $con = mysqli_connect("localhost:3307", "root", "", "phpsitedb");
    $sql = "update members set recommend_index=1";
    mysqli_query($con, $sql);
    //여기까지가 추천권한 부여해주는것
    
    $ary_sql = "select * from members order by num";
    $ary_result = mysqli_query($con, $ary_sql);
    $ary_id = array_fill(0,mysqli_num_rows($ary_result),"");
    $ary_recommend = array_fill(0,mysqli_num_rows($ary_result),0);

    for($k=0;$k<mysqli_num_rows($ary_result);$k++){
        mysqli_data_seek($ary_result,$k);
        $ary_row = mysqli_fetch_array($ary_result);
        $ary_id[$k] = $ary_row["id"];
    }
    
    //여기까지가 유저아이디를 통해 배열을 만듬
    //또, 대응되는 추천수를 담을 배열을 만듬

    $photo_sql = "select * from photos order by recommend desc";
    $photo_result = mysqli_query($con,$photo_sql);
    $photo_total_num = mysqli_num_rows($photo_result);

    for($i=0;$i<$photo_total_num;$i++){
        mysqli_data_seek($photo_result,$i);
        $photo_row = mysqli_fetch_array($photo_result);
        
        for($j=0;$j<count($ary_id);$j++){
            if($photo_row["id"]==$ary_id[$j]){
                $ary_recommend[$j] = $ary_recommend[$j] + $photo_row["recommend"];
                break;
            }
        }
    }
    //여기까지가 추천수 세는곳

    for($u=0;$u<count($ary_recommend);$u++){
        $insert_sql = "update members set point=$ary_recommend[$u]";
        $real_u = $u +1;
        $insert_sql .= " where num=$real_u";
        mysqli_query($con, $insert_sql);
    }

    $download_sql = "update members set mydownload=null";
    mysqli_query($con,$download_sql);
//여기는 다운로드 제한 초기화

    mysqli_close($con);     

    echo "
	      <script>
              alert('전체회원의 추천권한이 부여되었습니다.');
              alert('전체회원의 포인트가 갱신되었습니다.');
              alert('전체회원의 다운로드권한이 갱신되었습니다.');
	          location.href = 'index.php';
	      </script>
	  ";
?>

   
