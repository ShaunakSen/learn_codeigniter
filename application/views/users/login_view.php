<h4>Login Form</h4>
<?php
$attributes = array(
    'id' => 'login_form',
    'class' => 'form-horizontal'
);
form_open("users/login_view", $attributes);
?>

<div class="form-group">
    <?php
    echo form_label('Username');
    $data = array(
        'class' => 'form-control',
        'name' => 'username',
        'placeholder' => 'Enter Username'
    );
    echo form_input($data);
    ?>
</div>


<?php
form_close("users/login_view", $attributes);
?>