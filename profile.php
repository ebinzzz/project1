<?php
@include 'config.php';
session_start();

// Check if the user is logged in and has a valid student_id in the session


// Retrieve the student_id from the session
$email = $_SESSION['email'];

// The rest of your code remains mostly the same
?>
<?php
$sql = "SELECT * FROM  users where email = '$email' ";
$result = mysqli_query($conn, $sql);
if ($result){
   
  while($row = mysqli_fetch_assoc($result)){
    $id=$row['id'];
    $name=$row['name'];
    $email=$row['email'];
    $password=$row['password'];
  }
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Student Profile Page Design Example</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <meta name="author" content="Codeconvey" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet"><link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>

        
        <div class="col-rt-2">
            <ul>
                
            </ul>
        </div>
    </div>
</div>

<header class="ScriptHeader">
    <div class="rt-container">
    	<div class="col-rt-12">
        	<div class="rt-heading">
            	<h1><p>STUDENT PROFILE</p></h1>
                
            </div>
        </div>
    </div>
</header>

<section>
    <div class="rt-container">
          <div class="col-rt-12">
              <div class="Scriptcontent">
              
<!-- Student Profile -->
<div class="student-profile py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="card shadow-sm">
        <div class="card-header bg-transparent text-center">
        <?php
// Retrieve the profile image path from the database based on student_id
$sql = "SELECT profile_image FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $profileImagePath = $row['profile_image'];

    // Check if a profile image path is found and not empty
    if (!empty($profileImagePath)) {
        // Define the width and height for the small image
        $smallWidth = 100; // Adjust as needed
        $smallHeight = 120; // Adjust as needed

        // Display the image with CSS styles for smaller dimensions
        echo '<img class="profile_img" src="' . $profileImagePath . '" alt="student dp" style="width: ' . $smallWidth . 'px; height: ' . $smallHeight . 'px;">';
    } else {
        // Display a default image if the profile image path is empty
        echo '<img class="profile_img" src="default_profile_image.jpg" alt="student dp">';
    }
} else {
    // Display a default image if the query fails or no result found
    echo '<img class="profile_img" src="default_profile_image.jpg" alt="student dp">';
}
?>

        <h3><?php echo $name;?></h3>
    </div>
          <div class="card-body">
            <p class="mb-0"><strong class="pr-1">Student ID:</strong><?php echo $student_id?></p>
            <p class="mb-0"><strong class="pr-1">Class:</strong>S5-CS</p>
            <p class="mb-0"><strong class="pr-1">Section:</strong>A</p>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card shadow-sm">
          <div class="card-header bg-transparent border-0">
            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>General Information</h3>
          </div>
          <div class="card-body pt-0">
            <table class="table table-bordered">
              <tr>
                <th width="30%">Name</th>
                <td width="2%">:</td>
                <td><?php echo $name;?></td>
              </tr>
              <tr>
                <th width="30%">E-mail</th>
                <td width="2%">:</td>
                <td><?php echo $email;?></td>
              </tr>
            </table>
          </div>
        </div>
         
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
           
    		</div>
		</div>
    </div>
</section>

     


    <!-- Analytics -->

	</body>
</html>
<script>
    $(document).ready(function() {
        $(".toggle-table").click(function() {
            $(".identity-table").toggle();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".toggle-table1").click(function() {
            $(".identity-table1").toggle();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".toggle-table2").click(function() {
            $(".identity-table2").toggle();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $(".toggle-table3").click(function() {
            $(".identity-table3").toggle();
        });
    });
</script>
<style>
  .rt-heading{
    text-align:center;
  }
  </style>