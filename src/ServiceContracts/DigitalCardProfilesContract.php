<?php

declare(strict_types=1);

namespace Increase\ServiceContracts;

use Increase\Core\Exceptions\APIException;
use Increase\DigitalCardProfiles\DigitalCardProfile;
use Increase\DigitalCardProfiles\DigitalCardProfileCreateParams\TextColor;
use Increase\DigitalCardProfiles\DigitalCardProfileListParams\Status;
use Increase\Page;
use Increase\RequestOptions;

/**
 * @phpstan-import-type TextColorShape from \Increase\DigitalCardProfiles\DigitalCardProfileCreateParams\TextColor
 * @phpstan-import-type StatusShape from \Increase\DigitalCardProfiles\DigitalCardProfileListParams\Status
 * @phpstan-import-type TextColorShape from \Increase\DigitalCardProfiles\DigitalCardProfileCloneParams\TextColor as TextColorShape1
 * @phpstan-import-type RequestOpts from \Increase\RequestOptions
 */
interface DigitalCardProfilesContract
{
    /**
     * @api
     *
     * @param string $appIconFileID the identifier of the File containing the card's icon image
     * @param string $backgroundImageFileID the identifier of the File containing the card's front image
     * @param string $cardDescription a user-facing description for the card itself
     * @param string $description a description you can use to identify the Card Profile
     * @param string $issuerName a user-facing description for whoever is issuing the card
     * @param string $contactEmail an email address the user can contact to receive support for their card
     * @param string $contactPhone a phone number the user can contact to receive support for their card
     * @param string $contactWebsite a website the user can visit to view and receive support for their card
     * @param TextColor|TextColorShape $textColor The Card's text color, specified as an RGB triple. The default is white.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $appIconFileID,
        string $backgroundImageFileID,
        string $cardDescription,
        string $description,
        string $issuerName,
        ?string $contactEmail = null,
        ?string $contactPhone = null,
        ?string $contactWebsite = null,
        TextColor|array|null $textColor = null,
        RequestOptions|array|null $requestOptions = null,
    ): DigitalCardProfile;

    /**
     * @api
     *
     * @param string $digitalCardProfileID the identifier of the Digital Card Profile
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $digitalCardProfileID,
        RequestOptions|array|null $requestOptions = null,
    ): DigitalCardProfile;

    /**
     * @api
     *
     * @param string $cursor return the page of entries after this one
     * @param string $idempotencyKey Filter records to the one with the specified `idempotency_key` you chose for that object. This value is unique across Increase and is used to ensure that a request is only processed once. Learn more about [idempotency](https://increase.com/documentation/idempotency-keys).
     * @param int $limit Limit the size of the list that is returned. The default (and maximum) is 100 objects.
     * @param Status|StatusShape $status
     * @param RequestOpts|null $requestOptions
     *
     * @return Page<DigitalCardProfile>
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?string $idempotencyKey = null,
        ?int $limit = null,
        Status|array|null $status = null,
        RequestOptions|array|null $requestOptions = null,
    ): Page;

    /**
     * @api
     *
     * @param string $digitalCardProfileID the identifier of the Digital Card Profile to archive
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $digitalCardProfileID,
        RequestOptions|array|null $requestOptions = null,
    ): DigitalCardProfile;

    /**
     * @api
     *
     * @param string $digitalCardProfileID the identifier of the Digital Card Profile to clone
     * @param string $appIconFileID the identifier of the File containing the card's icon image
     * @param string $backgroundImageFileID the identifier of the File containing the card's front image
     * @param string $cardDescription a user-facing description for the card itself
     * @param string $contactEmail an email address the user can contact to receive support for their card
     * @param string $contactPhone a phone number the user can contact to receive support for their card
     * @param string $contactWebsite a website the user can visit to view and receive support for their card
     * @param string $description a description you can use to identify the Card Profile
     * @param string $issuerName a user-facing description for whoever is issuing the card
     * @param \Increase\DigitalCardProfiles\DigitalCardProfileCloneParams\TextColor|TextColorShape1 $textColor The Card's text color, specified as an RGB triple. The default is white.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function clone(
        string $digitalCardProfileID,
        ?string $appIconFileID = null,
        ?string $backgroundImageFileID = null,
        ?string $cardDescription = null,
        ?string $contactEmail = null,
        ?string $contactPhone = null,
        ?string $contactWebsite = null,
        ?string $description = null,
        ?string $issuerName = null,
        \Increase\DigitalCardProfiles\DigitalCardProfileCloneParams\TextColor|array|null $textColor = null,
        RequestOptions|array|null $requestOptions = null,
    ): DigitalCardProfile;
}
