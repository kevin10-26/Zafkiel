<?php declare(strict_types=1);

namespace Zafkiel\Desktop;

interface Renderer
{
    public function render($source, $data = []) : string;
}