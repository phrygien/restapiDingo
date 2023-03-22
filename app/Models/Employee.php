<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
class Employee extends Model
{
    use Loggable, HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'adress',
        'mobile'
    ];

    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'adress','mobile']);
        // Chain fluent methods for configuration options
    }

}
