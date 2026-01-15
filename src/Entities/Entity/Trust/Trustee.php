<?php

declare(strict_types=1);

namespace Increase\Entities\Entity\Trust;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\Entity\Trust\Trustee\Individual;
use Increase\Entities\Entity\Trust\Trustee\Structure;

/**
 * @phpstan-import-type IndividualShape from \Increase\Entities\Entity\Trust\Trustee\Individual
 *
 * @phpstan-type TrusteeShape = array{
 *   individual: null|Individual|IndividualShape,
 *   structure: Structure|value-of<Structure>,
 * }
 */
final class Trustee implements BaseModel
{
    /** @use SdkModel<TrusteeShape> */
    use SdkModel;

    /**
     * The individual trustee of the trust. Will be present if the trustee's `structure` is equal to `individual`.
     */
    #[Required]
    public ?Individual $individual;

    /**
     * The structure of the trustee. Will always be equal to `individual`.
     *
     * @var value-of<Structure> $structure
     */
    #[Required(enum: Structure::class)]
    public string $structure;

    /**
     * `new Trustee()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Trustee::with(individual: ..., structure: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Trustee)->withIndividual(...)->withStructure(...)
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
     * @param Individual|IndividualShape|null $individual
     * @param Structure|value-of<Structure> $structure
     */
    public static function with(
        Individual|array|null $individual,
        Structure|string $structure
    ): self {
        $self = new self;

        $self['individual'] = $individual;
        $self['structure'] = $structure;

        return $self;
    }

    /**
     * The individual trustee of the trust. Will be present if the trustee's `structure` is equal to `individual`.
     *
     * @param Individual|IndividualShape|null $individual
     */
    public function withIndividual(Individual|array|null $individual): self
    {
        $self = clone $this;
        $self['individual'] = $individual;

        return $self;
    }

    /**
     * The structure of the trustee. Will always be equal to `individual`.
     *
     * @param Structure|value-of<Structure> $structure
     */
    public function withStructure(Structure|string $structure): self
    {
        $self = clone $this;
        $self['structure'] = $structure;

        return $self;
    }
}
