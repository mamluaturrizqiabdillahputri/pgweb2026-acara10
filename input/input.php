<?php
$jenis = $_POST['jenis'];    //menerima daata yang dikirim dari formulir
$tinggi = $_POST['tinggi']; 
$kecamatan = $_POST['kecamatan']; 
$desa = $_POST['desa']; 
$latitude = $_POST['latitude']; 
$longitude = $_POST['longitude']; 
 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "latihan"; 
 
$conn = new mysqli($servername, $username, $password, $dbname); 
 
if ($conn->connect_error) { 
die("Connection failed: " . $conn->connect_error); 
} 
$sql = "INSERT INTO menara_telekomunikasi (`jenis`, `tinggi`, `kecamatan`, `desa`, `latitude`, `longitude`) 
        VALUES ('$jenis', '$tinggi', '$kecamatan', '$desa', '$latitude', '$longitude')";
if ($conn->query($sql) === TRUE) { 
echo "New record created successfully"; 
} else { 
echo "Error: " . $sql . "<br>" . $conn->error; 
} 
$conn->close(); 
header("Location: ../index.php"); 
?> 