#index.php
<?php

$html = '';
$html .= '<table border="1" cellspacing="0" cellspadding="0" width="100%">
	<thead>
	    <tr>
            <th>id</th>
			<th>Name</th>
			<th>sg</th>
			<th>step</th>
			<th>position</th>
			<th>salary</th>
			
			
	    </tr>
  </thead>
   <tbody>';
   	$link = mysqli_connect("localhost","root","","crud");
	$no = 1;
	$q = "SELECT * FROM `data` ORDER BY id DESC";
	$res = mysqli_query($link,$q);
	$row = mysqli_num_rows($res);
	if($row > 0) { 
	while($row = mysqli_fetch_assoc($res)) {
	    $html .= '<tr align="center"><td>'.$no.'</td>
	    <td>'.$row['name'].'</td>
	    <td>'.$row['sg'].'</td>
	    
	    <td>'.$row['step'].'</td>
	    <td>'.$row['position'].'</td>
	    <td>'.$row['salary'].'</td>';
	    $no++;
	}
	} else {
		$html .= '<tr aling="center"><td colspan="8">No Event</td></tr>';
	}

   	$html .= '</tbody></table>';

	require_once __DIR__ . '/vendor/autoload.php';

	$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'A4-L' ]);
	$mpdf->SetDisplayMode('fullpage');
	$mpdf->WriteHTML( $html );
	
	$mpdf->Output();
	exit;