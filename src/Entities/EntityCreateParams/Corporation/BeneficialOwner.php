<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams\Corporation;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityCreateParams\Corporation\BeneficialOwner\Individual;
use Increase\Entities\EntityCreateParams\Corporation\BeneficialOwner\Prong;

/**
 * @phpstan-import-type IndividualShape from \Increase\Entities\EntityCreateParams\Corporation\BeneficialOwner\Individual
 *
 * @phpstan-type BeneficialOwnerShape = array{
 *   individual: Individual|IndividualShape,
 *   prongs: list<Prong|value-of<Prong>>,
 *   companyTitle?: string|null,
 * }
 */
final class BeneficialOwner implements BaseModel
{
    /** @use SdkModel<BeneficialOwnerShape> */
    use SdkModel;

    /**
     * Personal details for the beneficial owner.
     */
    #[Required]
    public Individual $individual;

    /**
     * Why this person is considered a beneficial owner of the entity. At least one option is required, if a person is both a control person and owner, submit an array containing both.
     *
     * @var list<value-of<Prong>> $prongs
     */
    #[Required(list: Prong::class)]
    public array $prongs;

    /**
     * This person's role or title within the entity.
     */
    #[Optional('company_title')]
    public ?string $companyTitle;

    /**
     * `new BeneficialOwner()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BeneficialOwner::with(individual: ..., prongs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BeneficialOwner)->withIndividual(...)->withProngs(...)
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
        Individual|array $individual,
        array $prongs,
        ?string $companyTitle = null
    ): self {
        $self = new self;

        $self['individual'] = $individual;
        $self['prongs'] = $prongs;

        null !== $companyTitle && $self['companyTitle'] = $companyTitle;

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
     * Why this person is considered a beneficial owner of the entity. At least one option is required, if a person is both a control person and owner, submit an array containing both.
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
     * This person's role or title within the entity.
     */
    public function withCompanyTitle(string $companyTitle): self
    {
        $self = clone $this;
        $self['companyTitle'] = $companyTitle;

        return $self;
    }
}
