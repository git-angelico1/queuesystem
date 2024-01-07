<h2 style="color: black; font-weight: bold;">
        <div id="serving-content">
            <?php
            $mysqli = new mysqli("127.0.0.1", "root", "", "demo1");

            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            $earliestSql = "SELECT * FROM cashier ORDER BY created_at ASC LIMIT 1";

            $result = $mysqli->query($earliestSql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $queuenumber = $row['cash_generate'];
                $studentname = $row['cash_name'];
                $studentID = $row['cash_studentId'];
                $Purpose = $row['cash_purpose'];
                $otherpurpose = $row['cash_otherPurpose'];

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