<?php

namespace App\Exports;

use App\Models\TransactionHistory;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings, WithColumnWidths
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = User::query();

        $sellers = $this->dataQuery($data);
        $sellerCollection = new Collection();

        foreach ($sellers as $seller) {
            $sellerCollection->push((object)[
                'name' => $seller['name'] . ' ' . $seller['last_name'],
                'Original Amount' => $seller['seller_amount'] + $seller['discount_amount'] + $seller['commission'],
                'Seller Amount' => $seller['seller_amount'] + $seller['discount_amount'] + $seller['commission'] - $seller['original_commission'],
                'Discount Amount' => $seller['discount_amount'],
                'Original Commission' => $seller['original_commission'],
                'Paid' => $seller['seller_amount'] + $seller['discount_amount'] + $seller['commission'] - $seller['original_commission'] - $seller['due'],
                'Due' => $seller['due']
            ]);
        }
        return $sellerCollection;
    }

    public function dataQuery($data)
    {
        $value = $data->join('lenders', 'users.id', '=', 'lenders.renter_id')
            ->selectRaw('SUM(discount_amount) as discount_amount, 
                            SUM(commission) as commission,
                            SUM(original_commission) as original_commission,
                            SUM(lend_cost) as seller_amount,
                            renter_id, users.name, users.last_name, users.id')
            ->groupBy('lenders.renter_id')
            ->where('lenders.status', 1)
            ->where('lenders.deleted_at', null)
            ->get();

        $paid_amount = TransactionHistory::selectRaw('SUM(amount) as paid_amount, user_id as id')->groupBy('user_id')->get();

        $data = $value->map(function ($row) use ($paid_amount) {
            $paid = $paid_amount->where('id', $row->id)->pluck('paid_amount')->first();
            return collect($row)->put('due', $row->seller_amount + $row->discount_amount + $row->commission - $row->original_commission  - $paid );
        });

        return $data;
    }
    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name',
            'Original Amount',
            'Seller Amount',
            'Discount Amount',
            'Original Commission',
            'Paid',
            'Due'
        ];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 20,
            'B' => 15,
            'C' => 15,
            'D' => 15,
            'E' => 17,
            'F' => 8,
            'G' => 8,
        ];
    }
}
