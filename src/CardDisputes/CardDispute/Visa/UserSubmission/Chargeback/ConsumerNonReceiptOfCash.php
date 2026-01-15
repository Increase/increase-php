<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Non-receipt of cash. Present if and only if `category` is `consumer_non_receipt_of_cash`.
 *
 * @phpstan-type ConsumerNonReceiptOfCashShape = array<string,mixed>
 */
final class ConsumerNonReceiptOfCash implements BaseModel
{
    /** @use SdkModel<ConsumerNonReceiptOfCashShape> */
    use SdkModel;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(): self
    {
        return new self;
    }
}
