<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthentication\MessageCategory;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Fields specific to non-payment authentication attempts.
 *
 * @phpstan-type NonPaymentShape = array<string,mixed>
 */
final class NonPayment implements BaseModel
{
    /** @use SdkModel<NonPaymentShape> */
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
