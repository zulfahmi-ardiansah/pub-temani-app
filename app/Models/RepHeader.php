<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepHeader extends Model
{
    use HasFactory;
    
    public function he_category_rel ()
    {
        return $this->belongsTo(AdmCategory::class, 'he_category', 'id');
    }
    
    public function he_departement_rel ()
    {
        return $this->belongsTo(AdmDepartement::class, 'he_departement', 'id');
    }

    public function he_creator_rel ()
    {
        return $this->belongsTo(AdmUser::class, 'he_creator', 'id');
    }
}
