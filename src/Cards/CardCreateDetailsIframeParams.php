<?php

declare(strict_types=1);

namespace Increase\Cards;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create an iframe URL for a Card to display the card details. More details about styling and usage can be found in the [documentation](/documentation/embedded-card-component).
 *
 * @see Increase\Services\CardsService::createDetailsIframe()
 *
 * @phpstan-type CardCreateDetailsIframeParamsShape = array{
 *   physicalCardID?: string|null
 * }
 */
final class CardCreateDetailsIframeParams implements BaseModel
{
    /** @use SdkModel<CardCreateDetailsIframeParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Physical Card to create an iframe for. This will inform the appearance of the card rendered in the iframe.
     */
    #[Optional('physical_card_id')]
    public ?string $physicalCardID;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $physicalCardID = null): self
    {
        $self = new self;

        null !== $physicalCardID && $self['physicalCardID'] = $physicalCardID;

        return $self;
    }

    /**
     * The identifier of the Physical Card to create an iframe for. This will inform the appearance of the card rendered in the iframe.
     */
    public function withPhysicalCardID(string $physicalCardID): self
    {
        $self = clone $this;
        $self['physicalCardID'] = $physicalCardID;

        return $self;
    }
}
