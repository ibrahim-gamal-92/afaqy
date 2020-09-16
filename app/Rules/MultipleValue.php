<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MultipleValue implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $options;
    protected $error;

    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $items = explode(',', $value);
        foreach ($items as $item){
            if(!in_array($item, $this->options)){
                $this->error = $item;
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->error . ' is invalid value';
    }
}
