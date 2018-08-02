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
        @if($qrcode->user_id == Auth::user()->id || Auth::user()->role_id < 3)

    <!-- User Id Field -->
<div class="form-group">
        {!! Form::label('user_id', 'User Name:') !!}
        <p>{!! $qrcode->user_id !!}</p>
    </div>
    
    <!-- Website Field -->
    <div class="form-group">
        {!! Form::label('website', 'Website:') !!}
        <p>{!! $qrcode->website !!}</p>
    </div>
    
 
    
    <!-- Callback Url Field -->
    <div class="form-group">
        {!! Form::label('callback_url', 'Callback Url:') !!}
        <p>{!! $qrcode->callback_url !!}</p>
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

</div>

@if(Auth::user()->role_id <3 || $qrcode->user_id == Auth::user()->id)
<div class="col-sm-12">
        <h3 class="text-center text-danger">Transcations done on this QRCode</h3>
        @include('transactions.table')
</div>
@endif




