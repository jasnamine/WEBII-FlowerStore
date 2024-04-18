                <?php
                include 'inc/header.php';
                 ?>

            <div class="app-main__outer">

                <!-- Main -->
                <div class="app-main__inner">

                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-ticket icon-gradient bg-mean-fruit"></i>
                                </div>
                                <div>
                                    Product deatil
                                    <div class="page-title-subheading">
                                        View, create, update, delete and manage.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">

                                        <div class="position-relative row form-group">
                                            <label class="col-md-3 text-md-right col-form-label">Product Name</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input disabled placeholder="Product Name" type="text"
                                                    class="form-control" value="Calvin Klein">
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="color" class="col-md-3 text-md-right col-form-label">Color</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input required name="color" id="color" placeholder="Color" type="text"
                                                    class="form-control" value="">
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="size" class="col-md-3 text-md-right col-form-label">Size</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input required name="size" id="size" placeholder="Size" type="text"
                                                    class="form-control" value="">
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group">
                                            <label for="qty" class="col-md-3 text-md-right col-form-label">Qty</label>
                                            <div class="col-md-9 col-xl-8">
                                                <input required name="qty" id="qty" placeholder="Qty" type="text"
                                                    class="form-control" value="">
                                            </div>
                                        </div>

                                        <div class="position-relative row form-group mb-1">
                                            <div class="col-md-9 col-xl-8 offset-md-2">
                                                <a href="#" class="border-0 btn btn-outline-danger mr-1">
                                                    <span class="btn-icon-wrapper pr-1 opacity-8">
                                                        <i class="fa fa-times fa-w-20"></i>
                                                    </span>
                                                    <span>Cancel</span>
                                                </a>

                                                <button type="submit"
                                                    class="btn-shadow btn-hover-shine btn btn-primary">
                                                    <span class="btn-icon-wrapper pr-2 opacity-8">
                                                        <i class="fa fa-download fa-w-20"></i>
                                                    </span>
                                                    <span>Save</span>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Main -->

                <?php
                include 'inc/footer.php';
                 ?>

    <script src="assets/scripts/jquery-3.2.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="./assets/scripts/main.js"></script>
    <script type="text/javascript" src="./assets/scripts/my_script.js"></script>
</body>

</html>