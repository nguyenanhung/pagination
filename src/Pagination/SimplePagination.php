<?php
/**
 * Project pagination
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 13/02/2023
 * Time: 23:13
 */

namespace nguyenanhung\Libraries\Pagination\Pagination;

class SimplePagination extends BaseCore
{
    /** @var array $data */
    protected $data;

    /**
     * Function setData
     *
     * @param $data
     *
     * @return $this
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 13/02/2023 15:59
     */
    public function setData($data): SimplePagination
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Function build
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 17/02/2023 18:50
     */
    public function build(): string
    {
        $page_type = $this->data['page_type'] ?? '';
        if ($page_type === 'search_page' || $page_type === 'search') {
            $defaultPrefix = '&page=';
            $defaultSuffix = '';
        } else {
            $defaultPrefix = '/trang-';
            $defaultSuffix = '.html';
        }
        $page_prefix = $this->data['page_prefix'] ?? $defaultPrefix;
        $page_suffix = $this->data['page_suffix'] ?? $defaultSuffix;
        $page_link = $this->data['page_link'] ?? '';
        $page_title = $this->data['page_title'] ?? '';
        $current_page_number = $this->data['current_page_number'] ?? 1;
        $current_page_number = (int) $current_page_number;
        $total_item = $this->data['total_item'] ?? 0;
        $total_item = (int) $total_item;
        $item_per_page = $this->data['item_per_page'] ?? 10;
        $item_per_page = (int) $item_per_page;
        $begin = $this->data['pre_rows'] ?? 3;
        $begin = (int) $begin;
        $end = $this->data['suf_rows'] ?? 3;
        $end = (int) $end;
        $first_link = $this->data['first_link'] ?? '&nbsp;';
        $last_link = $this->data['last_link'] ?? '&nbsp;';
        $default_page_title = $this->data['default_page_title'] ?? 'trang';
        $default_last_page_name_title = $this->data['default_last_page_name_title'] ?? 'trang cuối';
        $left_class = $this->data['left_class'] ?? 'left';
        $right_class = $this->data['right_class'] ?? 'right';
        $selected_class = $this->data['selected_class'] ?? 'selected';

        /**
         * Kiểm tra giá trị page_number truyền vào
         * Nếu ko có giá trị hoặc giá trị = 0 -> set giá trị = 1
         */
        if (empty($current_page_number)) {
            $current_page_number = 1;
        }

        // Tính tổng số page có
        $total_page = ceil($total_item / $item_per_page);
        if ($total_page <= 1) {
            return '';
        }

        $output_html = '';
        if ($current_page_number !== 1) {
            $output_html .= '<li class="' . htmlEscape($left_class) . '"><a href="' . $this->trimHtmlEscape($page_link) . trim($page_suffix) . '" title="' . $this->trimHtmlEscape($page_title) . '">' . trim($first_link) . '</a></li>';
        }

        for ($page_number = 1; $page_number <= $total_page; $page_number++) {
            if ($page_number < ($current_page_number - $begin) || $page_number > ($current_page_number + $end)) {
                continue;
            }

            if ($page_number === $current_page_number) {
                $output_html .= '<li class="' . htmlEscape($selected_class) . '"><a href="' . $this->trimHtmlEscape($page_link) . trim($page_prefix) . $this->trimHtmlEscape($page_number) . trim($page_suffix) . '" title="' . $this->trimHtmlEscape($page_title) . ' ' . $this->trimHtmlEscape($default_page_title) . ' ' . $this->trimHtmlEscape($page_number) . '">' . $this->trimHtmlEscape($page_number) . '</a></li>';
            } else {
                $output_html .= '<li><a href="' . $this->trimHtmlEscape($page_link) . trim($page_prefix) . $this->trimHtmlEscape($page_number) . trim($page_suffix) . '" title="' . $this->trimHtmlEscape($page_title) . ' ' . $this->trimHtmlEscape($default_page_title) . ' ' . $this->trimHtmlEscape($page_number) . '">' . $this->trimHtmlEscape($page_number) . '</a></li>';
            }
        }
        unset($page_number);

        if ($current_page_number <> $total_page) {
            $output_html .= '<li class="' . htmlEscape($right_class) . '"><a href="' . $this->trimHtmlEscape($page_link) . trim($page_prefix) . $this->trimHtmlEscape($total_page) . trim($page_suffix) . '" title="' . $this->trimHtmlEscape($page_title) . ' - ' . $this->trimHtmlEscape($default_last_page_name_title) . ' ">' . trim($last_link) . '</a></li>';
        }

        return $output_html;
    }

