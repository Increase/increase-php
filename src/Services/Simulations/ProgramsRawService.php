<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\Programs\Program;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\ProgramsRawContract;
use Increase\Simulations\Programs\ProgramCreateParams;
use Increase\Simulations\Programs\ProgramCreateParams\Bank;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class ProgramsRawService implements ProgramsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates a [Program](#programs) being created in your group. By default, your group has one program called Commercial Banking. Note that when your group operates more than one program, `program_id` is a required field when creating accounts.
     *
     * @param array{
     *   name: string,
     *   bank?: value-of<Bank>,
     *   lendingMaximumExtendableCredit?: int,
     *   reserveAccountID?: string,
     * }|ProgramCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Program>
     *
     * @throws APIException
     */
    public function create(
        array|ProgramCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProgramCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/programs',
            body: (object) $parsed,
            options: $options,
            convert: Program::class,
        );
    }
}
