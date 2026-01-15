<?php

declare(strict_types=1);

namespace Increase\CheckTransfers\CheckTransfer;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * If the check has been mailed by Increase, this will contain details of the shipment.
 *
 * @phpstan-type MailingShape = array{
 *   imageID: string|null,
 *   mailedAt: \DateTimeInterface,
 *   trackingNumber: string|null,
 * }
 */
final class Mailing implements BaseModel
{
    /** @use SdkModel<MailingShape> */
    use SdkModel;

    /**
     * The ID of the file corresponding to an image of the check that was mailed, if available.
     */
    #[Required('image_id')]
    public ?string $imageID;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the check was mailed.
     */
    #[Required('mailed_at')]
    public \DateTimeInterface $mailedAt;

    /**
     * The tracking number of the shipment, if available for the shipping method.
     */
    #[Required('tracking_number')]
    public ?string $trackingNumber;

    /**
     * `new Mailing()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Mailing::with(imageID: ..., mailedAt: ..., trackingNumber: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Mailing)->withImageID(...)->withMailedAt(...)->withTrackingNumber(...)
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
        ?string $imageID,
        \DateTimeInterface $mailedAt,
        ?string $trackingNumber
    ): self {
        $self = new self;

        $self['imageID'] = $imageID;
        $self['mailedAt'] = $mailedAt;
        $self['trackingNumber'] = $trackingNumber;

        return $self;
    }

    /**
     * The ID of the file corresponding to an image of the check that was mailed, if available.
     */
    public function withImageID(?string $imageID): self
    {
        $self = clone $this;
        $self['imageID'] = $imageID;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the check was mailed.
     */
    public function withMailedAt(\DateTimeInterface $mailedAt): self
    {
        $self = clone $this;
        $self['mailedAt'] = $mailedAt;

        return $self;
    }

    /**
     * The tracking number of the shipment, if available for the shipping method.
     */
    public function withTrackingNumber(?string $trackingNumber): self
    {
        $self = clone $this;
        $self['trackingNumber'] = $trackingNumber;

        return $self;
    }
}
