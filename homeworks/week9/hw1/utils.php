<?php
    function generateToken(){
        $S = '';
        for ($i=0;$i<16;$i++){
            $S .= chr(rand(65,90));
        }
        return $S;
    }

    function getUserFromToken($token){
        global $conn;
        $sql = sprintf(
          "select username from RickyLee_tokens where token = '%s' ",
          $token
        );
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $username = $row['username'];

        $sql = sprintf(
            "select * from RickyLee_messageboardusers where username = '%s' ",
            $username
          );
          $result = $conn->query($sql);
          $row = $result->fetch_assoc();
          return $row;
      }
    
?>
