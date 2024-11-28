@extends('layouts.admin')


@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Coupon infomation</h3>
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
                        <a href="{{ route('admin.coupons') }}">
                            <div class="text-tiny">Coupons</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">New Coupon</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <form class="form-new-product form-style-1" method="POST" action="{{ route('admin.coupon.store') }}">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Coupon Code <span class="tf-color-1">*</span></div>
                        <input class="flex-grow @error('code') is-invalid @enderror" type="text"
                            placeholder="Coupon Code" name="code" value="{{ old('code') }}" tabindex="0"
                            value="" aria-required="true">
                    </fieldset>
                    @error('code')
                        <span class="invalid-feedback" style="font-size: 1.2rem" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <fieldset class="category">
                        <div class="body-title">Coupon Type</div>
                        <div class="select flex-grow">
                            <select class="" name="type">
                                <option value="">Select</option>
                                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Percent</option>
                            </select>
                        </div>
                    </fieldset>
                    @error('type')
                        <span class="invalid-feedback" style="font-size: 1.2rem" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">Value <span class="tf-color-1">*</span></div>
                        <input class="flex-grow @error('value') is-invalid @enderror" type="text"
                            placeholder="Coupon Value" name="value" value="{{ old('value') }}" tabindex="0"
                            value="" aria-required="true">
                    </fieldset>
                    @error('value')
                        <span class="invalid-feedback" style="font-size: 1.2rem" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <fieldset class="name">
                        <div class="body-title">Cart Value <span class="tf-color-1">*</span></div>
                        <input class="flex-grow @error('cart_value') is-invalid @enderror" type="text"
                            placeholder="Cart Value" name="cart_value" value="{{ old('cart_value') }}" tabindex="0"
                            value="" aria-required="true">
                    </fieldset>
                    @error('cart_value')
                        <span class="invalid-feedback" style="font-size: 1.2rem" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <fieldset class="name">
                        <div for="expiry_date" class="body-title">Expiry Date <span class="tf-color-1">*</span></div>
                        <input id="expiry_date" class="flex-grow @error('expiry_date') is-invalid @enderror" type="date"
                            placeholder="Expiry Date" name="expiry_date" value="{{ old('expiry_date') }}" tabindex="0"
                            value="" aria-required="true">
                    </fieldset>
                    @error('expiry_date')
                        <span class="invalid-feedback" style="font-size: 1.2rem" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
