<?php

declare(strict_types=1);

namespace Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * The parameters for receiving the prearbitration. Required if and only if `action` is `receive_merchant_prearbitration`.
 *
 * @phpstan-type ReceiveMerchantPrearbitrationShape = array<string,mixed>
 */
final class ReceiveMerchantPrearbitration implements BaseModel
{
    /** @use SdkModel<ReceiveMerchantPrearbitrationShape> */
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
