<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'site_name' => $this->site_name,
            'about_us' => $this->about_us,
            'why_us' => $this->why_us,
            'goal' => $this->goal,
            'vision' => $this->vision,
            'about_footer' => $this->about_footer,
            'ads_text' => $this->ads_text,
            'activities_text' => $this->activities_text,
            'person_text' => $this->person_text,
            'contact_us_text' => $this->contact_us_text,
            'terms_text' => $this->terms_text,
            'activite_terms' => $this->activite_terms,
        ];
    }
}
