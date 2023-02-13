<?php
if (!function_exists('_simpleViewPagination_')) {
    function _simpleViewPagination_($data = array())
    {
        $page = new \nguyenanhung\Libraries\Pagination\Pagination\SimplePagination();
        $page->setData($data);

        return $page->build();
    }
}
