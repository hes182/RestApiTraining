
<div class="row mb-3 pt-5">
    <div class="col-md">
        <h5>DATA CLUB FOOTBALL</h5>
        <a class="btn btn-primary btn-sm mr-2" href="<?=base_url('club_controller/addclub');?>"><i class="fa fa-plus-circle"></i> Tambah Data</a>
    <?php if ($result) { ?>
        <button type="button" class="btn btn-secondary btn-sm">
            Total Data <span class="badge badge-light"><?=$result['total_results'];?></span>
        </button>
    <?php } ?>
    </div>
</div>

<?php if (!empty($this->session->flashdata('msg'))) { ?>
<div class="row">
    <div class="col-md">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?=$this->session->flashdata('msg');?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
<?php } ?>

<div class="row">
    <div class="col-md">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Club Name</th>
                    <th>City</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
            <?php if ($result['status_code'] == "1") { foreach ($result['results'] as $val) { ?>
                <tr>
                    <td><?=$val['clubName'];?></td>
                    <td><?=$val['cityClub'];?></td>
                    <td>
                        <a class="btn btn-warning btn-sm mr-1" href="<?=base_url('club_controller/getClub/'.$val['idClub']);?>"><i class="fa fa-pencil"></i></a>
                        <a class="btn btn-danger btn-sm" href="<?=base_url('club_controller/delClub/'.$val['idClub']);?>"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php } } else { ?>
                <tr>
                    <td class="text-center" colspan="6">Data tidak ditemukan</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php if ($result['status_code'] == 1) { ?>
<div class="row">
    <div class="col-md">
    <?php 
        $offset = $this->input->get('offset', TRUE);
        if (empty($offset) || $offset === NULL || $offset == 0) { 
    ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#"><i class="fa fa-arrow-circle-left"></i></a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?=base_url('club_controller/getdata?offset=10');?>"><i class="fa fa-arrow-circle-right"></i></a>
                </li>
            </ul>
        </nav>
    <?php 
        } else { 
            $next = $offset + 10;
            $prev = $offset - 10;
            if ($next <= $result['total_results']) {
    ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="<?=base_url('club_controller/getdata?offset='.$prev);?>"><i class="fa fa-arrow-circle-left"></i></a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="<?=base_url('club_controller/getdata?offset='.$next);?>"><i class="fa fa-arrow-circle-right"></i></a>
                </li>
            </ul>
        </nav>
    <?php 
            } else {
    ?>
        <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="<?=base_url('club_controller/getdata?offset='.$prev);?>"><i class="fa fa-arrow-circle-left"></i></a>
                    </li>
                    <li class="page-item disabled">
                        <a class="page-link" href="#"><i class="fa fa-arrow-circle-right"></i></a>
                    </li>
                </ul>
            </nav>
    <?php
            }
        } 
    ?>        
    </div>
</div>
<?php } ?>