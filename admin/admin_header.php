<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

use Xmf\Language;

/**
 * @copyright 2019-2021 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author    Richard Griffith <richard@geekwright.com>
 */

$path = dirname(__DIR__, 3);
require_once $path . '/mainfile.php';
require_once $path . '/include/cp_functions.php';
require_once $path . '/include/cp_header.php';

class_exists('\Xmf\Module\Admin') or die('XMF is required.');

global $xoopsModule;

$thisModuleDir = $GLOBALS['xoopsModule']->getVar('dirname');

Language::load('main', $thisModuleDir);

xoops_cp_header();
