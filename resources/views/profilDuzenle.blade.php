@extends('layouts.app')

@section('content')	
<div class="container">
	<div class="row justify-content-center">
	    <div class="col-md-8">
	        <div class="card">
	            <div class="card-header">
	                Profil Düzenle
	            </div>

	            <div class="card-body">
	                {!! Form::open() !!}

	                	<input type="hidden" name="id" value="{{ $user_data->id }}">

	                	<div class="form-group">
						    <label for="exampleInputEmail1">Ad Soyad</label>
						    {!! Form::text('name',$user_data->name,['class'=>'form-control','placeholder'=>'Ad Soyad']) !!}
						</div>

						<div class="form-group">
						    <label for="exampleInputEmail1">E-mail</label>
						    {!! Form::text('email',$user_data->email,['class'=>'form-control','placeholder'=>'E-Mail']) !!}
						</div>

						<div class="form-group">
						    <label for="exampleInputEmail1">Telefon</label>
						    {!! Form::text('phone',$user_data->phone,['class'=>'form-control','placeholder'=>'Telefon']) !!}
						</div>

						<div class="form-group">
							{!! Form::submit('Bilgileri Kaydet',array('class'=>'btn btn-success')) !!}
						</div>

	                {!! Form::close() !!}
	            </div>
	        </div>
	    </div>
	</div>
</div>
@endsection