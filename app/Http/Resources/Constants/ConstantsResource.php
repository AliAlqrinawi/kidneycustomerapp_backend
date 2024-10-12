<?php

namespace App\Http\Resources\Constants;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConstantsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->value,
            'name' => isset($this->translate(app()->getLocale())->name) ? $this->translate(app()->getLocale())->name : '',
            'created_at' => $this->created_at
        ];


        return $data;
    }
}
