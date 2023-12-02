<?php
include_once 'dbConn.php';
include_once 'common/fuggvenyek.php';
$conn = OpenCon();
$user_data = check_login($conn);
?>
<header>
    <div style="font-size: 5vw;rotate: -8.5deg; text-align: center; margin: 80px 0"><?php echo $user_data['jogosultsag'];?></div>
</header>
