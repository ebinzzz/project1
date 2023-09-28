<!DOCTYPE html>
<html>
<head>
    <title>Favorite PDFs</title>
    <style>
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
    <h1>Favorite PDFs</h1>
    <div class="container">
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
                    echo "<a href='$pdfPath' target='_blank'>$pdfName</a>";
                    echo "</li>";
                }
            }
            ?>
        </ul>

        <button id="project-select">Select Project</button>
    </div>
</body>
</html>
