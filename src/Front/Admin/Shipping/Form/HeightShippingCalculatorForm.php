<?php

namespace App\Front\Admin\Shipping\Form;

use Sylius\Bundle\MoneyBundle\Form\Type\MoneyType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

class HeightShippingCalculatorForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('max_height', IntegerType::class)
            ->add('above_or_equal', MoneyType::class)
            ->add('below', MoneyType::class);
    }
}
