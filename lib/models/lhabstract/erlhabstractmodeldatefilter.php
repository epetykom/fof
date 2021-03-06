<?

class erLhAbstractModelDateFilter {
        
	public function getState()
	{
		return array (
			'id'         => $this->id,
			'name'       => $this->name,			
			'value'      => $this->value,
			'position'   => $this->position
		);
	}

	public function setState( array $properties )
	{
		foreach ( $properties as $key => $val )
		{
			$this->$key = $val;
		}
	}

	public function __toString()
	{
		return $this->name;
	}   

   	public function getFields()
   	{
       	return array (
		'name' => array (
		'type' => 'text',
		'trans' => 'Name',
		'required' => true,       
		'validation_definition' => new ezcInputFormDefinitionElement (
		    ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
		)),       
		'value' => array (
		'type' => 'text',
		'trans' => 'Value',
		'required' => true,       
		'validation_definition' => new ezcInputFormDefinitionElement (
		    ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
		)),
       	'position' => array(
       	'type' => 'text',
       	'trans' => 'Position',
       	'required' => true,
       	'validation_definition' => new ezcInputFormDefinitionElement(
       			ezcInputFormDefinitionElement::OPTIONAL, 'unsafe_raw'
       	)));
	}
   
	public function getModuleTranslations()
	{
		return array('name' => 'Date filter');
	}
   
	public static function getCount($params = array())
	{
		$session = erLhcoreClassAbstract::getSession();
		
		$q = $session->database->createSelectQuery();  
		
		$q->select( "COUNT(id)" )->from( "lh_abstract_date_filter" );   
	 
		if (isset($params['filter']) && count($params['filter']) > 0)
		{
	   		$conditions = array();
	   
		   	foreach ($params['filter'] as $field => $fieldValue)
		   	{
		    	$conditions[] = $q->expr->eq( $field, $fieldValue );
		   	}
	   
	   		$q->where( $conditions );
		}  
	     
		$stmt = $q->prepare(); 
		      
		$stmt->execute();  
		
		$result = $stmt->fetchColumn(); 
	    
		return $result; 
	}
   
	public function __get($var)
	{
	   switch ($var) {
	   	case 'left_menu':
	   	       $this->left_menu = '';
	   		   return $this->left_menu;
	   		break;
	   		
	   	default:
	   		break;
	   }
	}
	
	public static function fetch($id)
	{   
		if (isset($GLOBALS['erLhAbstractModelTooltip_'.$id])) return $GLOBALS['erLhAbstractModelTooltip_'.$id];         
	
		try {              
			$GLOBALS['erLhAbstractModelTooltip_'.$id] = erLhcoreClassAbstract::getSession()->load( 'erLhAbstractModelTooltip', (int)$id );     
		} catch (Exception $e) {
			$GLOBALS['erLhAbstractModelTooltip_'.$id] = '-';  
		}
	
		return $GLOBALS['erLhAbstractModelTooltip_'.$id];
	}
   
	public function removeThis()
	{
		erLhcoreClassAbstract::getSession()->delete($this);
	}
	
	public function defaultSort()
	{
		return 'position ASC';
	}
	
	public static function getList($paramsSearch = array())
   	{             
       	$paramsDefault = array('limit' => 500, 'offset' => 0);
       
       	$params = array_merge($paramsDefault,$paramsSearch);
       
       	$session = erLhcoreClassAbstract::getSession();
       
       	$q = $session->createFindQuery( 'erLhAbstractModelDateFilter' );  
       
		$conditions = array(); 
                   
		if (isset($params['filter']) && count($params['filter']) > 0)
		{                     
			foreach ($params['filter'] as $field => $fieldValue)
			{
				$conditions[] = $q->expr->eq( $field, $fieldValue );
			}
		} 
		
		if (isset($params['filterin']) && count($params['filterin']) > 0)
		{
			foreach ($params['filterin'] as $field => $fieldValue)
			{
				$conditions[] = $q->expr->in( $field, $fieldValue );
			} 
		}
		
		if (isset($params['filterlt']) && count($params['filterlt']) > 0)
		{
			foreach ($params['filterlt'] as $field => $fieldValue)
			{
				$conditions[] = $q->expr->lt( $field, $fieldValue );
			} 
		}
      
		if (isset($params['filtergt']) && count($params['filtergt']) > 0)
		{
			foreach ($params['filtergt'] as $field => $fieldValue)
			{
				$conditions[] = $q->expr->gt( $field, $fieldValue );
			} 
		}      
      
		if (count($conditions) > 0)
		{
			$q->where( $conditions );
		} 
      
      	$q->limit($params['limit'],$params['offset']);
                
      	$q->orderBy(isset($params['sort']) ? $params['sort'] : 'position ASC' ); 
              
       	$objects = $session->find( $q );
         
    	return $objects; 
	}
   
   	public $id = null;
	public $name = '';
	public $value = 0;
	public $position = 0;

}

?>