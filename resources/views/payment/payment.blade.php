@extends('template')

@section('main')

<style>
#loader {
  display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    background: rgba(0,0,0,0.75)  url('http://i.imgur.com/KUJoe.gif') no-repeat center center;
    z-index: 99999;

}
/* "{{asset('public/images/loader1.jpg')}}" */
</style>
<div class="container-fluid container-fluid-90 margin-top-85 min-height">
<div id='loader'></div>
<div id="progressDialog"></diV>
	@if(Session::has('message'))
		<div class="row mt-5">
			<div class="col-md-12 text-13 alert mb-0 {{ Session::get('alert-class') }} alert-dismissable fade in  text-center opacity-1">
				<a href="#"  class="close " data-dismiss="alert" aria-label="close">&times;</a>
				{{ Session::get('message') }}
			</div>
		</div>
	@endif
	<input name="property_id" type="hidden" value="{{ $property_id }}" class="property_id">
				<input name="checkin" type="hidden" value="{{ $checkin }}" class="checkin">
				<input name="checkout" type="hidden" value="{{ $checkout }}" class="checkout">
				<input name="number_of_guests" type="hidden" value="{{ $number_of_guests }}" class="number_of_guests">
				<input name="nights" type="hidden" value="{{ $nights }}" class="nights">
				<input name="currency" type="hidden" value="{{ $result->property_price->code }}" class="currency">
				<input name="booking_id" type="hidden" value="{{ $booking_id }}" class="booking_id">
				<input name="booking_type" type="hidden" value="{{ $booking_type }}" class="booking_type">
				<input naem="fname" type="hidden" value="{{Auth()->user()->first_name}}" class="fname">
				<input naem="lname" type="hidden" value="{{Auth()->user()->last_name}}" class="lname">
				<input naem="fname" type="hidden" value="{{Auth()->user()->email}}" class="email">
				<input naem="fname" type="hidden" value="{{Auth()->user()->phone}}" class="phone">
				<input name="total"  type="hidden" value="{!! $price_list->total_with_symbol !!}" class="form-control total mb20">

	<div class="row justify-content-center">
	
		<div class="col-md-6  mt-3 mb-5">
				<div class="card p-3">
					<a href="{{ url('/') }}/properties/{{ $result->slug}}">
						<img class="card-img-top p-2 rounded" src="{{ $result->cover_photo }}" alt="{{ $result->name }}" height="180px">
					</a>

					<div class="card-body p-2">
						<a href="{{ url('/') }}/properties/{{ $result->slug}}">
							<p class="text-16 font-weight-700 mb-0">{{ $result->name }}</p>
						</a>

						<p class="text-14 mt-2 text-muted mb-0">
							<i class="fas fa-map-marker-alt"></i>
							{{$result->property_address->address_line_1}}, {{ $result->property_address->state }}, {{ $result->property_address->country_name }}
						</p>
						<div class="border p-4 mt-4 text-center rounded-3">
							<p class="text-16 mb-0">
								<strong class="font-weight-700 secondary-text-color">{{ $result->property_type_name }}</strong>
								{{trans('messages.payment.for')}}
								<strong class="font-weight-700 secondary-text-color">{{ $number_of_guests }} {{trans('messages.payment.guest')}}</strong>
							</p>
							<div class="text-16"><strong>{{ date('D, M d, Y', strtotime($checkin)) }}</strong> to <strong>{{ date('D, M d, Y', strtotime($checkout)) }}</strong></div>
						</div>

						<div class="border p-4 rounded-3 mt-4">

							@foreach( $price_list->date_with_price as $date_price)
							<div class="d-flex justify-content-between text-16">
								<div>
									<p class="pl-4">{{ $date_price->date }}</p>
								</div>
								<div>
									<p class="pr-4">{!! $date_price->price !!}</p>
								</div>
							</div>
							@endforeach
							<hr>
							<div class="d-flex justify-content-between text-16">
								<div>
									<p class="pl-4">{{trans('messages.payment.night')}}</p>
								</div>
								<div>
									<p class="pr-4">{{ $nights }}</p>
								</div>
							</div>

							<div class="d-flex justify-content-between text-16">
								<div>
									<p class="pl-4">{!! $price_list->per_night_price_with_symbol !!} x {{ $nights }} {{trans('messages.payment.nights')}}</p>
								</div>
								<div>
									<p class="pr-4">{!! $price_list->total_night_price_with_symbol !!}</p>
								</div>
							</div>

							@if($price_list->service_fee)
								<div class="d-flex justify-content-between text-16">
									<div>
										<p class="pl-4">{{trans('messages.payment.service_fee')}}</p>
									</div>

									<div>
										<p class="pr-4">{!! $price_list->service_fee_with_symbol !!}</p>
									</div>
								</div>
							@endif

							@if($price_list->additional_guest)
								<div class="d-flex justify-content-between text-16">
									<div>
										<p class="pl-4">{{trans('messages.payment.additional_guest_fee')}}</p>
									</div>

									<div>
										<p class="pr-4">{!! $price_list->additional_guest_fee_with_symbol !!}</p>
									</div>
								</div>
							@endif

							@if($price_list->security_fee)
								<div class="d-flex justify-content-between text-16">
									<div>
										<p class="pl-4">{{trans('messages.payment.security_deposit')}}</p>
									</div>

									<div>
										<p class="pr-4">{!! $price_list->security_fee_with_symbol !!}</p>
									</div>
								</div>
							@endif

							@if($price_list->cleaning_fee)
								<div class="d-flex justify-content-between text-16">
									<div>
										<p class="pl-4">{{trans('messages.payment.cleaning_fee')}}</p>
									</div>

									<div>
										<p class="pr-4">{!! $price_list->cleaning_fee_with_symbol !!}</p>
									</div>
								</div>
							@endif

							@if($price_list->iva_tax)
								<div class="d-flex justify-content-between text-16">
									<div>
										<p class="pl-4">{{trans('messages.property_single.iva_tax')}}</p>
									</div>

									<div>
										<p class="pr-4">{!! $price_list->iva_tax_with_symbol !!}</p>
									</div>
								</div>
							@endif

							@if($price_list->accomodation_tax)
								<div class="d-flex justify-content-between text-16">
									<div>
										<p class="pl-4">{{trans('messages.property_single.accommodatiton_tax')}}</p>
									</div>

									<div>
										<p class="pr-4">{!! $price_list->accomodation_tax_with_symbol !!}</p>
									</div>
								</div>
							@endif
							<hr>

							<div class="d-flex justify-content-between font-weight-700">
								<div>
									<p class="pl-4">{{trans('messages.payment.total')}}</p>
								</div>

								<div>
									<p class="pr-4">{!! $price_list->total_with_symbol !!}</p>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body">
						<p class="exfont text-16">
							{{trans('messages.payment.paying_in')}}
							<strong><span id="payment-currency">{!! moneyFormat($currencyDefault->org_symbol,$currencyDefault->code) !!}</span></strong>.
							{{trans('messages.payment.your_total_charge')}}
							<strong><span id="payment-total-charge">{!! moneyFormat($currencyDefault->org_symbol, $price_eur) !!}</span></strong>.
							{{trans('messages.payment.exchange_rate_booking')}} {!! moneyFormat($currentCurrency->symbol, 1) !!} {!! $currentCurrency->code !!} to {!! moneyFormat($result->property_price->currency->org_symbol, $price_rate ) !!} {{ $result->property_price->currency_code }} ( {{trans('messages.listing_book.host_currency')}} ).
						</p>
					</div>
					<button id="payment-form-submit" type="submit" class="btn vbtn-outline-success text-16 font-weight-700 pl-5 pr-5 pt-3 pb-3">
							<i class="spinner fa fa-spinner fa-spin d-none"></i>
							{{ ($booking_type == 'instant') ? trans('messages.listing_book.book_now') : trans('messages.property.continue') }}
						</button>
				</div>

				
		</div>
		<!-- <div class="col-md-1 mb-5 mt-3 main-panel p-5 border rounded">
			 <form action="" method="post" id="checkout-form"> -->
				<!-- {{ csrf_field() }} 
				<div class="row justify-content-center">
				 <!-- inpututype -->
				<!-- @if($status == "" && $booking_type == "request")
					<div class="h2 pb-4 m-0 text-24">{{ trans('messages.listing_book.request_message') }}</div>
				@endif
				@if($booking_type == "instant"|| $status == "Processing" )
					<div class="col-md-12 p-0">
						<label for="exampleInputEmail1">{{ trans('messages.payment.country') }}</label>
					</div>

					<div class="col-sm-12 p-0 pb-3">
						<select name="payment_country" id="country-select" data-saving="basics1" class="form-control mb20">
							@foreach($country as $key => $value)
							<option value="{{ $key }}" {{ ($key == $default_country) ? 'selected' : '' }}>{{ $value }}</option>
							@endforeach
						</select>
					</div> -->
         
					
	
					<!-- <div class="col-sm-12 p-0">
						<label for="exampleInputEmail1">{{ trans('messages.payment.payment_type') }}</label>
					</div>

					<div class="col-sm-12 p-0 pb-3">
						<select name="payment_method" class="form-control mb20" id="payment-method-select">
							@if($paypal_status->value == 1)
								<option value="paypal" data-payment-type="payment-method" data-cc-type="visa" data-cc-name="" data-cc-expire="">
								{{ trans('messages.payment.paypal') }}
								</option>
							@endif

							@if($stripe_status->value == 1)
								<option value="stripe" data-payment-type="payment-method" data-cc-type="visa" data-cc-name="" data-cc-expire="">
								{{ trans('messages.payment.stripe') }}
								</option>
                            @endif

                            @if($banks >= 1)
                                <option value="bank" data-payment-type="payment-method" data-cc-type="bank" data-cc-name="" data-cc-expire="">
                                    {{ trans('messages.payment.bank') }}
                                </option>
                            @endif

							@if(!$paypal_status->value == 1 && !$stripe_status->value == 1 && !$banks >= 1)
								<option value="">
								{{ trans('messages.payment.disable') }}
								</option>
							@endif
						</select>
						<div class="paypal-div {{$paypal_status->value != 1 ? 'display-off' : ''}}">
							<span id='paypal-text'>{{ trans('messages.payment.redirect_to_paypal') }}</span>
						</div>

					</div> -->

				<!-- @endif -->

					<!-- <div class="col-sm-12 p-0">
						<label for="message"></label>
					</div>

					<div class="col-sm-12 p-0 pb-3">
						<textarea name="message_to_host" placeholder="{{ trans('messages.trips_active.type_message') }}" class="form-control mb20" rows="7" required></textarea>
					</div> -->


					
				<!-- </div>
			</form> 
		</div> -->
	</div>
