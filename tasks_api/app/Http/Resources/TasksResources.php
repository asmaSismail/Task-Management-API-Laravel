<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TasksResources extends JsonResource
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
            'id' => (string) $this->id,
            'attributes' => [
                'titre' => $this->titre,
                'description' => $this->description,
                'date_Echeance' => $this->date_Echeance, 
                'statut' => $this->statut,
                'created_at' => $this->created_at, 
                'updated_at' => $this->updated_at,
                'deleted_at' => $this->deleted_at,
            ],
            'relationships' => [
                'user' => [
                    'id' => (string) $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                ],
            ],
        ];
    }
}
