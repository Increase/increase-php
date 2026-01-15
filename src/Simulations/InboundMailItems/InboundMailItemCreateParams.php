<?php

declare(strict_types=1);

namespace Increase\Simulations\InboundMailItems;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Simulates an inbound mail item to your account, as if someone had mailed a physical check to one of your account's Lockboxes.
 *
 * @see Increase\Services\Simulations\InboundMailItemsService::create()
 *
 * @phpstan-type InboundMailItemCreateParamsShape = array{
 *   amount: int, lockboxID: string, contentsFileID?: string|null
 * }
 */
final class InboundMailItemCreateParams implements BaseModel
{
    /** @use SdkModel<InboundMailItemCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The amount of the check to be simulated, in cents.
     */
    #[Required]
    public int $amount;

    /**
     * The identifier of the Lockbox to simulate inbound mail to.
     */
    #[Required('lockbox_id')]
    public string $lockboxID;

    /**
     * The file containing the PDF contents. If not present, a default check image file will be used.
     */
    #[Optional('contents_file_id')]
    public ?string $contentsFileID;

    /**
     * `new InboundMailItemCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InboundMailItemCreateParams::with(amount: ..., lockboxID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InboundMailItemCreateParams)->withAmount(...)->withLockboxID(...)
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
        int $amount,
        string $lockboxID,
        ?string $contentsFileID = null
    ): self {
        $self = new self;

        $self['amount'] = $amount;
        $self['lockboxID'] = $lockboxID;

        null !== $contentsFileID && $self['contentsFileID'] = $contentsFileID;

        return $self;
    }

    /**
     * The amount of the check to be simulated, in cents.
     */
    public function withAmount(int $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The identifier of the Lockbox to simulate inbound mail to.
     */
    public function withLockboxID(string $lockboxID): self
    {
        $self = clone $this;
        $self['lockboxID'] = $lockboxID;

        return $self;
    }

    /**
     * The file containing the PDF contents. If not present, a default check image file will be used.
     */
    public function withContentsFileID(string $contentsFileID): self
    {
        $self = clone $this;
        $self['contentsFileID'] = $contentsFileID;

        return $self;
    }
}
