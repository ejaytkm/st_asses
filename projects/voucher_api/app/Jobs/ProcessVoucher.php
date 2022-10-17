<?php

namespace App\Jobs;

use App\Models\Voucher;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessVoucher implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data   = $data; // voucher chunk
    }

    /**
     * Main job: Store voucher codes created into a database via data in chucnks
     *
     * a. For the Expiry Date column, generate random expiry date between previous and next 3 days
     * b. Mark the status column to "Expired" if the expiry date is past.
     * @return void
     */
    public function handle()
    {
        $mass_insert = [];
        foreach ($this->data as $voucherCode) {
            $status = "";
            $current_ts = Carbon::now()->timestamp;
            $expiry_range_ts = 86400 * 3; // 1day * 3

            $min_range_ts = $current_ts - $expiry_range_ts;
            $max_range_ts = $current_ts + $expiry_range_ts;

            $random_expiry_date = mt_rand($min_range_ts, $max_range_ts);
            $status = $random_expiry_date > $current_ts ? "Available" : "Expired";

            // TODO: Check for any duplications that is not status = 'Expired'
            $data_entry = [
                "voucher_code" => $voucherCode,
                "status" => $status,
                "expiry_date" => Carbon::createFromTimestamp($random_expiry_date),
            ];
            // Voucher::create($data_entry); // Save voucher into database
            array_push($mass_insert, $data_entry);
        }

        Voucher::insert($mass_insert); // Save voucher into database
    }
}
