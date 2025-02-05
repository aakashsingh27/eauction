<?php include 'header.php'; ?>
<div id="layoutSidenav_content">
<main>
<div class="container-fluid">
<h2 class="mt-30 page-title">Menu Management</h2>
<ol class="breadcrumb mb-30">
<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
<li class="breadcrumb-item active">Menu Management</li>
</ol>
<div class="row justify-content-between">
<div class="col-lg-12">
<a href="add_menu.php" class="add-btn hover-btn">Add New Menu</a>
</div>
<div class="col-lg-12 col-md-12">
<div class="card card-static-2 mt-30 mb-30">
<div class="card-title-2">
<h4>All Menu</h4>
</div>
<div class="card-body-table">
<div class="table-responsive">
<table class="table ucp-table table-hover">
<thead>
<tr>
<th>Title</th>
<th>Use For</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<tr>
<td>Main Menu</td>
<td>Primary</td>
<td>Created 5 May 2020</td>
<td class="action-btns">
<a href="#" class="edit-btn"><i class="fas fa-edit"></i></a>
</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</main>


<?php include 'chatbox.php'; ?>
<?php include 'footer.php'; ?>