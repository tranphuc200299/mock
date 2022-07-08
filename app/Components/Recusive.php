<?php
namespace App\Components;
use App\Models\Category;

class Recusive{
    private  $data;
    private  $occupation;
    private $htmlSelect="";
    public function __construct($data, $occupation)
    {
        $this->data=$data;
        $this->occupation = $occupation;
    }

    public function categoryRecusive($parentId,$id=0,$text = " ")
    {
        foreach ($this->data as $value) {
            if ($value->parent_id == $id) {
                if(($value->findParentCategory == null || $value->findParentCategory->findParentCategory == null)) {
                    if ((!empty($parentId) && $parentId == $value['id']) || ($this->occupation != null && $value['id'] == $this->occupation->category_id)) {
                        $this->htmlSelect .= "<option disabled selected value='" . $value['id'] . " '>" . $text . $value['name'] . "</option>";
                    } else {
                        $this->htmlSelect .= "<option disabled value='" . $value['id'] . " '>" . $text . $value['name'] . "</option>";
                    }
                } else {
                    if ((!empty($parentId) && $parentId == $value['id']) || ($this->occupation != null && $value['id'] == $this->occupation->category_id)) {
                        $this->htmlSelect .= "<option  selected value='" . $value['id'] . " '>" . $text . $value['name'] . "</option>";
                    } else {
                        $this->htmlSelect .= "<option  value='" . $value['id'] . " '>" . $text . $value['name'] . "</option>";
                    }
                }

                $this->categoryRecusive($parentId, $value['id'], $text . '&nbsp &nbsp');
            }
        }

        return $this->htmlSelect;
    }
}
