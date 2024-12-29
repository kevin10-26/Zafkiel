<?php declare(strict_types=1);

/*
 * This file is part of Zafkiel.
 *
 * (c) BENTO Kévin <kevin.bento@free.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Zafkiel;

require(__DIR__ . '/Parser.php');

use Zafkiel\Parser;
use Zafkiel\ObjectMapper;
use Zafkiel\TransferObject;

/**
 * Parser for Zafkiel, designed for specific mapping returned by Zafkiel\ObjectMapper
 * @see Zafkiel\ObjectMapper
 * 
 * @package Zafkiel-Core
 * @since v0.1.0
 * @author BENTO Kévin (kevin.bento@free.fr)
 *
 * @link https://github.com/kevin10-26/Zafkiel-Core
 */

class ObjectParser implements Parser
{
    private string|array $_parsedData     = [];
    private ?TransferObject $_data        = null;

    /**
     * @since v0.1.0
     * @see Zafkiel\Mapper\ObjectMapper
     * 
     * @param array $data {
     *      @type string $key module : specifies the module
     *      @type array $key data {} : the data inside, which will be parsed
     * }
     * 
     * @return void;
     */
    public function __construct($data)
    {
        $this->_data = $data;
    }

    /**
     * Parses an input according to the mode passed as a parameter. Should be used with the get() method, to get it in a readable format
     * @see Zafkiel\ObjectParser->get() method
     * 
     * @since v0.1.0
     * 
     * @param string $mode : used to parse the string according to its source : json / classic array, into an array recognized by the class.
     * 
     * @return ObjectParser : should be called with get() method of the same class.
     */

    public function parse($mode) : ObjectParser
    {
        $mode = sprintf('%s%s', '_', $mode);
        $this->$mode();
        
        return $this;
    }

    /**
     * Gets data returned by the parse() method of the same class. It is then used in a module to display content.
     * 
     * @since v0.1.0
     * 
     * @return Array $this->_parsedData : should be called after the parse() method of the same class.
     * @see Zafkiel\ObjectParser->parse() method
     */

    final public function get() : string|Array
    {
        return $this->_parsedData;
    }

    /**
     * Parses submitted data via the constructor into JSON.
     * 
     * @since v0.1.0
     * 
     * @return void
     * @see Zafkiel\ObjectParser->parse() method
     * @see Zafkiel\ObjectParser->__construct method
     */

    private function _json() : void
    {
        $this->_parsedData = json_encode($this->_data->getContent());
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
     * @see Zafkiel\ObjectParser->parse() method
     * @see Zafkiel\ObjectParser->__construct method
     */

    private function _content() : void
    {
        $this->_parsedData = $this->_data['data'];
    }
}