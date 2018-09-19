<div class="col-md-6">

     <!-- Product Name Field -->
     <div class="form-group">
            
            <h3>{!! $qrcode->product_name !!}
            @if(isset($qrcode->company_name))
            <br>
            <small> By {!! $qrcode->company_name !!}</small>
            @endif
        </h3>
        </div>

         <!-- Amount Field -->
        <div class="form-group">            
            <h4> Amount : ${!! $qrcode->amount !!}</h4>
        </div>


         <!-- Product Url Field -->
        <div class="form-group">
            {!! Form::label('product_url', 'Product Url:') !!}
            <p>
                <a href="{!! $qrcode->product_url !!}" target="_blank">
                        {!! $qrcode->product_url !!}
                </a>
                
            </p>
        </div>

        <hr>
        <!--verify if the user is can see the rest of the content -->
        @if(!Auth::guest() && ($qrcode->user_id == Auth::user()->id || Auth::user()->role_id < 3))

    <!-- User Id Field -->
<div class="form-group">
        {!! Form::label('user_id', 'User :') !!}
        <p>{!! Auth::user()->email  !!}</p>
    </div>
    
    <!-- Website Field -->
    <div class="form-group">
        {!! Form::label('website', 'Website:') !!}
        <p> 
                <a href="{!! $qrcode->website !!}" target="_blank">
            <b>{!! $qrcode->website !!}</b>
                </a>
        </p>
    </div>
    
 
    
    <!-- Callback Url Field -->
    <div class="form-group">
        {!! Form::label('callback_url', 'Callback Url:') !!}
        <p>
            <a href="{!! $qrcode->callback_url !!}" target="_blank">
                    <b>{!! $qrcode->callback_url !!}</b>
            </a>
            
        </p>
    </div>
 
    <!-- Status Field -->
    <div class="form-group">
        {!! Form::label('status', 'Status:') !!}
        <p>
            @if($qrcode->status==1)
            <i class="fa fa-check-square text-green"></i>
            @else
            <i class="fa fa-times text-red"></i>
            @endif

        </p>
    </div>
    
    <!-- Created At Field -->
    <div class="form-group">
        {!! Form::label('created_at', 'Created At:') !!}
        <p>{!! $qrcode->created_at !!}</p>
    </div>
    
    <!-- Updated At Field -->
    <div class="form-group">
        {!! Form::label('updated_at', 'Updated At:') !!}
        <p>{!! $qrcode->updated_at !!}</p>
    </div>
    @endif
</div>

<div class="col-md-5 pull-right">

     <!-- Qrcode Path Field -->
     <div class="form-group">
            {!! Form::label('qrcode_path', 'Scan QRcode and pay with our App:') !!}
            <p>
            <img src="{{asset($qrcode->qrcode_path)}}" >
            </p>
        </div>
        <!--form to add paypal-->
        <div class="container">
            @if($message = Session::get('success'))
                <div class="container">
                    <span onclick="this.parentElement.style.display = 'none'"
                    >&times;

                    </span>
                    <p>{{ $message }}</p>

                </div>
                <?php Session::forget('success'); ?>
            @endif
                <form class="" method="POST" id="payment-form"  action="{!! URL::to('paypal') !!}">
                {{ csrf_field() }}
                <h3 class="w3-text-blue">Payment </h3>            
                <p>                  
                <input class="w3-input w3-border" name="amount" type="hidden" value="{{$qrcode->amount}}">
                </p>      
                <button class="btn btn-danger">Pay with PayPal</button></p>
                 </form>
        </div>
            
</div>


@if(!Auth::guest() && (Auth::user()->role_id <3 || $qrcode->user_id == Auth::user()->id))
<div class="col-sm-12">
        <h3 class="text-center text-danger">Transcations done on this QRCode</h3>
        @include('transactions.table')
</div>
@endif




