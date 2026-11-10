<!DOCTYPE html>
<html>
<body>
<h2>Form Edit Data Menara</h2>
<?php
        $servername ="localhost";
        $username = "root";
        $password = "";
        $dbname = "latihan";

        $sconn = new mysqli($servername, $username, $password, $dbname);
        if ($sconn->connect_error){
            die("Connection failed: ".$sconn->connect_error);
        }

        if (isset($_GET['id'])) {
    $id  = $_GET['id'];
    $sql = "SELECT * FROM menara_telekomunikasi WHERE id = $id";
    $result = $sconn->query($sql);
    
    if ($result && $result->num_rows > 0) { 
        echo "<form action='edit.php' onsubmit='return validateForm()' method='post'>"; 
        while($row = $result->fetch_assoc()) { 
            echo "<input type='hidden' name='id' value='".$row['id']."'><br>"; 

            echo "<label for='jenis'>Jenis Menara:</label><br>"; 
            echo "<input type='text' id='jenis' name='jenis' value='".$row['jenis']."'><br><br>"; 

            echo "<label for='tinggi'>Tinggi (meter):</label><br>"; 
            echo "<input type='text' id='tinggi' name='tinggi' value='".$row['tinggi']."'><br><br>"; 

            echo "<label for='kecamatan'>Kecamatan:</label><br>"; 
            echo "<input type='text' id='kecamatan' name='kecamatan' value='".$row['kecamatan']."'><br><br>"; 

            echo "<label for='desa'>Desa:</label><br>"; 
            echo "<input type='text' id='desa' name='desa' value='".$row['desa']."'><br><br>"; 

            echo "<label for='latitude'>Latitude (Y):</label><br>"; 
            echo "<input type='text' id='latitude' name='latitude' value='".$row['latitude']."'><br><br>"; 

            echo "<label for='longitude'>Longitude (X):</label><br>"; 
            echo "<input type='text' id='longitude' name='longitude' value='".$row['longitude']."'><br><br>"; 
        } 
        echo "<input type='submit' value='Simpan Perubahan'>";    
        echo "</form>";  
    } else {
        echo "Data tidak ditemukan.";
    }
} else {
    echo "ID tidak ditemukan. Silakan akses dari tabel utama.";
}

$sconn->close();
?>
 
<p id="informasi"></p>

<script> 
    function validateForm() { 
        let tinggi = document.getElementById("tinggi").value; 
        let text = ""; 

        // Cek jika nilai kosong, bukan angka, atau bernilai negatif/nol
        if (tinggi === "" || isNaN(tinggi) || Number(tinggi) < 1) { 
            text = "Data tinggi menara harus berupa angka dan tidak boleh bernilai negatif atau nol!"; 
            document.getElementById("informasi").innerHTML = text; 
            return false; // Menghentikan submit jika data salah
        } 
        
        document.getElementById("informasi").innerHTML = ""; 
        return true; // Lanjut submit jika data valid
    } 
</script>
</body>
</html>