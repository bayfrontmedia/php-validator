# Documentation > Rules

For more information, see [rule interface](README.md#rule-interface).

## Available rules

- [Alpha](#alpha)
- [AlphaNumeric](#alphanumeric)
- [Between](#between)
- [Callback](#callback)
- [Contains](#contains)
- [Date](#date)
- [Different](#different)
- [Email](#email)
- [EndsWith](#endswith)
- [Equals](#equals)
- [GreaterThan](#greaterthan)
- [GreaterThanOrEqual](#greaterthanorequal)
- [Ip](#ip)
- [Ipv4](#ipv4)
- [Ipv6](#ipv6)
- [IsArray](#isarray)
- [IsBoolean](#isboolean)
- [IsEmpty](#isempty)
- [IsFloat](#isfloat)
- [IsInteger](#isinteger)
- [IsJson](#isjson)
- [IsNull](#isnull)
- [IsObject](#isobject)
- [IsString](#isstring)
- [LengthBetween](#lengthbetween)
- [LengthEquals](#lengthequals)
- [LengthGreaterThan](#lengthgreaterthan)
- [LengthLessThan](#lengthlessthan)
- [LessThan](#lessthan)
- [LessThanOrEqual](#lessthanorequal)
- [Matches](#matches)
- [MaxLength](#maxlength)
- [MinLength](#minlength)
- [Numeric](#numeric)
- [Required](#required)
- [StartsWith](#startswith)
- [Url](#url)
- [Uuid](#uuid)
- [Uuidv4](#uuidv4)

### Alpha

**Description:**

Checks if string only contains alpha characters.

**Parameters:**

- `$value` (string)

<hr />

### AlphaNumeric

**Description:**

Checks if string only contains alphanumeric characters.

**Parameters:**

- `$value` (string)

<hr />

### Between

**Description:**

Checks if value is between given min and max values.

**Parameters:**

- `$value` (float)
- `$min` (float)
- `$max` (float)

<hr />

### Callback

**Description:**

Value must return `true` from the callback function.

The value is passed as an argument to the function.

> NOTE: This rule is not supported by the [Validator class](validator.md).

**Parameters:**

- `$value` (mixed)
- `$callback` (callable)

**Example:**

```php
use Bayfront\Validator\Rules\Callback;

$callback = new Callback('This is a string of words.', function ($value) {
    return str_contains($value, 'words');
});

if ($callback->isValid()) {
    // Do something
}
```

<hr />

### Contains

**Description:**

Checks if string value contains case-sensitive needle(s).

> NOTE: This rule is not supported by the [Validator class](validator.md).

**Parameters:**

- `$value` (string)
- `$needles` (array)

<hr />

### Date

**Description:**

Checks if string is a valid date according to a given format.

See: https://www.php.net/manual/en/datetime.format.php

**Parameters:**

- `$value` (string)
- `$format = 'Y-m-d H:i:s'` (string)

<hr />

### Different

**Description:**

Checks if values are different.
Strings are compared as case-sensitive.

**Parameters:**

- `$value` (mixed)
- `$match` (mixed)

<hr />

### Email

**Description:**

Checks if string validates as an email address.

**Parameters:**

- `$value` (mixed)

<hr />

### EndsWith

**Description:**

Checks if string ends with a given needle.

**Parameters:**

- `$value` (string)
- `$needle` (string)

<hr />

### Equals

**Description:**

Checks if values are equal.

**Parameters:**

- `$value` (float)
- `$compare` (float)

<hr />

### GreaterThan

**Description:**

Checks if value is greater than a given number.

**Parameters:**

- `$value` (float)
- `$compare` (float)

<hr />

### GreaterThanOrEqual

**Description:**

Checks if value is greater than or equal to a given number.

**Parameters:**

- `$value` (float)
- `$compare` (float)

<hr />

### Ip

**Description:**

Checks if string validates as an IP address.

**Parameters:**

- `$value` (string)

<hr />

### Ipv4

**Description:**

Checks if string validates as an IPv4 address.

**Parameters:**

- `$value` (string)

<hr />

### Ipv6

**Description:**

Checks if string validates as an IPv6 address.

**Parameters:**

- `$value` (string)

<hr />

### IsArray

**Description:**

Value is an array.

**Parameters:**

- `$value` (mixed)

<hr />

### IsBoolean

**Description:**

Value is a boolean.

**Parameters:**

- `$value` (mixed)

<hr />

### IsEmpty

**Description:**

Value is an empty string.

**Parameters:**

- `$value` (mixed)

<hr />

### IsFloat

**Description:**

Value is a float.

**Parameters:**

- `$value` (mixed)

<hr />

### IsInteger

**Description:**

Value is an integer.

**Parameters:**

- `$value` (mixed)

<hr />

### IsJson

**Description:**

Value is a JSON string.

**Parameters:**

- `$value` (mixed)

<hr />

### IsNull

**Description:**

Value is `null`.

**Parameters:**

- `$value` (mixed)

<hr />

### IsObject

**Description:**

Value is an object.

**Parameters:**

- `$value` (mixed)

<hr />

### IsString

**Description:**

Value is a string.

**Parameters:**

- `$value` (mixed)

<hr />

### LengthBetween

**Description:**

Checks if string length is between min and max length.

**Parameters:**

- `$value` (string)
- `$min` (int)
- `$max` (int)

<hr />

### LengthEquals

**Description:**

Checks if value length is a given length.

**Parameters:**

- `$value` (string)
- `$length` (int)

<hr />

### LengthGreaterThan

**Description:**

Checks if value length is greater than a given length.

**Parameters:**

- `$value` (string)
- `$length` (int)

<hr />

### LengthLessThan

**Description:**

Checks if value length is less than a given length.

**Parameters:**

- `$value` (string)
- `$length` (int)

<hr />

### LessThan

**Description:**

Checks if value is less than a given number.

**Parameters:**

- `$value` (float)
- `$compare` (float)

<hr />

### LessThanOrEqual

**Description:**

Checks if value is less than or equal to a given number.

**Parameters:**

- `$value` (float)
- `$compare` (float)

<hr />

### Matches

**Description:**

Values match.
Strings are compared as case-sensitive.

**Parameters:**

- `$value` (mixed)
- `$match` (mixed)

<hr />

### MaxLength

**Description:**

Checks if string length is greater than or equal to a given length.

**Parameters:**

- `$value` (string)
- `$length` (int)

<hr />

### MinLength

**Description:**

Checks if string length is greater than or equal to a given length.

**Parameters:**

- `$value` (string)
- `$length` (int)

<hr />

### Numeric

**Description:**

Checks if string only contains numeric characters.

**Parameters:**

- `$value` (mixed)

<hr />

### Required

**Description:**

Required array key exists.

**Parameters:**

- `$value` (array)
- `$key` (string): Array key in dot notation

<hr />

### StartsWith

**Description:**

Checks if string begins with a given needle.

**Parameters:**

- `$value` (string)
- `$needle` (string)

<hr />

### Url

**Description:**

Checks if string validates as a URL.

**Parameters:**

- `$value` (string)

<hr />

### Uuid

**Description:**

Checks if string is a valid UUID.

**Parameters:**

- `$value` (string)

<hr />

### Uuidv4

**Description:**

Checks if string is a valid UUIDv4.

**Parameters:**

- `$value` (string)

<hr />