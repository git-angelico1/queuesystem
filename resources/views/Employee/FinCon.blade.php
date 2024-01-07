<h2 style="color: black; font-weight: bold;" >
            <?php
            $mysqli = new mysqli("127.0.0.1", "root", "", "demo1");

            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            $earliestSql = "SELECT * FROM finance ORDER BY created_at ASC LIMIT 1";

            $result = $mysqli->query($earliestSql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $queuenumber = $row['fin_generate'];
                $studentname = $row['fin_name'];
                $studentID = $row['fin_studentId'];
                $Purpose = $row['fin_purpose'];
                $otherpurpose = $row['fin_otherPurpose'];

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