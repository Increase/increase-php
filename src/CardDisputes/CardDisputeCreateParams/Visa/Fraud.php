<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDisputeCreateParams\Visa;

use Increase\CardDisputes\CardDisputeCreateParams\Visa\Fraud\FraudType;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Fraud. Required if and only if `category` is `fraud`.
 *
 * @phpstan-type FraudShape = array{fraudType: FraudType|value-of<FraudType>}
 */
final class Fraud implements BaseModel
{
    /** @use SdkModel<FraudShape> */
    use SdkModel;

    /**
     * Fraud type.
     *
     * @var value-of<FraudType> $fraudType
     */
    #[Required('fraud_type', enum: FraudType::class)]
    public string $fraudType;

    /**
     * `new Fraud()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Fraud::with(fraudType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Fraud)->withFraudType(...)
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
     * @param FraudType|value-of<FraudType> $fraudType
     */
    public static function with(FraudType|string $fraudType): self
    {
        $self = new self;

        $self['fraudType'] = $fraudType;

        return $self;
    }

    /**
     * Fraud type.
     *
     * @param FraudType|value-of<FraudType> $fraudType
     */
    public function withFraudType(FraudType|string $fraudType): self
    {
        $self = clone $this;
        $self['fraudType'] = $fraudType;

        return $self;
    }
}
