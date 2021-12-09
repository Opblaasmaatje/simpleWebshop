    <x-app-layout>
        <div class="container mt-5 mb-3">
            <div class="row">
                @foreach ($brands as $brand)
                    <div class="col-md-4">
                        <div class="card p-3 mb-2">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>
                                    <div class="ms-2 c-details">
                                        <h6 class="mb-0"><a href="{{ route('brand.edit', $brand->id) }}">{{ $brand->name }}</a></h6>
                                        <span>{{ $brand->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-app-layout>
