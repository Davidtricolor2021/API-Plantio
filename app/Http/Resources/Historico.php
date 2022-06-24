<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Historico extends JsonResource
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
            'plantio_id' => $this->plantio_id,
            'users_id' => $this->users_id,
            'acao' => $this->acao,
            'data_acao' =>$this->data_acao,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
