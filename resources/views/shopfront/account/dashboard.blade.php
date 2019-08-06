@extends('layouts.app')
@section('title', 'My Account')
@section('content')
<div class="container">
   @include('inc.account-menu')
   <div class="tab-content mb-5" id="myTabContent">
      <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            @include('inc.account-profile')
      </div>
      <div class="tab-pane fade" id="alerts" role="tabpanel" aria-labelledby="alerts-tab">
            @include('inc.account-alerts')
      </div>
      {{-- <div class="tab-pane fade" id="lists" role="tabpanel" aria-labelledby="lists-tab">
            @include('inc.account-lists')
      </div> --}}
   </div>
             
</div>


@endsection