
<style>

/* Reset some default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Set a background color and font family for the whole page */
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    text-align: center;
}

/* Style the page header */
h1 {
    color: #333;
    margin: 20px 0;
}

/* Create a container for the form and result message */
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Style the form label */
label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

/* Style the search input field */
#searchTerm {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Style the search button */
button[name="search"] {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #0073e6;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.2s;
}

/* Add hover effect to the search button */
button[name="search"]:hover {
    background-color: #005bb9;
}

/* Style the result message */
p {
    margin-top: 20px;
    color: #333;
    font-weight: bold;
}

</style>




<style>
    /* Add your CSS styles here */
    /* ... (existing styles) ... */

    /* Style the "Enroll" button */
    button[name="enroll"] {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.2s;
        margin-top: 20px;
    }

    /* Add hover effect to the "Enroll" button */
    button[name="enroll"]:hover {
        background-color: #45a049;
    }
</style>

<?php
// Include the database connection configuration
include 'config.php';

$servername = "localhost";
$username = "root";
$password = '';
$dbname = "project";

// Initialize variables
$searchResultMessage = '';
$foundProject = null;

// Check if the search form is submitted
if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a SQL query to select the project details from the database
    $sql = "SELECT * FROM users WHERE pdfn = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Project found, fetch and store its details
        $foundProject = $result->fetch_assoc();
    } else {
        $searchResultMessage = "Project not found in the database.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search  Project</title>
    <!-- Include your existing CSS styles here -->
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <h1>Search Project</h1>
    <div class="container">
        <form method="post">
            <label for="searchTerm">Search for a  project:</label>
            <input type="text" id="searchTerm" name="searchTerm" required>
            <br>
            <button type="submit" name="search">Search</button>
        </form>
        <p><?php echo $searchResultMessage; ?></p>
        <?php
        if ($foundProject) {
            // Display project details and PDF view
            echo "<h2>Project Details</h2>";
            echo "<p>Project Name: " . $foundProject['pdfn'] . "</p>";

            // You can display additional project details here

            echo "<h2>PDF View</h2>";
            echo "<iframe src='data:application/pdf;base64," . base64_encode($foundProject['fav']) . "' width='100%' height='500px'></iframe>";
           


            // Add an "Enroll" button
            echo "<form method='post'>";
            echo "<button type='submit' name='enroll' value='" . $foundProject['pdfn'] . "'>Enroll</button>";
            
            echo "</form>";
        }
        ?>
    </div>
</body>
</html>
