
<!DOCTYPE html>
<html>
<head>
    <title>PDF Viewer</title>
</head>
<body>
    <h1>COMPUTER SCIENCE AND ENGINEERING PROJECTS</h1>
    <ul>
        <?php
        // Function to check if a PDF file exists in the "favorites.txt" file
        function isFavorite($pdfName) {
            $favorites = file("favorites.txt", FILE_IGNORE_NEW_LINES);
            return in_array($pdfName, $favorites);
        }

        // Function to get the image filename corresponding to a PDF filename
        function getImageFilename($pdfFilename) {
            $imageFilename = "pdf_images/" . pathinfo($pdfFilename, PATHINFO_FILENAME) . "pdf2.jpeg"; // Assuming images have .jpg extension
            return $imageFilename;
        }

        // Function to get the description corresponding to a PDF filename (you can modify this as needed)
        function getDescription($pdfFilename) {
            // Add your logic to fetch or generate descriptions for PDFs
            // For this example, we're using a placeholder description
            return "Description for $pdfFilename";
        }

        if (isset($_GET['pdf'])) {
            $pdfName = $_GET['pdf'];

            // Read the list of favorite PDFs from "favorites.txt"
            $favorites = file("favorites.txt", FILE_IGNORE_NEW_LINES);

            // Check if the PDF is already in the favorites list
            if (!in_array($pdfName, $favorites)) {
                // Add the PDF to the favorites list
                $favorites[] = $pdfName;

                // Save the updated favorites list back to "favorites.txt"
                file_put_contents("favorites.txt", implode("\n", $favorites));

                echo "<script>alert('$pdfName has been added to favorites.')</script>";
            } else {
                echo "<script>alert('$pdfName is already in favorites.')</script>";
            }

            echo "<script>window.location.href = 'pdf.php';</script>";
        }

        // Scan the "pdfs" directory for PDF files
        $pdfDirectory = "pdfs/";
        $pdfFiles = glob($pdfDirectory . "*.pdf");

        foreach ($pdfFiles as $pdfFile) {
            $pdfName = basename($pdfFile);
            $isFavorite = isFavorite($pdfName);
            $imageFilename = getImageFilename($pdfName);
            $description = getDescription($pdfName);

            echo "<li>";
            echo "<a href='$pdfFile' target='_blank'>$pdfName</a>";

            if ($isFavorite) {
                echo " (Favorite)";
                echo " (<a href='remove_from_favorites.php?pdf=$pdfName'>Remove from Favorites</a>)";
            } else {
                echo " <button class='favorite-btn' onclick='addToFavorites(\"$pdfName\")'>Add to Favorites</button>";
            }
            
            // Add image and description
            echo "<div>";
            echo "<img src='$imageFilename' alt='PDF Image' class='pdf-icon' />";
            echo "<p>$description</p>";
            echo "</div>";
            
            echo "</li>";
        }
        ?>
    </ul>
</body>
</html>
<script>
    function addToFavorites(pdfName) {
        // Send an AJAX request to add_to_favorites.php with the selected PDF name
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "add_to_favorites.php?pdf=" + pdfName, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the UI to indicate that the PDF is now a favorite
                alert("Added to Favorites");
                location.reload(); // Refresh the page to reflect the change
            }
        };
        xhr.send();
    }
</script>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        
        h1 {
            color: #333;
            text-align: center;
        }
        
        ul {
            list-style: none;
            padding: 0;
            margin: 20px;
        }
        
        li {
            background-color: #fff;
            padding: 10px;
            border: 1px solid #ddd;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        a {
            text-decoration: none;
            color: #0073e6;
        }
        
        a:hover {
            text-decoration: underline;
        }
        
        .pdf-icon {
            width: 20px;
            height: 20px;
            margin-right: 5px;
            vertical-align: middle;
        }
        
        .favorite-btn,
        .remove-favorite-btn {
            background-color: #0073e6;
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.2s;
        }
        
        .favorite-btn:hover,
        .remove-favorite-btn:hover {
            background-color: #005bb9;
        }
</style>
