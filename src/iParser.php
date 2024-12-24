<?php declare(strict_types=1);

namespace Zafkiel;

interface iParser
{
    public function parse($mode) : Parser;
    public function get()        : string|Array;
}