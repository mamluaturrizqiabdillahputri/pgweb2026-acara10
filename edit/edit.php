<?php 
$id        = $_POST['id']; 
$jenis     = $_POST['jenis']; 
$tinggi    = $_POST['tinggi']; 
$kecamatan = $_POST['kecamatan']; 
$desa      = $_POST['desa']; 
$latitude  = $_POST['latitude']; 
$longitude = $_POST['longitude']; 

$servername = "localhost"; 
$username   = "root"; 
$password   = ""; 
$dbname     = "latihan"; 

$conn = new mysqli($servername, $username, $password, $dbname); 

if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 

// Pastikan nama tabel menara_telekomunikasi dan klausa WHERE id=$id sudah benar
$sql = "UPDATE menara_telekomunikasi SET 
            jenis='$jenis', 
            tinggi=$tinggi, 
            kecamatan='$kecamatan', 
            desa='$desa', 
            latitude=$latitude, 
            longitude=$longitude 
        WHERE id=$id"; 

if ($conn->query($sql) === TRUE) { 
    echo "Record updated successfully"; 
} else { 
    echo "Error: " . $sql . "<br>" . $conn->error; 
} 

$conn->close(); 
header("Location: ../index.php"); 
?>
 
