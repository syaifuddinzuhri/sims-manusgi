<?php

namespace App\Models;

use App\Constants\UploadPathConstant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_name',
        'app_logo',
        'app_footer',
        'school_name',
        'phone',
        'email',
        'website',
        'address',
        'is_maintenance'
    ];

    public function getAppLogoAttribute()
    {
        return $this->attributes['app_logo'] ? fileUrl(UploadPathConstant::APP_LOGO, $this->attributes['app_logo']) : null;
    }
}
