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
        Schema::table('banks', function (Blueprint $table) {
            Schema::create('banks', function (Blueprint $table) {
                $table->id();
                $table->string('code')->comment('Уникальный код (англ. символы)');
                $table->string('number')->comment('Номер (карта или телефон)');
                $table->string('requisites')->nullable()->comment('Реквизиты получателя');
                $table->string('sbp_bank')->nullable()->comment('Имя банка (для СБП)');
                $table->string('en_name')->nullable()->comment('Английское название');
                $table->string('ru_name')->nullable()->comment('Русское название');
                $table->boolean('is_selected')->nullable()->comment('Выбрано по умолчанию');

                $table->softDeletesTz();
                $table->timestampsTz();
            });
        });

        \App\Models\Bank::create([
            'code' => 'SBP',
            'number' => '+79090421419',
            'requisites' => 'Ольга Юрьевна',
            'sbp_bank' => 'Райффайзен',
            'en_name' => 'SBP',
            'ru_name' => 'Система быстрых платежей',
            'is_selected' => false
        ]);

        \App\Models\Bank::create([
            'code' => 'Raiffeisen Bank',
            'number' => '5379653040192518',
            'requisites' => 'Ольга Юрьевна',
            'sbp_bank' => null,
            'en_name' => 'Raiffeisen Bank',
            'ru_name' => 'Райффайзен Банк',
            'is_selected' => true
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};
