@extends('emails.template')

@section('emails.main')

<style>
table {
  border:1px solid black;
  width:100%;
  font-size: 15px;
}
/* tr.bordered {
    border-bottom: 1px solid #000;
} */
</style>
<p style="color:green">{{trans('messages.trips_receipt.receipt')}} # {{ $booking->id }}</p>
 <table>
    <tr>
       <td><strong>{{trans('messages.trips_receipt.customer_receipt')}}</strong></td>
       <td><strong>{{trans('messages.trips_receipt.confirmation_code')}} :</strong> {{ $booking->code }}</td>
    </tr>
    <tr>
        <td><strong>{{trans('messages.trips_receipt.name')}} :</strong> {{ $booking->users->full_name }}</td>
    </tr>
    <tr style="border: 1px solid black;">
                <td><strong>{{trans('messages.trips_receipt.accommodatoin_address')}}</strong><br>
                <strong>{{ @$booking->properties->name }}</strong><br>
                {{ @$booking->properties->property_address->address_line_1 }}<br>
                {{ @$booking->properties->property_address->city }}, {{ @$booking->properties->property_address->state }} {{ @$booking->properties->property_address->postal_code }}<br>
                {{ @$booking->properties->property_address->country_name }}<br>
               </td>
               <td>
               <strong>{{trans('messages.trips_receipt.accommodatoin_address')}}</strong><br>
                {{ @$booking->properties->property_address->city }}<br>
               <strong>{{trans('messages.trips_receipt.accommodation_host')}}</strong><br>
               {{ @$booking->properties->users->full_name }}<br>
               </td>
              <td>
               <strong>{{trans('messages.trips_receipt.duration')}}</strong><br>
               {{ $booking->total_night }} {{trans('messages.trips_receipt.night')}}<br>
               <strong>{{trans('messages.trips_receipt.check_in')}}</strong><br>
               {{ $booking->startdate_dmy }}<br>
               {{trans('messages.trips_receipt.flexible_check_time')}}<br>
             </td>
             <td>
                 <strong>{{trans('messages.trips_receipt.accommodation_type')}}</strong><br>
                {{ @$booking->properties->property_type_name }}</br>
                <strong>{{trans('messages.trips_receipt.check_out')}}</strong></br>
                {{ $booking->enddate_dmy }}<br>{{trans('messages.trips_receipt.flexible_check_out')}}</br>
            </td>
        </tr>
 
    <!-- <table class="table table-bordered table-hover p-0 m-0 pt-2" > -->
        <thead class="thead-dark">
          <tr>
            <th colspan="6" style="color:aliceblue; background-color:black" >{{trans('messages.trips_receipt.booking_charge')}}</th>
          </tr>
        </thead>
        <tbody class="border">
          @if($date_price)
            @foreach($date_price as $datePrice )
              <tr>
                <td>{{ onlyFormat($datePrice->date) }}</td>
                <td class="text-right pr-4">{!! $booking->currency->symbol.$datePrice->price !!}  </td>
              </tr>
            @endforeach
          @endif
          <tr>
            <td>{!! $booking->currency->symbol.$booking->per_night !!} x {{ $booking->total_night }} {{trans('messages.trips_receipt.night')}}</td>
            <td class="text-right pr-4">{!! $booking->currency->symbol.$booking->per_night * $booking->total_night !!}</td>
          </tr>
          @if($booking->guest_charge)
          <tr>
            <td class=""> {{trans('messages.trips_receipt.additional_guest_fee')}} </td>
            <td class="text-right pr-4">{!! $booking->currency->symbol.$booking->guest_charge !!}</td>
          </tr>
          @endif
          @if($booking->cleaning_charge)
          <tr>
            <td class=""> {{trans('messages.trips_receipt.cleaning_fee')}} </td>
            <td class="text-right pr-4">{!! $booking->currency->symbol.$booking->cleaning_charge !!}</td>
          </tr>
          @endif
          @if($booking->security_money)
          <tr>
            <td class=""> {{trans('messages.trips_receipt.security_fee')}} </td>
            <td class="text-right pr-4">{!! $booking->currency->symbol.$booking->security_money !!}</td>
          </tr>
          @endif
          @if($booking->iva_tax)
          <tr>
            <td class=""> I.V.A Tax  </td>
            <td class="text-right pr-4">{!! $booking->currency->symbol.$booking->iva_tax !!}</td>
          </tr>
          @endif
           @if($booking->accomodation_tax)
          <tr>
            <td class="">Accomadation Tax </td>
            <td class="text-right pr-4">{!! $booking->currency->symbol.$booking->accomodation_tax !!}</td>
          </tr>
          @endif
          <tr>
            <td>{{ $site_name }} {{trans('messages.trips_receipt.service_fee')}}</td>
            <td class="text-right pr-4">{!! $booking->currency->symbol.$booking->service_charge !!}</td>
          </tr>
          <tr>
            <td>{{trans('messages.trips_receipt.total')}}</td>
            <td class="text-right pr-4">{!! $booking->currency->symbol.$booking->total !!}</td>
          </tr>
        </tbody>
      </table>	
      <table class="table table-clear">
          <tbody>
            <tr>
              <td class="left">
                <strong>{{trans('messages.trips_receipt.payment_received')}}:{{ $booking->receipt_date }}</strong>
              </td>
              <td class="text-right pr-4"> {!! $booking->transaction_id ?  $booking->currency->symbol.$booking->total: 0 !!}</td>
            </tr>
          </tbody>
        <!-- </table> -->
</table> 

<script ttype="text/javascript">
  function print_receipt()
  {
    document.getElementById("print-div").classList.add("d-none");
    document.getElementById("footer").classList.add("d-none");
    window.print();

     $("#print-div").removeClass("d-none");
  }

</script>
@stop
