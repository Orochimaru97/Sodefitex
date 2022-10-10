@extends('layouts.app')

@section('title', 'Edit Product')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{__('Home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">{{__('Products')}}</a></li>
        <li class="breadcrumb-item active">{{__('Edit')}}</li>
    </ol>
@endsection

@section('content')
    <div class="px-4 mx-auto mb-4">
        <form id="product-form" action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="row">
                <div class="w-full px-4">
                    @include('utils.alerts')
                    <div class="mb-4">
                        <button class="block uppercase mx-auto shadow bg-indigo-800 hover:bg-indigo-700 focus:shadow-outline focus:outline-none text-white text-xs py-3 px-10 rounded">Update Product <i class="bi bi-check"></i></button>
                    </div>
                </div>
                <div class="w-full px-4">
                    <div class="card">
                        <div class="p-4">
                            <div class="flex flex-wrap -mx-1">
                                <div class="col-md-7">
                                    <div class="mb-4">
                                        <label for="name">{{__('Product Name')}} <span class="text-red-500">*</span></label>
                                        <input type="text" class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded" name="name" required value="{{ $product->name }}">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="mb-4">
                                        <label for="code">{{__('Code')}} <span class="text-red-500">*</span></label>
                                        <input type="text" class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded" name="code" required value="{{ $product->code }}">
                                    </div>
                                </div>
                            
                                <div class="w-full md:w-1/2 px-4 mb-4 md:mb-0">
                                    <div class="mb-4">
                                        <label for="category_id">{{__('Category')}} <span class="text-red-500">*</span></label>
                                        <select class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded" name="category_id" id="category_id" required>
                                            @foreach(\App\Models\Category::all() as $category)
                                                <option {{ $category->id == $product->category->id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 px-4 mb-4 md:mb-0">
                                    <div class="mb-4">
                                        <label for="barcode_symbology">{{__('Barcode Symbology')}} <span class="text-red-500">*</span></label>
                                        <select class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded" name="barcode_symbology" id="barcode_symbology" required>
                                            <option {{ $product->barcode_symbology == 'C128' ? 'selected' : '' }} value="C128">Code 128</option>
                                            <option {{ $product->barcode_symbology == 'C39' ? 'selected' : '' }} value="C39">Code 39</option>
                                            <option {{ $product->barcode_symbology == 'UPCA' ? 'selected' : '' }} value="UPCA">UPC-A</option>
                                            <option {{ $product->barcode_symbology == 'UPCE' ? 'selected' : '' }} value="UPCE">UPC-E</option>
                                            <option {{ $product->barcode_symbology == 'EAN13' ? 'selected' : '' }} value="EAN13">EAN-13</option>
                                            <option {{ $product->barcode_symbology == 'EAN8' ? 'selected' : '' }} value="EAN8">EAN-8</option>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="w-full md:w-1/2 px-4 mb-4 md:mb-0">
                                    <div class="mb-4">
                                        <label for="cost">Cost <span class="text-red-500">*</span></label>
                                        <input id="cost" type="text" class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded" min="0" name="cost" required value="{{ $product->cost }}">
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 px-4 mb-4 md:mb-0">
                                    <div class="mb-4">
                                        <label for="price">Price <span class="text-red-500">*</span></label>
                                        <input id="price" type="text" class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded" min="0" name="price" required value="{{ $product->price }}">
                                    </div>
                                </div>
                            
                                <div class="w-full md:w-1/2 px-4 mb-4 md:mb-0">
                                    <div class="mb-4">
                                        <label for="quantity">{{__('Quantity')}} <span class="text-red-500">*</span></label>
                                        <input type="number" class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded" name="quantity" required value="{{ $product->quantity }}" min="1">
                                    </div>
                                </div>
                                <div class="w-full md:w-1/2 px-4 mb-4 md:mb-0">
                                    <div class="mb-4">
                                        <label for="stock_alert">{{__('Alert Quantity')}} <span class="text-red-500">*</span></label>
                                        <input type="number" class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded" name="stock_alert" required value="{{ $product->stock_alert }}" min="0">
                                    </div>
                                </div>
                            
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="order_tax">{{__('Tax (%)')}}</label>
                                        <input type="number" class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded" name="order_tax" value="{{ $product->order_tax }}" min="0" max="100">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="tax_type">{{__('Tax Type')}}</label>
                                        <select class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded" name="tax_type" id="tax_type">
                                            <option value="" selected>None</option>
                                            <option {{ $product->tax_type == 1 ? 'selected' : '' }}  value="1">Exclusive</option>
                                            <option {{ $product->tax_type == 2 ? 'selected' : '' }} value="2">Inclusive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label for="unit">Unit <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top" title="This text will be placed after Product Quantity."></i> <span class="text-red-500">*</span></label>
                                        <input type="text" class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded" name="unit" value="{{ old('unit') ?? $product->unit }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="note">Note</label>
                                <textarea name="note" id="note" rows="4 " class="block w-full px-4 py-3 mb-2 text-sm placeholder-gray-500 bg-white border rounded">{{ $product->note }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full px-4">
                    <div class="card">
                        <div class="p-4">
                            <div class="mb-4">
                                <label for="image">Product Images <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top" title="Max Files: 3, Max File Size: 1MB, Image Size: 400x400"></i></label>
                                <div class="dropzone d-flex flex-wrap align-items-center justify-content-center" id="document-dropzone">
                                    <div class="dz-message" data-dz-message>
                                        <i class="bi bi-cloud-arrow-up"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('third_party_scripts')
    <script src="{{ asset('js/dropzone.js') }}"></script>
@endsection

@push('page_scripts')
    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('dropzone.upload') }}',
            maxFilesize: 1,
            acceptedFiles: '.jpg, .jpeg, .png',
            maxFiles: 3,
            addRemoveLinks: true,
            dictRemoveFile: "<i class='bi bi-x-circle text-danger'></i> remove",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">');
                uploadedDocumentMap[file.name] = response.name;
            },
            removedfile: function (file) {
                file.previewElement.remove();
                var name = '';
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name;
                } else {
                    name = uploadedDocumentMap[file.name];
                }
                $('form').find('input[name="document[]"][value="' + name + '"]').remove();
            },
            init: function () {
                @if(isset($product) && $product->getMedia('images'))
                var files = {!! json_encode($product->getMedia('images')) !!};
                for (var i in files) {
                    var file = files[i];
                    this.options.addedfile.call(this, file);
                    this.options.thumbnail.call(this, file, file.original_url);
                    file.previewElement.classList.add('dz-complete');
                    $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">');
                }
                @endif
            }
        }
    </script>

    <script src="{{ asset('js/jquery-mask-money.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#cost').maskMoney({
                prefix:'{{ settings()->currency->symbol }}',
                thousands:'{{ settings()->currency->thousand_separator }}',
                decimal:'{{ settings()->currency->decimal_separator }}',
            });
            $('#price').maskMoney({
                prefix:'{{ settings()->currency->symbol }}',
                thousands:'{{ settings()->currency->thousand_separator }}',
                decimal:'{{ settings()->currency->decimal_separator }}',
            });

            $('#cost').maskMoney('mask');
            $('#price').maskMoney('mask');

            $('#product-form').submit(function () {
                var cost = $('#cost').maskMoney('unmasked')[0];
                var price = $('#price').maskMoney('unmasked')[0];
                $('#cost').val(cost);
                $('#price').val(price);
            });
        });
    </script>
@endpush

