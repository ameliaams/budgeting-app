<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

if (!function_exists('isActiveMaster')) {
    function isActiveMaster()
    {
        return Request::is('coa') || Request::is('rab') || Request::is('tahun') || Request::is('kas');
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
        return Request::is('laporanRealisasi') || Request::is('laporanTransaksiMasuk') || Request::is('laporanTransaksiKeluar') || Request::is('arusKas') || Request::is('laporanTotalKas');
    }
}

if (!function_exists('isActiveDiagram')) {
    function isActiveDiagram()
    {
        return Request::is('chart');
    }
}

if (!function_exists('isActiveCalendar')) {
    function isActiveCalendar()
    {
        return Request::is('kalender');
    }
}

if (!function_exists('isActiveCollapse')) {
    function isActiveCollapse()
    {
        return Request::is('collapse');
    }
}
