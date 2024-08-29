<?php

include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        /// LOGIN ///
        if ($_POST['action'] == 'login') {
            $input = file_get_contents('php://input'); // Raw data as a string
            parse_str($input, $login); // Array data

            $table = 'users';

            $sql = "SELECT id, password FROM $table
                WHERE username=:username";

            $sth = $db->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $sth->execute(['username' => $login['username']]);
            if ($sth->rowCount() > 0) {
                $user_info = $sth->fetchAll();
                
            }

            // $sql = "insert into users (name, password) value ( '" . $login['name'] . "', '" . $login['password'] . "')";
            // if ($db->query($sql)) {
            //     $res['message'] = 'User added';
            //     $res['status'] = 'success';
            // } else {
            //     $res['message'] = 'User didn\'t added';
            //     $res['status'] = 'error';
            // }

            // header('Content-Type: text/plain');
            // echo json_encode($sql); // Encode the array as a JSON string

            ///  REGISTER ///
        } elseif ($_POST['action'] == 'register') {
            $user_data = [
                'username' => 'khalafnasirov',
                'email' => 'email.com',
                'firstname' => 'gsdgsdg',
                'lastname' => 'gsdgsg',
                'password' => '1234',
                'phone' => 50,
                'birth' => 'sgddsg',
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
