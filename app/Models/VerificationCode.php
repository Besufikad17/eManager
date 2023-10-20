<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class VerificationCode extends Model {
    use HasFactory;

    public $table = "verification_code";

    protected $fillable = [
        'user_email',
        'code',
        'expired'
    ];
}
