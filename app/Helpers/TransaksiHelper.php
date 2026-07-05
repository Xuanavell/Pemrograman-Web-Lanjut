<?php

function hitung_ppn($total_harga)
{
    return 0;
}

function hitung_biaya_admin($total_harga)
{
    return $total_harga * 0.02;
}

function hitung_diskon_kupon($total_harga, $kupon_code)
{
    if ($kupon_code == 'PROMO2025') {
        return $total_harga * 0.10;
    } elseif ($kupon_code == 'PROMO2026') {
        return $total_harga * 0.15;
    } elseif ($kupon_code == 'AKHIRTAHUN') {
        return $total_harga * 0.25;
    } else {
        return 0;
    }
}
