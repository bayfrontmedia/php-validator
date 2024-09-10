<?php

namespace Bayfront\Validator;

use Bayfront\ArrayHelpers\Arr;
use Bayfront\Validator\Interfaces\ValidationRuleInterface;
use Bayfront\Validator\Rules\Alpha;
use Bayfront\Validator\Rules\AlphaNumeric;
use Bayfront\Validator\Rules\Between;
use Bayfront\Validator\Rules\Date;
use Bayfront\Validator\Rules\Different;
use Bayfront\Validator\Rules\Email;
use Bayfront\Validator\Rules\EndsWith;
use Bayfront\Validator\Rules\Equals;
use Bayfront\Validator\Rules\GreaterThan;
use Bayfront\Validator\Rules\GreaterThanOrEqual;
use Bayfront\Validator\Rules\Ip;
use Bayfront\Validator\Rules\Ipv4;
use Bayfront\Validator\Rules\Ipv6;
use Bayfront\Validator\Rules\IsArray;
use Bayfront\Validator\Rules\IsBoolean;
use Bayfront\Validator\Rules\IsEmpty;
use Bayfront\Validator\Rules\IsFloat;
use Bayfront\Validator\Rules\IsInteger;
use Bayfront\Validator\Rules\IsJson;
use Bayfront\Validator\Rules\IsNull;
use Bayfront\Validator\Rules\IsObject;
use Bayfront\Validator\Rules\IsString;
use Bayfront\Validator\Rules\LengthBetween;
use Bayfront\Validator\Rules\LengthEquals;
use Bayfront\Validator\Rules\LengthGreaterThan;
use Bayfront\Validator\Rules\LengthLessThan;
use Bayfront\Validator\Rules\LessThan;
use Bayfront\Validator\Rules\LessThanOrEqual;
use Bayfront\Validator\Rules\Matches;
use Bayfront\Validator\Rules\MaxLength;
use Bayfront\Validator\Rules\MinLength;
use Bayfront\Validator\Rules\Numeric;
use Bayfront\Validator\Rules\Required;
use Bayfront\Validator\Rules\StartsWith;
use Bayfront\Validator\Rules\Url;
use Bayfront\Validator\Rules\Uuid;
use Bayfront\Validator\Rules\Uuidv4;
use ReflectionClass;

class Validator
{

    /**
     * Was the validation valid?
     *
     * @var bool
     */
    private bool $is_valid = true;

    /**
     * Validation messages.
     *
     * @var array
     */
    private array $messages = [];

    /**
     * Available validation rules.
     *
     * @var array
     */
    private array $rules = [
        'alpha' => Alpha::class,
        'alphaNumeric' => AlphaNumeric::class,
        'between' => Between::class,
        'date' => Date::class,
        'different' => Different::class,
        'email' => Email::class,
        'endsWith' => EndsWith::class,
        'equals' => Equals::class,
        'greaterThan' => GreaterThan::class,
        'greaterThanOrEqual' => GreaterThanOrEqual::class,
        'ip' => Ip::class,
        'ipv4' => Ipv4::class,
        'ipv6' => Ipv6::class,
        'isArray' => IsArray::class,
        'isBoolean' => IsBoolean::class,
        'isEmpty' => IsEmpty::class,
        'isFloat' => IsFloat::class,
        'isInteger' => IsInteger::class,
        'isJson' => IsJson::class,
        'isNull' => IsNull::class,
        'isObject' => IsObject::class,
        'isString' => IsString::class,
        'lengthBetween' => LengthBetween::class,
        'lengthEquals' => LengthEquals::class,
        'lengthGreaterThan' => LengthGreaterThan::class,
        'lengthLessThan' => LengthLessThan::class,
        'lessThan' => LessThan::class,
        'lessThanOrEqual' => LessThanOrEqual::class,
        'matches' => Matches::class,
        'maxLength' => MaxLength::class,
        'minLength' => MinLength::class,
        'numeric' => Numeric::class,
        'required' => Required::class,
        'startsWith' => StartsWith::class,
        'url' => Url::class,
        'uuid' => Uuid::class,
        'uuidv4' => Uuidv4::class
    ];

    /**
     * Checks if array key exists including null value.
     *
     * @param array $array
     * @param string $key (In dot notation)
     * @return bool
     */
    private function keyDoesNotExist(array $array, string $key): bool
    {
        return Arr::get($array, $key) === null && Arr::get($array, $key, []) === [];
    }

