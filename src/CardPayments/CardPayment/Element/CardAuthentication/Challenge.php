<?php

declare(strict_types=1);

namespace Increase\CardPayments\CardPayment\Element\CardAuthentication;

use Increase\CardPayments\CardPayment\Element\CardAuthentication\Challenge\Attempt;
use Increase\CardPayments\CardPayment\Element\CardAuthentication\Challenge\VerificationMethod;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Details about the challenge, if one was requested.
 *
 * @phpstan-import-type AttemptShape from \Increase\CardPayments\CardPayment\Element\CardAuthentication\Challenge\Attempt
 *
 * @phpstan-type ChallengeShape = array{
 *   attempts: list<Attempt|AttemptShape>,
 *   createdAt: \DateTimeInterface,
 *   oneTimeCode: string,
 *   verificationMethod: VerificationMethod|value-of<VerificationMethod>,
 *   verificationValue: string|null,
 * }
 */
final class Challenge implements BaseModel
{
    /** @use SdkModel<ChallengeShape> */
    use SdkModel;

    /**
     * Details about the challenge verification attempts, if any happened.
     *
     * @var list<Attempt> $attempts
     */
    #[Required(list: Attempt::class)]
    public array $attempts;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Card Authentication Challenge was started.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * The one-time code used for the Card Authentication Challenge.
     */
    #[Required('one_time_code')]
    public string $oneTimeCode;

    /**
     * The method used to verify the Card Authentication Challenge.
     *
     * @var value-of<VerificationMethod> $verificationMethod
     */
    #[Required('verification_method', enum: VerificationMethod::class)]
    public string $verificationMethod;

    /**
     * E.g., the email address or phone number used for the Card Authentication Challenge.
     */
    #[Required('verification_value')]
    public ?string $verificationValue;

    /**
     * `new Challenge()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Challenge::with(
     *   attempts: ...,
     *   createdAt: ...,
     *   oneTimeCode: ...,
     *   verificationMethod: ...,
     *   verificationValue: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Challenge)
     *   ->withAttempts(...)
     *   ->withCreatedAt(...)
     *   ->withOneTimeCode(...)
     *   ->withVerificationMethod(...)
     *   ->withVerificationValue(...)
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
     * @param list<Attempt|AttemptShape> $attempts
     * @param VerificationMethod|value-of<VerificationMethod> $verificationMethod
     */
    public static function with(
        array $attempts,
        \DateTimeInterface $createdAt,
        string $oneTimeCode,
        VerificationMethod|string $verificationMethod,
        ?string $verificationValue,
    ): self {
        $self = new self;

        $self['attempts'] = $attempts;
        $self['createdAt'] = $createdAt;
        $self['oneTimeCode'] = $oneTimeCode;
        $self['verificationMethod'] = $verificationMethod;
        $self['verificationValue'] = $verificationValue;

        return $self;
    }

    /**
     * Details about the challenge verification attempts, if any happened.
     *
     * @param list<Attempt|AttemptShape> $attempts
     */
    public function withAttempts(array $attempts): self
    {
        $self = clone $this;
        $self['attempts'] = $attempts;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Card Authentication Challenge was started.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The one-time code used for the Card Authentication Challenge.
     */
    public function withOneTimeCode(string $oneTimeCode): self
    {
        $self = clone $this;
        $self['oneTimeCode'] = $oneTimeCode;

        return $self;
    }

    /**
     * The method used to verify the Card Authentication Challenge.
     *
     * @param VerificationMethod|value-of<VerificationMethod> $verificationMethod
     */
    public function withVerificationMethod(
        VerificationMethod|string $verificationMethod
    ): self {
        $self = clone $this;
        $self['verificationMethod'] = $verificationMethod;

        return $self;
    }

    /**
     * E.g., the email address or phone number used for the Card Authentication Challenge.
     */
    public function withVerificationValue(?string $verificationValue): self
    {
        $self = clone $this;
        $self['verificationValue'] = $verificationValue;

        return $self;
    }
}
