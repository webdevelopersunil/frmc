<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

use OwenIt\Auditing\Contracts\Auditable;

class File extends Model implements Auditable{

    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'directory',
        'mime',
        'size',
        'role',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($file) {

            $user = Auth::user();
            $userCurrentRoles = $user->getRoleNames(); // Returns a collection
            $roles = Role::all()->pluck('name')->toArray(); // Convert collection to array of role names

            foreach ($userCurrentRoles as $role) {
                if (in_array($role, $roles)) {
                    $file->role = $role;
                }
            }
        });
    }


    public static function upload($file,$path){
        
        $fileName   =   time(). '.'. $file->extension();
        
        $file->storeAs($path,$fileName);

        $savedFile   =   self::create([
            'name'      =>  $fileName,
            'mime'      =>  $file->extension(),
            'directory' =>  $path,
        ]);

        return $savedFile;
    }

    public function preliminary_report()
    {
        return $this->belongsTo(Complain::class, 'preliminary_report', 'id');
    }

}
