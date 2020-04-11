<?php

    function arlang($pharse) {
        static $lang = array(
            'message' => 'مرحبا',
            'name' => 'محمود ',
            'last' => 'فتحى'
        );
        return $lang[$pharse];
    }