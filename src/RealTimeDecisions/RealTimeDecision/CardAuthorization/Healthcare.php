<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\CardAuthorization\Healthcare\MerchantNinetyPercentEligibility;

/**
 * The healthcare-related fields for this authorization. Only present for specific programs.
 *
 * @phpstan-type HealthcareShape = array{
 *   merchantNinetyPercentEligibility: MerchantNinetyPercentEligibility|value-of<MerchantNinetyPercentEligibility>,
 * }
 */
final class Healthcare implements BaseModel
{
    /** @use SdkModel<HealthcareShape> */
    use SdkModel;

    /**
     * The merchant's eligibility under the Internal Revenue Service's 90% Rule for Flexible Spending Account (FSA) and Health Savings Account (HSA) eligible products. The eligibility is determined based on the list of merchants maintained by the Special Interest Group for IIAS Standards (SIGIS).
     *
     * @var value-of<MerchantNinetyPercentEligibility> $merchantNinetyPercentEligibility
     */
    #[Required(
        'merchant_ninety_percent_eligibility',
        enum: MerchantNinetyPercentEligibility::class,
    )]
    public string $merchantNinetyPercentEligibility;

    /**
     * `new Healthcare()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Healthcare::with(merchantNinetyPercentEligibility: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Healthcare)->withMerchantNinetyPercentEligibility(...)
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
     * @param MerchantNinetyPercentEligibility|value-of<MerchantNinetyPercentEligibility> $merchantNinetyPercentEligibility
     */
    public static function with(
        MerchantNinetyPercentEligibility|string $merchantNinetyPercentEligibility
    ): self {
        $self = new self;

        $self['merchantNinetyPercentEligibility'] = $merchantNinetyPercentEligibility;

        return $self;
    }

    /**
     * The merchant's eligibility under the Internal Revenue Service's 90% Rule for Flexible Spending Account (FSA) and Health Savings Account (HSA) eligible products. The eligibility is determined based on the list of merchants maintained by the Special Interest Group for IIAS Standards (SIGIS).
     *
     * @param MerchantNinetyPercentEligibility|value-of<MerchantNinetyPercentEligibility> $merchantNinetyPercentEligibility
     */
    public function withMerchantNinetyPercentEligibility(
        MerchantNinetyPercentEligibility|string $merchantNinetyPercentEligibility
    ): self {
        $self = clone $this;
        $self['merchantNinetyPercentEligibility'] = $merchantNinetyPercentEligibility;

        return $self;
    }
}