    /**
     * Function buildViewMore
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 14/02/2023 08:11
     */
    public function buildViewMore(): string
    {
        $page_number = $this->data['page_number'] ?? 1;
        $page_number = (int) $page_number;
        $page_total = $this->data['total_item'] ?? 0;
        $page_total = (int) $page_total;
        $page_size = $this->data['item_per_page'] ?? 10;
        $page_size = (int) $page_size;
        $url = $this->data['page_link'] ?? '';
        $title = $this->data['page_title'] ?? '';
        $more_type = $this->data['page_type'] ?? '';
        if ($more_type === 'search' || $more_type === 'search_page') {
            $defaultPrefix = '&page=';
            $defaultSuffix = '';
        } else {
            $defaultPrefix = '/trang-';
            $defaultSuffix = '.html';
        }
        $default_page_prefix = $this->data['page_prefix'] ?? $defaultPrefix;
        $default_page_suffix = $this->data['page_suffix'] ?? $defaultSuffix;
        $default_page_title = $this->data['default_page_title'] ?? 'trang';
        $default_page_title_more = $this->data['default_page_title_more'] ?? 'Xem thêm';
        $default_page_title_prev = $this->data['default_page_title_prev'] ?? 'Trang trước';
        $is_total = ceil($page_total / $page_size);
        if ($is_total <= 1) {
            return '';
        }

        if ($is_total == $page_number) {
            $back_page = $page_number - 1;
            if ($more_type === 'search') {
                $main = '<a title="' . $this->trimHtmlEscape($title) . ' ' . $this->trimHtmlEscape($default_page_title) . ' ' . $this->trimHtmlEscape($back_page) . '" href="' . $this->trimHtmlEscape($url) . trim($default_page_prefix) . $this->trimHtmlEscape($back_page) . '">' . trim($default_page_title_prev) . '</a>';
            } else {
                $main = '<a title="' . $this->trimHtmlEscape($title) . ' ' . $this->trimHtmlEscape($default_page_title) . ' ' . $this->trimHtmlEscape($back_page) . '" href="' . $this->trimHtmlEscape($url) . '/' . trim($default_page_prefix) . $this->trimHtmlEscape($back_page) . trim($default_page_suffix) . '">' . trim($default_page_title_prev) . '</a>';
            }
        } else {
            if (!empty($page_number) && $page_number !== 0) {
                $next_page = $page_number + 1;
            } else {
                $next_page = $page_number + 2;
            }
            if ($more_type === 'search') {
                $main = '<a title="' . $this->trimHtmlEscape($title) . ' ' . $this->trimHtmlEscape($default_page_title) . ' ' . $this->trimHtmlEscape($next_page) . '" href="' . $this->trimHtmlEscape($url) . trim($default_page_prefix) . $this->trimHtmlEscape($next_page) . '">' . trim($default_page_title_more) . '</a>';
            } else {
                $main = '<a title="' . $this->trimHtmlEscape($title) . ' ' . $this->trimHtmlEscape($default_page_title) . ' ' . $this->trimHtmlEscape($next_page) . '" href="' . $this->trimHtmlEscape($url) . '/' . trim($default_page_prefix) . $this->trimHtmlEscape($next_page) . trim($default_page_suffix) . '">' . trim($default_page_title_more) . '</a>';
            }
        }

        return $main;
    }

