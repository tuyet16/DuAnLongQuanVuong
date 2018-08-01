<?php
class Services extends Database{
    public function __construct() {
        parent::__construct(); 
    }
	public function getAreas(){
        $query = 'SELECT * FROM areas';
        $rs = $this->doQuery($query);
        return $rs;
    }
	
	public function getDistrictsByAreas($id)
	{
		$query = 'SELECT * FROM districts d, areas a where d.areasID=a.areasID and d.areasID=?';
		$param = array();
		$param[]=$id;
        $rs = $this->doQuery($query,$param);
        return $rs;	
	}

	public function getServices()
	{
		$sv = array();
		$dsAreas = $this->getAreas();
		foreach($dsAreas as $kv)
		{	$sers= array();
			$sv[$kv->areasName]=array();
			$districtByAreas = $this->getDistrictsByAreas($kv->areasID);
			foreach($districtByAreas as $district)
			{
				$sers[] = $district->districtName;
			}
			$sv[$kv->areasName][]=$sers;	
			$sv[$kv->areasName][]=array($kv->km,$kv->often,$kv->fast);
		}
		return $sv;
	}
	
}
?>