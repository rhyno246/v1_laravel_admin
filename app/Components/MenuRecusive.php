<?php
namespace App\Components;
class MenuRecusive {

    private $data;
    private $htmlSelect = '';
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function menuRecusive ($parentId , $id = 0 , $text = '') {
        foreach($this->data as $item){
            if($item['parent_id'] == $id){
                if(!empty($parentId) && $parentId == $item['id']){
                    $this->htmlSelect .= "<option selected value=". $item['id'] .">" . $text . $item['name'] ."</option>";
                }else{
                    $this->htmlSelect .= "<option value=". $item['id'] .">" . $text . $item['name'] ."</option>";
                }
                $this->menuRecusive( $parentId, $item['id'] , $text . '--');
            }
        }
        return $this->htmlSelect;
    }
}