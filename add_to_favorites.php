<?php
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
?>
