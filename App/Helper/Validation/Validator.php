<?php
namespace App\Helper\Validation;

Use Simple\Model;

class Validator extends BaseValidator
{
    public function validate_unique($field, $input, $param = NULL)
	{
        self::set_error_messages(array(
            "validate_unique"     => "{field} is already Taken.",
        ));
        $call = Model::unique_checker($param,$field,$input[$field]);
        if(!$call) {
            return;
        }
        return array(
            'field' => $field,
            'value' => $input[$field],
            'rule' => __FUNCTION__,
            'param' => $param,
        );
	}
}