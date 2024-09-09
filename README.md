## PHP validator

Simple class used to validate types and values.

- [License](#license)
- [Author](#author)
- [Requirements](#requirements)
- [Installation](#installation)
- [Documentation](#documentation)

## License

This project is open source and available under the [MIT License](LICENSE).

## Author

<img src="https://cdn1.onbayfront.com/bfm/brand/bfm-logo.svg" alt="Bayfront Media" width="250" />

- [Bayfront Media homepage](https://www.bayfrontmedia.com?utm_source=github&amp;utm_medium=direct)
- [Bayfront Media GitHub](https://github.com/bayfrontmedia)

## Requirements

* PHP `^8.0`

## Installation

```
composer require bayfrontmedia/php-validator
```

## Documentation

See [documentation](docs/README.md). 

**Example:**

```
use Bayfront\Validator\Validate;

$string = 'This is a string.';

if (!Validate::empty($string)) {
    // Do something
}
```

**Strings:**

- [empty](#empty)
- [matches](#matches)
- [minLength](#minlength)
- [maxLength](#maxlength)
- [lengthEquals](#lengthequals)
- [lengthBetween](#lengthbetween)
- [contains](#contains)
- [startsWith](#startswith)
- [endsWith](#endswith)
- [email](#email)
- [url](#url)
- [ip](#ip)
- [ipv4](#ipv4)
- [ipv6](#ipv6)
- [alpha](#alpha)
- [numeric](#numeric)
- [alphaNumeric](#alphanumeric)
- [date](#date)
- [uuid](#uuid)
- [uuidv4](#uuidv4)

**Integers:**

- [lessThan](#lessthan)
- [greaterThan](#greaterthan)
- [lessThanOrEqual](#lessthanorequal)
- [greaterThanOrEqual](#greaterthanorequal)
- [equals](#equals)
- [between](#between)

**Types:**

- [null](#null)
- [integer](#integer)
- [float](#float)
- [boolean](#boolean)
- [object](#object)
- [array](#array)
- [string](#string)
- [json](#json)

**Other:**

- [as](#as)

<hr />

### empty

**Description:**

Checks if string is empty.

**Parameters:**

- `$string` (string)

**Returns:**

- (bool)

<hr />

### matches

**Description:**

Checks if two strings match.

**Parameters:**

- `$string` (string)
- `$matches` (string)

**Returns:**

- (bool)

<hr />

### minLength

**Description:**

Checks if string length is greater than or equal to a given length.

**Parameters:**

- `$string` (string)
- `$length` (int)

**Returns:**

- (bool)

<hr />

### maxLength

**Description:**

Checks if string length is less than or equal to a given length.

**Parameters:**

- `$string` (string)
- `$length` (int)

**Returns:**

- (bool)

<hr />

### lengthEquals

**Description:**

Checks if string length is equal to a given length.

**Parameters:**

- `$string` (string)
- `$length` (int)

**Returns:**

- (bool)

<hr />

### lengthBetween

**Description:**

Checks if string length is between min and max length.

**Parameters:**

- `$string` (string)
- `$min` (int)
- `$max` (int)

**Returns:**

- (bool)

<hr />

### contains

**Description:**

Checks if string contains case-sensitive needle(s).

**Parameters:**

- `$string` (string)
- `$needles` (string|array)

**Returns:**

- (bool)

**Example:**

```
use Bayfront\Validator\Validate;

$string = 'This is a string.';

if (!Validate::contains($string, [
    'This',
    'is a'
])) {
    // Do something
}
```

<hr />

### startsWith

**Description:**

Checks if string begins with a given needle.

**Parameters:**

- `$string` (string)
- `$needle` (string)

**Returns:**

- (bool)

<hr />

### endsWith

**Description:**

Checks if string ends with a given needle.

**Parameters:**

- `$string` (string)
- `$needle` (string)

**Returns:**

- (bool)

<hr />

### email

**Description:**

Checks if string validates as email.

**Parameters:**

- `$string` (string)

**Returns:**

- (bool)

<hr />

### url

**Description:**

Checks if string validates as a URL.

**Parameters:**

- `$string` (string)

**Returns:**

- (bool)

<hr />

### ip

**Description:**

Checks if string validates as an IP address.

**Parameters:**

- `$string` (string)

**Returns:**

- (bool)

<hr />

### ipv4

**Description:**

Checks if string validates as an IPv4 address.

**Parameters:**

- `$string` (string)

**Returns:**

- (bool)

<hr />

### ipv6

**Description:**

Checks if string validates as an IPv6 address.

**Parameters:**

- `$string` (string)

**Returns:**

- (bool)

<hr />

### alpha

**Description:**

Checks if string only contains alpha characters.

**Parameters:**

- `$string` (string)

**Returns:**

- (bool)

<hr />

### numeric

**Description:**

Checks if string is numeric.

**Parameters:**

- `$string` (string)

**Returns:**

- (bool)

<hr />

### alphaNumeric

**Description:**

Checks if string only contains alphanumeric characters.

**Parameters:**

- `$string` (string)

**Returns:**

- (bool)

<hr />

### date

**Description:**

Checks if string is a valid date according to a given format.

See: [https://www.php.net/manual/en/datetime.format.php](https://www.php.net/manual/en/datetime.format.php)

**Parameters:**

- `$string` (string)
- `$format = 'Y-m-d H:i:s'` (string)

**Returns:**

- (bool)

<hr />

### uuid

**Description:**

Checks if string is a valid UUID.

**Parameters:**

- `$string` (string)

**Returns:**

- (bool)

<hr />

### uuidv4

**Description:**

Checks if string is a valid UUIDv4.

**Parameters:**

- `$string` (string)

**Returns:**

- (bool)

<hr />

### lessThan

**Description:**

Checks if value is less than a given number.

**Parameters:**

- `$value` (int)
- `$compare` (int)

**Returns:**

- (bool)

<hr />

### greaterThan

**Description:**

Checks if value is greater than a given number.

**Parameters:**

- `$value` (int)
- `$compare` (int)

**Returns:**

- (bool)

<hr />

### lessThanOrEqual

**Description:**

Checks if value is less than or equal to a given number.

**Parameters:**

- `$value` (int)
- `$compare` (int)

**Returns:**

- (bool)

<hr />

### greaterThanOrEqual

**Description:**

Checks if value is greater than or equal to a given number.

**Parameters:**

- `$value` (int)
- `$compare` (int)

**Returns:**

- (bool)

<hr />

### equals

**Description:**

Checks if values are equal.

**Parameters:**

- `$value` (int)
- `$compare` (int)

**Returns:**

- (bool)

<hr />

### between

**Description:**

Checks if value is between given min and max values.

**Parameters:**

- `$value` (int)
- `$min` (int)
- `$max` (int)

**Returns:**

- (bool)

<hr />

### null

**Description:**

Checks if value is `NULL`.

**Parameters:**

- `$value` (mixed)

**Returns:**

- (bool)

<hr />

### integer

**Description:**

Checks if value is an integer.

**Parameters:**

- `$value` (mixed)

**Returns:**

- (bool)

<hr />

### float

**Description:**

Checks if value is a float.

**Parameters:**

- `$value` (mixed)

**Returns:**

- (bool)

<hr />

### boolean

**Description:**

Checks if value is a boolean.

**Parameters:**

- `$value` (mixed)

**Returns:**

- (bool)

<hr />

### object

**Description:**

Checks if value is an object.

**Parameters:**

- `$value` (mixed)

**Returns:**

- (bool)

<hr />

### array

**Description:**

Checks if value is an array.

**Parameters:**

- `$value` (mixed)

**Returns:**

- (bool)

<hr />

### string

**Description:**

Checks if value is a string.

**Parameters:**

- `$value` (mixed)

**Returns:**

- (bool)

<hr />

### json

**Description:**

Checks if value is a JSON string.

**Parameters:**

- `$value` (mixed)

**Returns:**

- (bool)

<hr />

### as

**Description:**

Validate array values against a set of rules.

Multiple rules can be validated against one key by separating them with a pipe (`|`).

Available rules are any RULE_* constant. Parameters are separated by a comma.

**Parameters:**

- `$array` (array): Array to validate
- `$rules` (array): Array whose keys are the array key to validate in dot notation and values are the rule
- `$require_all = false` (bool): Require all array keys to exist

**Returns:**

- (bool)

**Example:**

```
use Bayfront\Validator\Validate;

$array = [
    'sku' => 12345,
    'type' => 'shirt',
    'color' => 'blue',
    'sizes' => [
        'small' => [
            'quantity' => 3,
            'price' => 9.99
        ]
    ],
    'on_sale' => true,
    'meta' => [
        'tags' => [
            'popular',
            'sale',
            'mens'
        ]
    ]
];

$rules = [
    'sku' => 'required|integer',
    'type' => 'string|nullable',
    'color' => 'string',
    'sizes.small.quantity' => 'integer|greaterThan:0',
    'sizes.small.price' => 'float|between:0,20',
    'on_sale' => 'boolean',
    'meta.tags' => 'nullable|array'
];

if (!Validate::as($array, $rules)) {
    // Do something
}
```