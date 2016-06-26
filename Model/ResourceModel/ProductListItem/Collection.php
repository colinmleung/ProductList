<?php

namespace Daiga\ProductList\Model\ResourceModel\ProductListItem;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected function _construct()
	{
		$this->_init('Daiga\ProductList\Model\ProductListItem', 'Daiga\ProductList\Model\ResourceModel\ProductListItem');
	}
}
