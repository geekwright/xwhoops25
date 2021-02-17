<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * @copyright 2019-2021 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author    Richard Griffith <richard@geekwright.com>
 */


defined('XOOPS_ROOT_PATH') or die("XOOPS root path not defined");

// get path to icons
$pathIcon32='';
if (class_exists('Xmf\Module\Admin', true)) {
    $pathIcon32 = \Xmf\Module\Admin::menuIconPath('');
}

$adminmenu=array();
// Index
$adminmenu[] = array(
    'title' => _MI_XWHOOPS_HOME ,
    'link'  => 'admin/index.php' ,
    'icon'  => $pathIcon32.'home.png'
) ;
// About
$adminmenu[] = array(
    'title' => _MI_XWHOOPS_ABOUT ,
    'link'  => 'admin/about.php' ,
    'icon'  => $pathIcon32.'about.png'
);
// Permissions
$adminmenu[] = array(
    'title' => _MI_XWHOOPS_PERMISSIONS ,
    'link'  => 'admin/permissions.php' ,
    'icon'  => $pathIcon32.'permissions.png'
);
// Test
$adminmenu[] = array(
    'title' => _MI_XWHOOPS_EXAMPLE ,
    'link'  => 'admin/index.php?do=example' ,
    'icon'  => $pathIcon32.'exec.png'
);
