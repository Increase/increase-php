<?php

declare(strict_types=1);

namespace Increase\Entities\EntityCreateParams;

use Increase\Core\Attributes\Required;
use Increase\Core\Concerns\SdkModel;
use Increase\Core\Contracts\BaseModel;
use Increase\Entities\EntityCreateParams\Joint\Individual;

/**
 * Details of the joint entity to create. Required if `structure` is equal to `joint`.
 *
 * @phpstan-import-type IndividualShape from \Increase\Entities\EntityCreateParams\Joint\Individual
 *
 * @phpstan-type JointShape = array{individuals: list<Individual|IndividualShape>}
 */
final class Joint implements BaseModel
{
    /** @use SdkModel<JointShape> */
    use SdkModel;

    /**
     * The two individuals that share control of the entity.
     *
     * @var list<Individual> $individuals
     */
    #[Required(list: Individual::class)]
    public array $individuals;

    /**
     * `new Joint()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Joint::with(individuals: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Joint)->withIndividuals(...)
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
     * @param list<Individual|IndividualShape> $individuals
     */
    public static function with(array $individuals): self
    {
        $self = new self;

        $self['individuals'] = $individuals;

        return $self;
    }

    /**
     * The two individuals that share control of the entity.
     *
     * @param list<Individual|IndividualShape> $individuals
     */
    public function withIndividuals(array $individuals): self
    {
        $self = clone $this;
        $self['individuals'] = $individuals;

        return $self;
    }
}
