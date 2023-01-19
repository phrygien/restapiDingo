<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class Employee extends Model
{
    use Loggable, HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'adress',
        'mobile'
    ];
}
