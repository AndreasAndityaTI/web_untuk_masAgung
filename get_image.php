<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    try {
        // Prepare the SQL query to prevent SQL injection
        $query = $config->prepare("SELECT gambar FROM barang WHERE id = ?");
        $query->execute([$id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result && !empty($result['gambar'])) {
            // Set the Content-Type header before outputting the image
            header("Content-Type: image/jpeg");
            echo $result['gambar'];
        } else {
            // Send appropriate headers and a message if the image is not found
            header('Content-Type: text/plain');
            echo 'Gambar tidak ditemukan.';
        }
    } catch (Exception $e) {
        // Handle any errors during the database query
        header('Content-Type: text/plain');
        echo 'Terjadi kesalahan saat mengambil gambar: ' . htmlspecialchars($e->getMessage());
    }
} else {
    // Send appropriate headers and a message for an invalid or missing ID
    header('Content-Type: text/plain');
    echo 'ID tidak valid.';
}
?>
