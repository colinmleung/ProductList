<?php

namespace Daiga\ProductList\Model;

class ProductListItem extends \Magento\Framework\Model\AbstractModel
	implements \Daiga\ProductList\Api\Data\ProductListItemInterface
{

	public function _construct()
	{
		$this->_init('Daiga\ProductList\Model\ResourceModel\ProductListItem');
	}

	public function getProductId()
	{
		return parent::getProductId();
	}
}
