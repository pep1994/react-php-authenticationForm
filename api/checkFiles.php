<?php 

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

        foreach ($_FILES['file']['name'] as $key => $value) {  
            $err_msg = [];       
            $check = true; 
            if ($_FILES['file']['error'][$key] === UPLOAD_ERR_OK) {
                $files_ext = ['PDF', 'PNG', 'JPG', 'DOC'];
                $file_ext = strtoupper(pathinfo($_FILES['file']['name'][$key], PATHINFO_EXTENSION));
                var_dump($_FILES);
                if (!in_array($file_ext, $files_ext)) {
                    $err_msg[] = "Il file " . $_FILES['file']['name'][$key] . " ha formato " . $file_ext . ", il quale non è consentito";
                    $check = false;  
                }
                if ($_FILES['file']['size'][$key] > 2000000) {
                    $err_msg[] = "Il file " . $_FILES['file']['name'][$key] .  "supera le dimensioni consentite (MAX. 2MB)"; 
                    $check = false;
                }
                if ($check) {
                    $random_name = bin2hex(random_bytes(20)) . "." . strtolower($file_ext);
                    if (!move_uploaded_file($_FILES['file']['tmp_name'][$key], "upload/$random_name")) {
                        echo "Upload fallito di " . $_FILES['file']['name'][$key];
                        return;
                    } 
                } else {
                    foreach ($err_msg as $value) {
                        echo "<p style = 'color: red'>$value</p>";
                    }
                }
            
            }  elseif ($_FILES['file']['error'][$key] ===    UPLOAD_ERR_NO_FILE) {
                echo "file non caricato";
                }  

        }
    }

    


