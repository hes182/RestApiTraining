<div class="row mb-3 pt-5">
    <div class="col-md">
        <h5>MEMPERBARUI DATA CLUB</h5>
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
        <form method="POST" action="<?=base_url('club_controller/putDataClub');?>">
            <input hidden type="number" name="id" value="<?=$idclub;?>" required>
            <div class="form-group">
                <label for="clubname">Club Name</label>
                <input class="form-control" type="text" name="clubname" value="<?=$clubname;?>" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input class="form-control" type="text" name="city" value="<?=$city;?>" required>
            </div>
            <input class="btn btn-primary" type="submit" value="Simpan">
        </form>
    </div>
</div>