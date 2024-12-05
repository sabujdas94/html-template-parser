<?php

require __DIR__ . '/../vendor/autoload.php';

use SecureTemplateParser\HTMLTemplateParser;

// Create a new instance of the parser
$parser = new HTMLTemplateParser();

// Define a user-provided template
$template = <<<EOT
Hi {{ user.name }}

{% if user.age > 18 %}
You're eligible for adult benefits.
{% else %}
You're still a minor.
{% endif %}
EOT;

// Define the data to populate the template
$data = [
    'user' => [
        'name' => 'John Doe',
        'age' => 25,
    ],
];

// Render the template with the provided data
try {
    $result = $parser->render($template, $data);
    echo $result;
} catch (\Exception $e) {
    throw $e;
}
