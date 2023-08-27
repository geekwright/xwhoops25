<?php declare(strict_types=1);
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
 * @license   GNU GPL 2.0 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author    Richard Griffith <richard@geekwright.com>
 */

use Xmf\Module\Admin;
use Xmf\Module\Helper;
use Xmf\Module\Helper\Permission;
use Xmf\Request;

require_once __DIR__ . '/admin_header.php';

require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

$moduleAdmin = Admin::getInstance();
$moduleAdmin->displayNavigation('permissions.php');

$helper     = Helper::getHelper('xwhoops');
$permHelper = new Permission();
if ($permHelper) {
    // this is the name and item we are going to work with
    $permissionName   = 'use_xwhoops';
    $permissionItemId = 0;

    // if this is a post operation get our variables
    if ('POST' === Request::getMethod()) {
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header(XOOPS_URL . '/', 3, $GLOBALS['xoopsSecurity']->getErrors());
        }
        $name   = $permHelper->defaultFieldName($permissionName, $permissionItemId);
        $groups = Request::getVar($name, [], 'POST');
        $permHelper->savePermissionForItem($permissionName, $permissionItemId, $groups);
        xoops_result(_MA_XWHOOPS_FORM_PROCESSED, _MA_XWHOOPS_PERMISSION_FORM);
    }
    $form        = new XoopsThemeForm(_MA_XWHOOPS_PERMISSION_FORM, 'form', '', 'POST', true);
    $permElement = $permHelper->getGroupSelectFormForItem(
        $permissionName,
        $permissionItemId,
        _MA_XWHOOPS_PERMISSION_GROUPS,
        null,
        true
    );

    $form->addElement($permElement);
    $form->addElement(new XoopsFormButton('', 'submit', _MA_XWHOOPS_FORM_SUBMIT, 'submit'));

    echo $form->render();
}

require_once __DIR__ . '/admin_footer.php';
