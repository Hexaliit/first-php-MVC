<?php require_once 'App/Views/inc/header.php'; ?>
    <div class="col-10 mx-auto position-relative rounded">
        <img src="public/img/non-owner-xs.jpg" alt="index" class="w-100" style="height: 400px">
        <div class="col-5 bg-light position-absolute h-100" style="top: 0">
            <?php flash('post_message'); ?>
            <?php flash('delete-car'); ?>
            <?php flash('car-update'); ?>
            <h3>What are you looking for?</h3>
            <form action="<?php echo ROOT;?>/cars/show" method="post">
                <div class="form-group my-3">
                    <label for="carbrands">Brand</label>
                    <select class="custom-select" id="carbrands" name="carbrand">
                        <option selected ></option>
                        <option value="BMW">BMW</option>
                        <option value="Benz">Mercedes-Benz</option>
                        <option value="VW">VW</option>
                        <option value="Opel">Opel</option>
                        <option value="Audi">Audi</option>
                    </select>
                </div>
                <div class="form-group my-3">
                    <label for="caryear">Registration from</label>
                    <select class="custom-select" id="caryear" name="caryear">
                        <option selected></option>
                        <option value="2020">2020</option>
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
                <div class="form-group my-3">
                    <label for="carprice">Price</label>
                    <input type="text" name="carprice" class="form-control" value="" placeholder="price until">
                </div>
                <input type="submit" class="btn btn-success my-3 w-100" value="Search">
            </form>
        </div>
    </div>
<?php require_once 'App/Views/inc/footer.php'; ?>