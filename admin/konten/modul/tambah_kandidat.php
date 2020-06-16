<?php
require_once 'fungsi.php';

if (isset($_POST['tambah'])) {
    $_SESSION['flash_data'] = $_POST;
    $flash = $_SESSION['flash_data'];
    $ft = uploadFoto();
    if ($ft != false) {
        $foto = $ft;
    } else {
        $foto = null;
    }
    $data = [
        'no' => $_POST['no'],
        'nim' => $_POST['nim'],
        'visi' => $_POST['visi'],
        'misi' => $_POST['misi'],
        'foto' => $foto
    ];

    if (tambahKandidat($data) == 1) {
        unset($_SESSION['flash_data']);
        echo "<script>
        swal({
            title: 'Berhasil',
            text: 'Kandidat berhasil ditambahkan !',
            icon: 'success'
          }).then(function(){
              window.location.href = 'index.php?hal=kandidat'
          });
        </script>";
    }
}
?>
<div class="section-body">
    <div class="card">
        <div class="card-header">
            <h4>Tambah kandidat</h4>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="card-body">
                <?php if (@isset($_SESSION['pesan'])) : ?>
                    <div class="alert alert-danger"><?= $_SESSION['pesan'];
                                                    unset($_SESSION['pesan']) ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="no">No kandidat</label>
                    <input type="number" class="form-control" name="no" value="<?= @$flash['no'] ?>">
                </div>
                <div class="form-group">
                    <label for="nim">NIM kandidat</label>
                    <input type="number" class="form-control" name="nim" value="<?= @$flash['nim'] ?>">
                </div>
                <div class="form-group">
                    <label for="visi">Visi kandidat <small style="color:red">Pisah antara poin ke poin dengan titik koma ; cth: visi1;visi2;visi3</small></label>
                    <textarea type="textarea" class="form-control" name="visi"><?= @$flash['visi'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="misi">Misi kandidat <small style="color:red">Pisah antara poin ke poin dengan titik kone ; cth: misi1;misi2;misi3</small></label>
                    <textarea type="textarea" class="form-control" name="misi"><?= @$flash['misi'] ?></textarea>
                </div>
                <div class="form-group">
                    <div class="image-preview" id="image-preview">
                        <label for="image-upload" id="image-label">Foto kandidat</label>
                        <input type="file" id="image-upload" name="foto">
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="tambah">Tambah kandidat</button>
                </div>
            </div>
        </form>
    </div>
</div>