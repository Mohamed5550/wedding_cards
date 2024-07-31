<?php

namespace App\Imports;

use App\Models\Invitee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InviteesImport implements ToModel, WithHeadingRow
{

    protected ?int $eventId = null;
    
    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Invitee([
            'name' => $row["name"],
            'phone' => $row["phone"],
            'status' => Invitee::PENDING,
            'event_id' => $this->eventId,
            'qr_token' => $this->eventId . '_' . $row["phone"] . '_' . uniqid()
        ]);
    }
}
