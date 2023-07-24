
if (!function_exists('isActiveMaster')) {
    function isActiveMaster()
    {
        return Request::is('coa') || Request::is('rab') || Request::is('admin/pages/charts/inline.html');
        // Add other URLs as needed
    }
}
