<?php declare(strict_types=1);

namespace Zafkiel\Mapper;

class ObjectMapper
{
    private $data = [];
    public function mapData($data)
    {
        $this->data = $data;
        return $this;
    }
}