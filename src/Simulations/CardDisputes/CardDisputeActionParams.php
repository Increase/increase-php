<?php

declare(strict_types=1);

namespace Increase\Simulations\CardDisputes;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Network;
use Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa;

/**
 * After a [Card Dispute](#card-disputes) is created in production, the dispute will initially be in a `pending_user_submission_reviewing` state. Since no review or further action happens in sandbox, this endpoint simulates moving a Card Dispute through its various states.
 *
 * @see Increase\Services\Simulations\CardDisputesService::action()
 *
 * @phpstan-import-type VisaShape from \Increase\Simulations\CardDisputes\CardDisputeActionParams\Visa
 *
 * @phpstan-type CardDisputeActionParamsShape = array{
 *   network: Network|value-of<Network>, visa?: null|Visa|VisaShape
 * }
 */
final class CardDisputeActionParams implements BaseModel
{
    /** @use SdkModel<CardDisputeActionParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The network of the Card Dispute. Details specific to the network are required under the sub-object with the same identifier as the network.
     *
     * @var value-of<Network> $network
     */
    #[Required(enum: Network::class)]
    public string $network;

    /**
     * The Visa-specific parameters for the taking action on the dispute. Required if and only if `network` is `visa`.
     */
    #[Optional]
    public ?Visa $visa;

    /**
     * `new CardDisputeActionParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CardDisputeActionParams::with(network: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CardDisputeActionParams)->withNetwork(...)
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
     * @param Network|value-of<Network> $network
     * @param Visa|VisaShape|null $visa
     */
    public static function with(
        Network|string $network,
        Visa|array|null $visa = null
    ): self {
        $self = new self;

        $self['network'] = $network;

        null !== $visa && $self['visa'] = $visa;

        return $self;
    }

    /**
     * The network of the Card Dispute. Details specific to the network are required under the sub-object with the same identifier as the network.
     *
     * @param Network|value-of<Network> $network
     */
    public function withNetwork(Network|string $network): self
    {
        $self = clone $this;
        $self['network'] = $network;

        return $self;
    }

    /**
     * The Visa-specific parameters for the taking action on the dispute. Required if and only if `network` is `visa`.
     *
     * @param Visa|VisaShape $visa
     */
    public function withVisa(Visa|array $visa): self
    {
        $self = clone $this;
        $self['visa'] = $visa;

        return $self;
    }
}
