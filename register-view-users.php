<!doctype html>
<html lang=en>

<head>
    <title>View users page</title>
    <meta charset=utf-8>
    <link rel="stylesheet" type="text/css" href="includes.css">
</head>

<body>
        <div id="container">
                    <?php include("header.php"); ?>
                    <?php include("nav.php"); ?>
                    <?php include("info-col.php"); ?>
            <div id="content">
                            <!-- Start of the content of the table of users page. -->
                            <h2>These are the registered users</h2>
                            <p>
                <?php
                    // This script retrieves all the records from the users table.
                    require('mysqli_connect.php'); // Connect to the database.
                    // Make the query: 
                    $q = "SELECT CONCAT(lname, ', ', fname) AS name, DATE_FORMAT(registration_date, '%M %d, %Y') AS regdat FROM users ORDER BY registration_date ASC";

                    $result = @mysqli_query ($dbcon, $q); // Run the query.

                    if ($result) { // If it ran OK, display the records.
                    // Table header. 
                            echo '<table> <tr><td><b>Name</b></td><td><b>Date Registered</b></td></tr>';
                            // Fetch and print all the records: #3
                            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                echo '<tr>
                                        <td>' . $row['name'] . '</td>
                                        <td>' . $row['regdat'] . '</td>
                                    </tr>'; 
                                }
                                echo '</table>'; // Close the table so that it is ready for displaying.
                            mysqli_free_result ($result); // Free up the resources.
                        } else { // If it did not run OK.
                            // Error message:
                            echo '<p class="error">The current users could not be retrieved. We apologize for any inconvenience.</p>';
                            // Debug message:
                            echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
                    } // End of if ($result)
                    mysqli_close($dbcon); // Close the database connection.
                ?>
            </div><!-- End of the user’s table page content -->
            <?php include("footer.php"); ?>
        </div>
</body>

</html>