<?php
session_start();
require_once('../../global/libs/gfconfig.php');
require_once('../../global/libs/gfinit.php');
require_once('../../global/libs/gffunc.php');
require_once('../../includes/gfconfig.php');
require_once('../../libs/cls.mysql.php');
require_once('../../libs/cls.users.php');
$objmysql = new CLS_MYSQL;
$masv = isset($_POST["masv"]) ? antiData($_POST["masv"]) : "";
$malop = isset($_POST["malop"]) ? antiData($_POST["malop"]) : "";
if($masv == "") die("Chưa lựa chọn sinh viên nào!");

$CTH = array(); // Chương trình học của lớp sinh viên đang học
$res_cthoc = SysGetList('tbl_chuongtrinhhoc', array('slot', 'id_monhoc'), "AND id_lop='".$malop."'");
if(count($res_cthoc)>0){
	foreach ($res_cthoc as $key => $value) {
		$CTH[$value['id_monhoc']] = $value;
	}
}

//---------------------------------------
$MONHOC = array();
$json_monhoc = file_get_contents(DOCUMENT_ROOT.'jsons/monhoc.json');
$arr_monhoc = json_decode($json_monhoc, true);
foreach ($arr_monhoc as $key => $value) {
	$MONHOC[$value['id']] = $value;
}

//---------------------------------------
$NOTE = array();
$res_note = SysGetList('tbl_hoctap_note', array());
if(count($res_note)>0){
	foreach ($res_note as $key => $value) {
		$NOTE[$value['id']][] = $value;
	}
}

