# The Simply PHP Framewrok
[![Latest Stable Version](https://poser.pugx.org/simplyphp/framework/v/stable)](https://packagist.org/packages/simplyphp/framework)
[![Total Downloads](https://poser.pugx.org/simplyphp/framework/downloads)](https://packagist.org/packages/simplyphp/framework)
[![License](https://poser.pugx.org/simplyphp/framework/license)](https://packagist.org/packages/simplyphp/framework)
[![Monthly Downloads](https://poser.pugx.org/simplyphp/framework/d/monthly)](https://packagist.org/packages/simplyphp/framework)

### VALIDATION

Make sure to use:
```php
Use App\Helper\Validation\Validator as validate;
```


#### Available Methods

```php
// Shorthand validation
is_valid(array $data, array $rules)

// Get or set the validation rules
validation_rules(array $rules);

// Get or set the filtering rules
filter_rules(array $rules);

// Runs the filter and validation routines
run(array $data);

// Strips and encodes unwanted characters
xss_clean(array $data);

// Sanitizes data and converts strings to UTF-8 (if available),
// optionally according to the provided field whitelist
sanitize(array $input, $whitelist = NULL);

// Validates input data according to the provided ruleset (see example)
validate(array $input, array $ruleset);

// Filters input data according to the provided filterset (see example)
filter(array $input, array $filterset);

// Returns human readable error text in an array or string
get_readable_errors($convert_to_string = false);

// Fetch an array of validation errors indexed by the field names
get_errors_array();

// Override field names with readable ones for errors
set_field_name($field, $readable_name);
```

# Example (Long format)

The following example is part of a registration form, the flow should be pretty standard

```php
# Note that filters and validators are separate rule sets and method calls. There is a good reason for this.

$v = new validate;

$_POST = $v->sanitize($_POST); // You don't have to sanitize, but it's safest to do so.

$v->validation_rules(array(
	'username'    => 'required|alpha_numeric|max_len,100|min_len,6',
	'password'    => 'required|max_len,100|min_len,6',
	'email'       => 'required|valid_email',
	'gender'      => 'required|exact_len,1|contains,m f',
	'credit_card' => 'required|valid_cc'
));

$v->filter_rules(array(
	'username' => 'trim|sanitize_string',
	'password' => 'trim',
	'email'    => 'trim|sanitize_email',
	'gender'   => 'trim',
	'bio'	   => 'noise_words'
));

$validated_data = $v->run($_POST);

if($validated_data === false) {
	echo $v->get_readable_errors(true);
} else {
	print_r($validated_data); // validation successful
}
```

# Example (Short format)

The short format is an alternative way to run the validation.

```php
$data = array(
	'street' => '6 Avondans Road'
);

$validated = validate::is_valid($data, array(
	'street' => 'required|street_address'
));

if($validated === true) {
	echo "Valid Street Address!";
} else {
	print_r($validated);
}
```

## Check if specific value exist:
```php
$v->validation_rules(array(
	'username'    => 'required|alpha_numeric|max_len,100|min_len,6|unique,users',
	'password'    => 'required|max_len,100|min_len,6',
	'email'       => 'required|valid_email|unique,users',
));
```
To check whether a record is exist, add the **unique** rule and the table where to check.

In this example we are checking whether the username and email is already exist in **users** table.

Match data-keys against rules-keys
-------------
We can check if there is a rule specified for every data-key, by adding an extra parameter to the run method.

```
$v->run($_POST, true);
```

If it doesn't match the output will be:
```
There is no validation rule for <span class=\"$field_class\">$field</span>
```

Return Values
-------------
`run()` returns one of two types:

*ARRAY* containing the successfully validated and filtered data when the validation is successful

*BOOLEAN* False when the validation has failed

`validate()` returns one of two types:

*ARRAY* containing key names and validator names when data does not pass the validation.

You can use this array along with your language helpers to determine what error message to show.

*BOOLEAN* value of TRUE if the validation was successful.

`filter()` returns the exact array structure that was parsed as the `$input` parameter, the only difference would be the filtered data.


Available Validators
--------------------
* required `Ensures the specified key value exists and is not empty`
* valid_email `Checks for a valid email address`
* max_len,n `Checks key value length, makes sure it's not longer than the specified length. n = length parameter.`
* min_len,n `Checks key value length, makes sure it's not shorter than the specified length. n = length parameter.`
* exact_len,n `Ensures that the key value length precisely matches the specified length. n = length parameter.`
* alpha `Ensure only alpha characters are present in the key value (a-z, A-Z)`
* alpha_numeric `Ensure only alpha-numeric characters are present in the key value (a-z, A-Z, 0-9)`
* alpha_dash `Ensure only alpha-numeric characters + dashes and underscores are present in the key value (a-z, A-Z, 0-9, _-)`
* alpha_space `Ensure only alpha-numeric characters + spaces are present in the key value (a-z, A-Z, 0-9, \s)`
* numeric `Ensure only numeric key values`
* integer `Ensure only integer key values`
* boolean `Checks for PHP accepted boolean values, returns TRUE for "1", "true", "on" and "yes"`
* float `Checks for float values`
* valid_url `Check for valid URL or subdomain`
* url_exists `Check to see if the url exists and is accessible`
* valid_ip `Check for valid generic IP address`
* valid_ipv4 `Check for valid IPv4 address`
* valid_ipv6 `Check for valid IPv6 address`
* valid_cc `Check for a valid credit card number (Uses the MOD10 Checksum Algorithm)`
* valid_name `Check for a valid format human name`
* contains,n `Verify that a value is contained within the pre-defined value set`
* contains_list,n `Verify that a value is contained within the pre-defined value set. The list of valid values must be provided in semicolon-separated list format (like so: value1;value2;value3;..;valuen). If a validation error occurs, the list of valid values is not revelead (this means, the error will just say the input is invalid, but it won't reveal the valid set to the user.`
* doesnt_contain_list,n `Verify that a value is not contained within the pre-defined value set. Semicolon (;) separated, list not outputted. See the rule above for more info.`
* street_address `Checks that the provided string is a likely street address. 1 number, 1 or more space, 1 or more letters`
* iban `Check for a valid IBAN`
* min_numeric `Determine if the provided numeric value is higher or equal to a specific value`
* max_numeric `Determine if the provided numeric value is lower or equal to a specific value`
* date `Determine if the provided input is a valid date (ISO 8601)`
* starts `Ensures the value starts with a certain character / set of character`
* phone_number `Validate phone numbers that match the following examples: 555-555-5555 , 5555425555, 555 555 5555, 1(519) 555-4444, 1 (519) 555-4422, 1-555-555-5555`
* regex `You can pass a custom regex using the following format: 'regex,/your-regex/'`
* valid_json_string `validate string to check if it's a valid json format`

Available Filters
-----------------
Filters can be any PHP function that returns a string. You don't need to create your own if a PHP function exists that does what you want the filter to do.

* sanitize_string `Remove script tags and encode HTML entities, similar to validate::xss_clean();`
* urlencode `Encode url entities`
* htmlencode `Encode HTML entities`
* sanitize_email `Remove illegal characters from email addresses`
* sanitize_numbers `Remove any non-numeric characters`
* sanitize_floats `Remove any non-float characters`
* trim `Remove spaces from the beginning and end of strings`
* base64_encode `Base64 encode the input`
* base64_decode `Base64 decode the input`
* sha1 `Encrypt the input with the secure sha1 algorithm`
* md5 `MD5 encode the input`
* noise_words `Remove noise words from string`
* json_encode `Create a json representation of the input`
* json_decode `Decode a json string`
* rmpunctuation `Remove all known punctuation characters from a string`
* basic_tags `Remove all layout orientated HTML tags from text. Leaving only basic tags`
* whole_number `Ensure that the provided numeric value is represented as a whole number`
* ms_word_characters `Converts MS Word special characters [“”‘’–…] to web safe characters`
* lower_case `Converts to lowercase`
* upper_case `Converts to uppercase`
* slug `Creates web safe url slug`

#  Creating your own validators and filters

Adding custom validators and filters is made easy by using callback functions.

```php


/*
   Create a custom validation rule named "is_object".
   The callback receives 3 arguments:
   The field to validate, the values being validated, and any parameters used in the validation rule.
   It should return a boolean value indicating whether the value is valid.
*/
validate::add_validator("is_object", function($field, $input, $param = NULL) {
    return is_object($input[$field]);
});

/*
   Create a custom filter named "upper".
   The callback function receives two arguments:
   The value to filter, and any parameters used in the filter rule. It should returned the filtered value.
*/
validate::add_filter("upper", function($value, $params = NULL) {
    return strtoupper($value);
});

```

Alternately, you can simply create your own class that extends the validate class.

```php

class MyClass extends validate
{
	public function filter_myfilter($value, $param = NULL)
	{
		...
	}

	public function validate_myvalidator($field, $input, $param = NULL)
	{
		...
	}

} // EOC

$validator = new MyClass();

$validated = $validator->validate($_POST, $rules);

```

Please see `examples/custom_validator.php` for further information.

Remember to create a public methods with the correct parameter types and parameter counts.

* For filter methods, prepend the method name with "filter_".
* For validator methods, prepend the method name with "validate_".

# Set Custom Field Names

You can easily override your form field names for improved readability in errors using the `validate::set_field_name($field, $readable_name)` method as follows:

```php
$data = array(
	'str' => null
);

$rules = array(
	'str' => 'required'
);

validate::set_field_name("str", "Street");

$validated = validate::is_valid($data, $rules);

if($validated === true) {
	echo "Valid Street Address\n";
} else {
	print_r($validated);
}
```

# validating file fields

```php
$is_valid = validate::is_valid(array_merge($_POST,$_FILES), array(
	'title' => 'required|alpha_numeric',
	'image' => 'required_file|extension,png;jpg'
));

if($is_valid === true) {
	// continue
} else {
	print_r($is_valid);
}
```
credits to https://github.com/Wixel/GUMP

