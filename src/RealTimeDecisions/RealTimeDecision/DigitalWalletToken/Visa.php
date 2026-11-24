<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Risk scores provided by Visa for the provisioning request. This field will be present in the JSON response if and only if `network` is equal to `visa`.
 *
 * @phpstan-type VisaShape = array{
 *   networkRiskScore: int|null, provisioningRiskScore: int|null
 * }
 */
final class Visa implements BaseModel
{
    /** @use SdkModel<VisaShape> */
    use SdkModel;

    /**
     * Visa's risk score for the card, based on its transaction history, from 0 to 99. A higher score indicates a higher risk.
     */
    #[Required('network_risk_score')]
    public ?int $networkRiskScore;

    /**
     * Visa's risk score for the provisioning request, from 1 to 99. A higher score indicates a higher risk.
     */
    #[Required('provisioning_risk_score')]
    public ?int $provisioningRiskScore;

    /**
     * `new Visa()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Visa::with(networkRiskScore: ..., provisioningRiskScore: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Visa)->withNetworkRiskScore(...)->withProvisioningRiskScore(...)
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
        ?int $networkRiskScore,
        ?int $provisioningRiskScore
    ): self {
        $self = new self;

        $self['networkRiskScore'] = $networkRiskScore;
        $self['provisioningRiskScore'] = $provisioningRiskScore;

        return $self;
    }

    /**
     * Visa's risk score for the card, based on its transaction history, from 0 to 99. A higher score indicates a higher risk.
     */
    public function withNetworkRiskScore(?int $networkRiskScore): self
    {
        $self = clone $this;
        $self['networkRiskScore'] = $networkRiskScore;

        return $self;
    }

    /**
     * Visa's risk score for the provisioning request, from 1 to 99. A higher score indicates a higher risk.
     */
    public function withProvisioningRiskScore(?int $provisioningRiskScore): self
    {
        $self = clone $this;
        $self['provisioningRiskScore'] = $provisioningRiskScore;

        return $self;
    }
}
