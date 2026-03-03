<?php
session_start();
$koneksi = mysqli_connect("localhost", "root", "", "praukk");

function get_status($status)
{
    if ($status == 'Selesai')
        return 'bg-success';
    if ($status == 'Proses')
        return 'bg-warning';
    return 'bg-danger';
}

?>