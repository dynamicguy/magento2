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
 * @category    Mage
 * @package     Mage_ImportExport
 * @copyright   Copyright (c) 2012 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Collection by pages iterator
 *
 * @category    Mage
 * @package     Mage_ImportExport
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_ImportExport_Model_Resource_CollectionByPagesIterator
{
    /**
     * Load collection page by page and apply callbacks to each collection item
     *
     * @param Varien_Data_Collection_Db $collection Collection to load page by page
     * @param int $pageSize Number of items to fetch from db in one query
     * @param array $callbacks Array of callbacks which should be applied to each collection item
     */
    public function iterate(Varien_Data_Collection_Db $collection, $pageSize, array $callbacks)
    {
        /** @var $paginatedCollection Varien_Data_Collection_Db */
        $paginatedCollection = null;
        $pageNumber = 1;
        do {
            $paginatedCollection = clone $collection;
            $paginatedCollection->clear();

            $paginatedCollection->setPageSize($pageSize)
                ->setCurPage($pageNumber);

            if ($paginatedCollection->count() > 0) {
                foreach ($paginatedCollection as $item) {
                    foreach ($callbacks as $callback) {
                        call_user_func($callback, $item);
                    }
                }
            }

            $pageNumber++;
        } while ($pageNumber <= $paginatedCollection->getLastPageNumber());

        $paginatedCollection->clear();
        unset($paginatedCollection);
    }
}
