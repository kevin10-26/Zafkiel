<?php declare(strict_types=1);

namespace Zafkiel\Mapper;

use Zafkiel\TransferObject;

interface Mapper
{
    public function mapData()       : ObjectMapper;
    public function getMappedData() : TransferObject;
}