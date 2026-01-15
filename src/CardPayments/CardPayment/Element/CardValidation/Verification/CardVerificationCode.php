<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardValidation\Verification;

use Increase\CardPayments\CardPayment\Element\CardValidation\Verification\CardVerificationCode\Result;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Fields related to verification of the Card Verification Code, a 3-digit code on the back of the card.
 *
 * @phpstan-type CardVerificationCodeShape = array{result: Result|value-of<Result>}
 */
final class CardVerificationCode implements BaseModel
{
    /** @use SdkModel<CardVerificationCodeShape> */
    use SdkModel;

    /**
     * The result of verifying the Card Verification Code.
     *
     * @var value-of<Result> $result
     */
    #[Required(enum: Result::class)]
    public string $result;

    /**
     * `new CardVerificationCode()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardVerificationCode::with(result: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardVerificationCode)->withResult(...)
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
     *
     * @param Result|value-of<Result> $result
     */
    public static function with(Result|string $result): self
    {
        $self = new self;

        $self['result'] = $result;

        return $self;
    }

    /**
     * The result of verifying the Card Verification Code.
     *
     * @param Result|value-of<Result> $result
     */
    public function withResult(Result|string $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }
}
