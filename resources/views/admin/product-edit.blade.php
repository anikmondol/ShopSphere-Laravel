@extends('layouts.admin')


@section('content')
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Edit Product</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.products') }}">
                            <div class="text-tiny">Products</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit product</div>
                    </li>
                </ul>
            </div>
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data" action="{{ route("admin.product.update") }}">
                @csrf
                @method("PUT")
                <input type="hidden" name="id" value="{{ $product->id }}">
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Product name <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter product name" name="name" tabindex="0"
                            value="{{ $product->name }}" aria-required="true">
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    @error('name')
                        <span class="alert alert-danger text-center" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter product slug" name="slug" tabindex="0"
                            value="{{ $product->slug }}" aria-required="true">
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    @error('slug')
                        <span class="alert alert-danger text-center" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="body-title mb-10">Category <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="category_id">
                                    <option>Choose category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                        @error('category_id')
                            <span class="alert alert-danger text-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <fieldset class="brand">
                            <div class="body-title mb-10">Brand <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="brand_id">
                                    <option>Choose Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"
                                            {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                        @error('brand_id')
                            <span class="alert alert-danger text-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <fieldset class="shortdescription">
                        <div class="body-title mb-10">Short Description <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10 ht-150" name="short_description" placeholder="Short Description" tabindex="0"
                            aria-required="true"> {{ $product->short_description }} </textarea>
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    @error('short_description')
                        <span class="alert alert-danger text-center" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <fieldset class="description">
                        <div class="body-title mb-10">Description <span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true">{{ $product->description }}</textarea>
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    @error('description')
                        <span class="alert alert-danger text-center" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="wg-box">
                    <fieldset>
                        <div class="body-title mb-4">Upload images <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow ">
                            @if ($product->image)
                                <div class="item" id="imgpreview">
                                    <img src=" {{ asset('uploads/products') }}/{{ $product->image }} " class="effect8"
                                        alt="{{ $product->name }}">
                            @endif
                        </div>
                        <div id="upload-file" class="item up-load w-100">
                            <label class="uploadfile" for="myFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Drop your images here or select <span class="tf-color">click to
                                        browse</span></span>
                                <input type="file" id="myFile" name="image" accept="image/*">
                            </label>
                        </div>
                </div>
                </fieldset>
                @error('image')
                    <span class="alert alert-danger text-center" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <fieldset>
                    <div class="body-title mb-10">Upload Gallery Images</div>
                    @php
                        $imagesArray = explode(',', $product->images); // Convert the string to an array
                    @endphp
                    <div class="upload-image mb-16 grid-container">

                        @if (!empty($imagesArray) && isset($imagesArray[0]))
                        <div class="file-upload-section w-100">
                            <label
                                class="uploadfile d-flex flex-column align-items-center justify-content-center p-4 border rounded"
                                style="cursor: pointer; border: 2px dashed #007bff; background-color: #f9f9f9;">
                                <span class="icon" style="font-size: 36px; color: #007bff;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </span>
                                <span class="text-tiny mt-2">
                                    <span class="tf-color" style="color: #007bff; font-weight: bold;">Click to browse</span>
                                </span>
                                <input type="file" name="images[]" class="form-control d-none" accept="image/*" multiple>
                                <!-- Preview Container for Multiple Images -->
                                <div class="display-input-images mt-3" style="width: 100px">
                                    <img src="{{ asset('uploads/products/thumbnails/' . $imagesArray[0]) }}"alt="Image" style="width: 100%; height: auto;">
                                </div>
                            </label>
                        </div>
                        @else
                            <div class="file-upload-section w-100">
                                <label
                                    class="uploadfile d-flex flex-column align-items-center justify-content-center p-4 border rounded"
                                    style="cursor: pointer; border: 2px dashed #007bff; background-color: #f9f9f9;">
                                    <span class="icon" style="font-size: 36px; color: #007bff;">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </span>
                                    <span class="text-tiny mt-2">
                                        <span class="tf-color" style="color: #007bff; font-weight: bold;">click to
                                            browse</span>
                                    </span>
                                    <input type="file" name="images[]" class="form-control d-none" accept="image/*"
                                        multiple>


                                    <div class="display-input-images mt-3" style="width: 100px">
                                        <!-- Previews will be appended dynamically here -->
                                    </div>

                                </label>
                            </div>
                        @endif

                        @if (!empty($imagesArray) && isset($imagesArray[1]))
                        <div class="file-upload-section w-100">
                            <label
                                class="uploadfile d-flex flex-column align-items-center justify-content-center p-4 border rounded"
                                style="cursor: pointer; border: 2px dashed #007bff; background-color: #f9f9f9;">
                                <span class="icon" style="font-size: 36px; color: #007bff;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </span>
                                <span class="text-tiny mt-2">
                                    <span class="tf-color" style="color: #007bff; font-weight: bold;">Click to browse</span>
                                </span>
                                <input type="file" name="images[]" class="form-control d-none" accept="image/*" multiple>
                                <!-- Preview Container for Multiple Images -->
                                <div class="display-input-images mt-3" style="width: 100px">
                                    <img src="{{ asset('uploads/products/thumbnails/' . $imagesArray[1]) }}" alt="Image" style="width: 100%; height: auto;">
                                </div>
                            </label>
                        </div>
                        @else
                            <div class="file-upload-section w-100">
                                <label
                                    class="uploadfile d-flex flex-column align-items-center justify-content-center p-4 border rounded"
                                    style="cursor: pointer; border: 2px dashed #007bff; background-color: #f9f9f9;">
                                    <span class="icon" style="font-size: 36px; color: #007bff;">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </span>
                                    <span class="text-tiny mt-2">
                                        <span class="tf-color" style="color: #007bff; font-weight: bold;">click to
                                            browse</span>
                                    </span>
                                    <input type="file" name="images[]" class="form-control d-none" accept="image/*"
                                        multiple>


                                    <div class="display-input-images mt-3" style="width: 100px">
                                        <!-- Previews will be appended dynamically here -->
                                    </div>

                                </label>
                            </div>
                        @endif


                        @if (!empty($imagesArray) && isset($imagesArray[2]))
                        <div class="file-upload-section w-100">
                            <label
                                class="uploadfile d-flex flex-column align-items-center justify-content-center p-4 border rounded"
                                style="cursor: pointer; border: 2px dashed #007bff; background-color: #f9f9f9;">
                                <span class="icon" style="font-size: 36px; color: #007bff;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </span>
                                <span class="text-tiny mt-2">
                                    <span class="tf-color" style="color: #007bff; font-weight: bold;">Click to browse</span>
                                </span>
                                <input type="file" name="images[]" class="form-control d-none" accept="image/*" multiple>
                                <!-- Preview Container for Multiple Images -->
                                <div class="display-input-images mt-3" style="width: 100px">
                                    <img src="{{ asset('uploads/products/thumbnails/' . $imagesArray[2]) }}" alt="Image" style="width: 100%; height: auto;">
                                </div>
                            </label>
                        </div>
                        @else
                            <div class="file-upload-section w-100">
                                <label
                                    class="uploadfile d-flex flex-column align-items-center justify-content-center p-4 border rounded"
                                    style="cursor: pointer; border: 2px dashed #007bff; background-color: #f9f9f9;">
                                    <span class="icon" style="font-size: 36px; color: #007bff;">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </span>
                                    <span class="text-tiny mt-2">
                                        <span class="tf-color" style="color: #007bff; font-weight: bold;">click to
                                            browse</span>
                                    </span>
                                    <input type="file" name="images[]" class="form-control d-none" accept="image/*"
                                        multiple>


                                    <div class="display-input-images mt-3" style="width: 100px">
                                        <!-- Previews will be appended dynamically here -->
                                    </div>

                                </label>
                            </div>
                        @endif


                        @if (!empty($imagesArray) && isset($imagesArray[3]))
                        <div class="file-upload-section w-100">
                            <label
                                class="uploadfile d-flex flex-column align-items-center justify-content-center p-4 border rounded"
                                style="cursor: pointer; border: 2px dashed #007bff; background-color: #f9f9f9;">
                                <span class="icon" style="font-size: 36px; color: #007bff;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </span>
                                <span class="text-tiny mt-2">
                                    <span class="tf-color" style="color: #007bff; font-weight: bold;">Click to browse</span>
                                </span>
                                <input type="file" name="images[]" class="form-control d-none" accept="image/*" multiple>
                                <!-- Preview Container for Multiple Images -->
                                <div class="display-input-images mt-3" style="width: 100px">
                                    <img src="{{ asset('uploads/products/thumbnails/' . $imagesArray[3]) }}" alt="Image" style="width: 100%; height: auto;">
                                </div>
                            </label>
                        </div>
                        @else
                            <div class="file-upload-section w-100">
                                <label
                                    class="uploadfile d-flex flex-column align-items-center justify-content-center p-4 border rounded"
                                    style="cursor: pointer; border: 2px dashed #007bff; background-color: #f9f9f9;">
                                    <span class="icon" style="font-size: 36px; color: #007bff;">
                                        <i class="fas fa-cloud-upload-alt"></i>
                                    </span>
                                    <span class="text-tiny mt-2">
                                        <span class="tf-color" style="color: #007bff; font-weight: bold;">click to
                                            browse</span>
                                    </span>
                                    <input type="file" name="images[]" class="form-control d-none" accept="image/*"
                                        multiple>


                                    <div class="display-input-images mt-3" style="width: 100px">
                                        <!-- Previews will be appended dynamically here -->
                                    </div>

                                </label>
                            </div>
                        @endif




                        {{-- <div class="file-upload-section w-100">
                            <label
                                class="uploadfile d-flex flex-column align-items-center justify-content-center p-4 border rounded"
                                style="cursor: pointer; border: 2px dashed #007bff; background-color: #f9f9f9;">
                                <span class="icon" style="font-size: 36px; color: #007bff;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </span>
                                <span class="text-tiny mt-2">
                                    <span class="tf-color" style="color: #007bff; font-weight: bold;">click to
                                        browse</span>
                                </span>
                                <input type="file" name="images[]" class="form-control d-none" accept="image/*"
                                    multiple>
                                <!-- Preview Container for Multiple Images -->
                                <div class="display-input-images mt-3" style="width: 100px">
                                    <!-- Previews will be appended dynamically here -->
                                </div>
                            </label>

                        </div>

                        <div class="file-upload-section w-100">
                            <label
                                class="uploadfile d-flex flex-column align-items-center justify-content-center p-4 border rounded"
                                style="cursor: pointer; border: 2px dashed #007bff; background-color: #f9f9f9;">
                                <span class="icon" style="font-size: 36px; color: #007bff;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </span>
                                <span class="text-tiny mt-2">
                                    <span class="tf-color" style="color: #007bff; font-weight: bold;">click to
                                        browse</span>
                                </span>
                                <input type="file" name="images[]" class="form-control d-none" accept="image/*"
                                    multiple>
                                <!-- Preview Container for Multiple Images -->
                                <div class="display-input-images mt-3" style="width: 100px">
                                    <!-- Previews will be appended dynamically here -->
                                </div>
                            </label>

                        </div>

                        <div class="file-upload-section w-100">
                            <label
                                class="uploadfile d-flex flex-column align-items-center justify-content-center p-4 border rounded"
                                style="cursor: pointer; border: 2px dashed #007bff; background-color: #f9f9f9;">
                                <span class="icon" style="font-size: 36px; color: #007bff;">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </span>
                                <span class="text-tiny mt-2">
                                    <span class="tf-color" style="color: #007bff; font-weight: bold;">click to
                                        browse</span>
                                </span>
                                <input type="file" name="images[]" class="form-control d-none" accept="image/*"
                                    multiple>


                                <div class="display-input-images mt-3" style="width: 100px">
                                    <!-- Previews will be appended dynamically here -->
                                </div>

                            </label>
                        </div> --}}

                    </div>
                </fieldset>
                @error('images')
                    <span class="alert alert-danger text-center" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">Regular Price <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter regular price" name="regular_price"
                            tabindex="0" value="{{ $product->regular_price }}" aria-required="true">
                        @error('regular_price')
                            <div class="alert alert-danger text-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </fieldset>


                    <fieldset class="name">
                        <div class="body-title mb-10">Sale Price <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter sale price" name="sale_price"
                            tabindex="0" value="{{ $product->sale_price }}" aria-required="true">
                        @error('sale_price')
                            <div class="alert alert-danger text-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </fieldset>

                </div>


                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter SKU" name="SKU" tabindex="0"
                            value="{{ $product->SKU }}" aria-required="true">
                        @error('SKU')
                            <div class="alert alert-danger text-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </fieldset>


                    <fieldset class="name">
                        <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter quantity" name="quantity"
                            tabindex="0"value="{{ $product->quantity }}" aria-required="true">
                        @error('quantity')
                            <div class="alert alert-danger text-center" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </fieldset>


                </div>

                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">Stock</div>
                        <div class="select mb-10">
                            <select class="" name="stock_status">
                                <option value="instock" {{ $product->stock_status == 'instock' ? 'selected' : '' }}>
                                    InStock</option>
                                <option value="outofstock" {{ $product->stock_status == 'outofstock' ? 'selected' : '' }}>
                                    Out of Stock</option>
                            </select>
                        </div>
                    </fieldset>
                    @error('stock_status')
                        <span class="alert alert-danger text-center" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title mb-10">Featured</div>
                        <div class="select mb-10">
                            <select class="" name="featured">
                                <option value="0" {{ $product->featured == '0' ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $product->featured == '1' ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                    </fieldset>

                    @error('featured')
                        <span class="alert alert-danger text-center" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="cols gap10">
                    <button class="tf-button w-full" type="submit">Add product</button>
                </div>
        </div>
        </form>
        <!-- /form-add-product -->
    </div>
    <!-- /main-content-wrap -->

    </div>
    <!-- /main-content-wrap -->
@endsection


@push('scripts')
    <script>
        $(function() {
            $("#myFile").on("change", function(e) {
                const photoInput = $("#myFile");
                const [file] = this.files;
                if (file) {
                    $("#imgpreview img").attr('src', URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });

            $("input[name='name']").on('change', function() {
                $("input[name='slug']").val(StringToSlug($(this).val()));
            });
        });

        function StringToSlug(Text) {
            return Text.toLowerCase()
                .replace(/[^\w\s-]/g, "")
                .replace(/\s+/g, "-")
                .replace(/^-+|-+$/g, "");
        }

        $(document).ready(function() {
            // Trigger file input when clicking on drag-and-drop area
            $('.uploadfile').on('click', function() {
                $(this).find('input[type="file"]').trigger('click');
            });

            // Trigger file input when clicking on Browse button
            $('.file-upload-browse').on('click', function() {
                $(this).closest('.file-upload-section').find('input[type="file"]').trigger('click');
            });

            // Handle file selection and display previews
            $('input[type="file"]').on('change', function() {
                const files = this.files;
                const displayContainer = $(this).closest('.file-upload-section').find(
                    '.display-input-images');
                displayContainer.empty(); // Clear existing previews

                if (files.length > 0) {
                    Array.from(files).forEach(file => {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            const img = $('<img>').attr('src', e.target.result);
                            displayContainer.append(img);
                        };

                        reader.readAsDataURL(file); // Read file as Data URL
                    });
                }
            });
        });
    </script>
@endpush
