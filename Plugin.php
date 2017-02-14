<?php namespace NotOnPaper\OctobercmsNopTheme;

use System\Classes\PluginBase;
use Illuminate\Support\Facades\Event;
use Backend\Facades\Backend;
use Backend\Classes\Controller as BackendController;
use System\Models\PluginVersion;

/**
 * Class Plugin
 * @package NotOnPaper\OctobercmsNopTheme
 */
class Plugin extends PluginBase
{
    /**
     * Run this code at boot.
     */
    public function boot() {

        Event::listen('backend.menu.extendItems', function($manager) {

            $manager->addMainMenuItems('October.Backend', [
                'dashboard' => [
                    'icon'        => 'icon-dashboard'
                ],
            ]);

            $manager->addMainMenuItems('October.System', [
                'system' => [
                    'icon' => 'icon-cogs'
                ],
            ]);

            $manager->addMainMenuItems('October.Cms', [
                'media' => [
                    'icon' => 'icon-camera'
                ],
                'cms' => [
                    'icon' => 'icon-edit'
                ],
            ]);

            $manager->addSideMenuItems('October.Cms', 'cms', [
                'pages' => [
                    'icon' => 'icon-file'
                ]
            ]);

            if(PluginVersion::where('code', 'RainLab.Pages')->where('is_disabled', 0)->first()){
                $manager->addMainMenuItems('RainLab.Pages', [
                    'pages' => [
                        'icon' => 'icon-file'
                    ]
                ]);
            }

        });

        BackendController::extend(function ($controller) {
            $controller->addCss('/plugins/notonpaper/octobercmsnoptheme/assets/css/custom.css');
        });
    }
}
