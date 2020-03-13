<?php

namespace App\Http\Resources;

use App\Website;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class WebsiteResource
 * @package App\Http\Resources
 * @mixin Website
 */
class WebsiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'url' => $this->url,
            'created_at' => $this->created_at
        ];
    }
}
