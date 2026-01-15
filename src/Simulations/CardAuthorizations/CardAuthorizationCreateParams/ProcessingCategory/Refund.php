<?php

declare(strict_types=1);

namespace Increase\Simulations\CardAuthorizations\CardAuthorizationCreateParams\ProcessingCategory;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details related to refund authorizations.
 *
 * @phpstan-type RefundShape = array{originalCardPaymentID?: string|null}
 */
final class Refund implements BaseModel
{
    /** @use SdkModel<RefundShape> */
    use SdkModel;

    /**
     * The card payment to link this refund to.
     */
    #[Optional('original_card_payment_id')]
    public ?string $originalCardPaymentID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $originalCardPaymentID = null): self
    {
        $self = new self;

        null !== $originalCardPaymentID && $self['originalCardPaymentID'] = $originalCardPaymentID;

        return $self;
    }

    /**
     * The card payment to link this refund to.
     */
    public function withOriginalCardPaymentID(
        string $originalCardPaymentID
    ): self {
        $self = clone $this;
        $self['originalCardPaymentID'] = $originalCardPaymentID;

        return $self;
    }
}
