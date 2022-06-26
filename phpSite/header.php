<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
    if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
    else $userpoint = "";
    if (isset($_SESSION["mylike"])) $mylike = $_SESSION["mylike"];
    else $mylike = "";
?>		
        <nav class="nav">
            <h3>
                <li><a href="index.php">PHP Site</a></li>
            </h3>
            <ul>
<?php
    if(!$userid) {
?>                
                <li><a href="membership_form.php">MemberShip</a> </li>
                <li><a href="mylogin_form.php">Login</a></li>
<?php
    } else {
?>
                <li><a href="mylogout.php">Logout</a> </li>
                <li><a href="membership_modify_form.php">Changing Information</a></li>
                <li><a href="myphoto_list_form.php?id=<?=$userid?>">MyPhotos</a></li>
                <li><a href="photo_upload_form.php">Photo Upload</a></li>
                <li><a href="photo_list_form.php">Photo List</a></li>
                <li><a href="messageList_form.php">Message List</a></li>
                <li><a href="friends_form.php">Friends</a></li>
<?php
    }
    if($userpoint>=1000) {
?>
                <li><a href="End_OftheDay.php">Settle the day</a></li>
<?php
    }
                if($userid){
?>
                <li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li><li>&nbsp;</li>
                <li>My Point :
                    <?=$userpoint?></li>
                <?php
                }
                    ?>
            </ul>
        </nav>
        <div id="header_img_bar">
            <img src="./img/mainback2.PNG" width="100%"; height="315px";>
        </div>