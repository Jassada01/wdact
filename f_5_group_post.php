<?php


	// Add for PHPSpreadsheet : 2020-12-27
	require_once("plugins/PHPSpreadsheet/autoload.php");

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use PhpOffice\PhpSpreadsheet\IOFactory;


	// ======== Get Var ========
	$f = $_POST['f'];
	//$p1 = $_POST['p1'];
	//$p2 = $_POST['p2'];
	//$p3 = $_POST['p3'];
	
	
	if (isset($_POST['p1']) )
	{
		$p1 = $_POST['p1'];
	}
	if (isset($_POST['p2']) )
	{
		$p2 = $_POST['p2'];
	}
	if (isset($_POST['p3']) )
	{
		$p3 = $_POST['p3'];
	}
	// ================ Global Function =============================
	$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
	$thai_month_arr=array(
		"0"=>"",
		"1"=>"มกราคม",
		"2"=>"กุมภาพันธ์",
		"3"=>"มีนาคม",
		"4"=>"เมษายน",
		"5"=>"พฤษภาคม",
		"6"=>"มิถุนายน", 
		"7"=>"กรกฎาคม",
		"8"=>"สิงหาคม",
		"9"=>"กันยายน",
		"10"=>"ตุลาคม",
		"11"=>"พฤศจิกายน",
		"12"=>"ธันวาคม"                 
	);
	function thai_date($time){
		global $thai_day_arr,$thai_month_arr;
		$thai_date_return="วัน".$thai_day_arr[date("w",$time)];
		$thai_date_return.= "ที่ ".date("j",$time);
		$thai_date_return.=" ".$thai_month_arr[date("n",$time)];
		$thai_date_return.= " ".(date("Y",$time)+543);
		return $thai_date_return;
	}
	
	function validateDate($date, $format = 'Y-m-d H:i:s')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format) == $date;
	}
	
	function gen_rnd_str($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	function gen_rnd_num($length = 5) {
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	
	
	
	
	// ======== Function ========
	// 1
	function load_group_post_data()
	{
		foreach ($_POST as $key => $value)
		{
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
		}
		
		//$sql = "   Select a.id, a.full_picture,  substring(a.message, 1, 100) AS MSG, a.message AS FULL_MSG , a.created_time, a.Type, IFNULL(b.case_id, '-') AS  CASE_ID, IFNULL(d.crp_status, '-') AS STATUS_TEXT, IFNULL(c.status, '-') AS STATUS_CODE from group_post_data a                              ";
		//$sql = $sql .   "   Left Join case_group_post b ON a.id = b.group_post_id                                                                                                                                                                                                                                                                                                 ";
		//$sql = $sql .   "   Left Join wd_case c ON b.case_id = c.case_id                                                                                                                                                                                                                                                                                                                  ";
		//$sql = $sql .   "   Left Join m_crp_status d ON c.status = d.id                                                                                                                                                                                                                                                                                                                    ";
		//$sql = $sql .   "   Where YEAR(a.created_time) = $select_year                                                                                                                                                                                                                                                                                                                              ";
		//$sql = $sql .   "   AND a.Type = 'G'                                                                                                                                                                                                                                                                                                                            ";
		//$sql = $sql .   "   Order By a.created_time DESC                                                                                                                                                                                                                                                                                                                                       ";
		
		$sql = "SELECT a.id,
				a.full_picture,
				Substring(a.message, 1, 100) AS MSG,
				a.message                    AS FULL_MSG,
				a.created_time,
				a.type,
				Ifnull(b.case_id, '-')       AS CASE_ID,
				Ifnull(d.crp_status, '-')    AS STATUS_TEXT,
				Ifnull(c.status, '-')        AS STATUS_CODE,
				Ifnull(f.type_name, '-')     AS Type_name
		FROM   group_post_data a
				LEFT JOIN case_group_post b
					ON a.id = b.group_post_id
				LEFT JOIN wd_case c
					ON b.case_id = c.case_id
				LEFT JOIN m_crp_status d
					ON c.status = d.id
				LEFT JOIN group_post_type_data e
					ON a.id = e.post_id
				LEFT JOIN m_group_post_type_master f
					ON e.post_type = f.id
		WHERE  Year(a.created_time) = $select_year 
				AND a.type = 'G'
		ORDER  BY a.created_time DESC ";
		
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);		
		$data_Array = array();
		while ($row = $res->fetch_assoc()){
			//if ($row[''])
			if ($row['CASE_ID'] != '-')
			{
					$row['print_case_id'] = substr($row['CASE_ID'],0, 2).'-'.substr($row['CASE_ID'],2, 2).'-'.substr($row['CASE_ID'],4);
			}
			else
			{
				$row['print_case_id'] = '-';
			}
			
			$data_Array[] = $row;
		}
		//echo $sql;
		echo json_encode($data_Array);	
	}
	
	
		// F=2
	function dl_excel_file_post_in_group()
	{
		foreach ($_POST as $key => $value)
		{
			//$data[htmlspecialchars($key)] = htmlspecialchars($value);
			$a = htmlspecialchars($key) ;
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '',trim(str_replace("'", "", htmlspecialchars($value))));
			//echo $key . ":" . $value . "\n";
		}
		$tbl_f = array(
			"wd_id" => "รหัส",
			"name" => "ชื่อ",
			"s_name" => "นามสกุล",
			"n_name" => "ชื่อเล่น",
			"sex" => "เพศ",
			"wd_status" => "สถานะ",
			"gen" => "รุ่น",
			"birthday" => "วดป เกิด",
			"age" => "อายุ",
			"occ" => "อาชีพ",
			"occ_type" => "ประเภทอาชีพ",
			"occ_add" => "สถานที่ทำงาน",
			"education" => "สถานศึกษา",
			"address" => "ที่อยู่",
			"dis_name" => "ตำบล",
			"aum_name" => "อำเภอ",
			"prv_name" => "จังหวัด",
			"zip_code" => "รหัสไปรษณี",
			"geo_name" => "ภาค",
			"tel" => "เบอร์โทร",
			"tel_2" => "เบอร์โทรสำรอง",
			"email" => "อีเมล์",
			"soc_fb" => "Facebook",
			"soc_fb_2" => "Facebook2",
			"soc_line" => "Line",
			"soc_twitter" => "Twitter",
			"remark" => "หมายเหตุ"
		);
		$tbl_f_all = array();

		$column = array();
		//foreach (range('A', 'Z') as $char_list) {
		//	array_push($column, $char_list);
		//}
		
		for ($i = 'a'; $i < 'zz'; $i++) 
		{
			array_push($column, $i);
		}
		
		
		/** Error reporting */
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		date_default_timezone_set('Asia/Bangkok');

		/** Include PHPExcel */
		//require_once dirname(__FILE__) . '/plugins/Classes/PHPExcel.php';

		// Create new PHPExcel object
		//$objPHPExcel = new PHPExcel();
		$objPHPExcel = new Spreadsheet();
		$styleArray = array(
			'font'  => array(
				'bold'  => true
				),
			  'fill' => array(
				'type' => PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
				'startcolor' => array(
				  'argb' => 'FFFFFFCC',
				),
			  ),
			);
			
			$styleBan = array(
			  'fill' => array(
				'type' => PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
				'startcolor' => array(
				  'argb' => 'FFFFE6E6',
				),
			  ),
			);
			
			
		// Set document properties
		$objPHPExcel->getProperties()->setCreator("WD_System")
									 ->setLastModifiedBy("WD_System");
									 
		// Query Data
		include "connectionDb.php";
		//$sql = "SELECT a.case_id, a.topic, a.t_sum, a.status, h.crp_status, a.add_date, a.crp_dmg_off, a.ofd_dmg, Ifnull(b.total, 0) AS count_ep, IFnull(c.job_type, '-') AS Job_Type, d.crp_type, IFNULL(e.engegement, 0) AS engegement , IFNULL( e.reach, 0) AS REACH, f.pubtime, ifnull(f.count_post, 0) as count_post , g.ofd_name, g.ofd_type, g.org_type_name, g.amphur_name, g.province_name, g.geo_name, i.img FROM wd_case a LEFT JOIN count_episode b ON a.case_id = b.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.job_type) AS job_type FROM case_job_type a GROUP BY a.case_id) c ON a.case_id = c.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.crp_type) AS crp_type FROM case_crp_type_data a GROUP BY a.case_id) d ON a.case_id = d.case_id LEFT JOIN (SELECT a.case_id, Sum(e.value) AS value, Sum(CASE WHEN e.f_name = 'post_engaged_users' THEN e.value ELSE 0 END) AS engegement, Sum(CASE WHEN e.f_name = 'post_impressions_unique' THEN e.value ELSE 0 END) AS reach FROM wd_case a INNER JOIN case_pub_info b ON a.case_id = b.case_id INNER JOIN static_post e ON b.pub_url = e.post_id WHERE e.data_type = 1 AND f_name IN ( 'post_engaged_users', 'post_impressions_unique' ) AND Year(a.add_date) = $select_year GROUP BY a.case_id ORDER BY a.case_id) e ON a.case_id = e.case_id LEFT JOIN (SELECT a.case_id, Count(b.post_id) AS count_post, Min(b.pub_time) AS pubtime FROM case_pub_info a INNER JOIN system_page_all_pub b ON a.pub_url = b.post_id WHERE a.pub_type = 'page_WD_post' GROUP BY a.case_id) f ON a.case_id = f.case_id LEFT JOIN (SELECT a.case_id, Group_concat(DISTINCT a.ofd_name) AS ofd_name, Group_concat(DISTINCT a.ofd_type) AS ofd_type, Group_concat(DISTINCT e.org_type_name) AS org_type_name , Group_concat(DISTINCT b.amphur_name) AS AMPHUR_NAME, Group_concat(DISTINCT c.province_name) AS PROVINCE_NAME , Group_concat(DISTINCT d.geo_name) AS GEO_NAME FROM case_ofd_info a INNER JOIN add_amphures b ON a.ofd_address_code = b.amphur_code INNER JOIN add_provinces c ON b.province_id = c.province_id INNER JOIN add_geography d ON c.geo_id = d.geo_id INNER JOIN m_org_type e ON a.org_type_id = e.org_type_id GROUP BY a.case_id) g ON a.case_id = g.case_id Inner Join m_crp_status h ON a.status = h.id Left Join vw_case_img i ON a.case_id = i.case_id WHERE Year(a.add_date) = $select_year ORDER BY a.case_id DESC";
		
		$sql = "   Select    substring(a.message, 1, 100) AS ข้อความ , DATE_FORMAT(a.created_time, '%Y-%m-%d') AS วันที่โพส , IFNULL(b.case_id, '-') AS  'CASE ID', IFNULL(d.crp_status, '-') AS สถานะเคส, f.type_name AS ประเภทโพส,  CONCAT('https://www.facebook.com/groups/Watchdog.TAC1/', a.id) AS URL from group_post_data a                              ";
		$sql = $sql .   "   Left Join case_group_post b ON a.id = b.group_post_id                                                                                                                                                                                                                                                                                                 ";
		$sql = $sql .   "   Left Join wd_case c ON b.case_id = c.case_id                                                                                                                                                                                                                                                                                                                  ";
		$sql = $sql .   "   Left Join m_crp_status d ON c.status = d.id                                                                                                                                                                                                                                                                                                                    ";
		$sql = $sql .   "   LEFT JOIN group_post_type_data e
								ON a.id = e.post_id
								LEFT JOIN m_group_post_type_master f
								ON e.post_type = f.id                                                                                                                                                                                                                                                                                                                    ";
		$sql = $sql .   "   Where YEAR(a.created_time) = $select_year                                                                                                                                                                                                                                                                                                                              ";
		$sql = $sql .   "   AND a.Type = 'G'                                                                                                                                                                                                                                                                                                                            ";
		$sql = $sql .   "   Order By a.created_time                                                                                                                                                                                                                                                                                                                                       ";
		
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		
		// Set Active Sheet = 0
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Print_page Heder
		$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
		$objPHPExcel->getActiveSheet()->setCellValue("A1", "โพสในศูนย์ ปี ".$select_year);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		
		$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
		$objPHPExcel->getActiveSheet()->setCellValue("A2", "Update : ".thai_date(date('U'))." เวลา ".date('H:i'));
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Leelawadee UI');
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setItalic(true);
		
		// Print column Name
		$i_colum = 0;
		$i_row = 4;
		while ($property = mysqli_fetch_field($res)) {
			//$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $tbl_f[$property->name]);
			$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $property->name);
			//$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleArray);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFill()->getStartColor()->setRGB('FFFFCC');
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getColumnDimension((string)$column[$i_colum])->setAutoSize(true);
			$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
			array_push($tbl_f_all, $property->name);
			$i_colum ++;
		}
		// Print Data
		while ($row = $res->fetch_assoc()){
				$i_colum = 0;
				$i_row++;
				if ($row['CASE ID'] != "-")
				{
					$row['ประเภทโพส'] = "โพสเคส";
				}
				foreach ($tbl_f_all as $f_name) {
					
					if (validateDate($row[$f_name], 'Y-m-d'))
					{
						$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row[$f_name]);
						$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getNumberFormat()->setFormatCode('yyyy-mm-dd');
					}
					else
					{
						if ($f_name == "CASE ID")
						{
							$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , substr($row[$f_name],0, 2).'-'.substr($row[$f_name],2, 2).'-'.substr($row[$f_name],4));
						}
						else
						{
							$objPHPExcel->getActiveSheet()->setCellValue((string)$column[$i_colum].(string)$i_row , $row[$f_name]);
							if (is_numeric($row[$f_name]) and ($f_name != "CASE ID"))
							{
								$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getNumberFormat()->setFormatCode('#,##');
							}
						}
					}
					
					
					
					
					$objPHPExcel->getActiveSheet()->getStyle((string)$column[$i_colum].(string)$i_row)->getFont()->setName('Leelawadee UI');
					
					//if ($row['wd_status'] == "Banned")
					//{
					//	$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($i_colum, $i_row)->applyFromArray($styleBan);
					//}
					$i_colum++;
				}
				
		}

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('ข้อมูลโพส');
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);


		// Save Excel 2007 file
		// File_name
		//$file_name = "test";
		$file_name = "files/ข้อมูลโพสในศูนย์ปี $select_year _".date('dmyH').gen_rnd_str(4);
		$file_name.= ".xlsx";
		$objWriter = new Xlsx($objPHPExcel);
		$objWriter->save($file_name);
		echo '<button type="button" class="btn btn-box-tool" onclick="location.href='."'".$file_name."'".'"> <i class="fa fa-file-excel-o"></i> Download Excel</button>';
		//exec($file_name);
	}

	// F=3
	function load_group_post_status_for_select()
	{
		foreach ($_POST as $key => $value) {
			$a = htmlspecialchars($key);
			$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
		}
		$sql = " SELECT a.id, a.type_name FROM  m_group_post_type_master a WHERE id <> 0 AND Active = 1 ";
		include "connectionDb.php";
		$res = $conn->query(trim($sql));
		mysqli_close($conn);
		$data_Array = array();
		while ($row = $res->fetch_assoc()) {
			$data_Array[] = $row;
		}
		echo json_encode($data_Array);
	}

	//F=4
function update_post_type()
{
	foreach ($_POST as $key => $value) {
		$a = htmlspecialchars($key);
		$$a = preg_replace('~[^a-z0-9_ก-๙\s/,//.//://;//?//_//^//>//<//=//%//#//@//!//{///}//[//]/-//&//+//*///]~ui ', '', trim(str_replace("'", "", htmlspecialchars($value))));
	}

	include "connectionDb.php";
	// INSERT POST TYPE
	$ran_str = gen_rnd_str(15);
	$ins_sql = "Insert Into group_post_type_data value ('$POST_ID', $POST_TYPE , NULL, '$ran_str')";
	//echo $ins_sql;
	if (!$conn->query($ins_sql)) {
		echo  $conn->errno;
		exit();
	}

	mysqli_close($conn);
}
	



	
	
	//============================ MAIN =========================================================
	switch($f)
	{
		case 1 :
		{
			load_group_post_data();
			break;
		}
		case 2 :
		{
			dl_excel_file_post_in_group();
			break;
		}
		case 3 :
		{
			load_group_post_status_for_select();
			break;
		}
		case 4 :
		{
			update_post_type();
			break;
		}


		
	}
?>