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
            <p><input id = "phone" placeholder="Phone..." oninput="this.className = ''"></p>
        </div>

        <div class="tab">Birthday:
            <p><input id="dd" placeholder="dd" oninput="this.className = ''"></p>
            <p><input id="mm" placeholder="mm" oninput="this.className = ''"></p>
            <p><input id="yyyy" placeholder="yyyy" oninput="this.className = ''"></p>
        </div>

        <div class="tab">Login Info:
            <p><input id="username" placeholder="Username..." oninput="this.className = ''"></p>
            <p><input id="password" placeholder="Password..." oninput="this.className = ''"></p>
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
</div>
@endsection

@section('scripts')
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
                document.getElementById("regForm").submit();
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

        // let saveFile = () => {
        //
        //     // Get the data from each element on the form.
        //     const name = document.getElementById('name');
        //     const lname = document.getElementById('lname');
        //     const email = document.getElementById('email');
        //     const phone = document.getElementById('phone');
        //     const dd = document.getElementById('dd');
        //     const mm = document.getElementById('mm');
        //     const yyyy = document.getElementById('yyyy');
        //     const username = document.getElementById('username');
        //     const password = document.getElementById('password');
        //
        var name = document.getElementById('name');
        var value = name.getAttribute('name');

        window.alert(value);

        var saveArray = [
            name => document.getElementById('name'),
            lname => document.getElementById('lname'),
            email => document.getElementById('email'),
            phone => document.getElementById('phone'),
            dd => document.getElementById('dd'),
            mm => document.getElementById('mm'),
            yyyy => document.getElementById('yyyy'),
            username => document.getElementById('username'),
            password => document.getElementById('password'),
        ];

        console.log(saveArray);

        // var myJSON = JSON.stringify(saveFile);

            // This variable stores all the data.
            // let data =
            //     '\r Name: ' + name.value + ' \r\n ' +
            //     'lname: ' +lname.value + ' \r\n ' +
            //     'Email: ' + email.value + ' \r\n ' +
            //     'phone: ' + phone.value + ' \r\n ' +
            //     'dd: ' + dd.value;
            //     'mm: ' + mm.value;
            //     'yyyy: ' + yyyy.value;
            //     'username: ' + username.value;
            //     'password: ' + password.value;
            //
            //     console.log(data);

            // Convert the text to BLOB.
        //     const textToBLOB = new Blob([data], { type: 'text/plain' });
        //     const sFileName = 'formData.txt';	   // The file to save the data.
        //
        //     let newLink = document.createElement("a");
        //     newLink.download = sFileName;
        //
        //     if (window.webkitURL != null) {
        //         newLink.href = window.webkitURL.createObjectURL(textToBLOB);
        //     }
        //     else {
        //         newLink.href = window.URL.createObjectURL(textToBLOB);
        //         newLink.style.display = "none";
        //         document.body.appendChild(newLink);
        //     }
        //
        //     newLink.click();
        // }

    </script>

@endsection

