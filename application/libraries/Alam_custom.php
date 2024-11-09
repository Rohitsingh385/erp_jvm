<?php
	class Alam_custom{
		public function motherTounge(){
			return array(
				'1' => 'HINDI',
				'2' => 'ENGLISH',
				'3' => 'SANSKRIT',
				'4' => 'URDU',
				'5' => 'BENGALI',
				'6' => 'ODIA',
				'7' => 'OTHERS',
			);
		}
		
		public function bloodGroup(){
			return array(
				'1' => 'A+',
				'2' => 'A-',
				'3' => 'B+',
				'4' => 'B-',
				'5' => 'AB+',
				'6' => 'AB-',
				'7' => 'O+',
				'8' => 'O-',
			);
		}
		
		public function parent_qualification(){
			return array(
				'1' => 'PROFESSIONAL',
				'2' => 'POST GRADUATE',
				'3' => 'GRADUATE',
				'4' => 'SENIOR SECONDARY',
				'5' => 'CLASS X',
				'6' => 'BELOW X',
			);
		}
		
		public function parent_qualification_code(){
			return array(
				'1' => 'PR',
				'2' => 'PG',
				'3' => 'G',
				'4' => 'SS',
				'5' => 'X',
				'6' => 'BC X',
			);
		}
		
		public function parent_accupation(){
			return array(
				'1' => 'SERVICE',
				'2' => 'BUSNIESS',
				'3' => 'OTHERS',
			);
		}

		public function father_accupation(){
			return array(
				'1' => 'SERVICE',
				'2' => 'BUSNIESS',
				'3' => 'OTHERS',
			);
		}

		public function mother_accupation(){
			return array(
				'1' => 'SERVICE',
				'2' => 'BUSNIESS',
				'3' => 'HOUSEMAKER',
				'4' => 'OTHERS',
			);
		}
		
		public function grand_parent(){
			return array(
				'1' => 'SAIL',
				'2' => 'MECON',
				'3' => 'JVM',
				'4' => 'OTHERS',
			);
		}
		
		public function grand_parent_code(){
			return array(
				'1' => 'S',
				'2' => 'M',
				'3' => 'J',
				'4' => 'O',
			);
		}
	}