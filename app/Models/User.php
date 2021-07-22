<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MailResetPasswordNotification;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;

class User extends Authenticatable implements MustVerifyEmail
{
    protected $table = 'nppbkc_users';
    use HasFactory, Notifiable, SoftDeletes, LogsActivity;
    
    protected static $logAttributes = [
        'name',
        'email',
        'password',
        'role'
    ];
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;
    protected static $logName = 'user';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "User has been {$eventName}";
    }
    
    protected $with = ['profile'];
 
    public function profile()
    {
      return $this->morphTo();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getHasProfileAttribute()
    {
      return $this->profile_id !== null;
    }
    public function getHasAdminProfileAttribute()
    {
      return $this->profile_type == 'AdminProfile';
    }
    public function getHasUserProfileAttribute()
    {
      return $this->profile_type == 'UserProfile';
    }
    public function getHasOfficerProfileAttribute()
    {
      return $this->profile_type == 'OfficerProfile';
    }
    public function files()
    {
        return $this->hasMany(UserFile::class);
    }
    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new MailResetPasswordNotification($token));
    // }
}
