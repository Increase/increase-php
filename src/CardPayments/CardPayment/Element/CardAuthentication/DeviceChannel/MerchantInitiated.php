<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthentication\DeviceChannel;

use Increase\CardPayments\CardPayment\Element\CardAuthentication\DeviceChannel\MerchantInitiated\Indicator;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Fields specific to merchant initiated transactions.
 *
 * @phpstan-type MerchantInitiatedShape = array{
 *   indicator: Indicator|value-of<Indicator>
 * }
 */
final class MerchantInitiated implements BaseModel
{
    /** @use SdkModel<MerchantInitiatedShape> */
    use SdkModel;

    /**
     * The merchant initiated indicator for the transaction.
     *
     * @var value-of<Indicator> $indicator
     */
    #[Required(enum: Indicator::class)]
    public string $indicator;

    /**
     * `new MerchantInitiated()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MerchantInitiated::with(indicator: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MerchantInitiated)->withIndicator(...)
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
     * @param Indicator|value-of<Indicator> $indicator
     */
    public static function with(Indicator|string $indicator): self
    {
        $self = new self;

        $self['indicator'] = $indicator;

        return $self;
    }

    /**
     * The merchant initiated indicator for the transaction.
     *
     * @param Indicator|value-of<Indicator> $indicator
     */
    public function withIndicator(Indicator|string $indicator): self
    {
        $self = clone $this;
        $self['indicator'] = $indicator;

        return $self;
    }
}
