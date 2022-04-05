<?php
/**
 * @package    juzaweb/juzacms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://github.com/juzaweb/juzacms
 * @license    MIT
 */

namespace Juzaweb\CMS\Support;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Foundation\ProviderRepository;
use Illuminate\Support\Str;
use Juzaweb\CMS\Abstracts\Plugin as BasePlugin;

class Module extends BasePlugin
{
    /**
     * {@inheritdoc}
     */
    public function getCachedServicesPath(): string
    {
        return Str::replaceLast(
            'services.php',
            $this->getSnakeName() . '_module.php',
            $this->app->getCachedServicesPath()
        );
    }

    /**
     * {@inheritdoc}
     */
    public function registerProviders(): void
    {
        $providers = $this->getExtraJuzaweb('providers', []);
        
        if (config('plugin.autoload')) {
            $providers = array_merge(
                $this->getExtraLarevel('providers', []),
                $providers
            );
        }
        
        try {
            (new ProviderRepository(
                $this->app,
                new Filesystem(),
                $this->getCachedServicesPath()
            ))
                ->load($providers);
        } catch (\Throwable $e) {
            $this->disable();
            throw $e;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function registerAliases(): void
    {
        $loader = AliasLoader::getInstance();

        foreach ($this->getExtraJuzaweb('aliases', []) as $aliasName => $aliasClass) {
            $loader->alias($aliasName, $aliasClass);
        }
    }
}
