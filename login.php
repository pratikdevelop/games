<?php
$pdo = require 'config.php'; 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$data = json_decode(file_get_contents("php://input"));
if(isset($data->email,$data->password) && !empty($data->email) && !empty($data->password))
{
    $email = htmlspecialchars(trim($data->email));
    $password = htmlspecialchars(trim($data->password));
    

    if(filter_var($email, FILTER_VALIDATE_EMAIL) )
    {
        $sql = 'select * from users where email = :email';
        $stmt = $pdo->prepare($sql);
        $p = ['email'=>$email];
        $stmt->execute($p);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount() == 0)
        {
            http_response_code(401);
            echo json_encode(array("message"=>'Email is not found')); 
        }
        else
        {
            $result = password_verify($password, $row['password']);
            if($result == 1) {
                http_response_code(200);
                $_SESSION["loggedIn"] = true;
                $_SESSION["user"] = $row;

                echo json_encode(array("message"=>'login successful'));
            }
            else {
                http_response_code(401);
                echo json_encode(array("message"=>'pssword is not found')); 
            }
            
        }
    }
    else
    {
        http_response_code(401);
        echo json_encode(array("message"=>'Email address is not valid')); 
    }
}
else
{   
    if(!isset($data->email) || empty($data->email))
    {
        $errors[] = 'Email is required';
    }

    if(!isset($data->password) || empty($data->password))
    {
        $errors[] = 'Password is required';
    }

    http_response_code(401);
    echo json_encode(array("message"=>$errors)); 
}
?>