<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Livewire;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.pages.home');
    }

    public function listCategories(Request $request){
        if ($request->ajax()) {
            $data = Category::select(['id','name','description'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('name', function ($category) {
                    return '<strong>'.$category->name.'</strong>';
                })
                ->addColumn('action', function($category){
                    return Livewire::mount('datatable.action-button', ['model_id' => $category->id])->html();
                })
                ->rawColumns(['name','action'])
                ->make(true);
        }
    }
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->drawCallbackWithLivewire();
    }


    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('admin.login');
    }
}
