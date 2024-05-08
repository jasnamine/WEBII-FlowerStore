<?php
require_once '../lib/database.php';
require_once '../lib/session.php';

// Ban Admin Function
function ban_admin($username) {
        $sql = "UPDATE admins SET active = 0 WHERE admin_username = :username";
        $result = query($sql, [':username' => $username]); // Utilizing the existing query function
        
        if ($result) {
            setFlashData("success", "Admin has been banned successfully.");
            // Admin has been banned successfully
            return true;
        } else {
          setFlashData("error", "Admin not found or failed to ban the admin.");
            // Handle ban failure
            return false;
        }
    
}

function unban_admin($username) {
   $data = array(
       'active' => '1'
   );

   $condition = "admin_username = '$username'";
   update('admins', $data, $condition, array(':username' => $username));
}

if (isset($_GET['ban'])) {
   $username = $_GET['ban'];
   ban_admin($username);
}

if (isset($_GET['unban'])) {
   $username = $_GET['unban'];
   unban_admin($username);
}


// truy vấn vào bảng users
$listUsers = getRow("SELECT admin_username, admin_email, active FROM admins ORDER BY admin_username");
        // echo '<pre>';
        // print_r($listUsers);
        // echo '</pre>';
?>
<?php
include 'inc/header.php'
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
                        Admin
                        <div class="page-title-subheading">
                            View, create, update, delete and manage.
                        </div>
                    </div>
                </div>

                <div class="page-title-actions">
                    <a href="./user-create.php" class="btn-shadow btn-hover-shine mr-3 btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus fa-w-20"></i>
                        </span>
                        Create
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">
                        <form>
                            <div class="input-group">
                                <input type="search" name="search" id="search" placeholder="Search everything"
                                    class="form-control" />
                                <span class="input-group-append">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-search"></i>&nbsp; Search
                                    </button>
                                </span>
                            </div>
                        </form>

                        <div class="btn-actions-pane-right">
                            <div role="group" class="btn-group-sm btn-group">
                                <button class="btn btn-focus">This week</button>
                                <button class="active btn btn-focus">Anytime</button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th>Full Name</th>
                                    <th class="text-center">Email</th>

                                    <th class="text-center">Actions</th>
                                    <th class="text-center">Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        if(!empty($listUsers)):
                          $count = 0;
                          foreach($listUsers as $item):
                          $count++;
                        
                        ?>
                                <tr>
                                    <td class="text-center text-muted"><?php echo $count; ?></td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img width="40" class="rounded-circle" data-toggle="tooltip"
                                                            title="Image" data-placement="bottom"
                                                            src="assets/images/_default-user.png" alt="" />
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading"><?php echo $item['admin_username'];?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><?php echo $item['admin_email'];?></td>

                                    <td class="text-center">
                                        <a href="./user-show.php"
                                            class="btn btn-hover-shine btn-outline-primary border-0 btn-sm">
                                            Details
                                        </a>
                                        <a href="./user-edit.php" data-toggle="tooltip" title="Edit"
                                            data-placement="bottom" class="btn btn-outline-warning border-0 btn-sm">
                                            <span class="btn-icon-wrapper opacity-8">
                                                <i class="fa fa-edit fa-w-20"></i>
                                            </span>
                                        </a>

                                    </td>

                                    <td class="text-center">
                                        <?php if ($item['active']) : ?>
                                        <button style="width: 45%;" class="btn btn-danger btn-sm"
                                            onclick="confirmBan('<?php echo $item['admin_username']; ?>')">Ban</button>
                                        <?php else : ?>
                                        <button style="width: 45%;" class="btn btn-success btn-sm"
                                            onclick="confirmUnban('<?php echo $item['admin_username']; ?>')">Unban</button>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                                <?php
                        endforeach;
                        endif;
                        ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-block card-footer">
                        <nav role="navigation" aria-label="Pagination Navigation"
                            class="flex items-center justify-between">
                            <div class="flex justify-between flex-1 sm:hidden">
                                <span
                                    class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                    « Previous
                                </span>

                                <a href="#page=2"
                                    class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                    Next »
                                </a>
                            </div>

                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700 leading-5">
                                        Showing
                                        <span class="font-medium">1</span>
                                        to
                                        <span class="font-medium">5</span>
                                        of
                                        <span class="font-medium">9</span>
                                        results
                                    </p>
                                </div>

                                <div>
                                    <span class="relative z-0 inline-flex shadow-sm rounded-md">
                                        <span aria-disabled="true" aria-label="&amp;laquo; Previous">
                                            <span
                                                class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5"
                                                aria-hidden="true">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </span>

                                        <span aria-current="page">
                                            <span
                                                class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5">1</span>
                                        </span>
                                        <a href="#page=2"
                                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150"
                                            aria-label="Go to page 2">
                                            2
                                        </a>

                                        <a href="#page=2" rel="next"
                                            class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
                                            aria-label="Next &amp;raquo;">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Main -->

</div>
<?php
          include 'inc/footer.php';
          ?>
</div>

<!-- Modal Confirm
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Xác nhận hành động</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="confirmText"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-primary" id="confirmAction">Xác nhận</button>
      </div>
    </div>
  </div>
</div> -->

<script>
function confirmBan(username) {
    if (confirm('Bạn có chắc muốn khóa admin này không?')) {
        window.location.href = 'admin.php?ban=' + username;
    }
}

function confirmUnban(username) {
    if (confirm('Bạn có chắc muốn mở khóa admin này không?')) {
        window.location.href = 'admin.php?unban=' + username;
    }
}
</script>