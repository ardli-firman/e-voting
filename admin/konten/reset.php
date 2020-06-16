<?php
require_once 'modul/fungsi.php';
if (@$_GET['aksi'] == 'reset' && isset($_GET['kode'])) {
    if (base64_decode($_GET['kode']) == 'admin') {
        if (resetVote() == '1') {
            header('Location: index.php');
        }
    }
}
?>
<div class="section-header">
    <h1>Reset vote</h1>
</div>
<div class="section-body">
    <div class="row">
        <div class="col">
            <a href="?hal=reset&aksi=reset&kode=<?= base64_encode($_SESSION['data']['adm']['level']) ?>" onclick="return confirm('Yakin ?')" class="btn btn-icon icon-left btn-warning"><i class="fas fa-exclamation-triangle"></i> Reset vote ?</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <small>Reset , akan menghapus semua hasil voting</small>
        </div>
    </div>
</div>