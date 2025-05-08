<?php

function select($query)
{
 global $db;
 $result =mysqli_query($db, $query);
 $rows = [];
 while($row = mysqli_fetch_array($result))
 { 
    $rows[] = $row;
    }
    return $rows;
return $result;
}


function delete_barang($id_barang)

{
    global $db;
    $query = "DELETE FROM barang WHERE id_barang = $id_barang";
    
    mysqli_query($db, $query);
    
    return mysqli_affected_rows($db);
    


}

function create_anggota($post)
{
    global $db;

    // Ambil data dari form dan sanitasi input
 
    $nama    = strip_tags($post['nama']);
    $email = strip_tags($post['email']);
    $alamat        = $post['alamat'];
    $no_hp = strip_tags($post['no_hp']);
    $tanggal_daftar = strip_tags($post['tanggal_daftar']);

   

    // Query untuk update data siswa
    $query = "INSERT INTO anggota VALUES(null,'$nama','$email','$alamat', '$no_hp','$tanggal_daftar')";
    // Eksekusi query
    mysqli_query($db, $query);

    // Mengembalikan hasil apakah ada perubahan data
    return mysqli_affected_rows($db);
}

function update_anggota($post)
{
    global $db;

    // Ambil data dari form
    $id_anggota = strip_tags($post['id_anggota']);
    $nama    = strip_tags($post['nama']);
    $email = strip_tags($post['email']);
    $alamat        = $post['alamat'];
    $no_hp = strip_tags($post['no_hp']);
    $tanggal_daftar = strip_tags($post['tanggal_daftar']);

    // Query untuk update data di tabel anggota
    $query = "UPDATE anggota SET nama = '$nama', email = '$email', alamat = '$alamat', no_hp = '$no_hp', tanggal_daftar = '$tanggal_daftar' WHERE id_anggota = $id_anggota";

    // Eksekusi query
    mysqli_query($db, $query);

    // Kembalikan jumlah baris yang terpengaruh
    return mysqli_affected_rows($db);
}

function delete_anggota($id_anggota)
{
    global $db;

    //query hapus data anggota
    $query = "DELETE FROM anggota WHERE id_anggota = $id_anggota";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function create_transaksi($post)
{
    global $db;

    // Ambil data dari form dan sanitasi input
    $nama_produk = strip_tags($post['nama_produk']);
    $kategori    = strip_tags($post['kategori']);
    $harga       = (float) strip_tags($post['harga']);
    $stok        = (int) strip_tags($post['stok']);
    $deskripsi   = strip_tags($post['deskripsi']);

    // Query untuk menambahkan data transaksi (created_at otomatis diisi dengan NOW())
    $query = "INSERT INTO transaksi VALUES (NULL, '$nama_produk', '$kategori', '$harga', '$stok', '$deskripsi', CURRENT_TIMESTAMP())";

    // Eksekusi query
    mysqli_query($db, $query);

    // Mengembalikan hasil apakah ada perubahan data
    return mysqli_affected_rows($db);
}

function delete_transaksi($id)
{
    global $db;

    //query hapus data transaksi
    $query = "DELETE FROM transaksi WHERE id = $id";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}



function create_akun($post)
{
    global $db;

    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $email = strip_tags($post['email']);
    $password = strip_tags($post['password']);
    $level = strip_tags($post['level']);

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //query tambah data
    $query = "INSERT INTO akun VALUES(null, '$nama', '$username', '$email', '$password', '$level')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function delete_akun($id_akun)
{
    global $db;

    //query hapus data akun
    $query = "DELETE FROM akun WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);


}


function update_akun($post)
{
    global $db;

    $id_akun = strip_tags($post['id_akun']);
    $nama = strip_tags($post['nama']);
    $username = strip_tags($post['username']);
    $email = strip_tags($post['email']);
    $password = strip_tags($post['password']);
    $level = strip_tags($post['level']);

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //query ubah data
    $query = "UPDATE akun SET nama = '$nama', username = '$username', email = '$email', password = '$password', level = '$level' WHERE id_akun = $id_akun";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}



function create_pegawai($post)
{
    global $db;

    $nama       =   ($post['nama']);
    $jabatan        =   ($post['jabatan']);
    $email      =   ($post['email']);
    $telepon    =   ($post['telepon']);
    $alamat    =   ($post['alamat']);   
   

    //query tambah data
    $query = "INSERT INTO pegawai VALUES(null, '$nama', '$jabatan', '$telepon', '$alamat','$email',)";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}