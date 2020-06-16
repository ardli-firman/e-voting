<?php
session_start();
require_once 'koneksi/Koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once 'voters/_partials/header.php' ?>

<body>
    <?php require_once 'voters/_partials/nav.php' ?>
    <div class="container">
        <?php switch (@$val = $_GET['vote']) {
            case 'kuy':
                require_once 'voters/konten/vote.php';
                break;

            default:
                require_once 'voters/konten/login.php';
                break;
        } ?>
    </div>
    <?php require_once 'voters/_partials/script.php' ?>
</body>

</html>