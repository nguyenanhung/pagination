<?php
/**
 * Project pagination
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 13/02/2023
 * Time: 23:12
 */

namespace nguyenanhung\Libraries\Pagination\Pagination;

class BaseCore
{
    const VERSION = '2.1.1';

    public function getVersion(): string
    {
        return self::VERSION;
    }
}
