<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'about_us',
        'why_us',
        'goal',
        'vision',
        'about_footer',
        'ads_text',
        'activities_text',
        'person_text',
        'contact_us_text',
        'terms_text',
        'activite_terms',
        'counter1_name',
        'counter1_count',
    ];
}
