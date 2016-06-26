<?php

namespace Daiga\ProductList\Model;

class ProductList extends \Magento\Framework\Model\AbstractModel
	implements \Daiga\ProductList\Api\Data\ProductListInterface
{
	const WISHLIST = 0;
	const SHARELIST = 1;
	const CARTLIST = 2;

	protected $_productListItemCollectionFactory;
	protected $_productListItemFactory;
	protected $_logger;

	public function __construct(
		\Magento\Framework\Model\Context $context,
    \Magento\Framework\Registry $registry,
    \Daiga\ProductList\Model\ResourceModel\ProductList $resource,
    \Daiga\ProductList\Model\ResourceModel\ProductList\Collection $resourceCollection,
		\Daiga\ProductList\Model\ResourceModel\ProductListItem\CollectionFactory $productListItemCollectionFactory,
		\Daiga\ProductList\Model\ProductListItemFactory $productListItemFactory,
		array $data = []
	) {
		parent::__construct($context, $registry, $resource, $resourceCollection, $data);
		$this->_productListItemCollectionFactory = $productListItemCollectionFactory;
		$this->_productListItemFactory = $productListItemFactory;
		$this->_logger = $context->getLogger();
	}

	public function _construct()
	{
		$this->_init('Daiga\ProductList\Model\ResourceModel\ProductList');
	}

	public function getListType()
	{
		return parent::getListType();
	}

	public function getItems()
	{
		$listOfItems = $this->_productListItemCollectionFactory->create()
			->addFieldToFilter('productlist_id', parent::getData('productlist_id'));

		$itemArray = array();
		foreach ($listOfItems as $item) {
			array_push($itemArray, $item->getProductId());
		}
		return $itemArray;
	}

	public function addItem($productId) {
			$item = $this->_productListItemFactory->create();
			//$this->_logger->addInfo('product list id');
			//$this->_logger->addInfo(parent::getData('productlist_id'));

			$currentItems = $this->_productListItemCollectionFactory->create()
			->addFieldToFilter('productlist_id', parent::getData('productlist_id'));

			foreach($currentItems as $item) {
				if ($item->getProduct() == $productId) return $this;
			}

			$item->setProductId($productId);
			$item->setData('productlist_id', parent::getData('productlist_id'));
			$item->setQty(1);
			$item->save();
			return $this;
	}

	public function deleteItem($productId) {
		$items = $this->_productListItemCollectionFactory->create()
			->addFieldToFilter('productlist_id', parent::getData('productlist_id'));

		foreach($items as $item) {
			if ($item->getProductId() == $productId) $item->delete();
	  }
	  return $this;
	}
}
