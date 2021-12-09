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
            <div class="row">
                <form action="{{ route('brand.update', $id) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="input-group mb-3">
                        <input value="{{ $name }}" id="name" name="name" type="text" class="form-control" placeholder="Brand name" aria-label="Brand"
                            aria-describedby="basic-addon1">
                    </div>
                    <div class="container d-flex justify-content-between">
                        <input hidden required type="number" id="id" name="id" class="btn btn-primary" value="{{ $id }}">
                        <input type="submit" class="btn btn-primary" value="Change">
                </form>
                <form method="POST" action="{{ route('brand.destroy', $id) }}">
                    @csrf
                    @method("DELETE")
                    <input class="btn btn-danger" type="submit" value="Delete">
                </form>
            </div>
        </section>
        <!--Section: Block Content-->
    </x-app-layout>
