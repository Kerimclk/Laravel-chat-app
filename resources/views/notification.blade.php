@extends('layouts.app')

@section('css')
    <style type="text/css">
        .profile
        {
            border-radius: 50%;
            border: 1px solid #dfdfdf;
            padding: 5px;
            background: #ffffff;
            box-shadow: 0px 1px 2px #efefef;
        }
        .card-body
        .list-group li a
        {
            float: right;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Bildirimler
                </div>

                <div class="card-body">
                	<ul class="list-group">
	                   @foreach($request_senders as $item)
                    	<li class="list-group-item">
                            <img src="{{asset('default_avatar.png')}}" class="profile" width="35">
                    		<b>{{ $item['name'] }}</b> sana arkadaşlık isteği gönderdi.
                    		<a href="{{ url('friends/confirm/') }}/{{ $item['friend_id'] }}" class="btn btn-success btn-sm">Kabul Et</a>
                    	</li>
	                   @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection