# Documentation

PHP validator is a simple class used to validate a variety of data.
Validation can be done one rule at a time using a rule interface,
or multiple rules at once using the validator.

It supports custom validation messages on a per-rule or a per-array key 
(when using the validator) basis.

This library also supports custom rules using the [callback](rules.md#callback) rule.

- [Validator](validator.md) - Validate an array using multiple rules
- [Rule interface](rule-interface.md) - Validate using a single rule
- [Available rules](rules.md) - All available rules