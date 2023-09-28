<?php
// Include the database connection configuration
include 'config.php';
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "project";

// Check if the "Select Project" button is clicked
if (isset($_POST['selectProject'])) {
    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Loop through the submitted checkboxes
    foreach ($_POST['selectedPDFs'] as $pdfName) {
        $pdfPath = "pdfs/" . $pdfName;

        // Read the PDF file content
        $pdfContent = file_get_contents($pdfPath);

        // Insert the PDF name and content into the "users" table
        $stmt = $conn->prepare("INSERT INTO users (pdfn, fav) VALUES (?, ?)");
        $stmt->bind_param("ss", $pdfName, $pdfContent);
        if ($stmt->execute() !== TRUE) {
            echo "Error inserting PDF: " . $stmt->error;
        }
        $stmt->close();
    }

    // Close the database connection
    $conn->close();

    echo "<script>alert('Project Selected.')</script>";
    echo "<script>window.location.href = 'pdf.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Favorite Projects</title>
    <style>
    /* Your CSS styles here */
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        text-align: center;
        margin: 0;
        padding: 0;
    }

    h1 {
        color: #333;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        margin-bottom: 10px;
    }

    a {
        text-decoration: none;
        color: #0073e6;
    }

    a:hover {
        text-decoration: underline;
    }

    .checkbox-label {
        display: block;
        margin-bottom: 5px;
    }

    #project-select {
        margin-top: 20px;
        padding: 10px;
        background-color: #0073e6;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    #project-select:hover {
        background-color: #005bb9;
    }
    </style>
</head>
<body>
    <h1>Favorite Project</h1>
    <div class="container">
        <form method="post">
            <ul>
                <?php
                // Read the list of favorite PDFs from "favorites.txt"
                $favorites = file("favorites.txt", FILE_IGNORE_NEW_LINES);

                if (empty($favorites)) {
                    echo "<p>No favorite PDFs found.</p>";
                } else {
                    foreach ($favorites as $pdfName) {
                        $pdfPath = "pdfs/" . $pdfName;

                        echo "<li>";
                        echo "<label class='checkbox-label'>";
                        echo "<input type='checkbox' name='selectedPDFs[]' value='$pdfName'>";
                        echo "<a href='$pdfPath' target='_blank'>$pdfName</a>";
                        echo "</label>";
                        echo "</li>";
                    }
                }
                ?>
            </ul>
            <button type="submit" name="selectProject" id="project-select">Select Project</button>
        </form>
    </div>
</body>
</html>
