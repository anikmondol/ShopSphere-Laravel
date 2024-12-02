@extends('layouts.app')

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="contact-us container">
            <div class="mw-930">
                <h2 class="page-title">CONTACT US</h2>
            </div>
        </section>

        <hr class="mt-2 text-secondary " />
        <div class="mb-4 pb-4"></div>

        <section class="contact-us container">
            <div class="mw-930">
                <div class="contact-us__form">
                    @if (Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                    @endif
                    <form name="contact-us-form" class="needs-validation" novalidate="" method="POST"
                        action="{{ route('home.contact.store') }}">
                        @csrf
                        <h3 class="mb-5">Get In Touch</h3>
                        <div class="form-floating my-4">
                            <input type="text" class="form-control @error('name') is-invalid @enderror "
                                value="{{ old('name') }}" name="name" placeholder="Name *">
                            <label for="contact_us_name">Name *</label>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating my-4">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror "
                                value="{{ old('phone') }}" name="phone" placeholder="Phone *">
                            <label for="contact_us_name">Phone *</label>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-floating my-4">
                            <input type="email" class="form-control @error('email') is-invalid @enderror "
                                value="{{ old('email') }}" name="email" placeholder="Email address *">
                            <label for="contact_us_name">Email address *</label>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="my-4">
                            <textarea class="form-control @error('comment') is-invalid @enderror  form-control_gray"
                                name="comment" placeholder="Your Message" cols="30" rows="8">{{ old('comment') }}</textarea>
                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="my-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
