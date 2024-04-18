<?php
include 'include/header.php';

?>
    <section
      class="hero-wrap hero-wrap-2"
      style="background-image: url('images/bg_2.jpg')"
      data-stellar-background-ratio="0.5"
    >
      <div class="overlay"></div>
      <div class="container">
        <div
          class="row no-gutters slider-text align-items-end justify-content-center"
        >
          <div class="col-md-9 ftco-animate mb-5 text-center">
            <p class="breadcrumbs mb-0">
              <span class="mr-2"
                ><a href="index.html"
                  >Home <i class="fa fa-chevron-right"></i></a
              ></span>
              <span>My account <i class="fa fa-chevron-right"></i></span>
            </p>
            <h2 class="mb-0 bread">My account</h2>
          </div>
        </div>
      </div>
    </section>

        <!-- My Account Start -->
        <div class="my-account">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="dashboard-nav" data-toggle="pill" href="#dashboard-tab" role="tab">Dashboard</a>
                            <a class="nav-link" id="orders-nav" data-toggle="pill" href="#orders-tab" role="tab">Orders</a>
                            <a class="nav-link" id="account-nav" data-toggle="pill" href="#account-tab" role="tab">Account Details</a>
                            <a class="nav-link" href="index.php">Logout</a>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content">

                            <div class="tab-pane fade" id="orders-tab" role="tabpanel" aria-labelledby="orders-nav">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Product</th>
                                                <th>Date</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Product Name</td>
                                                <td>01 Jan 2020</td>
                                                <td>$22</td>
                                                <td>Approved</td>
                                                <td><button>View</button></td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Product Name</td>
                                                <td>01 Jan 2020</td>
                                                <td>$22</td>
                                                <td>Approved</td>
                                                <td><button>View</button></td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>Product Name</td>
                                                <td>01 Jan 2020</td>
                                                <td>$22</td>
                                                <td>Approved</td>
                                                <td><button>View</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            
                            <div class="tab-pane fade" id="account-tab" role="tabpanel" aria-labelledby="account-nav">
                                <h4>Account Details</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input class="input-account" type="text" placeholder="User name">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="input-account" type="text" placeholder="Mobile">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="input-account" type="text" placeholder="Email">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="input-account" type="text" placeholder="Address">
                                    </div>
                                    <div class="col-md-6">
                                        <button class="button-account">Update Account</button>
                                        
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- My Account End -->

 <?php
include 'include/footer.php';
?>