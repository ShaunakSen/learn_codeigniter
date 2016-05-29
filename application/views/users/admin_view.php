
<p class="bg-success">
    <?php
    if ($this->session->flashdata('login_success')) {
        echo $this->session->flashdata('login_success');
    }
    ?>
</p>

<h2>Admin Page</h2>