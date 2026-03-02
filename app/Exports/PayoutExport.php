<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PayoutExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $users = User::all();

        $data = [];

        foreach ($users as $user) {

            $totalBalance = $user->staking_balance
                + $user->direct_balance
                + $user->level_balance
                + $user->royalty_balance;

            $data[] = [
                'User ID' => $user->referal_code,
                'Name' => $user->name,
                'Total Payout ($)' => $totalBalance,
                'Final Withdrawable ($)' => $user->withdrawable + $totalBalance,
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'User ID',
            'Name',
            'Total Payout ($)',
            'Final Withdrawable ($)'
        ];
    }
}