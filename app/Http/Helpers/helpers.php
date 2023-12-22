<?php

//format angka untuk nominal uang ----------------------------------------------------------------------------------------------------
function format_uang($angka)
{
    return number_format($angka, 0, ',', '.');
}

// fungsi terbilang nominal uang ----------------------------------------------------------------------------------------------------
function terbilang($angka)
{
    $angka = abs($angka);
    $baca = array('', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas');
    $varTerbilang = '';

    if ($angka < 12) {
        $varTerbilang = ' ' . $baca[$angka];
    } elseif ($angka < 20) {
        $varTerbilang = terbilang($angka - 10) . ' belas';
    } elseif ($angka < 100) {
        $varTerbilang = terbilang($angka / 10) . ' puluh' . terbilang($angka % 10);
    } elseif ($angka < 200) {
        $varTerbilang = ' seratus' . terbilang($angka - 100);
    } elseif ($angka < 1000) {
        $varTerbilang = terbilang($angka / 100) . ' ratus' . terbilang($angka % 100);
    } elseif ($angka < 2000) {
        $varTerbilang = ' seribu' . terbilang($angka - 1000);
    } elseif ($angka < 1000000) {
        $varTerbilang = terbilang($angka / 1000) . ' ribu' . terbilang($angka % 1000);
    } elseif ($angka < 1000000000) {
        $varTerbilang = terbilang($angka / 1000000) . ' juta' . terbilang($angka % 1000000);
    } elseif ($angka < 1000000000000) {
        $varTerbilang = terbilang($angka / 1000000000) . ' miliar' . terbilang($angka % 1000000000);
    } elseif ($angka < 1000000000000000) {
        $varTerbilang = terbilang($angka / 1000000000000) . ' triliun' . terbilang($angka % 1000000000000);
    }

    return $varTerbilang;
}

// fungsi tanggalan indonesia ----------------------------------------------------------------------------------------------------
function tanggal_indonesia($tgl, $tampil_hari = true)
{
    $nama_hari = array(

        'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Minggu'
    );
    $nama_bulan = array(
        1 =>
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );
    $tahun   = substr($tgl, 0, 4);
    $bulan   = $nama_bulan[(int) substr($tgl, 5, 2)];
    $tanggal = substr($tgl, 8, 2);
    $text    = '';


    if ($tampil_hari) {
        $urutan_hari = date('w', mktime(0, 0, 0, substr($tgl, 5, 2), $tanggal, $tahun));
        $hari = $nama_hari[$urutan_hari];
        $text .= "$hari, $tanggal $bulan $tahun";
    } else {
        $text .= "$tanggal $bulan $tahun";
    }
    return $text;
}

// fungsi tambah nol didepan ----------------------------------------------------------------------------------------------------
function tambah_nol_didepan($value, $threshold = null)
{
    return sprintf("%0" . $threshold . "s", $value);
}


function format_rupiah($nominal, $prefix = false)
{
    if ($prefix) {
        return "Rp. " . number_format($nominal, 0, ',', '.');
    }

    return number_format($nominal, 0, ',', '.');
}
