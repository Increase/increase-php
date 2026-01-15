<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ProcessingError;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Incorrect amount. Present if and only if `error_reason` is `incorrect_amount`.
 *
 * @phpstan-type IncorrectAmountShape = array{expectedAmount: int}
 */
final class IncorrectAmount implements BaseModel
{
    /** @use SdkModel<IncorrectAmountShape> */
    use SdkModel;

    /**
     * Expected amount.
     */
    #[Required('expected_amount')]
    public int $expectedAmount;

    /**
     * `new IncorrectAmount()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * IncorrectAmount::with(expectedAmount: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new IncorrectAmount)->withExpectedAmount(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(int $expectedAmount): self
    {
        $self = new self;

        $self['expectedAmount'] = $expectedAmount;

        return $self;
    }

    /**
     * Expected amount.
     */
    public function withExpectedAmount(int $expectedAmount): self
    {
        $self = clone $this;
        $self['expectedAmount'] = $expectedAmount;

        return $self;
    }
}
