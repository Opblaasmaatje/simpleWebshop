    <x-app-layout>
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                @csrf
                {{ method_field('POST') }}
                <div class="form-group mb-2">
                    <label for="Brand">Brand name</label>
                    <input required type="text" name="name" class="form-control" id="Brand" placeholder="Enter Brand name">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </form>
        </div>
    </x-app-layout>
