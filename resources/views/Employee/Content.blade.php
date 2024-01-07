<h2 style="color: black; font-weight: bold;" id="textToSpeakRegistrar">
            <?php
            $mysqli = new mysqli("127.0.0.1", "root", "", "demo1");

            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            $earliestSql = "SELECT * FROM registrar ORDER BY created_at ASC LIMIT 1";

            $result = $mysqli->query($earliestSql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $queuenumber = $row['reg_generate'];
                $studentname = $row['reg_name'];
                $studentID = $row['reg_studentId'];
                $Purpose = $row['reg_purpose'];
                $otherpurpose = $row['reg_otherPurpose'];

                echo "<span class='regenerate-number'> Queue Number: $queuenumber </span><br>";
                echo "Name: " . $studentname . "<br>";
                echo "ID: " .  $studentID . "<br>";
                echo "Purpose: ";
                
              
                if ($Purpose == "other") {
                    echo $otherpurpose;
                } else {
                    echo $Purpose;
                }
                echo "<br>";

            } else {
                echo '---';
            }

            $mysqli->close();
            ?>
</h2>