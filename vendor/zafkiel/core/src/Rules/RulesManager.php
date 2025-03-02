<?php declare(strict_types=1);

namespace Zafkiel\Rules;

use Zafkiel\Core\Factory;
use Zafkiel\Rules\DOMGenerator;

class RulesManager
{
    private array $_rules = [];

    private DOMGenerator $_dom;

    public function __construct(DOMGenerator $dom)
    {
        $this->_dom = $dom;
    }

    public function addRule() : RulesManager
    {
        $element = $this->_dom->renderDOM();
        
        array_push($this->_rules, $element);

        return $this;
    }

    public function getRules()
    {
        return $this->_rules;
    }

    public function getRuleByIndex($index)
    {
        return $this->_rules[$index];
    }

    public function getLastInsertedRule()
    {
        $rules = $this->getRules();

        return $rules[count($rules) - 1];
    }
}