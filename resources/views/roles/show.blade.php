@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Role : <b class="text-primary">{!! $role->name !!}</b>
        </h1>
        <h1>
            <a href="{!! route('roles.edit', [$role->id]) !!}" class='btn btn-primary pull-right'>Edit Role</a>
        </h1>
        
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('roles.show_fields')

                </div>
            </div>
        </div>
    </div>
@endsection
