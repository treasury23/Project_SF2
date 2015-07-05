<?php

namespace Redmine\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class LogFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('hours', 'number',  array('label'=>'Hours',
            'attr'=>array('placeholder' => 'Hours', 'maxlength' => 10 ),
            'required'=>true,
            'scale'=> 2,
            'constraints' => new Length(array('max' => 6))));

        $builder->add('comment', 'text',  array('label'=>'Comment:',
            'attr'=>array('placeholder' => 'Comment', 'maxlength' => 255),
            'required'=>false,
            'trim' => true));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Redmine\Bundle\Entity\Log',
        );
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'log';
    }
}