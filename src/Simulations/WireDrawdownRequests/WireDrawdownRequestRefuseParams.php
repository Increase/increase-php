<?php

declare(strict_types=1);

namespace Increase\Simulations\WireDrawdownRequests;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\WireDrawdownRequests\WireDrawdownRequestRefuseParams\RefusalReasonCode;

/**
 * Simulates a Wire Drawdown Request being refused by the debtor.
 *
 * @see Increase\Services\Simulations\WireDrawdownRequestsService::refuse()
 *
 * @phpstan-type WireDrawdownRequestRefuseParamsShape = array{
 *   refusalReasonAdditionalInformation?: string|null,
 *   refusalReasonCode?: null|RefusalReasonCode|value-of<RefusalReasonCode>,
 * }
 */
final class WireDrawdownRequestRefuseParams implements BaseModel
{
    /** @use SdkModel<WireDrawdownRequestRefuseParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Additional information about the refusal that the simulated refusal will have.
     */
    #[Optional('refusal_reason_additional_information')]
    public ?string $refusalReasonAdditionalInformation;

    /**
     * The reason code that the simulated refusal will have.
     *
     * Defaults to `other`.
     *
     * @var value-of<RefusalReasonCode>|null $refusalReasonCode
     */
    #[Optional('refusal_reason_code', enum: RefusalReasonCode::class)]
    public ?string $refusalReasonCode;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param RefusalReasonCode|value-of<RefusalReasonCode>|null $refusalReasonCode
     */
    public static function with(
        ?string $refusalReasonAdditionalInformation = null,
        RefusalReasonCode|string|null $refusalReasonCode = null,
    ): self {
        $self = new self;

        null !== $refusalReasonAdditionalInformation && $self['refusalReasonAdditionalInformation'] = $refusalReasonAdditionalInformation;
        null !== $refusalReasonCode && $self['refusalReasonCode'] = $refusalReasonCode;

        return $self;
    }

    /**
     * Additional information about the refusal that the simulated refusal will have.
     */
    public function withRefusalReasonAdditionalInformation(
        string $refusalReasonAdditionalInformation
    ): self {
        $self = clone $this;
        $self['refusalReasonAdditionalInformation'] = $refusalReasonAdditionalInformation;

        return $self;
    }

    /**
     * The reason code that the simulated refusal will have.
     *
     * Defaults to `other`.
     *
     * @param RefusalReasonCode|value-of<RefusalReasonCode> $refusalReasonCode
     */
    public function withRefusalReasonCode(
        RefusalReasonCode|string $refusalReasonCode
    ): self {
        $self = clone $this;
        $self['refusalReasonCode'] = $refusalReasonCode;

        return $self;
    }
}
