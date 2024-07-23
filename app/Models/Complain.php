<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model implements Auditable{

    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'complains';

    protected $fillable = [
        'complain_no',
        'complainant_id',
        'description',
        'work_centre',
        'department_section',
        'against_persons',
        'public_status',
        'complaint_status',
        'preliminary_report',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'against_persons',
        // 'work_centre',
        // 'department_section',
    ];

    public static function getComplainNo(){

        $lastInsertedId =   self::latest()->first('id');

        return 'CMPL0000' . str_pad(rand(0, 99999), 4, '0', STR_PAD_LEFT) . ($lastInsertedId ? $lastInsertedId->id : '0');
    }

    public function preliminaryReport(){

        return $this->hasOne(File::class, 'id', 'preliminary_report');
    }

    public function userAdditionalDetails(){

        return $this->hasMany(UserAdditionalDetail::class, 'complain_id', 'id')->with('file');
    }

    public function nodalAdditionalDetails(){

        return $this->hasMany(NodalAdditionalDetail::class, 'complain_id', 'id')->with('file');
    }

}
