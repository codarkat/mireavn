<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.pages.home');
    }

    public function listCategories(Request $request){
        if ($request->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('category_info', function ($category) {
                    $image = asset("data/images/upload/categories/");
                    return '
                        <div class="d-flex">
															<!--begin::Thumbnail-->
															<a href="edit-category.html" class="symbol symbol-50px">
																<span class="symbol-label" style="background-image:url('.$image.');"></span>
															</a>
															<!--end::Thumbnail-->
															<div class="ms-5">
																<!--begin::Title-->
																<a href="edit-category.html" class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1" data-kt-ecommerce-category-filter="category_name">'.$category->name.'</a>
																<!--end::Title-->
																<!--begin::Description-->
																<div class="text-muted fs-7 fw-bold">'.$category->description.'</div>
																<!--end::Description-->
															</div>
														</div>
                    ';
                })
                ->addColumn('action', function($category){
                    return '<div class="d-flex justify-content-end">
															<!--begin::Share link-->
															<div class="ms-2">
																<a class="btn btn-sm btn-icon btn-light btn-active-light-primary updateCategory" data-id="'.$category->id.'" data-bs-toggle="modal"
                                data-bs-target="#modal_update_category">
																	<!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/craft/html/releases/2022-08-27-142439/core/html/src/media/icons/duotune/general/gen055.svg-->
                                                                    <span class="svg-icon svg-icon-5 m-0"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M2 4.63158C2 3.1782 3.1782 2 4.63158 2H13.47C14.0155 2 14.278 2.66919 13.8778 3.04006L12.4556 4.35821C11.9009 4.87228 11.1726 5.15789 10.4163 5.15789H7.1579C6.05333 5.15789 5.15789 6.05333 5.15789 7.1579V16.8421C5.15789 17.9467 6.05333 18.8421 7.1579 18.8421H16.8421C17.9467 18.8421 18.8421 17.9467 18.8421 16.8421V13.7518C18.8421 12.927 19.1817 12.1387 19.7809 11.572L20.9878 10.4308C21.3703 10.0691 22 10.3403 22 10.8668V19.3684C22 20.8218 20.8218 22 19.3684 22H4.63158C3.1782 22 2 20.8218 2 19.3684V4.63158Z" fill="currentColor"/>
                                                                    <path d="M10.9256 11.1882C10.5351 10.7977 10.5351 10.1645 10.9256 9.77397L18.0669 2.6327C18.8479 1.85165 20.1143 1.85165 20.8953 2.6327L21.3665 3.10391C22.1476 3.88496 22.1476 5.15129 21.3665 5.93234L14.2252 13.0736C13.8347 13.4641 13.2016 13.4641 12.811 13.0736L10.9256 11.1882Z" fill="currentColor"/>
                                                                    <path d="M8.82343 12.0064L8.08852 14.3348C7.8655 15.0414 8.46151 15.7366 9.19388 15.6242L11.8974 15.2092C12.4642 15.1222 12.6916 14.4278 12.2861 14.0223L9.98595 11.7221C9.61452 11.3507 8.98154 11.5055 8.82343 12.0064Z" fill="currentColor"/>
                                                                    </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
																</a>
															</div>
															<!--end::Share link-->
															<!--begin::More-->
															<div class="ms-2">
																<a class="btn btn-sm btn-icon btn-light btn-active-light-primary deleteCategory" data-id="'.$category->id.'">
																	<!--begin::Svg Icon | path: /var/www/preview.keenthemes.com/kt-products/docs/craft/html/releases/2022-08-27-142439/core/html/src/media/icons/duotune/arrows/arr015.svg-->
                                                                    <span class="svg-icon svg-icon-5 m-0"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path opacity="0.3" d="M12 10.6L14.8 7.8C15.2 7.4 15.8 7.4 16.2 7.8C16.6 8.2 16.6 8.80002 16.2 9.20002L13.4 12L12 10.6ZM10.6 12L7.8 14.8C7.4 15.2 7.4 15.8 7.8 16.2C8 16.4 8.3 16.5 8.5 16.5C8.7 16.5 8.99999 16.4 9.19999 16.2L12 13.4L10.6 12Z" fill="currentColor"/>
                                                                    <path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM13.4 12L16.2 9.20001C16.6 8.80001 16.6 8.19999 16.2 7.79999C15.8 7.39999 15.2 7.39999 14.8 7.79999L12 10.6L9.2 7.79999C8.8 7.39999 8.2 7.39999 7.8 7.79999C7.4 8.19999 7.4 8.80001 7.8 9.20001L10.6 12L7.8 14.8C7.4 15.2 7.4 15.8 7.8 16.2C8 16.4 8.3 16.5 8.5 16.5C8.7 16.5 9 16.4 9.2 16.2L12 13.4L14.8 16.2C15 16.4 15.3 16.5 15.5 16.5C15.7 16.5 16 16.4 16.2 16.2C16.6 15.8 16.6 15.2 16.2 14.8L13.4 12Z" fill="currentColor"/>
                                                                    </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
																</a>
															</div>
															<!--end::More-->
														</div>';
                })
                ->rawColumns(['category_info','action'])
                ->make(true);
        }
    }

    public function getCategoryData(Request $request){

        ## Read POST data
        $id = $request->post('id');

        $category_data = Category::find($id);

        $response = array();
        if(!empty($category_data)){

            $response['name'] = $category_data->name;
            $response['description'] = $category_data->description;

            $response['success'] = 1;
        }else{
            $response['success'] = 0;
        }

        return response()->json($response);

    }

    public function deleteCategory(Request $request){

        ## Read POST data
        $id = $request->post('id');

        $category_data = Category::find($id);

        if($category_data->delete()){
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully';
        }else{
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.';
        }

        return response()->json($response);
    }


    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('admin.login');
    }
}
