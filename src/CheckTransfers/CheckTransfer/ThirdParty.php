<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details relating to the custom fulfillment you will perform. Will be present if and only if `fulfillment_method` is equal to `third_party`.
 *
 * @phpstan-type ThirdPartyShape = array{recipientName: string|null}
 */
final class ThirdParty implements BaseModel
{
    /** @use SdkModel<ThirdPartyShape> */
    use SdkModel;

    /**
     * The name that you will print on the check.
     */
    #[Required('recipient_name')]
    public ?string $recipientName;

    /**
     * `new ThirdParty()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ThirdParty::with(recipientName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ThirdParty)->withRecipientName(...)
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
    public static function with(?string $recipientName): self
    {
        $self = new self;

        $self['recipientName'] = $recipientName;

        return $self;
    }

    /**
     * The name that you will print on the check.
     */
    public function withRecipientName(?string $recipientName): self
    {
        $self = clone $this;
        $self['recipientName'] = $recipientName;

        return $self;
    }
}
