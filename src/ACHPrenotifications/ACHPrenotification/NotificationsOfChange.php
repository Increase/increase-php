<?php

declare(strict_types=1);

namespace Increase\ACHPrenotifications\ACHPrenotification;

use Increase\ACHPrenotifications\ACHPrenotification\NotificationsOfChange\ChangeCode;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * @phpstan-type NotificationsOfChangeShape = array{
 *   changeCode: ChangeCode|value-of<ChangeCode>,
 *   correctedData: string,
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
     * The corrected data that should be used in future ACHs to this account. This may contain the suggested new account number or routing number. When the `change_code` is `incorrect_transaction_code`, this field contains an integer. Numbers starting with a 2 encourage changing the `funding` parameter to checking; numbers starting with a 3 encourage changing to savings.
     */
    #[Required('corrected_data')]
    public string $correctedData;

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
     * NotificationsOfChange::with(changeCode: ..., correctedData: ..., createdAt: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationsOfChange)
     *   ->withChangeCode(...)
     *   ->withCorrectedData(...)
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
     */
    public static function with(
        ChangeCode|string $changeCode,
        string $correctedData,
        \DateTimeInterface $createdAt,
    ): self {
        $self = new self;

        $self['changeCode'] = $changeCode;
        $self['correctedData'] = $correctedData;
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
     * The corrected data that should be used in future ACHs to this account. This may contain the suggested new account number or routing number. When the `change_code` is `incorrect_transaction_code`, this field contains an integer. Numbers starting with a 2 encourage changing the `funding` parameter to checking; numbers starting with a 3 encourage changing to savings.
     */
    public function withCorrectedData(string $correctedData): self
    {
        $self = clone $this;
        $self['correctedData'] = $correctedData;

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
