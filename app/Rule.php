<?php

namespace App;

use Jenssegers\Mongodb\Model as Model;

class Rule extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'redirect_rules';
    protected $primaryKey = 'short_url';
    protected $fillable = [
            'long_url', 'short_url'
        ];
}
