<?php

namespace SecureTemplateParser;

use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Twig\Extension\SandboxExtension;
use Twig\Sandbox\SecurityPolicy;

class HTMLTemplateParser
{
    protected Environment $twig;

    public function __construct()
    {
        // Define allowed Twig features
        $policy = new SecurityPolicy(
            ['if'],                      // Allowed tags
            ['escape', 'length'],        // Allowed filters
            ['length'],                  // Allowed methods
            [],                          // Allowed properties
            []                           // Allowed functions
        );

        // Set up Twig environment with Sandbox
        $loader = new ArrayLoader();
        $this->twig = new Environment($loader);
        $this->twig->addExtension(new SandboxExtension($policy));
    }

    /**
     * Render the template with the given data.
     *
     * @param string $template User-provided Twig template
     * @param array $data Data to populate the template
     * @return string Rendered template
     * @throws \Twig\Error\Error
     */
    public function render(string $template, array $data): string
    {
        // Escape output by default
        $this->twig->getExtension(SandboxExtension::class)->enableSandbox();

        // Render the template safely
        return $this->twig->createTemplate($template)->render($data);
    }
}
