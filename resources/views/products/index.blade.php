@extends('layouts.product')

@section('content')



<div class="card-box">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="page-title">Product List</h2>

        <a href="{{ route('product.create') }}" class="btn btn-primary">
            Create Product
        </a>
    </div>

    <table class="table table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Description</th>
                <th style="width: 150px;">Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->qty }}</td>
                    <td>Rs. {{ $product->price }}</td>
                    <td>{{ $product->description }}</td>

                    <td>
                        <a href="{{ route('product.edit', $product) }}" class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form method="POST" action="{{ route('product.destroy', $product) }}" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="confirmDelete(this)">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted">
                        No products found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

<script>
function confirmDelete(button) {
    Swal.fire({
        title: "Are you sure?",
        text: "This product will be deleted permanently!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            button.closest("form").submit();
        }
    });
}
</script>

@endsection