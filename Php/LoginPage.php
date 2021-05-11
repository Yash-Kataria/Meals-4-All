<?php
		if(isset($_POST["btnsubmit"]))
		{
			//For Validation
			if(($_POST["emailid"]=="" || !(preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $_POST["emailid"]))))
			{    
				die("<script LANGUAGE='JavaScript'>
				window. alert('Please Enter Valid Email Id..!!\\n\\n Example :- abc@gmail.com');
				window. location. href='../Login.php';
				</script>");
			}
			else if($_POST["password"]=="" || !(preg_match('/^[A-Z][a-z]{1,}[^a-zA-Z0-9][0-9]{1,}$/', $_POST["password"])))
			{           
				die("<script LANGUAGE='JavaScript'>
				window. alert('Please Enter Valid Password..!!\\n\\n Example :- 12345');
				window. location. href='../Login.php';
				</script>");
			}
			else
			{
				$con=new mysqli("localhost","root","","meals-4-all");
				if(isset($con->connect_error))
				{
					die("<script LANGUAGE='JavaScript'>
					window. alert('Connection Not Established with the Database..!!');
					window. location. href='../Login.php';
					</script>");
				}
				//For Admin Verification
				if(strcasecmp("@mca.christuniversity.in", substr($_POST["emailid"],strpos($_POST["emailid"],"@"),strlen($_POST["emailid"])))==0)
				{
					$result=$con->query("Select AdminId,EmailID,Password from Admin");
					if($result->num_rows!=0)
					{
						$count=0;
						while($verify=$result->fetch_object())
						{
							if(strcasecmp($verify->EmailID, $_POST["emailid"])==0 && strcasecmp($verify->Password, $_POST["password"])==0)
							{
								$count=1;
								if(isset($_POST["remembermebox"]))
								{
									setcookie("EmailId", $_POST["emailid"],time()+60*60*24*30);
									setcookie("Password", $_POST["password"],time()+60*60*24*30);
									session_start();
									$_SESSION["AdminId"]=$verify->AdminId;
									$_SESSION["EmailId"]=$_POST["emailid"];
									// header("location:../Admin/AdminHomepage.php");
									echo("<script LANGUAGE='JavaScript'>
									window.location.href='../Admin/AdminHomepage.php';
									</script>");
								}
								else
								{
									session_start();
									$_SESSION["AdminId"]=$verify->AdminId;
									$_SESSION["EmailId"]=$_POST["emailid"];
									// header("location:../Admin/AdminHomepage.php");
									echo("<script LANGUAGE='JavaScript'>
									window.location.href='../Admin/AdminHomepage.php';
									</script>");
								}
							}
						}
						if($count==0)
						{
							die("<script LANGUAGE='JavaScript'>
							window. alert('You are not an authorized system administrator.!');
							window. location. href='../Login.php';
							</script>");
						}
					}
				}
				//For Normal User Verification             
				else if(strcasecmp("@gmail.com", substr($_POST["emailid"],strpos($_POST["emailid"],"@"),strlen($_POST["emailid"])))==0)    
				{           
					$result=$con->query("Select CustomerId,EmailId,Password from Customer");
					if($result->num_rows!=0)
					{
						$count=0;
						while($verify=$result->fetch_object())
						{
							if(strcasecmp($verify->EmailId, $_POST["emailid"])==0 && strcasecmp($verify->Password, $_POST["password"])==0)
							{
								$count=1;
								if(isset($_POST["remembermebox"]))
								{
									setcookie("EmailId", $_POST["emailid"],time()+60*60*24*30);
									setcookie("Password", $_POST["password"],time()+60*60*24*30);
									session_start();
									$_SESSION["CustomerId"]=$verify->CustomerId;
									$_SESSION["EmailId"]=$_POST["emailid"];
									// header("location:../Customer/CustomerHomepage.php");
									echo("<script LANGUAGE='JavaScript'>
									window. location. href='../Customer/CustomerHomepage.php';
									</script>");
								}
								else
								{
									session_start();
									$_SESSION["CustomerId"]=$verify->CustomerId;
									$_SESSION["EmailId"]=$_POST["emailid"];
									// header("location:../Customer/CustomerHomepage.php");
									echo("<script LANGUAGE='JavaScript'>
									window. location. href='../Customer/CustomerHomepage.php';
									</script>");
								}
							}
						}
						if($count==0)
						{
							die("<script LANGUAGE='JavaScript'>
							window. alert('You have not registered yet, Register Now.!');
							window. location. href='../CustomerRegistration.html';
							</script>");
						}
					}
					else
					{
						die("<script LANGUAGE='JavaScript'>
                        window. alert('Server is Down..Sorry for the Inconvenience.\\n\\n'.$con->error.');
                        window. location. href='../Login.php';
                        </script>");
					}
				}
				$con->close();
			}
		}
            
        ?>