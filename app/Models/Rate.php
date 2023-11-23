<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Rate extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    /*=============Scopes==============*/

    /*=============Accessors==============*/
    public function getCreatedAtJalaliAttribute(): string
    {
        $carbon = $this->created_at->setTimezone('Asia/Tehran');
        return Jalalian::fromCarbon($carbon)->format('Y/m/d');
    }

    /*=============Relations==============*/

    /*=============Additional functions==============*/

    /*=============Vendor functions==============*/
}
