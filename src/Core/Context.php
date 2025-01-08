<?php declare(strict_types=1);

namespace Zafkiel\Core;

abstract class Context
{
    protected array $_data;

    public function setData(array $data)
    {
        $this->_data = $data;
    }

    public function getData()
    {
        return $this->_data;
    }
}