    /**
     * Validate input against a set of rules.
     *
     * @param array $input
     * @param array $rules (Rules in dot notation)
     * @param bool $require_all (Require all rule keys to exist on the array?)
     * @param bool $first_error_only (Stop validation and return first error only)
     * @return self
     */
    public function validate(array $input, array $rules, bool $require_all = false, bool $first_error_only = false): Validator
    {

        foreach ($rules as $input_key => $rule_list) {

            /*
             * Check if all are required before evaluating rules
             */

            if ($require_all && $this->keyDoesNotExist($input, $input_key)) {

                $this->is_valid = false;
                $this->messages[$input_key]['required'] = 'Key does not exist: ' . $input_key;

                if ($first_error_only) {
                    return $this;
                }

                continue; // Do not evaluate any other rules

            }

            $rule_list = explode('|', $rule_list); // Rules are separated by a pipe (|)

            foreach ($rule_list as $rule_definition) {

                /*
                 * Check if this key is required
                 *
                 * If rule exists and fails, ignore all other rules for this $input_key
                 */

                if (in_array('required', $rule_list)) {

                    /** @var ValidationRuleInterface $rule_class */
                    $rule_class = new $this->rules['required']($input, $input_key);

                    if (!$rule_class->isValid()) {

                        $this->is_valid = false;
                        $this->messages[$input_key]['required'] = $rule_class->getMessage();

                        if ($first_error_only) {
                            return $this;
                        }

                        continue 2; // Stop iterating rules for this input key since it does not exist

                    }

                }

                /*
                 * Check nullable
                 */

                if (in_array('nullable', $rule_list)) {

                    /** @var ValidationRuleInterface $rule_class */
                    $rule_class = new $this->rules['isNull'](Arr::get($input, $input_key, []));

                    if ($rule_class->isValid()) { // If is null

                        continue 2; // Stop iterating this input key since nullable and = null negates all other rules

                    }

                    /*
                     * No error if not valid, because "nullable" allows for other types
                     * which will be evaluated below.
                     */

                }

                // Check all other rules

                $definition = explode(':', $rule_definition, 2);

                $rule = $definition[0];

                if ($rule == 'required' || $rule == 'nullable') {
                    continue; // Already checked, continue to next rule
                }

                if (!isset($this->rules[$rule])) {

                    $this->is_valid = false;
                    $this->messages[$input_key][$rule] = 'Invalid rule: ' . $rule;

                    if ($first_error_only) {
                        return $this;
                    }

                    continue; // Continue to next rule

                }

                if (!isset($definition[1])) { // No parameters defined in rule

                    $params = [Arr::get($input, $input_key)]; // Subject

                } else { // Parameters defined in rule

                    $params = explode(',', $definition[1]);

                    array_unshift($params, Arr::get($input, $input_key)); // Add subject to start of array

                }

                /*
                 * Check number of parameters
                 */

                $rc = new ReflectionClass($this->rules[$rule]);
                $rc_params = $rc->getConstructor()->getParameters();

                if (count($rc_params) !== count($params)) {

                    $this->is_valid = false;
                    $this->messages[$input_key][$rule] = 'Invalid rule parameters: ' . $rule;

                    if ($first_error_only) {
                        return $this;
                    }

                    continue; // Continue to next rule

                }

                /** @var ValidationRuleInterface $rule_class */
                $rule_class = new $this->rules[$rule](...$params);

                if (!$rule_class->isValid()) {

                    $this->is_valid = false;
                    $this->messages[$input_key][$rule] = $rule_class->getMessage();

                    if ($first_error_only) {
                        return $this;
                    }

                }

            }

        }

        return $this;

    }

    /**
     * Is validation valid?
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->is_valid;
    }

    /**
     * Defined validation messages for specific array keys.
     *
     * @var array
     */
    private array $key_messages = [];

    /**
     * Set validation messages for specific array keys.
     *
     * Only this validation message will be returned with the key "key", regardless of the rule which caused it.
     *
     * @param array $messages (key = array key in dot notation, value = message)
     * @return $this
     */
    public function setKeyMessages(array $messages): Validator
    {

        foreach ($messages as $key => $message) {
            $this->key_messages[$key] = $message;
        }

        return $this;

    }

    /**
     * Defined validation messages for specific array key rules.
     *
     * @var array
     */
    private array $rule_messages = [];

    /**
     * Set validation messages for a specific array key rule.
     *
     * @param string $key (Array key in dot notation)
     * @param array $rule_messages (Key = rule, Value = message)
     * @return $this
     */
    public function setRuleMessages(string $key, array $rule_messages): Validator
    {

        foreach ($rule_messages as $rule => $message) {
            $this->rule_messages[$key][$rule] = $message;
        }

        return $this;

    }

    /**
     * Get all validation messages.
     *
     * Array keys equal the array key in which the validation error occurred.
     * Array values are returned as an array whose keys equal the rule
     * (or `key` when defined using the `seyKeyMessages` method),
     * and whose value equal the message.
     *
     * @return array
     */
    public function getMessages(): array
    {

        $messages = $this->messages; // Messages returned by rules

        foreach ($messages as $key => $message) {

            if (isset($this->key_messages[$key])) { // Key message exists, only return this

                $messages[$key] = [
                    'key' => $this->key_messages[$key]
                ];

            } else if (isset($this->rule_messages[$key])) {

                foreach ($this->rule_messages[$key] as $rule => $rule_message) {

                    if (isset($messages[$key][$rule])) { // Overwrite message
                        $messages[$key][$rule] = $rule_message;
                    }

                }

            }

        }

        return $messages;

    }

}