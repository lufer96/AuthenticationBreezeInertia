<?php

namespace App\Http\Task\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'uuid_key' => $this->uuid_key,
            'name' => $this->name,
            'description' => $this->description,
            'status' => (bool) $this->status,
        ];
    }
}
