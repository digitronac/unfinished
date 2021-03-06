<?php

namespace Core\Filter;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class TagFilter implements InputFilterAwareInterface
{
    protected $inputFilter;

    public function getInputFilter()
    {
        if(!$this->inputFilter){
            $inputFilter = new InputFilter();

            $inputFilter->add([
                'name'       => 'name',
                'required'   => true,
                'filters'    => [['name' => 'StringTrim']],
                'validators' => [
                    ['name' => 'NotEmpty'],
                    ['name' => 'StringLength', 'options' => ['min' => 2, 'max' => 100]],
                ],
            ]);

            $inputFilter->add([
                'name'       => 'slug',
                'required'   => true,
                'filters'    => [['name' => 'StringTrim']],
                'validators' => [
                    ['name' => 'NotEmpty'],
                    ['name' => 'StringLength', 'options' => ['min' => 2, 'max' => 100]],
                ],
            ]);

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }
}