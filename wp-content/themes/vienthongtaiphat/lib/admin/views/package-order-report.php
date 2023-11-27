<div class="wrap n-admin-wrap">
	<h2>Báo cáo</h2>
	<form action="<?= admin_url('edit.php') ?>" method="get" class="package-order-report-form">
		<?php
		$date_start = $_GET['date_start'] ?? date("Y-m-01", mktime(0, 0, 0, date("m"), 1, date("Y")));
		$date_end   = $_GET['date_end'] ?? date("Y-m-d");
		?>
		<input type="hidden" name="page" value="package-order-report">
		<input type="hidden" name="post_type" value="package_order">
		<input type="date" class="n-input" name="date_start" value="<?= $date_start ?>" placeholder="Từ ngày" aria-label="Từ ngày">
		<input type="date" class="n-input" name="date_end" value="<?= $date_end ?>" placeholder="Đến ngày" aria-label="Đến ngày">
		<input type="submit" name="filter_action" class="button" value="Lọc">
	</form>

	<?php
	global $wpdb;
	$date_start .= " 00:00:00";
	$date_end   .= " 23:59:00";
	$post_type  = 'package_order';

	$query = $wpdb->prepare(
		"SELECT SUM(CAST(pm1.meta_value AS DECIMAL(10,2))) AS total_revenue
    FROM {$wpdb->postmeta} pm1
    INNER JOIN {$wpdb->posts} p ON pm1.post_id = p.ID
    WHERE p.post_type = %s
    AND p.post_status = 'publish'
    AND pm1.meta_key = '_package_order_revenue'
    AND pm1.meta_value != '' 
    AND pm1.meta_value != '0'
    AND EXISTS (
        SELECT 1
        FROM {$wpdb->postmeta} pm2
        WHERE pm2.post_id = p.ID
        AND pm2.meta_key = '_package_order_status'
        AND pm2.meta_value != '0'
    )
    AND EXISTS (
        SELECT 1
        FROM {$wpdb->postmeta} pm3
        WHERE pm3.post_id = p.ID
        AND pm3.meta_key = '_package_order_date'
        AND pm3.meta_value >= %s
        AND pm3.meta_value <= %s
    )",
		$post_type,
		$date_start,
		$date_end
	);

	$query2 = $wpdb->prepare(
		"SELECT COUNT(p.ID) AS total_orders
    FROM {$wpdb->posts} p
    INNER JOIN {$wpdb->postmeta} pm_status ON p.ID = pm_status.post_id
    INNER JOIN {$wpdb->postmeta} pm_date ON p.ID = pm_date.post_id
    WHERE p.post_type = %s
    AND p.post_status = 'publish'
    AND pm_status.meta_key = '_package_order_status'
    AND pm_status.meta_value != '0'
    AND pm_date.meta_key = '_package_order_date'
    AND pm_date.meta_value >= %s
    AND pm_date.meta_value <= %s",
		$post_type,
		$date_start,
		$date_end
	);

	$total_revenue = $wpdb->get_var($query);
	$total_orders  = $wpdb->get_var($query2);
	?>

	<div class="package-order-report-wrap">
		<div class="package-order-report-item">
			<div class="package-order-report-content">
				<h3 class="report-title">Tổng đơn thành công</h3>
				<p class="report-value"><?= $total_orders ?></p>
			</div>
		</div>
		<div class="package-order-report-item">
			<div class="package-order-report-content">
				<h3 class="report-title">Tổng hoa hồng</h3>
				<p class="report-value"><?= number_format($total_revenue, 0, '.', '.') ?>đ</p>
			</div>
		</div>
	</div>
</div>
