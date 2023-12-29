<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Session;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredient = Ingredient::all();
        return view('admin.ingredient.all_ingredient', compact('ingredient'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.ingredient.add_ingredient');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'ingredient_name' => 'required|max:255',
            'ingredient_unit' => 'required|max:255',
            'ingredient_status' => 'required',

        ]);
        $ingredient = new Ingredient(
            [
                'nl_ten' => $request->ingredient_name,
                'nl_dvt' => $request->ingredient_unit,
                'nl_tinhtrang' => $request->ingredient_status,
                'nl_slcl' => 0,
                'nl_slsd' => 0,
            ]
        );
        $ingredient->save();

        Toastr::success('Thêm nguyên liệu thành công', 'Thông báo');
        return Redirect::to('/ingredient');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $ingredient = Ingredient::find($id);
        return view('admin.ingredient.edit_ingredient', compact('ingredient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->nl_ten = $request->ingredient_name;
        $ingredient->nl_dvt = $request->ingredient_unit;
        $ingredient->nl_tinhtrang = $request->ingredient_status;
        $ingredient->save();
        Toastr::success('Cập nhật nguyên liệu thành công', 'Thông báo');
        return Redirect::to('/ingredient');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ingredient = Ingredient::find($id);
        $ingredient->delete();

        Toastr::success('Xóa nguyên liệu thành công', 'Thông báo');
        return Redirect::to('/ingredient');
    }
    public function get_ingredient()
    {
        $ingredient = Ingredient::all();
        return DataTables::of($ingredient)
            ->addIndexColumn()
            ->addColumn('active', function ($ingredient) {
                if ($ingredient->nl_tinhtrang == 0) {
                    return ' <a href="' . route('active_ingredient', $ingredient->nl_id) . '"><i class="fa fa-toggle-off" aria-hidden="true" 
                    style="font-size: 18pt;color: red"></i></a>';
                } else {
                    return '  <a href="' . route('unactive_ingredient', $ingredient->nl_id) . '"><i class="fa fa-toggle-on" aria-hidden="true"
                    style="font-size: 18pt;color: green"></i></a>';
                }
            })


            ->addColumn('action', function ($ingredient) {
                return '
                <div style="display:flex;"> 

                    <a href="' . route('ingredient.edit', $ingredient->nl_id) . '" class="mt-1">
                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i></a>
                    &nbsp|
                    <form action="' . route('ingredient.destroy', [$ingredient->nl_id]) . '" method="POST" >                      
                    ' . csrf_field() . '
                    ' . method_field('delete') . '
                        <button class="btn btn-sm " onclick="return myFunction();"> <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i></button>
                        </form>
                   </div> ';
            })

            ->rawColumns(['active', 'action'])
            ->make(true);
    }
    public function save_ingredient1(Request $request)
    {

        $this->validate($request, [
            'ingredient_name' => 'required|max:255',
            'ingredient_unit' => 'required|max:255',
            'ingredient_status' => 'required',
        ]);

        $ingredient = new Ingredient(
            [

                'nl_ten' => $request->ingredient_name,
                'nl_dvt' => $request->ingredient_unit,
                'nl_tinhtrang' => $request->ingredient_status,
                'nl_slcl' => 0,
                'nl_slsd' => 0,

            ]
        );
        $ingredient->save();
        Toastr::success('Thêm nguyên liệu thành công', 'Thông báo');
        return redirect()->back();
    
    }

    public function active_ingredient($ingredient_id)
    {
        DB::table('nguyenlieu')->where('nl_id', $ingredient_id)->update(['nl_tinhtrang' => 1]);
        Toastr::success('Kích hoạt nguyên liệu thành công', 'Thông báo');
        return Redirect::to('/ingredient');
    }
    public function unactive_ingredient($ingredient_id)
    {
        DB::table('nguyenlieu')->where('nl_id', $ingredient_id)->update(['nl_tinhtrang' => 0]);
        Toastr::success('Không kích hoạt nguyên liệu thành công', 'Thông báo');
        return Redirect::to('/ingredient');
    }
    public function check_ingredient()
    {
        $ingredient = Ingredient::all();
        return view('admin.ingredient.check_ingredient', compact('ingredient'));
    }
    public function check_update_ingredient(Request $request)
    {
        $ingredient = Ingredient::all();
        $data = $request->all();

        for ($nl_id = 0; $nl_id < count($request->nl_id); $nl_id++) {
            foreach ($ingredient as $ing)
                if ($ing->nl_id == $request->nl_id[$nl_id]) {
                    $ing->nl_slcl =  $request->sltt[$nl_id];
                    $ing->update();
                }
        }

        Toastr::success('Cập nhật số lượng sản phẩm thành công', 'Thông báo');
        return redirect()->back();
    }
    public function all_input_receipt()
    {
        $ingredient = Ingredient::all();
        return view('admin.ingredient.show_ingredient', compact('ingredient'));
    }

    public function get_all_input_receipt()
    {
        $ingredient = Ingredient::all();
        return DataTables::of($ingredient)
            ->addIndexColumn()
            ->addColumn('sl', function ($ingredient) {
                return $ingredient->nl_slcl . $ingredient->nl_dvt;
            })
            ->rawColumns(['sl'])
            ->make(true);
    }
}
