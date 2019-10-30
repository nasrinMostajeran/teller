<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
    protected $fillable = [
        'account_id_from', 'account_id_to', 'amount'
    ];

}
