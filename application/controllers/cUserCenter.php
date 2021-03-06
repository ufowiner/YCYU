<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class cUserCenter extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	//数据crud验证数据有效性，数据边际，是否在可操作权限内

	public function index()
	{
		$this->load->model("mUsercenter","mu");
		$data['skill']=$this -> mu -> skillGet();
		$data['mes']=null;
		if($data['skill']==false)
		{
			$data['mes']="add a skill card";
		}
		$this->load->view('head');
		$this->load->view('user-center',$data);
		$this->load->view('foot');
		//调试程序
		$this->output->enable_profiler(TRUE);
	}
	
	//拉取skill 
	public function pullSkill()
	{
		$this->load->model("mUsercenter","mu");
		$data=$this -> mu -> skillGet();
		foreach ($data->result_array() as $value) {
			echo $value['name'];
		}
		
	}

	//添加技能片 
	public function addSkill()
	{
		$this->load->model("mUsercenter","mu");
		$data=$this->input->raw_input_stream;
		$obj=json_decode($data);
		$tName=$obj->name;
		$tLvl=$obj->level;
		$tDes=$obj->descript;
		$res=$this->mu->addSkill($tName,$tLvl,$tDes);
		echo $res>0 ? "success" : "error";
	}

	//delete skill
	public function deleteSkill()
	{
		$sid=$_POST['sid'];
		$this->load->model("mUserCenter","sm");
		$res=$this->sm->skillDelete($sid);
		echo $res ? "success" : "error";		
	}

	//修改技能片
	public function modifySkill()
	{
		$sname=$_POST['name'];
		$slevel=$_POST['level'];
		$sdes=$_POST['des'];
		$sid=$_POST['sid'];
		$this->load->model("mUserCenter","sm");
		$res=$this->sm->skillUpdata($sid,$sname,$slevel,$sdes);
		echo $res ? "ok" : "error";
	}
}
/* End of file cUserCenter.php */
/* Location: ./application/controllers/cUserCenter.php */
