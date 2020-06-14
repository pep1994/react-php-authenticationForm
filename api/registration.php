<?php 

    $error_msg = [];
    $check = true;

    $method = ($_SERVER[REQUEST_METHOD]);
    if ($method === 'POST' && isset($_POST['submit'])) {

        // controllo nome
        $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
        if (strlen($name) < 1) {
          $error_msg[] = 'Inserire un nome valido';
           $check = false;
        }

        // controllo cognome
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
        if (strlen($name) < 1) {
           $error_msg[] = 'Inserire un cognome valido';
           $check = false;
        }

        // controllo email
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
        if (!$email) {
          $error_msg[] = "La mail inserita non e' valida"; 
          $check = false;
        }

        // controllo password
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        if (strlen($password) < 8 ) {
           $error_msg[] = "La password deve contenere almeno 8 caratteri";
           $check = false;
        }
        if (!preg_match("/[0-9]/", $password)) {
            $error_msg[] = "La password deve contenere almeno un numero";
            $check = false;
        }
        if (!preg_match("/[A-Z]/", $password)) {
            $error_msg[] = "La password deve contenere almeno un lettera maiuscola";
            $check = false;
        }

        // controllo sesso
        if (!filter_has_var(INPUT_POST, 'sesso')) {
            $error_msg[] = "E' necessario indicare il sesso";
            $check = false;
        } elseif ($_POST['sesso'] !== 'm' && $_POST['sesso'] !== 'f') {
           $error_msg[] = 'Il sesso indicato non è valido';
           $check = false;
        }

        $sex = $_POST['sesso'];

        if ($check === false) {
            echo "<h2>Errore nella registrazione</h2>";
            foreach ($error_msg as $msg) {
                echo "<p style = 'color: red'>" . $msg . "</p>";
            }
            echo "<a href='http://localhost:3000/signin'>Torna al form di registrazione</a>";
        } else {
            $conn = new mysqli('localhost', 'root', 'root', 'Users');
            if ($conn -> connect_errno) {
                echo "Connessione fallita" . " errore n° " . $conn -> connect_errno;
                return;
            } else {
                $res = $conn -> query(
                    "
                    SELECT *
                    FROM utenti 
                    WHERE email = '$email'"
                );

                if ($res -> num_rows >= 1) {
                    echo 'Errore nella registrazione: email già esistente';
                } else {
                    $res = $conn -> query(
                        "
                        INSERT INTO utenti (id, name, lastname, email, password, data_registrazione, sex) VALUES (NULL, '$name', '$lastname', '$email', '$password'," . "'" . date("Y-m-d") . "'," . "'$sex')
                        "  
                    ); 

                    if ($res) {
                       echo "<p style='color: green'>La registrazione è avvenuta con successo</p>";
                       echo "<a href='http://localhost:3000/login'>Vai al login</a>";
                    } else {
                        echo "<p style='color: red'>La registrazione è fallita</p>";
                        echo "<a href='http://localhost:3000/signin'>Torna al form di registrazione</a>";
                    }

                }
            }

            $conn -> close();
        }
        
    }