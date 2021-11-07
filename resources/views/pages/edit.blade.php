@extends('index')
@section('title', 'MNC Admin - Edit Product')
@section('main')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Products</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('product.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="text" class="col-4 col-form-label">Name</label>
                            <div class="col-8">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fa fa-address-card"></i>
                                        </div>
                                    </div>
                                    <input id="name" name="name" placeholder="Name..." type="text" class="form-control" value="{{ $product->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="select" class="col-4 col-form-label">Category</label>
                            <div class="col-8">
                                <select id="select" name="category_id" class="custom-select">
                                    <option>-- Categoty --</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}" {{ ($product->categories_id == $item->id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="textarea" class="col-4 col-form-label">Description</label>
                            <div class="col-8">
                                <textarea id="textarea" name="description" cols="40" rows="5"
                                    class="form-control">{{ $product->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="textarea" class="col-4 col-form-label">Image</label>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="">Main Image</label>
                                        <input type="text" name="old_main_image" value="{{ json_decode($prduct->multiple_image->main_image) }}">
                                        <input type="file" name="main_image" value="">
                                    </div>
                                    <div class="col-4">
                                        <label for="">Second Image</label>
                                        <input type="file" name="second_image" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-4">Sizes</label>
                            <div class="col-8">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input name="size[]" id="checkbox_0" type="checkbox" checked="checked"
                                        class="custom-control-input" value="s">
                                    <label for="checkbox_0" class="custom-control-label">S</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input name="size[]" id="checkbox_1" value="m" type="checkbox"
                                        class="custom-control-input">
                                    <label for="checkbox_1" class="custom-control-label">M</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input name="size[]" id="checkbox_2" value="l" type="checkbox"
                                        class="custom-control-input" >
                                    <label for="checkbox_2" class="custom-control-label">L</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input name="size[]" id="checkbox_3" value="xl" type="checkbox"
                                        class="custom-control-input" >
                                    <label for="checkbox_3" class="custom-control-label">XL</label>
                                </div>
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input name="size[]" id="checkbox_4" value="xxl" type="checkbox"
                                        class="custom-control-input" >
                                    <label for="checkbox_4" class="custom-control-label">XXL</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-4">Colors</label>
                            <div class="col-8">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="color[]" class="form-check-input" id="exampleCheck1" value="merah">
                                        <label class="form-check-label" for="exampleCheck1">Merah</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="color[]" class="form-check-input" id="exampleCheck1" value="biru">
                                        <label class="form-check-label" for="exampleCheck1">Biru</label>
                                      </div>
                                      <div class="form-group form-check">
                                        <input type="checkbox" name="color[]" class="form-check-input" id="exampleCheck1" value="hitam">
                                        <label class="form-check-label" for="exampleCheck1">Hitam</label>
                                      </div>
                                      <div class="form-group form-check">
                                        <input type="checkbox" name="color[]" class="form-check-input" id="exampleCheck1" value="abu-abu">
                                        <label class="form-check-label" for="exampleCheck1">Abu-abu</label>
                                      </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="text1" class="col-4 col-form-label">Variants</label>
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="">Variant 1</label>
                                    <input name="variant_1" placeholder="Name" type="text" class="form-control mb-1">
                                    <input name="price_1" placeholder="Price" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Variant 2</label>
                                    <input name="variant_2" placeholder="Name" type="text" class="form-control mb-1">
                                    <input name="price_2" placeholder="Price" type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Variant 3</label>
                                    <input name="variant_3" placeholder="Name" type="text" class="form-control mb-1">
                                    <input name="price_3" placeholder="Price" type="text" class="form-control">
                                </div>

                            </div>
                        </div>
                        <div class="form-group row">
                            <button type="reset" class="btn btn-dark ml-3">Cancel</button>
                            <button type="submit" class="btn btn-primary ml-1">Save</button>
                        </div>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
@endpush
