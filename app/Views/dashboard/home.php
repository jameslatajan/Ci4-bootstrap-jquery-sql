<?= $this->extend('layouts/dashboard-layout') ?>
<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">List of Users</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listUsers->getResult() as $row):?>
                <tr>
                    <td><?php echo $row->id;?></td>
                    <td><?php echo $row->name;?></td>
                    <td><?php echo $row->email;?></td>
                    <td><?php echo $row->password;?></td>
                   
                </tr>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
    <?= $this->endSection() ?>