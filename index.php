<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tugas 3</title>
</head>
<body>
    <!-- Judul tabel -->
    <h3 id="judul_tabel">Daftar Pembelian</h3>

    <!-- Tabel -->
    <table align="center" border="1" cellpadding="10" cellspacing="0" border="1">
        <thead>
            <tr bgcolor="greenyellow">
                <!-- Header kolom -->
                <?php
                    $ar_judul = 
                    [
                        'NO',
                        'NAMA',
                        'PRODUCT',
                        'JUMLAH BELI',
                        'HARGA SATUAN',
                        'HARGA KOTOR',
                        'DISKON',
                        'PPN',
                        'HARGA BERSIH'
                    ];

                    // Menambahkan header kolom dengan PHP
                    foreach ($ar_judul as $jdl) 
                    {
                        echo "<th>$jdl</th>";
                    }
                ?>
            </tr>
        </thead>
        <tbody id="data">
            <!-- Data Pembelian akan ditambahkan melalui PHP di sini -->
            <?php
                // Data Pembelian
                $p1 = ['nama' => 'Budi Santoso', 'Product' => 'TV', 'quantity' => '3'];
                $p2 = ['nama' => 'Siti Aminah', 'Product' => 'AC', 'quantity' => '2'];
                $p3 = ['nama' => 'Alisa', 'Product' => 'AC', 'quantity' => '5'];
                $p4 = ['nama' => 'I Putu Gede', 'Product' => 'TV', 'quantity' => '1'];
                $p5 = ['nama' => 'Sri Rezeki', 'Product' => 'Kulkas', 'quantity' => '1'];
                $p6 = ['nama' => 'Hanif Rizqi', 'Product' => 'Kulkas', 'quantity' => '3'];

                $ar_pelanggan = [$p1, $p2, $p3, $p4, $p5, $p6];

                //  Fungsi untuk menghitung harga
                function HargaSatuan ($product)
                {
                    switch ($product)
                    {
                        case 'TV':
                            return 3000000;
                        case 'AC':
                            return 4000000;
                        case 'Kulkas':
                            return 5000000;
                        default:
                            return 0;
                    }
                }

                // inilisasi nomor urutan
                $no = 1;

                // loop untuk menanmpilkan data pembeli dalam tabel
                foreach ($ar_pelanggan as $pembeli)
                {
                    $nama = $pembeli['nama'];
                    $product = $pembeli['Product'];
                    $quantity = $pembeli['quantity'];
                    
                    // Menghitung harga satuan produk
                    $hargaSatuan = HargaSatuan($product);

                    // Menghitung harga kotor
                    $quantity = empty($pembeli['quantity']) ? 0 : $pembeli['quantity'];
                    if (!is_numeric($quantity)) {
                        $quantity = 0; // Set nilai default jika quantity tidak valid
                    }
                    $hargaKotor = $hargaSatuan * $quantity;
                    
                    // Menghitung diskon
                    $diskon = ($product == 'Kulkas' && $quantity >= 3) ? 0.3 * $hargaKotor : 0.1 * $hargaKotor;

                    // Menghitung PPN
                    $ppn = 0.11 * ($hargaKotor - $diskon);

                    // Menghitung Harga Bersih
                    $hargaBersih = ($hargaKotor - $diskon) + $ppn;
                    
                    // Membuat warna acak untuk setiap baris tabel
                    $warna = sprintf("#%06X", mt_rand(0, 0xFFFFFF));

                    echo "<tr bgcolor='$warna'>";
                    echo "<td>$no</td>"; // Nomor urutan
                    echo "<td>$nama</td>";
                    echo "<td>$product</td>"; // Ini seharusnya menampilkan nama produk
                    echo "<td>$quantity</td>";
                    echo "<td> Rp. " . number_format($hargaSatuan, 0 ,',',',') . "</td>"; // Ini seharusnya menampilkan harga satuan
                    echo "<td> Rp. " . number_format($hargaKotor, 0, ',',',') . "</td>";
                    echo "<td> Rp. " . number_format($diskon, 0 ,',',',') . "</td>";
                    echo "<td> Rp. " . number_format($ppn, 0 ,',',',') . "</td>";
                    echo "<td> Rp. " . number_format($hargaBersih, 0 ,',',',') . "</td>"; // Menambahkan elemen untuk harga bersih
                    echo '</tr>';

                    // Increment nomor urutan
                    $no++; 
                }  
            ?>
        </tbody>
    </table>
</body>
</html>
