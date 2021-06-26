<script src='jquery-3.3.1.min.js' type='text/javascript'></script>

<input type='hidden' id='sort' value='asc'>
<div class="table-responsive" style="width: 90%;">
	<table class="table table-bordered table-striped" id='empTable'>
		<thead>
			<tr>
				<th><span onclick='sortTable("tgl");'>Tanggal</span></th>
				<th><span onclick='sortTable("username");'>Username</span></th>
				<th><span onclick='sortTable("fieldnum");'>No. Lapangan</span></th>
				<th><span onclick='sortTable("price");'>Harga</span></th>
				<th><span onclick='sortTable("status");'>Status</span></th>
				<th>Aksi</th>
			</tr>
		</thead>
		<?php
		include "dbConnect.php";


		if (isset($_POST['search']) && $_POST['search'] == true) {
			$param = '%' . mysqli_real_escape_string($db_connection, $keyword) . '%';

			$sql = mysqli_query($db_connection, "SELECT * FROM booking WHERE username LIKE '" . $param . "' OR tgl LIKE '" . $param . "' OR phonenum like '" . $param . "'");

			$sql2 = mysqli_query($db_connection, "SELECT COUNT(*) AS jumlah FROM booking WHERE username LIKE '" . $param . "' OR tgl LIKE '" . $param . "' OR tipe LIKE '" . $param . "' OR phonenum like '" . $param . "'");
			$get_jumlah = mysqli_fetch_array($sql2);

			$sql3 = mysqli_query($db_connection, "SELECT sum(price) as total from booking WHERE username LIKE '" . $param . "' OR tgl LIKE '" . $param . "' OR tipe LIKE '" . $param . "' OR phonenum like '" . $param . "'");
			$data2 = mysqli_fetch_array($sql3);

			$sqlacc = mysqli_query($db_connection, "SELECT COUNT(*) AS jumlahaccept FROM booking where status ='Accepted' AND username LIKE '" . $param . "' OR tgl LIKE '" . $param . "' OR tipe LIKE '" . $param . "' OR phonenum like '" . $param . "'");
			$get_sqlacc = mysqli_fetch_array($sqlacc);
		} else {
			$sql = mysqli_query($db_connection, "select * from booking order by tgl desc");

			$sql2 = mysqli_query($db_connection, "SELECT COUNT(*) AS jumlah FROM booking");
			$get_jumlah = mysqli_fetch_array($sql2);

			$sql3 = mysqli_query($db_connection, "select sum(price) as total from booking where status = 'Accepted'");
			$data2 = mysqli_fetch_array($sql3);

			$sqlacc = mysqli_query($db_connection, "SELECT COUNT(*) AS jumlahaccept FROM booking where status ='Accepted'");
			$get_sqlacc = mysqli_fetch_array($sqlacc);

			$sqlconf = mysqli_query($db_connection, "SELECT COUNT(*) AS jumlahconf FROM booking where status ='Menunggu Konfirmasi'");
			$get_sqlconf = mysqli_fetch_array($sqlconf);
		}

		while ($data = mysqli_fetch_array($sql)) {
			$status  = $data['status'];
		?>
			<tbody>
				<tr>
					<td class="align-middle"><?php echo $data['tgl']; ?></td>
					<td class="align-middle"><?php echo $data['username']; ?></td>
					<td class="align-middle"><?php echo $data['services']; ?></td>
					<td class="align-middle">Rp. <?php echo number_format($data['price']) ?></td>
					<td class="align-middle"><?php echo $status ?></td>
					<td>
					<?php if($status == 'Menunggu Konfirmasi'){ ?>
					<a href="responseAccept.php?transnum=<?php echo $data['transnum']; ?>" class="btn btn-success">Konfirmasi Booking</a>
				<?php } ?>
					<a href="delete.php?transnum=<?php echo $data['transnum']; ?>" class="btn btn-danger">Delete</a>
					</td>
				</tr>
			</tbody>
		<?php
		}
		?>

	</table>
	Total data = <?php echo $get_jumlah['jumlah']; ?> data ditemukan. (<?php echo $get_sqlacc['jumlahaccept']; ?> accepted)(<?php echo $get_sqlconf['jumlahconf']; ?> accepted)
	<br>
	Total pemasukan = Rp. <?php echo number_format($data2['total']) ?>
</div>
<script>
	function sortTable(columnName) {

		var sort = $("#sort").val();
		$.ajax({
			url: 'fetch_details.php',
			type: 'post',
			data: {
				columnName: columnName,
				sort: sort
			},
			success: function(response) {

				$("#empTable tr:not(:first)").remove();

				$("#empTable").append(response);
				if (sort == "asc") {
					$("#sort").val("desc");
				} else {
					$("#sort").val("asc");
				}

			}
		});
	}
</script>