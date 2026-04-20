<?php

declare(strict_types=1);

namespace Increase\BeneficialOwners;

use Increase\BeneficialOwners\BeneficialOwnerCreateParams\Individual;
use Increase\BeneficialOwners\BeneficialOwnerCreateParams\Prong;
use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Concerns\SdkParams;
use Increase\Core\Contracts\BaseModel;

/**
 * Create a Beneficial Owner.
 *
 * @see Increase\Services\BeneficialOwnersService::create()
 *
 * @phpstan-import-type IndividualShape from \Increase\BeneficialOwners\BeneficialOwnerCreateParams\Individual
 *
 * @phpstan-type BeneficialOwnerCreateParamsShape = array{
 *   entityID: string,
 *   individual: Individual|IndividualShape,
 *   prongs: list<Prong|value-of<Prong>>,
 *   companyTitle?: string|null,
 * }
 */
final class BeneficialOwnerCreateParams implements BaseModel
{
    /** @use SdkModel<BeneficialOwnerCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The identifier of the Entity to associate with the new Beneficial Owner.
     */
    #[Required('entity_id')]
    public string $entityID;

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
     * `new BeneficialOwnerCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BeneficialOwnerCreateParams::with(entityID: ..., individual: ..., prongs: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BeneficialOwnerCreateParams)
     *   ->withEntityID(...)
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
        string $entityID,
        Individual|array $individual,
        array $prongs,
        ?string $companyTitle = null,
    ): self {
        $self = new self;

        $self['entityID'] = $entityID;
        $self['individual'] = $individual;
        $self['prongs'] = $prongs;

        null !== $companyTitle && $self['companyTitle'] = $companyTitle;

        return $self;
    }

    /**
     * The identifier of the Entity to associate with the new Beneficial Owner.
     */
    public function withEntityID(string $entityID): self
    {
        $self = clone $this;
        $self['entityID'] = $entityID;

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
