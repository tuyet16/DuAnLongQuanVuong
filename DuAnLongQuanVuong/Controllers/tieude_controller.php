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
			$tableDB = new Database();
            $tables = $tableDB->getTables();
			$view = Page::View();
            $GLOBALS['template']['menu'] = include_once'../template/menu.php';
            $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
            $GLOBALS['template']['content'] = include_once $view;
            include_once('../template/index.php');
		break;
        case 'editquydinh':
            $user = new Users();
            $rsvitriquangcao1 = $user->carosoulpanel();
             if(isset($_GET['id']))
                {
                    $id = $_GET['id'];
                    $dsquydinh= $user->tieude();
                    $rsquydinh = $user->getIDtieude($id);
                    $view = Page::View();            
                    $GLOBALS['template']['menu'] = include_once'../template/menu.php';
                    $GLOBALS['template']['leftmenu'] = include_once'../template/adminleftmenu.php';
                    $GLOBALS['template']['content'] = include_once $view;
                    include_once('../template/index.php');
                    
                   
                }
                else
                {
                    if(isset($_POST['submit']))
                    {
                        $id = $_POST['id'];
                        $tentd = $_POST['tentd'];
                        $user = new Users();
                        $user->editquydinh($tentd,$id);
                    }
                    header('Location: tieude_controller.php?action=index');
                }
            
        break;
 
 }
?>