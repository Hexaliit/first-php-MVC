<?php require_once 'App/Views/inc/header.php'; ?>
<?php if ($res) : ?>
    <?php foreach ($res as $car): ?>
        <div class="card mt-3 ml-3">
            <a href="<?php echo ROOT;?>/users/postdetail/<?php echo $car['id'];?>">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?php echo $car['picture']; ?>" alt="" class="card-img h-100 rounded-right">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="row justify-content-around">
                                <h5 class="card-title ml-2"><?php echo $car['brand'];?> : <?php echo $car['model'];?></h5>
                                <h5 class="card-title ml-5">$<?php echo $car['price'];?></h5>
                            </div>
                            <p class="card-text">
                            <table class="table table-borderless text-center">
                                <tbody>
                                <tr>
                                    <td><?php echo $car['distance'];?>  KM</td>
                                    <td><?php echo $car['date_of_product'];?></td>
                                    <td><?php echo $car['power'];?> (hp)</td>
                                </tr>
                                <tr>
                                    <td><?php echo $car['is_second'];?></td>
                                    <td><?php echo $car['owners'];?> vichele owners</td>
                                    <td><?php echo $car['transmition'];?> transmition</td>
                                </tr>
                                <tr>
                                    <td><?php echo $car['fuel'];?></td>
                                    <td><?php echo $car['consumes'];?> /100km(comb.)</td>
                                    <td><?php echo $car['trash'];?> g CO2/km(comb.)</td>
                                </tr>
                                </tbody>
                            </table>
                            </p>
                            <hr>
                            <div class="row justify-content-around">
                                <p class="card-text"><small class="text-muted">Posted at : <?php echo $car['posted_at'];?></small></p>
                                <p class="card-text"><small class="text-muted">More details...</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
<p class="bg-warning text-dark py-3"><?php echo $err;?></p>
<?php endif; ?>

<?php require_once 'App/Views/inc/footer.php'; ?>