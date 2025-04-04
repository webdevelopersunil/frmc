<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NodalHistoryComplaint extends Model {
    
    use HasFactory;

    protected $table = 'nodal_history_complaints';

    protected $fillable = [
        'nodal_history_id',
        'complaint_id',
    ];

    /**
     * Get the nodal history that owns this record.
     */
    public function nodalHistory(): BelongsTo
    {
        return $this->belongsTo(NodalHistory::class, 'nodal_history_id');
    }

    /**
     * Get the complaint related to this nodal history.
     */
    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class, 'complaint_id');
    }

}
