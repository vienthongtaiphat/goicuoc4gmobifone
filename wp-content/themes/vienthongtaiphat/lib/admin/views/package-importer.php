<div class="wrap">
	<h2>Nhập gói cước</h2>
	<form method="POST" enctype="multipart/form-data" id="package-importer-form">
		<table class="form-table">
			<tbody>
			<tr>
				<th scope="row"><label for="file">Chọn tệp Excel:</label></th>
				<td><input type="file" id="file" name="file" accept=".xlsx,.xls"></td>
			</tr>
			<tr>
				<th scope="row"><label for="mno">Nhà mạng:</label></th>
				<td>
					<select name="mno" id="mno">
						<option value="mobifone">MobiFone</option>
						<option value="vinaphone">VinaPhone</option>
					</select>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="package_special_offers">Gói cước ưu đãi đặc biệt:</label></th>
				<td><input type="checkbox" id="package_special_offers" name="package_special_offers" value="true"></td>
			</tr>
			</tbody>
		</table>
		<div class="statusBar-wrapper" style="display: none">
			<p>Đang thực hiện, vui lòng không đóng trang này!</p>
			<div class="statusBar"></div>
		</div>
		<p id="import-results"></p>
		<p class="submit">
			<input type="submit" name="submit" value="Nhập" class="button button-primary">
		</p>
	</form>
</div>
