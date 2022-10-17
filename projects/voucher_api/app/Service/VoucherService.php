<?php

namespace App\Service;

use App\Jobs\ProcessVoucher;
use App\Models\Voucher;
use App\Utils\Utility;
use Error;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Bus;

class VoucherService
{
    /**
     * 3. Create A function (Not Seeder) to generate 3,000,000 (3 Millions) records of voucher codes in less than 10 minutes. Store all all it in database.
     *
     * @return @var \Illuminate\Bus\Batch
     */
    public function generateVoucher()
    {
        $batch  = Bus::batch([])->dispatch();
        $count_voucher = 3000000; // 3000000 ~ to change
        $per_batch_size = 10000; // 10000 ~ to change

        // #STEP1: LOOP & GENERATE UNIQUE VOUCHERS
        $voucherCodes = [];
        while (count($voucherCodes) < $count_voucher) {
            $s = Utility::generateCodeString();
            $voucherCodes[$s] = null;
        }

        // # STEP2: Add process of saving into database into batch - for now we will batch one by one
        $chuck = [];
        $current_count = 1;
        foreach ($voucherCodes as $key => $value) {
            array_push($chuck, $key);

            if ($current_count == $per_batch_size) { // end of data to chucnk ~ add to batch,
                $batch->add(new ProcessVoucher($chuck));
                $chuck = [];
                $current_count = 0;
            }

            $current_count++;
        }

        return $batch;
    }

    /**
     * 5. An API to return One (1), Available, Unclaimed, Voucher code.
     *
     * @return @var voucher_obj [object]
     */
    public function getVoucher()
    {
        $data =  Voucher::where("status", "Available")
            ->limit(200)
            ->get();

        if (!$data->count()) {
            throw new Error("No vouchers available. Please use the POST generate function first before proceeding.");
        }

        $random = rand(1,200);
        return $data[$random];
    }

    /**
     * 6. An API to Claim the voucher with the voucher code
     * Mark the record to "Claimed" if the voucher hasn't expired.
     * @return @var voucher_obj [object]
     */
    public function claimVoucher($code)
    {
        $data =  Voucher::where("voucher_code", $code)->first();
        if (!$data) {
            throw new Error("Unable to find voucher code in system.");
        }

        if ($data->status === "Claimed") {
            throw new Error("Sorry, voucher - {$code} has already been claimed.");
        }

        $data->status = "Claimed";
        $data->save();
        return $data;
    }



    /**
     * 5. An API to return One (1), Available, Unclaimed, Voucher code.
     *
     * @return @var voucher_obj [object]
     */
    public function getVoucherStats()
    {
        $v_available = Voucher::where("status", "Available")->count();
        $v_claimed = Voucher::where("status", "Claimed")->count();
        $v_expired = Voucher::where("status", "Expired")->count();

        $current_ts = Carbon::now()->timestamp;

        $expiry_ts_6H = $current_ts + (3600  * 6);   // 6HOURS
        $expiry_ts_12H = $current_ts + (3600  * 12); // 12HOURS
        $expiry_ts_24H = $current_ts + (3600  * 24); // 24HOURS


        $v_expire_6H = Voucher::whereBetween('expiry_date', [
            Carbon::createFromTimestamp($current_ts),
            Carbon::createFromTimestamp($expiry_ts_6H),
        ])->count();

        $v_expire_12H = Voucher::whereBetween('expiry_date', [
            Carbon::createFromTimestamp($current_ts),
            Carbon::createFromTimestamp($expiry_ts_12H),
        ])->count();

        $v_expire_24H = Voucher::whereBetween('expiry_date', [
            Carbon::createFromTimestamp($current_ts),
            Carbon::createFromTimestamp($expiry_ts_24H),
        ])->count();


        return [
            "available" => $v_available,
            "claimed" => $v_claimed,
            "expired" => $v_expired,

            "no_expire_6H" => $v_expire_6H,
            "no_expire_12H" => $v_expire_12H,
            "no_expire_24H" => $v_expire_24H,
        ];
    }
}