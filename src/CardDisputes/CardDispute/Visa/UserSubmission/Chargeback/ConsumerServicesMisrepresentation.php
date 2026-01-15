<?php

declare(strict_types=1);

namespace Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback;

use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerServicesMisrepresentation\CardholderCancellation;
use Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerServicesMisrepresentation\MerchantResolutionAttempted;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Services misrepresentation. Present if and only if `category` is `consumer_services_misrepresentation`.
 *
 * @phpstan-import-type CardholderCancellationShape from \Increase\CardDisputes\CardDispute\Visa\UserSubmission\Chargeback\ConsumerServicesMisrepresentation\CardholderCancellation
 *
 * @phpstan-type ConsumerServicesMisrepresentationShape = array{
 *   cardholderCancellation: CardholderCancellation|CardholderCancellationShape,
 *   merchantResolutionAttempted: MerchantResolutionAttempted|value-of<MerchantResolutionAttempted>,
 *   misrepresentationExplanation: string,
 *   purchaseExplanation: string,
 *   receivedAt: string,
 * }
 */
final class ConsumerServicesMisrepresentation implements BaseModel
{
    /** @use SdkModel<ConsumerServicesMisrepresentationShape> */
    use SdkModel;

    /**
     * Cardholder cancellation.
     */
    #[Required('cardholder_cancellation')]
    public CardholderCancellation $cardholderCancellation;

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
     * Misrepresentation explanation.
     */
    #[Required('misrepresentation_explanation')]
    public string $misrepresentationExplanation;

    /**
     * Purchase explanation.
     */
    #[Required('purchase_explanation')]
    public string $purchaseExplanation;

    /**
     * Received at.
     */
    #[Required('received_at')]
    public string $receivedAt;

    /**
     * `new ConsumerServicesMisrepresentation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConsumerServicesMisrepresentation::with(
     *   cardholderCancellation: ...,
     *   merchantResolutionAttempted: ...,
     *   misrepresentationExplanation: ...,
     *   purchaseExplanation: ...,
     *   receivedAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConsumerServicesMisrepresentation)
     *   ->withCardholderCancellation(...)
     *   ->withMerchantResolutionAttempted(...)
     *   ->withMisrepresentationExplanation(...)
     *   ->withPurchaseExplanation(...)
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
        MerchantResolutionAttempted|string $merchantResolutionAttempted,
        string $misrepresentationExplanation,
        string $purchaseExplanation,
        string $receivedAt,
    ): self {
        $self = new self;

        $self['cardholderCancellation'] = $cardholderCancellation;
        $self['merchantResolutionAttempted'] = $merchantResolutionAttempted;
        $self['misrepresentationExplanation'] = $misrepresentationExplanation;
        $self['purchaseExplanation'] = $purchaseExplanation;
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
     * Misrepresentation explanation.
     */
    public function withMisrepresentationExplanation(
        string $misrepresentationExplanation
    ): self {
        $self = clone $this;
        $self['misrepresentationExplanation'] = $misrepresentationExplanation;

        return $self;
    }

    /**
     * Purchase explanation.
     */
    public function withPurchaseExplanation(string $purchaseExplanation): self
    {
        $self = clone $this;
        $self['purchaseExplanation'] = $purchaseExplanation;

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
