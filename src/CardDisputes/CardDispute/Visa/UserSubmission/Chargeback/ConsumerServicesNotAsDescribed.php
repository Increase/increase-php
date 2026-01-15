<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerServicesNotAsDescribed\CardholderCancellation;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerServicesNotAsDescribed\MerchantResolutionAttempted;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Services not as described. Present if and only if `category` is `consumer_services_not_as_described`.
 *
 * @phpstan-import-type CardholderCancellationShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerServicesNotAsDescribed\CardholderCancellation
 *
 * @phpstan-type ConsumerServicesNotAsDescribedShape = array{
 *   cardholderCancellation: CardholderCancellation|CardholderCancellationShape,
 *   explanation: string,
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   receivedAt: string,
 * }
 */
final class ConsumerServicesNotAsDescribed implements BaseModel
{
    /** @use SdkModel<ConsumerServicesNotAsDescribedShape> */
    use SdkModel;

    /**
     * Cardholder cancellation.
     */
    #[Required('cardholder_cancellation')]
    public CardholderCancellation $cardholderCancellation;

    /**
     * Explanation of what was ordered and was not as described.
     */
    #[Required]
    public string $explanation;

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
     * `new ConsumerServicesNotAsDescribed()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerServicesNotAsDescribed::with(
     *   cardholderCancellation: ...,
     *   explanation: ...,
     *   merchantResolutionAttempted: ...,
     *   receivedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerServicesNotAsDescribed)
     *   ->withCardholderCancellation(...)
     *   ->withExplanation(...)
     *   ->withMerchantResolutionAttempted(...)
     *   ->withReceivedAt(...)
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
     * @param CardholderCancellation|CardholderCancellationShape $cardholderCancellation
     * @param MerchantResolutionAttempted|value-of<MerchantResolutionAttempted> $merchantResolutionAttempted
     */
    public static function with(
        CardholderCancellation|array $cardholderCancellation,
        string $explanation,
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        string $receivedAt,
    ): self {
        $self = new self;

        $self['cardholderCancellation'] = $cardholderCancellation;
        $self['explanation'] = $explanation;
        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;
        $self['receivedAt'] = $receivedAt;

        return $self;
    }

    /**
     * Cardholder cancellation.
     *
     * @param CardholderCancellation|CardholderCancellationShape $cardholderCancellation
     */
    public function withCardholderCancellation(
        CardholderCancellation|array $cardholderCancellation
    ): self {
        $self = clone $this;
        $self['cardholderCancellation'] = $cardholderCancellation;

        return $self;
    }

    /**
     * Explanation of what was ordered and was not as described.
     */
    public function withExplanation(string $explanation): self
    {
        $self = clone $this;
        $self['explanation'] = $explanation;

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
}
