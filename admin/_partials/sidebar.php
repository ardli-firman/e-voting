<?php
$url = @$_GET['hal'];
?>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">E-Voting</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">EV</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="<?= ($url == null || $url == 'dashboard') ? 'active' : '' ?>">
                <a href="index.php" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="<?= ($url == 'kandidat') ? 'active' : '' ?>">
                <a href="?hal=kandidat" class="nav-link"><i class="fas fa-user"></i><span>Kandidat</span></a>
            </li>
            <li class="<?= ($url == 'reset') ? 'active' : '' ?>">
                <a href="?hal=reset" class="nav-link"><i class="fas fa-info-circle"></i><span>Reset voting</span></a>
            </li>
        </ul>
    </aside>
</div>