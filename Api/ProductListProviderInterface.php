<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Daiga\ProductList\Api;

interface ProductListProviderInterface
{
    /**
     * Retrieve wishlist
     *
     * @param int $customerId
     * @return \Daiga\ProductList\Api\Data\ProductListInterface
     */
    public function getWishListForCustomer($customerId);

    /**
     * Retrieve sharelist
     *
     * @param int $customerId
     * @return \Daiga\ProductList\Api\Data\ProductListInterface
     */
    public function getShareListForCustomer($customerId);

    /**
     * Retrieve cartlist
     *
     * @param int $customerId
     * @return \Daiga\ProductList\Api\Data\ProductListInterface
     */
    public function getCartListForCustomer($customerId);

    /**
     * Adds item to wishlist
     *
     * @param int $customerId
     * @param int $productId
     * @return \Daiga\ProductList\Api\Data\ProductListInterface
     */
    public function addItemToWishList($customerId, $productId);

    /**
     * Adds item to sharelist
     *
     * @param int $customerId
     * @param int $productId
     * @return \Daiga\ProductList\Api\Data\ProductListInterface
     */
    public function addItemToShareList($customerId, $productId);

    /**
     * Adds item to cartlist
     *
     * @param int $customerId
     * @param int $productId
     * @return \Daiga\ProductList\Api\Data\ProductListInterface
     */
    public function addItemToCartList($customerId, $productId);

    /**
     * Deletes item from wishlist
     *
     * @param int $customerId
     * @param int $productId
     * @return \Daiga\ProductList\Api\Data\ProductListInterface
     */
    public function deleteItemFromWishList($customerId, $productId);

    /**
     * Deletes item from sharelist
     *
     * @param int $customerId
     * @param int $productId
     * @return \Daiga\ProductList\Api\Data\ProductListInterface
     */
    public function deleteItemFromShareList($customerId, $productId);

    /**
     * Deletes item from cartlist
     *
     * @param int $customerId
     * @param int $productId
     * @return \Daiga\ProductList\Api\Data\ProductListInterface
     */
    public function deleteItemFromCartList($customerId, $productId);
}
