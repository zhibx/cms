<?php

namespace Juzaweb\DevTool\Providers;

use Illuminate\Support\ServiceProvider;
use Juzaweb\DevTool\Commands\CacheSizeCommand;
use Juzaweb\DevTool\Commands\FindFillableColumnCommand;
use Juzaweb\DevTool\Commands\MakeAdminCommand;
use Juzaweb\DevTool\Commands\Plugin;
use Juzaweb\DevTool\Commands\Plugin\ActionMakeCommand;
use Juzaweb\DevTool\Commands\Plugin\CommandMakeCommand;
use Juzaweb\DevTool\Commands\Plugin\ControllerMakeCommand;
use Juzaweb\DevTool\Commands\Plugin\DisableCommand;
use Juzaweb\DevTool\Commands\Plugin\EnableCommand;
use Juzaweb\DevTool\Commands\Plugin\EventMakeCommand;
use Juzaweb\DevTool\Commands\Plugin\InstallCommand as PluginInstallCommand;
use Juzaweb\DevTool\Commands\Plugin\JobMakeCommand;
use Juzaweb\DevTool\Commands\Plugin\ListCommand;
use Juzaweb\DevTool\Commands\Plugin\ListenerMakeCommand;
use Juzaweb\DevTool\Commands\Plugin\MiddlewareMakeCommand;
use Juzaweb\DevTool\Commands\Plugin\Migration\LaravelModulesV6Migrator;
use Juzaweb\DevTool\Commands\Plugin\Migration\MigrateCommand;
use Juzaweb\DevTool\Commands\Plugin\Migration\MigrateRefreshCommand;
use Juzaweb\DevTool\Commands\Plugin\Migration\MigrateResetCommand;
use Juzaweb\DevTool\Commands\Plugin\Migration\MigrateRollbackCommand;
use Juzaweb\DevTool\Commands\Plugin\Migration\MigrateStatusCommand;
use Juzaweb\DevTool\Commands\Plugin\Migration\MigrationMakeCommand;
use Juzaweb\DevTool\Commands\Plugin\ModelMakeCommand;
use Juzaweb\DevTool\Commands\Plugin\ModuleDeleteCommand;
use Juzaweb\DevTool\Commands\Plugin\ModuleMakeCommand;
use Juzaweb\DevTool\Commands\Plugin\ProviderMakeCommand;
use Juzaweb\DevTool\Commands\Plugin\Publish\PublishCommand;
use Juzaweb\DevTool\Commands\Plugin\RequestMakeCommand;
use Juzaweb\DevTool\Commands\Plugin\ResourceMakeCommand;
use Juzaweb\DevTool\Commands\Plugin\RouteProviderMakeCommand;
use Juzaweb\DevTool\Commands\Plugin\RuleMakeCommand;
use Juzaweb\DevTool\Commands\Plugin\SeedCommand;
use Juzaweb\DevTool\Commands\Plugin\Translation\ImportTranslationCommand;
use Juzaweb\DevTool\Commands\Plugin\Translation\TranslateViaGoogleCommand;
use Juzaweb\DevTool\Commands\Resource;
use Juzaweb\DevTool\Commands\Theme;

class ConsoleServiceProvider extends ServiceProvider
{
    protected array $commands = [
        PluginInstallCommand::class,
        CommandMakeCommand::class,
        ControllerMakeCommand::class,
        DisableCommand::class,
        //DumpCommand::class,
        EnableCommand::class,
        EventMakeCommand::class,
        JobMakeCommand::class,
        ListenerMakeCommand::class,
        PublishCommand::class,
        //MailMakeCommand::class,
        MiddlewareMakeCommand::class,
        //NotificationMakeCommand::class,
        ProviderMakeCommand::class,
        RouteProviderMakeCommand::class,
        ListCommand::class,
        ModuleDeleteCommand::class,
        ModuleMakeCommand::class,
        //FactoryMakeCommand::class,
        //PolicyMakeCommand::class,
        RequestMakeCommand::class,
        RuleMakeCommand::class,
        MigrateCommand::class,
        MigrateRefreshCommand::class,
        MigrateResetCommand::class,
        MigrateRollbackCommand::class,
        MigrateStatusCommand::class,
        MigrationMakeCommand::class,
        ModelMakeCommand::class,
        SeedCommand::class,
        Plugin\SeedMakeCommand::class,
        ResourceMakeCommand::class,
        Plugin\TestMakeCommand::class,
        LaravelModulesV6Migrator::class,
        Theme\ThemeGeneratorCommand::class,
        Theme\ThemeListCommand::class,
        ActionMakeCommand::class,
        Resource\DatatableMakeCommand::class,
        Resource\JuzawebResouceMakeCommand::class,
        MakeAdminCommand::class,
        Theme\GenerateDataThemeCommand::class,
        Theme\DownloadStyleCommand::class,
        Theme\DownloadTemplateCommand::class,
        Plugin\UpdateCommand::class,
        Theme\ThemeUpdateCommand::class,
        Theme\MakeBlockCommand::class,
        CacheSizeCommand::class,
        ImportTranslationCommand::class,
        TranslateViaGoogleCommand::class,
        Plugin\Translation\ExportTranslationCommand::class,
        Plugin\RepositoryMakeCommand::class,
        Theme\ExportTranslationCommand::class,
        Theme\ImportTranslationCommand::class,
        Theme\TranslateViaGoogleCommand::class,
        FindFillableColumnCommand::class,
        Resource\CRUDMakeCommand::class,
    ];

    /**
     * Register the commands.
     */
    public function register(): void
    {
        $this->commands($this->commands);
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return $this->commands;
    }
}
