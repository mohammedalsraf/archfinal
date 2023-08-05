<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to the login page
    exit();
}
include("conn.php");


?>
<!DOCTYPE html  >
<html lang="en"  dir="rtl">

<head >
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="fontawesome/css/all.min.css">


</head>

<body>
<?php include("menuandnav.php") ?>

<!-- search  -->
<div class="container mt-5 col-3">
<form   action="search.php" method="post" >
  <div style="margin-bottom:7px "><label  style="font-weight: bold;">ابحث عن رقم الكتاب او الموضوع اوالقسم ...</label></div>
  <div class="row">
    <div class="col-md-6">
      <!-- Input text -->
      <input type="text" class="form-control mr-2" id="searchInput" placeholder="ابحث عن كتاب .."  name="search" >
    </div>
    <div class="col-md-2">
      <!-- First button -->
      <button type="submit" class="btn btn-primary mr-2">بحث</button>
    </div>
    <div class="col-md-3">
      <!-- Second button -->
      <button type="button" class="btn btn-danger mr-2" id="cancelButton">الغاء</button>
    </div>
  </div>
</form>
</div>
<!-- search  -->


<!-- Table -->
   <div class="container my-5 ms-5 maintable">
  
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

                <th scope="col" style="width: 10%">الاجراء</th>
            </tr>
        </thead>
      <?php
      $limit = 12; // Number of records to display per page
      $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $offset = ($current_page - 1) * $limit;

    // Query to retrieve data for the current page
      $sql="SELECT * FROM users ORDER BY updateup DESC LIMIT $limit OFFSET $offset"; //query
      $qres=$conn->query($sql);// save query in qres
      if(!$qres){
         die("Incorrect SQL query ". mysqli_error($conn));
    }

    // Query to get the total number of rows in the table
          $count_query = "SELECT COUNT(*) as total FROM users";
          $count_result = $conn->query($count_query);
          $total_rows = $count_result->fetch_assoc()['total'];
          $total_pages = ceil($total_rows / $limit);
   
      while( $row=$qres->fetch_assoc()){
        // print_r($row);
        // $imageURL = 'uploads/'.$row["filename"];
        // echo $imageURL;
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
      // <td><img src='uploads/$row[filename] '   width='300' height='300', class='profile-photo' alt='photo'/>
      ?>
    </table>
      <!-- Display the pagination links in multiple rows -->
    <!-- Display the pagination links in multiple rows -->
    <div class="scroll">
    <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                    <li class="page-item <?php if ($current_page === $i) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
   </div>
  
    <!-- Table -->


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