# php-indexnow

**php-indexnow** is a PHP library for [IndexNow](https://indexnow.org) API.

## Example usage
```bash
composer require nemorize/indexnow
```
```php
$indexnow = new \Nemorize\Indexnow\Indexnow();
$indexnow->setKey('fc1e3ad82010475381daf9846e627fdd');
$indexnow->submit('https://example.com/url-changed');
$indexnow->submit([
    'https://example.com/url-changed',
    'https://example.com/url-changed-2'
]);
```

## Specification

### setHost
```php
Indexnow::setHost (string $host): void;
```
You can change the hostname of the API. If you don't set the hostname, the default host is `api.indexnow.org`.

### getHost
```php
Indexnow::getHost (): string;
```
Returns the hostname of the API.

### setKey
```php
Indexnow::setKey (string $key): void;
```
You can change the key of the API.

### getKey
```php
Indexnow::getKey (): string;
```
Returns the key of the API.

### setKeyLocation
```php
Indexnow::setKeyLocation (?string $keyLocation): void;
```
You can change the key location of the API. If you want to unset the key location, you can set `null`.

### getKeyLocation
```php
Indexnow::getKeyLocation (): ?string;
```
Returns the key location of the API.

### submit
```php
Indexnow::submit (string|array $url, array $guzzleOptions = null): void;
```
You can submit a URL to the API. If you use `$url` as an array, it will submit multiple URLs using JSON request.
`$guzzleOptions` is an array of options for [Guzzle](https://docs.guzzlephp.org/en/stable/quickstart.html#making-a-request).

#### Exceptions
`submit` method throws exceptions if some errors occur.
If the API throws well-known non-20x response codes, it will throw the following exceptions that extend `IndexnowException`.
Any other errors will throw `GuzzleException`.

- `BadRequestException`
- `ForbiddenException`
- `TooManyRequestsException`
- `UnprocessableEntityException`

## License
MIT License