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

        $grandTotalBalance = 0;
        $grandWithdrawable = 0;

        foreach ($users as $user) {

            $totalBalance = $user->staking_balance
                + $user->direct_balance
                + $user->level_balance
                + $user->royalty_balance;

            $finalWithdrawable = $user->withdrawable + $totalBalance;

            $grandTotalBalance += $totalBalance;
            $grandWithdrawable += $finalWithdrawable;

            $data[] = [
                $user->referal_code,
                $user->name,
                $totalBalance,
                $finalWithdrawable,
            ];
        }

        // 👇 Add Grand Total Row
        $data[] = [
            'TOTAL',
            '',
            $grandTotalBalance,
            $grandWithdrawable,
        ];

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'User ID',
            'Name',
            'Total Balance ($)',
            'Final Withdrawable ($)'
        ];
    }
}