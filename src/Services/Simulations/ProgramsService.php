<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\Client;
use Increase\Core\Exceptions\APIException;
use Increase\Core\Util;
use Increase\Programs\Program;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\ProgramsContract;
use Increase\Simulations\Programs\ProgramCreateParams\Bank;

/**
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class ProgramsService implements ProgramsContract
{
    /**
     * @api
     */
    public ProgramsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ProgramsRawService($client);
    }

    /**
     * @api
     *
     * Simulates a [Program](#programs) being created in your group. By default, your group has one program called Commercial Banking. Note that when your group operates more than one program, `program_id` is a required field when creating accounts.
     *
     * @param string $name the name of the program being added
     * @param Bank|value-of<Bank> $bank the bank for the program's accounts, defaults to First Internet Bank
     * @param int $lendingMaximumExtendableCredit the maximum extendable credit of the program being added
     * @param string $reserveAccountID the identifier of the Account the Program should be added to is for
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        Bank|string|null $bank = null,
        ?int $lendingMaximumExtendableCredit = null,
        ?string $reserveAccountID = null,
        RequestOptions|array|null $requestOptions = null,
    ): Program {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'bank' => $bank,
                'lendingMaximumExtendableCredit' => $lendingMaximumExtendableCredit,
                'reserveAccountID' => $reserveAccountID,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
