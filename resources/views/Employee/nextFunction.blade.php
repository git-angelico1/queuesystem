<?php
        $mysqli = new mysqli("127.0.0.1", "root", "", "demo1");

            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            $earliestSql = "SELECT * FROM registrar ORDER BY created_at ASC LIMIT 1";

            $result = $mysqli->query($earliestSql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo $row['reg_generate'];
            } else {
                echo '---';
            }

            $mysqli->close();
            ?>