<?php

include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        /// LOGIN ///
        if ($_POST['action'] == 'login') {
            header('Content-Type: application/json');

            $input = file_get_contents('php://input'); // Raw data as a string
            parse_str($input, $login); // Array data

            if ($login['username'] === null) {
                $res['message'] = 'Please fill all the information';
                $res['status'] = 'warning';
            }

            if ($login['password'] ===  null) {
                $res['message'] = 'Please fill all the information';
                $res['status'] = 'warning';
            }

            $res = [];


            $table = 'users';

            $sql = "SELECT id, password, username FROM $table
                WHERE username=:username";

            $sth = $db->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $sth->execute(['username' => $login['username']]);

            if ($sth->rowCount() > 0) {
                $password_hash = $sth->fetchColumn(1);
                $username = $sth->fetchColumn(2);

                // LOGIN SUCCESSFUL
                if (password_verify($login['password'], $password_hash)) {

                    
                    
                    $res['message'] = 'Login successful, username: ' . $_SESSION['username'] ;
                    $res['status'] = 'success';

                    $_SESSION['is_logined'] = true;
                    $_SESSION['username'] = 'salam'; 

                // LOGIN FAILED
                } else {
                    $res['message'] = 'Login failed';
                    $res['status'] = 'error';
                }  
            // USER NOT FOUND              
            } else {
                $res['message'] = 'User not found';
                $res['status'] = 'warning';
            }

            echo json_encode($res);

            ///  REGISTER ///
        } elseif ($_POST['action'] == 'register') {
            $user_data = [
                'username' => 'salam',
                'email' => 'email.yeni',
                'firstname' => 'gsdgsdg',
                'lastname' => 'gsdgsg',
                'password' => password_hash('1234', PASSWORD_BCRYPT),
                'phone' => 50,
                'birth' => date('Y-m-d H:i:s'),
                'image' => 'sdgsg',
                'token' => 'dgsdgsdg',
                'otp' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $table = 'users';

            if (insert_data($table, $user_data)) {
                $res['message'] = 'User added';
                $res['status'] = 'success';
            } else {
                $res['message'] = 'User already exists';
                $res['status'] = 'error';
            }

            echo json_encode($res); // Encode the array as a JSON string
        }
    }
}
