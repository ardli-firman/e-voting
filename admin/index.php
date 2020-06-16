<?php require_once '../koneksi/Koneksi.php' ?>
<?php require_once 'konten/modul/sesi.php' ?>
<?php isLogin() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once '_partials/header.php ' ?>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <?php require_once '_partials/nav.php' ?>
            <?php require_once '_partials/sidebar.php' ?>

            <div class="main-content">
                <section class="section">
                    <?php switch (@$_GET['hal']) {
                        case 'dashboard':
                            require_once 'konten/dashboard.php';
                            break;
                        case 'kandidat':
                            require_once 'konten/kandidat.php';
                            break;
                        case 'reset':
                            require_once 'konten/reset.php';
                            break;
                        default:
                            require_once 'konten/dashboard.php';
                            break;
                    } ?>
                </section>
            </div>
            <?php require_once '_partials/footer.php' ?>
        </div>
    </div>

    <?php require_once '_partials/script.php' ?>
</body>

</html>