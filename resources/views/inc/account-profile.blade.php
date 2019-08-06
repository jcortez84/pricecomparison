<h3 class=" h4 text-teal mt-3 text-uppercase">Profile</h3>

<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-1 mb-5">
                <div class="card-body">
                    <form method="POST" action="{{ route('update_profile') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="rounded-0 form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth::user()->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="rounded-0 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="rounded-0 form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" >

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="newsletter" class="col-md-4 col-form-label text-md-right">{{ __('Newsletter') }}</label>

                            <div class="col-md-6">
                                <input id="newsletter" type="checkbox" class="rounded-0 form-control ml-auto" name="newsletter">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alerts" class="col-md-4 col-form-label text-md-right">{{ __('Price Alerts') }}</label>
    
                            <div class="col-md-6">
                                <input id="price_alerts" type="checkbox" class="rounded-0 form-control ml-auto" name="alerts">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-go rounded-0 ">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>