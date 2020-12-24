@extends('layouts.app')

@section('content')

@php

$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", 
"Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", 
"Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", 
"Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", 
"Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", 
"Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", 
"Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", 
"East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", 
"Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", 
"Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", 
"Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", 
"Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", 
"Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", 
"Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", 
"Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", 
"Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", 
"Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", 
"Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", 
"Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", 
"Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", 
"Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", 
"Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", 
"South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", 
"Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", 
"Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", 
"Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", 
"United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", 
"Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

@endphp

<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title"> Edit {{ $client[0]->name }} {{ $client[0]->surname }}'s Profile </h3>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('client.profiles.update', $client[0]->id) }}"  enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">

                        <div class="form-group">
                            <label for="avatar">Profile picture</label>                            
                            <div class="">
                                <input type="file" class="form-control" id="avatar" name="avatar" value="" />
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="">{{ __('Name') }}</label>

                            <div class="">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" 
                                value="{{ old('name', $client[0]->name) }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="middle_name" class="">{{ __('Middle Name') }}</label>

                            <div class="">
                                <input id="middle_name" type="text" class="form-control 
                                @error('middle_name') is-invalid @enderror" name="middle_name" 
                                value="{{ old('middle_name', $client[0]->middle_name) }}" required autocomplete="name" autofocus>

                                @error('middle_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="">
                                <label for="surname" class="">{{ __('Surname') }}</label>
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" 
                                value="{{ old('surname', $client[0]->surname) }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="">{{ __('E-Mail Address') }}</label>

                            <div class="">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" 
                                value="{{ old('email', $client[0]->email) }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="phone" class="">{{ __('Phone') }}</label>

                            <div class="">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" 
                                value="{{ old('phone', $client[0]->phone) }}" required autocomplete="phone" placeholder="08x-xxxx-xxx" 
                                pattern="[0-9]{3}-[0-9]{4}-[0-9]{3}"
                                autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>  

                        <div class="form-group">
                            <label for="address" class="">{{ __('Address') }}</label>

                            <div class="">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" 
                                value="{{ old('address', $client[0]->address) }}"" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="postcode" class="">{{ __('Postcode') }}</label>

                            <div class="">
                                <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode" 
                                value="{{ old('postcode', $client[0]->postcode) }}"" required autocomplete="address" autofocus>

                                @error('postcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <label for="">Country</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                            </div>
                            <select class="custom-select" id="country" name="country">
                                <option value="{{ old('title', $client[0]->country) }}">{{ old('title', $client[0]->country) }}</option>
                                    @foreach ($countries as $country)
                                        <option value= "{{$country}}"  >
                                        {{ $country}}</option>
                                    @endforeach
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="DOB" class="">{{ __('Date of Birth') }}</label>

                            <div class="">
                                <input id="DOB" type="date" class="form-control @error('DOB') is-invalid @enderror" name="DOB" 
                                value="{{ old('DOB', $client[0]->DOB) }}"" required autocomplete="DOB" autofocus>

                                @error('DOB')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <label for="">Gender</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input id="gender" type="radio" class="@error('gender') is-invalid @enderror" name="gender" 
                                    value="male" {{ old('gender') }} required autofocus >
                                </div>
                            </div>
                            <input type="text" class="form-control" aria-label="Text input with radio button" placeholder="male">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input id="gender" type="radio" class=" @error('gender') is-invalid @enderror" name="gender" 
                                    value="female" {{ old('gender') }} required autofocus>
                                </div>
                            </div>
                            <input type="text" class="form-control" aria-label="Text input with radio button" placeholder="female">
                        
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="float-right" style="margin-top:16px">
                            <a href="{{ route('client.profiles.index') }}" class="btn btn-link">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right">Submit</button>
                        </div>      

                    </form>

                </div>  
            </div>
        </div>
    </div>
</div>
@endsection
