we create a custom function say test:
public function test()
    {
        echo "This is the test method for the view controllers";
    }

how to access this: go to url: http://localhost/series/ci/index.php/welcome/test
it should be of format: path/index.php/class_name/method_name


Create a new controller as Home.php
<?php
class Home extends CI_Controller
{
    public function index()
    {
        $this->load->view('home_view');
    }
}
?>

now create this view in views/home_view.php
<h4>Hello.. This is Home View</h4>

go to url: http://localhost/series/ci/index.php/home
to see this view


CREATING A MODEL
_____________________

Create a database errand_db with table users(id, username, password)
create file in model/User_model.php
We now create a custom controller Users.php to communicate with the model

class Users extends CI_Controller{
    public function show(){
    ...
    }

    Now there are 2 ways to load up a model: manually or by using autoload

    manually:
    $this -> load -> model('user_model');

    automatically:
    in config/autoload.php:

    $autoload['model'] = array('User_model');


  Mow in our model : User_model
  class User_model extends CI_Model
  {
      public function get_users()
      {
      //here write queries
      }
  }

  In controller:
  $result = $this -> User_model -> get_users();

    In model also u can load database in 2 ways: manual or automatic

    manual:
        $config['hostname'] = '127.0.0.1';
        $config['username'] = 'root';
        $config['password'] = 'littlemini';
        $config['database'] = 'errand_db';

        $connection = $this->load->database($config);

    automatic:
        go to config/databases.php and set configurations there
        now go to config/autoload.php and do:
            $autoload['libraries'] = array('database');


    In model:
    $query = $this->db->get('users');
    return $query->result();
    //this gives all user info as array of objects

    In controller:
    $result = $this -> User_model -> get_users();
    foreach($result as $object){
                echo $object->id . '<br/>   ';
            }

    But the way we are echoing stuff here from the controller itself is not the right way
    We need to make a view

    make a view in views/user_view.php:
    now we need to put information inside this view. How do we do that?

    in controller:

    $data['welcome'] = "Welcome to my page";
    $data['results'] = $this -> User_model -> get_users();

    $this->load->view('user_view', $data)

    in view:
    <h1><?php echo $welcome; ?></h1>

    <?php
    foreach($results as $object){
    echo $object->username . '<br/>';
    }

    Thus we are using a controller to access a model. This model makes queries to the database.
    Controller is getting the data, load the view and transfer the data to view. This is MVC

    CRUD

    $query = $this->db->query("SELECT * FROM users");
    return $query->num_rows();
    or $query->num_fields();

    more functions:
    In model:
    public function get_users($user_id){
    $this->db->where('id', $user_id);
    OR
    $this->db->where(['id'=>$user_id])

    $query = $this->db->get('users');
    return $query->result();
    }
    So we need to pass in an id to this function
    In controller
    $data['results']=$this->User_model->get_users(1);

    Also we can pass in the id via url
    public function show($user_id){
    $data['results'] = $this -> User_model -> get_users($user_id);
    }

    More functionality to where:
    $this->db->where([
    'id'=>$user_id,
    'username'=>$username
    ])

    INSERTION

    Create method in model:
    public function create_users($data){
        $this->db->insert('users', $data);
    }

    Create method in controller

    public function insert(){
    $username= 'suraj';
    $password='1111';
    }
    $this->User_model->create_users([
        'username' => $username,
        'password' => $password
    ]);
    }

    UPDATE

    This method requires id to be passed explicitly

    Create method in model:
        public function update_users($data,$id){
            $this->db->where(['id'=>$id]);
            $this->db->update('users', $data);
        }

    Create method in controller

        public function update(){

        $id = 4;
        $username= 'bhagu';
        $password='111100';
        $this->User_model->update_users([
            'username' => $username,
            'password' => $password
        ],$id);
        }

    DELETE

    in controller:

    public function delete(){
    $id=4;
    $this->User_model->delete_user($id);
    }

    in model:

    public function delete_user($id){
    $this->db->where(['id'=>$id]);
    $this->db->delete('users');
    }


