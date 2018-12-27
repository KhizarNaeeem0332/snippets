

$(function () {

    //setDefault
    $.validator.setDefaults({

        highlight : function (element) {
            var id_attr = "#" + $( element ).attr("id") + "1";
            //console.log(id_attr);
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            $(id_attr).removeClass('glyphicon-ok').addClass('glyphicon-remove');
        },
        unhighlight : function (element) {
            var id_attr = "#" + $( element ).attr("id") + "1";
           // console.log(id_attr);
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(id_attr).removeClass('glyphicon-remove').addClass('glyphicon-ok');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function(error, element) {
            if(element.length) {
                error.insertAfter(element);
            } else {
                error.insertAfter(element);
            }
        }

    });

    //sizeMatch : 9
    $.validator.addMethod("sizeMatch", function(value, element , size) {
            if (value.length == size) {
                return true ;
            }
            else {
                return false;
            }
        }
    );//sizeMatch end"

    $.validator.addMethod("sizeMinMatch", function(value, element , size) {
            if (value.length < size) {
                return false ;
            }
            else {
                return true;
            }
        }
    );//sizeMatch end"


    //textMatch: "text"
    $.validator.addMethod("textMatch", function(value, element , text) {

            if (value == text) {
                return false ;
            }
            else {
                return true;
            }
            //return this.optional(element) || !value === text
        }
    );//textMatch end


    //patternMatch : /pattern/
    $.validator.addMethod('patternMatch', function (value,element,pattern) {
        return this.optional(element) || pattern.test(value);
    }
    );//patternMatch End



    $.validator.addMethod("checkDropDown",function(value, element) {
        if (value == "-1")
            return false;
        else
            return true;
    },
    "Please select a value");

    $.validator.addMethod("personTypeDropDown",function(value, element) {
            if (value == "-1")
            {
                return false;
            }
            if (value == "Student")
            {
                $('#txtID').mask('99NTU9999');
                return true;
            }
            else
            {
                $('#txtID').unmask();
                return true;
            }
        },
        "Please select a value");


//patternNotAllow : /pattern/
    $.validator.addMethod('patternNotAllow', function (value,element,pattern) {
        return this.optional(element) || !pattern.test(value);
    }
    );//patternMatch End


    $.validator.addMethod('imgMinSize', function(value, element) {
        var size = element.files[0].size;
        if (size <= 16000)// checks the file more than 1 MB
        {
            return false;
        }
        else {
            return true;
        }
    });

    $.validator.addMethod('imgMaxSize', function(value, element) {
        var size = element.files[0].size;

        if (size >= 3145728)// checks the file more than 1 MB
        {
            return false;
        }
        else {
            return true;
        }
    });

    $.validator.addMethod('rupeeValue', function(value, element) {

        if (value == 0 || value == 00 || value == 000 || value == 0000)// checks the file more than 1 MB
        {
            return false;
        }
        else {
            return true;
        }
    });

    //validating both student and employee id
    $.validator.addMethod('vehicleRegID', function(value, element) {

        var ddValue = document.getElementById('ddPersonType').value ;


        if (ddValue == "student" || ddValue == "Student")
        {
            var pattern = /([\d]{2}NTU[\d]{4})/;

            if(!value.match(pattern))
            {
                return false;
            }
            else if (value == '00NTU0000')
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        else
        {
            var numberPattern = /([\d]{1,5})/;
            var onlyNumberPattern = /^\d+$/;

            if (value.length > 5 )
            {
                return false;
            }
            else if (value == 0 || value == 00 || value == 000 || value == 0000 || value == 00000)
            {
                return false;
            }
            else if(!value.match(numberPattern))
            {
                return false;
            }
            else if(!value.match(onlyNumberPattern))
            {
                return false;
            }
            else
            {
                return true;
            }
        }

    });





//verify_student.php #formStudentVerify
    $("#formStudentVerify").validate({

        rules:{
            txtStdRegID:{
                required: true,
                patternMatch: /([\d]{2}NTU[\d]{4})/,
                sizeMatch : 9,
                textMatch : '00NTU0000'
            },
            txtCnic:{
                required :true,
                sizeMatch:15,
                patternMatch: /([\d]{5}[-][\d]{7}[-][\d]{1})/
            }
        },
        messages:{
            txtStdRegID:{
                required: "Student ID required.",
                patternMatch : "Invalid ID, it must be XXNTUXXXX format",
                sizeMatch: "Student ID must be 9 characters",
                textMatch: "Invalid ID"
            },
            txtCnic:{
                required : "Student CNIC required",
                sizeMatch: "length must be 15 number including dash(-)",
                patternMatch: "Invalid pattern , e.g xxxxx-xxxxxxx-x"
            }
        }
    });//#formStudentVerify end

//verify_staff.php #formStafftVerify
    $("#formStaffVerify").validate({

        rules:{
            txtRegID:{
                required: true,
                minlength:1 ,
                maxlength:5 ,
                number :true
            },
            txtCnic:{
                required :true,
                sizeMatch:15,
                patternMatch: /([\d]{5}[-][\d]{7}[-][\d]{1})/
            }
        },
        messages:{
            txtRegID:{
                required: "Staff ID  required.",
                minlength: "Length must be greater than equal to 1" ,
                maxlength: "Length must be less than 5" ,
                number : "Invalid ID, only numbers are allowed."
            },
            txtCnic:{
                required : "Staff CNIC required",
                sizeMatch: "length must be 15 number including dash(-)",
                patternMatch: "Invalid pattern , e.g xxxxx-xxxxxxx-x"
            }
        }
    });//#formStafftVerify end

//verify_faculty.php #formFacultytVerify
    $("#formFacultyVerify").validate({

        rules:{
            txtRegID:{
                required: true,
                minlength:1 ,
                maxlength:5 ,
                number :true
            },
            txtCnic:{
                required :true,
                sizeMatch:15,
                patternMatch: /([\d]{5}[-][\d]{7}[-][\d]{1})/
            }
        },
        messages:{
            txtRegID:{
                required: "Faculty ID  required.",
                minlength: "Length must be greater than equal to 1" ,
                maxlength: "Length must be less than 5" ,
                number : "Invalid ID, only numbers are allowed."
            },
            txtCnic:{
                required : "Faculty CNIC required",
                sizeMatch: "length must be 15 number including dash(-)",
                patternMatch: "Invalid pattern , e.g xxxxx-xxxxxxx-x"
            }
        }
    });//#formStafftVerify end

//verify_vehicle.php #formVehicleVerify
    $("#formVehicleVerify").validate({

        rules:{
            txtCnic:{
                required :true,
                sizeMatch:15,
                patternMatch: /([\d]{5}[-][\d]{7}[-][\d]{1})/
            },
            txtVehicleNo:{
                required :true,
                minlength:4,
                maxlength:20
            }
        },
        messages:{
            txtCnic:{
                required : "CNIC required",
                sizeMatch: "length must be 15 number including dash(-)",
                patternMatch: "Invalid pattern , e.g xxxxx-xxxxxxx-x"
            },
            txtVehicleNo:{
                required :"Vehicle number required",
                minlength: "length should be greater than 4",
                maxlength: "length must be less than 20"
            }
        }
    });//#formVehicleVerify end

 //signin.php #formSignIn
    $("#formSignIn").validate({

        rules:{
            txtRegID:{
                required: true,
                minlength:1 ,
                maxlength:5 ,
                number :true
            },
            txtPassword:{
                required :true,
                minlength:8,
                maxlength:50,
                patternNotAllow: /\s+/
            }
        },
        messages:{
            txtRegID:{
                required: "Employee ID  required.",
                minlength: "Length must be greater than equal to 1" ,
                maxlength: "Length must be less than 5" ,
                number : "Invalid ID, only numbers are allowed."
            },
            txtPassword:{
                required : "Password required",
                minlength:"Password must be greater than 8 characters",
                maxlength:"Password must be less than 50 characters",
                patternNotAllow: "white spaces are not allowed"
            }
        }
    });//#formStafftVerify end

//signup.php #formSignUp
    $("#formSignUp").validate({

        rules:{
            txtRegID:{
                required: true,
                minlength:1 ,
                maxlength:5 ,
                number :true
            },
            txtCnic:{
                required :true,
                sizeMatch:15,
                patternMatch: /([\d]{5}[-][\d]{7}[-][\d]{1})/
            },
            txtUserName:{
                  required :true ,
                  minlength:5,
                  maxlength:20,
                  patternNotAllow: /\s+/
            },
            txtPassword:{
                required :true,
                minlength:8,
                maxlength:50,
                patternNotAllow: /\s+/
            },
            ddAdminType:{
                checkDropDown :true

            },
            txtQuestion :{
                required: true,
                minlength: 8 ,
                maxlength: 20 ,
                patternNotAllow: /\s+/
            }
        },
        messages:{
            txtRegID:{
                required: "Employee ID  required.",
                minlength: "Length must be greater than equal to 1" ,
                maxlength: "Length must be less than 5" ,
                number : "Invalid ID, only numbers are allowed."
            },
            txtCnic:{
                required : "CNIC required",
                sizeMatch: "length must be 15 number including dash(-)",
                patternMatch: "Invalid pattern , e.g xxxxx-xxxxxxx-x"
            },
            txtUserName:{
                required : "User name required",
                minlength:"User name must be greater than 8 characters",
                maxlength:"User name must be less than 50 characters",
                patternNotAllow: "white spaces are not allowed"
            },
            txtPassword:{
                required : "Password required",
                minlength:"Password must be greater than 8 characters",
                maxlength:"Password must be less than 50 characters",
                patternNotAllow: "white spaces are not allowed"
            },
            ddAdminType:{
                checkDropdown :"Please select admin type"
            },
            txtQuestion:{
                required: "Secret text required",
                minlength: "Length must be greater than 8" ,
                maxlength: "Length must be less than 20" ,
                patternNotAllow: "white spaces are not allowed"
            }
        }
    });//#Signuo end

 //signup_security.php #formSignupSecurity
    $("#formSignupSecurity").validate({

        rules:{
            txtCode:{
                required: true,
                number :true
            }
        },
        messages:{
            txtCode:{
                required: "Security code  required.",
                number : "only numbers are allowed."
            }
        }
    });//#formSignupSecurity end

//forgot_password.php #formChangePassword
    $("#formChangePassword").validate({

        rules:{
            txtRegID:{
                required: true,
                minlength:1 ,
                maxlength:5 ,
                number :true
            },
            txtCnic:{
                required :true,
                sizeMatch:15,
                patternMatch: /([\d]{5}[-][\d]{7}[-][\d]{1})/
            },
            txtPassword:{
                required :true,
                minlength:8,
                maxlength:50,
                patternNotAllow: /\s+/
            },
            txtQuestion :{
                required: true,
                minlength: 8 ,
                maxlength: 20 ,
                patternNotAllow: /\s+/
            }
        },
        messages:{
            txtRegID:{
                required: "Employee ID  required.",
                minlength: "Length must be greater than equal to 1" ,
                maxlength: "Length must be less than 5" ,
                number : "Invalid ID, only numbers are allowed."
            },
            txtCnic:{
                required : "CNIC required",
                sizeMatch: "length must be 15 number including dash(-)",
                patternMatch: "Invalid pattern , e.g xxxxx-xxxxxxx-x"
            },
            txtPassword:{
                required : "Password required",
                minlength:"Password must be greater than 8 characters",
                maxlength:"Password must be less than 50 characters",
                patternNotAllow: "white spaces are not allowed"
            },
            txtQuestion:{
                required: "Secret text required",
                minlength: "Length must be greater than 8" ,
                maxlength: "Length must be less than 20" ,
                patternNotAllow: "white spaces are not allowed"
            }
        }
    });//#formChangePassword end


 //register_faculty_id.php + register_staff_id.php #formRegEmpID
    $("#formRegEmpID").validate({

        rules:{
            txtRegID:{
                required: true,
                minlength:1 ,
                maxlength:5 ,
                number :true
            },
            txtCnic:{
                required :true,
                sizeMatch:15,
                patternMatch: /([\d]{5}[-][\d]{7}[-][\d]{1})/
            },
            fileImage:{
                required: true,
                accept: "image/jpg,image/jpeg,image/png",
                imgMinSize: 16000,
                imgMaxSize:3145728

            }
        },
        messages:{
            txtRegID:{
                required: "Register id  required.",
                minlength: "Length must be greater than equal to 1" ,
                maxlength: "Length must be less than 5" ,
                number : "Invalid ID, only numbers are allowed."
            },
            txtCnic:{
                required : "CNIC required",
                sizeMatch: "length must be 15 number including dash(-)",
                patternMatch: "Invalid pattern , e.g xxxxx-xxxxxxx-x"
            },
            fileImage:{
                required: "Picture required.",
                accept:"Only jpg and png are allowed",
                imgMinSize: "Image size must be greater than 16KB",
                imgMaxSize:"Image size must be less than 3MB"
            }
        }
    });//#formRegEmpID end


 //register_student_id.php #formRegStdID
    $("#formRegStdID").validate({

        rules:{
            txtRegID:{
                required: true,
                patternMatch: /([\d]{2}NTU[\d]{4})/,
                sizeMatch : 9,
                textMatch : '00NTU0000'
            },
            txtCnic:{
                required :true,
                sizeMatch:15,
                patternMatch: /([\d]{5}[-][\d]{7}[-][\d]{1})/
            },
            txtChallanNo:{
                required: true,
                number:true,
                patternNotAllow: /\s+/
            },
            txtRupee:{
                required: true,
                sizeMinMatch:2,
                maxlength:4,
                rupeeValue: true,
                number :true
            },
            fileImage:{
                required: true,
                accept: "image/jpg,image/jpeg,image/png",
                imgMinSize: 16000,
                imgMaxSize:3145728
            }
        },
        messages:{
            txtRegID:{
                required: "Student ID required.",
                patternMatch : "Invalid ID, it must be XXNTUXXXX format",
                sizeMatch: "Student ID must be 9 characters",
                textMatch: "Invalid ID"
            },
            txtCnic:{
                required : "Staff CNIC required",
                sizeMatch: "length must be 15 number including dash(-)",
                patternMatch: "Invalid pattern , e.g xxxxx-xxxxxxx-x"
            },
            txtChallanNo:{
                required: "Challan number required.",
                number:"Challan number must contain number only",
                patternNotAllow: "white spaces are not allowed"
            },
            txtRupee:{
                required: "Rupee required",
                sizeMinMatch : "Wrong amount.",
                maxlength:"Length exceeded.",
                rupeeValue: "Invalid value",
                number : "Only number is allowed."
            },
            fileImage:{
                required: "Picture required.",
                accept:"Only jpg and png are allowed",
                imgMinSize: "Image size must be greater than 16KB",
                imgMaxSize:"Image size must be less than 3MB"
            }
        }
    });//#formRegStdID end



//register_vehicle.php #formRegVehicle
    $("#formRegVehicle").validate({

        rules:{
            ddPersonType:{
                personTypeDropDown :true

            },
            txtID:{
                required: true,
                maxlength:9,
                vehicleRegID :true
            },
            txtCnic:{
                required :true,
                sizeMatch:15,
                patternMatch: /([\d]{5}[-][\d]{7}[-][\d]{1})/
            },
            ddVehicleType:{
                checkDropDown : true
            },
            txtVehicleNo:{
                required :true,
                minlength:4,
                maxlength:20
            },
            txtMake:{
                required :true,
                patternNotAllow: /[^a-zA-Z\s]/
            },
            txtModel :{
                required: true
            },
            txtColor:{
                required :true,
                patternNotAllow: /[^a-zA-Z\s]/
            }
        },
        messages:{

            ddPersonType:{
                personTypeDropDown : "Please Select Person Type"
            },
            txtID:{
                required: "Employee ID  required.",
                maxlength: "Length must be less than 9.",
                vehicleRegID : "Invalid ID with respect to person type."
            },
            txtCnic:{
                required : "CNIC required",
                sizeMatch: "length must be 15 number including dash(-)",
                patternMatch: "Invalid pattern , e.g xxxxx-xxxxxxx-x"
            },
             ddVehicleType:{
                checkDropDown : "Vehicle type required"
            },
            txtVehicleNo:{
                required :"Vehicle number required",
                minlength: "length should be greater than 4",
                maxlength: "length must be less than 20"
            },
            txtPassword:{
                required : "Password required",
                minlength:"Password must be greater than 8 characters",
                maxlength:"Password must be less than 50 characters",
                patternNotAllow: "white spaces are not allowed"
            },
            txtMake:{
                required :"Vehicle make required.",
                patternNotAllow: "Only character and spaces are allowed"
            },
            txtModel :{
                required: "Model required."
            },
            txtColor:{
                required :"Color required.",
                patternNotAllow: "Only character and spaces are allowed"
            }
        }
    });//#formRegVehicle end




//---------------  Progress Validation -----------------------

    // //p_stdid.php #fProStdID
    $("#fProStd").validate({

        rules:{
            txtCode:{
                required: true
            },
            txtRegID:{
                required: true,
                patternMatch: /([\d]{2}NTU[\d]{4})/,
                sizeMatch : 9,
                textMatch : '00NTU0000'
            },
            txtCnic:{
                required :true,
                sizeMatch:15,
                patternMatch: /([\d]{5}[-][\d]{7}[-][\d]{1})/
            }
        },
        messages:{
            txtCode:{
                required: "Code required."
            },
            txtRegID:{
                required: "Student ID required.",
                patternMatch : "Invalid ID, it must be XXNTUXXXX format",
                sizeMatch: "Student ID must be 9 characters",
                textMatch: "Invalid ID"
            },
            txtCnic:{
                required : "Staff CNIC required",
                sizeMatch: "length must be 15 number including dash(-)",
                patternMatch: "Invalid pattern , e.g xxxxx-xxxxxxx-x"
            }
        }
    });//#fProStdID end

    // //p_stdid.php #fProStdID
    $("#fUProStd").validate({

        rules:{
            txtRegID:{
                required: true,
                patternMatch: /([\d]{2}NTU[\d]{4})/,
                sizeMatch : 9,
                textMatch : '00NTU0000'
            },
            txtCnic:{
                required :true,
                sizeMatch:15,
                patternMatch: /([\d]{5}[-][\d]{7}[-][\d]{1})/
            },
            txtChallanNo:{
                required: true,
                number:true,
                patternNotAllow: /\s+/
            },
            txtRupee:{
                required: true,
                sizeMinMatch:2,
                maxlength:4,
                rupeeValue: true,
                number :true
            }
        },
        messages:{
            txtRegID:{
                required: "Student ID required.",
                patternMatch : "Invalid ID, it must be XXNTUXXXX format",
                sizeMatch: "Student ID must be 9 characters",
                textMatch: "Invalid ID"
            },
            txtCnic:{
                required : "Staff CNIC required",
                sizeMatch: "length must be 15 number including dash(-)",
                patternMatch: "Invalid pattern , e.g xxxxx-xxxxxxx-x"
            },
            txtChallanNo:{
                required: "Challan number required.",
                number:"Challan number must contain number only",
                patternNotAllow: "white spaces are not allowed"
            },
            txtRupee:{
                required: "Rupee required",
                sizeMinMatch : "Wrong amount.",
                maxlength:"Length exceeded.",
                rupeeValue: "Invalid value",
                number : "Only number is allowed."
            }
        }
    });//#fProStdID end

    // //p_fltid.php #fProfltID
    $("#fProEmp").validate({

        rules:{
            txtCode:{
                required: true
            },
            txtRegID:{
                required: true,
                minlength:1 ,
                maxlength:5 ,
                number :true
            },
            txtCnic:{
                required :true,
                sizeMatch:15,
                patternMatch: /([\d]{5}[-][\d]{7}[-][\d]{1})/
            }
        },
        messages:{
            txtCode:{
                required: "Code required."
            },
            txtRegID:{
                required: "Faculty id  required.",
                minlength: "Length must be greater than equal to 1" ,
                maxlength: "Length must be less than 5" ,
                number : "Invalid ID, only numbers are allowed."
            },
            txtCnic:{
                required : "Faculty CNIC required",
                sizeMatch: "length must be 15 number including dash(-)",
                patternMatch: "Invalid pattern , e.g xxxxx-xxxxxxx-x"
            }
        }
    });//#fProStdID end

       // //p_stdid.php #fProStfID
    $("#fUProEmp").validate({

        rules:{
            txtCode:{
                required: true
            },
            txtRegID:{
                required: true,
                minlength:1 ,
                maxlength:5 ,
                number :true
            },
            txtCnic:{
                required :true,
                sizeMatch:15,
                patternMatch: /([\d]{5}[-][\d]{7}[-][\d]{1})/
            },
            fileImage:{
                required: true,
                accept: "image/jpg,image/jpeg,image/png",
                imgMinSize: 16000,
                imgMaxSize:3145728

            }
        },
        messages:{
            txtCode:{
                required: "Code required."
            },
            txtRegID:{
                required: "Faculty id  required.",
                minlength: "Length must be greater than equal to 1" ,
                maxlength: "Length must be less than 5" ,
                number : "Invalid ID, only numbers are allowed."
            },
            txtCnic:{
                required : "Staff CNIC required",
                sizeMatch: "length must be 15 number including dash(-)",
                patternMatch: "Invalid pattern , e.g xxxxx-xxxxxxx-x"
            },
            fileImage:{
                required: "Picture required.",
                accept:"Only jpg and png are allowed",
                imgMinSize: "Image size must be greater than 16KB",
                imgMaxSize:"Image size must be less than 3MB"
            }
        }
    });//#fProStdID end


    //register_vehicle.php #formRegVehicle
    $("#fProVehicle").validate({

        rules:{
            ddPersonType:{
                personTypeDropDown :true

            },
            txtCode:{
                required: true
            },
            txtRegID:{
                required: true,
                maxlength:9,
                vehicleRegID :true
            },
            txtCnic:{
                required :true,
                sizeMatch:15,
                patternMatch: /([\d]{5}[-][\d]{7}[-][\d]{1})/
            }
        },
        messages:{

            ddPersonType:{
                personTypeDropDown : "Please Select Person Type"
            },
            txtCode:{
                required: "Code required."
            },
            txtRegID:{
                required: "Register ID  required.",
                maxlength: "Length must be less than 9.",
                vehicleRegID : "Invalid ID with respect to person type."
            },
            txtCnic:{
                required : "CNIC required",
                sizeMatch: "length must be 15 number including dash(-)",
                patternMatch: "Invalid pattern , e.g xxxxx-xxxxxxx-x"
            }
        }
    });//#formRegVehicle end

//---------------  Progress Admin Validation -----------------------
    //p_admin.php #fProAdmin
    $("#fProAdmin").validate({

        rules:{
            txtCode:{
                required: true
            },
            txtRegID:{
                required: true,
                minlength:1 ,
                maxlength:5 ,
                number :true
            },
            txtPassword:{
                required :true,
                minlength:8,
                maxlength:50,
                patternNotAllow: /\s+/
            }
        },
        messages:{
            txtCode:{
                required: "Code required."
            },
            txtRegID:{
                required: "Employee ID  required.",
                minlength: "Length must be greater than equal to 1" ,
                maxlength: "Length must be less than 5" ,
                number : "Invalid ID, only numbers are allowed."
            },
            txtPassword:{
                required : "Password required",
                minlength:"Password must be greater than 8 characters",
                maxlength:"Password must be less than 50 characters",
                patternNotAllow: "white spaces are not allowed"
            }
        }
    });//#formStafftVerify end


 //p_update_admin.php #fUProAdmin
    $("#fUProAdmin").validate({

        rules:{
            txtRegID:{
                required: true,
                minlength:1 ,
                maxlength:5 ,
                number :true
            },
            txtCnic:{
                required :true,
                sizeMatch:15,
                patternMatch: /([\d]{5}[-][\d]{7}[-][\d]{1})/
            },
            txtUserName:{
                required :true ,
                minlength:5,
                maxlength:20,
                patternNotAllow: /\s+/
            },
            txtPassword:{
                minlength:8,
                maxlength:50,
                patternNotAllow: /\s+/
            },
            ddAdminType:{
                checkDropDown :true

            },
            txtQuestion :{
                minlength: 8 ,
                maxlength: 20 ,
                patternNotAllow: /\s+/
            }
        },
        messages:{
            txtRegID:{
                required: "Employee ID  required.",
                minlength: "Length must be greater than equal to 1" ,
                maxlength: "Length must be less than 5" ,
                number : "Invalid ID, only numbers are allowed."
            },
            txtCnic:{
                required : "CNIC required",
                sizeMatch: "length must be 15 number including dash(-)",
                patternMatch: "Invalid pattern , e.g xxxxx-xxxxxxx-x"
            },
            txtUserName:{
                minlength:"Password must be greater than 8 characters",
                maxlength:"Password must be less than 50 characters",
                patternNotAllow: "white spaces are not allowed"
            },
            txtPassword:{
                minlength:"Password must be greater than 8 characters",
                maxlength:"Password must be less than 50 characters",
                patternNotAllow: "white spaces are not allowed"
            },
            ddAdminType:{
                checkDropdown :"Please select admin type"
            },
            txtQuestion:{
                minlength: "Length must be greater than 8" ,
                maxlength: "Length must be less than 20" ,
                patternNotAllow: "white spaces are not allowed"
            }
        }
    });//#fUProAdmin end


});//function end

