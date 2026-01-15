<?php

declare(strict_types=1);

namespace Increase\Simulations\ACHTransfers;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;
use Increase\Simulations\ACHTransfers\ACHTransferCreateNotificationOfChangeParams\ChangeCode;

/**
 * Simulates receiving a Notification of Change for an [ACH Transfer](#ach-transfers).
 *
 * @see Increase\Services\Simulations\ACHTransfersService::createNotificationOfChange()
 *
 * @phpstan-type ACHTransferCreateNotificationOfChangeParamsShape = array{
 *   changeCode: ChangeCode|value-of<ChangeCode>, correctedData: string
 * }
 */
final class ACHTransferCreateNotificationOfChangeParams implements BaseModel
{
    /** @use SdkModel<ACHTransferCreateNotificationOfChangeParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The reason for the notification of change.
     *
     * @var value-of<ChangeCode> $changeCode
     */
    #[Required('change_code', enum: ChangeCode::class)]
    public string $changeCode;

    /**
     * The corrected data for the notification of change (e.g., a new routing number).
     */
    #[Required('corrected_data')]
    public string $correctedData;

    /**
     * `new ACHTransferCreateNotificationOfChangeParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ACHTransferCreateNotificationOfChangeParams::with(
     *   changeCode: ..., correctedData: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ACHTransferCreateNotificationOfChangeParams)
     *   ->withChangeCode(...)
     *   ->withCorrectedData(...)
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
        string $correctedData
    ): self {
        $self = new self;

        $self['changeCode'] = $changeCode;
        $self['correctedData'] = $correctedData;

        return $self;
    }

    /**
     * The reason for the notification of change.
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
     * The corrected data for the notification of change (e.g., a new routing number).
     */
    public function withCorrectedData(string $correctedData): self
    {
        $self = clone $this;
        $self['correctedData'] = $correctedData;

        return $self;
    }
}
