<?php

namespace Daiga\ProductList\Model\ResourceModel\ProductList;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected function _construct()
	{
		$this->_init('Daiga\ProductList\Model\ProductList', 'Daiga\ProductList\Model\ResourceModel\ProductList');
	}
}
