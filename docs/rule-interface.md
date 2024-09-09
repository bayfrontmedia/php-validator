# Documentation > Rule interface

Validate using a single rule.

This library includes a number of [validation rules](rules.md), each with their own class.
Each validation rule extends `Bayfront\Validator\Abstracts\Rule` and implements
`Bayfront\Validator\Interfaces\ValidationRuleInterface`.

Each rule will require different parameters in its constructor, depending on its requirements.

**Example:**

```php
use Bayfront\Validator\Rules\Matches;

$password = '12345';
$confirm_password = '1234';

$matches = new Matches($password, $confirm_password);

// Optionally set a custom validation message
$matches->setMessage('Passwords must match');

if (!$matches->isValid()) {
    echo $matches->getMessage();
}
```

Each rule contains the following methods:

- [setMessage](#setmessage)
- [getMessage](#getmessage)
- [isValid](#isvalid)

### setMessage

**Description:**

Set validation error message.

**Parameters:**

- `$message` (string)

**Returns:**

- `Bayfront\Validator\Abstracts\Rule`

<hr />

### getMessage

**Description:**

Get validation error message.

If a message has not been set, the default message for the rule will be used.

**Parameters:**

- None

**Returns:**

- (string)

<hr />

### isValid

**Description:**

Is validation valid?

**Parameters:**

- None

**Returns:**

- (bool)