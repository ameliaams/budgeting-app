<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

if (!function_exists('isActiveMaster')) {
    function isActiveMaster()
    {
        return Request::is('coa') || Request::is('rab') || Request::is('tahun');
    }
}

if (!function_exists('isActiveTransaksi')) {
    function isActiveTransaksi()
    {
        return Request::is('kasMasuk') || Request::is('kasKeluar');
    }
}

if (!function_exists('isActiveDashboard')) {
    function isActiveDashboard()
    {
        return Request::is('home');
    }
}

if (!function_exists('isActiveLaporan')) {
    function isActiveLaporan()
    {
        return Request::is('laporan');
    }
}