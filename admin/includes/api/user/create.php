<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With");

include_once "../../init.php";

try
{
    $json = file_get_contents("php://input");
    $decoded = json_decode($json, true);
    
    if(!User::check_username($decoded['username'])) {
        if(!User::check_email($decoded['email'])) {
            if($decoded['password'] == $decoded['confirm_password']) {
                if ($new_user = new User()) {
                    $new_user->email = trim(strip_tags($decoded['email']));
                    $new_user->username = trim(strip_tags($decoded['username']));
                    $new_user->password = password_hash(trim(strip_tags($decoded['password'])), PASSWORD_DEFAULT);

                    $new_user->save();
                    $session->login($new_user);
                    echo json_encode(
                        array('message' => $new_user)
                    );
                }
            } else echo json_encode(
                array('message' => 'Passwords didnt match.')
            );
        } else echo json_encode(
            array('message' => 'Email is already taken. Use another.')
        );
    } else echo json_encode(
        array('message' => 'Username already exists. Try some other.')
    );

} catch(Exception $ex) {
    echo json_encode(
        array('message' => $ex.getMessage())
    );
}


?>