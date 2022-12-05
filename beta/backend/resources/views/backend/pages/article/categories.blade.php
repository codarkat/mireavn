@extends('backend.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Categories')
@push('css')
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet" type="text/css" />
    
@endpush
@section('content')

<div class="content fs-6 d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Toolbar-->
        <div class="toolbar" id="kt_toolbar">
            <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                    <!--begin::Title-->
                    <h1 class="text-dark fw-bold my-1 fs-2">Customer Listing</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb fw-semibold fs-base my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="../../../index-2.html" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <li class="breadcrumb-item text-muted">eCommerce</li>
                        <li class="breadcrumb-item text-muted">Customers</li>
                        <li class="breadcrumb-item text-dark">Customer Listing</li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Info-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modal_add_category" >Add Category</a>
                </div>
                <!--end::Actions-->
            </div>
        </div>
        <!--end::Toolbar-->
        <!--begin::Post-->
        <div class="post fs-6 d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div class="container-xxl">
                <!--begin::Card-->
                <div class="card">
                    
                    <!--begin::Card body-->
                    <div class="card-body pt-9">
                        
                        <livewire:category-table />
                        <livewire:user-table />

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>

    <!--begin::Modal - New Category-->
    <div wire:ignore.self class="modal fade" id="modal_add_category" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                              transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                              transform="rotate(45 7.41422 6)" fill="currentColor" />
                                    </svg>
                                </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    @livewire('category-form')
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - New Category-->

    <!--begin::Modal - Edit Category-->
    <div wire:ignore.self class="modal fade" id="modal_edit_category" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                              transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                              transform="rotate(45 7.41422 6)" fill="currentColor" />
                                    </svg>
                                </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    @livewire('category-form')
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Edit Category-->
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>

    <script>
        window.addEventListener('openEditModal', e =>{
            var editModal = new bootstrap.Modal(document.getElementById('modal_edit_category'));
            editModal.show();
        })

        window.addEventListener('openDeleteModal', e =>{
            Swal.fire({
                    text: "Are you sure you want to delete?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    console.log(e.detail.id);
                    Livewire.emit('deleteCategory', e.detail.id)
                    // if (result.value) {
                    //     Swal.fire({
                    //         text: "You have deleted!.",
                    //         icon: "success",
                    //         buttonsStyling: false,
                    //         confirmButtonText: "Ok, got it!",
                    //         customClass: {
                    //             confirmButton: "btn fw-bold btn-primary",
                    //         }
                    //     }).then(function () {
                    //         // Remove current row
                    //         // datatable.row($(parent)).remove().draw();
                    //     });
                    // } else if (result.dismiss === 'cancel') {
                    //     Swal.fire({
                    //         text: customerName + " was not deleted.",
                    //         icon: "error",
                    //         buttonsStyling: false,
                    //         confirmButtonText: "Ok, got it!",
                    //         customClass: {
                    //             confirmButton: "btn fw-bold btn-primary",
                    //         }
                    //     });
                    // }
                });
        })

        
    </script>
@endpush
