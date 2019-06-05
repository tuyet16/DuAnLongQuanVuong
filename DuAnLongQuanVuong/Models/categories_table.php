<?php
class Categories extends Database{
    private $categoryId;
    private $categoryName;
    public function __construct() {
        parent::__construct();
        
    }
    public function setCategoryId($category_id){
        $this->categoryId = $category_id;
    }
    public function getCategoryId(){
        return $this->categoryId;
    }
    public function setCategoryName($category_name){
        $this->categoryName = $category_name;
    }
    public function getCategoryname(){
        return $this->categoryName;
    }
    public function getCategories(){
        $query = 'SELECT * FROM categories ORDER BY categoryName ASC';
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function getCategoriesProduct(){
        $query = 'SELECT c.*, p.productID FROM categories c, products p where  ORDER BY categoryName ASC';
        $rs = $this->doQuery($query);
        return $rs;
    }
    public function getDScategory($id){
        $query = 'SELECT distinct ct.* FROM categories ct, products pr, users us where ct.categoryID = pr.categoryID and pr.userid = us.userid and us.userid=?';
        $param = array();
        $param[] = $id;
        $rs = $this->doQuery($query,$param);
        return $rs;
    }
    public function getCategoryByID($category_id){   
        $query = 'SELECT * FROM categories WHERE categoryID=?';
        $param = array();
        $param[] = $category_id;
        $rs = $this->doQuery($query, $param);
        return $rs;
    }
    public function insertNewCategory($category_name, $cate_img=null){
        $query = 'INSERT INTO categories(categoryName, cate_img)';
        $query.= ' VALUES(?, ?)';
        $param = array();
        $param[] = $category_name;
        $param[] = $cate_img;
        $this->doQuery($query, $param);
    }
    public function deleteCategory($category_id){
        $query = 'DELETE FROM categories WHERE categoryID=?';
        $param = array();
        $param[]= $category_id;
        $this->doQuery($query, $param);
    }
    public function editCategory($category_name, $cate_img, $category_id){
        if($cate_img != null)
        {
            $query = 'UPDATE categories SET categoryName=?, cate_img = ?  WHERE categoryID=?';
            $param = array();
            $param[] = $category_name;
            $param[] = $cate_img;
            $param[] = $category_id;
        }
        else
        {
            $query = 'UPDATE categories SET categoryName=? WHERE categoryID=?';
            $param = array();
            $param[] = $category_name;
            $param[] = $category_id;
        }
        $this->doQuery($query, $param);
    }
}
?>