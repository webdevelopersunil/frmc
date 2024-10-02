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

        // 'work_centre',
        // 'department_section',

        'work_centre_id',
        'department_section_id',
        'other_section',

        'against_persons',
        'public_status',
        'complaint_status_id', 
        'preliminary_report',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'work_centre_id',
        'department_section_id',
    ];

    public static function getComplainNo(){

        $lastInsertedId =   self::latest()->first('id');

        return 'CMPL0000' . str_pad(rand(0, 99999), 4, '0', STR_PAD_LEFT) . ($lastInsertedId ? $lastInsertedId->id : '0');
    }

    public function preliminaryReport(){

        return $this->hasOne(File::class, 'id', 'preliminary_report');
    }

    public function workCenter(){

        return $this->hasOne( WorkCenter::class, 'id', 'work_centre_id');
    }

    public function complaintStatus(){

        return $this->hasOne( ComplaintStatus::class, 'id', 'complaint_status_id');
    }

    public function centerDepartment(){

        return $this->hasOne( CenterDepartment::class, 'id', 'department_section_id');
    }

    public function userAdditionalDetails(){

        return $this->hasMany(UserAdditionalDetail::class, 'complain_id', 'id')->with('file');
    }

    public function nodalAdditionalDetails(){

        return $this->hasMany(NodalAdditionalDetail::class, 'complain_id', 'id')->where('flag','document')->with('file');
    }

    public function nodalPreliminaryReports(){

        return $this->hasMany(NodalAdditionalDetail::class, 'complain_id', 'id')->where('flag','preliminary_report')->with('file');
    }


    public function updateStatus($complain,$status_id){

        $complain->complaint_status_id  =   $status_id;
        $complain->save();

    }
    
}
