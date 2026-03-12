<?php

declare(strict_types=1);

namespace Increase\BeneficialOwners;

use Increase\BeneficialOwners\EntityBeneficialOwner\Individual;
use Increase\BeneficialOwners\EntityBeneficialOwner\Prong;
use Increase\BeneficialOwners\EntityBeneficialOwner\Type;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;

/**
 * Beneficial owners are the individuals who control or own 25% or more of a `corporation` entity. Beneficial owners are always people, and never organizations. Generally, you will need to submit between 1 and 5 beneficial owners for every `corporation` entity. You should update and archive beneficial owners for a corporation entity as their details change.
 *
 * @phpstan-import-type IndividualShape from \Increase\BeneficialOwners\EntityBeneficialOwner\Individual
 *
 * @phpstan-type EntityBeneficialOwnerShape = array{
 *   id: string,
 *   companyTitle: string|null,
 *   createdAt: \DateTimeInterface,
 *   individual: Individual|IndividualShape,
 *   prongs: list<Prong|value-of<Prong>>,
 *   type: Type|value-of<Type>,
 * }
 */
final class EntityBeneficialOwner implements BaseModel
{
    /** @use SdkModel<EntityBeneficialOwnerShape> */
    use SdkModel;

    /**
     * The identifier of this beneficial owner.
     */
    #[Required]
    public string $id;

    /**
     * This person's role or title within the entity.
     */
    #[Required('company_title')]
    public ?string $companyTitle;

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Beneficial Owner was created.
     */
    #[Required('created_at')]
    public \DateTimeInterface $createdAt;

    /**
     * Personal details for the beneficial owner.
     */
    #[Required]
    public Individual $individual;

    /**
     * Why this person is considered a beneficial owner of the entity.
     *
     * @var list<value-of<Prong>> $prongs
     */
    #[Required(list: Prong::class)]
    public array $prongs;

    /**
     * A constant representing the object's type. For this resource it will always be `entity_beneficial_owner`.
     *
     * @var value-of<Type> $type
     */
    #[Required(enum: Type::class)]
    public string $type;

    /**
     * `new EntityBeneficialOwner()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * EntityBeneficialOwner::with(
     *   id: ...,
     *   companyTitle: ...,
     *   createdAt: ...,
     *   individual: ...,
     *   prongs: ...,
     *   type: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new EntityBeneficialOwner)
     *   ->withID(...)
     *   ->withCompanyTitle(...)
     *   ->withCreatedAt(...)
     *   ->withIndividual(...)
     *   ->withProngs(...)
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
     * @param Individual|IndividualShape $individual
     * @param list<Prong|value-of<Prong>> $prongs
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $id,
        ?string $companyTitle,
        \DateTimeInterface $createdAt,
        Individual|array $individual,
        array $prongs,
        Type|string $type,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['companyTitle'] = $companyTitle;
        $self['createdAt'] = $createdAt;
        $self['individual'] = $individual;
        $self['prongs'] = $prongs;
        $self['type'] = $type;

        return $self;
    }

    /**
     * The identifier of this beneficial owner.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * This person's role or title within the entity.
     */
    public function withCompanyTitle(?string $companyTitle): self
    {
        $self = clone $this;
        $self['companyTitle'] = $companyTitle;

        return $self;
    }

    /**
     * The [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) time at which the Beneficial Owner was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * Personal details for the beneficial owner.
     *
     * @param Individual|IndividualShape $individual
     */
    public function withIndividual(Individual|array $individual): self
    {
        $self = clone $this;
        $self['individual'] = $individual;

        return $self;
    }

    /**
     * Why this person is considered a beneficial owner of the entity.
     *
     * @param list<Prong|value-of<Prong>> $prongs
     */
    public function withProngs(array $prongs): self
    {
        $self = clone $this;
        $self['prongs'] = $prongs;

        return $self;
    }

    /**
     * A constant representing the object's type. For this resource it will always be `entity_beneficial_owner`.
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
