<?php

function getTemplateEngine(): object
{
    return httpKernel()->getTemplateEngine();
}

function renderTemplate(string $templatePath, array $variables = []): void
{
    getTemplateEngine()->render($templatePath, $variables);
}
