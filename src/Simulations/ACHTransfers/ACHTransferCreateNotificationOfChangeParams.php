<?php

declare(strict_types=1);

namespace Increase\Simulations\ACHTransfers;

use Increase\Core\Attributes\Optional;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\ACHTransfers\ACHTransferCreateNotificationOfChangeParams\CorrectedAccountFunding;

/**
 * Simulates receiving a Notification of Change for an [ACH Transfer](#ach-transfers).
 *
 * @see Increase\Services\Simulations\ACHTransfersService::createNotificationOfChange()
 *
 * @phpstan-type ACHTransferCreateNotificationOfChangeParamsShape = array{
 *   correctedAccountFunding?: null|CorrectedAccountFunding|value-of<CorrectedAccountFunding>,
 *   correctedAccountNumber?: string|null,
 *   correctedIndividualID?: string|null,
 *   correctedRoutingNumber?: string|null,
 * }
 */
final class ACHTransferCreateNotificationOfChangeParams implements BaseModel
{
    /** @use SdkModel<ACHTransferCreateNotificationOfChangeParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The corrected account funding type.
     *
     * @var value-of<CorrectedAccountFunding>|null $correctedAccountFunding
     */
    #[Optional('corrected_account_funding', enum: CorrectedAccountFunding::class)]
    public ?string $correctedAccountFunding;

    /**
     * The corrected account number.
     */
    #[Optional('corrected_account_number')]
    public ?string $correctedAccountNumber;

    /**
     * The corrected individual identifier.
     */
    #[Optional('corrected_individual_id')]
    public ?string $correctedIndividualID;

    /**
     * The corrected routing number.
     */
    #[Optional('corrected_routing_number')]
    public ?string $correctedRoutingNumber;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param CorrectedAccountFunding|value-of<CorrectedAccountFunding>|null $correctedAccountFunding
     */
    public static function with(
        CorrectedAccountFunding|string|null $correctedAccountFunding = null,
        ?string $correctedAccountNumber = null,
        ?string $correctedIndividualID = null,
        ?string $correctedRoutingNumber = null,
    ): self {
        $self = new self;

        null !== $correctedAccountFunding && $self['correctedAccountFunding'] = $correctedAccountFunding;
        null !== $correctedAccountNumber && $self['correctedAccountNumber'] = $correctedAccountNumber;
        null !== $correctedIndividualID && $self['correctedIndividualID'] = $correctedIndividualID;
        null !== $correctedRoutingNumber && $self['correctedRoutingNumber'] = $correctedRoutingNumber;

        return $self;
    }

    /**
     * The corrected account funding type.
     *
     * @param CorrectedAccountFunding|value-of<CorrectedAccountFunding> $correctedAccountFunding
     */
    public function withCorrectedAccountFunding(
        CorrectedAccountFunding|string $correctedAccountFunding
    ): self {
        $self = clone $this;
        $self['correctedAccountFunding'] = $correctedAccountFunding;

        return $self;
    }

    /**
     * The corrected account number.
     */
    public function withCorrectedAccountNumber(
        string $correctedAccountNumber
    ): self {
        $self = clone $this;
        $self['correctedAccountNumber'] = $correctedAccountNumber;

        return $self;
    }

    /**
     * The corrected individual identifier.
     */
    public function withCorrectedIndividualID(
        string $correctedIndividualID
    ): self {
        $self = clone $this;
        $self['correctedIndividualID'] = $correctedIndividualID;

        return $self;
    }

    /**
     * The corrected routing number.
     */
    public function withCorrectedRoutingNumber(
        string $correctedRoutingNumber
    ): self {
        $self = clone $this;
        $self['correctedRoutingNumber'] = $correctedRoutingNumber;

        return $self;
    }
}