$res_hoctap = SysGetList('tbl_hoctap', array(), "AND masv='".$masv."'");
if(count($res_hoctap)>0){
	$stt = 0;
	echo '<table id="'.$masv.'" class="table table-striped table-bordered">
	<thead>
	<th class="text-center">STT</th>
	<th>Môn học</th>
	<th class="text-center">Số tín chỉ</th>
	<th class="text-center" onclick="sortTable(3)">Slot <i class="fa fa-sort-amount-desc" aria-hidden="true"></i></th>
	<th class="text-center">Chuyên cần</th>
	<th class="text-center">Điểm kiểm tra</th>
	<th class="text-center">ĐK thi</th>
	<th class="text-center">Điểm thi</th>
	<th class="text-center">Thi lại</th>
	<th class="text-center">Ngày cập nhật điểm</th>
	<th class="text-center">Note</th>
	<th class="text-center" width="100">Tình trạng chuyên cần</th>
	<th class="text-center" width="100">Tình trạng kiểm tra</th>
	<th class="text-center" width="100">Tình trạng ĐK thi</th>
	<th class="text-center" width="100" onclick="sortTable(14)">Trạng thái môn học <i class="fa fa-sort-amount-desc" aria-hidden="true"></i></th>
	</thead>
	<tbody id="table-hoctap-'.$masv.'">';

	foreach ($res_hoctap as $key => $value){
		$dkthi = $value['dieukienthi'];
		$flag_status_monhoc = "NA"; $val_status_monhoc = 4; // Dùng để order
		$flag_ktra = $flag_chuyencan = "NA";
		$diem_chuyencan = $diem_kiemtra = $diem_thi = "";
		if($dkthi===0) $flag_dkthi = 0;
		elseif ($dkthi===1) $flag_dkthi = "xanh";
		else $flag_dkthi = "NA";

		$arr_diem = $value['diem']!="" ? json_decode($value['diem'], true) : array();
		if(is_array($arr_diem) && count($arr_diem)>0){
			$diem_chuyencan = isset($arr_diem['chuyencan']) ? $arr_diem['chuyencan'] : "";
			$diem_kiemtra = isset($arr_diem['diemkt']) ? $arr_diem['diemkt'] : "";
			$diem_thi = isset($arr_diem['diemthi']) ? $arr_diem['diemthi'] : "";

			// Cờ điểm chuyên cần
			if($diem_chuyencan < 2){
				$flag_chuyencan = 'do';
			}
			else if($diem_chuyencan >= 2 && $diem_chuyencan < 5){
				$flag_chuyencan = 'vang';
			}
			else if($diem_chuyencan >= 5 && $diem_chuyencan <= 10){
				$flag_chuyencan = 'xanh';
			}

			// Cờ điểm kiểm tra
			if($diem_kiemtra < 2){
				$flag_ktra = 'do';
			}
			else if($diem_kiemtra >= 2 && $diem_kiemtra < 5){
				$flag_ktra = 'vang';
			}
			else if($diem_kiemtra >= 5 && $diem_kiemtra <= 10){
				$flag_ktra = 'xanh';
			}

			// Cờ trạng thái môn học
			if($dkthi=='do' || $flag_chuyencan=='do' || $flag_ktra=='do'){
				$flag_status_monhoc = 'do';
				$val_status_monhoc = 1;
			}elseif ($dkthi=='xanh' && $flag_chuyencan=='xanh' && $flag_ktra=='xanh') {
				$flag_status_monhoc = 'xanh';
				$val_status_monhoc = 3;
			}else{
				$flag_status_monhoc = 'vang';
				$val_status_monhoc = 2;
			}
		}

		$res_hoctap[$key]['flag_ktra'] = $flag_ktra;
		$res_hoctap[$key]['flag_chuyencan'] = $flag_chuyencan;
		$res_hoctap[$key]['flag_dkthi'] = $flag_dkthi;
		$res_hoctap[$key]['flag_status_monhoc'] = $flag_status_monhoc;
		$res_hoctap[$key]['status_monhoc'] = $val_status_monhoc;
	}
	usort($res_hoctap, function ($item1, $item2) {
	    return $item1['status_monhoc'] <=> $item2['status_monhoc'];
	});

	foreach ($res_hoctap as $key => $value) {
		$stt = $stt+1;
		$name_monhoc = isset($MONHOC[$value['id_monhoc']]) ? $MONHOC[$value['id_monhoc']]['name'] : "";
		$diem = $value['diem']!="" ? json_decode($value['diem'],true) : array();
		$chuyencan = isset($diem['chuyencan']) ? $diem['chuyencan'] : "";
		$diemkt = isset($diem['diemkt']) ? $diem['diemkt'] : "";
		$diemthi = isset($diem['diemthi']) ? $diem['diemthi'] : "";
		$status = $value['status'];
		$ketqua = $value['ketqua'];
		$diemthilai = $value['ketqua2'];
		$dkthi = $value['dieukienthi'];
		$diem_pass = 4;
		$slot = isset($CTH[$value['id_monhoc']]) ? $CTH[$value['id_monhoc']]['slot'] : "";

		$last_comment = ""; $num_comment = 0;
		if(isset($NOTE[$value['id']]) && is_array($NOTE[$value['id']])){
			$num_comment = count($NOTE[$value['id']]);
			$last_comment = end($NOTE[$value['id']]);
		}

		echo '<tr dataid="'.$value['id'].'" datama="'.$masv.'" datamon="'.$value['id_monhoc'].'">
		<td align="center" width="50">'.$stt.'</td>
		<td>'.$name_monhoc.'</td>
		<td align="center">'.$value['tinchi'].'</td>
		<td align="center">'.$slot.'</td>
		<td align="center"><input type="text" name="chuyencan" class="nhapdiem chuyencan form-control" value="'.$chuyencan.'" dataid="'.$value['id'].'" datama="'.$masv.'"></td>
		<td align="center"><input type="text" name="diemkt" class="nhapdiem diemkt form-control" value="'.$diemkt.'" dataid="'.$value['id'].'" datama="'.$masv.'"></td>
		<td align="center"><input type="text" name="dkthi" class="nhapdiem dkthi form-control" value="'.$dkthi.'" dataid="'.$value['id'].'" datama="'.$masv.'"></td>
		<td align="center"><input type="text" name="diemthi" class="nhapdiem diemthi form-control" value="'.$diemthi.'" dataid="'.$value['id'].'" datama="'.$masv.'"></td>
		<td align="center"><input type="text" name="thilai" class="nhapdiem thilai form-control" value="'.$diemthilai.'" dataid="'.$value['id'].'" datama="'.$masv.'"></td>
		<td align="center">
		<div class="time"></div>
		<button class="btn btn-default btn_capnhap_diem" data_mon="'.$value['id'].'" data_masv="'.$masv.'">Cập nhập điểm</button>
		</td>
		<td align="center" width="150">
		<a dataid="'.$value['id'].'" title="Note" class="btn_readNote"><i class="fa fa-commenting-o" aria-hidden="true"> <span class="label_number" id="id_'.$value['id'].'">'.$num_comment.'</span></i></a>
		<div class="last-comment">'.$last_comment.'</div>
		</td>
		<td align="center"><span class="flag '.$value['flag_chuyencan'].'"><i class="fa fa-flag" aria-hidden="true"></i></span></td>
		<td align="center"><span class="flag '.$value['flag_ktra'].'"><i class="fa fa-flag" aria-hidden="true"></i></span></td>
		<td align="center"><span class="flag '.$value['flag_dkthi'].'"><i class="fa fa-flag" aria-hidden="true"></i></span></td>
		<td align="center"><span class="flag '.$value['flag_status_monhoc'].'" data-val="'.$value['status_monhoc'].'"><i class="fa fa-flag" aria-hidden="true"></i></span></td>
		</tr>';
	}
	echo '</tbody>
	</table>';
}else{
	echo '<table style="width:100%"><tr><td colspan="10" style="text-align:center;">Không có dữ liệu.</td></tr></table>';
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".nhapdiem").keypress(function(e){
			if(e.which==13) {
				var ht_row = $(this).parent().parent();
				var ht_id = ht_row.attr('dataid');
				var masv = ht_row.attr('datama');
				var id_mon = ht_row.attr('datamon');
				var chuyencan = ht_row.find('.chuyencan').val();
				var diemkt = ht_row.find('.diemkt').val();
				var diemthi = ht_row.find('.diemthi').val();
				var dkthi = ht_row.find('.dkthi').val();
				var diemthilai = ht_row.find('.thilai').val();

				var url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_diem.php";
				var _data = {
					'masv':masv,
					'ht_id':ht_id,
					'id_mon':id_mon,
					'chuyencan':chuyencan,
					'diemkt':diemkt,
					'diemthi':diemthi,
					'dkthi':dkthi,
					'diemthilai':diemthilai,
				};
				$.post(url, _data,function(req){
					if(req=="success") {
						showMess("Đã lưu thành công");
					}else{
						showMess("Lỗi", "error");
					}
				}) 
			}
		});

		$('.btn_capnhap_diem').on('click', function(){ // tự động từ hệ thống
			var _url='<?php echo ROOTHOST;?>ajaxs/hoctap/frm_update_diem.php';
			var _masv=$(this).attr('data_masv');
			var _mon=$(this).attr('data_mon');
			$.get(_url,{'masv':_masv,'mon':_mon},function(req){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg');
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-title').html('Cập nhập điểm');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			});
		});

		// read note hoctap
		$('.btn_readNote').click(function(){
			var ht_id=$(this).attr('dataid');
			$.get('<?php echo ROOTHOST;?>ajaxs/hoctap/get_note.php',{'ht_id':ht_id},function(req){
				$('#myModalPopup .modal-dialog').removeClass('modal-lg');
				$('#myModalPopup .modal-dialog').removeClass('modal-sm');
				$('#myModalPopup .modal-title').html('Ghi chú');
				$('#myModalPopup .modal-body').html(req);
				$('#myModalPopup').modal('show');
			});
		});

		$(".btn_xet_dat").click(function(){
			var ht_row = $(this).parent().parent();
			var ht_id = ht_row.attr('dataid');
			var masv = ht_row.attr('datama');
			var id_mon = ht_row.attr('datamon');
			var _data = {
				'masv':masv,
				'ht_id':ht_id,
				'id_mon':id_mon
			};
			if(confirm("Bạn có chắc chắn thực hiện Xét Đạt/Không Đạt cho SV #"+masv+"?")) {
				var _url = "<?php echo ROOTHOST;?>ajaxs/hoctap/process_xet_dat.php";
				$.post(_url, _data, function(req){
					if(req=="error") {
						showMess("Lỗi trong quá trình xét đạt/không đạt cho SV #"+masv,"error");
					} else {
						showMess(req,"");
						setTimeout(function(){ window.location.reload(); }, 3000);
					}
				})
			}
		});
	});

	function sortTable(n) {
		var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
		table = document.getElementById("<?php echo $masv;?>");
		switching = true;
		// Set the sorting direction to ascending:
		dir = "asc";
		/* Make a loop that will continue until
		no switching has been done: */
		while (switching) {
			// Start by saying: no switching is done:
			switching = false;
			rows = table.rows;
			/* Loop through all table rows (except the
			first, which contains table headers): */
			for (i = 1; i < (rows.length - 1); i++) {
				// Start by saying there should be no switching:
				shouldSwitch = false;
				/* Get the two elements you want to compare,
				one from current row and one from the next: */
				x = rows[i].getElementsByTagName("TD")[n];
				y = rows[i + 1].getElementsByTagName("TD")[n];
				/* Check if the two rows should switch place,
				based on the direction, asc or desc: */
				if (dir == "asc") {
					if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
						// If so, mark as a switch and break the loop:
						shouldSwitch = true;
						break;
					}
				} else if (dir == "desc") {
					if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
						// If so, mark as a switch and break the loop:
						shouldSwitch = true;
						break;
					}
				}
			}
			if (shouldSwitch) {
				/* If a switch has been marked, make the switch
				and mark that a switch has been done: */
				rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
				switching = true;
				// Each time a switch is done, increase this count by 1:
				switchcount ++;
			} else {
				/* If no switching has been done AND the direction is "asc",
				set the direction to "desc" and run the while loop again. */
				if (switchcount == 0 && dir == "asc") {
					dir = "desc";
					switching = true;
				}
			}
		}
	}
</script>
