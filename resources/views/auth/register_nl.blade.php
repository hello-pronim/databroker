@extends('auth.auth_app')

@section('content')
<div class="container-fluid app-wapper bg-pattern-side">
    <div class="container">
        <div class="row justify-content-center auth-section">
            <div class="col-md-8" id="register_nl_section">
                <h1 class="text-primary text-center text-bold">Want to stay up-to-date on the latest Databroker news?</h1>
                <h3 class="text-center text-bold"> Now’s a good time to sign up for our NewsBytes! </h3>
                <br>
                <form method="POST" action="{{ route('auth.create_nl') }}">
                    @csrf                    
                    <p class="text-bold fs-20">
                        Our NewsBytes email brings you a whole host of inspiring content – updates about the Databroker marketplace, company announcements, use cases from our data communities, news from the world of data, and more!  
                        <br> <br>
                        We’d love to know a little more about your interests. <br>
                        Which data communities are most relevant for you?
                    </p>
                    <div class="row mt-30">
                        @foreach ($communities as $community)
                        <div class="col-md-4">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="community[]" value="{{$community['communityIdx']}}">
                                    <p class="text-black">{{$community['communityName']}}</p>
                                    <span class="form-check-sign">
                                        <span class="custom-check check"></span>
                                    </span>                                                        
                                </label>
                            </div>                             
                        </div>    
                        @endforeach
                        <div class="error_notice">Please choose at least one.</div>
                    </div>    
                    <br>                       
                    
                    <div class="form-group row mb-0">                        
                        <div class="col-md-6">                                
                            <button type="submit" class="customize-btn">Sign Up</button>
                        </div>

                        <div class="col-md-6 text-right">                            
                            <a class="btn btn-link text-grey" id="no_thank_link" href="{{ route('login') }}">
                                <i class="material-icons">clear</i>{{ __(' Not right now, thanks') }}
                            </a>                        
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
