<?php
//handles all user function
class Users extends Database
{
    private $userTable = 'users';
    private $dbConnect = false;
    public function __construct()
    {
        $this->dbConnect = $this->dbConnect();
    }

    //check if logged in
    public function isLoggedIn()
    {
        if (isset($_SESSION["userid"])) {
            return true;
        } else {
            return false;
        }
    }

    //login user
    public function login()
    {
        $errorMessage = '';
        if (!empty($_POST["login"]) && $_POST["email"] != '' && $_POST["password"] != '') {
            $time = time() - 600;
            $email = $_POST['email'];
            $query = mysqli_query($this->dbConnect, "select count(*) as total_count from loginlogs where TryTime > $time and email ='$email'");
            $check_login_row = mysqli_fetch_assoc($query);
            $total_count = $check_login_row['total_count'];

            $email = $_POST['email'];
                $sqlEmail = "SELECT * FROM " . $this->userTable . " 
                WHERE email='" . $email . "'";

                $resultSet = mysqli_query($this->dbConnect, $sqlEmail);
                $isValidEmail = mysqli_num_rows($resultSet);
                if ($isValidEmail) {
            
            
            if ($total_count == 3) {
                $errorMessage = "To many failed login attempts. Please try again after 10 minutes!";
                return $errorMessage;
            } else {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $sqlQuery = "SELECT * FROM " . $this->userTable . " 
                WHERE email='" . $email . "' AND password='" . md5($password) . "'";

                $resultSet = mysqli_query($this->dbConnect, $sqlQuery);
                $isValidLogin = mysqli_num_rows($resultSet);
                if ($isValidLogin) {
                    if(!empty($_POST["remember"])) {
                        setcookie ("loginId", $email, time()+ (10 * 365 * 24 * 60 * 60));  
                        setcookie ("loginPass",	$password,	time()+ (10 * 365 * 24 * 60 * 60));
                    } else {
                        setcookie ("loginId",""); 
                        setcookie ("loginPass","");
                    }
                    $userDetails = mysqli_fetch_assoc($resultSet);
                    mysqli_query($this->dbConnect, "DELETE FROM loginlogs WHERE email='$email'");
                    $_SESSION["userid"] = $userDetails['id'];
                    $_SESSION["dept"] = $userDetails['department'];
                    if ($userDetails['user_group']) {
                        $_SESSION["admin"] = $userDetails['user_group'];
                    }
                    if ($userDetails['allowed']) {
                        $_SESSION["full"] = $userDetails['allowed'];
                    }
                    header("location: inquiry.php");
                } else {
                    $total_count++;
                    $rem_attm = 3 - $total_count;
                    if ($rem_attm == 0) {
                        $errorMessage = "To many failed login attempts. Please try again after 10 minutes!";
                    } else {
                        $errorMessage = "Please enter valid login details.<br/>$rem_attm attempts remaining";
                    }
                    $try_time = time();
                    mysqli_query($this->dbConnect, "insert into loginlogs(email,TryTime) values('$email','$try_time')");
                }
            }
                }
            else{
                $errorMessage = "Incorrect Email or Password!";
            }
        } else if (!empty($_POST["login"])) {
            $errorMessage = "Enter Both User and Password Login Details!";
        }
        return $errorMessage;
    }

