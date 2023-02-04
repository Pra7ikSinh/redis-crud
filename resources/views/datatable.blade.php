<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/datatables.mark.js/2.0.0/datatables.mark.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.min.css">
    <!-- bootstrap link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">



    {{-- Font awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    {{-- bootstrap icon  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    {{-- datatable cdn  --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />
    <title>Table</title>
    <style>
        .dataTable {
            table-layout: fixed !important;
            word-wrap: break-word;
        }
        td {
  word-break: break-word;
}

        .error {
            color: red;
        }

        .error_occured {
            border: 2px red ridge;
            box-shadow: 0 0 9px 0px red;
        }

        .valid {
            border: 2px green solid;
            box-shadow: 0 0 9px 0px green;
        }

        .validation-error {
            color: red;
        }

        .navbar {
            background-color: rgb(136, 21, 14);
        }
    </style>
</head>

<body>
    <!-- Modal -->
    <div class="modal" id="AddEmpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalCenterTitle">Add Employee</h5>
                    <button type="button" class="close clear" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form Add User  -->

                    <form method="POST" id="addUserform" enctype="multipart/form-data">
                        {{-- <form id="addUserform" method="POST" action="{{url('/')}}/datatable" enctype="multipart/form-data" novalidate="false"> --}}
                        @csrf
                        {{-- {!! Form::open([
                        'id' => 'add-user-id',
                        'action'=> [HomeController::class,'index'],
                        'method' => 'POST',
                        'enctype' => 'multipart/form-data',
                    ]) !!} --}}

                        <input type="hidden" id="id_for_update" name="id_for_update">
                        {{-- {!! Form::hidden(, $value, [$options]) !!} --}}

                        <!--  -->
                        <div class="form-group row">
                            {{-- <label for="first_name" class="col-sm-3 text-center col-form-label">First Name</label> --}}
                            {!! Form::label('first_name', 'First Name', ['class' => 'col-sm-3 text-center col-form-label']) !!}
                            <div class="col-sm-9">
                                {{-- <input type="text" class="form-control" name="first_name" id="first_name"
                                placeholder="Enter your first name here"> --}}
                                {!! Form::text('first_name', old('first_name'), [
                                    'class' => 'form-control',
                                    'id' => 'first_name',
                                    'placeholder' => 'Enter your first name here',
                                ]) !!}
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-group row">
                            <label for="last_name" class="col-sm-3 text-center col-form-label">last name</label>
                            <div class="col-sm-9">
                                {{-- <input type="text" class="form-control" name="last_name" id="last_name"
                                placeholder="Enter your last name here"> --}}
                                {!! Form::text('last_name', old('last_name'), [
                                    'class' => 'form-control',
                                    'id' => 'last_name',
                                    'placeholder' => 'Enter your last name here',
                                ]) !!}
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 text-center col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="email" id="email"
                                    placeholder="Enter your Em@il here">
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-group row">
                            <label for="contact_number" class="col-sm-3 text-center col-form-label">Contact No.</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="contact_number" id="contact_number"
                                    placeholder="Enter your phone number here">
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-group row">
                            <label for="profile_photo" class="col-sm-3 text-center col-form-label">profile photo</label>
                            <div class="col-sm-9">
                                <div class="col-sm-9 text-center col-form-label" id="preview_image">
                                    <div class='align-items-center'>
                                        <img id="preview_img" src='' alt=''
                                            style='width: 90px; height: 90px' class='rounded-circle' />
                                    </div>
                                </div>
                                <input id="profile_photo" name="profile_photo" type="file" data-show-preview="true">
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-group row">
                            <label for="designation" class="col-sm-3 text-center col-form-label">Designation</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="designation" id="designation"
                                    placeholder="Enter your designation here">
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-group row">
                            <label for="assigned_team" class="col-sm-3 text-center col-form-label">Assigned
                                Team</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="assigned_team" id="assigned_team"
                                    placeholder="Enter your assigned team here">
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-group row">
                            <label for="company" class="col-sm-3 text-center col-form-label">company</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="company" id="company"
                                    placeholder="Enter your company ">
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                        <label for="joinningDate" class="col-sm-3 text-center col-form-label">joinning Date</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" name="joinningDat   e" id="joinningDate"
                                placeholder="Enter your joinning Date ">
                        </div>
                    </div> --}}


                        <!--  -->
                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-3 text-center pt-0">Gender</legend>
                                <div style="display: flex;" class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender"
                                            value="Male">
                                        <label class="form-check-label" for="gridRadios1">
                                            Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender"
                                            value="Female">
                                        <label class="form-check-label" for="gridRadios2">
                                            Female
                                        </label>
                                        <label id="gender-error" class="error" for="gender">&nbsp;&nbsp;</label>
                                    </div>

                                </div>
                            </div>
                        </fieldset>
                        <!--  -->
                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-3 text-center pt-0">Languages</legend>
                                <div style="display: flex;" class="col-sm-9">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="languages[]"
                                            id="languages" value="English">
                                        <label class="form-check-label" for="gridRadios1">
                                            English&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="languages[]"
                                            id="languages" value="Hindi">
                                        <label class="form-check-label" for="gridRadios2">
                                            Hindi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="languages[]"
                                            id="languages" value="Gujarati">
                                        <label class="form-check-label" for="gridRadios2">
                                            Gujarati&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                        </label>
                                        <label id="languages[]-error" class="error" for="languages[]"></label>
                                    </div>

                                </div>
                            </div>
                        </fieldset>

                        <!--  -->
                        <div class="form-group row">

                            <label for="intro" class="col-sm-3 text-center col-form-label">Write about
                                employee</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="intro" name="intro" rows="3" placeholder="intro here anything "></textarea>
                            </div>
                            <div class="error" id="summary"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" id="btn_add_emp" name="submit" class="btn btn-primary">Add
                                    Employee</button>
                                <button type="button" class="btn btn-secondary clear"
                                    data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <!-- <button type="submit" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-md navbar-light shadow-sm">
        <div class="container">

            <h2>Laravel</h2>




            {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> --}}


            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->

                @guest
                @else
                @can('IfAdmin')
                <h3 class="text-primary">WelCome Admin,</h3>
                @endcan
                @can('IfUser')
                <h3 class="text-primary">WelCome User</h3>
                @endcan
                    <li class="nav-item dropdown">

                        {{ Auth::user()->name }}


                        <a class="dropdown-item" href={{ route('logout') }}
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        {{-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> --}}


                        <form  class="dropdown-item" id="logout-form" action={{ route('logout') }} method="POST" class="d-none">
                            @csrf
                            {{-- <input type="submit" text="{{__('Logout')}}" name="logoutButton"
                            value="logout"/> --}}
                        </form>
                        {{-- @php

                            if(isset($_POST['logoutButton'])){

                                Redis::del('empData');
                            }
                        @endphp --}}

                        {{-- </div> --}}
                    </li>
                @endguest
            </ul>
        </div>
        </div>
    </nav>

    <h1 class="text-center ">Datatable</h1>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

@can('IfAdmin')

<button type="button" onclick="Modalshow();" class="btn btn-dark " data-toggle="modal">
    <i class="bi bi-plus-circle-dotted"></i> &nbsp;Add Users
</button>
@endcan

    <div class="card-body" id="show_all_employees">
        <h1 class="text-center text-secondary my-5">Loading...</h1>
    </div>

    <!-- jquery  -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"
        integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        "https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js),datatables.mark.js"
    </script>
    <script>
        "https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js)"
    </script>
    <script>
        "https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"
    </script>
    <script>
        $(document).ready(function() {
            // console.log("document is ready");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log("document is ready");


            $.validator.addMethod("EmailRegex", function(value) {
                return /^(?=[^@]*[A-Za-z])([a-zA-Z0-9])(([a-zA-Z0-9])*([\._-])?([a-zA-Z0-9]))*@(([a-zA-Z0-9])+(\.))+([a-zA-Z]{2,4})+$/
                    .test(value);
            }, "please enter valid E-m@il");

            $.validator.addMethod("DesignationRegex", function(value) {
                return /^\s*[a-zA-Z.\s]+\s*$/.test(value);
            }, "only alphabets and '.' is allowed");

            $.validator.addMethod("CompanyRegEx", function(value) {
                return /^([a-zA-Z0-9]+\s)*[a-zA-Z0-9]+$/.test(value);
            }, "Pre-spaces,backward spaces and double spaces are not allowed !");

            $("#addUserform").validate({
                rules: {
                    first_name: {
                        required: true,
                        lettersonly: true,
                        minlength: 3,
                        maxlength: 10,
                    },
                    last_name: {
                        required: true,
                        lettersonly: true,
                        minlength: 3,
                        maxlength: 10,
                    },
                    email: {
                        required: true,
                        email: true,
                        EmailRegex: true,
                    },
                    contact_number: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 10,
                    },
                    profile_photo: {
                        required: {
                            depends: function(element) {
                                var status = false;
                                if ($("#preview_img").attr('src') == 'preview_img') {
                                    status = true;

                                }
                                return status;
                            }
                        },
                        accept: "image/*",
                        extension: "png|jpg|jpeg",
                    },
                    designation: {
                        required: true,
                        minlength: 3,
                        maxlength: 20,
                        DesignationRegex: true,
                    },
                    assigned_team: {
                        required: true,
                        maxlength: 20,
                    },
                    company: {
                        required: true,
                        CompanyRegEx: true,

                    },
                    gender: {
                        required: true,

                    },

                    'languages[]': {
                        required: true,

                    }
                },
                highlight: function(element) {
                    $(element).addClass("error_occured");
                    $(element).removeClass("valid");
                },
                unhighlight: function(element) {
                    $(element).addClass("valid");
                    $(element).removeClass("error_occured");
                },
                invalidHandler: function(element) {
                    var validator = $("#addUserform").validate();
                    $("#summary").text(validator.numberOfInvalids() + " fields are invalid..");
                },
                submitHandler: function() {
                    var form = document.getElementById("addUserform");
                    var Form_Data = new FormData(form);
                    var files = $("#profile_photo")[0].files;
                    $('#btn_add_emp').text('Adding');

                    $.ajax({
                        url: '{{ route('store') }}',
                        type: 'POST',
                        data: Form_Data,
                        // dataType: 'json',
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            console.log(response);
                            $("#AddEmpModal").modal('hide');
                            $("#addUserform").validate().resetForm();
                            $("#addUserform").trigger('reset');

                            fetchedData();

                            $('#btn_add_emp').text('Add Employee');
                            console.log(response.status);
                            if (response.status == 200) {
                                if (response.success ==
                                    "employee data updated successfully") {
                                    Swal.fire({
                                        title: "Updated !!!",
                                        text: response.success,
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 1000
                                    })
                                } else {
                                    // console.log(response);
                                    sweetAlert.fire({
                                        title: "Added",
                                        text: "New Employee added !!! . .",
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 1000
                                    })
                                }


                            }

                        }
                    })


                },
                /* messages :{
                     //write particular messages for showing user error
                }
                */
            });

            fetchedData();
        });

        function fetchedData() {
            $.ajax({
                url: '{{ route('fetchedData') }}',
                type: 'get',
                success: function(data) {

                    // const data1 = JSON.parse(data);
                    /* json decode return object*/
                    /* json enocode  return string*/
                    // console.log(typeof data);
                    // console.log(data);
                    console.log('data fetched succesfully : 200');
                    // console.log(data.status);
               /*     $.each(data, function(key, value) {
                        console.log(key);
                        console.log(value);
                        console.log("\n");


                        here ... key is 0, value is array of values from database containing columns as key and their values as value

                        $.each(value, function(keyy, valuee) {
                             so, we now using value as our array and printing column and values
                            console.log(keyy + ":" + valuee);
                        })
                    })
*/


                    let table_html = `<table class='table dataTable align-middle mb-0 bg-white'>
                    <thead class='bg-light'>
                <tr>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Company</th>
                    <th>Gender</th>
                    <th>Languages</th>
                    <th>Intro</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>`;

                    $.each(data, function(key, value) {
                        // key = 0 , 1 , 2 , 3
                        // value = 1:array ...
                        // console.log(key);
                        // $.each(value, function(column, itsValue) {
                        //     console.log(column);
                            // console.log(value['profile_photo']);
            table_html +=`
            <tr>
                <td>
                    <div class='d-flex align-items-center'>
                        <img src= "`+value['profile_photo']+`" alt=''
                                           style='width: 45px; height: 45px' class='mr-7 rounded-circle' />
                                       <div class='ms-3'>
                                           <p class='fw-bold mb-1'>`+value['first_name']+ " " +value['last_name'] +`</p>
                                           <p class='text-muted mb-0'>`+value['email']+` , `+value['contact_number']+`</p>
                                       </div>
                                   </div>
                               </td>
                               <td>
                                   <p class='fw-normal mb-1'>`+value['designation']+`</p>
                                   <p class='text-muted mb-0'><b> Team :</b> `+value['assigned_team']+`</p>
                               </td>
                               <td>
                                   <span class=''>`+value['company']+`</span>
                               </td>
                               <td>
                                   <span>`+value['gender']+`</span>
                               </td>
                               <td>
                                   <span>`+value['languages']+`</span>
                               </td>
                               <td>
                                   <span>`+value['intro']+`</span>
                               </td>

                               <td>
                                @can('IfAdmin')

                                   <button type='button' class='btn btn-success btn-sm btn-rounded'>
                                   <i class='bi bi-send-fill'></i>
                                   </button>

                                   <button  style='background-color : #ff0e05' type='button' class='btn mr-7 btn-sm btn-rounded'>
                                    <a herf="{{route('PDFGenerate',['id'=> `+value['id']+`])}}"><i class='bi bi-filetype-pdf'></i></a>
                                    </button>

                                    <button type='button' onclick=EditEmployee(`+value['id']+`); class='btn mt-1 btn-primary btn-sm btn-rounded'>
                                   <i class='bi bi-pencil-square'></i>
                                   </button>
                                   <button onclick=DeleteEmployee(`+value['id']+`);  style='background-color : #740e05' type='button' class='btn mt-1  btn-sm btn-rounded'>
                                   <i class='bi bi-trash3'></i>
                                   @endcan
                                @can('IfUser')
                                <button type='button' class='btn btn-success btn-sm btn-rounded'>
                                   <i class='bi bi-send-fill'></i>
                                   </button>
                                   <button  style='background-color : #ff0e05' type='button' class='btn mr-7 btn-sm btn-rounded'>
                                    <a herf="{{route('PDFGenerate',['id'=> `+value['id']+`])}}"><i class='bi bi-filetype-pdf'></i></a>
                                    </button>

                                   @endcan
                               </td>
                           </tr>


            `;
                        });
                    // });

                    $('#show_all_employees').html(table_html);


                    $("table").DataTable({
                        mark: true,

                        autoWidth: false,
                        bAutoWidth: false,
                        sScrollX: "100%",
                        aoColumns: [{
                                sWidth: '25%'
                            },
                            {
                                sWidth: '15%'
                            },
                            {
                                sWidth: '15%'
                            },
                            {
                                sWidth: '9%'
                            },
                            {
                                sWidth: '10%'
                            },
                            {
                                sWidth: '15%'
                            },
                            {
                                sWidth: '8%'
                            }
                        ],
                        order: [0, 'desc'],
                        searchHighlight: true,

                    });

                }
            })
        }

        function DeleteEmployee(id) {
            fd = new FormData();
            fd.append('id', id);
            for (var pair of fd.entries()) {
                console.log(pair[0] + ', ' + pair[1]);
                alert();
            }
            // console.log(fd);
            // alert();
            sweetAlert.fire({
                title: 'Are you sure?',
                text: 'once employee\'s data deleted, It can\'t be reversed !!!',
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: 'Delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('DeleteEmployee') }}",
                        data: fd,
                        // url:"/DeleteEmployee/" + id,
                        type: 'POST',
                        enctype: 'multipart/form-data',
                        // dataType:'json',
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.status == '200') {
                                sweetAlert.fire({
                                    title: "Deleted",
                                    text: "Employee Data is deleted!!",
                                    imageUrl: "/images/img.gif",
                                    imageWidth: 100,
                                    imageHeight: 100,
                                    // buttons: ["oh no!", "oh yes!"],
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                            // console.log(response.status);
                            // console.log(response.success);

                            // console.log(response)
                            fetchedData();
                        }

                    })
                }
            })

        }

        function EditEmployee(id) {
            fd = new FormData();
            fd.append('id', id);
            $.ajax({
                url: "{{ route('EditEmployee') }}",
                data: fd,
                type: 'post',
                enctype: 'multipart/form-data',
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#AddEmpModal").modal('show');
                    $("#exampleModalCenterTitle").text("Update details of Employee");
                    $("#id_for_update").val(response.id);
                    $("#first_name").val(response.first_name);
                    $("#last_name").val(response.last_name);
                    $("#email").val(response.email);
                    $("#contact_number").val(response.contact_number);
                    // $("#first_name").val(response.);

                    $("#preview_img").attr('hidden', false);
                    $("#preview_img").attr('src', response.profile_photo);

                    $("#designation").val(response.designation);
                    $("#assigned_team").val(response.assigned_team);
                    $("#company").val(response.company);
                    // $("#gender").val(response.gender);
                    $("input[name='gender'][value=" + response.gender + "]").prop("checked", true);
                    // $("#languages").val(response.languages);
                    var str = response.languages;
                    console.log(response.languages);
                    lang_array = str.split(",");
                    for (i = 0; i <= lang_array.length; i++) {
                        $("input[name='languages[]'][value=" + lang_array[i] + "]").prop("checked", true);
                    }
                    $("#intro").val(response.intro);
                    $("#btn_add_emp").html("Update Employee");

                }
            })
        }

        function Modalshow() {

            $("#AddEmpModal").modal("show");
            $("#addUserform").trigger("reset");
            $("#id_for_update").val("");
            $("textarea").removeClass("valid");
            $("input").removeClass("error");
            $("#contact_number-error").html("");
            $("input").removeClass("error_occured");
            $("input").removeClass("valid");
            $("input").removeClass("validation-error ");
            $("#exampleModalCenterTitle").html("Add Employee");
            $("#btn_add_emp").html("Add Employee");

            // $("#preview_image").html("");
            $("#preview_img").attr('hidden', "true");
            $("#preview_img").attr('src', "preview_img");
            $("#addUserform").validate().resetForm();
        }


    </script>
</body>

</html>
