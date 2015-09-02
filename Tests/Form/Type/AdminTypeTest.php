<?php

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\AdminBundle\Tests\Form\Type;

use stdClass;

use Sonata\AdminBundle\Form\Type\AdminType;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilder;

use Sonata\AdminBundle\Tests\Fixtures\Admin\FieldDescription;

class AdminTypeTest extends TypeTestCase
{
    public function testGetDefaultOptions()
    {
        $type = new AdminType();

        $optionResolver = new OptionsResolver();

        $type->setDefaultOptions($optionResolver);

        $options = $optionResolver->resolve();

        $this->assertTrue($options['delete']);
        $this->assertFalse($options['auto_initialize']);
        $this->assertSame('link_add', $options['btn_add']);
        $this->assertSame('link_list', $options['btn_list']);
        $this->assertSame('link_delete', $options['btn_delete']);
        $this->assertSame('SonataAdminBundle', $options['btn_catalogue']);
    }

    public function testBuildForm()
    {
        $type = new AdminType();

        $formFactory = $this->getMock('Symfony\Component\Form\FormFactoryInterface');
        $eventDispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');

        $formBuilder = new FormBuilder('test', 'stdClass', $eventDispatcher, $formFactory);

        $childFormBuilder = new FormBuilder('elementId', 'stdClass', $eventDispatcher, $formFactory);
        $formBuilder->add($childFormBuilder);

        $description = new FieldDescription();
        $description->setName('firstView');
        $description->setOptions(array('type' => 'sonata_type_admin', 'template' => NULL, 'help' => NULL));

        // (object)array(
        //         '__CLASS__' => 'Sonata\\DoctrineORMAdminBundle\\Admin\\FieldDescription',
        //         'name' => 'firstView',
        //         'type' => 'sonata_type_admin',
        //         'mappingType' => 1,
        //         'fieldName' => 'firstView',
        //         'associationMapping' => 'Array(19)',
        //         'fieldMapping' => NULL,
        //         'parentAssociationMappings' => 'Array(0)',
        //         'template' => NULL,
        //         'options' => 'Array(5)',
        //         'parent' => NULL,
        //         'admin' => 'MyLittle\\Bundle\\TheFiftyGiftsAppBundle\\Admin\\OfferAdmin',
        //         'associationAdmin' => 'MyLittle\\Bundle\\TheFiftyGiftsAppBundle\\Admin\\FirstViewThumbAdmin',
        //         'help' => NULL,
        //     ),

        $options = array ( 
            'block_name' => NULL,
            'disabled' => false,
            'attr' => array ( ),
            'translation_domain' => NULL,
            'auto_initialize' => false,
            // 'empty_data' => stdClass::__set_state(
            //     array( 
            //         '__CLASS__' => 'Closure',
            //     )
            // ),
            'trim' => true,
            'required' => true,
            'read_only' => false,
            'max_length' => NULL,
            'pattern' => NULL,
            'property_path' => NULL,
            'mapped' => true,
            'by_reference' => true,
            'error_bubbling' => true,
            'label_attr' => array ( ),
            'virtual' => NULL,
            'inherit_data' => false,
            'compound' => true,
            'method' => 'POST',
            'action' => '',
            'post_max_size_message' => 'The uploaded file was too large. Please try to upload a smaller file.',
            'validation_groups' => NULL,
            'error_mapping' => array ( ),
            'constraints' => array ( ),
            'cascade_validation' => false,
            'invalid_message' => 'This value is not valid.',
            'invalid_message_parameters' => array ( ),
            'extra_fields_message' => 'This form should not contain extra fields.',
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_provider' => (object)
                array(
                    '__CLASS__' => 'Symfony\\Component\\Form\\Extension\\Csrf\\CsrfProvider\\SessionCsrfProvider',
                    'session' => 'Symfony\\Component\\HttpFoundation\\Session\\Session',
                    'secret' => 'ThisTokenIsNotSoSecretChangeIt',
                ),
            'csrf_message' => 'The CSRF token is invalid. Please try to resubmit the form.',
            'intention' => NULL,
            'sonata_admin' => NULL,
            'sonata_help' => NULL,
            'horizontal_label_class' => '',
            'horizontal_label_offset_class' => '',
            'horizontal_input_wrapper_class' => '',
            'delete_options' => array ( 'type' => 'checkbox',
                'type_options' => 'Array(2)',
            ),
            'btn_list' => 'link_list',
            'btn_delete' => 'link_delete',
            'btn_catalogue' => 'SonataAdminBundle',
            'sonata_field_description' => $description,
            'btn_add' => false,
            'delete' => false,
            'data_class' => 'MyLittle\\Bundle\\TheFiftyGiftsAppBundle\\Entity\\FirstViewThumb',
            'label_render' => false,
            'label' => 'First View',
        );

        $type->buildForm($formBuilder, $options);
    }
}
