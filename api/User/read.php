<?php
// Headers
// public ou pas 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age : 3600");






//verifier methode
if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    include_once '../../config/Database.php';
    include_once '../../models/User.php';
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
    // Blog post query
    $result = $User->read();
    // Get row count
    $num = $result->rowCount();
    // Check if any posts
    if ($num > 0) {
        $tableauUser = [];
        $tableauUser['User'] = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $user = [
                "IdUser" => $IdUser,
                "nom " => $nom,
                "mail" => $mail,
                "mdp" => $mdp
            ];
            $tableauUser['User'][] = $user;
        }

        http_response_code(200);
        // Turn to JSON & output
        echo json_encode($tableauUser);
    } else {
        // No Posts
        echo json_encode(
            array('message' => 'No Posts Found')
        );
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "methode n'est pas autorisé"]);
}
