<?php

function getTemplateEngine(): object
{
    return httpKernel()->getTemplateEngine();
}

function renderTemplate(string $templatePath, array $variables)
{
    getTemplateEngine()->render($templatePath, $variables);
}
