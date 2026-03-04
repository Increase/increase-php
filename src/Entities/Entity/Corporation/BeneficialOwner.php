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
 *   beneficialOwnerID: string,
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
    #[Required('beneficial_owner_id')]
    public string $beneficialOwnerID;

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
     * BeneficialOwner::with(
     *   beneficialOwnerID: ..., companyTitle: ..., individual: ..., prongs: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BeneficialOwner)
     *   ->withBeneficialOwnerID(...)
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
        string $beneficialOwnerID,
        ?string $companyTitle,
        Individual|array $individual,
        array $prongs,
    ): self {
        $self = new self;

        $self['beneficialOwnerID'] = $beneficialOwnerID;
        $self['companyTitle'] = $companyTitle;
        $self['individual'] = $individual;
        $self['prongs'] = $prongs;

        return $self;
    }

    /**
     * The identifier of this beneficial owner.
     */
    public function withBeneficialOwnerID(string $beneficialOwnerID): self
    {
        $self = clone $this;
        $self['beneficialOwnerID'] = $beneficialOwnerID;

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
