<?php

declare(strict_types=1);

namespace Increase\ACHTransfers\ACHTransfer;

use Increase\ACHTransfers\ACHTransfer\NotificationsOfChange\ChangeCode;
use Increase\ACHTransfers\ACHTransfer\NotificationsOfChange\CorrectedAccountFunding;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type NotificationsOfChangeShape = array{
 *   changeCode: ChangeCode|value-of<ChangeCode>,
 *   correctedAccountFunding: null|CorrectedAccountFunding|value-of<CorrectedAccountFunding>,
 *   correctedAccountNumber: string|null,
 *   correctedIndividualID: string|null,
 *   correctedRoutingNumber: string|null,
 *   createdAt: \DateTimeInterface,
 * }
 */
final class NotificationsOfChange implements BaseModel
{
    /** @use SdkModel<NotificationsOfChangeShape> */
    use SdkModel;

    /**
     * The required type of change that is being signaled by the receiving financial institution.
     *
     * @var value-of<ChangeCode> $changeCode
     */
    #[Required('change_code', enum: ChangeCode::class)]
    public string $changeCode;

    /**
     * The corrected account funding type that should be used in future ACHs to this account. This is derived from the corrected transaction code.
     *
     * @var value-of<CorrectedAccountFunding>|null $correctedAccountFunding
     */
    #[Required('corrected_account_funding', enum: CorrectedAccountFunding::class)]
    public ?string $correctedAccountFunding;

    /**
     * The corrected account number that should be used in future ACHs to this account.
     */
    #[Required('corrected_account_number')]
    public ?string $correctedAccountNumber;

    /**
     * The corrected individual identifier that should be used in future ACHs.
     */
    #[Required('corrected_individual_id')]
    public ?string $correctedIndividualID;

    /**
     * The corrected routing number that should be used in future ACHs to this account.
     */
    #[Required('corrected_routing_number')]
    public ?string $correctedRoutingNumber;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the notification occurred.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * `new NotificationsOfChange()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationsOfChange::with(
     *   changeCode: ...,
     *   correctedAccountFunding: ...,
     *   correctedAccountNumber: ...,
     *   correctedIndividualID: ...,
     *   correctedRoutingNumber: ...,
     *   createdAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationsOfChange)
     *   ->withChangeCode(...)
     *   ->withCorrectedAccountFunding(...)
     *   ->withCorrectedAccountNumber(...)
     *   ->withCorrectedIndividualID(...)
     *   ->withCorrectedRoutingNumber(...)
     *   ->withCreatedAt(...)
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
     * @param ChangeCode|value-of<ChangeCode> $changeCode
     * @param CorrectedAccountFunding|value-of<CorrectedAccountFunding>|null $correctedAccountFunding
     */
    public static function with(
        ChangeCode|string $changeCode,
        CorrectedAccountFunding|string|null $correctedAccountFunding,
        ?string $correctedAccountNumber,
        ?string $correctedIndividualID,
        ?string $correctedRoutingNumber,
        \DateTimeInterface $createdAt,
    ): self {
        $self = new self;

        $self['changeCode'] = $changeCode;
        $self['correctedAccountFunding'] = $correctedAccountFunding;
        $self['correctedAccountNumber'] = $correctedAccountNumber;
        $self['correctedIndividualID'] = $correctedIndividualID;
        $self['correctedRoutingNumber'] = $correctedRoutingNumber;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The required type of change that is being signaled by the receiving financial institution.
     *
     * @param ChangeCode|value-of<ChangeCode> $changeCode
     */
    public function withChangeCode(ChangeCode|string $changeCode): self
    {
        $self = clone $this;
        $self['changeCode'] = $changeCode;

        return $self;
    }

    /**
     * The corrected account funding type that should be used in future ACHs to this account. This is derived from the corrected transaction code.
     *
     * @param CorrectedAccountFunding|value-of<CorrectedAccountFunding>|null $correctedAccountFunding
     */
    public function withCorrectedAccountFunding(
        CorrectedAccountFunding|string|null $correctedAccountFunding
    ): self {
        $self = clone $this;
        $self['correctedAccountFunding'] = $correctedAccountFunding;

        return $self;
    }

    /**
     * The corrected account number that should be used in future ACHs to this account.
     */
    public function withCorrectedAccountNumber(
        ?string $correctedAccountNumber
    ): self {
        $self = clone $this;
        $self['correctedAccountNumber'] = $correctedAccountNumber;

        return $self;
    }

    /**
     * The corrected individual identifier that should be used in future ACHs.
     */
    public function withCorrectedIndividualID(
        ?string $correctedIndividualID
    ): self {
        $self = clone $this;
        $self['correctedIndividualID'] = $correctedIndividualID;

        return $self;
    }

    /**
     * The corrected routing number that should be used in future ACHs to this account.
     */
    public function withCorrectedRoutingNumber(
        ?string $correctedRoutingNumber
    ): self {
        $self = clone $this;
        $self['correctedRoutingNumber'] = $correctedRoutingNumber;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the notification occurred.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }
}
