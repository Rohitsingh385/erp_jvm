<div style="padding: 5px; background-color: white" class="table-responsive">

    <table style="width:100%">
        <tr>
            <td>
                <center><img src="assets/school_logo/cbse_logo.jpg" style="margin-left:5%; width:83px;"></center>
            </td>
            <td>
                <center>
                    <h1><span style="color:#02933e;font-size:24px !important;">JAWAHAR VIDYA MANDIR</span></h1>Shyamali Colony, Doranda, Ranchi-834002<br />Session- ( 2024-2025 )<br />EXAM WISE TABULATION SHEET <?php echo $details[0]->ExamName; ?> Class <?php echo $details[0]->CLASS_NM; ?>-<?php echo $details[0]->SECTION_NAME; ?>
                </center>
            </td>
            <td>
                <center><img src="assets/school_logo/jvm.png" style="margin-left:5%; width:83px;"></center>
            </td>
        </tr>
    </table>
<br><hr>
    <table border="1" cellspacing="0">
        <thead>
            <tr>
                <th>Name</th>
                <th>Adm. No.</th>
                <th>Roll No.</th>

                <?php
                foreach ($subjects as $kkey) {
                ?>
                    <th><?php echo $kkey->subj_nm; ?></th>
                    <?php
                    if ($cls != 12) {
                    ?>

                    <?php } ?>
                <?php } ?>

                <th>Total</th>
				<th>Signature</th>

            </tr>
        </thead>
        <tbody>
            <?php

            foreach ($stu_data as $kkeyo) {
                $gt = 0;
            ?>
                <tr>
                    <th><?php echo $kkeyo['name']; ?></th>
                    <td><?php echo $kkeyo['adm_no']; ?></td>
                    <td><?php echo $kkeyo['roll_no']; ?></td>
                    <?php foreach ($kkeyo['subjects'] as $kk) {
                    ?>
                        <td><center><?php echo $kk['subject_marks']; ?></center></td>
                        <?php
                        if ($cls != 12) {
                        ?>

                        <?php } ?>
                    <?php
                        $gt += ($kk['opt_code'] != '1') ? $kk['hundred'] : 0;
                    } ?>

                    <?php
                    if ($cls == 14) {
                        $divd = 5;
                        $tot = $gt / 4;
                    } else {
                        $divd = 4;
                        $tot = $gt;
                    }
                    ?>
                    <td><center><?php echo $gt; ?></center></td>
					<td></td>

                </tr>
            <?php } ?>

        </tbody>
    </table>

</div>