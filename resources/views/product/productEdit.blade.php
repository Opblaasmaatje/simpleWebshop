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
            <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                {{ method_field('PUT') }}
                <div class="form-group mb-2">
                    <label for="products">Product name</label>
                    <input required value="{{ $product->name }}" type="text" name="name" class="form-control" id="products" placeholder="Enter product name">
                    <input required hidden value="{{ $product->id }}" type="number" name="id" id="id">
                </div>
                <div class="form-group mb-2">
                    <label for="price">Product price</label>
                    <input required value="{{ $product->price }}" type="number" name="price" class="form-control" id="price" placeholder="3,55">
                </div>
                <div class="form-group mb-2">
                    <label for="description">description</label>
                    <input required value="{{ $product->description }}" type="text" name="description" class="form-control" id="description"
                        placeholder="What is this product">
                </div>
                <div class="form-group d-flex row mb-5">
                    <label for="exampleFormControlFile1">Photo of product</label>
                    <input required value="{{ $product->img }}" type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                </div>
                <div class="form-group d-flex row mb-5">
                    <select required value="{{ $product->brand_id }}" name="brand" id="brand" class="form-control">
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </form>
            <form method="POST" action="{{ route('product.destroy', $product->id) }}">
                @csrf
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger mb-2">Delete</button>
            </form>
        </div>
    </x-app-layout>
