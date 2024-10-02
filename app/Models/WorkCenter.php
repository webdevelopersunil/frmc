<?php

namespace App\Models;

use App\Models\CenterDepartment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class WorkCenter extends Model implements AuditableContract
{
    use HasFactory, SoftDeletes, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nodal_officer_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    public function departments()
    {
        return $this->hasMany(CenterDepartment::class, 'work_center_id');
    }

    /**
     * Define a relationship to the User model using nodal_officer_id
     */
    public function nodalOfficer()
    {
        return $this->belongsTo(User::class, 'nodal_officer_id');
    }

}
