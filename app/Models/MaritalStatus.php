<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaritalStatus extends Model
{
    use HasFactory;

    public $guarded = ['*'];

    public function personalInformation(): HasMany
    {
        return $this->hasMany(PersonalInformation::class);
    }
}
