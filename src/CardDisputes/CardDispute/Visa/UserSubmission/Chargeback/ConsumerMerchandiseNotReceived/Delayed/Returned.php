<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotReceived\Delayed;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Returned. Present if and only if `return_outcome` is `returned`.
 *
 * @phpstan-type ReturnedShape = array{
 *   merchantReceivedReturnAt: string, returnedAt: string
 * }
 */
final class Returned implements BaseModel
{
    /** @use SdkModel<ReturnedShape> */
    use SdkModel;

    /**
     * Merchant received return at.
     */
    #[Required('merchant_received_return_at')]
    public string $merchantReceivedReturnAt;

    /**
     * Returned at.
     */
    #[Required('returned_at')]
    public string $returnedAt;

    /**
     * `new Returned()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Returned::with(merchantReceivedReturnAt: ..., returnedAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Returned)->withMerchantReceivedReturnAt(...)->withReturnedAt(...)
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
    public static function with(
        string $merchantReceivedReturnAt,
        string $returnedAt
    ): self {
        $self = new self;

        $self['merchantReceivedReturnAt'] = $merchantReceivedReturnAt;
        $self['returnedAt'] = $returnedAt;

        return $self;
    }

    /**
     * Merchant received return at.
     */
    public function withMerchantReceivedReturnAt(
        string $merchantReceivedReturnAt
    ): self {
        $self = clone $this;
        $self['merchantReceivedReturnAt'] = $merchantReceivedReturnAt;

        return $self;
    }

    /**
     * Returned at.
     */
    public function withReturnedAt(string $returnedAt): self
    {
        $self = clone $this;
        $self['returnedAt'] = $returnedAt;

        return $self;
    }
}
