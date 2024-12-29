<?php declare(strict_types=1);

namespace Zafkiel;

class TransferObject
{
    private ?array $_content = null;
    private string $_module  = "";

    public string $version = 'v0.1.0';

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

    final public function getVersion()
    {
        return $this->version;
    }
}