<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Plantio extends JsonResource
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
            'mes' => $this->mes,
            'ano' => $this->ano,
            'valor_incremento' => $this->valor_incremento,
            'valor_compensacao' => $this->valor_compensacao,
            'valor_reparacao' => $this->valor_reparacao,
            'tca_firmado' => $this->tca_firmado,
            'tca_executado' => $this->tca_executado,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
