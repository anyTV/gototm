<?php

namespace App;

use Jenssegers\Mongodb\Model as Model;

class Visit extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'redirect_visits';
    protected $fillable = [
            'ip_address', 'referrer', 'browser',
            'platform', 'country', 'browser_version'
        ];

}
