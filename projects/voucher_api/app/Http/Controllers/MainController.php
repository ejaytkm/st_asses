<?php

namespace App\Http\Controllers;

use App\Service\VoucherService;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Generated 3Million Vouchers
     *
     * @param count int
     * @param bench bool
     * @return bool
     */
    public function generate(Request $request)
    {
        try {
            $voucherS = new VoucherService();
            $data = $voucherS->generateVoucher($request->count);

            return response()->json([
                "data" => $data,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage(),
                "code" => $th->getCode(),
            ], 500);
        }
    }
}