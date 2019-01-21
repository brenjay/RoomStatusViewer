@php

                
@endphp
                

@extends('backpack::layout')

@section('header')
 <script type = "text/javascript" 
         src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>
		
      <script type = "text/javascript" language = "javascript">
         $(document).ready(function() {
            $("#driver").click(function(event){
              $.ajax({
                  method: "GET",
                  url: "/admin/reset",
                })
                  .done(function( msg ) {
                    new PNotify({
                  title: "Operation successful",
                  text: msg,
                  type: "success"
                });
                  });
            });
         });
      </script>
</head>
<body>
    <section class="content-header">
      <h1>
        Actions
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('backpack::base.dashboard') }}</li>
      </ol>
    </section>
@endsection


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-title">Actions</div>
                </div>

                <div class="box-body"><button class="btn btn-primary ladda-button" id="driver">Mark all rooms as unclean/not passing</button>
                <div id="stage"></div>
                </div>
            </div>
        </div>
    </div>

    
    
@endsection
