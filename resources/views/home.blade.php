@extends('layouts.app')

@section('css')
    <style>
        img.card-img-top{
            width:50px;
            height: 50px;
            margin-left:45px;
            margin-top: 15px;
            margin-bottom: -15px;
            border:6px solid #ddd;
            border-radius: 50%;
            padding: 5px
        }
        img.card-img-top.active{
            border-bottom-color:red;
            border-top-color:blue;
            border-left-color:green;
            border-right-color: orange
        }
        .row.f{
            margin-bottom: 15px
        }
        ul.messages{
            width: 350px
        }
        ul.messages li{
            list-style: none;
            padding:8px;
            background-color: #dedede;
            margin-bottom: 4px;
            border-radius: 4px;
            clear: both;
            float:left;
        }
        ul.messages li.active{
            float:right;
            background-color: #ccc;
        }
        p#error{
            color:#aaa;
            font-size:13px
        }
    </style>
@endsection

@section('content')
<div class="container">
    <!-- Friends List -->
    <div class="row f">
        @foreach($users as $u)
            <div class="col-sm-2">
                    <div class="card" style="width: 9rem; text-align:center">
                      <img class="card-img-top @if($u->id == $receiver) active @else null @endif" style="width:50px;" src="{{asset('default_avatar.png')}}" alt="{{ $u->name }}">
                      <div class="card-body">
                        <h5 class="card-title">{{ $u->name }}</h5>
                        <a href="{{ url('/messages/') }}/{{ $u->id }}" class="btn btn-success btn-sm">Mesaj Gönder</a>
                      </div>
                    </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">
                    Mesajlar
                    <a href="{{ url('/friends') }}" class="btn btn-dark btn-sm" style="float:right">
                        Tanıyor Olabileceğin Kişiler
                    </a>
                </div>

                <div class="card-body">
                    <ul class="messages">

                    </ul>

                   {!! Form::open() !!}
                        {!! Form::textarea('text', '', ['class'=>'form-control','id'=>'message_text','rows'=>3,'placeholder'=>'Mesajını gönderebilmen için ENTER tuşuna basmalısın..']) !!}
                   {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript">
        
        // message send method
        $(document).on('keypress','textarea#message_text',function(e){
            var code = e.keyCode || e.which;
            var text = "";
            var obj = $(this);
            
            if(code==13){
            text = $.trim(obj.val());
            }

            if(text!=""){
            $.ajax({
                type:'POST',
                url:'/message/send',
                data:{
                    '_token': $('input[name=_token]').val(),
                    'text':text,
                    'from':{{ Auth::user()->id }},
                    'receiver':{{ $receiver }}
                },
                success:function(response){
                    if(response.message == 'ok'){
                        obj.val("");
                        AjaxMessageLoad();
                    }else{
                        alert('bir hata oluştu lütfen tekrar deneyiniz.');
                    }
                }
            });
            }  
        });

        // page loading -- messages

        setInterval(function(){ AjaxMessageLoad(); }, 3000);

        $(document).ready(function(){
            AjaxMessageLoad();
        });
      
        function AjaxMessageLoad(){

            var box = $('ul.messages');

            $.ajax({
                type:'POST',
                url:'/message/getMessage', 
                data:{
                    '_token':$('input[name=_token]').val(),
                    'from':{{ Auth::user()->id }},
                    'receiver':{{ $receiver }}
                },      
                success:function(res){

                    box.html("");

                    if(res.data.length > 0){
                        $.each(res.data,function(i,e){
                            if(i%2!=0){
                                box.append('<li class="active">'+e.text+'</li>');
                            }else{
                                box.append('<li>'+e.text+'</li>');
                            }
                            
                        });
                    }else{
                        box.html("<p id='error'>Konuşmaya başlamak için aşağıdaki kutucuğu doldurup mesajını gönder.</p>");
                    }
                    
                }
            });
        }
    </script>    
@endsection
