<?php
class AllDownloadsDefaultModuleFrontController extends ModuleFrontController
{
	function getCustomerOrders2($id_customer, $showHiddenStatus = false)
	{
	

		$res = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
		SELECT o.*, (SELECT SUM(od.`product_quantity`) FROM `'._DB_PREFIX_.'order_detail` od WHERE od.`id_order` = o.`id_order`) nb_products
		FROM `'._DB_PREFIX_.'orders` o
		WHERE o.`id_customer` = '.(int)$id_customer.' AND o.`valid` = 1
		GROUP BY o.`id_order`
		ORDER BY o.`date_add` DESC');
		if (!$res)
			return array();

		foreach ($res AS $key => $val)
		{
			$res2 = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
			SELECT os.`id_order_state`, osl.`name` AS order_state, os.`invoice`
			FROM `'._DB_PREFIX_.'order_history` oh
			LEFT JOIN `'._DB_PREFIX_.'order_state` os ON (os.`id_order_state` = oh.`id_order_state`)
			INNER JOIN `'._DB_PREFIX_.'order_state_lang` osl ON (os.`id_order_state` = osl.`id_order_state` AND osl.`id_lang` = '.(int)($this->context->language->id).')
			WHERE oh.`id_order` = '.(int)($val['id_order']).(!$showHiddenStatus ? ' AND os.`hidden` != 1' : '').'
			ORDER BY oh.`date_add` DESC, oh.`id_order_history` DESC
			LIMIT 1');
			if ($res2)
				$res[$key] = array_merge($res[$key], $res2[0]);
		}
		return $res;
	}
	function getDet($id_order)
	{
		if(_PS_VERSION_ < "1.5.0.0"){
		$query = 'SELECT ord.id_order_detail as `id`, ord.`product_id`, ord.`product_price`, ord.`id_order`, ord.`product_attribute_id`, ord.`product_quantity`, ord.`product_name`, pd.display_filename,pd.physically_filename, ord.download_hash, ord.download_deadline
		FROM `'._DB_PREFIX_.'order_detail` ord
		LEFT JOIN `'._DB_PREFIX_.'product_download` pd ON (pd.id_product = ord.product_id )
		WHERE id_order = '.$id_order.' AND ord.download_hash  <> \'\'
		GROUP BY ord.product_id
		ORDER BY download_deadline ASC';
		}
		else
		{
				$query = 'SELECT ord.id_order_detail as `id`, ord.`product_id`, ord.`product_price`, ord.`id_order`, ord.`product_attribute_id`, ord.`product_quantity`, ord.`product_name`, pd.display_filename,pd.filename, ord.download_hash, ord.download_deadline
		FROM `'._DB_PREFIX_.'order_detail` ord
		LEFT JOIN `'._DB_PREFIX_.'product_download` pd ON (pd.id_product = ord.product_id )
		WHERE id_order = '.$id_order.' AND ord.download_hash  <> \'\'
		GROUP BY ord.product_id
		ORDER BY download_deadline ASC';
			}
		$result = Db::getInstance()->executeS($query);
		return $result;
	}
   public function initContent()
	{
	   if (_PS_VERSION_ > "1.7.0.0"){
        $this->display_column_left = false;
        parent::initContent();
        if (!isset($this->context->cart)) {
            $this->context->cart = new Cart();
        }
	   }

if (_PS_VERSION_ < "1.7.0.0"){
if ($this->context->getMobileDevice() == false)
		{
			// These hooks aren't used for the mobile theme.
			// Needed hooks are called in the tpl files.
		
			$this->context->smarty->assign(array(
				'HOOK_HEADER' => Hook::exec('displayHeader'),
				'HOOK_TOP' => Hook::exec('displayTop'),
				'HOOK_LEFT_COLUMN' => ($this->display_column_left ? Hook::exec('displayLeftColumn') : ''),
				'HOOK_RIGHT_COLUMN' => ($this->display_column_right ? Hook::exec('displayRightColumn', array('cart' => $this->context->cart)) : ''),
								//'HOOK_FOOTER' => Hook::exec('displayFooter'),

			));
		}
		else
		{
			$this->context->smarty->assign(array(
				'HOOK_MOBILE_HEADER' => Hook::exec('displayMobileHeader'),
			));
		}

}
 $module = new AllDownloads();

  
		$products2= array();
$orders = $this->getCustomerOrders2(intval($this->context->cookie->id_customer));
$key =0;
	foreach ($orders AS $order)
	{
		
		$products2[] = $this->getDet($order['id_order']);
		
		
		
	
	/*	print_r($products2).'<br/>';*/
	
	}
	        $context = Context::getContext();
		$this->context->smarty->assign(array(
			'products2' => $products2,
			'psversion' => _PS_VERSION_,
		
		
			));
	
	

        if (_PS_VERSION_ > "1.7.0.0") {
            $this->setTemplate('module:alldownloads/views/templates/front/alldownloads-page17.tpl');
        } else {
            $this->setTemplate('alldownloads-page.tpl');
        }
	
	}

	

	

    

}



?>