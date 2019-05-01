@extends('layouts.pages')

@section('title', 'Subscribe!')

@section('content')
    <script src="https://js.stripe.com/v3/"></script>

    <span class="glyphicon glyphicon-glass"></span>

    @if(auth()->check())
        @if(! $subscriptionIsActive)
            <div class="row">
                <div class="col-md-12">
                    <br> <h6>  Hi {{ auth()->guard('user')->user()->username }}, subscribe to download ebooks!</h6>
                </div>
            </div>

            <div class="row">
                @foreach($subscription as $sub)
                    <div class="col-md-4">
                        <div class="payment-box">
                            <div class="subscription-title">
                                <p> <b> {{ $sub->title }} </b> - £{{ $sub->price }} </p>
                            </div>

                            <br>
                            <p class="subscription-description">{{ $sub->description }}</p>

                            <div class="payment-button">
                                <form action="{{ route('subscribe') }}" method="POST">
                                    <input type="hidden" name="subscription_id" value="{{ $sub->id }}">
                                    <script
                                            src="https://checkout.stripe.com/checkout.js"
                                            class="stripe-button"
                                            data-key="pk_test_KrOBeLEWljcCESyMr9czj4T2"
                                            data-amount="{{ $sub->price * 100 }}"
                                            data-name="{{ $sub->title }}"
                                            data-description="{{ $sub->description }}"
                                            data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                                            data-locale="auto"
                                            data-currency="gbp">
                                    </script>
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
                <p>Your subscription is still active.</p>
            @endif
    @else
        <br> <p>Please <a href="{{ route('user.register') }}">register</a> to access this page, or login <a href="{{ route('user.login') }}">here</a></p>
    @endif
@endsection











