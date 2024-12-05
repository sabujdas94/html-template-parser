## Examples

You can find usage examples in the `examples/` directory.

### Basic Example

```php
require 'path-to-your-package/vendor/autoload.php';

use SecureTemplateParser\SecureTemplateParser;

$parser = new SecureTemplateParser();

$template = <<<EOT
Hi {{ user.name }}

{% if user.age > 18 %}
You're eligible for adult benefits.
{% else %}
You're still a minor.
{% endif %}
EOT;

$data = [
    'user' => [
        'name' => 'John Doe',
        'age' => 25,
    ],
];

echo $parser->render($template, $data);
