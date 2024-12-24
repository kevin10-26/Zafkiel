<?php declare(strict_types=1);

namespace Zafkiel;

class TransferObject
{
    private ?array $_content = null;
    private string $_module  = "";

    final public function setBody($body)
    {
        $this->_content = $body;
    }

    final public function getContent()
    {
        return $this->_content['data'];
    }

    final public function getModule()
    {
        return $this->_module;
    }
}