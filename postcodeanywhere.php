<?php
/* Postcode Anywhere Module to add UK and International Address validation to the standard entry screens within Prestashop 1.4+
 * Original v1.0 www.postcodeanywhere.co.uk
 * Updated by: Paul Campbell (pcampbell@ecartservice.net) 16/12/2013
 * Repository: https://github.com/paulc010/postcodeanywhere
 */

class PostcodeAnywhere extends Module
{
    private $_html = '';
    private $_postErrors = array();
  
    public function __construct()
    {
        $this->name = 'postcodeanywhere';
        $this->tab = version_compare(_PS_VERSION_, '1.3', '>') ? 'billing_invoicing' : 'Postcode Anywhere Address Auto-Fill';
        $this->version = '1.1';
        $this->author = 'Postcode Anywhere';
        $this->need_instance = 0;
        
        parent::__construct();
        
        $this->displayName = $this->l('UK and International Address Auto-Fill');
        $this->description = $this->l('Add UK and International address auto-fill to your website for quick, accurate data capture.');
        
        // Backward compatibility
        if (version_compare(_PS_VERSION_, '1.5', '<'))
            require(_PS_MODULE_DIR_.$this->name.'/backward_compatibility/backward.php');
    }
  
    public function install()
    {
        parent::install();
        
        if (!$this->registerHook('header') || !$this->registerHook('footer'))
          return false;
			
		// Default license key and royal mail true
		Configuration::updateValue($this->name.'_pcakey', 'AA11-AA11-AA11-AA11');
		Configuration::updateValue($this->name.'_rmdata', 'true');
        
        return true;
	}

	private function _postValidation()
	{
		if (!Validate::isCleanHtml(Tools::getValue('our_pcakey')))
			$this->_postErrors[] = $this->l('The key you entered is not valid, sorry');
	}
	
	private function _postProcess()
	{
		Configuration::updateValue($this->name.'_pcakey', Tools::getValue('our_pcakey'), true);
		Configuration::updateValue($this->name.'_rmdata', (Tools::getValue('our_rmdata') ? 'true' : 'false'));
		$this->_html .= '<div class="conf confirm">'.$this->l('Settings updated').'</div>';
	}
	
	public function getContent()
	{
		$this->_html .= '<h2>'.$this->displayName.'</h2>';
		
		if (Tools::isSubmit('submit'))
		{			
			$this->_postValidation();
			
			if (!count($this->_postErrors))
				$this->_postProcess();
			else
				foreach ($this->_postErrors as $err)
					$this->_html .= '<div class="alert error">'.$err.'</div>';
		}
		
		$this->_displayForm();
		
		return $this->_html;
	}
	
	private function _displayForm()
	{
		$this->_html .= '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset>
				<legend><img src="../img/admin/cog.gif" alt="" class="middle" />'.$this->l('Settings').'</legend>
				<label>'.$this->l('Postcode Anywhere Key').'</label>
				<div class="margin-form">
					<input type="text" name="our_pcakey" value="'.Tools::getValue('our_pcakey', Configuration::get($this->name.'_pcakey')).'"/>
					<p class="clear">'.$this->l('Please enter a Postcode Anywhere Web Service key').'</p>
				</div>
				<label>'.$this->l('Use Royal Mail Data').'</label>
				<div class="margin-form">
					<input type="checkbox" name="our_rmdata" value="'.(Tools::getValue('our_rmdata', Configuration::get($this->name.'_rmdata')) ? 'true' : 'false').'"'.
					(Tools::getValue('our_rmdata', Configuration::get($this->name.'_rmdata')) == 'true' ? ' checked="checked"' : '').' />
					<p class="clear">'.$this->l('Check this if you wish to return Royal Mail address data').'</p>
				</div>
			<input type="submit" name="submit" value="'.$this->l('Update').'" class="button" />
			</fieldset>
		</form>';
	}

    public function hookHeader()
    {
        $this->context->controller->addCSS($this->_path.'css/pca.css', 'all');
        return '<script type="text/javascript" src="https://services.postcodeanywhere.co.uk/js/address-0.90.js"></script>';
    }
    
    public function hookFooter()
    {
        $footer_insert = '<script type="text/javascript">var _pcaoptions = { key: "'.Configuration::get($this->name.'_pcakey').'", royalMail: '.Configuration::get($this->name.'_rmdata').'};</script>';
        $footer_insert .= '<script type="text/javascript" src="'.$this->_path.'js/pca-footer.js'.'"></script>';
        
        return $footer_insert;
    }
}