<div class='table-responsive'>
    <table class='table'>
        <tr>
            <th style='background:#5785c3; color:#fff!important;'>Adm No.</th>
            <th style='background:#5785c3; color:#fff!important;'>Name</th>
            <th style='background:#5785c3; color:#fff!important;'>Roll No.</th>
            <th style='background:#5785c3; color:#fff!important;'>Promoted</th>
        </tr>
        <?php
        foreach ($get_stu as $key => $val) {
            $admno = str_replace('/', '_', $val['ADM_NO']);
            $get   = $this->alam->selectA('student', 'promot', "adm_no='".$val['ADM_NO']."'");
            // echo "<pre>";print_r($get);die;

        ?>
            <tr>
                <td><?php echo $val['ADM_NO']; ?></td>
                <td><?php echo $val['FIRST_NM']; ?></td>
                <td><?php echo $val['ROLL_NO']; ?></td>
                <td>
                    <select class="form-control" name="spcl_achvmnt" id="spcl_achvmnt_<?php echo $admno; ?>" onchange="saveAchievement(this.value,'<?php echo $admno; ?>','<?php echo $val['ADM_NO']; ?>','<?php echo $term; ?>')">
                        <option value="none">Select</option>
                        <option value="VI" <?php echo ($get[0]['promot'] == 'VI') ? "selected" : "" ?>>VI</option>
                        <option value="VII" <?php echo ($get[0]['promot'] == 'VII') ? "selected" : "" ?>>VII</option>
                        <option value="VIII" <?php echo ($get[0]['promot'] == 'VIII') ? "selected" : "" ?>>VIII</option>
                        <option value="IX" <?php echo ($get[0]['promot'] == 'IX') ? "selected" : "" ?>>IX</option>
                        <option value="X" <?php echo ($get[0]['promot'] == 'X') ? "selected" : "" ?>>X</option>
                    </select>

                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>
<script>
    function saveAchievement(val, admno_replace, admno, term) {
        // alert(admno_replace);
        $.ajax({
            url: "<?php echo base_url('SpecialAchievement/saveAchievement'); ?>",
            type: "POST",
            data: {
                val: val,
                admno: admno,
                term: 'TERM-2'
            },
            success: function(ret) {
                 if (ret == '0') {
                     alert('Enter Valid Entry..!');
                     $("#spcl_achvmnt_" + admno_replace).val('');
                 } else {
                    $("#spcl_achvmnt_" + admno_replace).val(ret);
                 }
            }
        });
    }
</script>