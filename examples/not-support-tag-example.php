<?php

require __DIR__ . '/../vendor/autoload.php';

use SecureTemplateParser\SecureTemplateParser;

// Create a new instance of the parser
$parser = new SecureTemplateParser();

// Define a template with a mix of supported and unsupported features
$template = <<<EOT
Hi {{ user.name }}

{% for item in user.items %}
- {{ item }}
{% endfor %}


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
        'items' => ['Item 1', 'Item 2', 'Item 3'],
    ],
];

// Render the template and handle exceptions
try {
    $result = $parser->render($template, $data);
    echo $result;
} catch (\Twig\Sandbox\SecurityError $e) {
    echo "Security Error: " . $e->getMessage() . "\n";
} catch (\Exception $e) {
    echo "Error rendering template: " . $e->getMessage() . "\n";
}
