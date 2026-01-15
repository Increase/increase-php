<?php

declare(strict_types=1);

namespace Increase\DigitalWalletTokens\DigitalWalletToken;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\DigitalWalletTokens\DigitalWalletToken\Update\Status;

/**
 * @phpstan-type UpdateShape = array{
 *   status: \Increase\DigitalWalletTokens\DigitalWalletToken\Update\Status|value-of<\Increase\DigitalWalletTokens\DigitalWalletToken\Update\Status>,
 *   timestamp: \DateTimeInterface,
 * }
 */
final class Update implements BaseModel
{
    /** @use SdkModel<UpdateShape> */
    use SdkModel;

    /**
     * The status the update changed this Digital Wallet Token to.
     *
     * @var value-of<Status> $status
     */
    #[Required(
        enum: Status::class
    )]
    public string $status;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the update happened.
     */
    #[Required]
    public \DateTimeInterface $timestamp;

    /**
     * `new Update()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Update::with(status: ..., timestamp: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Update)->withStatus(...)->withTimestamp(...)
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
     * @param Status|value-of<Status> $status
     */
    public static function with(
        Status|string $status,
        \DateTimeInterface $timestamp,
    ): self {
        $self = new self;

        $self['status'] = $status;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * The status the update changed this Digital Wallet Token to.
     *
     * @param Status|value-of<Status> $status
     */
    public function withStatus(
        Status|string $status,
    ): self {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date and time at which the update happened.
     */
    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }
}
