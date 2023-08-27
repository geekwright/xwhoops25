<?php declare(strict_types=1);

//namespace XoopsModules\Xwhoops25;

use Xmf\Module\Helper\Permission;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

/**
 * @copyright 2019-2021 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author    Richard Griffith <richard@geekwright.com>
 */
class Xwhoops25CorePreload extends \XoopsPreloadItem
{
    private const AUTOLOADER_PATH = '/vendor/autoload.php';
    private const PERMISSION_NAME = 'use_xwhoops';
    private const PERMISSION_ITEM_ID = 0;

    /**
     * eventCoreIncludeCommonAuthSuccess
     */
    public static function eventCoreIncludeCommonAuthSuccess(): void
    {
        self::initializeAutoloader();
        self::initializeWhoops();
    }

    /**
     * @return void
     */
    private static function initializeAutoloader(): void
    {
        $autoloader = \dirname(__DIR__) . self::AUTOLOADER_PATH;

        if (!\file_exists($autoloader)) {
            // Throw an exception for better error handling
            throw new \RuntimeException("xwhoops25/vendor/autoload.php not found, was 'composer install' done?");
        }

        require_once $autoloader;
    }

    /**
     * @return void
     */
    private static function initializeWhoops(): void
    {
        $permissionHelper = new Permission('xwhoops25');
        if ($permissionHelper->checkPermission(self::PERMISSION_NAME, self::PERMISSION_ITEM_ID, false)) {
            self::registerWhoops();
        }
    }

    /**
     * @return void
     */
    private static function registerWhoops(): void
    {
        $whoops = new Run();
        $handler = new PrettyPageHandler();

        $whoops->pushHandler($handler);
        $whoops->register();

        $handler->addDataTableCallback(
            \_LOGGER_QUERIES,
            static function () {
                return self::getLoggerQueries();
            }
        );
    }

    /**
     * @return array|string[]
     */
    private static function getLoggerQueries(): array
    {
        $logger = \XoopsLogger::getInstance();

        if (false === $logger->renderingEnabled) {
            return ['XoopsLogger' => 'off'];
        }

        $queries = [];
        $count = 1;

        foreach ($logger->queries as $key => $query) {
            $queries[$count] = self::formatQuery($query, $count);
            $count++;
        }

        return $queries;
    }

    /**
     * @param array $query
     * @param int   $count
     *
     * @return string
     */
    private static function formatQuery(array $query, int $count): string
    {
        $error = (null === $query['errno'] ? '' : $query['errno'] . ' ') . ($query['error'] ?? '');
        $queryTime = isset($query['query_time']) ? \sprintf('%0.6f', $query['query_time']) : '';
        $queryKey = $count . ' - ' . $queryTime;

        if (null !== $query['errno']) {
            $queryKey = $count . ' - Error';
        }

        return \htmlentities($query['sql'], \ENT_QUOTES | \ENT_HTML5) . ' ' . $error;
    }
}
