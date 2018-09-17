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
    
    
    use AppBundle\DTO\UserDTO;
    use Proxies\__CG__\AppBundle\Entity\User;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    class UserDTOType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add('id',CheckboxType::class)
                    ->add('nom')
                    ->add('prenom')
                    ->add('pseudo')
                    ->add('dateNaissance')
                    ->add('photo');
        }
        
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults(array(
                'data_class'=>UserDTO::class,
            ));
        }
    }