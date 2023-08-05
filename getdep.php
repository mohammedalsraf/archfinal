<?php

    include("conn.php");
    ////////////////////////////// GET DEP
$depQuery = "SELECT id, dep FROM dep_table"; 
$result = $conn->query($depQuery);

// Check if data was fetched successfully
$deps = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $deps[] = $row;
    }
}
//////////////////////////////////////////////////////// end of get Dep





?>