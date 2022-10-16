<?php

namespace App\Service;

use App\Models\Voucher;

function generateCodeString() {
    // - Max length = 6
    // - For eg: x9aLd3, 0LPxYi, aXd91S, pLax78, 091XsD
    // - The voucher code must be Unique, Case Sensitive, Alpha-Numeric. (No Symbol allowed)
    // - The voucher code must be scrambled, non-sequence, and public users not able to guess the code patterns easily.
    return substr(bin2hex(random_bytes(4)), 0, 6);
}

class VoucherService
{
    // 3. Create A function (Not Seeder) to generate 3,000,000 (3 Millions) records of voucher codes in less than 10 minutes. Store all all it in database.
    public function generateVoucher($count)
    {
        $start = microtime(true);
        $voucherCodes = [];

        // #STEP1: LOOP & GENERATE UNIQUE VOUCHERS
        while (count($voucherCodes) < $count) {
            $s = generateCodeString();
            $voucherCodes[$s] = null;
        }

        // #STEP2: Store values into database
        // - For the Expiry Date column, generate random expiry date between previous and next 3 days, Mark the status column to "Expired" if the expiry date is past.
        foreach ($voucherCodes as $key => $value) {
            $v = $key;

            $voucher = Voucher::create([
                'title' => 'Traveling to Europe'
            ]);
        }

        $end = microtime(true);
        $diff = $end - $start;

        return [
            "count" => $count,
            "total" => "Proccess took {$diff} seconds"
        ];
    }
}