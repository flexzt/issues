<?php

namespace App\System\View\Blade;

use App\System\Context;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

/**
 * Class Blade
 *
 * @package App\System\View\Blade
 */
class Blade
{
    public static $_BaseDir = '';
    public       $view     = null;
    public       $viewData;

    public function __construct($compiler = null)
    {

        static::$_BaseDir = Context::App()->config->basePath;

        $this->viewData['basePath'] = '/';
        $this->viewData['errors'] = [];

        // Configuration
        // Note that you can set several directories where your templates are located
        $pathsToTemplates        = [static::$_BaseDir . '/app/resources/views',];
        $pathToCompiledTemplates = static::$_BaseDir . '/var/view_templates_c';

        // Dependencies
        $filesystem      = new Filesystem;
        $eventDispatcher = new Dispatcher(new Container);

        // Create View Factory capable of rendering PHP and Blade templates
        $viewResolver  = new EngineResolver;
        $bladeCompiler = new BladeCompiler($filesystem, $pathToCompiledTemplates);

        $viewResolver->register('blade', function () use ($bladeCompiler) {
            return new CompilerEngine($bladeCompiler);
        });

        $viewResolver->register('php', function () {
            return new PhpEngine;
        });

        $viewFinder = new FileViewFinder($filesystem, $pathsToTemplates);
        $this->view = new Factory($viewResolver, $viewFinder, $eventDispatcher);

    }

    public function fetch($viewName, $templateData)
    {

        // Render template
        return $this->view->make($viewName, $templateData)->render();
    }

    public function getTemplateVars($varName = null)
    {
        return $this->smarty->getTemplateVars($varName);
    }
}
