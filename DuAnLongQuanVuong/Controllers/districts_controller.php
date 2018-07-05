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
            $dt_model = new districts();
            $DSdistrict = $dt_model->getDistrict();
			$tableDB = new Database();
            $tables = $tableDB->getTables();
			$view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
		break;	
        case 'add':
            $dt_model = new districts();
            $dt_model->addDistricts($_POST['tenquan']);
            header('Location:districts_controller.php');
        break;
        case "edit":
		
        if(!isset($_POST['submit'])){
            try{
                $tablesDB = new Database();
                $tables = $tablesDB->getTables();				
              	$distric_model = new districts();
                $DSdistrict = $distric_model->getDistrict();
                $district = $distric_model->getByIDDistrict($_GET['id']);
				
                $view = Page::View();
                if(file_exists($view) == false)
                    throw new MVCException('Không tồn tại tập tin ' . $view);
                else
                {
                    $GLOBALS['template']['menu'] = include_once '../template/menu.php';
                    $GLOBALS['template']['content'] = include_once $view;
                    $GLOBALS['template']['title'] = 'Edit District';
                    include_once '../template/index.php';
                } 				  
            }catch(MVCException $e)
            {
                
            }
        }
        else
        {
            $name = $_POST['tenquan'];
            $id = $_POST['id'];
            //print_r($_POST);
            $distric_model = new districts();
            $distric_model->editDistricts($name,$id);
            header('Location: districts_controller.php');    
        }
	break;
    case 'delete':
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $dt_model = new districts();
            $dt_model->deleteDistrict($id);
            header('Location:districts_controller.php');
        }
            
    break;
	}
?>