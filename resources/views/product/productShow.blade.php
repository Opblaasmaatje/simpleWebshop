    <x-app-layout>
        <!--Section: Block Content-->
        <section class="mb-5">
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
            @if (Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">

                    <div id="mdb-lightbox-ui"></div>

                    <div class="mdb-lightbox">
                        <div class="row product-gallery mx-1">

                            <div class="col-12 mb-0">
                                <figure class="view overlay rounded z-depth-1 main-img">
                                    <img src="{{ $product->image }}" style="width:100%">
                                    </a>
                                </figure>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-md-6">
                    @can('admin')
                        <a href="{{ route('product.edit', $product) }}" class="btn btn-warning">Edit</a>
                    @endcan

                    <h5>{{ $product->name }}</h5>
                    <p class="mb-2 text-muted text-uppercase small">Shirts</p>
                    <p><span class="mr-1"><strong>${{ $product->price }}</strong></span></p>
                    <p class="pt-1">{{ $product->description }}</p>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Brand</strong></th>
                                    @if (empty($brand->name))
                                        <td>No brand</td>
                                    @else
                                        <td>{{ $brand->name }}</td>
                                    @endif

                                </tr>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Color</strong></th>
                                    <td>Black</td>
                                </tr>
                                <tr>
                                    <th class="pl-0 w-25" scope="row"><strong>Delivery</strong></th>
                                    <td>USA, Europe</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <form action="{{ route('shoppingcart.store', $product->id) }}" method="post" class="d-flex justify-content-center">
                        @csrf
                        @method("POST")
                        <div class="form-group">
                            <input hidden required type="number" class="form-control" id="id" name="id" value="{{ $product->id }}">
                        </div>
                        <div class="form-group">
                            <label for="amount">Order</label>
                            <input type="submit" class="btn btn-primary form-control" value="Add to cart">
                        </div>
                    </form>
                </div>
            </div>

        </section>
        <!--Section: Block Content-->
    </x-app-layout>
