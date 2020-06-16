<?php
require_once 'fungsi.php';
$query = "SELECT id_kandidat,no,m.nama,foto,visi,misi FROM kandidat k INNER JOIN mahasiswa m ON k.nim=m.nim";
$res = mysqli_query($db, $query);
if (@$_GET['aksi'] == 'hapus' && isset($_GET['no'])) {
    if (hapusKandidat($_GET['no']) == 1) {
        header('Location: index.php?hal=kandidat');
    }
}
?>
<div class="section-body">
    <div class="row my-4">
        <div class="col">
            <a href="?hal=kandidat&aksi=tambah" class="btn btn-icon icon-left btn-success">
                <i class="far fa-user"></i>Tambah Kandidat
            </a>
        </div>
    </div>
    <div class="row">
        <?php while (@$cd = mysqli_fetch_assoc(@$res)) : ?>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Calon No <?= $cd['no'] ?></h4>
                        <div class="card-header-action">
                            <a href="?hal=kandidat&aksi=edit&no=<?= $cd['id_kandidat'] ?>" class="btn btn-primary">Edit</a>
                            <a href="?hal=kandidat&aksi=hapus&no=<?= $cd['id_kandidat'] ?>" onclick="return confirm('Hapus ?') " class="btn btn-danger">Hapus</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chocolat-parent">
                            <img class="card-img" src="../assets/foto/<?= $cd['foto'] ?>" alt="">
                        </div>
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
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>