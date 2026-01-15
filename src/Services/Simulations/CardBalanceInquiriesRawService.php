<?php

declare(strict_types=1);

namespace Increase\Services\Simulations;

use Increase\CardPayments\CardPayment;
use Increase\Client;
use Increase\Core\Contracts\BaseResponse;
use Increase\Core\Exceptions\APIException;
use Increase\RequestOptions;
use Increase\ServiceContracts\Simulations\CardBalanceInquiriesRawContract;
use Increase\Simulations\CardBalanceInquiries\CardBalanceInquiryCreateParams;
use Increase\Simulations\CardBalanceInquiries\CardBalanceInquiryCreateParams\DeclineReason;
use Increase\Simulations\CardBalanceInquiries\CardBalanceInquiryCreateParams\NetworkDetails;

/**
 * @phpstan-import-type NetworkDetailsShape from \Increase\Simulations\CardBalanceInquiries\CardBalanceInquiryCreateParams\NetworkDetails
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
final class CardBalanceInquiriesRawService implements CardBalanceInquiriesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Simulates a balance inquiry on a [Card](#cards).
     *
     * @param array{
     *   balance?: int,
     *   cardID?: string,
     *   declineReason?: value-of<DeclineReason>,
     *   digitalWalletTokenID?: string,
     *   eventSubscriptionID?: string,
     *   merchantAcceptorID?: string,
     *   merchantCategoryCode?: string,
     *   merchantCity?: string,
     *   merchantCountry?: string,
     *   merchantDescriptor?: string,
     *   merchantState?: string,
     *   networkDetails?: NetworkDetails|NetworkDetailsShape,
     *   networkRiskScore?: int,
     *   physicalCardID?: string,
     *   terminalID?: string,
     * }|CardBalanceInquiryCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CardPayment>
     *
     * @throws APIException
     */
    public function create(
        array|CardBalanceInquiryCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CardBalanceInquiryCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'simulations/card_balance_inquiries',
            body: (object) $parsed,
            options: $options,
            convert: CardPayment::class,
        );
    }
}
