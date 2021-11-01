<div class="page-title-overlap bg-accent pt-4">
    <div class="container d-flex flex-wrap flex-sm-nowrap justify-content-center justify-content-sm-between align-items-center pt-2">
        <div class="d-flex align-items-center pb-3">
            <div class="img-thumbnail rounded-circle position-relative flex-shrink-0" style="width: 6.375rem;">
                <img class="rounded-circle account-avatar" src="{{$urlPhoto}}/{{$dataUser->image}}" alt="Avatar"></div>
            <div class="ps-3">
                <h3 class="text-light fs-lg mb-0">{{$dataUser->name}}</h3>
                <span class="d-block text-light fs-ms opacity-60 py-1">{{$dataUser->email}}</span>
                <div id="user-status-{{$dataUser->id}}">
                    @if($dataUser->status == \App\Enums\StatusEnum::ACTIVE)

                        <span class="badge bg-success"><i class="ci-check me-2"></i>Online</span>
                    @else
                        <span class="badge bg-danger"><i class="ci-delete-location me-2"></i>Offline</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="text-sm-end">
                <!-- Facebook -->
                <a href="#" class="btn-social bs-sm rounded-circle bs-facebook">
                    <i class="ci-facebook"></i>
                </a>

                <!-- Twitter -->
                <a href="#" class="btn-social bs-sm rounded-circle bs-twitter">
                    <i class="ci-twitter"></i>
                </a>

                <!-- Instagram -->
                <a href="#" class="btn-social bs-sm rounded-circle bs-instagram">
                    <i class="ci-instagram"></i>
                </a>

                <!-- Google -->
                <a href="#" class="btn-social bs-sm rounded-circle bs-google">
                    <i class="ci-google"></i>
                </a>
            </div>
        </div>
    </div>
</div>
