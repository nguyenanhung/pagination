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
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Function build
     *
     * @return string|null
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 13/02/2023 24:22
     */
    public function build()
    {
        $page_link = isset($this->data['page_link']) ? $this->data['page_link'] : '';
        $page_title = isset($this->data['page_title']) ? $this->data['page_title'] : '';
        $page_prefix = isset($this->data['page_prefix']) ? $this->data['page_prefix'] : '';
        $page_suffix = isset($this->data['page_suffix']) ? $this->data['page_suffix'] : '';
        $current_page_number = isset($this->data['current_page_number']) ? $this->data['current_page_number'] : 1;
        $total_item = isset($this->data['total_item']) ? $this->data['total_item'] : 0;
        $item_per_page = isset($this->data['item_per_page']) ? $this->data['item_per_page'] : 10;
        $begin = isset($this->data['pre_rows']) ? $this->data['pre_rows'] : 3;
        $end = isset($this->data['suf_rows']) ? $this->data['suf_rows'] : 3;
        $first_link = isset($this->data['first_link']) ? $this->data['first_link'] : '&nbsp;';
        $last_link = isset($this->data['last_link']) ? $this->data['last_link'] : '&nbsp;';
        $default_page_title = isset($this->data['default_page_title']) ? $this->data['default_page_title'] : 'trang';
        $default_last_page_name_title = isset($this->data['default_last_page_name_title']) ? $this->data['default_last_page_name_title'] : 'trang cuối';
        $left_class = isset($this->data['left_class']) ? $this->data['left_class'] : 'left';
        $right_class = isset($this->data['right_class']) ? $this->data['right_class'] : 'right';
        $selected_class = isset($this->data['selected_class']) ? $this->data['selected_class'] : 'selected';

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
            return null;
        }

        $output_html = '';
        if ($current_page_number !== 1) {
            $output_html .= '<li class="' . trim($left_class) . '"><a href="' . trim($page_link) . trim($page_suffix) . '" title="' . trim($page_title) . '">' . trim($first_link) . '</a></li>';
        }

        for ($page_number = 1; $page_number <= $total_page; $page_number++) {
            if ($page_number < ($current_page_number - $begin) || $page_number > ($current_page_number + $end)) {
                continue;
            }

            if ($page_number === $current_page_number) {
                $output_html .= '<li class="' . trim($selected_class) . '"><a href="' . trim($page_link) . trim($page_prefix) . trim($page_number) . trim($page_suffix) . '" title="' . $page_title . ' ' . $default_page_title . ' ' . $page_number . '">' . $page_number . '</a></li>';
            } else {
                $output_html .= '<li><a href="' . trim($page_link) . trim($page_prefix) . trim($page_number) . trim($page_suffix) . '" title="' . $page_title . ' ' . $default_page_title . ' ' . $page_number . '">' . $page_number . '</a></li>';
            }
        }
        unset($page_number);

        if ($current_page_number !== $total_page) {
            $output_html .= '<li class="' . trim($right_class) . '"><a href="' . trim($page_link) . trim($page_prefix) . trim($total_page) . trim($page_suffix) . '" title="' . trim($page_title) . ' - ' . $default_last_page_name_title . ' ">' . trim($last_link) . '</a></li>';
        }

        return $output_html;
    }
}
