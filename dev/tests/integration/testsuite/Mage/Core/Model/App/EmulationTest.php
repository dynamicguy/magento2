<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Mage_Core
 * @subpackage  integration_tests
 * @copyright   Copyright (c) 2012 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Mage_Core_Model_App_EmulationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Mage_Core_Model_App_Emulation
     */
    protected $_model;

    /**
     * @covers Mage_Core_Model_App_Emulation::startEnvironmentEmulation
     * @covers Mage_Core_Model_App_Emulation::stopEnvironmentEmulation
     */
    public function testEnvironmentEmulation()
    {
        $this->_model = Mage::getModel('Mage_Core_Model_App_Emulation');
        Mage::getDesign()->setArea(Mage_Core_Model_App_Area::AREA_ADMINHTML);

        $initialEnvInfo = $this->_model->startEnvironmentEmulation(1);
        $initialDesign = $initialEnvInfo->getInitialDesign();
        $this->assertEquals(Mage_Core_Model_App_Area::AREA_ADMINHTML, $initialDesign['area']);
        $this->assertEquals(Mage_Core_Model_App_Area::AREA_FRONTEND, Mage::getDesign()->getArea());

        $this->_model->stopEnvironmentEmulation($initialEnvInfo);
        $this->assertEquals(Mage_Core_Model_App_Area::AREA_ADMINHTML, Mage::getDesign()->getArea());
    }
}
