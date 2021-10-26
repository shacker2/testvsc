<?php

class alldownloads extends Module
{
	public function __construct()
	{
		$this->name = 'alldownloads';
			if(_PS_VERSION_ > "1.4.0.0"){
		$this->tab = 'front_office_features';
		$this->author = 'RSI';
		$this->need_instance = 1;
		}else
		{
		$this->tab = 'Home';
		}
		$this->version = '3.0.0';
        if (_PS_VERSION_ > '1.6.0.0') {
            $this->bootstrap = true;
        }
		parent::__construct();

		$this->displayName = $this->l('All downloads');
		$this->description = $this->l('Display all downloads in a specific page - www.catalogo-onlinersi.net');
	}

	public function install()
	{
		if (!parent::install() OR !$this->registerHook('myAccountBlock') OR !$this->registerHook('header') OR !$this->registerHook('customerAccount') OR !$this->registerHook('LeftColumn'))
			return false;
		return true;
	}

	public function uninstall()
	{
		return parent::uninstall();
	}
	
public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		if(_PS_VERSION_ < '1.6.0.0'){
		if (Tools::isSubmit('submitCoolshare'))
		{
			
			$widthcs = Tools::getValue('widthcs');
			$formatcs = Tools::getValue('formatcs');
			$float = Tools::getValue('float');
			$margin = Tools::getValue('margin');
			$c1 = Tools::getValue('c1');
			$c2 = Tools::getValue('c2');
			$c3 = Tools::getValue('c3');
			$c4 = Tools::getValue('c4');
				$c5 = Tools::getValue('c5');
				$c6 = Tools::getValue('c6');
				$c7 = Tools::getValue('c7');
				$c8 = Tools::getValue('c8');
				$c9 = Tools::getValue('c9');
					$c10 = Tools::getValue('c10');
						$c11 = Tools::getValue('c11');
						$c12 = Tools::getValue('c12');
							$c13 = Tools::getValue('c13');
				$width = Tools::getValue('width');
				$height = Tools::getValue('height');
				$colorize = Tools::getValue('colorize');
	
				Configuration::updateValue('COOLSHARE_WIDTHCS', $widthcs);
				Configuration::updateValue('COOLSHARE_COLORIZE', $colorize);

				Configuration::updateValue('COOLSHARE_WIDTH', $width);
				Configuration::updateValue('COOLSHARE_MARGIN', $margin);
				Configuration::updateValue('COOLSHARE_HEIGHT', $height);
					Configuration::updateValue('COOLSHARE_FORMATCS', $formatcs);
					Configuration::updateValue('COOLSHARE_FLOAT', $float);
				Configuration::updateValue('COOLSHARE_c1', $c1);
				Configuration::updateValue('COOLSHARE_c2', $c2);
				Configuration::updateValue('COOLSHARE_c3', $c3);
				Configuration::updateValue('COOLSHARE_c4', $c4);
				Configuration::updateValue('COOLSHARE_c5', $c5);
					Configuration::updateValue('COOLSHARE_c6', $c6);
						Configuration::updateValue('COOLSHARE_c7', $c7);
							Configuration::updateValue('COOLSHARE_c8', $c8);
								Configuration::updateValue('COOLSHARE_c9', $c9);
								Configuration::updateValue('COOLSHARE_c10', $c10);
								Configuration::updateValue('COOLSHARE_c11', $c11);
								Configuration::updateValue('COOLSHARE_c12', $c12);
									Configuration::updateValue('COOLSHARE_c13', $c13);
	
				
			if (isset($errors) AND sizeof($errors))
				$output .= $this->displayError(implode('<br />', $errors));
			else
				$output .= $this->displayConfirmation($this->l('Settings updated'));
		}
		return $output.$this->displayForm();
		}
	else
	{
     return $this->_displayInfo().$this->_displayAdds();

	}	
	}
	 private function _displayInfo()
    {
      
        return $this->display(
            __FILE__,
            'views/templates/hook/infos.tpl'
        );
    }
	 private function _displayAdds()
    {
   


        return $this->display(
            __FILE__,
            'views/templates/hook/add.tpl'
        );
    }
	
	public function displayForm()
	{
		$output = '
	
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
			
			<p>'.$this->l('Use this url if you want to make a link to the virtual downloads of the customers in a menu:').' http://youriteurl/modules/alldownloads/alldownloads-page.php</p>
				<center>	<a href="../modules/alldownloads/moduleinstall.pdf">README</a></center><br/>	
			<center>	<a href="../modules/alldownloads/termsandconditions.pdf">TERMS</center></a><br/>	
	  				<legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Other products').'</legend>																	  
<object type="text/html" data="http://catalogo-onlinersi.net/modules/productsanywhere/images.php?idproduct=&desc=yes&buy=yes&type=home_default&price=yes&style=false&color=10&color2=40&bg=ffffff&width=800&height=310&lc=000000&speed=5&qty=15&skip=29,14,42,44,45&sort=1" width="800" height="310" style="border:0px #066 solid;"></object>
	<legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Video').'</legend>			
<iframe width="560" height="315" src="https://www.youtube.com/embed/ULJRfHiByXs" frameborder="0" allowfullscreen></iframe><br/>
			</fieldset>
		</form>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Contribute').'</legend>
				<p class="clear">'.$this->l('You can contribute with a donation if our free modules and themes are usefull for you. Clic on the link and support us!').'</p>
				<p class="clear">'.$this->l('For more modules & themes visit:').' <a href="http://www.catalogo-onlinersi.net" target="_blank">www.catalogo-onlinersi.net</p>
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="HMBZNQAHN9UMJ">
<input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/scr/pixel.gif" width="1" height="1">
	</fieldset>
</form>';
		return $output;
	}
 public function hookHeader($params)
 {
	 if (_PS_VERSION_ < "1.5.0.0" && _PS_VERSION_ > "1.4.0.0"){
	Tools::addCSS(($this->_path).'css/style5.css','all');
	 }
	 	 if (_PS_VERSION_ > "1.5.0.0"){
		 	$this->context->controller->addCSS(($this->_path).'css/style5.css', 'all');
		 }
}
	public function hookMyAccountBlock($params)
	{
		global $smarty;
		if(_PS_VERSION_ < "1.5.0.0"){
		if (!$params['cookie']->isLogged())
			return false;
		}
		else
		{
	if (!$this->context->customer->isLogged())
				return false;
			}

		return $this->display(__FILE__, 'alldownloads.tpl');
	}
	public function hookLeftColumn($params)
	{
		
	if(_PS_VERSION_ < "1.5.0.0"){
		if (!$params['cookie']->isLogged())
		return $this->display(__FILE__, 'alldownloads-left.tpl');
		}
		else
		{
	if (!$this->context->customer->isLogged())
		return $this->display(__FILE__, 'alldownloads-left.tpl');
			}
   
	
	}
	public function getCustomerOrders2($id_customer, $showHiddenStatus = false)
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
			INNER JOIN `'._DB_PREFIX_.'order_state_lang` osl ON (os.`id_order_state` = osl.`id_order_state` AND osl.`id_lang` = '.(int)($cookie->id_lang).')
			WHERE oh.`id_order` = '.(int)($val['id_order']).(!$showHiddenStatus ? ' AND os.`hidden` != 1' : '').'
			ORDER BY oh.`date_add` DESC, oh.`id_order_history` DESC
			LIMIT 1');
			if ($res2)
				$res[$key] = array_merge($res[$key], $res2[0]);
		}
		return $res;
	}
	public function getDet($id_order)
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
	public function displayFrontForm()
	{
		global $cookie, $smarty, $errors;
		$products2= array();
$orders = alldownloads::getCustomerOrders2(intval($cookie->id_customer));
$key =0;
	foreach ($orders AS $order)
	{
		
		$products2[] = alldownloads::getDet($order['id_order']);
		
		
	
	/*	print_r($products2).'<br/>';*/
	
	}
	
		$smarty->assign(array(
			'products2' => $products2,
			'psversion' => _PS_VERSION_
		
			));
	
	


$smarty->assign('errors', $errors);

	
		return $this->display(__FILE__, 'alldownloads-page.tpl');
	}
}

?>
