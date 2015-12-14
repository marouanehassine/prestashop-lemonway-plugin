<?php
class IbanCore extends ObjectModel{
	
	
	public $id_lw_iban;
	public $id_customer;
	public $id_wallet;
	public $holder;
	public $iban;
	public $bic;
	public $dom1;
	public $dom2;
    public $comment;
    public $id_status;

    
    
    public $date_add;
    public $date_upd; 
	
	/**
	 * @see ObjectModel::$definition
	 */
	public static $definition = array(
			'table' => 'lemonway_iban',
			'primary' => 'id_iban',
			'multilang' => false,
			'multilang_shop' => false,
			'fields' => array(
					'id_lw_iban' 		=>    array('type' => self::TYPE_STRING, 'validate' => 'isGenericName'),
					'id_customer' 		=>    array('type' => self::TYPE_INT,'required'=>true),
					'id_wallet' 		=>    array('type' => self::TYPE_STRING,'required'=>true),
					'holder' 			=>    array('type' => self::TYPE_STRING,'required'=>true,'validate' => 'isGenericName'),
					'iban'				=>    array('type' => self::TYPE_STRING,'required'=>true),
					'bic' 				=>    array('type' => self::TYPE_STRING,'required'=>false),
					'iban' 				=>    array('type' => self::TYPE_STRING, 'validate' => 'isGenericName','required'=>true),
					'dom1' 				=>    array('type' => self::TYPE_STRING,'required'=>false),
					'dom2' 				=>    array('type' => self::TYPE_STRING,'required'=>false),
					'comment' 			=>    array('type' => self::TYPE_STRING,'required'=>false),
					'id_status' 		=>    array('type' => self::TYPE_INT,'required'=>false),
					'date_add' 			=>    array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
					'date_upd'			=>    array('type' => self::TYPE_DATE, 'validate' => 'isDate'),

			),
	);
	
	/**
	 * Get customer ibas
	 *
	 * @param int $id_customer Customer id
	 * @return array Iban $ibans
	 */
	public static function getCustomerIbans($id_customer)
	{
		
		$sql = 'SELECT * FROM `'._DB_PREFIX_.'lemonway_iban` iban WHERE iban.`id_customer` = '.$id_customer.' ORDER BY iban.`date_add` DESC';
		
		$res = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);
		if (!$res) {
			return array();
		}
		
		return $res;
		
	}
}