<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			return redirect(base_url());
		}
	}

	public function dashboard()
	{
		$this->load->model('queries');
		$schoolUsers = $this->queries->viewAllschools();
		$this->load->view('dashboard', ['schoolUsers' => $schoolUsers]);
	}

	public function addschool()
	{
		$this->load->view('addschool');
	}

	public function createschool()
	{
		$this->form_validation->set_rules('schoolname','school Name', 'required');
		$this->form_validation->set_rules('branch','Branch Name', 'required');
		if ($this->form_validation->run()) {
			$data = $this->input->post();
			$this->load->model('queries');
			if ($this->queries->insertschool($data)) {
				$this->session->set_flashdata('message', 'school Added Successfully');
			} else {
				$this->session->set_flashdata('message', 'Failed To Add!');
			}

			return redirect('admin/dashboard');
		} else {
			$this->addschool();
		}
	}

	public function addStudent()
	{
		$this->load->model('queries');
		$schools = $this->queries->getschools();
		$this->load->view('addStudent', ['schools'=>$schools]);
	}

	public function createStudent()
	{
		$this->form_validation->set_rules('studentname','Student Name', 'required');
		$this->form_validation->set_rules('school_id','school Name', 'required');
		$this->form_validation->set_rules('email','Email', 'required');
		$this->form_validation->set_rules('gender','Gender', 'required');
		$this->form_validation->set_rules('course','Course', 'required');

		if ($this->form_validation->run()) {
			$data = $this->input->post();

			$this->load->model('queries');
			if ($this->queries->insertStudent($data)) {
				$this->session->set_flashdata('message', 'Student Added Successfully');
			} else {
				$this->session->set_flashdata('message', 'Failed To Add!');
			}

			return redirect('admin/addStudent');
		} else {
			$this->addStudent();
		}
	}

	public function viewstudents($school_id)
	{
		$this->load->model('queries');
		$students = $this->queries->getStudents($school_id);
		$this->load->view('viewStudents', ['students' => $students]);
	}

	public function editStudent($student_id)
	{
		$this->load->model('queries');
		$schools = $this->queries->getschools();
		$studentInfo = $this->queries->getStudentRecord($student_id);
		$this->load->view('editStudent', ['schools' => $schools, 'studentInfo' => $studentInfo]);
	}

	public function addModerator()
	{
		$this->load->model('queries');
		$schools = $this->queries->getschools();
		$roles = $this->queries->getRoles();
		// echo "<pre>";
		// print_r($schools);
		// echo "</pre>";
		// exit();
		$this->load->view('addModerator', ['schools' => $schools, 'roles' => $roles]);
	}

	public function createModerator()
	{
		$this->form_validation->set_rules('username','Username', 'required');
		$this->form_validation->set_rules('school_id','school Name', 'required');
		$this->form_validation->set_rules('email','Email', 'required');
		$this->form_validation->set_rules('gender','Gender', 'required');
		$this->form_validation->set_rules('role_id','Role', 'required');
		$this->form_validation->set_rules('password','Password', 'required');
		$this->form_validation->set_rules('confpwd','Password Confirmation', 'required');

		if ($this->form_validation->run()) {
			$data = $this->input->post();
			$data['password'] = sha1($this->input->post('password'));
			$data['confpwd'] = sha1($this->input->post('confpwd'));

			$this->load->model('queries');
			if ($this->queries->insertModerator($data)) {
				$this->session->set_flashdata('message', 'Moderator Added Successfully');
			} else {
				$this->session->set_flashdata('message', 'Failed To Add!');
			}

			return redirect('admin/dashboard');
		} else {
			$this->addModerator();
		}
	}

	public function modifystudent($id)
	{
		$this->form_validation->set_rules('studentname','Student Name', 'required');
		$this->form_validation->set_rules('school_id','school Name', 'required');
		$this->form_validation->set_rules('email','Email', 'required');
		$this->form_validation->set_rules('gender','Gender', 'required');
		$this->form_validation->set_rules('course','Course', 'required');

		if ($this->form_validation->run()) {
			$data = $this->input->post();

			$this->load->model('queries');
			if ($this->queries->updateStudent($data, $id)) {
				$this->session->set_flashdata('message', 'Student Updated Successfully');
			} else {
				$this->session->set_flashdata('message', 'Failed To Update!');
			}
			redirect($_SERVER['HTTP_REFERER']);
			// return redirect('admin/addStudent');
		} else {
			$this->editStudent();
		}
	}

	public function deletestudent($id)
	{
		$this->load->model('queries');
		if($this->queries->removeStudent($id))
		{
			return redirect('admin/dashboard');
		} else {
			return redirect('admin/dashboard');
		}
	}

	public function moderator()
	{
		$this->load->model('queries');
		$moderator = $this->queries->viewAllschools();
		$this->load->view('viewModerator', ['moderator'=>$moderator]);
	}

}
