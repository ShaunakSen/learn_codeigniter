<h4>Login Form</h4>

<?php
$attributes = array('id' => 'login_form', 'class' => 'form-horizontal');

if($this->session->flashdata('errors'))
{
    echo $this->session->flashdata('errors');
}

echo form_open("Users/login", $attributes);
?>
<br/>
<div class="form-group">
    <?php
    echo form_label('Username');

    $data = array(
        'class'=>'form-control',
        'name'=>'username',
        'placeholder'=>'Enter Username'
    );

    echo form_input($data);
    echo '<br/>';
    echo form_label('Password');

    $data = array(
        'class'=>'form-control',
        'name'=>'password',
        'placeholder'=>'Enter Password'
    );
    echo form_password($data);

    echo '<br/>';
    echo form_label('Confirm Password');

    $data = array(
        'class'=>'form-control',
        'name'=>'confirm_password',
        'placeholder'=>'Confirm Password'
    );

    echo form_password($data);
    echo '<br/>';
    $data = array(
        'class'=>'btn btn-primary',
        'name'=>'submit',
        'value'=>'Login'
    );
    echo form_submit($data);

    ?>
</div>


<?
echo form_close();
?>