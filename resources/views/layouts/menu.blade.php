{{--All users can access--}}
<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.show',['id'=> Auth::user()->id]) !!}"><i class="fa fa-user"></i><span>My Profile</span></a>
</li>

<li class="{{ Request::is('accounts*') ? 'active' : '' }}">
    <a href="{!! route('accounts.show') !!}"><i class="fa fa-list"></i><span>My Account</span></a>
</li>

<li class="{{ Request::is('transactions*') ? 'active' : '' }}">
        <a href="{!! route('transactions.index') !!}"><i class="fa fa-exchange"></i><span>Transactions</span></a>
</li>




{{--Webmasters--}}
@if(Auth::user()->role_id ==3)
<li class="{{ Request::is('qrcodes*') ? 'active' : '' }}">
    <a href="{!! route('qrcodes.index') !!}"><i class="fa fa-qrcode"></i><span>Qrcodes</span></a>
</li>

@endif




{{--Moderators--}}
@if(Auth::user()->role_id <3)
<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-users"></i><span>Users</span></a>
</li>
@endif

{{--Admin--}}
@if(Auth::user()->role_id ==1 )
<li class="{{ Request::is('roles*') ? 'active' : '' }}">
        <a href="{!! route('roles.index') !!}"><i class="fa fa-tasks"></i><span>Roles</span></a>
    </li>

    <li class="{{ Request::is('accounts*') ? 'active' : '' }}">
        <a href="{!! route('accounts.index') !!}"><i class="fa fa-credit-card"></i><span>Accounts</span></a>
    </li>
    
    <li class="{{ Request::is('accountHistories*') ? 'active' : '' }}">
        <a href="{!! route('accountHistories.index') !!}"><i class="fa fa-history"></i><span>Account Histories</span></a>
    </li>
 @endif   




