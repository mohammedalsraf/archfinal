<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>حذف قسم</title>
    <!-- Include Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
   
</head>
<body>
<?php include("menuandnav.php") ?>

    <div class="container mt-4 container my-5 ms-5 maintable" style="text-align:center" >
       
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>اسم القسم</th>
                    <th>العملية</th>
                
                </tr>
            </thead>
            <tbody>
                <?php
                 include("conn.php");
                if($_SERVER['REQUEST_METHOD']==='GET'){
                    if(isset($_GET["id"])){
                        $id=$_GET['id'];
                    $sql="DELETE FROM `dep_table` WHERE id=$id";
                    $res=$conn->query($sql);
                     if(!$res){
                        die( "SQL Fail".mysqli_error($conn));
                     }
                    
                     header("location: add.php");
                    
                    
                    
                    
                    
                    }
                    
                    
                    
                    
                    
                    }
                    
                
              

                $sql = "SELECT * FROM dep_table";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["dep"] . "</td>";
                       echo "<td>  ".
                      
                       " <a  class='btn btn-danger btn-sm remove'  href='showdeletdep.php?id=$row[id]' onclick='confirmationDelete();return false;'>حذف</a>"
              
                       . "</td>  ";
                        
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <!-- Include Bootstrap JS (optional if not using JavaScript elsewhere) -->
    <script src="code.jquery.com_jquery-3.7.0.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script> -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script >
    function confirmationDelete(anchor)
{
   var conf = confirm('هل انت متاكد انك تريد حذف هذا العنصر ؟');
   if(conf)
      window.location=anchor.attr("href");
}

</script>
    
</body>
</html>