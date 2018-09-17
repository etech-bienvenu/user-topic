<?php
    /**
     * Description courte du fichier
     * Description longue du fichier s'il y en a une
     * LICENSE: Informations sur la licence
     * @copyright  Copyright (c) 2011-2012 Council of Europe (www.coe.int)
     * @license    http://static.coe.int/licenses/lgpl
     * @version    $Id:$
     * @since      File available since Release xxx
     */
    
    namespace AppBundle\Form;
    
    
    use AppBundle\DTO\TopicDTO;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\CollectionType;
    use Symfony\Component\Form\Extension\Core\Type\HiddenType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class TopicDTOType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add('title',HiddenType::class)
                    ->add('users',CollectionType::class,array(
                        'entry_type' => UserDTOType::class,
                        'entry_options'=>array('label'=>false),
                    ));
        }
        
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(array(
                'data_class' => TopicDTO::class,
            ));
        }
    }