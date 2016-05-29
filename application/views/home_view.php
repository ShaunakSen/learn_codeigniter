<br/>
<p class="bg-success">
    <?php
    if ($this->session->flashdata('login_success')) {
        echo $this->session->flashdata('login_success');
    }
    ?>
</p>

<p class="bg-danger">
    <?php
    if ($this->session->flashdata('login_failed')) {
        echo $this->session->flashdata('login_failed');
    }
    ?>
</p>

<h4>Hello.. This is Home View</h4>