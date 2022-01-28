<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'menu';


    protected $fillable = array('id_parent', 'judul', 'url', 'id_hak_akses');

    public function parent()
    {
        return $this->belongsTo('App\Models\Menu', 'id_parent', 'id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\Menu', 'id_parent');
    }

    public function hak_akses()
    {
        return $this->belongsTo('App\Models\Permission', 'id_hak_akses', 'id');
    }
}
