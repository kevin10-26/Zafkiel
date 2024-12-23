<?php declare(strict_types=1);

namespace Zafkiel\Parser;

interface iParser
{
    public function parse($mode) : Parser;
    public function get() : Array;
}