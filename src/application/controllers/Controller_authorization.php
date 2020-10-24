<?php


    class Controller_authorization extends Controller
    {
        /**
         * @var Model_user
         */
        private $users;

        public function __construct() {
            parent::__construct();
            $this->users=new Model_user();
            $this->content_view='main_view.php';
        }


        public function action_index($params=null){
            $this->view->generate('login_view.php');
        }

        public function action_login($params=null){
            if(is_null($params) or !is_array($params)){
                throw new BaseException();
            }
            extract($params);
            if(empty($user_login) or empty($user_password)){
                throw new BaseException();
            }

            session_start();
            $select=['select'=>' *','where'=>"user_login='".$user_login."'"];
            $this->users=new Model_user($select);
            $users=$this->users->getAllRows();
            if(count($users)==0){
                $this->authError("Неверное имя пользователя или пароль!");
            }
            else{
                $user=$users[0];
//                print_r($user);
                $password_hash=$user['user_password'];
                if(password_verify($user_password, $password_hash)){
                    $_SESSION['user_id']=$user['user_id'];
                    $_SESSION['user_login']=$user['user_login'];
                    $_SESSION['user_type']=$user['user_type'];
                    header("Location: /sheets");

                    //                    $this->view->generate($this->template_view,$this->content_view);
                }
                else{
                    $this->authError("Неверное имя пользователя или пароль!");
                }

            }

        }
        public function action_signup($params=null){
            if(is_null($params) or !is_array($params)){
                throw new BaseException();
            }
            extract($params);
            if(empty($user_login) or empty($user_password)){
                throw new BaseException();
            }
            if(empty($user_type)){
                $user_type='student';
            }

            session_start();
            $select=['select'=>' *','where'=>"user_login='".$user_login."'"];
            $this->users=new Model_user($select);
            $users_rows=$this->users->getAllRows();
            if(!$users_rows){
                $users_rows=[];
            }
            if(count($users_rows)==0){
                $password_hash=password_hash($user_password,PASSWORD_DEFAULT);
                $this->users=new Model_user();
                $this->users->user_login=$user_login;
                $this->users->user_password=$password_hash;
                $this->users->user_type=$user_type;
//                print_r($this->users);
                $result=$this->users->save();
                echo $result;
                if($result){

                    $response=self::phpAlert("Пользователь успешно зарегистрирован");
                    $content_view="";
                    $template_view="login_view.php";
                    $this->view->generate($template_view,$content_view,['response'=> $response]);
                }
                else{
                    echo fff;
                    throw new BaseException();
                }
            }
            else{

                $this->authError("Пользователь с такими данными уже существует");

            }
        }
        public function action_logout(){
            session_start();
            session_unset();
            session_destroy();
            header("Location: /");

//            $this->action_index();
        }

        private function authError($message){
            $response=self::phpAlert($message);
//            header("Location: /?response=" . $message);
            $template_view="login_view.php";
            $content_view="";
            $this->view->generate($template_view,$content_view,['response'=> $response]);
        }

    }