<?php

namespace App\Exports;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomersExport implements FromCollection, WithHeadings, WithColumnWidths
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = User::query();

        $users = $this->dataQuery($data);
        $userCollection = new Collection();

        foreach ($users as $user) {
            $userCollection->push((object)[
                'name' => $user->name.' '.$user->last_name,
                'phone_number' => $user->phone_number ?? 'N/A',
                'email' => $user->email ?? 'N/A',
                'id_status' => $user->status == 1 ? 'Verified' : 'Not Verified',
                'user_type' => $user->user_type == 1 ? 'Elite' : 'Rookie',
                'address' => isset($user->address) ? $user->address->address . ',' . $user->address->city . ',' . $user->address->post_code : 'N/A',
                'nid' => $user->identification_number ?? '',
                'referral_code' => $user->referral_code ?? '',
                'referred_by' => $user->referred_by ?? '',
                'created_at' => isset($user->created_at) ? Carbon::parse($user->created_at)->format('d-m-Y') : 'N/A'
            ]);
        }

        logger($userCollection);
        return $userCollection;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function dataQuery($data)
    {
        return $data->with('address')
            ->whereHas('roles', function ($query) {
                $query->where('name', '!=', 'admin');
            })->get();
    }
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name',
            'Phone Number',
            'Email',
            'User Status',
            'User type',
            'Address',
            'NID No',
            'Referred Code',
            'Reference By',
            'join date'
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
            'D' => 10,
            'E' => 10,
            'F' => 30,
            'G' => 20,
            'H' => 15,
            'I' => 15,
            'J' => 15,
        ];
    }


}
