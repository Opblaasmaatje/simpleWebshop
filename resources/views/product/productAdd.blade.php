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
            <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                @csrf
                {{ method_field('POST') }}
                <div class="form-group mb-2">
                    <label for="products">Product name</label>
                    <input required type="text" name="name" class="form-control" id="products" placeholder="Enter product name">
                </div>
                <div class="form-group mb-2">
                    <label for="price">Product price</label>
                    <input required type="number" name="price" class="form-control" id="price" placeholder="3,55">
                </div>
                <div class="form-group mb-2">
                    <label for="description">description</label>
                    <input required type="text" name="description" class="form-control" id="description" placeholder="What is this product">
                </div>
                <div class="form-group d-flex row mb-5">
                    <label for="exampleFormControlFile1">Photo of product</label>
                    <input required type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                </div>
                <div class="form-group d-flex row mb-5">
                    <select required name="brand" id="brand" class="form-control">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </form>
        </div>
    </x-app-layout>
