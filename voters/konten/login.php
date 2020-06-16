<?php
if (isset($_POST['login'])) {
    $nim = htmlspecialchars($_POST['nim']);
    $pw = htmlspecialchars($_POST['password']);
    if ($nim === 'admin' && $pw === 'admin1234') {
        $adm['adm'] = [
            'level' => 'admin',
            'nama' => 'admin'
        ];
        $_SESSION['data'] = $adm;
        echo "<script>
            window.location.href = 'admin/index.php'
        </script>";
        die();
    }

    if ($nim != 'admin' && $nim == $pw) {
        $query = "SELECT * FROM mahasiswa WHERE nim = {$nim}";
        $res = mysqli_query($db, $query);
        if ($res->num_rows == 1) {
            $query = "SELECT * FROM vote WHERE nim = {$nim}";
            if (mysqli_query($db, $query)->num_rows == 0) {
                $mhs['mhs'] = mysqli_fetch_object($res);
                $_SESSION['data'] = $mhs;
                header('Location: ?vote=kuy');
            } else {
                $_SESSION['pesan'] = 'Maaf, Kamu sudah menggunakan hak pilihmu :)';
            }
        } else {
            $_SESSION['pesan'] = 'NIM Tidak Terdaftar';
        }
    } else {
        $_SESSION['pesan'] = 'NIM dan Password tidak sama';
    }
}
?>
<form class="form-signin" method="POST">
    <img class="mb-4" src="assets/img/logo.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Masukkan NIM Kamu !</h1>
    <label for="NIM" class="sr-only">NIM</label>
    <input name="nim" type="nim" id="NIM" class="form-control" placeholder="NIM" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Masok</button>
</form>
<?php if (@$_SESSION['pesan'] != null) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $_SESSION['pesan'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif;
unset($_SESSION['pesan']) ?>