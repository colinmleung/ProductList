<?php

namespace Daiga\ProductList\Model;

use Psr\Log\LoggerInterface;

class ProductListProvider implements \Daiga\ProductList\Api\ProductListProviderInterface {

		protected $_productListCollectionFactory;
		protected $_productListFactory;
        protected $_productListResourceFactory;
        protected $_productRepository;
        protected $_customerRepository;

	   /**
     * Initialize dependencies.
     *
     * @param \Daiga\ProductList\Model\ResourceModel\ProductListFactory $productListResourceFactory
     * @param \Daiga\ProductList\Model\ProductListFactory $productListFactory
     * @param \Daiga\ProductList\Model\ResourceModel\ProductList\CollectionFactory $productListCollectionFactory
     * @param \Magento\Catalog\Api\ProductRepositoryInterface
     * @param \Magento\Customer\Api\CustomerRepositoryInterface
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Daiga\ProductList\Model\ResourceModel\ProductListFactory $productListResourceFactory,
    	\Daiga\ProductList\Model\ProductListFactory $productListFactory,
        \Daiga\ProductList\Model\ResourceModel\ProductList\CollectionFactory $productListCollectionFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->_productListResourceFactory = $productListResourceFactory;
    	$this->_productListFactory = $productListFactory;
        $this->_productListCollectionFactory = $productListCollectionFactory;
        $this->_productRepository = $productRepository;
        $this->_customerRepository = $customerRepository;
        $this->_logger = $logger;
    }

    public function getWishListForCustomer($customerId) {
        return $this->getList($customerId, 0);
    }

    public function getShareListForCustomer($customerId) {
        return $this->getList($customerId, 1);
    }

    public function getCartListForCustomer($customerId) {
        return $this->getList($customerId, 2);
    }

    public function addItemToWishList($customerId, $productId) {
        return $this->addItemToList($customerId, 0, $productId);
    }

    public function addItemToShareList($customerId, $productId) {
        return $this->addItemToList($customerId, 1, $productId);
    }

    public function addItemToCartList($customerId, $productId) {
        return $this->deleteItemFromList($customerId, 2, $productId);
    }

    public function deleteItemFromWishlist($customerId, $productId) {
        return $this->deleteItemFromList($customerId, 0, $productId);
    }

    public function deleteItemFromShareList($customerId, $productId) {
        return $this->deleteItemFromList($customerId, 1, $productId);
    }

    public function deleteItemFromCartList($customerId, $productId) {
        return $this->deleteItemFromList($customerId, 2, $productId);
    }

    public function getList($customerId, $listType) {

        $this->_customerRepository->getById($customerId); // check if customer exists

        $productList = $this->_productListCollectionFactory->create()
            ->addFieldToFilter('customer_id', $customerId)
            ->addFieldToFilter('list_type', $listType)
            ->getFirstItem();

        $this->_logger->addInfo($productList->getListType() == NULL);
        if ($productList->getListType() == NULL) {
            $productList = $this->_productListFactory->create();
            $productList->setCustomerId($customerId);
            $productList->setListType($listType);
            $productList->save();
        }

        return $productList;
    }

    public function addItemToList($customerId, $listType, $productId) {

        $this->_productRepository->getById($productId); // check if product exists
        $this->_customerRepository->getById($customerId); // check if customer exists

        $productList = $this->getList($customerId, $listType);
        $productList->addItem($productId);
        return $productList;
    }

    public function deleteItemFromList($customerId, $listType, $productId) {

        $this->_productRepository->getById($productId); // check if product exists
        $this->_customerRepository->getById($customerId); // check if customer exists

        $productList = $this->getList($customerId, $listType);
        $productList->deleteItem($productId);
        return $productList;
    }
}
