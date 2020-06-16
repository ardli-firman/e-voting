<?php
require_once 'fungsi.php';
if (isset($_GET['no'])) {
    $query = "SELECT id_kandidat,no,m.nama,m.nim,foto,visi,misi FROM kandidat k INNER JOIN mahasiswa m ON k.nim=m.nim WHERE id_kandidat = {$_GET['no']}";
    $res = mysqli_query($db, $query);
    $dt = mysqli_fetch_assoc($res);

    if (isset($_POST['ubah'])) {
        if (editKandidat($_POST) == 1) {
            echo "<script>
                    swal({
                        title: 'Berhasil',
                        text: 'Kandidat berhasil diubah !',
                        icon: 'success'
                    }).then(function(){
                        window.location.href = 'index.php?hal=kandidat'
                    });
                </script>";
        }
    }
}
?>
<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Edit kandidat</h4>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name='id' value="<?= $dt['id_kandidat'] ?>">
            <input type="hidden" name="foto_lawas" value="<?= $dt['foto'] ?>">
            <div class="card-body">
                <?php if (@isset($_SESSION['pesan'])) : ?>
                    <div class="alert alert-danger"><?= $_SESSION['pesan'];
                                                    unset($_SESSION['pesan']) ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="no">No kandidat</label>
                    <input type="number" class="form-control" name="no" value="<?= $dt['no'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nim">NIM kandidat</label>
                    <input type="number" class="form-control" name="nim" value="<?= $dt['nim'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="visi">Visi kandidat <small style="color:red">Pisah antara poin ke poin dengan titik koma ; cth: visi1;visi2;visi3</small></label>
                    <textarea type="textarea" class="form-control" name="visi"><?= $dt['visi'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="misi">Misi kandidat <small style="color:red">Pisah antara poin ke poin dengan titik kone ; cth: misi1;misi2;misi3</small></label>
                    <textarea type="textarea" class="form-control" name="misi"><?= $dt['misi'] ?></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <div class="image-preview" id="image-preview">
                            <label for="image-upload" id="image-label">Foto kandidat</label>
                            <input type="file" id="image-upload" name="foto">
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div>
                            <img width=50% height="50%" class="rounded profile-widget-picture" src="../assets/foto/<?= $dt['foto'] ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="ubah">Ubah kandidat</button>
                </div>
            </div>
        </form>
    </div>
</div>