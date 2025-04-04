<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NodalHistory extends Model {

    use HasFactory;

    protected $table = 'nodal_history';

    protected $fillable = [
        'old_nodal_id',
        'new_nodal_id',
        'level',
        'action_type'
        // Add any other fields like timestamps if applicable
    ];

    /**
     * Get all complaints linked to this nodal history.
     */
    public function complaints(): HasMany
    {
        return $this->hasMany(NodalHistoryComplaint::class, 'nodal_history_id');
    }

    /**
     * Optional: get old nodal officer
     */
    public function oldNodal()
    {
        return $this->belongsTo(User::class, 'old_nodal_id');
    }

    /**
     * Optional: get new nodal officer
     */
    public function newNodal()
    {
        return $this->belongsTo(User::class, 'new_nodal_id');
    }
}
