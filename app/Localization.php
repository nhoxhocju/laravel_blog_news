<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;

class Localization extends Model
{
    public $timestamps = false;

    public static $localeArray = array(
        'EN' => '2',
        'VI' => '1'
    );
}
