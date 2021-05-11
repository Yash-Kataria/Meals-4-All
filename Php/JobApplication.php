<?php
    if(isset($_POST["btnsubmit"]))
    {
        $con=new mysqli("localhost","root","","meals-4-all");
        if(isset($con->connect_error))
        {
            die("<script>alert('Connection Not Established with the Database..!!')</script>");
        }
        else
        {            
            $EmailId=$_POST["emailid"];
            $result=$con->query("Select * from Jobapplicant where EmailId='$EmailId'");
            if($result->num_rows!=0)
            {
                echo ("<script LANGUAGE='JavaScript'>
                window. alert('You have already applied for the JOB.!\\nWe'll reach back to you soon.!');
                window. location. href='../Login.php';
                </script>");
                // echo("<script>alert('You are already registered.!')</script>");
                // header("location: ../Login.php");
            }
            else
            {
                $imgtype=array("image/png","image/gif","image/jpg","image/jpeg");
                if($_FILES["photo"]["name"] == "")
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Upload Profile Photo\\n\\nFile Should be .PNG, .GIF or .JPG');
                    window. location. href='../JobApplication.html';
                    </script>");
                }
                else if(!(in_array($_FILES["photo"]["type"], $imgtype)))
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Unsupported File Type Uploaded for Profile Photo\\n\\nFile Should be .PNG, .GIF or .JPG');
                    window. location. href='../JobApplication.html';
                    </script>");
                }
                else if($_FILES["photo"]["size"]>=1000000)         //1 Mb=1000000 bytes
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Unsupported File Size Uploaded for Profile Photo\\n\\nMaximum Size 1 Mb');
                    window. location. href='../JobApplication.html';
                    </script>");
                }
                if($_FILES["licencephoto"]["name"] == "")
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Upload Licence Photo\\n\\nFile Should be .PNG, .GIF or .JPG');
                    window. location. href='../JobApplication.html';
                    </script>");
                }
                else if(!(in_array($_FILES["licencephoto"]["type"], $imgtype)))
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Unsupported File Type Uploaded for Licence Photo\\n\\nFile Should be .PNG, .GIF or .JPG');
                    window. location. href='../JobApplication.html';
                    </script>");
                }
                else if($_FILES["licencephoto"]["size"]>=1000000)         //1 Mb=1000000 bytes
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Unsupported File Size Uploaded for Licence Photo\\n\\nMaximum Size 1 Mb');
                    window. location. href='../JobApplication.html';
                    </script>");
                }
                else
                {
                    // $destination="..//Images//Customer_Photo//";
                    $profilephotodestination="..\\Images\\Applicant_Photo\\";
                    $check= move_uploaded_file($_FILES["photo"]["tmp_name"], $profilephotodestination.$_FILES["photo"]["name"]);
                    if($check==FALSE)
                    {
                        die("<script LANGUAGE='JavaScript'>
                        window. alert('Profile Photo File NOT Uploaded.!');
                        window. location. href='../JobApplication.html';
                        </script>");
                    }
                    
                    $licencephotodestination="..\\Images\\Licence_Photo\\";
                    $check= move_uploaded_file($_FILES["licencephoto"]["tmp_name"], $licencephotodestination.$_FILES["licencephoto"]["name"]);
                    if($check==FALSE)
                    {
                        die("<script LANGUAGE='JavaScript'>
                        window. alert('Licence Photo File NOT Uploaded.!');
                        window. location. href='../JobApplication.html';
                        </script>");
                    }
                }
                if($_POST["firstname"]=="")
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Enter Valid First Name..!!');
                    window. location. href='../JobApplication.html';
                    </script>");
                }
                else if($_POST["lastname"]=="")
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Enter Valid Last Name..!!');
                    window. location. href='../JobApplication.html';
                    </script>");
                }
                else if($_POST["gender"]=="")
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Enter Valid Gender..!!');
                    window. location. href='../JobApplication.html';
                    </script>");
                }
                else if($_POST["birthdate"]=="")
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Enter Valid Birthdate..!!');
                    window. location. href='../JobApplication.html';
                    </script>");
                }
                else if($_POST["emailid"]=="" || !(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $_POST["emailid"])))
                {  
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Enter Valid Email Id..!!\\n Example :- abc@gmail.com');
                    window. location. href='../JobApplication.html';
                    </script>");
                }
                else if($_POST["phoneno"]=="" || !(preg_match('/((\+*)((0[ -]+)*|(91 )*)(\d{12}+|\d{10}+))|\d{5}([- ]*)\d{6}/', $_POST["phoneno"])))
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Enter Valid Mobile Number..!!\\n Example :- +91 9876543210');
                    window. location. href='../JobApplication.html';
                    </script>");
                }
                else if($_POST["address"]=="" && strlen($_POST["address"])>=200)
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Select a Valid Address and should be less than 200 words..!!');
                    window. location. href='../JobApplication.html';
                    </script>");
                }
                else if($_POST["licenceno"]=="" || !(preg_match('/(([A-Z]{2}[0-9]{2})( )|([A-Z]{2}-[0-9]{2}))((19|20)[0-9][0-9])[0-9]{7}$/', $_POST["licenceno"])))
                {
                    die("<script LANGUAGE='JavaScript'>
                    window. alert('Please Enter Valid Indian Licence Number..!!\\n Example :- GJ-1320120123456');
                    window. location. href='../JobApplication.html';
                    </script>");
                }
                else
                {
                    $ApplicantName=($_POST["firstname"]." ".$_POST["lastname"]);
                    $Gender=$_POST["gender"];
                    $Birthdate=$_POST["birthdate"];
                    $EmailId=$_POST["emailid"];
                    $PhoneNo="";
                    if(strlen($_POST["phoneno"])>10)
                    {
                        $PhoneNo=$_POST["phoneno"];
                    }
                    else
                    {
                        $PhoneNo="+91 ".$_POST["phoneno"];
                    }
                    $Photo=$_FILES['photo']['name'];
                    $LicencePhoto=$_FILES['licencephoto']['name'];
                    $Address=($_POST["address"]);
                    $Licenceno=$_POST["licenceno"];
                    
                    $result=$con->query("Insert into JobApplicant(ApplicantName,Gender,Birthdate,EmailId,PhoneNo,Address,Photo,LicencePhoto,LicenceNo,Status) "
                                        . "values('$ApplicantName','$Gender','$Birthdate','$EmailId','$PhoneNo','$Address','$Photo','$LicencePhoto','$Licenceno','Pending')");
                    if($result==true)
                    {
                        echo ("<script LANGUAGE='JavaScript'>
                        window. alert('Your Job Application Form for delivery agent has been registered successfully..!!');
                        window. location. href='../Login.php';
                        </script>");
                        // echo "<script>alert('Registration Done Successfully..!!')</script>";
                        // header("location:Login.php");
                    }
                    else
                    {
                        die("<script LANGUAGE='JavaScript'>
                        window. alert('Data NOT Inserted Successfully\\n\\n'.$con->error.');
                        window. location. href='../JobApplication.html';
                        </script>");
                    }            
                }
            }
        }
        $con->close();
    }
?>