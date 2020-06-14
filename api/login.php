<?php

    $err_msg = [];
    $check = true;
    

    $method = $_SERVER[REQUEST_METHOD];
    if ($method === 'POST' && isset($_POST['loginSubmit'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if (!$email) {
            echo "La mail inserita non e' valida";
            return; 
        }
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        if (strlen($password) < 8 || !preg_match("/[0-9]/", $password) || !preg_match("/[A-Z]/", $password)) {
            echo "La password inserita non è valida";
            return;
        }
        $conn = new mysqli('localhost', 'root', 'root', 'Users');
            if ($conn -> connect_errno) {
                echo "Connessione fallita" . " errore n° " . $conn -> connect_errno;
                return;
            } else {
                $res = $conn -> query(
                    "
                    SELECT *
                    FROM utenti 
                    WHERE email = '$email' AND password = '$password'
                    "
                );
                var_dump($res);

                if ($res -> num_rows === 0) {
                   echo "email o password non corretta <br>";
                   echo "<a href=''>Torna al login</a>";
                } elseif($res -> num_rows === 1) {
                    $row = $res -> fetch_assoc();
                    $id_user = $row['id'];
                    $name_user = $row['name'];
                    $lastname_user = $row['lastname'];
                    echo "Login effettuato con successo <br>";
                    echo "<a href='http://localhost:3000/dashboard/$id_user/$name_user/$lastname_user'>Vai alla mia dashboard</a>";
                }

            }

            $conn -> close();
        
    }

