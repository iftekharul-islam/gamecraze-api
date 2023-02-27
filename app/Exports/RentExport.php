<?php

namespace App\Exports;

use App\Models\Rent;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RentExport implements FromCollection, WithHeadings, WithColumnWidths
{
    use Exportable;
    protected $disk_type, $status;

    public function __construct($disk_type, $status)
    {
        $this->disk_type = $disk_type;
        $this->status = $status;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Rent::query();

        $rents = $this->dataQuery($data);
        $rentCollection = new Collection();

        foreach ($rents as $rent) {
            $rentCollection->push((object)[
                'name' => $rent->user->name.' '.$rent->user->last_name,
                'phone_number' => $rent->user->phone_number ?? 'N/A',
                'email' => $rent->user->email ?? 'N/A',
                'game_name' => $rent->game->name,
                'disk_type' => $rent->disk_type == 1 ? 'Physical disk' : 'Digital disk'
            ]);
        }
        return $rentCollection;
    }

    public function dataQuery($data)
    {
        if ($this->disk_type == 1) {
            $data->where('disk_type', $this->disk_type);
        }
        if ($this->disk_type != 1 && $this->disk_type != null) {
            $data->where('disk_type', 0);
        }
        if ($this->status == 1) {
            $data->where('status', $this->status);
        }
        if ($this->status != 1 && $this->status != null) {
            $data->where('status', 0);
        }
        return $data->with('game', 'user')->orderBy('created_at', 'DESC')->get();
    }
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Customer Name',
            'Phone Number',
            'Email',
            'Games Name',
            'Disk Type'
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 20,
            'C' => 25,
            'D' => 25,
            'E' => 15,
        ];
    }
}
