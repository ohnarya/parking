<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // add "$settingMyAccount" permission
        $settingMyAccount = $auth->createPermission('settingMyAccount');
        $settingMyAccount->description = 'Setting My Account';
        $auth->add($settingMyAccount);

        // add "$manageParkingLot" permission
        $manageParkingLot = $auth->createPermission('manageParkingLots');
        $manageParkingLot->description = 'Manage Parking Lots';
        $auth->add($manageParkingLot);

        // add "$manageDestination" permission
        $manageDestination = $auth->createPermission('manageDestinations');
        $manageDestination->description = 'Manage Destinations';
        $auth->add($manageDestination);

        // add "author" role and give this role the "settingMyAccount" permission
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $settingMyAccount);

        // add "admin" role and give this role the "manageParkingLot, manageDestination" permission
        // also "admin" has all permissions of "user"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $manageParkingLot);
        $auth->addChild($admin, $manageDestination);
        $auth->addChild($admin, $user);
    }
}