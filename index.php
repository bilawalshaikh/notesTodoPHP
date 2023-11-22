<?php 

// //variables
// $insert=false;
// $update=false;
// $delete=false;
// //connected to the database

// $server="localhost";
// $username="root";
// $password="";
// $database="notes";


// $conn= mysqli_connect($server,$username,$password,$database);

// if(!$conn){
// die("Sorry we failed to connect:". mysqli_connect_error());   
// }

// if(isset($_GET['delete'])){
//   $sno = $_GET['delete'];
//   // $delete = true;
//   $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
//   $result = mysqli_query($conn, $sql);
// }


// //Insertion 
// if($_SERVER['REQUEST_METHOD'] == 'POST'){
//   if(isset($_POST['snoEdit'])){
//     //update the record
    
//     $sno=$_POST['snoEdit'];
//     $title=$_POST['titleEdit'];    
// $description=$_POST['descriptionEdit'];

// $sql=
// "UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`sno` = $sno";
// $results=mysqli_query($conn,$sql);


// if($results){
//   // echo "inserted";
//   $update=true;
// }else{
//   echo "not inserted";
// }    
    
//   }
//   else{


  
// $title=$_POST['title'];    
// $description=$_POST['description'];

// $sql="INSERT INTO `notes` ( `title`, `description`) VALUES ( '$title', '$description');";
// $results=mysqli_query($conn,$sql);

// if($results){
//     // echo "inserted";
//     $insert=true;
// }else{
//     echo "not inserted";
// }
//   }
// }

?>


<?php  
// INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'But Books', 'Please buy books from Store', current_timestamp());
$insert = false;
$update = false;
$delete = false;
// Connect to the Database 
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Die if connection was not successful
if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['snoEdit'])){
  // Update the record
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $description = $_POST["descriptionEdit"];

  // Sql query to be executed
  $sql = "UPDATE `notes` SET `title` = '$title' , `description` = '$description' WHERE `notes`.`sno` = $sno";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{
    $title = $_POST["title"];
    $description = $_POST["description"];

  // Sql query to be executed
  $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$title', '$description')";
  $result = mysqli_query($conn, $sql);

   
  if($result){ 
      $insert = true;
  }
  else{
      echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
  } 
}
}
?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes -Notes takin made easy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">  
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>

</head>
  <body>


   <!-- Edit Modal -->
   <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/php-practice/notesProject/index.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="titleEdit" name="titleEdit" aria-describedby="emailHelp">
            </div>


            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
            <button class="btn btn-primary">Update Notes</button> 
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!--  -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">NOTES</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
              </li>
             
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>

<!-- uska -->
<?php
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your note has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
<!-- uska -->
<?php
// if($insert=true){
//     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
//     <strong>Success!</strong> Your note has been inserted succesfully.
//     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
//   </div>";
// }
?>



<?php
// if($update=true){
//     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
//     <strong>Success!</strong> Your note has been updated succesfully.
//     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
//   </div>";
// }
?>

<?php
// if($delete=true){
//     echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
//     <strong>Success!</strong> Your note has been deleted succesfully.
//     <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
//   </div>";
// }
?>

      <!-- <div class="container my-4">
        <h2>Add a Note</h2>
        <form action="/php-practice/notesProject/index.php" method="post">
            <div class="mb-3">
              <label for="title" class="form-label">Node Title</label>
              <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
              
        
            <div class="mb-3">
                <label for="description" class="form-label">Node description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
              </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
          </form>
      </div>


      <div class="container my-4">



<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.NO</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody> -->
  <?php
// $sql="SELECT * FROM `notes`";
// $results=mysqli_query($conn,$sql);
// $sno=0;
// while($row =mysqli_fetch_assoc($results)){
//     $sno= $sno+1;
//     echo "<tr>
//     <th scope='row'>". $sno . "</th> 
//     <td>". $row['title'] . "</td>
//     <td>". $row['description'] . "</td>
//     <td> 
//     <button class='edit btn btm-sm btn-primary' id=".$row['sno'].">Edit</button>
//     <button class='delete btn btm-sm btn-primary' id=d".$row['sno'].">Delete</button>
    
    
    
//     </td>
//   </tr>";
  


// }
?>
    
  
  <!-- </tbody>
</table>
      </div>

<hr> -->
<!--  -->

<div class="container my-4">
    <h2>Add a Note to iNotes</h2>
    <form action="/php-practice/notesProject/index.php" method="post">

    <!-- <form action="/crud/index.php" method="POST"> -->
      <div class="form-group">
        <label for="title">Note Title</label>
        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
      </div>

      <div class="form-group">
        <label for="desc">Note Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Note</button>
    </form>
  </div>

  <div class="container my-4">


    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql = "SELECT * FROM `notes`";
          $result = mysqli_query($conn, $sql);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)){
            $sno = $sno + 1;
            echo "<tr>
            <th scope='row'>". $sno . "</th>
            <td>". $row['title'] . "</td>
            <td>". $row['description'] . "</td>
            <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>  </td>
          </tr>";
        } 
          ?>


      </tbody>
    </table>
  </div>
  <hr>


<!--  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  

<!--  -->
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script> -->
<!--  -->

    <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        console.log(title, description);
        titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this note!")) {
          console.log("yes");
          window.location = `/php-practice/notesProject/index.php?delete=${sno}`;

          // window.location = `/crud/index.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>












    <!-- <script>
        edits=document.getElementsByClassName('edit');
        Array.from(edits).forEach((element)=>{
            element.addEventListener("click",(e)=>{
              console.log("edit ", );
           tr=e.target.parentNode.parentNode;
           title = tr.getElementsByTagName("td")[0].innerText;
           description = tr.getElementsByTagName("td")[1].innerText;
           console.log(title,description);
           titleEdit.value=title;
           descriptionEdit.value=description;
           snoEdit.value=e.target.id;
           console.log(e.target.id);
           $('#editModal').modal('toggle');
       })
        })


        //dekete
        deletes=document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element)=>{
            element.addEventListener("click",(e)=>{
              console.log("edit ", );
             sno=e.target.id.substr(1,);
       
       if(confirm("Press a button")){
        console.log("yes");
        window.location = `/php-practice/notesProject/index.php?${sno}`
       }else{
        console.log("no");
       }
       
       
        })
        })


    </script> -->
  

</body>
</html>