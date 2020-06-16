<div class="section-header">
    <h1>Kandidat</h1>
</div>
<?php
switch (@$_GET['aksi']) {
    case 'edit':
        require_once 'modul/edit_kandidat.php';
        break;
    case 'tambah':
        require_once 'modul/tambah_kandidat.php';
        break;
    default:
        require_once 'modul/beranda_kandidat.php';
        break;
}
?>