    //sign up user
    public function registerUser()
    {
        $errorMessage = '';
        // receive all input values from the form
        if (!empty($_POST["register_btn"]) && $_POST["email"] != '' && $_POST["password"] != '') {
            $surname = $_POST['surname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $dob = $_POST['dob'];
            $password = ($_POST['password']);
            $password_confirm = ($_POST['password_confirm']);

            if ($password != $password_confirm) {
                $errorMessage = "The two passwords do not match";
                return $errorMessage;
            }
            $password = md5($password); //encrypt the password before saving in the database

            $user_check_query = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($this->dbConnect, $user_check_query);
            $user = mysqli_fetch_assoc($result);

            if ($user) { // if user exists
                if ($user['email'] === $email) {
                    $errorMessage = "Email Address Already Exists";
                    return $errorMessage;
                }
            }

            $insertQuery = "INSERT INTO users (email, password, firstname, surname, dob)
            VALUES('$email', '$password', '$firstname', '$surname', '$dob')";
            $userInsert = mysqli_query($this->dbConnect, $insertQuery);
            echo '<script>alert("Successfully Registered\n")</script>';

            $user_session_query = "SELECT * FROM users WHERE email='$email'";
            $resultSet = mysqli_query($this->dbConnect, $user_session_query);
            $isValidLogin = mysqli_num_rows($resultSet);
            if ($isValidLogin) {
                $userDetails = mysqli_fetch_assoc($resultSet);
                mysqli_query($this->dbConnect, "DELETE FROM loginlogs WHERE email='$email'");
                unset($_SESSION['admin']);
                unset($_SESSION['full']);
                $_SESSION["userid"] = $userDetails['id'];
                $_SESSION["dept"] = $userDetails['department'];
                if ($userDetails['user_group']) {
                    $_SESSION["admin"] = $userDetails['user_group'];
                }
                if ($userDetails['allowed']) {
                    $_SESSION["full"] = $userDetails['allowed'];
                }
                header("refresh:0;url=inquiry.php");
            } else {
                $errorMessage = "Error Creating Account, Please Try Again Later!";
                return $errorMessage;
            }
        } else if (!empty($_POST["register_btn"])) {
            $errorMessage = "Please Make Sure Everything Is Filled Correctly!";
        }
        return $errorMessage;
    }

    //sign up staff
    public function registerStaff()
    {
        $errorMessage = '';
        // receive all input values from the form
        if (!empty($_POST["staff_btn"]) && $_POST["email"] != '' && $_POST["password"] != '') {
            $surname = $_POST['surname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $dob = $_POST['dob'];
            $dept = $_POST['department'];
            $allow = isset($_POST['fullaccess']) ? 1 : 0;
            $password = ($_POST['password']);
            $password_confirm = ($_POST['password_confirm']);

            if ($password != $password_confirm) {
                $errorMessage = "The two passwords do not match";
                return $errorMessage;
            }
            $password = md5($password); //encrypt the password before saving in the database

            $user_check_query = "SELECT * FROM users WHERE email='$email'";
            $result = mysqli_query($this->dbConnect, $user_check_query);
            $user = mysqli_fetch_assoc($result);

            if ($user) { // if user exists
                if ($user['email'] === $email) {
                    $errorMessage = "Email Address Already Exists";
                    return $errorMessage;
                }
            }

            $insertQuery = "INSERT INTO users (email, password, firstname, surname, dob, department, allowed, user_group)
            VALUES('$email', '$password', '$firstname', '$surname', '$dob', '$dept', '$allow', '1' )";
            $userInsert = mysqli_query($this->dbConnect, $insertQuery);
            echo '<script>alert("User Successfully Created\n")</script>';

            $user_session_query = "SELECT * FROM users WHERE email='$email'";
            $resultSet = mysqli_query($this->dbConnect, $user_session_query);
            $isValidLogin = mysqli_num_rows($resultSet);
            if ($isValidLogin) {
                $userDetails = mysqli_fetch_assoc($resultSet);
                mysqli_query($this->dbConnect, "DELETE FROM loginlogs WHERE email='$email'");
                $_SESSION["userid"] = $userDetails['id'];
                $_SESSION["dept"] = $userDetails['department'];
                if ($userDetails['user_group']) {
                    $_SESSION["admin"] = $userDetails['user_group'];
                }
                if ($userDetails['allowed']) {
                    $_SESSION["full"] = $userDetails['allowed'];
                }
                header("refresh:0;url=logout.php");
            } else {
                $errorMessage = "Something Went Wrong";
                return $errorMessage;
            }
        } else if (!empty($_POST["register_btn"])) {
            $errorMessage = "Please Make Sure Everything Is Filled Correctly!";
        }
        return $errorMessage;
    }

    //change of password
    public function updatePassword()
    {
        $errorMessage = '';
        if (!empty($_POST["password_btn"])) {
            $password = ($_POST['password']);
            $password_confirm = ($_POST['password_confirm']);
            if ($password != $password_confirm) {
                $errorMessage = "The two passwords do not match";
                return $errorMessage;
            }
            $password = md5($password);
            $changeQuery = "UPDATE users SET password = '$password' WHERE id = '$_SESSION[userid]'";
            $isChanged = mysqli_query($this->dbConnect, $changeQuery);
            echo '<script>alert("Password has successfully changed\n")</script>';
            header("refresh:0;url=profile.php");
        } else if (!empty($_POST["password_btn"])) {
            $errorMessage = "Please Make Sure Everything Is Filled Correctly!";
        }
        return $errorMessage;
    }

    //reset password
    public function resetPassword()
    {
        $errorMessage = '';
        if (!empty($_POST["reset_btn"])) {
            $email = ($_POST['email']);
            $surname = ($_POST['surname']);
            $password = ($_POST['password']);
            $password_confirm = ($_POST['password_confirm']);
            if ($password != $password_confirm) {
                $errorMessage = "The two passwords do not match";
                return $errorMessage;
            }
            $password = md5($password);
            $sqlQuery = "SELECT * FROM " . $this->userTable . " 
            WHERE email='" . $email . "' AND surname='" . $surname . "'";

            $resultSet = mysqli_query($this->dbConnect, $sqlQuery);
            $isValidLogin = mysqli_num_rows($resultSet);
            if ($isValidLogin) {
                $changeQuery = "UPDATE users SET password = '$password' WHERE email = '$email'";
                $isChanged = mysqli_query($this->dbConnect, $changeQuery);
                echo '<script>alert("Password has successfully changed\n")</script>';
                header("refresh:0;url=login.php");
            } else {
                $errorMessage = "Incorrect Credentials: Email Or Surname";
            }
        } else if (!empty($_POST["reset_btn"])) {
            $errorMessage = "Please Make Sure Everything Is Filled Correctly!";
        }
        return $errorMessage;
    }

    //update user information
    public function updateUser()
    {
        $errorMessage = '';
        // receive all input values from the form
        if (!empty($_POST["update_btn"]) && $_POST["email"] != '' && $_POST["firstname"] != '') {
            $dept = $_POST['department'];
            $email = $_POST['email'];
            $firstname = $_POST['firstname'];
            $surname = $_POST['surname'];
            $dob = $_POST['dob'];
            $allow = isset($_POST['fullaccess']) ? 1 : 0;
            $updateQuery = "UPDATE users
            SET email = '$email', firstname = '$firstname', surname = '$surname', department = '$dept', dob = '$dob', allowed = '$allow' 
            WHERE email = '$email'";
            $isUpdated = mysqli_query($this->dbConnect, $updateQuery);
            if (!$isUpdated) {
                $errorMessage = "Could Not Updated User!";
            }
            else{
                echo '<script>alert("Updated Information Successfully\n")</script>';
                header("refresh:0;url=profile.php");
            }
        } else if (!empty($_POST["update_btn"])) {
            $errorMessage = "Please Make Sure Everything Is Filled Correctly!";
        }
        return $errorMessage;
    }

    //get user information from user table
    public function getUserInfo()
    {
        if (!empty($_SESSION["userid"])) {
            $sqlQuery = "SELECT * FROM " . $this->userTable . " 
				WHERE id ='" . $_SESSION["userid"] . "'";
            $result = mysqli_query($this->dbConnect, $sqlQuery);
            $userDetails = mysqli_fetch_assoc($result);
            return $userDetails;
        }
    }

    //get user coloum
    public function getColoumn($id, $column)
    {
        $sqlQuery = "SELECT * FROM " . $this->userTable . " 
			WHERE id ='" . $id . "'";
        $result = mysqli_query($this->dbConnect, $sqlQuery);
        $userDetails = mysqli_fetch_assoc($result);
        return $userDetails[$column];
    }
}
