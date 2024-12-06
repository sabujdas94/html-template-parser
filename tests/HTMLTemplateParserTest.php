<?php

use PHPUnit\Framework\TestCase;
use HTMLTemplateParser\Parser;

class SecureTemplateParserTest extends TestCase
{
    public function testRenderBasicTemplate()
    {
        $parser = new Parser();
        $template = "Hello, {{ user.name }}!";
        $data = ['user' => ['name' => 'John']];

        $result = $parser->render($template, $data);

        $this->assertEquals("Hello, John!", $result);
    }

    public function testRenderWithConditionalLogic()
    {
        $parser = new Parser();
        $template = "{% if user.age > 18 %}Welcome, adult!{% else %}Welcome, young one!{% endif %}";
        $data = ['user' => ['age' => 20]];

        $result = $parser->render($template, $data);

        $this->assertEquals("Welcome, adult!", $result);
    }

    public function testEscapeHTML()
    {
        $parser = new Parser();
        $template = "Your input: {{ user.input }}";
        $data = ['user' => ['input' => '<script>alert("XSS")</script>']];

        $result = $parser->render($template, $data);

        $this->assertEquals("Your input: &lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;", $result);
    }

    public function testUnsupportedTags()
    {
        $parser = new Parser();
        $template = "{% set foo = 'bar' %}";
        $data = [];

        $this->expectException(\Twig\Sandbox\SecurityError::class);
        $parser->render($template, $data);
    }

}
