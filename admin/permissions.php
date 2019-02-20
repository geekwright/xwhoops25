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
 * @copyright 2019 XOOPS Project (https://xoops.org)
 * @license   GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @author    Richard Griffith <richard@geekwright.com>
 */


use Xmf\Request;
use Xmf\Module\Admin;
use Xmf\Module\Helper;
use Xmf\Module\Helper\Permission;


include_once __DIR__ . '/admin_header.php';

$moduleAdmin = Admin::getInstance();
$moduleAdmin->displayNavigation('permissions.php');

$helper = Helper::getHelper('xwhoops');
$permHelper = new Permission();
if ($permHelper) {
    // this is the name and item we are going to work with
    $permissionName='use_xwhoops';
    $permissionItemId=0;

    // if this is a post operation get our variables
    if ('POST'===Request::getMethod()) {
        $name=$permHelper->defaultFieldName($permissionName, $permissionItemId);
        $groups=Request::getVar($name, array(), 'POST');
        $permHelper->savePermissionForItem($permissionName, $permissionItemId, $groups);
        echo $xoops->alert('success', _MA_XWHOOPS_FORM_PROCESSED, _MA_XWHOOPS_PERMISSION_FORM);
    }

    $form = new \Xoops\Form\ThemeForm(_MA_XWHOOPS_PERMISSION_FORM, 'form', '', 'POST');
    $permElement = $permHelper->getGroupSelectFormForItem(
        $permissionName,
        $permissionItemId,
        _MA_XWHOOPS_PERMISSION_GROUPS,
        null,
        true
    );

    $form->addElement($permElement);
    $form->addElement(new \Xoops\Form\Button('', 'submit', _MA_XWHOOPS_FORM_SUBMIT, 'submit'));

    echo $form->render();
}

include_once __DIR__ . '/admin_footer.php';
