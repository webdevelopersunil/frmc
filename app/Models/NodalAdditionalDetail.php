<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

class NodalAdditionalDetail extends Model implements Auditable {

    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'complain_id',
        'nodal_id',
        'description',
        'file_id',
    ];

    public function file(){

        return $this->hasOne(File::class, 'id', 'file_id');
    }
}