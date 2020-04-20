@extends('layouts.adminbase')
@section('content2')
    @if($data[0]->role == 'admin' || $data[0]->role == 'student' || $data[0]->role == 'professor')

        <!-- Modal - Create -->
        <div class="modal" id="modal-1" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <form action="{{ action('AdminController@store','users')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="table" name="table" value="users">

                            <div class="form-group">
                                <label >uniNumber</label>
                                <input type="text" class="form-control" name="uniNumber" id="uniNumber">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Role</label>
                                <select class="form-control" name="role" id="role">
                                    <option value="admin">Admin</option>
                                    <option value="student">Student</option>
                                    <option value="professor">Professor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >Name</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label >Email address</label>
                                <input type="email" class="form-control" name="email" id="email">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                            </div>
                            <div class="form-group">
                                <label >Password</label>
                                <input type="password" minlength="8" class="form-control" name="password" id="password">
                            </div>
                            <div class="form-group">
                                <label >Country</label>
                                <select id="country" name="country" class="form-control">
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Åland Islands">Åland Islands</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="American Samoa">American Samoa</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Anguilla">Anguilla</option>
                                    <option value="Antarctica">Antarctica</option>
                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Aruba">Aruba</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Bouvet Island">Bouvet Island</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Cape Verde">Cape Verde</option>
                                    <option value="Cayman Islands">Cayman Islands</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Christmas Island">Christmas Island</option>
                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                    <option value="Cook Islands">Cook Islands</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Cote D'ivoire">Cote D'ivoire</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                    <option value="Faroe Islands">Faroe Islands</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="French Guiana">French Guiana</option>
                                    <option value="French Polynesia">French Polynesia</option>
                                    <option value="French Southern Territories">French Southern Territories</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Gibraltar">Gibraltar</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Greenland">Greenland</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guadeloupe">Guadeloupe</option>
                                    <option value="Guam">Guam</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guernsey">Guernsey</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guinea-bissau">Guinea-bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                    <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Isle of Man">Isle of Man</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jersey">Jersey</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                    <option value="Korea, Republic of">Korea, Republic of</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Macao">Macao</option>
                                    <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Martinique">Martinique</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mayotte">Mayotte</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montenegro">Montenegro</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Namibia">Namibia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                                    <option value="New Caledonia">New Caledonia</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Niue">Niue</option>
                                    <option value="Norfolk Island">Norfolk Island</option>
                                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Pitcairn">Pitcairn</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Puerto Rico">Puerto Rico</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Reunion">Reunion</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russian Federation">Russian Federation</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="Saint Helena">Saint Helena</option>
                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                    <option value="Saint Lucia">Saint Lucia</option>
                                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                    <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serbia">Serbia</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                    <option value="Swaziland">Swaziland</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                    <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Timor-leste">Timor-leste</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tokelau">Tokelau</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                    <option value="Uruguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Viet Nam">Viet Nam</option>
                                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                                    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                                    <option value="Western Sahara">Western Sahara</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label >City</label>
                                <input type="text" class="form-control" name="city" id="city">
                            </div>
                            <button type="submit" class="btn btn-success">Create</button>
                            <button href="/tables" type="submit" class="btn btn-danger" style="float: right">Cancel</button>
                        </form>


                    </div>

                </div>
            </div>
        </div>

        <!-- Modal - Import Data -->
        <div class="modal" id="modal-2" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Import Students Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ action('AdminController@import','users')}}" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="table" name="table" value="users">

                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="file" name="upload-file" class="form-control-file">
                            </div>
                            <input class="btn btn-success" type="submit" value="Upload .csv File" name="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal - Edit Data -->
        <div class="modal" id="modal-edit-user" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Import Students Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{{action('AdminController@update',['files' => true])}}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('PUT')}}
                        <input type="hidden" id="table" name="table" value="users">
                        <div class="form-row">
                            <div class="col">
                            <label >uniNumber</label>
                            <input required="required" type="text" class="form-control" id="uniNumber" name="uniNumber" value="">
                            </div>
                            <div class="col">
                            <label for="exampleFormControlSelect1">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="admin">Admin</option>
                                <option value="student">Student</option>
                                <option value="professor">Professor</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label >Name</label>
                            <input type="text" required="required" class="form-control" id="name" name="name" value="">
                        </div>
                        <div class="form-group">
                            <label >Email address</label>
                            <input type="email" class="form-control" required="required" id="email" name="email" value="">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label >Password</label>
                            <input required="required" type="password" minlength="8" class="form-control" id="password" name="password" value="">
                        </div>
                        <div class="form-group">
                            <label >Photo</label>
                            <input type="file" class="form-control-file" id="profilePhoto" name="profilePhoto">
                        </div>
                        <div class="form-group">
                            <label >Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="">
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label >Country</label>
                                <select id="country" name="country" value="" class="form-control">
                                    <option value="Afghanistan">Afghanistan</option>
                                    <option value="Åland Islands">Åland Islands</option>
                                    <option value="Albania">Albania</option>
                                    <option value="Algeria">Algeria</option>
                                    <option value="American Samoa">American Samoa</option>
                                    <option value="Andorra">Andorra</option>
                                    <option value="Angola">Angola</option>
                                    <option value="Anguilla">Anguilla</option>
                                    <option value="Antarctica">Antarctica</option>
                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                    <option value="Argentina">Argentina</option>
                                    <option value="Armenia">Armenia</option>
                                    <option value="Aruba">Aruba</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Austria">Austria</option>
                                    <option value="Azerbaijan">Azerbaijan</option>
                                    <option value="Bahamas">Bahamas</option>
                                    <option value="Bahrain">Bahrain</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Barbados">Barbados</option>
                                    <option value="Belarus">Belarus</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Belize">Belize</option>
                                    <option value="Benin">Benin</option>
                                    <option value="Bermuda">Bermuda</option>
                                    <option value="Bhutan">Bhutan</option>
                                    <option value="Bolivia">Bolivia</option>
                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                    <option value="Botswana">Botswana</option>
                                    <option value="Bouvet Island">Bouvet Island</option>
                                    <option value="Brazil">Brazil</option>
                                    <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                    <option value="Brunei Darussalam">Brunei Darussalam</option>
                                    <option value="Bulgaria">Bulgaria</option>
                                    <option value="Burkina Faso">Burkina Faso</option>
                                    <option value="Burundi">Burundi</option>
                                    <option value="Cambodia">Cambodia</option>
                                    <option value="Cameroon">Cameroon</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Cape Verde">Cape Verde</option>
                                    <option value="Cayman Islands">Cayman Islands</option>
                                    <option value="Central African Republic">Central African Republic</option>
                                    <option value="Chad">Chad</option>
                                    <option value="Chile">Chile</option>
                                    <option value="China">China</option>
                                    <option value="Christmas Island">Christmas Island</option>
                                    <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                    <option value="Colombia">Colombia</option>
                                    <option value="Comoros">Comoros</option>
                                    <option value="Congo">Congo</option>
                                    <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                    <option value="Cook Islands">Cook Islands</option>
                                    <option value="Costa Rica">Costa Rica</option>
                                    <option value="Cote D'ivoire">Cote D'ivoire</option>
                                    <option value="Croatia">Croatia</option>
                                    <option value="Cuba">Cuba</option>
                                    <option value="Cyprus">Cyprus</option>
                                    <option value="Czech Republic">Czech Republic</option>
                                    <option value="Denmark">Denmark</option>
                                    <option value="Djibouti">Djibouti</option>
                                    <option value="Dominica">Dominica</option>
                                    <option value="Dominican Republic">Dominican Republic</option>
                                    <option value="Ecuador">Ecuador</option>
                                    <option value="Egypt">Egypt</option>
                                    <option value="El Salvador">El Salvador</option>
                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                    <option value="Eritrea">Eritrea</option>
                                    <option value="Estonia">Estonia</option>
                                    <option value="Ethiopia">Ethiopia</option>
                                    <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                    <option value="Faroe Islands">Faroe Islands</option>
                                    <option value="Fiji">Fiji</option>
                                    <option value="Finland">Finland</option>
                                    <option value="France">France</option>
                                    <option value="French Guiana">French Guiana</option>
                                    <option value="French Polynesia">French Polynesia</option>
                                    <option value="French Southern Territories">French Southern Territories</option>
                                    <option value="Gabon">Gabon</option>
                                    <option value="Gambia">Gambia</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Germany">Germany</option>
                                    <option value="Ghana">Ghana</option>
                                    <option value="Gibraltar">Gibraltar</option>
                                    <option value="Greece">Greece</option>
                                    <option value="Greenland">Greenland</option>
                                    <option value="Grenada">Grenada</option>
                                    <option value="Guadeloupe">Guadeloupe</option>
                                    <option value="Guam">Guam</option>
                                    <option value="Guatemala">Guatemala</option>
                                    <option value="Guernsey">Guernsey</option>
                                    <option value="Guinea">Guinea</option>
                                    <option value="Guinea-bissau">Guinea-bissau</option>
                                    <option value="Guyana">Guyana</option>
                                    <option value="Haiti">Haiti</option>
                                    <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                    <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                    <option value="Honduras">Honduras</option>
                                    <option value="Hong Kong">Hong Kong</option>
                                    <option value="Hungary">Hungary</option>
                                    <option value="Iceland">Iceland</option>
                                    <option value="India">India</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                    <option value="Iraq">Iraq</option>
                                    <option value="Ireland">Ireland</option>
                                    <option value="Isle of Man">Isle of Man</option>
                                    <option value="Israel">Israel</option>
                                    <option value="Italy">Italy</option>
                                    <option value="Jamaica">Jamaica</option>
                                    <option value="Japan">Japan</option>
                                    <option value="Jersey">Jersey</option>
                                    <option value="Jordan">Jordan</option>
                                    <option value="Kazakhstan">Kazakhstan</option>
                                    <option value="Kenya">Kenya</option>
                                    <option value="Kiribati">Kiribati</option>
                                    <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                    <option value="Korea, Republic of">Korea, Republic of</option>
                                    <option value="Kuwait">Kuwait</option>
                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                    <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                    <option value="Latvia">Latvia</option>
                                    <option value="Lebanon">Lebanon</option>
                                    <option value="Lesotho">Lesotho</option>
                                    <option value="Liberia">Liberia</option>
                                    <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                    <option value="Liechtenstein">Liechtenstein</option>
                                    <option value="Lithuania">Lithuania</option>
                                    <option value="Luxembourg">Luxembourg</option>
                                    <option value="Macao">Macao</option>
                                    <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                    <option value="Madagascar">Madagascar</option>
                                    <option value="Malawi">Malawi</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Maldives">Maldives</option>
                                    <option value="Mali">Mali</option>
                                    <option value="Malta">Malta</option>
                                    <option value="Marshall Islands">Marshall Islands</option>
                                    <option value="Martinique">Martinique</option>
                                    <option value="Mauritania">Mauritania</option>
                                    <option value="Mauritius">Mauritius</option>
                                    <option value="Mayotte">Mayotte</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                    <option value="Moldova, Republic of">Moldova, Republic of</option>
                                    <option value="Monaco">Monaco</option>
                                    <option value="Mongolia">Mongolia</option>
                                    <option value="Montenegro">Montenegro</option>
                                    <option value="Montserrat">Montserrat</option>
                                    <option value="Morocco">Morocco</option>
                                    <option value="Mozambique">Mozambique</option>
                                    <option value="Myanmar">Myanmar</option>
                                    <option value="Namibia">Namibia</option>
                                    <option value="Nauru">Nauru</option>
                                    <option value="Nepal">Nepal</option>
                                    <option value="Netherlands">Netherlands</option>
                                    <option value="Netherlands Antilles">Netherlands Antilles</option>
                                    <option value="New Caledonia">New Caledonia</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Nicaragua">Nicaragua</option>
                                    <option value="Niger">Niger</option>
                                    <option value="Nigeria">Nigeria</option>
                                    <option value="Niue">Niue</option>
                                    <option value="Norfolk Island">Norfolk Island</option>
                                    <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                    <option value="Norway">Norway</option>
                                    <option value="Oman">Oman</option>
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="Palau">Palau</option>
                                    <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                    <option value="Panama">Panama</option>
                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                    <option value="Paraguay">Paraguay</option>
                                    <option value="Peru">Peru</option>
                                    <option value="Philippines">Philippines</option>
                                    <option value="Pitcairn">Pitcairn</option>
                                    <option value="Poland">Poland</option>
                                    <option value="Portugal">Portugal</option>
                                    <option value="Puerto Rico">Puerto Rico</option>
                                    <option value="Qatar">Qatar</option>
                                    <option value="Reunion">Reunion</option>
                                    <option value="Romania">Romania</option>
                                    <option value="Russian Federation">Russian Federation</option>
                                    <option value="Rwanda">Rwanda</option>
                                    <option value="Saint Helena">Saint Helena</option>
                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                    <option value="Saint Lucia">Saint Lucia</option>
                                    <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                    <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                    <option value="Samoa">Samoa</option>
                                    <option value="San Marino">San Marino</option>
                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                    <option value="Senegal">Senegal</option>
                                    <option value="Serbia">Serbia</option>
                                    <option value="Seychelles">Seychelles</option>
                                    <option value="Sierra Leone">Sierra Leone</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Slovakia">Slovakia</option>
                                    <option value="Slovenia">Slovenia</option>
                                    <option value="Solomon Islands">Solomon Islands</option>
                                    <option value="Somalia">Somalia</option>
                                    <option value="South Africa">South Africa</option>
                                    <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                    <option value="Spain">Spain</option>
                                    <option value="Sri Lanka">Sri Lanka</option>
                                    <option value="Sudan">Sudan</option>
                                    <option value="Suriname">Suriname</option>
                                    <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                    <option value="Swaziland">Swaziland</option>
                                    <option value="Sweden">Sweden</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                    <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                    <option value="Tajikistan">Tajikistan</option>
                                    <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                    <option value="Thailand">Thailand</option>
                                    <option value="Timor-leste">Timor-leste</option>
                                    <option value="Togo">Togo</option>
                                    <option value="Tokelau">Tokelau</option>
                                    <option value="Tonga">Tonga</option>
                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                    <option value="Tunisia">Tunisia</option>
                                    <option value="Turkey">Turkey</option>
                                    <option value="Turkmenistan">Turkmenistan</option>
                                    <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                    <option value="Tuvalu">Tuvalu</option>
                                    <option value="Uganda">Uganda</option>
                                    <option value="Ukraine">Ukraine</option>
                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="United States">United States</option>
                                    <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                    <option value="Uruguay">Uruguay</option>
                                    <option value="Uzbekistan">Uzbekistan</option>
                                    <option value="Vanuatu">Vanuatu</option>
                                    <option value="Venezuela">Venezuela</option>
                                    <option value="Viet Nam">Viet Nam</option>
                                    <option value="Virgin Islands, British">Virgin Islands, British</option>
                                    <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                    <option value="Wallis and Futuna">Wallis and Futuna</option>
                                    <option value="Western Sahara">Western Sahara</option>
                                    <option value="Yemen">Yemen</option>
                                    <option value="Zambia">Zambia</option>
                                    <option value="Zimbabwe">Zimbabwe</option>
                                </select>
                            </div>
                            <div class="col">
                            <label >City</label>
                            <input type="text" class="form-control" id="city" name="city" value="">
                            </div>
                        </div>
                        <input type="hidden" id="idUser" name="idUser" value="">
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-outline-success" >Update</button>
                            <button style="float: right" data-dismiss="modal" aria-label="Close" type="button" class="btn btn-outline-danger">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal - Delete -->
        <div class="modal" id="modal-delete-user" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{action('AdminController@destroy',['table' => 'users'])}}" method="POST">
                            {{method_field('DELETE')}}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <p>Are you sure you want to delete this user?</p>
                                <span id="uniNumber"></span><span>    </span><span id="nameUser"></span>
                                <input type="hidden" id="id" name="id">
                            </div>
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <button data-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary" style="float: right">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div class="container-xl" style="max-width: 100%; margin-bottom: 5%;">
            <!-- Search form -->
            <div style="margin-top: 1%;margin-bottom: 3%;">
                <h3>Users</h3>
            </div>

            <div class="content" style="">
                <div class="row">
                    <div class="col-xl-12">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-1"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
                                <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-2"><i class="fa fa-upload" aria-hidden="true"></i> Import</button>
                            </div>

                            <div class="card-body" >
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover">
                                        <thead class=" text-primary">
                                        <tr>

                                            <th scope="col" >
                                                ID
                                            </th>
                                            <th scope="col">
                                                uniNumber
                                            </th>
                                            <th scope="col">
                                                Role
                                            </th>
                                            <th scope="col">
                                                Name
                                            </th>
                                            <th scope="col">
                                                Email
                                            </th>
                                            <th scope="col" >
                                                Photo
                                            </th>
                                            <th scope="col" >
                                                Country
                                            </th>
                                            <th scope="col" >
                                                City
                                            </th>
                                            <th scope="col" >
                                                Description
                                            </th>
                                            <th scope="col" >
                                                Tools
                                            </th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        @foreach($data as $user)
                                            <tr>
                                                <td>
                                                    {{$user->id}}
                                                </td>
                                                <td>
                                                    {{$user->uniNumber}}
                                                </td>
                                                <td>
                                                    {{$user->role}}
                                                </td>
                                                <td>
                                                    {{$user->name}}
                                                </td>
                                                <td>
                                                    {{$user->email}}
                                                </td>
                                                <td>
                                                    <span class="profile-picture">
                                                        <img class="editable img-responsive " alt=" Avatar" id="avatar2" style="height: 50px;border-radius: 100%;  width: 50px; object-fit: cover;" src="/storage/profilePhotos/{{ $user->photo }}">
                                                    </span>
                                                </td>
                                                <td>
                                                    {{$user->country}}
                                                </td>
                                                <td>
                                                    {{$user->city}}
                                                </td>
                                                <td>
                                                    {{$user->description}}
                                                </td>
                                                <td class="text-right">

                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fal fa-tools"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <button  data-id="{{$user->id}}" data-uninumber="{{$user->uniNumber}}" data-role="{{$user->role}}" data-name="{{$user->name}}" data-email="{{$user->email}}" data-password="{{$user->password}}" data-photo="{{$user->photo}}" data-description="{{$user->description}}" data-country="{{$user->country}}" data-city="{{$user->city}}"class="dropdown-item editbtn" data-toggle="modal" data-target="#modal-edit-user" id="edit" type="submit" ><i class="fa fa-edit" aria-hidden="true"></i> Edit</button>
                                                            <button class="dropdown-item" data-id="{{$user->id}}" data-name="{{$user->name}}" data-uninumber="{{$user->uniNumber}}" data-toggle="modal" data-target="#modal-delete-user" style="float: right;margin-right:1%;display: inline-block;" ><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>(function( $ ) {
                    $(function() {

                        $('#modal-edit-user').on('show.bs.modal', function (event) {
                            var button = $(event.relatedTarget)
                            var idUser = button.data('id')
                            var uniN = button.data('uninumber')
                            var role = button.data('role')
                            var name = button.data('name')
                            var email = button.data('email')
                            var password = button.data('password')
                            var photo = button.data('photo')
                            var description = button.data('description')
                            var country = button.data('country')
                            var city = button.data('city')

                            var modal = $(this)

                            modal.find('.modal-body #idUser').val(idUser)
                            modal.find('.modal-body #uniNumber').val(uniN)
                            modal.find('.modal-body #role').val(role)
                            modal.find('.modal-body #name').val(name)
                            modal.find('.modal-body #email').val(email)
                            modal.find('.modal-body #password').val(password)
                            //modal.find('.modal-body #photo').val(photo)
                            modal.find('.modal-body #description').val(description)
                            modal.find('.modal-body #country').val(country)
                            modal.find('.modal-body #city').val(city)
                        })

                        $('#modal-delete-user').on('show.bs.modal', function (event) {
                            var button = $(event.relatedTarget)
                            var idUser = button.data('id')
                            var name = button.data('name')
                            var uniN = button.data('uninumber')
                            var modal = $(this)

                            modal.find('.modal-body #id').val(idUser)
                            modal.find('.modal-body #nameUser').text(name)
                            modal.find('.modal-body #uniNumber').text(uniN)

                        })


                    })})(jQuery);

            </script>

    @elseif($data[0]->idGeneralSubject >0 )

        <!-- Modal - Create -->
        <div class="modal" id="modal-1" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Create</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">


                        <form action="{{ action('AdminController@store','subjects')}}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="table" name="table" value="subjects">

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">General Subject</label>
                                <select class="form-control" name="idGenSubject" id="idGenSubject">
                                    @foreach($general_subjects as $gsubject)

                                        <option value="{{$gsubject->idGeneralSubject}}">{{$gsubject->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label>Subject Name</label>
                                <input type="text" class="form-control" name="subjectName" id="subjectName">
                            </div>
                            <div class="form-group">
                                <label>Class</label>
                                <input type="text" class="form-control" name="class" id="class">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Academic Year</label>
                                <select class="form-control" name="academicYear" id="academicYear">
                                    @foreach($academicYears as $year)

                                    <option value="{{$year->academicYear}}">{{$year->academicYear}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <input type="hidden" id="table" name="table" value="subjects">

                            <button type="submit" class="btn btn-success">Create</button>
                            <button href="/admin/subjects" type="submit" class="btn btn-danger" style="float: right">Cancel</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>



            <!-- Modal - Import Data -->
            <div class="modal" id="modal-2" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Import Subjects Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ action('AdminController@import','subjects')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input type="file" name="upload-file" class="form-control-file">
                                </div>
                                <input class="btn btn-success" type="submit" value="Upload .csv File" name="submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal - Edit Data -->
            <div class="modal" id="modal-edit-subjects" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Subject</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{action('AdminController@update')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{method_field('PUT')}}
                                <input type="hidden" id="table" name="table" value="subjects">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">General Subject</label>
                                    <select class="form-control" name="idGenSubject" id="idGenSubject">
                                        @foreach($general_subjects as $gsubject)

                                            <option value="{{$gsubject->idGeneralSubject}}">{{$gsubject->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Subject Name</label>
                                    <input type="text" class="form-control" name="subname" id="subname">
                                </div>
                                <div class="form-group">
                                    <label>Class</label>
                                    <input type="text" class="form-control" name="classes" id="classes">
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Academic Year</label>
                                    <select class="form-control" name="academicYear" id="academicYear">
                                        @foreach($academicYears as $year)

                                            <option value="{{$year->academicYear}}">{{$year->academicYear}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                    <input type="hidden" id="idSub" name="idSub">
                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-outline-success" >Update</button>
                                        <button style="float: right" data-dismiss="modal" aria-label="Close" type="button" class="btn btn-outline-danger">Cancel</button>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal - Delete -->
            <div class="modal" id="modal-delete-subject" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{action('AdminController@destroy',['table' => 'subjects'])}}" method="POST">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <p>Are you sure you want to delete this subject?</p>
                                    <span id="subname"></span>
                                    <input type="hidden" id="id" name="id">
                                </div>
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <button data-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary" style="float: right">Cancel</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-xl" style="max-width: 100%; margin-bottom: 5%;">
                <!-- Search form -->
                <div style="margin-top: 1%;margin-bottom: 3%;">
                    <h3>Subjects</h3>
                </div>

            <div class="content" style="">
                <div class="row">
                    <div class="col-xl-12">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-1"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
                                <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-2"><i class="fa fa-upload" aria-hidden="true"></i> Import</button>
                            </div>

                            <div class="card-body" >
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-hover">
                                        <thead class=" text-primary">
                                        <tr>
                                            <th scope="col" >
                                                idSubject
                                            </th>
                                            <th scope="col" >
                                                idGeneralSubject
                                            </th>
                                            <th scope="col">
                                                Subject Name
                                            </th>
                                            <th scope="col">
                                                Class
                                            </th>
                                            <th scope="col" >
                                                Academic Year
                                            </th>
                                            <th scope="col" class="text-right">
                                                Tools
                                            </th>
                                        </tr>

                                        </thead>
                                        <tbody>
                                        @foreach($data as $subjects)
                                            <tr>
                                                <td>
                                                    {{$subjects->idSubject}}
                                                </td>
                                                <td>
                                                    {{$subjects->idGeneralSubject}}
                                                </td>
                                                <td>
                                                    {{$subjects->subjectName}}
                                                </td>
                                                <td>
                                                    {{$subjects->class}}
                                                </td>
                                                <td>
                                                    {{$subjects->academicYear}}
                                                </td>
                                                <td class="text-right">
                                                    <div class="dropdown">
                                                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fal fa-tools"></i>
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <button  data-id="{{$subjects->idSubject}}" data-gensub="{{$subjects->idGeneralSubject}}" data-subname="{{$subjects->subjectName}}" data-classes="{{$subjects->class}}" data-year="{{$subjects->academicYear}}" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-subjects" id="edit" type="submit" ><i class="fa fa-edit" aria-hidden="true"></i> Edit</button>
                                                            <button class="dropdown-item" data-id="{{$subjects->idSubject}}" data-subname="{{$subjects->subjectName}}" data-toggle="modal" data-target="#modal-delete-subject" style="float: right;margin-right:1%;display: inline-block;" ><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <script>(function( $ ) {
                        $(function() {

                            $('#modal-edit-subjects').on('show.bs.modal', function (event) {
                                var button = $(event.relatedTarget)
                                var idSub = button.data('id')
                                var idGenSub = button.data('gensub')
                                var subname = button.data('subname')
                                var classes = button.data('classes')
                                var year = button.data('year')


                                var modal = $(this)

                                modal.find('.modal-body #idSub').val(idSub)
                                modal.find('.modal-body #idGenSubject').val(idGenSub)
                                modal.find('.modal-body #subname').val(subname)
                                modal.find('.modal-body #classes').val(classes)
                                modal.find('.modal-body #year').val(year)
                            })

                            $('#modal-delete-subject').on('show.bs.modal', function (event) {
                                var button = $(event.relatedTarget)
                                var idSub = button.data('id')
                                var subname = button.data('subname')
                                var modal = $(this)

                                modal.find('.modal-body #id').val(idSub)
                                modal.find('.modal-body #subname').text(subname)

                            })



                        })})(jQuery);

                </script>


                    @elseif($data[0]->idCourse == 1)

                        <!-- Modal - Create -->
                            <div class="modal" id="modal-1" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Create</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">


                                            <form action="{{ action('AdminController@store','courses')}}" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" id="table" name="table" value="courses">

                                                <div class="form-group">
                                                    <label>Course Name</label>
                                                    <input type="text" class="form-control" name="coursename" id="coursename">
                                                </div>

                                                <div class="form-group">
                                                    <label for="exampleFormControlSelect1">University</label>
                                                    <select class="form-control" name="idUniv" id="idUniv">
                                                        @foreach($universities as $univ)
                                                        <option value="{{$univ->idUniversity}}">{{$univ->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <button type="submit" class="btn btn-success">Create</button>
                                                <button data-dismiss="modal" aria-label="Close" type="button" class="btn btn-danger" style="float: right">Cancel</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>



                            <!-- Modal - Import Data -->
                            <div class="modal" id="modal-2" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Import Courses Data</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ action('AdminController@import','courses')}}" method="post" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <input type="file" name="upload-file" class="form-control-file">
                                                </div>
                                                <input class="btn btn-success" type="submit" value="Upload .csv File" name="submit">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal - Edit Data -->
                            <div class="modal" id="modal-edit-courses" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Subject</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{action('AdminController@update')}}" method="POST" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                {{method_field('PUT')}}
                                                <input type="hidden" id="table" name="table" value="courses">
                                                <div class="form-group">
                                                    <label>Course Name</label>
                                                    <input type="text" class="form-control" name="coursename" id="coursename">
                                                </div>
                                                <input type="hidden" id="id" name="id">
                                                <div class="modal-footer">

                                                    <button type="submit" class="btn btn-outline-success" >Update</button>
                                                    <button style="float: right" data-dismiss="modal" aria-label="Close" type="button" class="btn btn-outline-danger">Cancel</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal - Delete -->
                            <div class="modal" id="modal-delete-courses" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{action('AdminController@destroy',['table' => 'courses'])}}" method="POST">
                                                {{method_field('DELETE')}}
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <p>Are you sure you want to delete this subject?</p>
                                                    <span id="coursename"></span>
                                                    <input type="hidden" id="id" name="id">
                                                </div>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                <button data-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary" style="float: right">Cancel</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="container-xl" style="max-width: 100%; margin-bottom: 5%;">
                                <!-- Search form -->
                                <div style="margin-top: 1%;margin-bottom: 3%;">
                                    <h3>Courses</h3>
                                </div>

                                <div class="content" style="">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            @if (session('success'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('success') }}
                                                </div>
                                            @endif
                                            <div class="card">
                                                <div class="card-header">
                                                    <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-1"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
                                                    <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-2"><i class="fa fa-upload" aria-hidden="true"></i> Import</button>
                                                </div>

                                                <div class="card-body" >
                                                    <div class="table-responsive">
                                                        <table id="datatable" class="table table-hover">
                                                            <thead class=" text-primary">
                                                            <tr>
                                                                <th scope="col" >
                                                                    idCourses
                                                                </th>
                                                                <th scope="col" >
                                                                    Name
                                                                </th>
                                                                <th scope="col" >
                                                                    idUniversity
                                                                </th>
                                                                <th scope="col" class="text-right">
                                                                    Tools
                                                                </th>
                                                            </tr>

                                                            </thead>
                                                            <tbody>
                                                            @foreach($data as $courses)
                                                                <tr>
                                                                    <td>
                                                                        {{$courses->idCourse}}
                                                                    </td>
                                                                    <td>
                                                                        {{$courses->name}}
                                                                    </td>
                                                                    <td>
                                                                        {{$courses->idUniversity}}
                                                                    </td>
                                                                    <td class="text-right">
                                                                        <div class="dropdown">
                                                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="fal fa-tools"></i>
                                                                            </button>
                                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                                <button data-id="{{$courses->idCourse}}" data-coursename="{{$courses->name}}" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-courses" id="edit" type="submit" ><i class="fa fa-edit" aria-hidden="true"></i> Edit</button>
                                                                                <button data-id="{{$courses->idCourse}}" data-coursename="{{$courses->name}}" class="dropdown-item" data-toggle="modal" data-target="#modal-delete-courses" style="float: right;margin-right:1%;display: inline-block;" ><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>(function( $ ) {
                                        $(function() {

                                            $('#modal-edit-courses').on('show.bs.modal', function (event) {
                                                var button = $(event.relatedTarget)
                                                var idCourses = button.data('id')
                                                var coursename = button.data('coursename')
                                                var modal = $(this)

                                                modal.find('.modal-body #id').val(idCourses)
                                                modal.find('.modal-body #coursename').val(coursename)
                                            })

                                            $('#modal-delete-courses').on('show.bs.modal', function (event) {
                                                var button = $(event.relatedTarget)
                                                var idCourses = button.data('id')
                                                var coursename = button.data('coursename')
                                                var modal = $(this)

                                                modal.find('.modal-body #id').val(idCourses)
                                                modal.find('.modal-body #coursename').text(coursename)

                                            })



                                        })})(jQuery);

                                </script>

                            @elseif($data[0]->idUniversity > 0)

                                <!-- Modal - Create -->
                                    <div class="modal" id="modal-1" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Create</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ action('AdminController@store','universities')}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" id="table" name="table" value="universities">
                                                        <div class="form-group">
                                                            <label>University Name</label>
                                                            <input type="text" class="form-control" name="univName" id="univName">
                                                        </div>
                                                        <button type="submit" class="btn btn-success">Create</button>
                                                        <button href="/admin/subjects" type="submit" class="btn btn-danger" style="float: right">Cancel</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <!-- Modal - Import Data -->
                                    <div class="modal" id="modal-2" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Import Subjects Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ action('AdminController@import','universities')}}" method="post" enctype="multipart/form-data">
                                                        {{csrf_field()}}
                                                        <div class="form-group">
                                                            <input type="file" name="upload-file" class="form-control-file">
                                                        </div>
                                                        <input class="btn btn-success" type="submit" value="Upload .csv File" name="submit">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal - Edit Data -->
                                    <div class="modal" id="modal-edit-univ" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Subject</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{action('AdminController@update')}}" method="POST" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        {{method_field('PUT')}}
                                                        <input type="hidden" id="table" name="table" value="universities">
                                                        <div class="form-group">
                                                            <label>University Name</label>
                                                            <input type="text" class="form-control" name="univName" id="univName">
                                                        </div>
                                                        <input type="hidden" id="idUniv" name="idUniv">

                                                        <div class="modal-footer">

                                                            <button type="submit" class="btn btn-outline-success" >Update</button>
                                                            <button style="float: right" data-dismiss="modal" aria-label="Close" type="button" class="btn btn-outline-danger">Cancel</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal - Delete -->
                                    <div class="modal" id="modal-delete-univ" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{action('AdminController@destroy',['table' => 'universities'])}}" method="POST">
                                                        {{method_field('DELETE')}}
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <p>Are you sure you want to delete this subject?</p>
                                                            <span id="univname"></span>
                                                            <input type="hidden" id="id" name="id">
                                                        </div>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                        <button data-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary" style="float: right">Cancel</button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="container-xl" style="max-width: 100%; margin-bottom: 5%;">
                                        <!-- Search form -->
                                        <div style="margin-top: 1%;margin-bottom: 3%;">
                                            <h3>University</h3>
                                        </div>

                                        <div class="content" style="">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    @if (session('success'))
                                                        <div class="alert alert-success" role="alert">
                                                            {{ session('success') }}
                                                        </div>
                                                    @endif
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-1"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
                                                            <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-2"><i class="fa fa-upload" aria-hidden="true"></i> Import</button>
                                                        </div>

                                                        <div class="card-body" >
                                                            <div class="table-responsive">
                                                                <table id="datatable" class="table table-hover">
                                                                    <thead class=" text-primary">
                                                                    <tr>
                                                                        <th scope="col" >
                                                                            idUniversity
                                                                        </th>
                                                                        <th scope="col" >
                                                                            Name
                                                                        </th>
                                                                        <th scope="col" class="text-right">
                                                                            Tools
                                                                        </th>
                                                                    </tr>

                                                                    </thead>
                                                                    <tbody>
                                                                    @foreach($data as $univ)
                                                                        <tr>
                                                                            <td>
                                                                                {{$univ->idUniversity}}
                                                                            </td>
                                                                            <td>
                                                                                {{$univ->name}}
                                                                            </td>
                                                                            <td class="text-right">
                                                                                <div class="dropdown">
                                                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                        <i class="fal fa-tools"></i>
                                                                                    </button>
                                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                                        <button data-id="{{$univ->idUniversity}}" data-univname="{{$univ->name}}" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-univ" id="edit" type="submit" ><i class="fa fa-edit" aria-hidden="true"></i> Edit</button>
                                                                                        <button data-id="{{$univ->idUniversity}}" data-univname="{{$univ->name}}" class="dropdown-item" data-toggle="modal" data-target="#modal-delete-univ" style="float: right;margin-right:1%;display: inline-block;" ><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script>(function( $ ) {
                                                $(function() {

                                                    $('#modal-edit-univ').on('show.bs.modal', function (event) {
                                                        var button = $(event.relatedTarget)
                                                        var univName = button.data('univname')
                                                        var idUniv = button.data('id')
                                                        var modal = $(this)

                                                        modal.find('.modal-body #univName').val(univName)
                                                        modal.find('.modal-body #idUniv').val(idUniv)
                                                    })

                                                    $('#modal-delete-univ').on('show.bs.modal', function (event) {
                                                        var button = $(event.relatedTarget)
                                                        var id = button.data('id')
                                                        var univname = button.data('univname')
                                                        var modal = $(this)

                                                        modal.find('.modal-body #id').val(id)
                                                        modal.find('.modal-body #univname').text(univname)

                                                    })



                                                })})(jQuery);

                                        </script>

            @elseif(count($data) == 3)
            <!-- Modal - Create -->
                <div class="modal" id="modal-1" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Create</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">


                                <form action="{{ action('AdminController@store','subjectEnrollments')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="table" name="table" value="subjectEnrollments">

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">User</label>
                                        <select class="form-control" name="idUser" id="idUser">
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Subject</label>
                                        <select class="form-control" name="idSubject" id="idSubject">
                                            @foreach($subjects as $sub)
                                                <option value="{{$sub->idSubject}}">{{$sub->subjectName}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">User</label>
                                        <select class="form-control" name="class" id="class">
                                            @foreach($subjects as $sub)
                                                <option value="{{$ze = $sub->class}}">{{$sub->class}}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-success">Create</button>
                                    <button href="/tables" type="submit" class="btn btn-danger" style="float: right">Cancel</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>



                <!-- Modal - Import Data -->
                <div class="modal" id="modal-2" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Import Students Data</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ action('AdminController@import','subjectEnrollments')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <input type="file" name="upload-file" class="form-control-file">
                                    </div>
                                    <input class="btn btn-success" type="submit" value="Upload .csv File" name="submit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal - Edit Data -->
                <div class="modal" id="modal-edit-subjectenroll" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Enrollment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{action('AdminController@update')}}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{method_field('PUT')}}
                                    <input type="hidden" id="table" name="table" value="subjectEnrollments">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">User:</label>
                                        <span name="iduser" id="iduser"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Subject:</label>
                                            <span name="idSub" id="idSub"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Class</label>
                                        <select class="form-control" name="classes" id="classes">
                                            @foreach($subjects as $sub)
                                                <option value="{{$sub->class}}">{{$sub->class}}</option>
                                            @endforeach

                                        </select>
                                        <input type="hidden" id="classes_h" name="classes_h" class="form-control" >

                                    </div>
                                    <input type="hidden" id="idSub" name="idSub">
                                    <div class="modal-footer">

                                        <button type="submit" class="btn btn-outline-success" >Update</button>
                                        <button style="float: right" data-dismiss="modal" aria-label="Close" type="button" class="btn btn-outline-danger">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal - Delete -->
                <div class="modal" id="modal-delete-subjectenroll" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{action('AdminController@destroy',['table' => 'subjects'])}}" method="POST">
                                    {{method_field('DELETE')}}
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <p>Are you sure you want to delete this subject?</p>
                                        <span id="idSub"></span>
                                        <input type="hidden" id="id" name="id">
                                    </div>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    <button data-dismiss="modal" aria-label="Close" class="btn btn-outline-secondary" style="float: right">Cancel</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-xl" style="max-width: 100%; margin-bottom: 5%;">
                    <!-- Search form -->
                    <div style="margin-top: 1%;margin-bottom: 3%;">
                        <h3>Subjects Enrollments</h3>
                    </div>

                    <div class="content" style="">
                        <div class="row">
                            <div class="col-xl-12">
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="card">
                                    <div class="card-header">
                                        <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-1"><i class="fa fa-plus" aria-hidden="true"></i> Create</button>
                                        <button class="btn btn-outline-primary"  type="submit" data-toggle="modal" data-target="#modal-2"><i class="fa fa-upload" aria-hidden="true"></i> Import</button>
                                    </div>

                                    <div class="card-body" >
                                        <div class="table-responsive">
                                            <table id="datatable" class="table table-hover">
                                                <thead class=" text-primary">
                                                <tr>
                                                    <th scope="col" >
                                                        idUser
                                                    </th>
                                                    {{--<th scope="col" >--}}
                                                        {{--User--}}
                                                    {{--</th>--}}
                                                    <th scope="col">
                                                        idSubject
                                                    </th>
                                                    {{--<th scope="col">--}}
                                                        {{--Subject--}}
                                                    {{--</th>--}}
                                                    <th scope="col">
                                                        Class
                                                    </th>

                                                    <th scope="col" class="text-right">
                                                        Tools
                                                    </th>
                                                </tr>

                                                </thead>
                                                <tbody>
                                                @foreach($data as $enroll)
                                                    <tr>
                                                        <td>
                                                            {{$enroll->idUser}}
                                                        </td>

                                                        <td>
                                                            {{$enroll->idSubject}}
                                                        </td>
                                                        <td>
                                                            {{$enroll->Class}}
                                                        </td>

                                                        <td class="text-right">

                                                            <div class="dropdown">
                                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fal fa-tools"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                    <button  data-idUser="{{$enroll->idUser}}" data-idsub="{{$enroll->idSubject}}" data-classes="{{$enroll->Class}}" class="dropdown-item" data-toggle="modal" data-target="#modal-edit-subjectenroll" id="edit" type="submit" ><i class="fa fa-edit" aria-hidden="true"></i> Edit</button>
                                                                    <button class="dropdown-item" data-iduser="{{$enroll->idUser}}" data-idsubject="{{$enroll->idSubject}}" data-toggle="modal" data-target="#modal-delete-subjectenroll" style="float: right;margin-right:1%;display: inline-block;" ><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @endif



                    <script>(function( $ ) {
                            $(function() {

                                $('#modal-edit-subjectenroll').on('show.bs.modal', function (event) {
                                    var button = $(event.relatedTarget)
                                    var iduser = button.data('iduser')
                                    var idsub = button.data('idsub')
                                    var classes = button.data('classes')



                                    var modal = $(this)

                                    modal.find('.modal-body #iduser').text(iduser)
                                    modal.find('.modal-body #idSub').text(idsub)
                                    modal.find('.modal-body #classes').val(classes)
                                    modal.find('.modal-body #classes_h').val(classes)
                                })

                                $('#modal-delete-subjectenroll').on('show.bs.modal', function (event) {
                                    var button = $(event.relatedTarget)
                                    var id = button.data('iduser')
                                    var idSub = button.data('idsubject')
                                    var modal = $(this)

                                    modal.find('.modal-body #id').val(id)
                                    modal.find('.modal-body #idSub').text(idSub)

                                })



                            })})(jQuery);

                    </script>

                    <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.min.css')}}"/>
                    <script type="text/javascript" src="{{asset('DataTables/datatables.min.js')}}"></script>

        <script>$(document).ready( function () {
                $('#datatable').DataTable();
            } );</script>
@endsection

