<?php
$query = "SELECT pilihan as no , COUNT(vote.nim) as 'jumlah' FROM `vote` LEFT JOIN `kandidat` ON 'vote.nim=kandidat.nim' GROUP BY pilihan ORDER BY jumlah DESC";
$ress = mysqli_query($db, $query);
if ($ress->num_rows == 0) {
    $data = 0;
} else {
    while ($has = mysqli_fetch_assoc($ress)) {
        $hass[] = $has;
    }
}
?>
<div class="section-header">
    <h1>Dashboard</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total pemilih</h4>
                    </div>
                    <div class="card-body">
                        <?php $res = mysqli_query($db, "SELECT COUNT(*) FROM mahasiswa"); ?>
                        <?= $tot = mysqli_fetch_row($res)[0] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Yang sudah memilih</h4>
                    </div>
                    <div class="card-body">
                        <?php $res = mysqli_query($db, "SELECT COUNT(*) FROM vote"); ?>
                        <?= $sud = mysqli_fetch_row($res)[0] ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Yang belum memilih</h4>
                    </div>
                    <div class="card-body">
                        <?= $tot - $sud ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Hasil dalam pie chart</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Hasil dalam tabel</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md">
                            <tbody>
                                <tr>
                                    <th>Rank</th>
                                    <th>No Calon</th>
                                    <th>Jumlah pemilih</th>
                                </tr>
                                <?php if (@$data === 0) : ?>
                                    <tr>
                                        <td>Tidak ada</td>
                                    </tr>
                                <?php else : ?>
                                    <?php $i = 1;
                                    foreach ($hass as $dat) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $dat['no'] ?></td>
                                            <td><?= $dat['jumlah'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../assets/js/dashChart.js"></script>