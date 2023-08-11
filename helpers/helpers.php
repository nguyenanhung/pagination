<?php
if (!function_exists('_simpleViewPagination_')) {
    function _simpleViewPagination_($data = array())
    {
        $page = new \nguyenanhung\Libraries\Pagination\Pagination\SimplePagination();
        $page->setData($data);
        return $page->build();
    }
}
if (!function_exists('_simpleViewMorePagination_')) {
    function _simpleViewMorePagination_($data = array()): string
    {
        $page = new \nguyenanhung\Libraries\Pagination\Pagination\SimplePagination();
        $page->setData($data);
        return $page->buildViewMore();
    }
}
if (!function_exists('_simpleViewSelectPagination_')) {
    function _simpleViewSelectPagination_($data = array()): string
    {
        $page = new \nguyenanhung\Libraries\Pagination\Pagination\SimplePagination();
        $page->setData($data);
        return $page->buildSelectPage();
    }
}
