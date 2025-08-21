<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MidtransWebhookController extends Controller {
    public function __invoke(Request $request, PaymentService $paymentService): Response {
        $paymentService->handleMidtransNotification();

        return response()->noContent();
    }
}
