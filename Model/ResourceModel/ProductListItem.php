<?php

namespace Daiga\ProductList\Model\ResourceModel;

class ProductListItem extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	public function _construct()
	{
		$this->_init('productlist_item', 'productlist_item_id');
	}
}
