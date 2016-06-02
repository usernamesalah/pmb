<?php 
	session_start(); 
	if (!isset($_SESSION['nim']) || !isset($_SESSION['nama']) || !isset($_SESSION['role'])) {
		header("Location: login_admin.php");
		exit;
	} else {
		$nim	= $_SESSION['nim'];
		$nama	= $_SESSION['nama'];
		$role	= $_SESSION['role'];
	}

	if (isset($_GET['page'])) {
		$_SESSION['page'] = $_GET['page'];
	} else {
		$_SESSION['page'] = 1;
	}
?>

<?php include "template/header.php"; ?>

<body ng-app="DBAlumni" ng-controller="MainController2">
	<script src="https://use.fontawesome.com/b24094c187.js"></script>
	<?php include "template/navbar.php";  ?>

	<div class="container">
		<center style="margin-top: 6%; margin-bottom: 3%;">
			<h1>Manage Data</h1>
		</center>
	  	<?php if (isset($_SESSION['status']) && $_SESSION['status'] == "berhasil"): ?>
			<div style="width: 40%; margin: 0 auto;" class="alert alert-success">
				<div class="ui success message">
			  		<div class="header"><b>Sukses</b></div>
			  		<p>Anda berhasil login sebagai admin</p>
			  	</div>
			</div>
		<?php endif; ?>
		<?php if (isset($_SESSION['error']) && $_SESSION['error'] == false): ?>
			<div style="width: 40%; margin: 0 auto;" class="alert alert-success">
				<div class="ui success message">
			  		<div class="header"><b>Sukses</b></div>
			  		<p>Anda berhasil menambahkan admin</p>
			  	</div>
			</div>
		<?php elseif (isset($_SESSION['error']) && $_SESSION['error'] == true): ?>
			<div style="width: 40%; margin: 0 auto;" class="alert alert-danger">
				<div class="ui error message">
			  		<div class="header"><b>Error</b></div>
			  		<p>Anda gagal menambahkan admin</p>
			  	</div>
			</div>
		<?php endif; ?>
		<a class="btn btn-success" href="download.php?fakultas=<?= $_SESSION['role'] ?>"><i class="glyphicon glyphicon-download-alt"></i> Download Data</a>
		<a class="btn btn-warning" href="input.php"><i class="fa fa-level-down"></i> Input Data</a>
		<?php if ($role == "Super Admin"): ?>
			<a class="btn btn-primary" href="admin_list.php"><i class="fa fa-users"></i> List Admin</a>
		<?php endif; ?>
		<a class="btn btn-danger" href="edit_password.php"><i class="glyphicon glyphicon-edit"></i> Ubah Password</a>	
		<table class="table table-bordered" style="text-align: center; width: 90%; margin: 0 auto;">
		  <thead>
		    <tr><th>No</th>
		    <th>Foto</th>
		    <th>Nama</th>
		    <th>NIM</th>
		    <th>Jurusan</th>
		    <th>Fakultas</th>
		    <th>No HP</th>
		    <th></th>
		  </tr></thead>
		  <tbody ng-repeat="maba in result | orderBy:order | searchFor:searchString">
		    <tr>
		    	<td>{{ $index + 1 }}</td>
		    	<td><img src="http://www.reg.unsri.ac.id/upload/foto/maba/2016/thumbnail/{{ maba.nim }}.jpg"></td>
		    	<td>
		    		<a href="detail.php?nim={{ maba.nim }}">{{ maba.nama }}</a>
		    	</td>
		    	<td>
		    		{{ maba.nim }}
		    	</td>
		    	<td>
		    		{{ maba.jurusan }}
		    	</td>
		    	<td>
		    		{{ maba.fakultas }}
		    	</td>
		    	<td>
		    		{{ maba.no_hp }}
		    	</td>
		    	<td>
		    		<a class="btn btn-primary" href="edit.php?nim={{ maba.nim }}">
					  <i class="glyphicon glyphicon-pencil"></i> Edit
					</a>
		    	</td>
		    </tr>
		  </tbody>
		</table>
		<div class="row">
			<div class="col-md-6">
					<?php if (isset($_GET['page'])): ?>
						<a class="pull-left" href="http://pmb.bem.unsri.ac.id/admin.php?page=<?= $_GET['page'] - 1 ?>">&lt; Previous</a>
					<?php endif; ?>
			</div>
			<div class="col-md-6">
					<?php if (isset($_GET['page']) && $_GET['page'] != 1): ?>
						<a class="pull-right" href="http://pmb.bem.unsri.ac.id/admin.php?page=<?= $_GET['page'] + 1 ?>">Next &gt;</a>
					<?php else: ?>
						<a class="pull-right" href="http://pmb.bem.unsri.ac.id/admin.php?page=2">Next &gt;</a>
					<?php endif; ?>
			</div>
		</div>
	</div>

	<?php include "template/footer.php"; ?>
</body>
</html>
<?php 
	unset($_SESSION['status']);
	unset($_SESSION['error']);
?>