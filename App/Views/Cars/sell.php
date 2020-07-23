<?php require_once 'App/Views/inc/header.php'; ?>
<div class="row">
    <div class="col-8 mx-auto bg-white py-3 border border-dark">
        <h3>sell your car</h3>
        <hr>
        <form action="<?php echo ROOT;?>/cars/sell" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="sell_brand">Brand:</label>
            <select class="custom-select" id="sell_brand" name="sell_brand">
                <option selected value="BMW">BMW</option>
                <option value="Benz">Mercedes-Benz</option>
                <option value="VW">VW</option>
                <option value="Opel">Opel</option>
                <option value="Audi">Audi</option>
            </select>
        </div>
            <div class="form-group">
                <label for="sell_model">Select model<sup>*</sup></label>
                <input type="text" class="form-control" name="sell_model">
            </div>
            <div class="form-group">
                <label for="sell_picture">Select picture<sup>*</sup></label>
                <input type="file" class="form-control <?php echo (!empty($picture_err)) ? 'is-invalid' : "";?>" name="sell_picture" id="file">
                <span class="invalid-feedback"><?php echo isset($picture_err) ? $picture_err : '';?></span>
            </div>
            <div class="form-group">
                <label for="sell_year">Year of product</label>
                <select class="custom-select" id="sell_year" name="sell_year">
                    <option selected value="2020">2020</option>
                    <option value="2019">2019</option>
                    <option value="2018">2018</option>
                    <option value="2017">2017</option>
                    <option value="2016">2016</option>
                    <option value="2015">2015</option>
                    <option value="2014">2014</option>
                    <option value="2013">2013</option>
                    <option value="2012">2012</option>
                    <option value="2011">2011</option>
                    <option value="2010">2010</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sell_price">Price<sup>*</sup>:</label>
                <input type="text" name="sell_price" class="form-control <?php echo (!empty($price_err)) ? 'is-invalid' : "";?>" value="<?php echo isset($price) ? $price : '';?>">
                <span class="invalid-feedback"><?php echo isset($price_err) ? $price_err : '';?></span>
            </div>
            <div class="form-group">
                <label for="sell_distance">Distance gone:</label>
                <input type="text" name="sell_distance" class="form-control <?php echo (!empty($distance_err)) ? 'is-invalid' : "";?>" value="<?php echo isset($distance) ? $distance : '';?>">
                <span class="invalid-feedback"><?php echo isset($distance_err) ? $distance_err : '';?></span>
            </div>
            <div class="form-group">
                <label for="sell_power">Power:</label>
                <input type="text" name="sell_power" class="form-control <?php echo (!empty($power_err)) ? 'is-invalid' : "";?>" value="<?php echo isset($power) ? $power : '';?>">
                <span class="invalid-feedback"><?php echo isset($power_err) ? $power_err : '';?></span>
            </div>
            <div class="form-group">
                <label for="sell_co_value">Value of CO2 :</label>
                <input type="text" name="sell_co_value" class="form-control <?php echo (!empty($co_value_err)) ? 'is-invalid' : "";?>" value="<?php echo isset($co_value) ? $co_value : '';?>">
                <span class="invalid-feedback"><?php echo isset($co_value_err) ? $co_value_err : '';?></span>
            </div>
            <div class="form-check form-check-inline my-2">
                <span class="mr-4">Gearbox:</span>
                <input class="form-check-input my-3" type="radio" name="sell_transmition" value="manual" checked>
                <label class="form-check-label" for="sell_transmition">
                    Manual
                </label>
                <input class="form-check-input my-3 ml-4" type="radio" name="sell_transmition" value="automatic" >
                <label class="form-check-label" for="sell_transmition">
                    Automatic
                </label>
            </div>
            <div class="form-check form-check-inline my-2">
                <span class="mr-4">Status:</span>
                <input class="form-check-input my-3" type="radio" name="sell_status" value="new" checked>
                <label class="form-check-label" for="sell_status">
                    New
                </label>
                <input class="form-check-input my-3 ml-4" type="radio" name="sell_status" value="second-hand" >
                <label class="form-check-label" for="sell_status">
                    Second Hand
                </label>
            </div>
            <div class="form-group">
                <label for="sell_owner">Vichele Owner(s):</label>
                <select class="custom-select" id="sell_owner" name="sell_owner">
                    <option selected value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sell_fuel">Fuel:</label>
                <select class="custom-select" id="sell_fuel" name="sell_fuel">
                    <option selected value="benzin">benzin</option>
                    <option value="gas">gas</option>
                    <option value="dissel">dissel</option>
                </select>
            </div>
            <div class="form-group">
                <label for="sell_fuel_consumes">Value fuel consumes per 100km :</label>
                <input type="text" name="sell_fuel_consumes" class="form-control <?php echo (!empty($fuel_consumes_err)) ? 'is-invalid' : "";?>" value="<?php echo isset($fuel_consumes) ? $fuel_consumes : '';?>">
                <span class="invalid-feedback"><?php echo isset($fuel_consumes_err) ? $fuel_consumes_err : '';?></span>
            </div>
            <input type="submit" class="btn btn-info btn-block" value="Post">
        </form>
    </div>
</div>


<?php require_once 'App/Views/inc/footer.php'; ?>