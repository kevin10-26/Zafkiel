<?php declare(strict_types=1);

namespace Zafkiel\Tests\Unit;

require './vendor/autoload.php';
require __DIR__ . '/../../src/ObjectParser.php';

use Zafkiel\ObjectParser;
use PHPUnit\Framework\TestCase;

final class ParserTest extends TestCase
{
    public function testParseJson(): void
    {
        $jsonData = array("test" => "Hello world");
        $parser = new ObjectParser(json_encode($jsonData));

        $parserResult = $parser->parse('json')->get();

        $this->assertSame(array("test" => "Hello world"), $parserResult);
    }

    public function testParseHTTP(): void
    {
        $jsonData = array("test" => "Hello world", "test2" => "Bye world");
        $parser = new ObjectParser(json_encode($jsonData));

        $parserResult = $parser->parse('content')->get();

        $this->assertSame(array("test" => "Hello world"), $parserResult);
    }
}