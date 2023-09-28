<?php
// Function to remove a PDF from favorites
function removeFromFavorites($pdfName) {
    $favorites = file("favorites.txt", FILE_IGNORE_NEW_LINES);
    $key = array_search($pdfName, $favorites);
    if ($key !== false) {
        unset($favorites[$key]);
    }
    file_put_contents("favorites.txt", implode("\n", $favorites));
}

if (isset($_GET['pdf'])) {
    $pdfName = $_GET['pdf'];

    // Call the removeFromFavorites function to remove the PDF from favorites
    removeFromFavorites($pdfName);

    echo "<script>alert('$pdfName has been removed from favorites.')</script>";
}

// Redirect back to the main page
echo "<script>window.location.href = 'pdf.php';</script>";
?>
