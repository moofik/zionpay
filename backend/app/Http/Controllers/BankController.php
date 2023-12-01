<?php

namespace App\Http\Controllers;

use App\Dto\RegistrationDto;
use App\Http\Requests\AnonymousPayRequest;
use App\Http\Requests\PayAndRegisterRequest;
use App\Http\Requests\PayRequest;
use App\Models\AnonymousPayment;
use App\Models\Bank;
use App\Models\Payment;
use App\Service\AnonymousPaymentMessage;
use App\Service\MoneyConverter;
use App\Service\PaymentMessage;
use App\Service\TelegramService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class BankController extends Controller
{
    public function index(Request $request)
    {
        return Bank::all();
    }
}
