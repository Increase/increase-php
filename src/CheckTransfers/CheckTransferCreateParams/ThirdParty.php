<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransferCreateParams;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details relating to the custom fulfillment you will perform. This is required if `fulfillment_method` is equal to `third_party`. It must not be included if any other `fulfillment_method` is provided.
 *
 * @phpstan-type ThirdPartyShape = array{recipientName?: string|null}
 */
final class ThirdParty implements BaseModel
{
    /** @use SdkModel<ThirdPartyShape> */
    use SdkModel;

    /**
     * The pay-to name you will print on the check. If provided, this is used for [Positive Pay](/documentation/positive-pay). If this is omitted, Increase will be unable to validate the payer name when the check is deposited.
     */
    #[Optional('recipient_name')]
    public ?string $recipientName;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $recipientName = null): self
    {
        $self = new self;

        null !== $recipientName && $self['recipientName'] = $recipientName;

        return $self;
    }

    /**
     * The pay-to name you will print on the check. If provided, this is used for [Positive Pay](/documentation/positive-pay). If this is omitted, Increase will be unable to validate the payer name when the check is deposited.
     */
    public function withRecipientName(string $recipientName): self
    {
        $self = clone $this;
        $self['recipientName'] = $recipientName;

        return $self;
    }
}