    /**
     * Function buildSelectPage
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 14/02/2023 10:46
     */
    public function buildSelectPage(): string
    {
        $page_number = $this->data['page_number'] ?? 1;
        $page_number = (int) $page_number;
        $total_rows = $this->data['total_item'] ?? 0;
        $total_rows = (int) $total_rows;
        $per_page = $this->data['item_per_page'] ?? 10;
        $per_page = (int) $per_page;
        $page_links = $this->data['page_link'] ?? '';
        $title = $this->data['page_title'] ?? '';
        $type = $this->data['page_type'] ?? '';
        if ($type === 'search' || $type === 'search_page') {
            $defaultPrefix = '&page=';
            $defaultSuffix = '';
        } else {
            $defaultPrefix = '/trang-';
            $defaultSuffix = '.html';
        }
        $default_page_prefix = $this->data['page_prefix'] ?? $defaultPrefix;
        $default_page_suffix = $this->data['page_suffix'] ?? $defaultSuffix;
        $default_page_title = $this->data['default_page_title'] ?? 'trang';
        $default_last_page_name_title = $this->data['default_last_page_name_title'] ?? 'Trang cuối';
        $left_class = $this->data['left_class'] ?? 'left';
        $right_class = $this->data['right_class'] ?? 'right';
        $selected_class = $this->data['selected_class'] ?? 'selected';
        /**
         * ----------------------------------------------
         * Kiểm tra giá trị page_number truyền vào
         * Nếu ko có giá trị hoặc giá trị = 0 -> set giá trị = 1
         * ----------------------------------------------
         */
        if (empty($page_number)) {
            $page_number = 1;
        }
        /**
         * ----------------------------------------------
         * Tính tổng số page có
         * ----------------------------------------------
         */
        $total = ceil($total_rows / $per_page);
        $main = '';
        if ($total <= 1) {
            return '';
        }
        if ($page_number !== 1) {
            if ($type === 'select_page') {
                $main .= "<li class=\"" . htmlEscape($left_class) . "\"><a href=\"" . $this->trimHtmlEscape($page_links) . trim($default_page_suffix) . "\" title=\"" . $this->trimHtmlEscape($title) . "\">&nbsp;</a></li>";
            } else {
                $main .= "";
            }
        }
        for ($num = 1; $num <= $total; $num++) {
            if ($num === $page_number) {
                if ($type === 'select_page') {
                    $main .= "<li class=\"" . htmlEscape($selected_class) . "\"><a href=\"" . $this->trimHtmlEscape($page_links) . trim($default_page_prefix) . $this->trimHtmlEscape($num) . trim($default_page_suffix) . "\" title=\"" . $this->trimHtmlEscape($title) . " " . ucfirst($this->trimHtmlEscape($default_page_title)) . " " . $this->trimHtmlEscape($num) . "\">" . $this->trimHtmlEscape($num) . "</a></li>";
                } else {
                    $main .= "<option selected value=\"" . $num . "\">" . ucfirst($this->trimHtmlEscape($default_page_title)) . " " . $num . "</option>";
                }
            } else {
                if ($type === 'select_page') {
                    $main .= "<li><a href=\"" . $this->trimHtmlEscape($page_links) . trim($default_page_prefix) . $num . trim($default_page_suffix) . "\" title=\"" . $this->trimHtmlEscape($title) . " " . ucfirst($this->trimHtmlEscape($default_page_title)) . " " . $this->trimHtmlEscape($num) . "\">" . $this->trimHtmlEscape($num) . "</a></li>";
                } else {
                    $main .= "<option value=\"" . $num . "\">" . ucfirst($this->trimHtmlEscape($default_page_title)) . " " . $num . "</option>";
                }
            }
        }
        unset($num);
        if ($page_number <> $total) {
            if ($type === 'select_page') {
                $main .= "<li class=\"" . htmlEscape($right_class) . "\"><a href=\"" . $this->trimHtmlEscape($page_links) . trim($default_page_prefix) . $total . trim($default_page_suffix) . "\" title=\"" . $this->trimHtmlEscape($title) . " trang cuối\">&nbsp;</a></li>";
            } else {
                $main .= "<option value=\"" . $total . "\">" . $this->trimHtmlEscape($default_last_page_name_title) . "</option>";
            }
        }

        return $main;
    }

    /**
     * Function cleanPaginationUrl
     *
     * @param string $str
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/09/2021 17:10
     */
    public function cleanPaginationUrl(string $str = ''): string
    {
        $str = str_replace(array('trang-', 'Trang-', '/page/'), '', $str);

        return trim($str);
    }

    /**
     * Function getPageNumber
     *
     * @param string $str
     *
     * @return int
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 13/02/2023 59:30
     */
    public function getPageNumber(string $str = ''): int
    {
        $str = str_replace('trang-', '', $str);

        return (int) $str;
    }

    /**
     * Function getPaginationsTitle
     *
     * @param $str
     *
     * @return array|string|string[]
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 13/02/2023 59:06
     */
    public function getPaginationsTitle($str)
    {
        return str_replace('trang-', 'Trang ', $str);
    }

    /**************************************************************/
    /**
     * Function trimHtmlEscape
     *
     * @param $str
     *
     * @return string
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 13/02/2023 56:48
     */
    private function trimHtmlEscape($str): string
    {
        $str = trim($str);

        return htmlEscape($str);
    }
}
