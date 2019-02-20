<?php

use Xmf\Module\Helper\Permission;
use Xoops\Core\PreloadItem;


/**
 * @copyright 2019 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author    Richard Griffith <richard@geekwright.com>
 */
class XwhoopsPreload extends PreloadItem
{
    /**
     * eventCoreIncludeCommonAuthSuccess
     *
     * @return void
     */
    public static function eventCoreIncludeCommonAuthSuccess()
    {
        $permissionHelper = new Permission('xwhoopsmc');
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
