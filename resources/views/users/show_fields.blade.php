
<div class="col-sm-6">
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{!! $user->name !!}</p>
</div>

<!-- Role Id Field -->
<div class="form-group">
    {!! Form::label('role_id', 'Role Name:') !!}
    <p>{!! $user->role['name'] !!}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $user->email !!}</p>
</div>



<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $user->created_at->format('D d,m,y') !!}</p>
</div>
</div>





@if(Auth::user()->role_id <3 || $user->id == Auth::user()->id)
        <div class="col-sm-6">
                <h3 class="text-center text-primary">QRCodes made by {!! $user->name !!}</h3>
            @include('qrcodes.table')
                </div>

                
                <hr>
    <div class="col-md-12">
        <h3 class="text-center text-danger">Transactions made by {!! $user->name !!}</h3>
            @include('transactions.table')
    </div>
@endif


