<?php
	include_once('../Config/bootload.php');	
    $action = filter_input(INPUT_GET,'action');
    if($action==NULL)
    {
        $action =filter_input(INPUT_POST,'action');
        if($action==NULL)
        {
            	$action ='index';
        }
    }
	
	switch($action){
		case 'index':
             $user = new Users();
             $dsquydinh= $user->tieude();
            $rsvitriquangcao1 = $user->carosoulpanel();
            $category = new Categories();
            $dsCategories = $category->getCategories();
			$services = new Services();
			$advance = new Advance();
			$surcharges = new Surcharge();
			$dsSV = $services->getServices();
            $category = new Categories();
            $dsCategories = $category->getCategories();
			$dsAdvance = $advance->getAdvance();
			$dsSurcharges = $surcharges->getSurcharge();
			$view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
			if(isset($_SESSION['role']))
			{	if($_SESSION['role']=='0')
				{
					$GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
				}
				else
				{
					$GLOBALS['template']['leftmenu'] = include_once'../template/shopleftmenu.php';		
				}
			}
			else
			{	
				$GLOBALS['template']['leftmenu'] = include_once'../template/leftmenu.php';
			}
            $GLOBALS['template']['content'] = /*print_r($_SESSION['role']);*/ include_once $view;
            include_once('../template/index.php');
		break;	
	}
?>