    <x-app-layout>
        <div class="container mt-5 mb-3">
            @if (count($invoices) <= 0)
                You haven't ordered anything yet!
            @else
                @foreach ($invoices as $invoice)
                    <div class="card mt-3">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $invoice->id }}"
                                    aria-expanded="false" aria-controls="collapse{{ $invoice->id }}">
                                    Open invoice {{ $invoice->id }}
                                </button>
                                <a href="{{ route('invoice.show', $invoice->id) }}" class="btn btn-link">
                                    Invoice details </a>
                            </h5>
                            <ul class="list-group list-group-flush">
                                @foreach ($orderedProducts as $product)
                                    @if ($product->invoice_id == $invoice->id)
                                        <div class="collapse" id="collapse{{ $invoice->id }}">
                                            <div class="card card-body">
                                                <li class="list-group-item">{{ $product->product->name }} | Amount: {{ $product->amount }}</li>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </x-app-layout>
