<?php
namespace App\Controllers;
use App\Models\Car;
use Core\Controller;
use Core\View;
use App\Models\User;

class Users extends Controller
{
    public function registerAction()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'email_err' => '',
                'phone_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            //Validate Email
            if (empty($data['email'])){
                $data['email_err'] = 'Please Enter Your  Email';
            } elseif (User::getUserByEmail($data['email'])){
                $data['email_err'] = 'This email already exists';
            }
            //validate phone
            if (empty($data['phone'])){
                $data['phone_err'] = 'Please Enter Your Phone Number';
            } elseif (strlen($data['phone']) < 10){
                $data['phone_err'] = 'Invalid Phone Number';
            } elseif (User::getUserByPhone($data['phone'])){
                $data['phone_err'] = 'This Phone Number Already Exists';
            }elseif (!is_numeric($data['phone'])){
                $data['phone_err'] = 'Phone number Should Only have Numbers';
            }
            //validate password
            if (empty($data['password'])){
                $data['password_err'] = 'Please Enter Password';
             }elseif (strlen($data['password']) < 6){
                $data['password_err'] = 'Password Should have at least 6 characters';
            }
            //validate password
            if (empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please Confirm Your password';
            } elseif ($data['password'] != $data['confirm_password']){
                $data['confirm_password_err'] = 'Password do not match';
            }
            //validate All
            if (empty($data['email_err']) && empty($data['phone_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) ){
                //validated
                $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);
                if (User::registerUser($data)){
                    flash('register_success', 'You are registered and can log in');
                    redirect('users/login');
                }
            }else {
                View::render('Users/register.php',$data);
            }

        }else {
            $data = [
                'email' => '',
                'phone' => '',
                'password' => '',
                'confirm_password' => '',
                'email_err' => '',
                'phone_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            View::render('Users/register.php',$data);
        }
    }
    public function loginAction()
    {
        if ($_SERVER['REQUEST_METHOD'] =='POST'){
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($_POST['lemail']),
                'password' => trim($_POST['lpassword']),
                'email_err' => '',
                'password_err' => ''
            ];

            //validate email
            if (empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            } elseif (User::getUserByEmail($data['email'])){

            } else {
                $data['email_err'] = 'Invalid Email';
            }
            //validate password
            if (empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }

            if (empty($data['email_err']) && empty($data['password_err'])){
                $loggedin = User::loginUser($data['email'],$data['password']);
                if ($loggedin){
                    //create session
                    $this->createUserSession($loggedin);
                } else {
                    $data['password_err'] = 'Invalid Password';
                    View::render('Users/login.php',$data);
                }
            }else {
                View::render('Users/login.php',$data);
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            View::render('Users/login.php',$data);
        }

    }
    public function postAction()
    {
        if (!isLoggedIn()){
            redirect('users/login');
        }
        date_default_timezone_set("Asia/Tehran");
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $res = $this->upload();
            $data = [
                'brand' => $_POST['sell_brand'],
                'user_id' => $_SESSION['user_id'] ,
                'model' => trim($_POST['sell_model']),
                'picture' => ($res['status'] == 1) ? $res['value'] : "",
                'year' => $_POST['sell_year'],
                'price' => trim($_POST['sell_price']),
                'distance' => trim($_POST['sell_distance']),
                'power' => trim($_POST['sell_power']),
                'co_value' => trim($_POST['sell_co_value']),
                'transmition' => $_POST['sell_transmition'],
                'status' => $_POST['sell_status'],
                'owner' => $_POST['sell_owner'],
                'fuel' => $_POST['sell_fuel'],
                'fuel_consumes' => trim($_POST['sell_fuel_consumes']),
                'picture_err' => '',
                'price_err' => '',
                'distance_err' => '',
                'power_err' => '',
                'co_value_err' => '',
                'fuel_consumes_err' => ''
            ];
            if (empty($data['price'])){
                $data['price_err'] = 'price can not be empty';
            } elseif (!is_numeric($data['price'])) {
                $data['price_err'] = 'price should be number';
            }
            if ((!empty($data['distance'])) && !is_numeric($data['distance'])){
                $data['distance_err'] = 'only number is acceptable';
            }
            if ((!empty($data['power'])) && !is_numeric($data['power'])){
                $data['power_err'] = 'only number is acceptable';
            }
            if ((!empty($data['co_value'])) && !is_numeric($data['co_value'])){
                $data['co_value_err'] = 'only number is acceptable';
            }
            if ((!empty($data['fuel_consumes'])) && !is_numeric($data['fuel_consumes'])){
                $data['fuel_consumes_err'] = 'only number is acceptable';
            }
            if ($res['status'] != 1){
                $data['picture_err'] = $res['value'];
            }



            // check if we don't have error
            if (empty($data['price_err']) && empty($data['distance_err']) && empty($data['power_err']) && empty($data['co_value_err']) && empty($data['fuel_consumes_err']) && empty($data['picture_err'])){
                if (Car::sellCar($data)){
                    flash('post_message','Car Added');
                    redirect('');
                }  else {
                    die('ERROR');
                }
            }else {
                View::render('Users/post.php',$data);
            }
        } else {
            $data = [

            ];
            View::render('Users/post.php');
        }
    }
    public function postsAction(){
        if (!isLoggedIn()){
            redirect('users/login');
        }
        $res = Car::getCarByUserId($_SESSION['user_id']);
        if ($res){
            $data = [
                'res' => $res
            ];
            View::render('Users/posts.php',$data);
        }else {
            $data = [
                'err' => 'No posts yet'
            ];
            View::render('Users/posts.php',$data);
        }
    }
    public function postdetailAction($id){
        $res = Car::getCarById($id);
        if ($res){
            $data = [
              'car' => $res
            ];
            View::render('Users/postdetail.php',$data);
        }
}
    public function deletepostAction($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $res = Car::deleteCarById($id);
            if ($res == true){
                flash('delete-car','Car successfully Deleted');
                redirect('');
            }
        }
    }
    public function editpostAction($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $res = $this->upload();
            $data = [
                'CarId' => $id,
                'brand' => $_POST['sell_brand'],
                'user_id' => $_SESSION['user_id'] ,
                'model' => trim($_POST['sell_model']),
                'picture' => ($res['status'] == 1) ? $res['value'] : "",
                'year' => $_POST['sell_year'],
                'price' => trim($_POST['sell_price']),
                'distance' => trim($_POST['sell_distance']),
                'power' => trim($_POST['sell_power']),
                'co_value' => trim($_POST['sell_co_value']),
                'transmition' => $_POST['sell_transmition'],
                'status' => $_POST['sell_status'],
                'owner' => $_POST['sell_owner'],
                'fuel' => $_POST['sell_fuel'],
                'fuel_consumes' => trim($_POST['sell_fuel_consumes']),
                'picture_err' => '',
                'price_err' => '',
                'distance_err' => '',
                'power_err' => '',
                'co_value_err' => '',
                'fuel_consumes_err' => ''
            ];
            if (empty($data['price'])){
                $data['price_err'] = 'price can not be empty';
            } elseif (!is_numeric($data['price'])) {
                $data['price_err'] = 'price should be number';
            }
            if ((!empty($data['distance'])) && !is_numeric($data['distance'])){
                $data['distance_err'] = 'only number is acceptable';
            }
            if ((!empty($data['power'])) && !is_numeric($data['power'])){
                $data['power_err'] = 'only number is acceptable';
            }
            if ((!empty($data['co_value'])) && !is_numeric($data['co_value'])){
                $data['co_value_err'] = 'only number is acceptable';
            }
            if ((!empty($data['fuel_consumes'])) && !is_numeric($data['fuel_consumes'])){
                $data['fuel_consumes_err'] = 'only number is acceptable';
            }
            if ($res['status'] != 1){
                $data['picture_err'] = $res['value'];
            }
            if (empty($data['price_err']) && empty($data['distance_err']) && empty($data['power_err']) && empty($data['co_value_err']) && empty($data['fuel_consumes_err']) && empty($data['picture_err'])){
                //update
                if (Car::updateCar($data)){
                    flash('car-update','Successfully Updated');
                    redirect('');
                }
                else {
                    die("Some thing went wrong!!");
                }
            } else {
                View::render('Users/editpost.php',$data);
            }
        }else {
            $res = Car::getCarById($id);
            $data = [
                'CarId' => $res['CarId'],
                'model' => $res['model'],
                'power' => $res['power'],
                'co_value' => $res['trash'],
                'price' => $res['price'],
                'distance' => $res['distance'],
                'fuel_consumes' => $res['consumes']
            ];
            View::render('Users/editpost.php',$data);
        }
    }
    private function upload(){
        if (isset($_FILES['sell_picture']) && (!empty($_FILES['sell_picture']['name']))){
            $target_dir = "C:/wamp641/www/khodro/public/img/uploads/";
            $target_db = "http://localhost/khodro/public/img/uploads/";
            $imageFileType = pathinfo(basename($_FILES['sell_picture']['name']), PATHINFO_EXTENSION);
            $_FILES['sell_picture']['name'] = str_replace(basename($_FILES['sell_picture']['name'],$imageFileType),date("ymdHis").'.',basename($_FILES['sell_picture']['name']));
            $target_file = $target_dir . basename($_FILES['sell_picture']['name']);
            $target_file_db = $target_db . basename($_FILES['sell_picture']['name']);
            $data = [
                'status' => 1,
                'value' => $target_file_db
            ];
            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["sell_picture"]["tmp_name"]);
            if ($check !== false) {
                $data['status'] = 1;
            } else {
                $data['value'] = 'File is not an image.';
                $data['status'] = 0;

            }
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                $data['value'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $data['status'] = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($data['status'] == 0) {
                return $data;
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["sell_picture"]["tmp_name"], $target_file)) {
                    return $data;
                } else {
                    die("Sorry, there was an error uploading your file.");
                }
            }
        }else {
            $data = [
                'status' => 0,
                'value' => 'Please Select a valid picture file'
            ];
            return $data;
        }

    }

















    public function createUserSession($user){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        redirect('');
    }
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        session_destroy();
        redirect('users/login');
    }
}