PROJECT

    STRUCTURE

    views
    ->layouts
      ->main.php

    In main.php build up a standard HTML template
    then link to stylesheets
    <link rel="stylesheet" href = "<?php echo base_url() ?>assets/css/bootstrap.min.css">
    similarly include js files
    So we have created a view

    Go to controller home.php
    It is currently displaying the home view

    public function index(){

    $data['main_view'] = "home_view"
    $this->load->view("layouts/main", $data);
    }

    this data contains a variable main_view which is home_view so from main.php we are loading in home_view
    this is just like im passing data with var $main_view to layouts/main.php. This var contains value home_view
    which is used to load up that view from main.php

    in main.php create a container and properly align stuff
    container
        row
            .xs-3
            .xs-9
                <?php $this->load->view($main_view);

    Configure for base_url() method
    go to applications/config
    $autoload['helper']=array('url');
    also configure ur base url
    $config['base_url'] = 'https://localhost/series/ci/'

    In home.php
    h1 HELLO this is a view


    I want to create another view
    views
     ->users
        ->login_view.php

    in main.php in .col-xs-3
    $this->load->view('users/login_view');


    Now build a form in login_view

    <?php
    echo form_open('Users/login', $attributes);
    echo form_close();
    ?>
    1st parameter is action second is for attributes
    But we need helper function for this to work
    in autoload:
    add form to helper

    Now add some attributes to form
    $attributes = array('id'=>'login_form', 'class'=>'form-horizontal');

    Now create some input elements
    .form-group
        <?php
        echo form_label('Username');
        ?>
        <?php
        $data = array(
        'class'=>'form-control',
        'name'=>'username',
        'placeholder'=>'Enter Username'
        )
        echo form_input($data);
        ?>

    Similarly we create password inputs and a button too

    Note: The action of the form points to a method in Users controller. Lets
    create that method

    In Users.php
    public function login(){

    }

    Now we need to include form validations
    for that include validation ie form_validation class in autoload libraries

    In Users.php
    public function login(){
    $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
    }
    Now we need to echo the error messages to the user
    We will do this using sessions
    $autoload['libraries'] -> session

    public function login(){
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
        if($this->form_validation->run()==FALSE){
            $data = array(
            'errors' => validation_errors()
            );

            $this->session->set_flashdata($data);
            redirect('home');
            //this not only sets session but unsets it also
        }
    }

    In login_view we want to display these errors
    just before opening form:
    <?php
    if($this->session->flashdata('errors'))
    {
    echo $this->session->flashdata('errors');
    }
    ?>


    Now create a confirm password field


    $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|min_length[3]|matches[password]')

    Now we have checked when there are errors in our form. Next we have to perform action
    when user submits form correctly

    public function login(){
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
            if($this->form_validation->run()==FALSE){
                $data = array(
                'errors' => validation_errors()
                );

                $this->session->set_flashdata($data);
                redirect('Home');
                //this not only sets session but unsets it also
            }
            else{
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->User_model->login_user($username, $password)
            }
        }

        Create this function in the model:

        public function login_user($username, $password){

            $this->db->where('username',$username);
            $this->db->where('password',$password);
            $result=$this->db->get('users');
            if($result->num_rows()==1){
                return $result->row(0)->id;
            }
            else{
                return false
            }

        }

        In controller in else statement:

        else{
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user_id = $this->User_model->login_user($username, $password);

            if($user_id){
                $user_data = array(
                    'user_id' => $user_id,
                    'username' => $username,
                    'logged_in' => true
                );

                $this->session->set_userdata($user_data);
                //this does not unset the session automatically like flash_data() method
                $this->session->set_flashdata('login_success','You are now logged in');
                redirect('Home/index');
            }
            else{
                $this->session->set_flashdata('login_failed','Sorry ... Wrong credentials');
                redirect('Home/index');
            }
        }

        In home_view

        <p class="bg-success">
        <?php
            if($this->session->flash_data('login_success')){
                echo $this->session->flash_data('login_success');
            }
        ?>
        </p>

        <p class="bg-danger">
        <?php
            if($this->session->flash_data('login_failed')){
                echo $this->session->flash_data('login_failed');
            }
        ?>
        </p>

        <h4>Hello.. This is Home View</h4>

        Now we want to display form only when user is not logged in


        <?php if ($this->session->userdata('logged_in')): ?>
            <br/>
            <h4>Hi....<?php $this->session->userdata('username'); ?></h4>
            <br/>
            <?php
            echo form_open('Users/logout');
            $data = array(
                'class' => 'btn btn-primary',
                'name' => 'submit',
                'value' => 'Log Out'
            );
            echo form_submit($data);
            ?>


        <?php else: ?>

        //display form here


        Creating logout method in Users.php:

        public function logout(){
                $this->session->sess_destroy();
                redirect('Home/index');
            }



        Create separate admin view

        views
        ->users
            admin_view.php

        <h2>Admin View</h2>

        After logging in instead of redirecting

        $data['main_view'] = "users/admin_view";
        $this->load->view('layouts/main', $data);

        So main.php loads up admin_view instead of home_view












