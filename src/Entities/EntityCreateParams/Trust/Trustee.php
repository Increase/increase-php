<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams\Trust;

use Increase\Core\Attributes\Optional;
use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityCreateParams\Trust\Trustee\Individual;
use Increase\Entities\EntityCreateParams\Trust\Trustee\Structure;

/**
 * @phpstan-import-type IndividualShape from \Increase\Entities\EntityCreateParams\Trust\Trustee\Individual
 *
 * @phpstan-type TrusteeShape = array{
 *   structure: Structure|value-of<Structure>,
 *   individual?: null|Individual|IndividualShape,
 * }
 */
final class Trustee implements BaseModel
{
    /** @use SdkModel<TrusteeShape> */
    use SdkModel;

    /**
     * The structure of the trustee.
     *
     * @var value-of<Structure> $structure
     */
    #[Required(enum: Structure::class)]
    public string $structure;

    /**
     * Details of the individual trustee. Within the trustee object, this is required if `structure` is equal to `individual`.
     */
    #[Optional]
    public ?Individual $individual;

    /**
     * `new Trustee()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Trustee::with(structure: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Trustee)->withStructure(...)
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
     * @param Structure|value-of<Structure> $structure
     * @param Individual|IndividualShape|null $individual
     */
    public static function with(
        Structure|string $structure,
        Individual|array|null $individual = null
    ): self {
        $self = new self;

        $self['structure'] = $structure;

        null !== $individual && $self['individual'] = $individual;

        return $self;
    }

    /**
     * The structure of the trustee.
     *
     * @param Structure|value-of<Structure> $structure
     */
    public function withStructure(Structure|string $structure): self
    {
        $self = clone $this;
        $self['structure'] = $structure;

        return $self;
    }

    /**
     * Details of the individual trustee. Within the trustee object, this is required if `structure` is equal to `individual`.
     *
     * @param Individual|IndividualShape $individual
     */
    public function withIndividual(Individual|array $individual): self
    {
        $self = clone $this;
        $self['individual'] = $individual;

        return $self;
    }
}
