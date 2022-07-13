<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/juzacms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Juzaweb\Backend\Actions;

use Juzaweb\Backend\Http\Controllers\Backend\Setting\SeoController;
use Juzaweb\Backend\Models\SeoMeta;
use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\CMS\Models\Model;

class SeoAction extends Action
{
    public function handle()
    {
        $this->addAction(
            Action::POSTS_FORM_LEFT_ACTION,
            [$this, 'addFormSeo']
        );

        $this->addAction(
            Action::BACKEND_INIT,
            [$this, 'addAjaxs']
        );

        $this->addAction(Action::BACKEND_INIT, [$this, 'addMenu']);
    }

    public function addMenu()
    {
        /*HookAction::registerAdminPage(
            'setting.seo',
            [
                'title' => trans('cms::app.seo_setting'),
                'menu' => [
                    'icon' => 'fa fa-line-chart',
                    'parent' => 'setting'
                ]
            ]
        );*/
    }

    public function addAjaxs()
    {
        HookAction::registerAdminAjax(
            'seo-content',
            [
                'callback' => [SeoController::class, 'getStringRaw'],
                'method' => 'post'
            ]
        );
    }

    public function addFormSeo(Model $model)
    {
        $data = SeoMeta::findByModel($model);

        echo e(
            view(
                'cms::backend.items.seo_form',
                compact(
                    'model',
                    'data'
                )
            )
        );
    }
}
