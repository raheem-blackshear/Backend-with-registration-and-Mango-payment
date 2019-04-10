
# SCS : Smart contract System

The purpose of this software is to build an online system to register merchant details and give a chance to the merchants to pay registration to our service.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them

```
PHP >= 7.1.3
OpenSSL PHP Extension
PDO PHP Extension
Mbstring PHP Extension
Tokenizer PHP Extension
XML PHP Extension
Ctype PHP Extension
JSON PHP Extension
BCMath PHP Extension
```

### Demo

```
You can try the live demo : http://scs.gatenetwork.it/
```

### Installing

A step by step series of examples that tell you how to get a development environemnt running

Say what the step will be

```
git clone https://github.com/dirurl foldername
cd foldername
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

And repeat

```
until finished
```


## Payment details
```
The payment platform used to manage transactions is MangoPay.
reference site: https://www.mangopay.com/
API for integration: https://docs.mangopay.com/
The transaction amount is fixed at € 100.


```


## Deployment

Add additional notes about how to deploy this on a live system:

```
Keep all the files and folders outside of the main root and just upload public files on main root. Demo site is on the subdomain so public files/folders are in scs.gatenetwork.it folder.

You can change the MangoPay payment settings in app->http->controllers->MerchantController.php



```

## Sandbox Payment Card Details

```
Use the below details for sandbox testing:
credit card detail for sandbox.
card number - 4970101122334414
expiry => any date from the future example 1221
cvv number => any 3 number example 123

```

## Payment setting in single wallet 

```
1. First you have to create a legal user on the mangopay production account and create a wallet for it. connect your bank details with that user and upload documents for KYC.
2.	After that copy the user id and user wallet id and paste it in the MerchantController.php =>
$this->legalUserId = "user-id";
$this->legalUserWalletId = "wallet-id";

```


## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

