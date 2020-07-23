<?php require_once 'App/Views/inc/header.php'; ?>
<?php if ($car) : ?>
        <div class="card mt-3 ml-3">
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
                                <a href="<?php echo ROOT;?>/users/editpost/<?php echo $car['CarId'];?>" class="btn btn-dark"><span class="fa fa-pencil px-2">Edit</span></a>
                                <form action="<?php echo ROOT;?>/users/deletepost/<?php echo $car['CarId'];?>" method="post">
                                    <input type="submit" class="btn btn-danger" value="Remove">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
        </div>
<?php else: ?>
    <p class="bg-warning text-dark py-3">Invalid Action</p>
<?php endif; ?>

<?php require_once 'App/Views/inc/footer.php'; ?>