<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class GigResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'timestamp_start' => Carbon::createFromFormat('Y-m-d H:i:s', $this->timestamp_start)->format('m/d/Y h:i A'),
            'timestamp_end' => Carbon::createFromFormat('Y-m-d H:i:s', $this->timestamp_end)->format('m/d/Y h:i A'),
            'number_of_positions' => $this->number_of_positions,
            'pay_per_hour' => $this->pay_per_hour,
            'status'=> $this->status->label(),
            'company' => [
                'id'=> $this->company->id,
                'name' => $this->company->name
            ],

        ];
    }
}
