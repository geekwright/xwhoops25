<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

use Xmf\Module\Admin;

/**
 * @copyright 2019-2021 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author    Richard Griffith <richard@geekwright.com>
 */


require __DIR__ . '/admin_header.php';

$moduleAdmin = Admin::getInstance();
$moduleAdmin->displayNavigation('index.php');
$autoloader = dirname(__DIR__) . '/vendor/autoload.php';
if (!file_exists($autoloader)) {
    $moduleAdmin->addConfigWarning(_MI_XWHOOPS_NEEDS_COMPOSER);
}
$moduleAdmin->displayIndex();

// example - bounces around and into an error
// will show xWhoops25 page if user has permission
$op = \Xmf\Request::getString('do');
if ('example' === $op) {
    require_once __DIR__ . '/ExampleClass.php';
    number1();
}

function number1()
{
    number3('test message');
}

function number2(ExampleClass $ec)
{
    $msg = $ec->flawedMethod();
}

function number3($msg)
{
    number2(new ExampleClass($msg));
}

require __DIR__ . '/admin_footer.php';
