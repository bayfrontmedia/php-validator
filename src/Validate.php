<?php

namespace Bayfront\Validator;

use Bayfront\ArrayHelpers\Arr;
use DateTime;
use ReflectionException;
use ReflectionMethod;
use ReflectionParameter;

class Validate
{

    /*
     * |--------------------------------------------------------------------------
     * | Strings
     * |--------------------------------------------------------------------------
     */

    /**
     * Checks if string is empty.
     *
     * @param string $string
     * @return bool
     */
    public static function empty(string $string): bool
    {
        return $string == '';
    }

    /**
     * Checks if two strings match.
     *
     * @param string $string
     * @param string $matches
     * @return bool
     */
    public static function matches(string $string, string $matches): bool
    {
        return $string == $matches;
    }

    /**
     * Checks if string length is greater than or equal to a given length.
     *
     * @param string $string
     * @param int $length
     * @return bool
     */
    public static function minLength(string $string, int $length): bool
    {
        return strlen($string) >= $length;
    }

    /**
     * Checks if string length is less than or equal to a given length.
     *
     * @param string $string
     * @param int $length
     * @return bool
     */
    public static function maxLength(string $string, int $length): bool
    {
        return strlen($string) <= $length;
    }

    /**
     * Checks if string length is equal to a given length.
     *
     * @param string $string
     * @param int $length
     * @return bool
     */
    public static function lengthEquals(string $string, int $length): bool
    {
        return strlen($string) == $length;
    }

    /**
     * Checks if string length is between min and max length.
     *
     * @param string $string
     * @param int $min
     * @param int $max
     * @return bool
     */
    public static function lengthBetween(string $string, int $min, int $max): bool
    {
        return strlen($string) >= $min && strlen($string) <= $max;
    }

    /**
     * Checks if string contains case-sensitive needle(s).
     *
     * @param string $string
     * @param $needles array|string
     * @return bool
     */
    public static function contains(string $string, array|string $needles): bool
    {

        $needles = (array)$needles;

        foreach ($needles as $needle) {

            if (!str_contains($string, $needle)) {
                return false;
            }

        }

        return true;

    }

    /**
     * Checks if string begins with a given needle.
     *
     * @param string $string
     * @param string $needle
     * @return bool
     */
    public static function startsWith(string $string, string $needle): bool
    {
        return str_starts_with($string, $needle);
    }

    /**
     * Checks if string ends with a given needle.
     *
     * @param string $string
     * @param string $needle
     * @return bool
     */
    public static function endsWith(string $string, string $needle): bool
    {
        return str_ends_with($string, $needle);
    }

