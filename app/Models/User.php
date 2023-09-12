<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Constants\UploadPathConstant;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nisn',
        'nip',
        'password_encrypted',
        'username',
        'email',
        'phone',
        'gender',
        'pob',
        'dob',
        'photo',
        'class_id',
        'balance',
        'father_name',
        'mother_name',
        'parent_phone',
        'is_active',
        'is_student',
        'is_alumni',
        'passed_year',
        'last_login'
    ];

    protected $appends = [
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Hash the password on save/update.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function setPasswordEncryptedAttribute($value)
    {
        $this->attributes['password_encrypted'] = encryptData($value);
    }

    /**
     * Get the class that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function getPhotoAttribute()
    {
        return $this->attributes['photo'] ? fileUrl(UploadPathConstant::USER_PHOTOS, $this->attributes['photo']) : null;
    }

    public function getRoleAttribute()
    {
        $role = $this->roles;
        return count($role) > 0 ? $role[0]->id : NULL;
    }

    public function scopeIsNotStudent($query)
    {
        return $query->where('is_student', 0);
    }

    public function scopeIsStudent($query)
    {
        return $query->where('is_student', 1);
    }
}
