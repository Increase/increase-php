<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\RequestDetails;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Fields specific to the category `incremental_authorization`.
 *
 * @phpstan-type IncrementalAuthorizationShape = array{
 *   cardPaymentID: string, originalCardAuthorizationID: string
 * }
 */
final class IncrementalAuthorization implements BaseModel
{
    /** @use SdkModel<IncrementalAuthorizationShape> */
    use SdkModel;

    /**
     * The card payment for this authorization and increment.
     */
    #[Required('card_payment_id')]
    public string $cardPaymentID;

    /**
     * The identifier of the card authorization this request is attempting to increment.
     */
    #[Required('original_card_authorization_id')]
    public string $originalCardAuthorizationID;

    /**
     * `new IncrementalAuthorization()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * IncrementalAuthorization::with(
     *   cardPaymentID: ..., originalCardAuthorizationID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new IncrementalAuthorization)
     *   ->withCardPaymentID(...)
     *   ->withOriginalCardAuthorizationID(...)
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
        string $cardPaymentID,
        string $originalCardAuthorizationID
    ): self {
        $self = new self;

        $self['cardPaymentID'] = $cardPaymentID;
        $self['originalCardAuthorizationID'] = $originalCardAuthorizationID;

        return $self;
    }

    /**
     * The card payment for this authorization and increment.
     */
    public function withCardPaymentID(string $cardPaymentID): self
    {
        $self = clone $this;
        $self['cardPaymentID'] = $cardPaymentID;

        return $self;
    }

    /**
     * The identifier of the card authorization this request is attempting to increment.
     */
    public function withOriginalCardAuthorizationID(
        string $originalCardAuthorizationID
    ): self {
        $self = clone $this;
        $self['originalCardAuthorizationID'] = $originalCardAuthorizationID;

        return $self;
    }
}
