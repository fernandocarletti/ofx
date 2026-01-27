# PHP OFX

> **Disclaimer:** This library was built entirely using [OpenCode](https://opencode.ai) and Claude Opus 4.5.

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![PHP Version](https://img.shields.io/badge/PHP-8.4%2B-777BB4.svg)](https://php.net)
[![Tests](https://img.shields.io/badge/Tests-283%20passing-brightgreen.svg)]()

A modern, object-oriented PHP parser for Open Financial Exchange (OFX) files. Supports both OFX v1 (SGML) and OFX v2 (XML) formats with human-friendly property names and full type safety.

## Features

- **Dual Format Support** - Parses both OFX v1 (SGML) and v2 (XML) formats
- **Complete OFX Coverage** - Supports all major OFX domains: banking, credit cards, investments, bill pay, transfers, tax forms, and more
- **Human-Friendly API** - Property names like `transactionId` and `accountNumber` instead of cryptic OFX tags like `TRNUID` and `ACCTID`
- **Modern PHP** - Built for PHP 8.4+ using property hooks and strict typing
- **Fully Typed** - Complete type declarations for IDE autocompletion and static analysis
- **Zero Dependencies** - Only requires standard PHP extensions

## Installation

```bash
composer require fernandocarletti/ofx
```

## Quick Start

```php
use Ofx\Parser;

$parser = new Parser();
$ofx = $parser->parseFile('/path/to/statement.ofx');

// Access bank statement transactions
$bankMessages = $ofx->bankMessagesResponseV1;
$statement = $bankMessages->statementTransactionResponses[0]->statementResponse;

foreach ($statement->transactionList->transactions as $transaction) {
    echo sprintf(
        "%s: %s %s\n",
        $transaction->datePosted->format('Y-m-d'),
        $transaction->name,
        $transaction->amount
    );
}

// Check balances
echo "Ledger Balance: " . $statement->ledgerBalance->amount . "\n";
echo "Available Balance: " . $statement->availableBalance->amount . "\n";
```

## Usage Examples

### Parsing Bank Statements

```php
use Ofx\Parser;

$parser = new Parser();
$ofx = $parser->parseFile('bank_statement.ofx');

$statement = $ofx->bankMessagesResponseV1
    ->statementTransactionResponses[0]
    ->statementResponse;

// Account information
$account = $statement->bankAccount;
echo "Routing: " . $account->routingNumber . "\n";
echo "Account: " . $account->accountId . "\n";
echo "Type: " . $account->accountType->value . "\n"; // CHECKING, SAVINGS, etc.

// Transaction details
foreach ($statement->transactionList->transactions as $txn) {
    echo sprintf(
        "[%s] %s - %s (%s)\n",
        $txn->type->value,           // CREDIT, DEBIT, CHECK, etc.
        $txn->transactionId,
        $txn->name,
        $txn->amount
    );
    
    if ($txn->isDebit()) {
        echo "  This was a debit transaction\n";
    }
    
    if ($txn->checkNumber !== null) {
        echo "  Check #" . $txn->checkNumber . "\n";
    }
}
```

### Parsing Credit Card Statements

```php
$ofx = $parser->parseFile('credit_card.ofx');

$statement = $ofx->creditCardMessagesResponseV1
    ->statementTransactionResponses[0]
    ->creditCardStatementResponse;

// Credit card account
echo "Card: " . $statement->creditCardAccount->accountId . "\n";

// Transactions
foreach ($statement->transactionList->transactions as $txn) {
    echo $txn->datePosted->format('M d') . ": ";
    echo $txn->name . " " . $txn->amount . "\n";
}

// Balances
echo "Current Balance: " . $statement->ledgerBalance->amount . "\n";
echo "Available Credit: " . $statement->availableBalance->amount . "\n";
```

### Parsing Investment Statements

```php
$ofx = $parser->parseFile('investment.ofx');

$statement = $ofx->investmentMessagesResponseV1
    ->statementTransactionResponses[0]
    ->investmentStatementResponse;

// Investment account
$account = $statement->investmentAccount;
echo "Broker ID: " . $account->brokerId . "\n";
echo "Account: " . $account->accountId . "\n";

// Positions
foreach ($statement->positionList->positions as $position) {
    echo sprintf(
        "%s: %s units @ %s\n",
        $position->securityId->uniqueId,
        $position->units,
        $position->unitPrice
    );
}

// Investment transactions (buys, sells, dividends, etc.)
$txnList = $statement->investmentTransactionList;
foreach ($txnList->buyStock ?? [] as $buy) {
    echo "BUY: " . $buy->securityId->uniqueId . "\n";
}
```

### Accessing Header Information

```php
$ofx = $parser->parseFile('statement.ofx');

// Header is available after parsing
$header = $parser->parsedHeader;

echo "OFX Version: " . $header->version . "\n";       // 102, 160, 200, 220, etc.
echo "Is v1 (SGML): " . ($header->isVersion1 ? 'Yes' : 'No') . "\n";
echo "Is v2 (XML): " . ($header->isVersion2 ? 'Yes' : 'No') . "\n";
echo "Encoding: " . $header->encoding . "\n";         // UTF-8, Windows-1252, etc.
```

### Parsing from Different Sources

```php
// From file path
$ofx = $parser->parseFile('/path/to/file.ofx');

// From string content
$content = file_get_contents('statement.ofx');
$ofx = $parser->parseString($content);

// From stream resource
$stream = fopen('statement.ofx', 'r');
$ofx = $parser->parseStream($stream);
fclose($stream);
```

### Checking Signon Status

```php
$ofx = $parser->parseFile('statement.ofx');

$signon = $ofx->signonMessagesResponseV1->signonResponse;

if ($signon->status->isSuccess()) {
    echo "Signed on successfully\n";
    echo "Server date: " . $signon->serverDate->format('Y-m-d H:i:s') . "\n";
    echo "Language: " . $signon->language->value . "\n";
    
    if ($signon->financialInstitution !== null) {
        echo "FI: " . $signon->financialInstitution->organization . "\n";
    }
} else {
    echo "Signon failed: " . $signon->status->code . "\n";
    echo "Message: " . $signon->status->message . "\n";
}
```

## Supported OFX Domains

| Domain | Request | Response | Description |
|--------|---------|----------|-------------|
| **Signon** | `signonMessagesRequestV1` | `signonMessagesResponseV1` | Authentication and session management |
| **Signup** | `signupMessagesRequestV1` | `signupMessagesResponseV1` | Account enrollment and information |
| **Bank** | `bankMessagesRequestV1` | `bankMessagesResponseV1` | Bank account statements and transactions |
| **Credit Card** | `creditCardMessagesRequestV1` | `creditCardMessagesResponseV1` | Credit card statements and transactions |
| **Investment** | `investmentMessagesRequestV1` | `investmentMessagesResponseV1` | Brokerage statements, positions, trades |
| **Security List** | `securityListMessagesRequestV1` | `securityListMessagesResponseV1` | Security (stock/fund/bond) information |
| **Profile** | `profileMessagesRequestV1` | `profileMessagesResponseV1` | Financial institution capabilities |
| **Email** | `emailMessagesRequestV1` | `emailMessagesResponseV1` | Secure messaging with FI |
| **Bill Pay** | `billPayMessagesRequestV1` | `billPayMessagesResponseV1` | Bill payment and payee management |
| **Interbank Transfer** | `interbankTransferMessagesRequestV1` | `interbankTransferMessagesResponseV1` | Transfers between institutions |
| **Wire Transfer** | `wireTransferMessagesRequestV1` | `wireTransferMessagesResponseV1` | Wire transfer processing |
| **Tax 1099** | `tax1099MessagesRequestV1` | `tax1099MessagesResponseV1` | Tax form 1099 variants (INT, DIV, B, R, etc.) |

## Requirements

- PHP 8.4 or higher
- Extensions: `simplexml`, `libxml`, `bcmath`, `mbstring`

## Development

```bash
# Install dependencies
composer install

# Run tests
composer test

# Run static analysis
composer analyse

# Check code style
composer cs-check

# Fix code style
composer cs-fix
```

## License

This library is open-sourced software licensed under the [MIT license](LICENSE).
