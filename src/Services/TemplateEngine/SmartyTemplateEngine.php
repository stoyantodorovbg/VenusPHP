<?php

namespace StoyanTodorov\Core\Services\TemplateEngine;

use Smarty;
use StoyanTodorov\Core\Services\TemplateEngine\Interfaces\TemplateEngineInterface;

class SmartyTemplateEngine implements TemplateEngineInterface
{
    protected Smarty $instance;

    public function setup(): TemplateEngineInterface
    {
        print_r(templatesPath('templates', true));
        $this->instance = new Smarty();
        $this->instance->setTemplateDir(templatesPath('templates', true));
        $this->instance->setConfigDir(templatesPath('configs', true));
        $this->instance->setCompileDir(templatesPath('compile', true));
        $this->instance->setCacheDir(templatesPath('cache', true));

        return $this;
    }

    /**
     * @throws \SmartyException
     */
    public function render(string $templatePath, array $variables)
    {
        foreach ($variables as $name => $value) {
            $this->instance->assign($name, $value);
        }
        $this->instance->display($templatePath . '.tpl');
    }

    public function getEngineInstance(): object
    {
        return $this->instance;
    }
}