</div>
@push('scripts')
<script type="text/javascript" src="{{ url('public/js/jquery.validate.min.js') }}"></script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
// $('#payment-method-select').on('change', function(){
//   var payment = $(this).val();
//   if(payment !== 'paypal'){
//       $('.paypal-div').addClass('display-off')
//   }
//   else {
//       $('.paypal-div').removeClass('display-off')
//   }
// });

// $(document).ready(function() {
//     $('#checkout-form').validate({
//         submitHandler: function(form)
//         {
//  			$("#payment-form-submit").on("click", function (e)
//             {
//             	$("#payment-form-submit").attr("disabled", true);
//                 e.preventDefault();
//             });


//             $(".spinner").removeClass('d-none');
//             $("#save_btn-text").text("{{trans('messages.users_profile.save')}} ..");
//             return true;
//         }
//     });
// });


$('#country-select').on('change', function() {
  var country = $(this).find('option:selected').text();
  $('#country-name-set').html(country);
})





$('#payment-form-submit').on('click',function(e){
	e.preventDefault();

	var total=$('.total').val();
	var total1=total.substring(1).split(",").join(""); 
	var property_id = $('.property_id').val();
	var checkin =$('.checkin').val();
	var checkout =$('.checkout').val();
	var number_of_guests =$('.number_of_guests').val();
	var nights =$('.nights').val();
	var code =$('.code').val();
    var booking_id =$('.booking_id').val();
	var booking_type =$('.booking_type').val();
    var fname =$('.fname').val();
	var lname=$('.lname').val();
	var email=$('.email').val();
	var phone=$('.phone').val();
   
	var options = {	
		"key": "rzp_test_RBphh6rtyZn40S", // Enter the Key ID generated from the Dashboard
		"amount":total1*100 , // Amount is in currency subunits. Default currency is INR. Hence, 10 refers to 1000 paise
		"currency": "INR",
		"name": "Hotel",
		"description": "Thanks for choosing us! ",
		"image": "",
		"order_id": "", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
		"handler": function (response){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type:'POST',
				url:"{{route('create.booking')}}",  //{{ url('payments/create_booking') }}
				data:{
					  total:total,
					  property_id:property_id,
					  checkin:checkin,
					  checkout:checkout,
					  number_of_guests:number_of_guests,
					  nights:nights,
					  code:code,
					  booking_id:booking_id,
					  booking_type:booking_type,
					  transaction_id:response.razorpay_payment_id,
					  razorpay_order_id :response.razorpay_order_id
			 	},
				 dataType:"json",
				success:function(res){
					$('#loader').show();
					$(".preload").fadeIn(function() { 
					});
					window.location.href="{{ url('booking/sendreceipt')}}?code="+res.code;
					
				}
			});
		},
		"prefill": {
			"name": fname,
			"email": email,
			"contact": phone
		},
		"theme": {
			"color": "#528FF0"
		},
		
	};
	var rzp1 = new Razorpay(options);
	rzp1.open();
	
});	
</script>
@endpush
@stop
