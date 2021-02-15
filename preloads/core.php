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
        xoops_loadLanguage('logger');
        require_once $autoloader;
        $permissionHelper = new Permission('xwhoops25');
        if ($permissionHelper) {
            $permissionName = 'use_xwhoops';
            $permissionItemId = 0;

            if ($permissionHelper->checkPermission($permissionName, $permissionItemId, false)) {
                $whoops = new \Whoops\Run;
                $handler = new \Whoops\Handler\PrettyPageHandler;
                $whoops->pushHandler($handler);
                $whoops->register();
                $handler->addDataTableCallback(
                    _LOGGER_QUERIES,
                    function () {
                        $logger = XoopsLogger::getInstance();
                        if (false == $logger->renderingEnabled) {
                            return ['XoopsLogger' => 'off'];  // logger is off so data is incomplete
                        }
                        $queries = [];
                        $count=1;
                        foreach($logger->queries as $key => $q) {
                            $error = (null===$q['errno'] ? '' : $q['errno']) . (null===$q['error'] ? '' : $q['error']);
                            $queryTime = isset($q['query_time']) ? sprintf('%0.6f', $q['query_time']) : '';
                            $queryKey = (string) $count++ . ' - ' . $queryTime;
                            if (null !== $q['errno']) {
                                $queryKey = (string) $count .' - Error' ;
                            }
                            $queries[$queryKey] = htmlentities($q['sql']) . ' ' . $error;
                        }
                        return ($queries);
                    }
                );
            }
        }
    }
}
