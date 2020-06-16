<?php

require_once '../../../koneksi/Koneksi.php';

$query = "SELECT pilihan as no , COUNT(vote.nim) as 'jumlah' FROM `vote` LEFT JOIN `kandidat` ON 'vote.nim=kandidat.nim' GROUP BY pilihan ORDER BY pilihan ASC";
$res = mysqli_query($db, $query);

while ($has = mysqli_fetch_assoc($res)) {
    $hasil[] = $has;
}
die(json_encode($hasil));
