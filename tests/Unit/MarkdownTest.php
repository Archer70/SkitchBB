<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Utils\Markdown;

class MarkdownTest extends TestCase
{
    public function testFilterValidUrl()
    {
        $this->assertEquals('http://okay', Markdown::filterUrl('http://okay'));
        $this->assertEquals('https://okay', Markdown::filterUrl('https://okay'));
    }

    public function testInvalidUrlPrefix()
    {
        $this->assertEquals('', Markdown::filterUrl('javascript:alert("test")'));
    }

    public function testConvertsToMarkdown()
    {
        $this->assertEquals(
            "<p><a href=\"http://okay\">title</a></p>\n",
            Markdown::render('[title](http://okay)')
        );
    }
}
