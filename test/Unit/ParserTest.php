<?php declare(strict_types=1);

namespace Zafkiel\Tests\Unit;

require './vendor/autoload.php';
require __DIR__ . '/../../src/Parser/Parser.php';

use Zafkiel\Parser\Parser;
use PHPUnit\Framework\TestCase;

final class ParserTest extends TestCase
{
    public function testParseJson(): void
    {
        $jsonData = array("test" => "Hello world");
        $parser = new Parser(json_encode($jsonData));

        $parserResult = $parser->parseFromJSON();

        $this->assertSame(array("test" => "Hello world"), $parserResult);
    }

    public function testParseHTTP(): void
    {
        $jsonData = array("test" => "Hello world", "test2" => "Bye world");
        $parser = new Parser(json_encode($jsonData));

        $parserResult = $parser->parseFromJSON();

        $this->assertSame(array("test" => "Hello world"), $parserResult);
    }
}