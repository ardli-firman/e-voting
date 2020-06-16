<?php
require_once '../koneksi/Koneksi.php';

function uploadFoto()
{
    if ($_FILES['foto']['error'] == 0) {
        //Mengambil data gambar
        $namaFile   = $_FILES['foto']['name'];
        $ukuranFile = $_FILES['foto']['size'];
        $error      = $_FILES['foto']['error'];
        $tmpName    = $_FILES['foto']['tmp_name'];

        //mengecek error jika gambar belum di masukkan
        if ($error === 4) {
            echo "<script>
					alert('Pilih gambar');
							</script>";
            return false;
        }

        //cek apakah yang di upload adalah gambar
        $valid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        //mengambil array yang di belakang dan mengubahnya lowercase
        $ekstensi = strtolower(end($ekstensiGambar));
        //in array di gunakan untuk mencari ekstensi di dalam ekstensi valid
        if (!in_array($ekstensi, $valid)) {
            echo "<script>
					alert('Yang anda upload bukan gambar');
							</script>";

            return false;
        }

        //Mengecek ukuran
        if ($ukuranFile > 1000000) {
            echo "<script>
					alert('Ukuran gambar terlalu besar');
							</script>";
            return false;
        }

        //Setelah dicek gambar di upload
        //genererate nama baru agar tidak menimpa file yang sama
        $namaFileBaru = rand();
        // sambung
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensi;

        move_uploaded_file($tmpName, '../assets/foto/' . $namaFileBaru);

        return $namaFileBaru;
    } else {
        return '1.png';
    }
}

function tambahKandidat($data)
{
    global $db;
    $sql = "SELECT * FROM mahasiswa WHERE nim = {$data['nim']}";
    mysqli_query($db, $sql);
    if (mysqli_affected_rows($db) == 1) {
        $sql = "SELECT * FROM kandidat WHERE nim = {$data['nim']} OR no = {$data['no']}";
        mysqli_query($db, $sql);
        if (mysqli_affected_rows($db) == 0) {
            $sql = "INSERT INTO kandidat(no,nim,foto,visi,misi) VALUES({$data['no']},{$data['nim']},'{$data['foto']}','{$data['visi']}','{$data['misi']}')";
            mysqli_query($db, $sql);
            if (mysqli_affected_rows($db) == 1) {
                return mysqli_affected_rows($db);
            } else {
                return $_SESSION['pesan'] = mysqli_error($db);
            }
        } else {
            return $_SESSION['pesan'] = 'Nim / No sudah terdaftar';
        }
    } else {
        return $_SESSION['pesan'] = 'Nim tidak ada ';
    }
}

function hapusKandidat($no)
{
    global $db;
    $sql = "SELECT foto FROM kandidat WHERE id_kandidat = $no";
    $res = mysqli_query($db, $sql);
    $foto = mysqli_fetch_assoc($res)['foto'];
    if (file_exists('../assets/foto/' . $foto)) {
        unlink('../assets/foto/' . $foto);
        $sql = "DELETE FROM kandidat WHERE id_kandidat = $no";
        mysqli_query($db, $sql);
        if (mysqli_affected_rows($db) == 1) {
            return mysqli_affected_rows($db);
        }
    }
    return false;
}

function editKandidat($data)
{
    global $db;
    $id = $data['id'];
    $no = $data['no'];
    $nim = $data['nim'];
    $visi = $data['visi'];
    $misi = $data['misi'];
    $foto_lawas = $data['foto_lawas'];

    if ($_FILES['foto']['error'] === 4) {
        $foto = $foto_lawas;
    } else {
        unlink('../assets/foto/' . $foto_lawas);
        $foto = uploadFoto();
    }

    $sql = "UPDATE kandidat SET 
					no     = '$no',
					nim      = '$nim',
					foto    = '$foto',
					visi  = '$visi',
					misi   = '$misi'
					WHERE id_kandidat = $id ";
    mysqli_query($db, $sql);
    return mysqli_affected_rows($db);
}

function resetVote()
{
    global $db;
    $query = "DELETE FROM vote";
    mysqli_query($db, $query);
    if (mysqli_affected_rows($db) == 1) {
        return '1';
    }
}
