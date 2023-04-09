<?php
$pdo = require 'config.php'; 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$data = json_decode(file_get_contents("php://input"));
if(isset($data->first_name, $data->last_name, $data->email, $data->password) && !empty($data->first_name) && !empty($data->last_name) && !empty($data->email) && !empty($data->password))
{
    $firstName = (trim($data->first_name));
    $lastName = (trim($data->last_name));
    $email = (trim($data->email));
    $username = (trim($data->username));
    $password = (trim($data->password));
    
    $options = array("cost"=>4);
    $hashPassword = password_hash($password,PASSWORD_DEFAULT);
    $date = date('Y-m-d H:i:s');
    $response = [];

    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $sql = 'select * from users where email = :email';
        $stmt = $pdo->prepare($sql);
        $p = ['email'=>$email];
        $stmt->execute($p);
        
        if($stmt->rowCount() == 0)
        {
            $sql = "insert into users (first_name, last_name, username,email, password, created_date) values(:first_name,:last_name,:username,:email,:password,:created_date)";
        
            try{
                $handle = $pdo->prepare($sql);
                $params = [
                    ':first_name'=>$firstName,
                    ':last_name'=>$lastName,
                    ':username'=>$username,
                    ':email'=>$email,
                    ':password'=>$hashPassword,
                    ':created_date'=>$date
                ];
                
                $handle->execute($params);
                http_response_code(200);
                echo json_encode(array("message" => "registeration successful"));
                
            }
            catch(PDOException $e){
                http_response_code(500);

                echo json_encode(array("message" => "Internal Server Error"));
            }
        }
        else
        {
           http_response_code(404);
            echo json_encode(array("message" => "Email already registered"));

        }
    }
    else
    {   
       http_response_code(404);

        echo json_encode(array("message" => "Email address  not valid"));
    }
}
else
{
   http_response_code(404);
    echo json_encode(array("message" => "please fill all required fields"));
}
?>