<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Daiga\ProductList\Api\Data;

interface ProductListInterface
{
    /**
     * Retrieve list type
     * @return int
     */
    public function getListType();

    /**
     * Retrieve items
     * @return int[]
     */
    public function getItems();
}
