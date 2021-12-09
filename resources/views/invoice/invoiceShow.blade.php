    <x-app-layout>
        <div class="card">
            <div class="card-header bg-black"></div>
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <i class="far fa-building text-danger fa-6x float-start"></i>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xl-12">

                            <ul class="list-unstyled float-end">
                                <li style="font-size: 30px; color: red;">Company</li>
                                <li>123, Elm Street</li>
                                <li>123-456-789</li>
                                <li>mail@mail.com</li>
                            </ul>
                            <ul class="list-unstyled float-start">
                                <li style="font-size: 30px; color: red;">User info</li>
                                <li>{{ auth()->user()->name }}</li>
                                <li>{{ auth()->user()->firstLetter }}</li>
                                <li>{{ auth()->user()->email }}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row text-center">
                        <h3 class="text-uppercase text-center mt-3" style="font-size: 40px;">Invoice</h3>
                        <p>{{ $invoice->id }}</p>
                    </div>

                    <div class="row mx-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Description</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderedProducts as $product)
                                    @if ($product->invoice_id == $invoice->id)
                                        <tr>
                                            <td>{{ $product->product->name }}</td>
                                            <td><i class="fas fa-dollar-sign"></i> {{ $product->amount }}</td>
                                            <td><i class="fas fa-dollar-sign"></i> ${{ $product->product->price }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="row">
                        <div class="col-xl-8" style="margin-left:60px">
                            <p class="float-end" style="font-size: 30px; color: red; font-weight: 400;font-family: Arial, Helvetica, sans-serif;">Total:
                                <span><i class="fas fa-dollar-sign"></i> ${{ $invoice->totalPrice }}</span>
                            </p>
                        </div>

                    </div>

                    <div class="row mt-2 mb-5">
                        <p class="fw-bold">Date: <span class="text-muted">{{ $invoice->created_at }}</span></p>
                    </div>

                </div>



            </div>
            <div class="card-footer bg-black"></div>
        </div>
    </x-app-layout>
