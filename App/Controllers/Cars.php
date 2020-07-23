<?php
namespace App\Controllers;

use App\Models\Car;
use App\Models\User;
use Core\View;
use Core\Controller;

class Cars extends Controller {
public function showAction()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'brand' => $_POST['carbrand'],
            'year' => $_POST['caryear'],
            'price' => trim($_POST['carprice'])
        ];
        $res = Car::getCar($data);
        if ($res) {
            $data = [
                'cars' => $res,
                'count' => count($res)
            ];
            View::render('Cars/show.php', $data);
        } else {
            $data = [
                'cars' => '',
                'count' => '0'
            ];
            View::render('Cars/show.php', $data);
        }
    }
}




public function detailAction($id)
{
    $res = Car::getCarById($id);
    if ($res) {
        //go to detail page
        $data = [
            'car' => $res
        ];
        View::render('Cars/detail.php', $data);
    } else {
        $data = [
            'err' => 'Sorry, the item is no longer available.'
        ];
        View::render('Cars/detail.php' , $data);
    }
}
public function sellAction()
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
            View::render('Cars/sell.php',$data);
        }
    } else {
        $data = [

        ];
        View::render('Cars/sell.php');
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
}