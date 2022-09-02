# Jojka SDK for PHP

This repository contains the open source PHP SDK that allows you to access the Jojka REST API from your PHP app.

## Installation

The Jojka PHP SDK can be installed with [Composer](https://getcomposer.org/). Run this command:

```sh
composer require macure/jojka-sdk
```

## Usage
> **Note:** This version of the Jojka SDK for PHP requires PHP 7.2.5 or greater.

API key is required for API calls. Please make sure you accquire the key before using the library.

```php
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$sdk = new \Macure\JojkaSDK\JojkaSDK([
	'API_key' => '{app-key}'
]);
```
### Campaign service
With campaign service you can add and cancel campaign and get campaign recipient status. 
```php
use Macure\JojkaSDK\Http\Requests\AddCampaignRequest;
use Macure\JojkaSDK\Http\Requests\CancelCampaignRequest;
use Macure\JojkaSDK\Http\Requests\GetCampaignRecipientsStatusRequest;

// add campaign
$response = $sdk->campaign->addCampaign([
    AddCampaignRequest::TO_MSISDN => '46709771337;46709966666',
    AddCampaignRequest::MSG       => 'hello',
    AddCampaignRequest::SCHEDULED => '2016-05-31 12:18:52',
    AddCampaignRequest::NAME      => 'test campaign'
]);

// cancel campaign
$response = $sdk->campaign->cancelCampaign([
    CancelCampaignRequest::CAMPAIGN_ID => 287359
]);

// get campaign recipients status
$response = $sdk->campaign->getCampaignRecipientsStatus([
    GetCampaignRecipientsStatusRequest::CAMPAIGN_ID => 287359
]);
```

### Contact service
With contact service you can add or remove contact, add or remove contact from group, import and export contact list, add and remove from blocklist. 
```php
use Macure\JojkaSDK\Http\Requests\AddContactRequest;
use Macure\JojkaSDK\Http\Requests\InBlocklistRequest;
use Macure\JojkaSDK\Http\Requests\RemoveContactRequest;
use Macure\JojkaSDK\Http\Requests\AddToBlocklistRequest;
use Macure\JojkaSDK\Http\Requests\AddContactToGroupRequest;
use Macure\JojkaSDK\Http\Requests\ExportContactsListRequest;
use Macure\JojkaSDK\Http\Requests\ImportContactsListRequest;
use Macure\JojkaSDK\Http\Requests\GetGroupsFromMsisdnRequest;
use Macure\JojkaSDK\Http\Requests\RemoveFromBlocklistRequest;
use Macure\JojkaSDK\Http\Requests\RemoveContactFromGroupRequest;

// add contact
$response = $sdk->contact->addContact([
    AddContactRequest::MSISDN => '46709771337',
    AddContactRequest::NAME   => 'Lilleman',
    AddContactRequest::GROUP  => 'Utvecklare;Jojka personal'
]);

// remove contact
$response = $sdk->contact->removeContact([
    RemoveContactRequest::MSISDN => '46709771337'
]);

// add to group
$response = $sdk->contact->addContactToGroup([
    AddContactToGroupRequest::MSISDN => '46709771337',
    AddContactToGroupRequest::GROUP  => 'gruppnamn2'
]);

// remove from group
$response = $sdk->contact->removeContactFromGroup([
    RemoveContactFromGroupRequest::MSISDN => '46709771337',
    RemoveContactFromGroupRequest::GROUP  => 'Utvecklare'
]);

// import contacts
$response = $sdk->contact->importContactsList([
    ImportContactsListRequest::CONTACTS_LIST => [
        [
            'msisdn' => '46709771337',
            'name'   => 'Lilleman',
            'groups' => ['Utvecklare', 'Jojka personal 46709966666', 'Rutger', 'Lindquist', 'VD']
        ]
    ]
]);

// export contacts
$response = $sdk->contact->exportContactsList([
    ExportContactsListRequest::MAX    => 100,
    ExportContactsListRequest::OFFSET => 0
]);

// get groups from msisdn
$response = $sdk->contact->getGroupsFromMsisdn([
    GetGroupsFromMsisdnRequest::MSISDN => '46709771337'
]);

// add to blocklist
$response = $sdk->contact->addToBlocklist([
    AddToBlocklistRequest::MSISDN => '46709771337'
]);

// remove from blocklist
$response = $sdk->contact->removeFromBlocklist([
    RemoveFromBlocklistRequest::MSISDN => '46709771337'
]);

// in blocklist
$response = $sdk->contact->inBlocklist([
    InBlocklistRequest::MSISDN => '46709771337'
]);
```

### Message service
With message service you can fetch replies, get message ids by campaign, get message status and send the message. 
```php
use Macure\JojkaSDK\Http\Requests\SendRequest;$response
use Macure\JojkaSDK\Http\Requests\FetchRepliesRequest;
use Macure\JojkaSDK\Http\Requests\GetMessageStatusRequest;
use Macure\JojkaSDK\Http\Requests\GetMessageIdsByCampaignIdRequest;

// fetch replies
$response = $sdk->message->fetchReplies([
    FetchRepliesRequest::FROM_MSISDN => '46709771337',
    FetchRepliesRequest::SINCE_TIME  => '2016-05-31 13:00:06'
]);

// get message ids by campaign id
$response = $sdk->message->getMessageIdsByCampaignId([
    GetMessageIdsByCampaignIdRequest::CAMPAIGN_ID => 287359
]);

// get message status
$response = $sdk->message->getMessageStatus([
    GetMessageStatusRequest::MSG_ID => '6223c1c6079e9c21b5901d63',
]);

// send
$response = $sdk->message->send([
    SendRequest::TO  => '46709771337',
    SendRequest::MSG => 'hello world'
]);
```
### Responses
All service calls return instance of \Macure\JojkaSDK\Http\Response.
```php
namespace Macure\JojkaSDK\Http\Response;

use GuzzleHttp\Psr7\Response as Psr7Response;

class Response extends Psr7Response {}
```
The method **"deserialize"** in Response class deserialize API response and maps it to appropriate models, objects, arrays and etc so it can be easily used in any application.

```php
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

use Macure\JojkaSDK\Models\Contact;
use Macure\JojkaSDK\Http\Response\ContactListResponse;
use Macure\JojkaSDK\Http\Requests\ImportContactsListRequest;

$sdk = new \Macure\JojkaSDK\JojkaSDK([
	'API_key' => '{app-key}'
]);

/**
 * @var ContactListResponse $response
 */
$response = $sdk->contacts->importContactsList([
    ImportContactsListRequest::CONTACTS_LIST => [
        [
            'msisdn' => '46709771337',
            'name'   => 'Lilleman',
            'groups' => ['Utvecklare', 'Jojka personal 46709966666', 'Rutger', 'Lindquist', 'VD']
        ]
    ]
]);

/**
 * @var Contact[] $contacts
 */
$contacts = $response->deserialize();

foreach ($contacts as $contact) {
    $name   = $contact->getName();
    $groups = $contact->getGroups();
}
```