    /**
     * Checks if string validates as email.
     *
     * @param string $string
     * @return bool
     */
    public static function email(string $string): bool
    {
        return filter_var($string, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Checks if string validates as a URL.
     *
     * @param string $string
     * @return bool
     */
    public static function url(string $string): bool
    {
        return filter_var($string, FILTER_VALIDATE_URL);
    }

    /**
     * Checks if string validates as an IP address.
     *
     * @param string $string
     * @return bool
     */
    public static function ip(string $string): bool
    {
        return filter_var($string, FILTER_VALIDATE_IP);
    }

    /**
     * Checks if string validates as an IPv4 address.
     *
     * @param string $string
     * @return bool
     */
    public static function ipv4(string $string): bool
    {
        return filter_var($string, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    /**
     * Checks if string validates as an IPv6 address.
     *
     * @param string $string
     * @return bool
     */
    public static function ipv6(string $string): bool
    {
        return filter_var($string, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
    }

    /**
     * Checks if string only contains alpha characters.
     *
     * @param string $string
     * @return bool
     */
    public static function alpha(string $string): bool
    {
        return ctype_alpha($string);
    }

    /**
     * Checks if string is numeric.
     *
     * @param string $string
     * @return bool
     */
    public static function numeric(string $string): bool
    {
        return (is_numeric($string));
    }

    /**
     * Checks if string only contains alphanumeric characters.
     *
     * @param string $string
     * @return bool
     */
    public static function alphaNumeric(string $string): bool
    {
        return ctype_alnum($string);
    }

    /**
     * Checks if string is a valid date according to a given format.
     *
     * See: https://www.php.net/manual/en/datetime.format.php
     *
     * @param string $string
     * @param string $format (Date format to validate)
     * @return bool
     */
    public static function date(string $string, string $format = 'Y-m-d H:i:s'): bool
    {
        $obj = DateTime::createFromFormat($format, $string);
        return $obj && $obj->format($format) == $string;
    }

    /**
     * Checks if string is a valid UUID.
     *
     * @param string $string
     * @return bool
     */
    public static function uuid(string $string): bool
    {
        $regex = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/';
        return (bool)preg_match($regex, $string);
    }

    /**
     * Checks if string is a valid UUIDv4.
     *
     * @param string $string
     * @return bool
     */
    public static function uuidv4(string $string): bool
    {
        $regex = '/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/';
        return (bool)preg_match($regex, $string);
    }

    /*
     * |--------------------------------------------------------------------------
     * | Integers
     * |--------------------------------------------------------------------------
     */

    /**
     * Checks if value is less than a given number.
     *
     * @param float $value
     * @param float $compare
     * @return bool
     */
    public static function lessThan(float $value, float $compare): bool
    {
        return $value < $compare;
    }

    /**
     * Checks if value is greater than a given number.
     *
     * @param float $value
     * @param float $compare
     * @return bool
     */
    public static function greaterThan(float $value, float $compare): bool
    {
        return $value > $compare;
    }

    /**
     * Checks if value is less than or equal to a given number.
     *
     * @param float $value
     * @param float $compare
     * @return bool
     */
    public static function lessThanOrEqual(float $value, float $compare): bool
    {
        return $value <= $compare;
    }

    /**
     * Checks if value is greater than or equal to a given number.
     *
     * @param float $value
     * @param float $compare
     * @return bool
     */
    public static function greaterThanOrEqual(float $value, float $compare): bool
    {
        return $value >= $compare;
    }

    /**
     * Checks if values are equal.
     *
     * @param float $value
     * @param float $compare
     * @return bool
     */
    public static function equals(float $value, float $compare): bool
    {
        return $value == $compare;
    }

    /**
     * Checks if value is between given min and max values.
     *
     * @param float $value
     * @param float $min
     * @param float $max
     * @return bool
     */
    public static function between(float $value, float $min, float $max): bool
    {
        return $value >= $min && $value <= $max;
    }

    /*
     * |--------------------------------------------------------------------------
     * | Types
     * |--------------------------------------------------------------------------
     */

    /**
     * Checks if value is NULL.
     *
     * @param mixed $value
     * @return bool
     */
    public static function null(mixed $value): bool
    {
        return (NULL === $value);
    }

    /**
     * Checks if value is an integer.
     *
     * @param mixed $value
     * @return bool
     */
    public static function integer(mixed $value): bool
    {
        return is_int($value);
    }

    /**
     * Checks if value is a float.
     *
     * @param mixed $value
     * @return bool
     */
    public static function float(mixed $value): bool
    {
        return is_float($value);
    }

    /**
     * Checks if value is a boolean.
     *
     * @param mixed $value
     * @return bool
     */
    public static function boolean(mixed $value): bool
    {
        return is_bool($value);
    }

    /**
     * Checks if value is an object.
     *
     * @param mixed $value
     * @return bool
     */
    public static function object(mixed $value): bool
    {
        return is_object($value);
    }

    /**
     * Checks if value is an array.
     *
     * @param mixed $value
     * @return bool
     */
    public static function array(mixed $value): bool
    {
        return is_array($value);
    }

    /**
     * Checks if value is a string.
     *
     * @param mixed $value
     * @return bool
     */
    public static function string(mixed $value): bool
    {
        return is_string($value);
    }

    /**
     * Checks if value is a JSON string.
     *
     * @param mixed $value
     * @return bool
     */
    public static function json(mixed $value): bool
    {

        if (self::string($value)) {

            if (NULL !== json_decode($value)) {
                return (json_last_error() == JSON_ERROR_NONE);
            }

        }

        return false;

    }

    public const RULE_REQUIRED = 'required';
    public const RULE_NULLABLE = 'nullable';
    public const RULE_EMPTY = 'empty';
    public const RULE_MATCHES = 'matches';
    public const RULE_MINLENGTH = 'minLength';
    public const RULE_MAXLENGTH = 'maxLength';
    public const RULE_LENGTHEQUALS = 'lengthEquals';
    public const RULE_LENGTHBETWEEN = 'lengthBetween';
    public const RULE_CONTAINS = 'contains';
    public const RULE_STARTSWITH = 'startsWith';
    public const RULE_ENDSWITH = 'endsWith';
    public const RULE_EMAIL = 'email';
    public const RULE_URL = 'url';
    public const RULE_IP = 'ip';
    public const RULE_IPV4 = 'ipv4';
    public const RULE_IPV6 = 'ipv6';
    public const RULE_ALPHA = 'alpha';
    public const RULE_NUMERIC = 'numeric';
    public const RULE_ALPANUMERIC = 'alphanumeric';
    public const RULE_DATE = 'date';
    public const RULE_UUID = 'uuid';
    public const RULE_UUIDV4 = 'uuidv4';
    public const RULE_LESSTHAN = 'lessThan';
    public const RULE_GREATERTHAN = 'greaterThan';
    public const RULE_LESSTHANOREQUAL = 'lessThanOrEqual';
    public const RULE_GREATERTHANOREQUAL = 'greaterThanOrEqual';
    public const RULE_EQUALS = 'equals';
    public const RULE_BETWEEN = 'between';
    public const RULE_NULL = 'null';
    public const RULE_INTEGER = 'integer';
    public const RULE_FLOAT = 'float';
    public const RULE_BOOLEAN = 'boolean';
    public const RULE_OBJECT = 'object';
    public const RULE_ARRAY = 'array';
    public const RULE_STRING = 'string';
    public const RULE_JSON = 'json';

    private static array $private_as_rules = [
        self::RULE_EMPTY,
        self::RULE_MATCHES,
        self::RULE_MINLENGTH,
        self::RULE_MAXLENGTH,
        self::RULE_LENGTHEQUALS,
        self::RULE_LENGTHBETWEEN,
        self::RULE_CONTAINS,
        self::RULE_STARTSWITH,
        self::RULE_ENDSWITH,
        self::RULE_EMAIL,
        self::RULE_URL,
        self::RULE_IP,
        self::RULE_IPV4,
        self::RULE_IPV6,
        self::RULE_ALPHA,
        self::RULE_NUMERIC,
        self::RULE_ALPANUMERIC,
        self::RULE_DATE,
        self::RULE_UUID,
        self::RULE_UUIDV4,
        self::RULE_LESSTHAN,
        self::RULE_GREATERTHAN,
        self::RULE_LESSTHANOREQUAL,
        self::RULE_GREATERTHANOREQUAL,
        self::RULE_EQUALS,
        self::RULE_BETWEEN,
        self::RULE_NULL,
        self::RULE_INTEGER,
        self::RULE_FLOAT,
        self::RULE_BOOLEAN,
        self::RULE_OBJECT,
        self::RULE_ARRAY,
        self::RULE_STRING,
        self::RULE_JSON
    ];

    /**
     * Checks if array key exists including null value.
     *
     * @param array $array
     * @param string $key (In dot notation))
     * @return bool
     */
    private static function keyDoesNotExist(array $array, string $key): bool
    {
        return Arr::get($array, $key) === null && Arr::get($array, $key, []) === [];
    }

    /**
     * Validate method parameter can accept value.
     *
     * @param ReflectionParameter $parameter
     * @param mixed $value
     * @return bool
     */
    private static function isValidParameterType(ReflectionParameter $parameter, mixed $value): bool
    {

        $method_param_type = (string)$parameter->getType();
        $value_type = gettype($value);

        $valid_types = [
            'string',
            'integer',
            'float',
            'double'
        ];

        $parameter_types = explode('|', $method_param_type);

        foreach ($parameter_types as $type) {

            if ($type !== 'mixed' &&
                !in_array($value_type, $valid_types)) {

                return false;
            }

        }

        return true;

    }

    /**
     * @param mixed $value
     * @param string $method
     * @return bool
     */
    private static function callSingleParameterMethod(mixed $value, string $method): bool
    {

        if (!in_array($method, self::$private_as_rules)) {
            return false;
        }

        try {
            $class_method = new ReflectionMethod(self::class, $method);
        } catch (ReflectionException) { // Method does not exist
            return false;
        }

        $method_params = $class_method->getParameters();

        if (count($method_params) !== 1) {
            return false;
        }

        if (!self::isValidParameterType($method_params[0], $value)) {
            return false;
        }

        return self::$method($value);

    }

    /**
     * @param mixed $value
     * @param string $method
     * @param string $params
     * @return bool
     */
    private static function callMultiParameterMethod(mixed $value, string $method, string $params): bool
    {

        if (!in_array($method, self::$private_as_rules)) {
            return false;
        }

        $params = explode(',', $params);
        array_unshift($params, $value); // Add to beginning of array

        try {
            $class_method = new ReflectionMethod(self::class, $method);
        } catch (ReflectionException) { // Method does not exist
            return false;
        }

        $method_params = $class_method->getParameters();

        if (count($method_params) !== count($params)) { // Invalid rule definition
            return false;
        }

        foreach ($method_params as $k => $method_param) {

            if (!self::isValidParameterType($method_param, $params[$k])) {
                return false;
            }

        }

        return self::$method(...$params);

    }

    /**
     * Validate array values against a set of rules.
     *
     * Multiple rules can be validated against one key by separating them with a pipe (|).
     *
     * Available rules are any RULE_* constant. Parameters are separated by a comma.
     *
     * @param array $array (Array to validate)
     * @param array $rules
     *     (Array whose keys are the array key to validate in dot notation
     *     and values are the rule)
     * @param bool $require_all (Require all array keys to exist)
     * @return bool
     */

    public static function as(array $array, array $rules, bool $require_all = false): bool
    {

        foreach ($rules as $array_key => $rule) {

            /*
             * Require all
             * Arr::get with default [] ensures NULL values are accounted for
             */

            if ($require_all &&
                self::keyDoesNotExist($array, $array_key)) {
                return false;
            }

            $rule_list = explode('|', $rule);

            foreach ($rule_list as $single_rule) {

                if (in_array(self::RULE_REQUIRED, $rule_list) &&
                    self::keyDoesNotExist($array, $array_key)) {
                    return false;
                }

                if (in_array(self::RULE_NULLABLE, $rule_list)) {

                    if (Arr::get($array, $array_key, []) === null) {
                        continue 2; // Skip all other rules
                    }

                }

                if ($single_rule === self::RULE_REQUIRED || $single_rule === self::RULE_NULLABLE) {
                    continue;
                }

                // Not required, check if exists

                if (self::keyDoesNotExist($array, $array_key)) {
                    continue;
                }

                $single_rule = explode(':', $single_rule, 2);

                $method = $single_rule[0];

                if (sizeof($single_rule) == 1) { // No parameters

                    $result = self::callSingleParameterMethod(Arr::get($array, $array_key), $method);

                } else {

                    $result = self::callMultiParameterMethod(Arr::get($array, $array_key), $method, $single_rule[1]);

                }

                if ($result === true) {
                    continue;
                }

                return false;

            }

        }

        return true;

    }

}