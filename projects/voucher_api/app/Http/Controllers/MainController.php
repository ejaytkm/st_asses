<?php

namespace App\Http\Controllers;

use App\Service\VoucherService;
use Carbon\Carbon;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class MainController extends Controller
{
    /**
     * Generated 3,000,000 Vouchers
     *
     * @param count int
     * @param bench bool
     *
     * @return bool
     */
    public function generate(Request $request)
    {
        try {
            $voucherS = new VoucherService();
            $data = $voucherS->generateVoucher();
            return $data;
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage(),
                "code" => $th->getCode(),
            ], 500);
        }
    }

    /**
     * Get batch voucher generation status based on {id}
     *
     * @param id string
     *
     * @return
     */
    public function batchStatus(Request $request)
    {
        try {
            if (!$request->id) {
                throw new Error("Please a valid enter code in parameters.");
            }

            $batchId = $request->id;
            $data = Bus::findBatch($batchId);

            if (!$data) {
                throw new Error("Cannot find batch with supplied id. Please check again");
            }

            $cA = new Carbon($data->createdAt);
            $time_taken = $cA->diffInSeconds(new Carbon($data->finishedAt));

            return [
                "id" => $data->id,
                "time_taken" => $time_taken . " seconds.",
                "status" => $data->progress() . "%",

                "totalJobs" => $data->totalJobs,
                "pendingJobs" => $data->pendingJobs,
                "processedJobs" => $data->processedJobs(),
                "failedJobs" => $data->failedJobs,
                "createdAt" => $data->createdAt,
                "cancelledAt" => $data->cancelledAt,
                "finishedAt" => $data->finishedAt,
            ];
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage(),
                "code" => $th->getCode(),
            ], 500);
        }
    }

    /**
     * Get Available Unclaimed Voucher
     *
     * @return
     */
    public function getVoucher(Request $request)
    {
        try {
            $voucherS = new VoucherService();
            $voucher = $voucherS->getVoucher($request->code);

            return $voucher;
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage(),
                "code" => $th->getCode(),
            ], 500);
        }
    }

    /**
     * Claim one available voicher.
     * Throws Error - return if voucher has been claimed.
     * @param code string
     * @return
     */
    public function claimVoucher(Request $request)
    {
        try {
            if (!$request->code) {
                throw new Error("Please enter a valid code in parameters.");
            }

            $voucherS = new VoucherService();
            $voucher = $voucherS->claimVoucher($request->code);

            return $voucher;
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage(),
                "code" => $th->getCode(),
            ], 500);
        }
    }

    /**
     * Returns the voucher statistics of voucher db
     * - Numbers of Available, Claimed and Expired
     * - Numbers of Expiring in 6, 12, 24 hours.
     * @param code string
     * @return VoucherStatObject [object]
     */
    public function getVoucherStats(Request $request)
    {
        try {
            $voucherS = new VoucherService();
            $stats = $voucherS->getVoucherStats($request->code);

            return $stats;
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage(),
                "code" => $th->getCode(),
            ], 500);
        }
    }
}