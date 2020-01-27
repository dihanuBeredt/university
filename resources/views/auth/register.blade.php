@extends('layouts.app')

@section('content')
<div class="container">




    <form id="regForm" action="">

        <h1>Register:</h1>

        <!-- One "tab" for each step in the form: -->
        <div class="tab">Name:
            <p><input id="name" name="name" placeholder="First name..." oninput="this.className = ''"></p>
            <p><input id="lname" name="lname" placeholder="Last name..." oninput="this.className = ''"></p>
        </div>

        <div class="tab">Contact Info:
            <p><input id="email" placeholder="E-mail..." oninput="this.className = ''"></p>
            <p><input id ="phone" placeholder="Phone..." oninput="this.className = ''"></p>
        </div>

        <div class="tab">Birthday:
            <p><input id="dd" placeholder="dd" oninput="this.className = ''"></p>
            <p><input id="mm" placeholder="mm" oninput="this.className = ''"></p>
            <p><input id="yyyy" placeholder="yyyy" oninput="this.className = ''"></p>
        </div>

        <div class="tab">Login Info:
            <p><input id="username" placeholder="Username..." oninput="this.className = ''"></p>
            <p><input id="password" placeholder="Password..." oninput="this.className = ''"></p>
            <p><input type="checkbox" id="checkbox" value="agree" >agree</p>
        </div>


        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
        </div>

        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>

    </form>

    {{$s}}







</div>
@endsection

@section('scripts')

      // import axios from 'axios';
      <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

      <script>
       var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {

                // ... the form gets submitted:
                getInputValue().submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }


        axios.get('/api/register').then(function (response) {
            // handle success
            console.log(response);
        }).catch(function (error) {
            // handle error
            console.log(error);
        })


        // var array = [ '1' , '2'];
        // var x = array.push('7');
        // console.log(array);

        function getInputValue(){

            var fields = [];
            // Selecting the input element and get its value
            var inputVal1 = document.getElementById("name").value;
            var inputVal2 = document.getElementById("lname").value;
            var inputVal3 = document.getElementById("email").value;
            var inputVal4 = document.getElementById("phone").value;
            var inputVal5 = document.getElementById("dd").value;
            var inputVal6 = document.getElementById("mm").value;
            var inputVal7 = document.getElementById("yyyy").value;
            var inputVal8 = document.getElementById("username").value;
            var inputVal9 = document.getElementById("password").value;
            var inputVal10 = document.getElementById("checkbox").value;

            fields.push(inputVal1 , inputVal2 , inputVal3, inputVal4, inputVal5, inputVal6, inputVal7, inputVal8, inputVal9, inputVal10);
            var myJSON = JSON.stringify(fields);
            // Displaying the value
            console.log(myJSON);
        }


        getInputValue();

        // function jsonConvert(){
        //     var fs = require('fs');
        //     fs.writeFile("file.json", myJSON);
        //
        // }



        // console.log(window.location.href);






        // var myJSON = JSON.stringify(saveFile);

        // }

    </script>


@endsection

{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form name="myForm" method="POST" action="{{ route('register') }}" onsubmit="return validateForm()">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="lastName" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="lastName" type="name" class="form-control" name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName">--}}

{{--                                @error('lastName')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
