<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/clientes/drops/lms/custom/utils/classes/Utils.php';

class Search extends Utils {

	function __construct() {
		parent::__construct();
	}

	function get_course_name( $id ) {
		$query  = "select * from mdl_course where id=$id";
		$result = $this->db->query( $query );
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$name = $row['fullname'];
		}

		return $name;
	}

	function searchItem( $data ) {
		$courses = array();
		$item    = urldecode( base64_decode( $data ) );
		$query   = "select * from mdl_course where fullname like '%$item%'";
		$result  = $this->db->query( $query );
		while ( $row = $result->fetch( PDO::FETCH_ASSOC ) ) {
			$course = new stdClass();
			foreach ( $row as $key => $value ) {
				$course->$key = $value;
			}
			$courses[] = $course;
		}
		$list = $this->create_seacrh_results( $courses );

		return $list;
	}

	function create_seacrh_results( $courses ) {
		$list = "";
		if ( count( $courses ) > 0 ) {
			$userid = $this->user->id;
			$list   .= "<input type='hidden' id='userid' value='$userid'>";
			foreach ( $courses as $course ) {
				$courseid   = $course->id;
				$coursename = $this->get_course_name( $courseid );
				$list       .= "<div class='row'>";
				$list       .= "<span class='col-md-8'>$coursename</span>";
				$list       .= "<span class='col-md-4'><button id='enroll_me_$courseid' class='btn btn-primary'>Subscribe</button></span>";
				$list       .= "</div>";

			}
		} // end if count($courses)>0
		else {
			$list .= "<div class='row' style='text-align: center;'>";
			$list .= "<span class='col-12'>There is nothing found</span>";
			$list .= "</div>";
		}

		return $list;
	}


}