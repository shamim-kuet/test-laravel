<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PartnerResource extends JsonResource
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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'legal_name' => $this->legal_name,
            'address' => $this->address,
            'c_p_name' => $this->c_p_name,
            'c_p_phone' => $this->c_p_phone,
            'c_p_email' => $this->c_p_email,
            'hash_key' => $this->hash_key,
            'subscription_type' => $this->subscription_type,
            'subscription_expiry' => $this->subscription_expiry
        ];
    }
}
