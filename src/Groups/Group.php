<?php

declare(strict_types=1);

namespace Increase\Groups;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Groups\Group\ACHDebitStatus;
use Increase\Groups\Group\ActivationStatus;
use Increase\Groups\Group\Type;

/**
 * Groups represent organizations using Increase. You can retrieve information about your own organization via the API. More commonly, OAuth platforms can retrieve information about the organizations that have granted them access. Learn more about OAuth [here](https://increase.com/documentation/oauth).
 *
 * @phpstan-type GroupShape = array{
 *   id: string,
 *   achDebitStatus: ACHDebitStatus|value-of<ACHDebitStatus>,
 *   activationStatus: ActivationStatus|value-of<ActivationStatus>,
 *   createdAt: \DateTimeInterface,
 *   type: Type|value-of<Type>,
 * }
 */
final class Group implements BaseModel
{
    /** @use SdkModel<GroupShape> */
    use SdkModel;

    /**
     * The Group identifier.
     */
    #[Required]
    public string $id;

    /**
     * If the Group is allowed to create ACH debits.
     *
     * @var value-of<ACHDebitStatus> $achDebitStatus
     */
    #[Required('ach_debit_status', enum: ACHDebitStatus::class)]
    public string $achDebitStatus;

    /**
     * If the Group is activated or not.
     *
     * @var value-of<ActivationStatus> $activationStatus
     */
    #[Required('activation_status', enum: ActivationStatus::class)]
    public string $activationStatus;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Group was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * A constant representing the object's type. For this resource it will always be `group`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new Group()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Group::with(
     *   id: ..., achDebitStatus: ..., activationStatus: ..., createdAt: ..., type: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Group)
     *   ->withID(...)
     *   ->withACHDebitStatus(...)
     *   ->withActivationStatus(...)
     *   ->withCreatedAt(...)
     *   ->withType(...)
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
     * @param ACHDebitStatus|value-of<ACHDebitStatus> $achDebitStatus
     * @param ActivationStatus|value-of<ActivationStatus> $activationStatus
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        ACHDebitStatus|string $achDebitStatus,
        ActivationStatus|string $activationStatus,
        \DateTimeInterface $createdAt,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['achDebitStatus'] = $achDebitStatus;
        $self['activationStatus'] = $activationStatus;
        $self['createdAt'] = $createdAt;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The Group identifier.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * If the Group is allowed to create ACH debits.
     *
     * @param ACHDebitStatus|value-of<ACHDebitStatus> $achDebitStatus
     */
    public function withACHDebitStatus(
        ACHDebitStatus|string $achDebitStatus
    ): self {
        $self = clone $this;
        $self['achDebitStatus'] = $achDebitStatus;

        return $self;
    }

    /**
     * If the Group is activated or not.
     *
     * @param ActivationStatus|value-of<ActivationStatus> $activationStatus
     */
    public function withActivationStatus(
        ActivationStatus|string $activationStatus
    ): self {
        $self = clone $this;
        $self['activationStatus'] = $activationStatus;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Group was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `group`.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
