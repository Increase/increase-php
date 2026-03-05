<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Corporation;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\Entity\Corporation\BeneficialOwner\Individual;
use Increase\Entities\Entity\Corporation\BeneficialOwner\Prong;

/**
 * @phpstan-import-type IndividualShape from \Increase\Entities\Entity\Corporation\BeneficialOwner\Individual
 *
 * @phpstan-type BeneficialOwnerShape = array{
 *   id: string,
 *   companyTitle: string|null,
 *   individual: Individual|IndividualShape,
 *   prongs: list<Prong|value-of<Prong>>,
 * }
 */
final class BeneficialOwner implements BaseModel
{
    /** @use SdkModel<BeneficialOwnerShape> */
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
     * `new BeneficialOwner()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BeneficialOwner::with(id: ..., companyTitle: ..., individual: ..., prongs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BeneficialOwner)
     *   ->withID(...)
     *   ->withCompanyTitle(...)
     *   ->withIndividual(...)
     *   ->withProngs(...)
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
     */
    public static function with(
        string $id,
        ?string $companyTitle,
        Individual|array $individual,
        array $prongs,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['companyTitle'] = $companyTitle;
        $self['individual'] = $individual;
        $self['prongs'] = $prongs;

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
}
