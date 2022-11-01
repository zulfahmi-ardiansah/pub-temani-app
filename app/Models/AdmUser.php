<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdmUser extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public function us_departement_rel ()
    {
        return $this->belongsTo(AdmDepartement::class, 'us_departement', 'id');
    }
}
