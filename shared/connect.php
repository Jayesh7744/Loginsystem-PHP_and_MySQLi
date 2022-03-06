<?php
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "jaynew";

        $conn = mysqli_connect($server, $username, $password, $database);

        if (!$conn) {
            die ("error" . mysqli_connect_error());
        }


?>