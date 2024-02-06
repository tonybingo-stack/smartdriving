<?php

namespace App\Events;

use App\Entities\PaymentResult;
use App\Enums\PaymentStatus;
use App\Models\Payment;
use Illuminate\Foundation\Events\Dispatchable;

class PaymentStatusChangedEvent
{
    use Dispatchable;

    /**
     * PaymentStatusChangedEvent constructor method.
     *
     * @param Payment $payment
     * @param PaymentStatus $oldStatus
     * @param PaymentStatus $newStatus
     * @param PaymentResult $result
     */
    public function __construct(
        public readonly Payment $payment,
        public readonly PaymentStatus $oldStatus,
        public readonly PaymentStatus $newStatus,
        public readonly PaymentResult $result
    ) {
    }
}
