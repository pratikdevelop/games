<?php 
    require('config.php');
    if ($_SESSION['loggedIn'] == 1 && $_SESSION['user']) {
        session_destroy();
        http_response_code(200);
        echo json_encode(array("message"=>"logout successfull"));
    }
    else {
        http_response_code(401);
        echo json_encode(array("message"=>"user not login"));
    }