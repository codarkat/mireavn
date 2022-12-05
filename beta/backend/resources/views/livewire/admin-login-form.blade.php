<div>

    <!--begin::Form-->
    <form class="form w-100" novalidate="novalidate" wire:submit.prevent="LoginHandler()" method="POST">
        <!--begin::Heading-->
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">Sign In</h1>
            <!--end::Title-->
            <!--begin::Link-->
            <div class="text-gray-400 fw-semibold fs-4">
                <a href="../sign-up/basic.html" class="link-primary fw-bold">MIREA</a>VIETNAM
            </div>
            <!--end::Link-->
        </div>

        @if(Session::get('fail'))
        <div class="alert alert-danger d-flex justify-content-center p-5 mb-10">

            <!--begin::Wrapper-->
            <div class="d-flex flex-column align-items-center">
                <!--begin::Title-->
                <h4 class="mb-1 text-danger">FAIL</h4>
                <!--end::Title-->
                <!--begin::Content-->
                <span>{{Session::get('fail')}}</span>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        @endif

        <!--begin::Heading-->
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Label-->
            <label class="form-label fs-6 fw-bold text-dark">Email/Username</label>
            <!--end::Label-->
            <!--begin::Input-->
            <input class="form-control form-control-lg form-control-solid" type="text" name="email"
                wire:model="login_id" autocomplete="off" />
            <!--end::Input-->

            @error('login_id')
            <div class="fv-plugins-message-container invalid-feedback">
                <div>{{ $message }}</div>
            </div>
            @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack mb-2">
                <!--begin::Label-->
                <label class="form-label fw-bold text-dark fs-6 mb-0">{{ __('admin.Password') }}</label>
                <!--end::Label-->
                <!--begin::Link-->
                <a href="password-reset.html" class="link-primary fs-6 fw-bold">{{ __('admin.Forgot Password?') }}</a>
                <!--end::Link-->
            </div>
            <!--end::Wrapper-->
            <!--begin::Input-->
            <input class="form-control form-control-lg form-control-solid" type="password" name="password"
                wire:model="password" autocomplete="off" />
            <!--end::Input-->
            @error('password')
            <div class="fv-plugins-message-container invalid-feedback">
                <div>{{ $message }}</div>
            </div>
            @enderror
        </div>
        <!--end::Input group-->
        <!--begin::Actions-->
        <div class="text-center">
            <!--begin::Submit button-->
            <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                <span class="indicator-label">{{ __('admin.Sign in') }}</span>
                <span class="indicator-progress">{{ __('admin.Please wait...') }}
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <!--end::Submit button-->

        </div>
        <!--end::Actions-->
    </form>
    <!--end::Form-->

</div>