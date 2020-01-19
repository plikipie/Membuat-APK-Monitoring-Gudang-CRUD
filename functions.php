<?php 
// koneksi database
    $conn = mysqli_connect("localhost", "root", "","laporankp");


function query ($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}
function tambah($data) {
    global $conn;
    $kode_barang = htmlspecialchars ($data["kode_barang"]);
    $nama_barang = htmlspecialchars ($data["nama_barang"]);
    $jumlah_barang = htmlspecialchars ($data["jumlah_barang"]);
    $tgl_masuk = htmlspecialchars ($data["tgl_masuk"]);
    

    $query = "INSERT INTO tugaskp VALUES 
            ('','$kode_barang','$nama_barang','$jumlah_barang','$tgl_masuk')
            ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
    } 
    
    function hapus($no) {
        global $conn;
        mysqli_query($conn, "DELETE FROM tugaskp WHERE no = $no");
        return mysqli_affected_rows($conn);
    }

    function ubah ($data) {
        global $conn;
        $no = $data["no"];
        $kode_barang = htmlspecialchars ($data["kode_barang"]);
        $nama_barang = htmlspecialchars ($data["nama_barang"]);
        $jumlah_barang = htmlspecialchars ($data["jumlah_barang"]);
        $tgl_masuk = htmlspecialchars ($data["tgl_masuk"]);
        
        
        $query = "UPDATE tugaskp SET 
               kode_barang = '$kode_barang',
               nama_barang = '$nama_barang',
               jumlah_barang = '$jumlah_barang',
               tgl_masuk = '$tgl_masuk'
               WHERE no = $no
               ";
        mysqli_query($conn, $query);  
    }

    function cari($keyword) {
        $query = "SELECT * FROM tugaskp WHERE 
        kode_barang LIKE '%$keyword%' OR 
        nama_barang LIKE '%$keyword%' OR 
        jumlah_barang LIKE '%$keyword%' OR 
        tgl_masuk LIKE '%$keyword%' 
        ";
        return query($query);
    }

    function registrasi ($data) {
        global $conn;

        $username =strtolower (stripslashes($data["username"]));
        $password = mysql_real_escape_string($data["password"]);
        $password2 = mysql_real_escape_string($data["password2"]);
        $email = strtolower (stripslashes($data["email"]));

        // cek konfirmasi password  
        if($password != $password2 ) {
            echo "<script>
                alert('Konfirm Password tidak sesuai')';
            </script>";
            return false;
        }
    }

?> 
