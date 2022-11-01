<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdmDepartement extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function de_category_rel ()
    {
        return $this->belongsTo(AdmCategory::class, 'de_category', 'id');
    }
}
