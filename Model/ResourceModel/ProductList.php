<?php

namespace Daiga\ProductList\Model\ResourceModel;

class ProductList extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	public function _construct()
	{
		$this->_init('productlist', 'productlist_id');
	}
}
