<?php

declare(strict_types=1);

namespace Increase\Simulations\CardBalanceInquiries\CardBalanceInquiryCreateParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\CardBalanceInquiries\CardBalanceInquiryCreateParams\NetworkDetails\Visa;

/**
 * Fields specific to a given card network.
 *
 * @phpstan-import-type VisaShape from \Increase\Simulations\CardBalanceInquiries\CardBalanceInquiryCreateParams\NetworkDetails\Visa
 *
 * @phpstan-type NetworkDetailsShape = array{visa: Visa|VisaShape}
 */
final class NetworkDetails implements BaseModel
{
    /** @use SdkModel<NetworkDetailsShape> */
    use SdkModel;

    /**
     * Fields specific to the Visa network.
     */
    #[Required]
    public Visa $visa;

    /**
     * `new NetworkDetails()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NetworkDetails::with(visa: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NetworkDetails)->withVisa(...)
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
     * @param Visa|VisaShape $visa
     */
    public static function with(Visa|array $visa): self
    {
        $self = new self;

        $self['visa'] = $visa;

        return $self;
    }

    /**
     * Fields specific to the Visa network.
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
