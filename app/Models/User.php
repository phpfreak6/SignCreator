<?php
namespace App\Models;

use App\Models\Presenters\UserPresenter;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasRoles, Notifiable, SoftDeletes, HasMediaTrait, UserPresenter;

    protected $guarded = [
        'id',
        'updated_at',
        '_token',
        '_method',
        'password_confirmation'
    ];

    protected $dates = [
        'deleted_at',
        'confirmed_at',
        'date_of_birth'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providers()
    {
        return $this->hasMany('App\Models\UserProvider');
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profile()
    {
        return $this->hasOne('App\Models\Userprofile');
    }
		public function installer(){				return $this->belongsTo('App\Models\Installer', 'installer_id', 'id');	}
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userprofile()
    {
        return $this->hasOne('App\Models\Userprofile');
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * Get the list of users related to the current User.
     *
     * @return [array] roels
     */
    public function getRolesListAttribute()
    {
        return array_map('intval', $this->roles->pluck('id')->toArray());
    }

    /**
     * Set Password and bcrypt before that.
     *
     * @param string $password
     *            Password Text
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Route notifications for the Slack channel.
     *
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @return string
     */
    public function routeNotificationForSlack($notification)
    {
        return env('SLACK_NOTIFICATION_WEBHOOK');
    }

    /**
     * Get All users list
     *
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @return [Array]
     */
    public static function getUsersName()
    {
        return self::role('user')->get()->pluck('name');
    }

    public static function getUsers()
    {
        return self::get()->toArray();
    }

    public static function getAllInstallers()
    {
        return self::role('installer')->get()->toArray();
    }

    public static function getUsersEmail()
    {
        return self::role('user')->pluck("email", "id")->toArray();
    }

    public static function getInstallersEmail()
    {
        return self::role('installer')->pluck("email", "id")->toArray();
    }
}
