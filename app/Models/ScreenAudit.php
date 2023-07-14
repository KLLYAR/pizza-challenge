<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScreenAudit extends Model
{
    use HasFactory;

    protected $fillable = ['screenshot_path', 'deptor_id', 'admin_id'];

    public function deptor() {
        return $this->belongsTo(User::class, 'deptor_id');
    }

    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
