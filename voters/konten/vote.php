<?php
$mhs = $_SESSION['data']['mhs'];
if (!is_object($mhs)) {
    $_SESSION['pesan'] = 'Login dulu gan!';
    header('Location: index.php');
}

$query = "SELECT no,m.nama,foto,visi,misi FROM kandidat k INNER JOIN mahasiswa m ON k.nim=m.nim";
$res = mysqli_query($db, $query);

if (isset($_POST['tercoblos'])) {
    $no = $_POST['tercoblos'];
    $query = "INSERT INTO vote VALUES({$mhs->nim},{$no})";
    $res = mysqli_query($db, $query);
    $err = str_replace("'", " ", mysqli_error($db));
    if ($err == "") {
        session_destroy();
        echo "<script>
            Swal.fire({
                title: '{$err}',
                text: 'Terima kasih gan !',
                type: 'success',
                timer: 2000,
                showConfirmButton: false,
                onClose: () => {
                    window.location.reload()
                }
            })
        </script>";
    } else {
        session_destroy();
        echo "<script>
            Swal.fire({
                title: 'Ada Error gan !',
                text: '{$err}',
                type: 'warning',
                timer: 2000,
                showConfirmButton: false,
                onClose: () => {
                    window.location.reload()
                }
            })
        </script>";
    }
}
?>
<div class="row mt-3">
    <div class="col">
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">Selamat datang <?= $mhs->nama; ?>
                </h1>
                <p class="lead">Silahkan pilih Ketua HIMA Prodi DIV Teknik Informatika untuk periode 2019/2020.</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php while (@$cd = mysqli_fetch_assoc(@$res)) : ?>
        <div class="col-sm-6">
            <div class="card-deck mb-3">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal text-center">Calon No <?= $cd['no'] ?></h4>
                    </div>
                    <div class="push" style="padding:8px">
                        <div class="card-body">
                            <img src="assets/foto/<?= $cd['foto'] ?>" class="card-img" alt="">
                            <h4 class="card-title my-4 text-center"><?= $cd['nama'] ?></h4>
                            <h5 class="card-title my-4 text-center">Visi</h5>
                            <ul class="list-group list-group-flush text-justify list">
                                <?php $visi = explode(';', $cd['visi']);
                                $i = 0; ?>
                                <?php foreach ($visi as $value) : ?>
                                    <li class="list-group-item"><span class="badge badge-success badge-pill mr-3"><?= ++$i ?></span><?= $value ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <h5 class="card-title my-4 text-center">Misi</h5>
                            <ul class="list-group list-group-flush text-justify list">
                                <?php $misi = explode(';', $cd['misi']);
                                $a = 0; ?>
                                <?php foreach ($misi as $value) : ?>
                                    <li class="list-group-item"><span class="badge badge-info badge-pill mr-3"><?= ++$a ?></span><?= $value ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <form action="" method="post">
                                <button value="<?= $cd['no'] ?>" name="tercoblos" type="submit" class="btn btn-lg btn-block btn-outline-primary my-3">Coblos</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>