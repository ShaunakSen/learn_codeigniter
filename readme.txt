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

