<?php declare(strict_types=1);

/*
 * This file is part of Zafkiel.
 *
 * (c) Kévin BENTO <kevin.bento@free.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zafkiel\Parser;

require(__DIR__ . '/iParser.php');

use Zafkiel\Parser\iParser;
use Zafkiel\Mapper\ObjectMapper;

/**
 * Parser for Zafkiel, designed for specific mapping returned by Zafkiel\Mapper\ObjectMapper
 * @see Zafkiel\Mapper\ObjectMapper
 * 
 * @package Zafkiel-Core
 * @since v0.1.0
 * @author BENTO Kévin (kevin.bento@free.fr)
 *
 * @link https://github.com/kevin10-26/Zafkiel-Core
 */

class Parser implements iParser
{
    private array $_parsedData   = [];
    private ?ObjectMapper $_data = null;

    /**
     * Parses an input according to the mode passed as a parameter.
     * 
     * @since v0.1.0
     * @see Zafkiel\Mapper\ObjectMapper
     * 
     * @param array $data {
     *      @type string $key module : specifies the module
     *      @type array $key data {} : the data inside, which will be parsed
     * }
     * 
     * @return Parser : should be called with get() method of the same class.
     */
    public function __construct($data)
    {
        $this->_data['data'] = $data;
    }

    /**
     * Parses an input according to the mode in parameter.
     * 
     * @since v0.1.0
     * @see Zafkiel\Parser\Parser->get() method
     * @see $this->json() and $this->content()
     * 
     * @param string $mode : used to parse the string according to its source : json / classic array, into an array recognized by the class.
     * 
     * @return Parser : should be called with get() method of the same class.
     */

    public function parse($mode) : Parser
    {
        $this->$mode();
        
        return $this;
    }

    /**
     * Gets data returned by the parse() method of the same class.
     * 
     * @since v0.1.0
     * 
     * @return Array $this->_parsedData : should be called after the parse() method of the same class.
     * @see Zafkiel\Parser\Parser->parse() method
     */

    public function get() : Array
    {
        return $this->_parsedData;
    }

    /**
     * Parses submitted data via the constructor into JSON.
     * 
     * @since v0.1.0
     * 
     * @return void
     * @see Zafkiel\Parser\Parser->parse() method
     * @see Zafkiel\Parser\Parser->__construct method
     */

    private function json() : void
    {
        $this->_parsedData = json_encode($this->_data);
    }

    /**
     * Parses submitted data via the constructor into classic array, for instance :
     * {
     *      data: array()
     * }
     * 
     * @since v0.1.0
     * 
     * @return void
     * @see Zafkiel\Parser\Parser->parse() method
     * @see Zafkiel\Parser\Parser->__construct method
     */

    private function content() : void
    {
        $this->_parsedData = $this->_data['data'];
    }
}