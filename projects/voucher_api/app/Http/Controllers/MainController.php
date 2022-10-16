<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class MainController extends Controller
{
    /**
     * Generated 3Million Vouchers 
     *
     * @param noPlayers
     * @return []string{} // returns an arrayo fstrings
     */
    public function simulate(Request $request)
    {
        try {
            dd("hello")
        } catch (\Throwable $th) {
            return response()->json([
                "message" => $th->getMessage(),
                "code" => $th->getCode()
            ], 500);
        }
    }
}