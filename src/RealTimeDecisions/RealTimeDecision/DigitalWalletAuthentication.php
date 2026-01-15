<?php

declare(strict_types=1);

namespace Increase\RealTimeDecisions\RealTimeDecision;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletAuthentication\Channel;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletAuthentication\DigitalWallet;
use Increase\RealTimeDecisions\RealTimeDecision\DigitalWalletAuthentication\Result;

/**
 * Fields related to a digital wallet authentication attempt.
 *
 * @phpstan-type DigitalWalletAuthenticationShape = array{
 *   cardID: string,
 *   channel: Channel|value-of<Channel>,
 *   digitalWallet: DigitalWallet|value-of<DigitalWallet>,
 *   email: string|null,
 *   oneTimePasscode: string,
 *   phone: string|null,
 *   result: null|Result|value-of<Result>,
 * }
 */
final class DigitalWalletAuthentication implements BaseModel
{
    /** @use SdkModel<DigitalWalletAuthenticationShape> */
    use SdkModel;

    /**
     * The identifier of the Card that is being tokenized.
     */
    #[Required('card_id')]
    public string $cardID;

    /**
     * The channel to send the card user their one-time passcode.
     *
     * @var value-of<Channel> $channel
     */
    #[Required(enum: Channel::class)]
    public string $channel;

    /**
     * The digital wallet app being used.
     *
     * @var value-of<DigitalWallet> $digitalWallet
     */
    #[Required('digital_wallet', enum: DigitalWallet::class)]
    public string $digitalWallet;

    /**
     * The email to send the one-time passcode to if `channel` is equal to `email`.
     */
    #[Required]
    public ?string $email;

    /**
     * The one-time passcode to send the card user.
     */
    #[Required('one_time_passcode')]
    public string $oneTimePasscode;

    /**
     * The phone number to send the one-time passcode to if `channel` is equal to `sms`.
     */
    #[Required]
    public ?string $phone;

    /**
     * Whether your application successfully delivered the one-time passcode.
     *
     * @var value-of<Result>|null $result
     */
    #[Required(enum: Result::class)]
    public ?string $result;

    /**
     * `new DigitalWalletAuthentication()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DigitalWalletAuthentication::with(
     *   cardID: ...,
     *   channel: ...,
     *   digitalWallet: ...,
     *   email: ...,
     *   oneTimePasscode: ...,
     *   phone: ...,
     *   result: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DigitalWalletAuthentication)
     *   ->withCardID(...)
     *   ->withChannel(...)
     *   ->withDigitalWallet(...)
     *   ->withEmail(...)
     *   ->withOneTimePasscode(...)
     *   ->withPhone(...)
     *   ->withResult(...)
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
     * @param Channel|value-of<Channel> $channel
     * @param DigitalWallet|value-of<DigitalWallet> $digitalWallet
     * @param Result|value-of<Result>|null $result
     */
    public static function with(
        string $cardID,
        Channel|string $channel,
        DigitalWallet|string $digitalWallet,
        ?string $email,
        string $oneTimePasscode,
        ?string $phone,
        Result|string|null $result,
    ): self {
        $self = new self;

        $self['cardID'] = $cardID;
        $self['channel'] = $channel;
        $self['digitalWallet'] = $digitalWallet;
        $self['email'] = $email;
        $self['oneTimePasscode'] = $oneTimePasscode;
        $self['phone'] = $phone;
        $self['result'] = $result;

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
     * The channel to send the card user their one-time passcode.
     *
     * @param Channel|value-of<Channel> $channel
     */
    public function withChannel(Channel|string $channel): self
    {
        $self = clone $this;
        $self['channel'] = $channel;

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

    /**
     * The email to send the one-time passcode to if `channel` is equal to `email`.
     */
    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * The one-time passcode to send the card user.
     */
    public function withOneTimePasscode(string $oneTimePasscode): self
    {
        $self = clone $this;
        $self['oneTimePasscode'] = $oneTimePasscode;

        return $self;
    }

    /**
     * The phone number to send the one-time passcode to if `channel` is equal to `sms`.
     */
    public function withPhone(?string $phone): self
    {
        $self = clone $this;
        $self['phone'] = $phone;

        return $self;
    }

    /**
     * Whether your application successfully delivered the one-time passcode.
     *
     * @param Result|value-of<Result>|null $result
     */
    public function withResult(Result|string|null $result): self
    {
        $self = clone $this;
        $self['result'] = $result;

        return $self;
    }
}
