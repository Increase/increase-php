<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element;

use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If the category of this Transaction source is equal to `other`, this field will contain an empty object, otherwise it will contain null.
 *
 * @phpstan-type OtherShape = array<string,mixed>
 */
final class Other implements BaseModel
{
    /** @use SdkModel<OtherShape> */
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
