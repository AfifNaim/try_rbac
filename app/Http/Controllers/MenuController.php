<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class MenuController extends Controller
{
    
    
    public function indexMenu()
    {
        //menampilkan semua data role dan menu
        $hak_akses = Permission::all();
        $datas = Role::all();
        $menus = Menu::all();
        return view('menu.index',compact('hak_akses','datas','menus'));
    }

    public function createMenu()
    {
        $hak_akses = Permission::pluck('name', 'id');
        $parent = Menu::pluck('judul', 'id');
        return view('menu.create', compact('hak_akses','parent'));
    }

    public function storeMenu(Request $request)
    {

        $this->validate($request, [
            'judul' => 'required',
            'id_hak_akses' => 'required',
        ]);


        $input = $request->all();

        $menu = Menu::create($input);
        return redirect('/menu')->with('success', 'Menu Berhasil Ditambahkan!');
    }

    public function editMenu($id)
    {
        $menu = Menu::find($id);
        $hak_akses = Permission::pluck('name', 'id');
        $parent = Menu::pluck('judul', 'id');

        return view('menu.edit', compact('menu', 'hak_akses', 'parent'));
    }

    public function updateMenu(Request $request, $id)
    {
        $this->validate($request, [
            'judul' => 'required',
        ]);

        $menu = Menu::find($id);
        $input = $request->all();
        $menu->update($input);

        return redirect('/menu')->with('success', 'Menu Berhasil Diubah!');
    }

    public function destroyMenu($id)
    {
        Menu::where('id', $id)->delete();
        return redirect('/menu')->with('success', 'Menu Berhasil Dihapus!');
    }
}
