<?php

namespace App\Helper\Validation;

Use Simple\Model;

class Validator extends BaseValidator
{
    /**
     * Use to check wether the given field and value exist in the database
     * @param $field
     * @param $input
     * @param array $param
     * @return array|void
     */
    public function validate_unique(
        $field,
        $input,
        $param = []
    ) {
        self::set_error_messages(array(
            "unique"    =>  "{field} is already Taken.",
        ));
        $call = Model::unique_checker($param, $field, $input[$field]);
        if(!$call) {
            return;
        }
        return array(
            'field' => $field,
            'value' => $input[$field],
            'rule'  => __FUNCTION__,
            'param' => $param,
        );
	}
}