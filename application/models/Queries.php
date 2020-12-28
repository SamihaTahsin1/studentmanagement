<?php

	class Queries extends CI_Model
	{
		public function getRoles()
		{
			$roles = $this->db->get('tbl_roles');
			if($roles->num_rows() > 0)
			{
				return $roles->result();
			}
		}

		public function insertAdmin($data)
		{
			return $this->db->insert('tbl_users', $data);
		}

		public function adminExist($email, $password)
		{
			$checkAdmin = $this->db->where(['email' => $email, 'password' => $password])
														 ->get('tbl_users');
			if($checkAdmin->num_rows() > 0)
			{
				return $checkAdmin->row();
			}
		}

		public function insertSchool($data)
		{
			return $this->db->insert('tbl_school', $data);
		}

		public function getSchools()
		{
			$schools = $this->db->get('tbl_school');
			if($schools->num_rows() > 0)
			{
				return $schools->result();
			}
		}

		public function insertModerator($data)
		{
			return $this->db->insert('tbl_users', $data);
		}

		public function insertStudent($data)
		{
			return $this->db->insert('tbl_student', $data);
		}

		public function viewAllschools()
		{
			$this->db->select(['tbl_users.user_id',
													'tbl_users.username',
													'tbl_users.email',
													'tbl_users.gender',
													'tbl_school.school_id',
													'tbl_school.schoolname',
													'tbl_school.branch',
													'tbl_roles.rolename',
												]);

			$this->db->from('tbl_school');
			$this->db->join('tbl_users', 'tbl_school.school_id = tbl_users.school_id');
			$this->db->join('tbl_roles', 'tbl_roles.role_id = tbl_users.role_id');
			$users = $this->db->get();
			return $users->result();
		}

		public function getStudents($school_id)
		{
			$this->db->select([ 'tbl_school.school_id',
													'tbl_school.schoolname',
													'tbl_student.id',
													'tbl_student.email',
													'tbl_student.gender',
													'tbl_student.course',
													'tbl_student.studentname',
												]);

			$this->db->from('tbl_student');
			$this->db->join('tbl_school', 'tbl_school.school_id = tbl_student.school_id');

			$this->db->where(['tbl_student.school_id' => $school_id]);
			$student = $this->db->get();
			return $student->result();
		}

		public function getStudentRecord($student_id)
		{
			$this->db->select([ 'tbl_school.school_id',
													'tbl_school.schoolname',
													'tbl_student.id',
													'tbl_student.email',
													'tbl_student.gender',
													'tbl_student.course',
													'tbl_student.studentname',
												]);

			$this->db->from('tbl_student');
			$this->db->join('tbl_school', 'tbl_school.school_id = tbl_student.school_id');

			$this->db->where(['tbl_student.id' => $student_id]);
			$student = $this->db->get();
			return $student->row();
		}

		public function updateStudent($data, $id)
		{
			return $this->db->where('id', $id)
											->update('tbl_student', $data);
		}

		public function removeStudent($id)
		{
			$this->db->delete('tbl_student', ['id'=>$id]);
		}

	}

?>
