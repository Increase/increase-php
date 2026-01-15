<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotAsDescribed\MerchantResolutionAttempted;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotAsDescribed\ReturnAttempted;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotAsDescribed\Returned;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotAsDescribed\ReturnOutcome;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Merchandise not as described. Present if and only if `category` is `consumer_merchandise_not_as_described`.
 *
 * @phpstan-import-type ReturnAttemptedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotAsDescribed\ReturnAttempted
 * @phpstan-import-type ReturnedShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerMerchandiseNotAsDescribed\Returned
 *
 * @phpstan-type ConsumerMerchandiseNotAsDescribedShape = array{
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   receivedAt: string,
 *   returnAttempted: null|ReturnAttempted|ReturnAttemptedShape,
 *   returnOutcome: ReturnOutcome|value-of<ReturnOutcome>,
 *   returned: null|Returned|ReturnedShape,
 * }
 */
final class ConsumerMerchandiseNotAsDescribed implements BaseModel
{
    /** @use SdkModel<ConsumerMerchandiseNotAsDescribedShape> */
    use SdkModel;

    /**
     * Merchant resolution attempted.
     *
     * @var value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     */
    #[Required(
        'merchant_resolution_attempted',
        enum: MerchantResolutionAttempted::class
    )]
    public string $merchantResolutionAttempted;

    /**
     * Received at.
     */
    #[Required('received_at')]
    public string $receivedAt;

    /**
     * Return attempted. Present if and only if `return_outcome` is `return_attempted`.
     */
    #[Required('return_attempted')]
    public ?ReturnAttempted $returnAttempted;

    /**
     * Return outcome.
     *
     * @var value-of<ReturnOutcome> $returnOutcome
     */
    #[Required('return_outcome', enum: ReturnOutcome::class)]
    public string $returnOutcome;

    /**
     * Returned. Present if and only if `return_outcome` is `returned`.
     */
    #[Required]
    public ?Returned $returned;

    /**
     * `new ConsumerMerchandiseNotAsDescribed()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerMerchandiseNotAsDescribed::with(
     *   merchantResolutionAttempted: ...,
     *   receivedAt: ...,
     *   returnAttempted: ...,
     *   returnOutcome: ...,
     *   returned: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerMerchandiseNotAsDescribed)
     *   ->withMerchantResolutionAttempted(...)
     *   ->withReceivedAt(...)
     *   ->withReturnAttempted(...)
     *   ->withReturnOutcome(...)
     *   ->withReturned(...)
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
     * @param MerchantResolutionAttempted|value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     * @param ReturnAttempted|ReturnAttemptedShape|null $returnAttempted
     * @param ReturnOutcome|value-of<ReturnOutcome> $returnOutcome
     * @param Returned|ReturnedShape|null $returned
     */
    public static function with(
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        string $receivedAt,
        ReturnAttempted|array|null $returnAttempted,
        ReturnOutcome|string $returnOutcome,
        Returned|array|null $returned,
    ): self {
        $self = new self;

        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;
        $self['receivedAt'] = $receivedAt;
        $self['returnAttempted'] = $returnAttempted;
        $self['returnOutcome'] = $returnOutcome;
        $self['returned'] = $returned;

        return $self;
    }

    /**
     * Merchant resolution attempted.
     *
     * @param MerchantResolutionAttempted|value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     */
    public function withMerchantResolutionAttempted(
        MerchantResolutionAttempted|string $merchantResolutionAttempted
    ): self {
        $self = clone $this;
        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;

        return $self;
    }

    /**
     * Received at.
     */
    public function withReceivedAt(string $receivedAt): self
    {
        $self = clone $this;
        $self['receivedAt'] = $receivedAt;

        return $self;
    }

    /**
     * Return attempted. Present if and only if `return_outcome` is `return_attempted`.
     *
     * @param ReturnAttempted|ReturnAttemptedShape|null $returnAttempted
     */
    public function withReturnAttempted(
        ReturnAttempted|array|null $returnAttempted
    ): self {
        $self = clone $this;
        $self['returnAttempted'] = $returnAttempted;

        return $self;
    }

    /**
     * Return outcome.
     *
     * @param ReturnOutcome|value-of<ReturnOutcome> $returnOutcome
     */
    public function withReturnOutcome(ReturnOutcome|string $returnOutcome): self
    {
        $self = clone $this;
        $self['returnOutcome'] = $returnOutcome;

        return $self;
    }

    /**
     * Returned. Present if and only if `return_outcome` is `returned`.
     *
     * @param Returned|ReturnedShape|null $returned
     */
    public function withReturned(Returned|array|null $returned): self
    {
        $self = clone $this;
        $self['returned'] = $returned;

        return $self;
    }
}
