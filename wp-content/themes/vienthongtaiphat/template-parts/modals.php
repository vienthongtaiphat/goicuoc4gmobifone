<div class="modal fade packageModal" id="registerPackageModal" tabindex="-1" aria-labelledby="registerPackageModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<p class="register-package-content">Soạn: <span id="package-syntax"></span> gửi <span id="package-send"></span></p>
			</div>
		</div>
	</div>
</div>

<div class="modal fade packageOTPModal" id="registerPackageOTPModal" tabindex="-1" aria-labelledby="registerPackageOTPModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Đăng ký gói cước</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="register-package-otp-form">
					<div class="mb-3">
						<label class="form-label">Mời nhập số điện thoại</label>
						<input type="text" class="form-control" name="phone-number" aria-label="Phone number">
						<input type="hidden" class="form-control" name="package-name" value="" aria-label="Package name">
					</div>
					<button type="submit" class="btn btn-primary">Gửi yêu cầu đăng ký</button>
				</form>
				<div class="message-wrapper" style="display: none">
					<p class="package-recommend-title">Thông báo</p>
					<div class="message-content">Không tìm thấy gói cước!</div>
				</div>
				<div class="packages-recommend-wrapper" style="display: none">
					<p class="package-recommend-title">Gói cước đề xuất</p>
					<div class="package-recommend-slick-slider-wrapper">
						<div class="package-recommend-slick-slider package-recommend-slick-slider-1"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade packageOTPModal" id="confirmPackageOTPModal" tabindex="-1" aria-labelledby="confirmPackageOTPModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Đăng ký gói cước</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="confirm-package-otp-form">
					<div class="mb-3">
						<label class="form-label">Vui lòng nhập mã OTP đã được gửi tới số điện thoại <span id="phone-number"></span></label>
						<input type="text" class="form-control" name="otp" aria-label="OTP">
						<input type="hidden" name="package-name" value="" aria-label="Package name">
						<input type="hidden" name="username" value="" aria-label="Package name">
						<input type="hidden" name="phone-number" value="" aria-label="Phone number">
					</div>
					<button type="submit" class="btn btn-primary">Xác nhận thuê bao</button>
				</form>
				<div class="message-wrapper" style="display: none">
					<p class="package-recommend-title">Thông báo</p>
					<div class="message-content">Không tìm thấy gói cước!</div>
				</div>
				<div class="packages-recommend-wrapper" style="display: none">
					<p class="package-recommend-title">Gói cước đề xuất</p>
					<div class="package-recommend-slick-slider-wrapper">
						<div class="package-recommend-slick-slider package-recommend-slick-slider-2"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
