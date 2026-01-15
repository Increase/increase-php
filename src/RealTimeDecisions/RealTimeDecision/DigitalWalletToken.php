<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\Decision;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\Device;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\DigitalWallet;

/**
 * Fields related to a digital wallet token provisioning attempt.
 *
 * @phpstan-import-type DeviceShape from \Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletToken\Device
 *
 * @phpstan-type DigitalWalletTokenShape = array{
 *   cardID: string,
 *   decision: null|Decision|value-of<Decision>,
 *   device: Device|DeviceShape,
 *   digitalWallet: DigitalWallet|value-of<DigitalWallet>,
 * }
 */
final class DigitalWalletToken implements BaseModel
{
    /** @use SdkModel<DigitalWalletTokenShape> */
    use SdkModel;

    /**
     * The identifier of the Card that is being tokenized.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * Whether or not the provisioning request was approved. This will be null until the real time decision is responded to.
     *
     * @var value-of<Decision>|null $decision
     */
    #[Required(enum: Decision::class)]
    public ?string $decision;

    /**
     * Device that is being used to provision the digital wallet token.
     */
    #[Required]
    public Device $device;

    /**
     * The digital wallet app being used.
     *
     * @var value-of<DigitalWallet> $digitalWallet
     */
    #[Required('digital_wallet', enum: DigitalWallet::class)]
    public string $digitalWallet;

    /**
     * `new DigitalWalletToken()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalWalletToken::with(
     *   cardID: ..., decision: ..., device: ..., digitalWallet: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalWalletToken)
     *   ->withCardID(...)
     *   ->withDecision(...)
     *   ->withDevice(...)
     *   ->withDigitalWallet(...)
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
     * @param Decision|value-of<Decision>|null $decision
     * @param Device|DeviceShape $device
     * @param DigitalWallet|value-of<DigitalWallet> $digitalWallet
     */
    public static function with(
        string $cardID,
        Decision|string|null $decision,
        Device|array $device,
        DigitalWallet|string $digitalWallet,
    ): self {
        $self = new self;

        $self['cardID'] = $cardID;
        $self['decision'] = $decision;
        $self['device'] = $device;
        $self['digitalWallet'] = $digitalWallet;

        return $self;
    }

    /**
     * The identifier of the Card that is being tokenized.
     */
    public function withCardID(string $cardID): self
    {
        $self = clone $this;
        $self['cardID'] = $cardID;

        return $self;
    }

    /**
     * Whether or not the provisioning request was approved. This will be null until the real time decision is responded to.
     *
     * @param Decision|value-of<Decision>|null $decision
     */
    public function withDecision(Decision|string|null $decision): self
    {
        $self = clone $this;
        $self['decision'] = $decision;

        return $self;
    }

    /**
     * Device that is being used to provision the digital wallet token.
     *
     * @param Device|DeviceShape $device
     */
    public function withDevice(Device|array $device): self
    {
        $self = clone $this;
        $self['device'] = $device;

        return $self;
    }

    /**
     * The digital wallet app being used.
     *
     * @param DigitalWallet|value-of<DigitalWallet> $digitalWallet
     */
    public function withDigitalWallet(DigitalWallet|string $digitalWallet): self
    {
        $self = clone $this;
        $self['digitalWallet'] = $digitalWallet;

        return $self;
    }
}
