<?php declare(strict_types=1);

namespace Zafkiel\Rules;

use DOMDocument;
use DOMElement;

use Zafkiel\Core\Factory;

class DOMGenerator implements DOMExtensionGenerator
{
    private string $_node;

    private DOMDocument $_dom;

    public function __construct(string $node)
    {
        $this->_node = $node;
    }

    public function renderDOM() : DOMDocument
    {
        $this->_dom = new DOMDocument();

        $element = $this->_dom->createElement($this->_node);

        $this->_dom->appendChild($element);

        return $this->_dom;
    }

    public function getParsedNode() : string
    {
        return $this->_dom->saveHTML();
    }
}