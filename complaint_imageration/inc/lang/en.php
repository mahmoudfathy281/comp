<?php

    function lang($pharse) {
        static $lang = array(
            // navbar link
            // dropdown menwo
            'Edit_Profile'    => 'Edit Profile',
            'Setting'         => 'Settings',
            'profile'         => 'profile',
            'log_out'         => 'تسجيل الخروج',
            // nav item
            'home_admin'      => 'الرئيسية',
            'categore_admin'  => 'الاقسام',
            'complaint_admin'     => 'الشكاوي',
            'Member_admin'    => 'المواطنين',
            'dashpord_admin' => 'لوحة التحكم',
            'save_admin' => 'المحفوظات',

            // member page
            'edit_member'     => 'Edit Member'
        );
        return $lang[$pharse];
    }