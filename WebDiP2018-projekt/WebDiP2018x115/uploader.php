<!DOCTYPE html>
<html>
    <head>
       
        <meta charset="utf-8">
    </head>
    <body>
        <?php
        $userfile = $_FILES['userfile']['tmp_name'];
        $userfile_name = $_FILES['userfile']['name'];
        $userfile_size = $_FILES['userfile']['size'];
        $userfile_type = $_FILES['userfile']['type'];
        $userfile_error = $_FILES['userfile']['error'];
        $tipoviSlike =["image/jpeg","image/png"];
        if (!in_array($userfile_type, $tipoviSlike)){
            $_POST["MAX_FILE_SIZE"] = 250000;
        }
        else{
            $_POST["MAX_FILE_SIZE"] = 500000;
        }
        if ($userfile_error > 0) {
            echo 'Problem: ';
            switch ($userfile_error) {
                case 1: echo 'Veličina veća od ' . ini_get('upload_max_filesize');
                    break;
                case 2: echo 'Veličina veća od ' . $_POST["MAX_FILE_SIZE"] . 'B';
                    break;
                case 3: echo 'Datoteka djelomično prenesena';
                    break;
                case 4: echo 'Datoteka nije prenesena';
                    break;
            }
            exit;
        }
        $tipoviPolje = ["image/jpeg","image/png","audio/mp3","video/mp4","image/JPEG","image/PNG","audio/MP3","video/MP4"];
        if (!in_array($userfile_type, $tipoviPolje)) {
            echo 'Problem: Pogrešan format' . $userfile;
            exit;
        }
        $upfile = 'podaci/datoteke/' . $userfile_name;

        if (is_uploaded_file($userfile)) {
            if (!move_uploaded_file($userfile, $upfile)) {
                echo 'Problem: nije moguće prenijeti datoteku na odredište';
                exit;
            }
        } else {
            echo 'Problem: mogući napad prijenosom. Datoteka: ' . $userfile_name;
            exit;
        }

        echo 'Datoteka uspješno prenesena<br /><br />';
        
        ?>
    </body>
</html>
