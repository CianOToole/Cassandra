@extends('layouts.app')

@section('content')

@php

$genders = array("male", "female");

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

<div class="form-holder-alt">
    <div class="form-alt">
        <div class="form-alt-header">
            <h3> Edit my profile </h3>
        </div>

        <div class="form-alt-body">

            <form method="POST" action="{{ route('client.profiles.update', $client[0]->id) }}"  enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_method" value="PUT">
                @csrf

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h5><label for="name">Name</label></h5>
                        <input type="text" class="form-control input-alt @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $client[0]->name) }}" />

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <h5><label for="middle_name">Middle name</label></h5>
                        <input type="text" class="form-control input-alt @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name" value="{{ old('middle_name', $client[0]->middle_name) }}" />

                        @error('middle_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h5><label for="surname">Surname</label></h5>
                        <input type="text" class="form-control input-alt @error('surname') is-invalid @enderror" id="surname" name="surname" value="{{ old('surname', $client[0]->surname) }}" />

                        @error('surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <h5><label for="DOB">Date of birth</label></h5>
                        <input type="text" class="form-control input-alt @error('DOB') is-invalid @enderror" 
                        id="DOB" name="DOB" value="{{ old('DOB', $client[0]->DOB) }}" placeholder="1990-01-01" oninput="formatDOB()"/>

                        @error('DOB')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <h5><label for="address">Address</label></h5>
                    <input type="text" class="form-control input-alt @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $client[0]->address) }}" />

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5><label for="postcode">Postcode</label></h5>
                    <input type="text" class="form-control input-alt @error('postcode') is-invalid @enderror" 
                    id="postcode" name="postcode" value="{{ old('postcode', $client[0]->postcode) }}" />

                    @error('postcode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                                {{-- <label for="">Gender</label>
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
                </div> --}}

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <h5><label for="gender">Gender</label></h5>
                        <select class="custom-select" id="gender" name="gender">
                                @foreach ($genders as $gender)
                                    <option value= "{{$gender}}">{{ $gender}}</option>
                                @endforeach
                        </select>

                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <h5><label for="country">Country</label></h5>
                        <select class="custom-select" id="country" name="country">
                            <option value="{{ old('country', $client[0]->country) }}">{{ old('country', $client[0]->country) }}</option>
                                @foreach ($countries as $country)
                                    <option value= "{{$country}}">
                                    {{ $country}}</option>
                                @endforeach
                        </select>

                        @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <h5><label for="email">Email</label></h5>
                    <input type="email" class="form-control input-alt @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $client[0]->email) }}" />

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5><label for="phone">Phone</label></h5>
                    <input type="tel" class="form-control input-alt @error('phone') is-invalid @enderror" 
                    id="phone" name="phone" value="{{  old('phone', $client[0]->phone) }}" oninput="phoneNumber()" />

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <h5><label for="avatar">Profile picture</label></h5>
                    <input type="file" class="form-control input-alt @error('avatar') is-invalid @enderror" id="avatar" name="avatar" value="{{ old('avatar') }}" />

                    @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="submit-btn">
                    <a href="{{ route('client.profiles.index') }}" class="btn btn-link">Cancel</a>
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>      

            </form>
            
        </div>
    </div>
</div>

<script>
    function formatPostcode(){
        let postcode = document.getElementById('postcode');
        let toUpperCase = postcode.value.toUpperCase();
        postcode.value = toUpperCase;
        (postcode.value.length > 12) ? (postcode.value = postcode.value.slice(0, 12)) : null;
    }
    function formatDOB(){
        let date = document.getElementById('DOB');
        let newFormat= date.value;

        (newFormat.length == 4) ? (date.value = `${newFormat}-`) 
        : (newFormat.length == 7) ? (date.value = `${newFormat}-`) 
        : (newFormat.length > 10) ? (date.value = newFormat.slice(0, 10)) 
        : null;
    }
    function phoneNumber(){
        let input = document.getElementById('phone');
        let phone= input.value;

        (phone.length == 3) ? (input.value = `${phone}-`) 
        : (phone.length == 8) ? (input.value = `${phone}-`) 
        : (phone.length > 11) ? (input.value = phone.slice(0, 12)) 
        : null;
    }
</script>


@endsection
