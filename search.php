<?php

// Step 1: Establish database connection
include("conn.php");
// Step 2: Get search keyword from user input (assuming it's in $_POST["search"])
if (isset($_POST["search"])) {
    $searchKeyword = mysqli_real_escape_string($conn, $_POST["search"]);

    // Step 3: Construct the SQL query
    $query = "SELECT * FROM users 
              WHERE docnumber LIKE '%$searchKeyword%' 
                 OR dep LIKE '%$searchKeyword%'
                 OR copyto LIKE '%$searchKeyword%'
                 OR topic LIKE '%$searchKeyword%';";

    // Step 4: Execute the query
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    // Step 5: Process and display the results
    // if (mysqli_num_rows($result) > 0) {
    //     while ($row = mysqli_fetch_assoc($result)) {
    //         // Process and display the data here
    //         // For example, you can echo out the results
    //         echo "ID: " . $row["id"] . ", name: " . $row["name"] . ", email: " . $row["email"] . "<br>";
    //     }
    // } else {
    //     echo "No results found.";
    // }

    // // Step 6: Close the database connection
    // mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>البحث</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="fontawesome/css/all.min.css">
    
</head>

<body>
<?php include("menuandnav.php") ?>

<div class="container mt-5  col-3 ">
<h3> <?php echo " نتائج البحث عن". "($searchKeyword)" ?> </h3>
  <form class="form-inline"  action="search.php" method="post" >
    <div class="form-group my-3">
      <label for="searchInput" class="sr-only">بحث</label>
      <input type="text" class="form-control mr-2" id="searchInput" placeholder="ابحث عن رقم الكتاب او الموضوع او القسم..."  name="search" >
    </div>
    <button type="submit" class="btn btn-primary mr-2">ابحث</button>
    <button type="button" class="btn btn-secondary" id="cancelButton">الغاء</button>
  </form>
</div>


   <div class="container my-5 maintable">
   <div class="my-1">
   <a  class='btn btn-primary ' href='home.php'>الرجوع للصفحة الرئيسية</a>
   </div>
   <table class="table table-primary  table-hover table-bordered ">
        <thead>
            <tr>
            <th scope="col"></th>
                <th scope="col">نوع الكتاب</th>
                <th scope="col">رقم الكتاب</th>
                <th scope="col">تاريخ الكتاب</th>
                <th scope="col">القسم الصادر منه</th>
                <th scope="col">درجة السرية</th>
                <th scope="col">نسخه منه الى</th>
                <th scope="col">موضوع الكتاب</th>
                <th scope="col">صورة الكتاب</th>
                <th scope="col"> اخر تحديث</th>
                <th scope="col">اسم المستخدم</th>
                <th scope="col">الملاحضات</th>

                <th scope="col" style="width: 50%">الاجراء</th>
               
            </tr>
        </thead>
      <?php
     
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Process and display the data here
            // For example, you can echo out the results
            echo "
            <tbody>
            <tr>
            <td>  <a href='details.php?id=$row[id]' class='search-link'>
            <i class='fas fa-search'></i> 
          </a> </td>
              <td>$row[doctype]</td>
              <td>$row[docnumber]</td>
              <td>$row[date]</td>
              <td>$row[dep]</td>
              <td>$row[sery]</td>
              <td>$row[copyto]</td>
              <td>$row[topic]</td>
              <td><a href='uploads/$row[filename] '    target='_blank'  /> $row[filename] </a>  </td>
              <td>$row[updateup]</td>
              <td>$row[username]</td>
              <td>$row[notes]</td>
              
             
              
             
    
              
              <td>  
              <a  class='btn btn-primary btn-sm' href='update.php?id=$row[id]'>تحديث </a>
              <a  class='btn btn-danger btn-sm remove'  href='delet.php?id=$row[id]' onclick='confirmationDelete();return false;'>حذف</a>
    
              </td>  
            </tr>
            
            </tbody>";
        }
    } else {
        echo "No results found.";
    }

    // Step 6: Close the database connection
    mysqli_close($conn);    
      // <td><img src='uploads/$row[filename] '   width='300' height='300', class='profile-photo' alt='photo'/>
      ?>
    </table>
   </div>
   <script >
    function confirmationDelete(anchor)
{
   var conf = confirm('هل انت متاكد انك تريد حذف هذا العنصر ؟');
   if(conf)
      window.location=anchor.attr("href");
}

</script>
<script src="code.jquery.com_jquery-3.7.0.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<script>
  $(document).ready(function() {
    // Add click event listener to the cancel button
    $('#cancelButton').click(function() {
      // Clear the search input text
      $('#searchInput').val('');
    });
  });
</script>

</body>


</html>
