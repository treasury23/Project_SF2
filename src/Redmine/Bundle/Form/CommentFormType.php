<?php
/**
 * Created by JetBrains PhpStorm.
 * User: vitya
 * Date: 03.07.15
 * Time: 15:09
 * To change this template use File | Settings | File Templates.
 */

namespace Redmine\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('text', 'textarea',  array('label'=>'Комментарий:',
            'attr'=>array('placeholder' => 'Введите текст', 'maxlength' => 1024),
            'required'=>true,
            'trim' => true,
            'constraints' => new NotBlank()));
    }

        public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Redmine\Bundle\Entity\Comment',
        );
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'comment';
    }
}
