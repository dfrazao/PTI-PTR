@extends('layouts.app')
@section('content')
<head>
    <title>Profile</title>
</head>
<div class="container-xl mt-4 mb-4">
    @include('layouts.messages')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-1 pl-0 pb-0 pt-0 float-right" style="background-color:white; ">
            <li class="breadcrumb-item " aria-current="page"><a style="color:#2c3fb1;" href={{route('Dashboard')}}>{{__('gx.dashboard')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$user->name}}</li>
        </ol>
    </nav>
    <div class="container">
        <h2>{{__('gx.profile')}}</h2>
        <div class="row">
            <div class="col-xs-12 col-sm-3 center">
                <span class="profile-picture">
                    <img class="profilePhoto editable img-responsive" style="border-radius: 100%; width: 100%; object-fit: cover;" alt=" Avatar" id="avatar2" src="{{Storage::url('profilePhotos/'.$user->photo)}}">
                </span>
                @if(Auth::user()->id != $user->id)
                    <a href="#" class="btn btn-sm btn-block btn-success mt-3">
                        <i class="fas fa-envelope"></i>
                        <span>{{__('gx.send a message')}}</span>
                    </a>
                @elseif(Auth::user()->id == $user->id)
                    <button type="button" class="btn btn-sm btn-block btn-primary mt-3" data-toggle="modal" data-target="#modalPhoto">
                        <i class="fas fa-portrait"></i>
                        <span>{{__('gx.change profile photo')}}</span>
                    </button>

                    <div class="modal fade" id="modalPhoto" style="text-align:left!important;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">{{__('gx.choose a new profile photo')}}</h3>
                                    <button type="button" class="close" data-dismiss="modal">×</button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        @csrf
                                        {!! Form::open(['action' => ['ProfileController@update', $user->id], 'method' => 'POST', 'files' => true]) !!}
                                        <div class="form-group">
                                            {{Form::file('profilePhoto')}}
                                        </div>
                                        {{ Form::hidden('option', "image") }}

                                        {{Form::hidden('_method','PUT')}}
                                        {{Form::submit(trans('gx.submit'), ['class'=>'btn btn-primary'])}}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-xs-12 col-sm-9">
                <h3 class="float-left">
                    <span class="middle">{{ $user->name }}</span>
                </h3>

                <div class="container">

                    @if(Auth::user()->id == $user->id)
                        <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalEdit">{{__('gx.edit profile')}}</button>

                        <!-- The Modal -->
                        <div class="modal fade" id="modalEdit">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h3 class="modal-title">{{__('gx.edit profile')}}</h3>
                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="container">
                                            @csrf
                                            {!! Form::open(['action' => ['ProfileController@update', $user->id], 'method' => 'POST']) !!}
                                            <div class="form-group">
                                                {{Form::label('country', trans('gx.country'))}}
                                                {{Form::select('country', [
                                                    "Afghanistan"=>"Afghanistan",
                                                    "Åland Islands"=>"Åland Islands",
                                                    "Albania"=>"Albania",
                                                    "Algeria"=>"Algeria",
                                                    "American Samoa"=>"American Samoa",
                                                    "Andorra"=>"Andorra",
                                                    "Angola"=>"Angola",
                                                    "Anguilla"=>"Anguilla",
                                                    "Antarctica"=>"Antarctica",
                                                    "Antigua and Barbuda"=>"Antigua and Barbuda",
                                                    "Argentina"=>"Argentina",
                                                    "Armenia"=>"Armenia",
                                                    "Aruba"=>"Aruba",
                                                    "Australia"=>"Australia",
                                                    "Austria"=>"Austria",
                                                    "Azerbaijan"=>"Azerbaijan",
                                                    "Bahamas"=>"Bahamas",
                                                    "Bahrain"=>"Bahrain",
                                                    "Bangladesh"=>"Bangladesh",
                                                    "Barbados"=>"Barbados",
                                                    "Belarus"=>"Belarus",
                                                    "Belgium"=>"Belgium",
                                                    "Belize"=>"Belize",
                                                    "Benin"=>"Benin",
                                                    "Bermuda"=>"Bermuda",
                                                    "Bhutan"=>"Bhutan",
                                                    "Bolivia"=>"Bolivia",
                                                    "Bosnia and Herzegovina"=>"Bosnia and Herzegovina",
                                                    "Botswana"=>"Botswana",
                                                    "Bouvet Island"=>"Bouvet Island",
                                                    "Brazil"=>"Brazil",
                                                    "British Indian Ocean Territory"=>"British Indian Ocean Territory",
                                                    "Brunei Darussalam"=>"Brunei Darussalam",
                                                    "Bulgaria"=>"Bulgaria",
                                                    "Burkina Faso"=>"Burkina Faso",
                                                    "Burundi"=>"Burundi",
                                                    "Cambodia"=>"Cambodia",
                                                    "Cameroon"=>"Cameroon",
                                                    "Canada"=>"Canada",
                                                    "Cape Verde"=>"Cape Verde",
                                                    "Cayman Islands"=>"Cayman Islands",
                                                    "Central African Republic"=>"Central African Republic",
                                                    "Chad"=>"Chad",
                                                    "Chile"=>"Chile",
                                                    "China"=>"China",
                                                    "Christmas Island"=>"Christmas Island",
                                                    "Cocos (Keeling) Islands"=>"Cocos (Keeling) Islands",
                                                    "Colombia"=>"Colombia",
                                                    "Comoros"=>"Comoros",
                                                    "Congo"=>"Congo",
                                                    "Congo, The Democratic Republic of The"=>"Congo, The Democratic Republic of The",
                                                    "Cook Islands"=>"Cook Islands",
                                                    "Costa Rica"=>"Costa Rica",
                                                    "Cote D'ivoire"=>"Cote D'ivoire",
                                                    "Croatia"=>"Croatia",
                                                    "Cuba"=>"Cuba",
                                                    "Cyprus"=>"Cyprus",
                                                    "Czech Republic"=>"Czech Republic",
                                                    "Denmark"=>"Denmark",
                                                    "Djibouti"=>"Djibouti",
                                                    "Dominica"=>"Dominica",
                                                    "Dominican Republic"=>"Dominican Republic",
                                                    "Ecuador"=>"Ecuador",
                                                    "Egypt"=>"Egypt",
                                                    "El Salvador"=>"El Salvador",
                                                    "Equatorial Guinea"=>"Equatorial Guinea",
                                                    "Eritrea"=>"Eritrea",
                                                    "Estonia"=>"Estonia",
                                                    "Ethiopia"=>"Ethiopia",
                                                    "Falkland Islands (Malvinas)"=>"Falkland Islands (Malvinas)",
                                                    "Faroe Islands"=>"Faroe Islands",
                                                    "Fiji"=>"Fiji",
                                                    "Finland"=>"Finland",
                                                    "France"=>"France",
                                                    "French Guiana"=>"French Guiana",
                                                    "French Polynesia"=>"French Polynesia",
                                                    "French Southern Territories"=>"French Southern Territories",
                                                    "Gabon"=>"Gabon",
                                                    "Gambia"=>"Gambia",
                                                    "Georgia"=>"Georgia",
                                                    "Germany"=>"Germany",
                                                    "Ghana"=>"Ghana",
                                                    "Gibraltar"=>"Gibraltar",
                                                    "Greece"=>"Greece",
                                                    "Greenland"=>"Greenland",
                                                    "Grenada"=>"Grenada",
                                                    "Guadeloupe"=>"Guadeloupe",
                                                    "Guam"=>"Guam",
                                                    "Guatemala"=>"Guatemala",
                                                    "Guernsey"=>"Guernsey",
                                                    "Guinea"=>"Guinea",
                                                    "Guinea-bissau"=>"Guinea-bissau",
                                                    "Guyana"=>"Guyana",
                                                    "Haiti"=>"Haiti",
                                                    "Heard Island and Mcdonald Islands"=>"Heard Island and Mcdonald Islands",
                                                    "Holy See (Vatican City State)"=>"Holy See (Vatican City State)",
                                                    "Honduras"=>"Honduras",
                                                    "Hong Kong"=>"Hong Kong",
                                                    "Hungary"=>"Hungary",
                                                    "Iceland"=>"Iceland",
                                                    "India"=>"India",
                                                    "Indonesia"=>"Indonesia",
                                                    "Iran, Islamic Republic of"=>"Iran, Islamic Republic of",
                                                    "Iraq"=>"Iraq",
                                                    "Ireland"=>"Ireland",
                                                    "Isle of Man"=>"Isle of Man",
                                                    "Israel"=>"Israel",
                                                    "Italy"=>"Italy",
                                                    "Jamaica"=>"Jamaica",
                                                    "Japan"=>"Japan",
                                                    "Jersey"=>"Jersey",
                                                    "Jordan"=>"Jordan",
                                                    "Kazakhstan"=>"Kazakhstan",
                                                    "Kenya"=>"Kenya",
                                                    "Kiribati"=>"Kiribati",
                                                    "Korea, Democratic People's Republic of"=>"Korea, Democratic People's Republic of",
                                                    "Korea, Republic of"=>"Korea, Republic of",
                                                    "Kuwait"=>"Kuwait",
                                                    "Kyrgyzstan"=>"Kyrgyzstan",
                                                    "Lao People's Democratic Republic"=>"Lao People's Democratic Republic",
                                                    "Latvia"=>"Latvia",
                                                    "Lebanon"=>"Lebanon",
                                                    "Lesotho"=>"Lesotho",
                                                    "Liberia"=>"Liberia",
                                                    "Libyan Arab Jamahiriya"=>"Libyan Arab Jamahiriya",
                                                    "Liechtenstein"=>"Liechtenstein",
                                                    "Lithuania"=>"Lithuania",
                                                    "Luxembourg"=>"Luxembourg",
                                                    "Macao"=>"Macao",
                                                    "Macedonia, The Former Yugoslav Republic of"=>"Macedonia, The Former Yugoslav Republic of",
                                                    "Madagascar"=>"Madagascar",
                                                    "Malawi"=>"Malawi",
                                                    "Malaysia"=>"Malaysia",
                                                    "Maldives"=>"Maldives",
                                                    "Mali"=>"Mali",
                                                    "Malta"=>"Malta",
                                                    "Marshall Islands"=>"Marshall Islands",
                                                    "Martinique"=>"Martinique",
                                                    "Mauritania"=>"Mauritania",
                                                    "Mauritius"=>"Mauritius",
                                                    "Mayotte"=>"Mayotte",
                                                    "Mexico"=>"Mexico",
                                                    "Micronesia, Federated States of"=>"Micronesia, Federated States of",
                                                    "Moldova, Republic of"=>"Moldova, Republic of",
                                                    "Monaco"=>"Monaco",
                                                    "Mongolia"=>"Mongolia",
                                                    "Montenegro"=>"Montenegro",
                                                    "Montserrat"=>"Montserrat",
                                                    "Morocco"=>"Morocco",
                                                    "Mozambique"=>"Mozambique",
                                                    "Myanmar"=>"Myanmar",
                                                    "Namibia"=>"Namibia",
                                                    "Nauru"=>"Nauru",
                                                    "Nepal"=>"Nepal",
                                                    "Netherlands"=>"Netherlands",
                                                    "Netherlands Antilles"=>"Netherlands Antilles",
                                                    "New Caledonia"=>"New Caledonia",
                                                    "New Zealand"=>"New Zealand",
                                                    "Nicaragua"=>"Nicaragua",
                                                    "Niger"=>"Niger",
                                                    "Nigeria"=>"Nigeria",
                                                    "Niue"=>"Niue",
                                                    "Norfolk Island"=>"Norfolk Island",
                                                    "Northern Mariana Islands"=>"Northern Mariana Islands",
                                                    "Norway"=>"Norway",
                                                    "Oman"=>"Oman",
                                                    "Pakistan"=>"Pakistan",
                                                    "Palau"=>"Palau",
                                                    "Palestinian Territory, Occupied"=>"Palestinian Territory, Occupied",
                                                    "Panama"=>"Panama",
                                                    "Papua New Guinea"=>"Papua New Guinea",
                                                    "Paraguay"=>"Paraguay",
                                                    "Peru"=>"Peru",
                                                    "Philippines"=>"Philippines",
                                                    "Pitcairn"=>"Pitcairn",
                                                    "Poland"=>"Poland",
                                                    "Portugal"=>"Portugal",
                                                    "Puerto Rico"=>"Puerto Rico",
                                                    "Qatar"=>"Qatar",
                                                    "Reunion"=>"Reunion",
                                                    "Romania"=>"Romania",
                                                    "Russian Federation"=>"Russian Federation",
                                                    "Rwanda"=>"Rwanda",
                                                    "Saint Helena"=>"Saint Helena",
                                                    "Saint Kitts and Nevis"=>"Saint Kitts and Nevis",
                                                    "Saint Lucia"=>"Saint Lucia",
                                                    "Saint Pierre and Miquelon"=>"Saint Pierre and Miquelon",
                                                    "Saint Vincent and The Grenadines"=>"Saint Vincent and The Grenadines",
                                                    "Samoa"=>"Samoa",
                                                    "San Marino"=>"San Marino",
                                                    "Sao Tome and Principe"=>"Sao Tome and Principe",
                                                    "Saudi Arabia"=>"Saudi Arabia",
                                                    "Senegal"=>"Senegal",
                                                    "Serbia"=>"Serbia",
                                                    "Seychelles"=>"Seychelles",
                                                    "Sierra Leone"=>"Sierra Leone",
                                                    "Singapore"=>"Singapore",
                                                    "Slovakia"=>"Slovakia",
                                                    "Slovenia"=>"Slovenia",
                                                    "Solomon Islands"=>"Solomon Islands",
                                                    "Somalia"=>"Somalia",
                                                    "South Africa"=>"South Africa",
                                                    "South Georgia and The South Sandwich Islands"=>"South Georgia and The South Sandwich Islands",
                                                    "Spain"=>"Spain",
                                                    "Sri Lanka"=>"Sri Lanka",
                                                    "Sudan"=>"Sudan",
                                                    "Suriname"=>"Suriname",
                                                    "Svalbard and Jan Mayen"=>"Svalbard and Jan Mayen",
                                                    "Swaziland"=>"Swaziland",
                                                    "Sweden"=>"Sweden",
                                                    "Switzerland"=>"Switzerland",
                                                    "Syrian Arab Republic"=>"Syrian Arab Republic",
                                                    "Taiwan, Province of China"=>"Taiwan, Province of China",
                                                    "Tajikistan"=>"Tajikistan",
                                                    "Tanzania, United Republic of"=>"Tanzania, United Republic of",
                                                    "Thailand"=>"Thailand",
                                                    "Timor-leste"=>"Timor-leste",
                                                    "Togo"=>"Togo",
                                                    "Tokelau"=>"Tokelau",
                                                    "Tonga"=>"Tonga",
                                                    "Trinidad and Tobago"=>"Trinidad and Tobago",
                                                    "Tunisia"=>"Tunisia",
                                                    "Turkey"=>"Turkey",
                                                    "Turkmenistan"=>"Turkmenistan",
                                                    "Turks and Caicos Islands"=>"Turks and Caicos Islands",
                                                    "Tuvalu"=>"Tuvalu",
                                                    "Uganda"=>"Uganda",
                                                    "Ukraine"=>"Ukraine",
                                                    "United Arab Emirates"=>"United Arab Emirates",
                                                    "United Kingdom"=>"United Kingdom",
                                                    "United States"=>"United States",
                                                    "United States Minor Outlying Islands"=>"United States Minor Outlying Islands",
                                                    "Uruguay"=>"Uruguay",
                                                    "Uzbekistan"=>"Uzbekistan",
                                                    "Vanuatu"=>"Vanuatu",
                                                    "Venezuela"=>"Venezuela",
                                                    "Viet Nam"=>"Viet Nam",
                                                    "Virgin Islands, British"=>"Virgin Islands, British",
                                                    "Virgin Islands, U.S."=>"Virgin Islands, U.S.",
                                                    "Wallis and Futuna"=>"Wallis and Futuna",
                                                    "Western Sahara"=>"Western Sahara",
                                                    "Yemen"=>"Yemen",
                                                    "Zambia"=>"Zambia",
                                                    "Zimbabwe"=>"Zimbabwe"
], $user->country, ['class' => 'form-control', 'placeholder' => $user->country])}}
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('city', trans('gx.city'))}}
                                                {{Form::text('city', $user->city, ['class' => 'form-control', 'placeholder' => 'City'])}}
                                            </div>
                                            <div class="form-group">
                                                {{Form::label('about', trans('gx.about'))}}
                                                {{Form::textarea('about', $user->description, ['class' => 'form-control', 'placeholder' => 'About'])}}
                                            </div>
                                            {{ Form::hidden('option', "rest") }}

                                            {{Form::hidden('_method','PUT')}}
                                            {{Form::submit(trans('gx.submit'), ['class'=>'btn btn-primary'])}}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

                <div class="profile-user-info">

                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{__('gx.role')}} </div>

                        <div class="profile-info-value">
                            <span>
                                @if($user->role == 'student')
                                    {{__('gx.student')}}
                                @elseif($user->role == 'professor')
                                    {{__('gx.professor')}}
                                @else
                                    {{__('gx.admin')}}
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{__('gx.university')}} </div>

                        <div class="profile-info-value">
                            <span>{{ $universityName }}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{__('gx.course')}} </div>

                        <div class="profile-info-value">
                            <span>{{ $courseName }}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{__('gx.number')}} </div>

                        <div class="profile-info-value">
                            <span>{{ $user->uniNumber }}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div id="city" class="profile-info-name"> {{__('gx.email')}} </div>

                        <div class="profile-info-value">
                            <span>{{ $user->email }}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div id="city" class="profile-info-name"> {{__('gx.country')}} </div>

                        <div class="profile-info-value">
                            <span>{{ $user->country }}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div id="city" class="profile-info-name"> {{__('gx.city')}} </div>

                        <div class="profile-info-value">
                            <span>{{ $user->city }}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{__('gx.joined')}} </div>

                        <div class="profile-info-value">
                            <span>{{ $user->created_at }}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{__('gx.last online')}} </div>

                        <div class="profile-info-value">
                            <span>{{ $user->updated_at }}</span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> {{__('gx.subjects')}} </div>

                        <div class="profile-info-value">
                            @foreach($subjects as $subject)
                                <span>{{ $subject->subjectName }} - {{ $subject->academicYear }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="hr hr-8 dotted"></div>

            </div>
           <!-- /.col -->
        </div><!-- /.row -->

        <div class="space-20"></div>

        <div class="row mt-3">
            <div class="col-xs-12 col-sm-12">
                <div>
                    <h4>{{__('gx.little about me')}}</h4>
                    <div style="max-width: 1140px;white-space: normal;">
                        <span>
                            @if(is_null($user->description) or empty($user->description))
                                @if(Auth::user()->id != $user->id)
                                    {{__('gx.no description others')}}
                                @elseif(Auth::user()->id == $user->id)
                                    {{__('gx.no description yourself')}}
                                @endif
                            @else
                                {{ $user->description }}
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /#home -->
</div>
<style>
    .align-center, .center {
        text-align: center!important;
    }

    .profile-user-info {
        display: table;
        width: 98%;
        width: calc(100% - 24px);
        margin: 0 auto
    }

    .profile-info-row {
        display: table-row
    }

    .profile-info-name,
    .profile-info-value {
        display: table-cell;
        border-top: 1px dotted #D5E4F1
    }

    .profile-info-name {
        text-align: right;
        padding: 6px 10px 6px 4px;
        font-weight: 400;
        color: #667E99;
        background-color: transparent;
        width: 110px;
        vertical-align: middle
    }

    .profile-info-value {
        padding: 6px 4px 6px 6px
    }

    .profile-info-value>span+span:before {
        display: inline;
        content: ",";
        margin-left: 1px;
        margin-right: 3px;
        color: #666;
        border-bottom: 1px solid #FFF
    }

    .profile-info-value>span+span.editable-container:before {
        display: none
    }

    .profile-info-row:first-child .profile-info-name,
    .profile-info-row:first-child .profile-info-value {
        border-top: none
    }

    .profile-user-info-striped {
        border: 1px solid #DCEBF7
    }

    .profile-user-info-striped .profile-info-name {
        color: #336199;
        background-color: #EDF3F4;
        border-top: 1px solid #F7FBFF
    }

    .profile-user-info-striped .profile-info-value {
        border-top: 1px dotted #DCEBF7;
        padding-left: 12px
    }

</style>
<script>
    var cw = $('.profilePhoto').width();
    $('.profilePhoto').css({'height':cw+'px'});
</script>
@endsection
