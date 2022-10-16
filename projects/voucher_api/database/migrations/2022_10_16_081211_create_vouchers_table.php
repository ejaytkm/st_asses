<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * 2. Create a table inside MySQL, call `vouchers`
 * - The table consists of columns below.
 * - id
 * - voucher_code
 * - status - Values ('Available', 'Claimed', 'Expired')
 * - expiry_date
 * - created_at
 * - updated_at
 */
class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();

            $table->string("voucher_code");
            $table->string("status");
            $table->timestamp("expiry_date");

            $table->timestamps();

            $table->unique("voucher_code");
            $table->index("status");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
}
