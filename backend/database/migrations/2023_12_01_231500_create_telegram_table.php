<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('telegram_accounts', function (Blueprint $table) {
            Schema::create('telegram_accounts', function (Blueprint $table) {
                $table->id();
                $table->string('telegram_id')->comment('Идентификатор телеграм');

                $table->softDeletesTz();
                $table->timestampsTz();
            });
        });

        \App\Models\TelegramAccount::create([
            'telegram_id' => '131231613',
        ]);
        \App\Models\TelegramAccount::create([
            'telegram_id' => '463609933',
        ]);
        \App\Models\TelegramAccount::create([
            'telegram_id' => '6138432791',
        ]);
        \App\Models\TelegramAccount::create([
            'telegram_id' => '1730393847',
        ]);
        \App\Models\TelegramAccount::create([
            'telegram_id' => '985617299',
        ]);
        \App\Models\TelegramAccount::create([
            'telegram_id' => '1874631483',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('telegram_accounts');
    }
};
