<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements Auditable {
    
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'cpfNo',
        'address',
        'phone',
        'dob',
        'house_number',
        'area',
        'status',
        'landmark',
        'city',
        'state',
        'pincode',
        'phone_verified',
        'email_verified',
        'phone_otp',
        'email_otp'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',

        'phone_verified',
        'email_verified',
        'phone_otp',
        'email_otp'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

     /**
     * Get the current role of a user by user ID.
     *
     * @param  int  $userId
     * @return string|null
     */
    public static function getCurrentRole($userId)
    {
        $user = self::find($userId);

        if ($user) {
            $roles = $user->getRoleNames(); // This returns a collection of role names

            return $roles->isNotEmpty() ? $roles->first() : null; // Return the first role if exists
        }

        return null; // Return null if user not found or no roles assigned
    }

    public static function getUserRoleCount(string $roleName): ?string
    {
        return  User::role(trim($roleName))->count();
    }

    public function workCenter()
    {
        return $this->hasOne(WorkCenter::class, 'nodal_officer_id');
    }

}
