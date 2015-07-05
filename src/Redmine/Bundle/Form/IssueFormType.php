<?php

namespace Redmine\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class IssueFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('done', 'integer',  array('label'=>'% Done',
            'attr'=>array('min'=>0, 'max'=>100 ),
            'required'=>true,
            'trim' => true,
            'constraints' => new Length(array('max' => 3))));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Redmine\Bundle\Entity\Issue',
        );
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'issue';
    }
}