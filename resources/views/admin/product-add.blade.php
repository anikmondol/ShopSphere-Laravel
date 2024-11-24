@extends('layouts.admin')

@section('content')
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Add Product</h3>
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
                        <div class="text-tiny">Add product</div>
                    </li>
                </ul>
            </div>
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
                action="{{ route('admin.product.store') }}">
                @csrf
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Product name <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter product name" name="name" tabindex="0"
                            value="{{ old('name') }}" aria-required="true">
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
                            value="{{ old('slug') }}" aria-required="true">
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
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                            aria-required="true"> {{ old('short_description') }}</textarea>
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
                        <textarea class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true">{{ old('description') }}</textarea>
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
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview" style="display:none">
                                <img src="../../../localhost_8000/images/upload/upload-1.png" class="effect8"
                                    alt="">
                            </div>
                            <div id="upload-file" class="item up-load">
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
                        <div class="upload-image mb-16">
                            <!-- <div class="item">
                                                <img src="images/upload/upload-1.png" alt="">
                                            </div>                                                 -->
                            {{-- <div id="galUpload" class="item up-load">
                                <label class="uploadfile" for="gFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="text-tiny">Drop your images here or select <span class="tf-color">click
                                            to browse</span></span>
                                    <input type="file" id="gFile" name="images[]" accept="image/*"
                                        multiple="">
                                </label>
                            </div> --}}
                        </div>
                    </fieldset>
                    <div class="form-group row>
                        <label class="col-sm-3 col-form-label">Attachments</label>
                        <div class="col-sm-9">
                            <div class="file-upload-section">
                                <!-- Hidden file input for multiple files -->
                                <input
                                    name="images[]"
                                    type="file"
                                    class="form-control d-none"
                                    allowed="png,gif,jpeg,jpg"
                                    multiple
                                >
                                <!-- Visible input field and browse button -->
                                <div class="input-group col-xs-12">
                                    <input
                                        type="text"
                                        class="form-control file-upload-info"
                                        disabled
                                        readonly
                                        placeholder="Upload multiple images (max 500kB each)"
                                    >
                                    <span class="input-group-append">
                                        <button
                                            class="file-upload-browse btn btn-outline-secondary"
                                            type="button">
                                            <i class="fas fa-upload"></i> Browse
                                        </button>
                                    </span>
                                </div>
                                <!-- Preview container for multiple images -->
                                <div class="display-input-images mt-3">
                                    <!-- Previews will be appended here -->
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <div class="file-upload-section">
                                <!-- Hidden file input for multiple files -->
                                <input
                                    name="images[]"
                                    type="file"
                                    class="form-control d-none"
                                    allowed="png,gif,jpeg,jpg"
                                    multiple
                                >
                                <!-- Visible input field and browse button -->
                                <div class="input-group col-xs-12">
                                    <input
                                        type="text"
                                        class="form-control file-upload-info"
                                        disabled
                                        readonly
                                        placeholder="Upload multiple images (max 500kB each)"
                                    >
                                    <span class="input-group-append">
                                        <button
                                            class="file-upload-browse btn btn-outline-secondary"
                                            type="button">
                                            <i class="fas fa-upload"></i> Browse
                                        </button>
                                    </span>
                                </div>
                                <!-- Preview container for multiple images -->
                                <div class="display-input-images mt-3">
                                    <!-- Previews will be appended here -->
                                </div>
                            </div>
                        </div>

                    </div>

                    @error('images')
                        <span class="alert alert-danger text-center" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Regular Price <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter regular price" name="regular_price"
                                tabindex="0" value="{{ old('regular_price') }}" aria-required="true">
                            @error('regular_price')
                                <div class="alert alert-danger text-center" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </fieldset>


                        <fieldset class="name">
                            <div class="body-title mb-10">Sale Price <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter sale price" name="sale_price"
                                tabindex="0" value="{{ old('sale_price') }}" aria-required="true">
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
                                value="{{ old('SKU') }}" aria-required="true">
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
                                tabindex="0" value="{{ old('quantity') }}" aria-required="true">
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
                                    <option value="instock">InStock</option>
                                    <option value="outofstock">Out of Stock</option>
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
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
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

            $("#gFile").on("change", function(e) {
                const gPhotos = this.files;

                // Clear previous gallery preview
                // $(".gitems").remove();

                // Loop through selected files and append to gallery
                $.each(gPhotos, function(index, file) {
                    const imgPreview =
                        `<div class="item gitems"><img src="${URL.createObjectURL(file)}" alt="Gallery Image" /></div>`;
                    $("#galUpload").before(imgPreview);
                });
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

        $(document).ready(function () {
    // Trigger file input click when "Browse" is clicked
    $(".file-upload-browse").on("click", function () {
        $(this).closest(".file-upload-section").find('input[type="file"]').trigger("click");
    });

    // Handle file input change for multiple images
    $('input[name="images[]"]').on("change", function (e) {
        const fileInput = $(this);
        const files = this.files; // Get all selected files
        const allowedExtensions = fileInput.attr("allowed").split(",");
        const maxSize = 500 * 1024; // 500kB

        // Loop through all files and handle them
        $.each(files, function (index, file) {
            const fileExtension = file.name.split(".").pop().toLowerCase();

            // Validate file extension
            if (!allowedExtensions.includes(fileExtension)) {
                alert(`Invalid file type: ${file.name}. Only the following types are allowed: ${allowedExtensions.join(", ")}`);
                return;
            }

            // Validate file size
            if (file.size > maxSize) {
                alert(`File size exceeds the maximum limit of 500kB: ${file.name}`);
                return;
            }

            // Create a preview item for each valid file
            const previewItem = `
                <div class="preview-item">
                    <img src="${URL.createObjectURL(file)}" alt="Image Preview" class="img-thumbnail" />
                    <button type="button" class="btn btn-sm btn-outline-danger file-upload-remove" data-file-index="${index}" title="Remove">x</button>
                </div>
            `;

            // Append the preview item to the container
            fileInput.closest(".file-upload-section").find(".display-input-images").append(previewItem);
        });
    });

    // Remove individual image previews
    $(".file-upload-section").on("click", ".file-upload-remove", function () {
        $(this).closest(".preview-item").remove();
    });
});


    </script>
@endpush
