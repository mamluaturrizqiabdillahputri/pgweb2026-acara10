<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "latihan";

$sconn = new mysqli($servername, $username, $password, $dbname);

if ($sconn->connect_error) {
    die("Koneksi gagal: " . $sconn->connect_error);
}

$sql    = "SELECT * FROM menara_telekomunikasi";
$result = $sconn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebGIS Menara Telekomunikasi</title>
    
    <!-- Leaflet CSS Library -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css">
    
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 20px;
        }
        #map {
            height: 500px;
            width: 100%;
            margin-bottom: 20px;
        }
        /* Style Tabel Klasik Sederhana (Latihan 8) */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 4px 8px;
            text-align: left;
        }
        th {
            background-color: #d49393;
        }
    </style>
</head>

<body>

    <h2>WebGIS Data Menara Telekomunikasi</h2>

    <!-- WIDGET PETA LEAFLETJS -->
    <div id="map"></div>

    <!-- LINK INPUT & TABEL KLASIK -->
    <p><a href="input/index.html">Input</a></p>

    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Jenis</th>
                <th>Tinggi</th>
                <th>Kecamatan</th>
                <th>Desa</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['jenis']}</td>
                        <td>{$row['tinggi']}</td>
                        <td>{$row['kecamatan']}</td>
                        <td>{$row['desa']}</td>
                        <td>{$row['latitude']}</td>
                        <td>{$row['longitude']}</td>
                        <td>
                            <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Yakin ingin menghapus?\")'>hapus</a> 
                            <a href='edit/index.php?id={$row['id']}'>edit</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8' align='center'>Data tidak ditemukan</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Leaflet JavaScript Library -->
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>

    <script>
        /* Initial Map */
        var map = L.map('map').setView([-7.71, 110.36], 11);

        /* Tile Basemap */
        var basemap1 = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri'
        });

        var basemap2 = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: 'Map data &copy; Google'
        });

        basemap1.addTo(map);

        /* LOOPING MARKER DARI DATABASE */
        <?php
        if ($result->num_rows > 0) {
            $result->data_seek(0);
            while ($row = $result->fetch_assoc()) {
                $lat       = $row['latitude'];
                $lng       = $row['longitude'];
                $jenis     = addslashes($row['jenis']);
                $tinggi    = $row['tinggi'];
                $kecamatan = addslashes($row['kecamatan']);
                $desa      = addslashes($row['desa']);

                echo "L.marker([$lat, $lng]).addTo(map).bindPopup('<b>Jenis:</b> $jenis<br><b>Tinggi:</b> {$tinggi} m<br><b>Kecamatan:</b> $kecamatan<br><b>Desa:</b> $desa');\n";
            }
        }
        ?>

        /* Control Layer & Scale */
        var baseMaps = {
            "Esri Imagery": basemap1,
            "Google Street": basemap2
        };

        L.control.layers(baseMaps, null, {collapsed: false}).addTo(map);
        L.control.scale({maxWidth: 150, position: 'bottomright'}).addTo(map);
    </script>
</body>
</html>