<?php 
	class Functions
	{
		var $conn = null;
		public function __construct($conn)
		{
			$this->conn = $conn;
		}
		public function Login($username,$password)
		{
			$sql = "
				SELECT
					tb_admin.id,
					tb_admin.username,
					tb_admin.`password`,
					tb_admin.status_id,
					'tb_admin' as 'table'
				FROM tb_admin
				WHERE tb_admin.username='$username' AND tb_admin.`password`='$password'
				UNION 
				SELECT
					tb_member.id,
					tb_member.username,
					tb_member.`password`,
				  	tb_member.status_id,
					'tb_member' as 'table'
				FROM tb_member
				WHERE tb_member.username='$username' AND tb_member.`password`='$password'
			";
			$arr = $this->conn->QueryObj($sql);
			if(sizeof($arr)==1){
				$_SESSION["id"] = session_id();
				$_SESSION["data_id"] = $arr[0]["id"];
				$_SESSION["username"] = $arr[0]["username"];
				$_SESSION["status_id"] = $arr[0]["status_id"];
				$_SESSION["table"] = $arr[0]["table"];
				return true;
			}
			return false;
		}
		public function ChkSession()
		{
			if(!isset($_SESSION["id"])||$_SESSION["id"]==""||$_SESSION["id"]!=session_id())return false;
			if(!isset($_SESSION["data_id"])||$_SESSION["data_id"]=="")return false;
			if(!isset($_SESSION["username"])||$_SESSION["username"]=="")return false;
			if(!isset($_SESSION["status_id"])||$_SESSION["status_id"]=="")return false;
			if(!isset($_SESSION["table"])||$_SESSION["table"]=="")return false;
			return true;
		}
		public function GetUser()
		{
			if(!$this->ChkSession())return null;
			$data_id = $_SESSION["data_id"];
			$sql = "";
			if( $_SESSION["table"]=="tb_admin" ) {
				$sql = "
					SELECT
						tb_admin.id As admin_id,
						tb_admin.`name`,
						tb_admin.lname,
						tb_admin.fileupload,
						tb_prefix.`name` As prefix_name,
						tb_status.id As status_id,
						tb_status.`name` As status_name
					FROM
						tb_admin
						INNER JOIN tb_status ON tb_admin.status_id = tb_status.id
						INNER JOIN tb_prefix ON tb_admin.prefix_id = tb_prefix.id
					WHERE tb_admin.id='$data_id'";
			} else {
				$sql = "
					SELECT
						tb_member.id As member_id,
						tb_member.`name`,
						tb_prefix.`name` As prefix_name,
						tb_member.name,
						tb_member.lname,
						tb_member.fileupload,
						tb_status.id As status_id,
						tb_status.`name` As status_name,
						tb_position_member.id As position_member_id,
						tb_position_member.`name` As position_name
					FROM
						tb_member
						INNER JOIN tb_status ON tb_member.status_id = tb_status.id
						INNER JOIN tb_prefix ON tb_member.prefix_id = tb_prefix.id
						INNER JOIN tb_position_member ON tb_member.position_member_id = tb_position_member.id
					WHERE tb_member.id='$data_id'";
			}
			$arr = $this->conn->QueryObj($sql);
			if(sizeof($arr)==1){
				return $arr[0];
			}
			return null;
		}
	}