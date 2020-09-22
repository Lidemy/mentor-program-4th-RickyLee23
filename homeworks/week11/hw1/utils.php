<?php
    function generateToken(){
        $S = '';
        for ($i=0;$i<16;$i++){
            $S .= chr(rand(65,90));
        }
        return $S;
    }

    function getUserFromUsername($username) {
        global $conn;
        $sql = "select * from RickyLee_messageboardUsers where username = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$username);
        $result = $stmt->execute();
        if (!$result) {
            die('fail:'.$conn->error);
        }
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }

    function escape($str) {
        return htmlspecialchars($str,ENT_QUOTES);
    }

    function selectRole($role_id) {
        global $conn;
        $stmt = $conn->prepare("select * from RickyLee_messageboardRoles where role_id = ? ");
        $stmt->bind_param('i',$role_id);
        $result = $stmt->execute();
        if (!$result) {
            die('fail:'.$conn->error);
        }
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['role_name'];
    }
    
?>
