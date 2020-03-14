<?php

class Request
{
    private $errors = [];
    
    public function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public function clear($str)
    {
        return strip_tags( trim($str) );
    }

    public function getField($inputName)
    {
        $value = $_POST[$inputName] ?? '';

        return $this->clear($value);
    }

    public function required($inputName)
    {
        $value = $this->getField($inputName);
        if(empty($value))
        {
            $this->errors[$inputName][] = 'поле обязательно к заполнению';
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * проверяет длину строки из поля на минимальное значения
     * @param $inputName
     * @param $min
     */
    public function minLength($inputName, $min)
    {
        $value = $this->getField($inputName);
        if (strlen($value)<$min)
        {
        	$this->errors[$inputName][] = "Минимальная длина сроки $min";
        }
    }


    /**
     * проверяет длину строки из поля на максимальное значения
     * @param $inputName
     * @param $max
     */
    public function maxLength($inputName, $max)
    {
        $value = $this->getField($inputName);
        if (strlen($value)>$max)
        {
            $this->errors[$inputName][] = "Слишком длинный текст, максимальная длина $max";
        }
    }

    /**
     * проверка значения на максимальность
     * метод проверяет является ли введенное значение email
     * @param $inputName - имя поля
     */
    public function isEmail($inputName)
    {
        $value = strpos($this->getField($inputName), '@');
        if (!$value)
        {
            $this->errors[$inputName][] = 'Пожалуйста, введите корректный Email';
        }

    }

    /**
     * проверка значения на максимальность
     * @param $inputName
     * @param $minValue
     */
    public function maxValue($inputName, $maxValue)
    {
        $value = $this->getField($inputName);
        if ($value>$maxValue)
        {
            $this->errors[$inputName][] = "Максимальное число - $maxValue";
        }
    }

    /**
     * проверка значения на минимальность
     * @param $inputName
     * @param $minValue
     */
    public function minValue($inputName, $minValue)
    {
        $value = $this->getField($inputName);
        if ($value<$minValue)
        {
            $this->errors[$inputName][] = "Минимальное число - $minValue";
        }
    }


    
}
?>