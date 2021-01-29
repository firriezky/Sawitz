<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
//<option value="1">Aktif</option>
//<option value="2">Suspended</option>
//<option value="3">Blokir</option>
    protected $status_text = "";
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $status = $this->status;
        switch ($status) {
            case 1:
                $this->status_text = "Active";
                break;
            case 2:
                $this->status_text = "Suspended";
                break;
            default:
                $this->status_text = "Blocked";
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'gender' => $this->gender,
            'status' => $this->status,
            'status_text' => $this->status_text,
            'email' => $this->email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
