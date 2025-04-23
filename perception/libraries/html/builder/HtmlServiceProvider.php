<?php

namespace Perception\Libraries\Html\Builder;

use Collective\Html\HtmlServiceProvider as CollectiveHtmlServiceProvider;
use Illuminate\Support\Str;
use Illuminate\View\Compilers\BladeCompiler;
use Collective\Html\HtmlBuilder;

class HtmlServiceProvider extends CollectiveHtmlServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFormBuilder();

        $this->app->alias('form', FormBuilder::class);

        $this->registerBladeDirectives();
    }

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerFormBuilder()
    {
        $this->app->singleton('form', function ($app) {
            $form = new FormBuilder($app['html'], $app['url'], $app['view'], $app['session.store']->token(), $app['request']);

            return $form->setSessionStore($app['session.store']);
        });
    }

    /**
     * Register Blade directives.
     *
     * @return void
     */
    protected function registerBladeDirectives()
    {
        $this->app->afterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {
            $namespaces = [
                'Html' => get_class_methods(HtmlBuilder::class),
                'Form' => get_class_methods(FormBuilder::class),
            ];

            foreach ($namespaces as $namespace => $methods) {
                foreach ($methods as $method) {
                    if (in_array($method, $this->directives)) {
                        $snakeMethod = Str::snake($method);
                        $directive = strtolower($namespace) . '_' . $snakeMethod;

                        $bladeCompiler->directive($directive, function ($expression) use ($namespace, $method) {
                            return "<?php echo $namespace::$method($expression); ?>";
                        });
                    }
                }
            }
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['html', 'form', HtmlBuilder::class, FormBuilder::class];
    }
}
