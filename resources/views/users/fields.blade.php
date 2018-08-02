<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}

</div>

@if(Auth::user()->role_id <3)


<div class="from-group col-sm-6">
<label for="sel1">
 Role Names
</label>
<select class="form-control" >
    @foreach($roles as $role)
    <option value="{!! $role['id'] !!}">{!! $role['name'] !!}</option>
    @endforeach
 
</select>

 <!-- Password Field -->
 {!! Form::label('password', 'Password:') !!}
 {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
@endif






<!-- Submit Field -->
<div class="form-group col-sm-12">
    <div class="clearfix"></div>
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

</div>
