@extends('layouts.app')
@section('title', 'Test')
@section('content')
<div id = "intro" style = "text-align:center;">
                <h1>@{{ message }}</h1>
             </div>
             <script type = "text/javascript">
                var vue_det = new Vue({
                   el: '#intro',
                   data: {
                      message: 'My first VueJS Task'
                   }
                });
             </script>

@endsection