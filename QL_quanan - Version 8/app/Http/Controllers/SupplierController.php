<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Yajra\DataTables\DataTables;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::all();
        return view('admin.supplier.all_supplier', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supplier.add_supplier');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|email|max:255',
            'location' => 'required|max:255',

        ]);

        $diachi = $request->result;
        $diachi .= ', ';
        $diachi .= $request->location;

        $supplier = new Supplier(
            [

                'ncc_ten' => $request->name,
                'ncc_sdt' => $request->phone,
                'ncc_email' => $request->email,
                'ncc_diachi' => $diachi,

            ]
        );
        $supplier->save();
        Toastr::success('Thêm nhà cung cấp thành công', 'Thông báo');
        return Redirect::to('/supplier');
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
        $supplier = Supplier::find($id);
        return view('admin.supplier.edit_supplier', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $diachi1 = $request->result1;
        // $diachi1 .= ', ';
        $diachi1 .= $request->location1;



        $supplier = Supplier::find($id);
        $supplier->ncc_ten = $request->ncc_ten;
        $supplier->ncc_sdt = $request->ncc_sdt;
        $supplier->ncc_email = $request->ncc_email;

        if ($diachi1 != '') {
            $supplier->ncc_diachi = $diachi1;
        } else {
            $supplier->ncc_diachi =  $supplier->ncc_diachi;
        }

        $supplier->save();
        Toastr::success('Cập nhật nhà cung cấp thành công', 'Thông báo');
        return Redirect::to('/supplier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        Toastr::success('Xóa nhà cung cấp thành công', 'Thông báo');
        return Redirect::to('/supplier');
    }
    public function get_supplier()
    {
        $supplier = Supplier::all();
        return DataTables::of($supplier)
            ->addIndexColumn()
            ->addColumn('action', function ($supplier) {
                return '
                <div style="display:flex;"> 
                <a href="' . route('supplier.edit', $supplier->ncc_id) . '" class="mt-1">
                    <i class="fa fa-pencil-square-o" aria-hidden="true" style="color:blue; "></i></a>
                    &nbsp|

                    <form action="' . route('supplier.destroy', [$supplier->ncc_id]) . '" method="POST" >                      
                    ' . csrf_field() . '
                    ' . method_field('delete') . '
                        <button class="btn btn-sm " onclick="return myFunction();"> <i class="fa fa-trash-o" aria-hidden="true" style="color: red;"></i></button>
                        </form>
                    </div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function save_supplier1(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'email' => 'required|email|max:255',
            'location' => 'required|max:255',

        ]);
        
        $diachi = $request->result;
        $diachi .= ', ';
        $diachi .= $request->location;

        $supplier = new Supplier(
            [

                'ncc_ten' => $request->name,
                'ncc_sdt' => $request->phone,
                'ncc_email' => $request->email,
                'ncc_diachi' => $diachi,

            ]
        );
        $supplier->save();
        Toastr::success('Thêm nhà cung cấp thành công', 'Thông báo');
        return Redirect::to('/input-receipt');
    }
}
