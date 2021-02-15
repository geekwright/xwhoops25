<?php

use Xmf\Module\Helper\Permission;


/**
 * @copyright 2019-2021 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author    Richard Griffith <richard@geekwright.com>
 */
class Xwhoops25CorePreload extends XoopsPreloadItem
{
    /**
     * eventCoreIncludeCommonAuthSuccess
     *
     * @return void
     */
    public static function eventCoreIncludeCommonAuthSuccess()
    {
        $autoloader = dirname(__DIR__) . '/vendor/autoload.php';
        if (!file_exists($autoloader)) {
            trigger_error("xwhoops25/vendor/autoload.php not found, was 'composer install' done?");
            return;
        }
        require_once $autoloader;
        $permissionHelper = new Permission('xwhoops25');
        if ($permissionHelper) {
            $permissionName = 'use_xwhoops';
            $permissionItemId = 0;

            if ($permissionHelper->checkPermission($permissionName, $permissionItemId)) {
                $whoops = new \Whoops\Run;
                $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
                $whoops->register();
            }
        }
    }
}
