<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    private $options = '';
    protected $table = 'categories';
    // protected $guarded = [];
    protected $fillable = ['name', 'description', 'parent_id'];

    public function dequy($queryCategory, $parentId = 0, $title = '', $editCategory)
    {
        foreach ($queryCategory as $dataItem) {
            if(($dataItem->findParentCategory != null && $dataItem->findParentCategory->findParentCategory == null) || $dataItem->findParentCategory == null ) {
                if ($dataItem['parent_id'] == $parentId) {
                    //
                    if ($dataItem['id'] == $editCategory['parent_id']) {
                        $this->options .= '<option selected value="' . $dataItem->id . '">' . $title . $dataItem->name . '</option>';
                    } else {
                        $this->options .= '<option  value="' . $dataItem->id . '">' . $title . $dataItem->name . '</option>';
                    }
                    //---------//
                    // if ($dataItem['parent_id'] == $editCategory['id']) {
                    //     echo '<option hidden value="' . $dataItem->id . '">' . $title . $dataItem->name . '</option>';
                    // }
                    $this->dequy($queryCategory, $dataItem->id, $title . '...', $editCategory);
                }
            }
        }

        return $this->options;
    }

    function addOptionCategory($queryCategory, $parentId, $title)
    {
        foreach ($queryCategory as $dataItem) {
            if ($dataItem['parent_id'] == $parentId) {
                $this->option .= '<option value="' . $dataItem->id . '">' . $title . $dataItem->name . '</option>';
                $this->addOptionCategory($queryCategory, $dataItem->id, $title . '...');
            }
        }
        return $this->options;
    }

    public function occupations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Occupation');
    }

    public function findParentCategory()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Models\Category', 'parent_id', 'id');
    }
    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }
    public function getOccupationsIdsAttribute()
    {
        return $this->occupations->pluck('user_id');
    }
    public function jobs(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough('App\Models\Job', 'App\Models\Occupation');
    }
}
