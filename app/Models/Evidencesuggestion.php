<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Completion\Suggestion;

class Evidencesuggestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'imgEvidence',
        'suggestion_id'
    ];

    public function seggestion()
    {

        return $this->belongsTo(Suggestion::class);
    }
}
