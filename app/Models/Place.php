<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Get trix attachments that belongs to place.
     */
    public function trixAttachments()
    {
        return $this->hasMany(TrixAttachment::class);
    }
}
