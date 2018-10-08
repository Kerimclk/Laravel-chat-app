@extends('layouts.app')

@section('css')
    <style type="text/css">
        .emptyFriends
        {
            color:black;
            text-align: center;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Tanıyor Olabileceğin Kişiler
                </div>

                <div class="card-body">
                    <table cellpadding="10" cellspacing="10">
                    	@forelse($users as $item)
                    		<tr>
                    			<td>{{ $item->name }}</td>
                    			<td><a href="{{ url('friends/add/') }}/{{ $item->id }}" class="btn btn-success btn-sm">Arkadaşı Ekle</a></td>
                            </tr>
                            @empty
                            <div class="emptyFriends">
                                <b>Tanıyor olabileceğiniz kişiler bulumanamadı!</b>
                            </div>
                    	@endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
