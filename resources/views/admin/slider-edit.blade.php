@extends('layouts.admin')


@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Edit Slider</h3>
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
                        <a href="{{ route('admin.slides') }}">
                            <div class="text-tiny">Slider</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit Slider</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.slider.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="id" value="{{ $slider->id }}">
                     <fieldset class="name">
                        <div class="body-title">Tagline <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Tagline"
                            name="tagline" tabindex="0" value="{{ $slider->tagline }}" aria-required="true">
                    </fieldset>
                    @error('tagline')
                        <p class="invalid-feedback " style="font-size: 1.3rem" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">Title <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Title"
                            name="title" tabindex="0" value="{{ $slider->title }}" aria-required="true">
                    </fieldset>
                    @error('title')
                        <p class="invalid-feedback " style="font-size: 1.3rem" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">Sub title <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text"
                            placeholder="Sub title" name="subtitle" tabindex="0" value="{{ $slider->subtitle }}"
                            aria-required="true">
                    </fieldset>
                    @error('subtitle')
                        <p class="invalid-feedback " style="font-size: 1.3rem" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror

                    <fieldset class="name">
                        <div class="body-title">Line <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Line..."
                            name="link" tabindex="0" value="{{ $slider->link }}" aria-required="true">
                    </fieldset>
                    @error('link')
                        <p class="invalid-feedback " style="font-size: 1.3rem" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror


                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            @if ($slider->id)
                            <div class="item" id="imgpreview">
                                <img src="{{ asset('uploads/slides/') }}/{{ $slider->image }}" class="effect8" alt="">
                            </div>
                            @endif
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
                        <p class="invalid-feedback " style="font-size: 1.3rem" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror

                    <fieldset class="category">
                        <div class="body-title">Select category Status</div>
                        <div class="select flex-grow">
                            <select name="status">
                                <option>Select Status</option>
                                <option value="1" {{ $slider->status == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $slider->status == '0' ? 'selected' : '' }}>InActive</option>
                            </select>
                        </div>
                    </fieldset>
                    @error('status')
                        <p class="invalid-feedback " style="font-size: 1.3rem" role="alert">
                            <strong>{{ $message }}</strong>
                        </p>
                    @enderror

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
            <!-- /new-category -->
        </div>
        <!-- /main-content-wrap -->
    </div>
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
    </script>
@endpush
