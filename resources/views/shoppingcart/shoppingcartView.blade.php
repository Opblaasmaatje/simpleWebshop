    <x-app-layout>
        <div class="container mt-5 mb-3">
            @if (Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
            @endif
            @if (session()->has('cart'))
                <div class="container mb-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col"> </th>
                                            <th scope="col">Product</th>
                                            <th scope="col" class="text-center">Quantity</th>
                                            <th scope="col" class="text-right">Price</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td><img style="width:120px" src="{{ $product['item']['image'] }}" /> </td>
                                                <td><a href="{{ route('product.show', $product['item']['id']) }}">{{ $product['item']['name'] }}</a></td>
                                                <td><input disabled class="form-control" type="text" value="{{ $product['qty'] }}" /></td>
                                                <td class="text-right">{{ $product['item']['price'] }}€</td>
                                                <td class="text-right"><a class="btn btn-sm btn-danger"
                                                        href="{{ route('shoppingcart.reduce', $product['item']['id']) }}"><i class="fa fa-trash">Reduce by
                                                            one</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><strong>Total</strong></td>
                                            <td class="text-right"><strong>{{ $totalPrice }} €</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <form method="post" action="{{ route('invoice.store') }}">
                                    @csrf
                                    @method("POST")
                                    <input type="submit" class="btn btn-primary" value="Purchase">
                                    <input hidden id="" value="Purchase">
                                    <input hidden id="" value="Purchase">
                                    <input hidden id="" value="Purchase">
                                    <input hidden id="" value="Purchase">
                                </form>
                            </div>
                        </div>
                    @else
                        You basket is still empty
            @endif
        </div>
    </x-app-layout>
