# Documentation > Validator

Validate an array using multiple [rules](rules.md).

All rules can be used except for:

- [Callback](rules.md#callback)
- [Contains](rules.md#contains)

In addition, the rule `nullable` is available to be used, 
which allows for an array key's value to optionally be `null`.

- [Rule names](rules.md) are in camel-case with the first letter being lowercase
- Rules are separated by a pipe (`|`)
- Rule parameters are added with a colon (`:`) separated by a comma (`,`)

**Example:**

```php
use Bayfront\Validator\Validator;

$array = [
    'sku' => 1234567,
    'type' => 'shirt',
    'color' => 'blue',
    'sizes' => [
        'small' => [
            'quantity' => 3,
            'price' => -19.99
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
    'sku' => 'isInteger|lengthBetween:4,6',
    'color' => 'isString',
    'sizes.small.quantity' => 'isInteger|greaterThanOrEqual:0',
    'sizes.small.price' => 'isFloat|greaterThanOrEqual:0',
    'on_sale' => 'isBoolean',
    'meta.tags' => 'nullable|isArray'
];

$validator = new Validator();

// Optionally set key messages
$validator->setKeyMessages([
    'sku' => 'Incorrect SKU format'
]);

// Optionally set rule messages
$validator->setRuleMessages('sizes.small.quantity', [
    'greaterThanOrEqual' => 'Item quantity must be greater than 0'
]);

$validator->validate($array, $rules, true); // Require all keys to exist

if (!$validator->isValid()) {
    var_dump($validator->getMessages());
} else {
    die('Array is valid!');
}
```

Available methods:

- [validate](#validate)
- [isValid](#isvalid)
- [setKeyMessages](#setkeymessages)
- [setRuleMessages](#setrulemessages)
- [getMessages](#getmessages)

### validate

**Description:**

Validate input against a set of rules.

**Parameters:**

- `$input` (array)
- `$rules` (array): Rules in dot notation
- `$require_all = false` (bool): Require all rule keys to exist on the array?
- `$first_error_only = false` (bool): Stop validation and return first error only

**Returns:**

- `Bayfront\Validator\Validator`

<hr />

### isValid

**Description:**

Is validation valid?

**Parameters:**

- None

**Returns:**

- (bool)

<hr />

### setKeyMessages

**Description:**

Set validation messages for specific array keys.

Only this validation message will be returned for the key, regardless of the rule which caused it.

**Parameters:**

- `$messages` (array): key = array key in dot notation, value = message

**Returns:**

- `Bayfront\Validator\Validator`

<hr />

### setRuleMessages

**Description:**

Set validation messages for a specific array key rule.

**Parameters:**

- `$key` (string): Array key in dot notation
- `$rule_messages` (array): Key = rule, Value = message

**Returns:**

- `Bayfront\Validator\Validator`

<hr />

### getMessages

**Description:**

Get all validation messages.

Array keys equal the array key in which the validation error occurred.
Array values are returned as an array whose keys equal the rule 
(or `key` when defined using the `seyKeyMessages` method), 
and whose value equal the message.

**Parameters:**

- None

**Returns:**

- (array)

<hr />

**Example:**

Example array returned by this method using the example [above](#documentation--validator):

```php
[
    'sku' => [
        'key' => 'Incorrect SKU format'
    ],
    'sizes.small.price' => [
        'greaterThanOrEqual' => 'The value must be greater than or equal to 0'
    ]
]
```