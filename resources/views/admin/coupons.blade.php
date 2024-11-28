@extends('layouts.admin')


@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Coupons</h3>
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
                        <div class="text-tiny">Coupons</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name"
                                    tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="add-coupon.html"><i class="icon-plus"></i>Add new</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Value</th>
                                    <th>Cart Value</th>
                                    <th>Expiry Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>{{ $coupon->type }}</td>
                                        <td>${{ $coupon->value }}</td>
                                        <td>{{ $coupon->cart_value }}</td>
                                        <td>{{ $coupon->expiry_date }}</td>
                                        <td>
                                            <div class="list-icon-function">
                                                <a href="#">
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                </a>
                                                <form action="#" method="POST">
                                                    <div class="item text-danger delete">
                                                        <i class="icon-trash-2"></i>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                div class="divider">
            </div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                {{ $coupons->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    </div>
@endsection


{{-- @push('scripts')
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
@endpush --}}
