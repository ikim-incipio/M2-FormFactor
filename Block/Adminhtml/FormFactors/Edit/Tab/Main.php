<?php
/**
 * Copyright © 2018 Incipio
 * 2018-08 Isaac Kim
 */

namespace Incipio\FormFactor\Block\Adminhtml\FormFactors\Edit\Tab;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Magento\Store\Model\System\Store;
use Incipio\FormFactor\Helper\Data;

class Main extends Generic implements TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * Constructor
     *
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Store $systemStore
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Store $systemStore,
        Data $dataHelper,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_dataHelper = $dataHelper;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Details');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Details');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('current_formfactor');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('formfactor_');

        $fieldset = $form->addFieldset('general', ['legend' => __('Form Factor Details')]);
        if ($model->getFormfactorId()) {
            $fieldset->addField('formfactor_id', 'hidden', ['name' => 'formfactor_id']);
        }

        $fieldset->addField('code', 'text', array(
            'name' => 'code',
            'label' => __('Code'),
            'title' => __('Code'),
            'required' => true
        ));

        $fieldset->addField('name', 'text', array(
            'name' => 'name',
            'label' => __('Name'),
            'title' => __('Name'),
            'required' => true
        ));

        $fieldset->addField('status', 'select', array(
            'name' => 'status',
            'label' => __('Status'),
            'title' => __('Status'),
            'values'    => array(
                0 => __('Inactive'),
                1 => __('Active'),
            )
        ));

        $prodFieldset = $form->addFieldset('product', ['legend' => __('Product Information')]);

        $prodFieldset->addField('category', 'select', array(
            'name' => 'category',
            'label' => __('Use Category Products'),
            'title' => __('Use Category Products'),
            'values'    => array(
                0 => __('No'),
                1 => __('Yes'),
            )
        ));

        $prodFieldset->addField('product_title', 'text', array(
            'name' => 'product_title',
            'label' => __('Product Title'),
            'title' => __('Product Title')
        ));

        $prodFieldset->addField('product_desc', 'textarea', array(
            'name' => 'product_desc',
            'label' => __('Product Description'),
            'title' => __('Product Description')
        ));

        $prodFieldset->addField('product_price', 'text', array(
            'name' => 'product_price',
            'label' => __('Product Price'),
            'title' => __('Product Price')
        ));

        $prodFieldset->addField('product_image', 'text', array(
            'name' => 'product_image',
            'label' => __('Product Image'),
            'title' => __('Product Image')
        ));

        $prodFieldset->addField('device_slider_status', 'select', array(
            'name' => 'device_slider_status',
            'label' => __('Use Device Slider'),
            'title' => __('Use Device Slider'),
            'values'    => array(
                0 => __('No'),
                1 => __('Yes'),
            )
        ));

        $prodFieldset->addField('device_slider', 'textarea', array(
            'name' => 'device_slider',
            'label' => __('Device Slider'),
            'title' => __('Device Slider')
        ));

        $prodFieldset->addField('manufacturer_options', 'textarea', array(
            'name' => 'manufacturer_options',
            'label' => __('Manufacturer Options'),
            'title' => __('Manufacturer Options')
        ));

        $prodFieldset->addField('device_options', 'textarea', array(
            'name' => 'device_options',
            'label' => __('Device Options'),
            'title' => __('Device Options')
        ));

        $heroFieldset = $form->addFieldset('hero', ['legend' => __('Hero Image')]);

        $heroFieldset->addField('hero_title', 'text', array(
            'name' => 'hero_title',
            'label' => __('Hero Title'),
            'title' => __('Hero Title')
        ));

        $heroFieldset->addField('hero_desc', 'textarea', array(
            'name' => 'hero_desc',
            'label' => __('Hero Description'),
            'title' => __('Hero Description')
        ));

        $heroFieldset->addField('hero_color', 'text', array(
            'name' => 'hero_color',
            'label' => __('Hero Text Color'),
            'title' => __('Hero Text Color')
        ));

        $heroFieldset->addField('hero_image', 'text', array(
            'name' => 'hero_image',
            'label' => __('Hero Image'),
            'title' => __('Hero Image')
        ));

        $utilityFieldset = $form->addFieldset('utility', ['legend' => __('Utility Section')]);

        $utilityFieldset->addField('utility_title', 'text', array(
            'name' => 'utility_title',
            'label' => __('Utility Title'),
            'title' => __('Utility Title')
        ));

        $utilityFieldset->addField('utility_desc', 'textarea', array(
            'name' => 'utility_desc',
            'label' => __('Utility Description'),
            'title' => __('Utility Description')
        ));

        $utilityFieldset->addField('utility_media', 'text', array(
            'name' => 'utility_media',
            'label' => __('Utility Media'),
            'title' => __('Utility Media')
        ));

        $featuresFieldset = $form->addFieldset('feature', ['legend' => __('Features Section')]);

        $featuresFieldset->addField('feature_title', 'text', array(
            'name' => 'feature_title',
            'label' => __('Feature Title'),
            'title' => __('Feature Title')
        ));

        $featuresFieldset->addField('feature_desc', 'text', array(
            'name' => 'feature_desc',
            'label' => __('Feature Desc'),
            'title' => __('Feature Desc')
        ));

        $featuresFieldset->addField('feature_one', 'text', array(
            'name' => 'feature_one',
            'label' => __('Feature 1'),
            'title' => __('Feature 1')
        ));

        $featuresFieldset->addField('feature_two', 'text', array(
            'name' => 'feature_two',
            'label' => __('Feature 2'),
            'title' => __('Feature 2')
        ));

        $featuresFieldset->addField('feature_three', 'text', array(
            'name' => 'feature_three',
            'label' => __('Feature 3'),
            'title' => __('Feature 3')
        ));

        $featuresFieldset->addField('feature_four', 'text', array(
            'name' => 'feature_four',
            'label' => __('Feature 4'),
            'title' => __('Feature 4')
        ));

        $featuresFieldset->addField('feature_five', 'text', array(
            'name' => 'feature_five',
            'label' => __('Feature 5'),
            'title' => __('Feature 5')
        ));

        $featuresFieldset->addField('feature_image', 'text', array(
            'name' => 'feature_image',
            'label' => __('Feature Image'),
            'title' => __('Feature Image')
        ));

        $featuresFieldset->addField('feature_bgcolor', 'text', array(
            'name' => 'feature_bgcolor',
            'label' => __('Feature Background Color'),
            'title' => __('Feature Background Color')
        ));

        $featuresFieldset->addField('second_feature_title', 'text', array(
            'name' => 'second_feature_title',
            'label' => __('Second Feature Title'),
            'title' => __('Second Feature Title')
        ));

        $featuresFieldset->addField('second_feature_desc', 'text', array(
            'name' => 'second_feature_desc',
            'label' => __('Second Feature Desc'),
            'title' => __('Second Feature Desc')
        ));

        $featuresFieldset->addField('second_feature_one', 'text', array(
            'name' => 'second_feature_one',
            'label' => __('Second Feature 1'),
            'title' => __('Second Feature 1')
        ));

        $featuresFieldset->addField('second_feature_two', 'text', array(
            'name' => 'second_feature_two',
            'label' => __('Second Feature 2'),
            'title' => __('Second Feature 2')
        ));

        $featuresFieldset->addField('second_feature_three', 'text', array(
            'name' => 'second_feature_three',
            'label' => __('Second Feature 3'),
            'title' => __('Second Feature 3')
        ));

        $featuresFieldset->addField('second_feature_four', 'text', array(
            'name' => 'second_feature_four',
            'label' => __('Second Feature 4'),
            'title' => __('Second Feature 4')
        ));

        $featuresFieldset->addField('second_feature_five', 'text', array(
            'name' => 'second_feature_five',
            'label' => __('Second Feature 5'),
            'title' => __('Second Feature 5')
        ));

        $featuresFieldset->addField('second_feature_image', 'text', array(
            'name' => 'second_feature_image',
            'label' => __('Second Feature Image'),
            'title' => __('Second Feature Image')
        ));

        $featuresFieldset->addField('second_feature_bgcolor', 'text', array(
            'name' => 'second_feature_bgcolor',
            'label' => __('Second Feature Background Color'),
            'title' => __('Second Feature Background Color')
        ));

        $lifestyleFieldset = $form->addFieldset('lifestyle', ['legend' => __('Lifestyle Section')]);

        $lifestyleFieldset->addField('lifestyle_image_large', 'text', array(
            'name' => 'lifestyle_image_large',
            'label' => __('Lifestyle Large Image'),
            'title' => __('Lifestyle Large Image')
        ));

        $lifestyleFieldset->addField('lifestyle_image_small_one', 'text', array(
            'name' => 'lifestyle_image_small_one',
            'label' => __('Lifestyle Small Image 1'),
            'title' => __('Lifestyle Small Image 1')
        ));

        $lifestyleFieldset->addField('lifestyle_image_small_two', 'text', array(
            'name' => 'lifestyle_image_small_two',
            'label' => __('Lifestyle Small Image 2'),
            'title' => __('Lifestyle Small Image 2')
        ));

        $heroFieldset = $form->addFieldset('featured_tile_img', ['legend' => __('Image For Featured Page')]);

        $heroFieldset->addField('featured_tile_img_url', 'text', array(
            'name' => 'featured_tile_img_url',
            'label' => __('Feature Page Tile Image'),
            'title' => __('Feature Page Tile Image')
        ));

        if(!$model->getData()) {
            $model->setData('status', 1);
        }
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }
}
