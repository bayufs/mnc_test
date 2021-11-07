@extends('index')
@section('title', 'MNC Admin - Products')
@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Products</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">Add</a>

                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif


                @if (Session::has('failed'))
                    <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Images</th>
                                <th>Colors</th>
                                <th>Sizes</th>
                                <th>Prices</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (empty($products ?? ''))
                                <tr>
                                    <td colspan="8">
                                        <center>Not Data</center>
                                    </td>
                                </tr>
                            @else

                            @endif
                            <?php $no = 1; ?>
                            @foreach ($products ?? '' as $product)
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>
                                        <?php foreach (json_decode($product->multiple_image) as $image) {?>
                                        <img class="img-fluid" src="{{ asset('uploads/' . $image) }}" alt="">
                                        <?php }?>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach (json_decode($product->multiple_color) as $color)
                                                <li>{{ $color }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach (json_decode($product->multiple_size) as $size)
                                                <li>{{ $size }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach (json_decode($product->multiple_price) as $price)
                                                <li>{{ $price }}</li>
                                                <li></li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ route('product.edit', ['id' => $product->id]) }}"><span
                                                class="badge badge-warning">Edit</span></a>
                                        <a href="{{ route('product.delete', ['id' => $product->id]) }}"><span
                                                class="badge badge-danger">Delete</span></a>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush
