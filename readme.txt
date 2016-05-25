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