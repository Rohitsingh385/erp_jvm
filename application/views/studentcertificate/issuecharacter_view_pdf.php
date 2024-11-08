<?php foreach ($stu_list_all as $stu_list) {    ?>

    <div class="parent">

    </div>


    <table style="width:100%">
        <tr>

            <td>
                <center style="font-size: 18px; font-family: Verdana, Geneva, Tahoma, sans-serif !important;;"><b>( Affiliated to CBSE-New Delhi, Code-CBSE/Affl./3430004 )<br>SHYAMALI, RANCHI - 834002, JHARKHAND</b></center>
            </td>
            

        </tr>
    </table>
    <!-- <table style="width:100%" >
    <tr>
       <td><center><h3><span style="color:#000000"><u>CHARACTER CERTIFICATE</u></span></h3></center></td>
</tr>
</table><br> -->
    <br><br>
    <table align="right">
        <tr>
            <td>Sl No.&nbsp;&nbsp; <?php echo $stu_list['CERT_NO']; ?></td>

        </tr><br><br>
    </table>
    <p class="line">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  This is to certify that <?php echo $stu_list['S_NAME']; ?> s/o,d/o <?php echo $stu_list['M_Name']; ?> & <?php echo $stu_list['F_NAME']; ?> has <?php echo $stu_list['remark1']; ?> the <?php echo $stu_list['remark2']; ?> in the year <?php echo $stu_list['remark5']; ?> from this institution conducted by the <?php echo $stu_list['remark3']; ?>
    </p>
    <br>
   <p class="line"> He bears a good moral character and conduct. </p>
    <br><br>
    <table style="width:100%">
        <tr>
            <td colspan="2">Date : <?php echo date("d-m-Y", strtotime($stu_list['Issued_Date'])) ?> </td>

            <td colspan="2" style="text-align: right;">Principal</td>
        </tr>

    </table>
    <p style="page-break-after: always;">&nbsp;</p>
<?php } ?>

<style type="text/css">
    .parent {
        margin: 15px auto 0 auto;
        width: 400px;
        height: 100px;
    }
    @page { margin: 15px 75px 38px 75px; }
</style>
<style>
    .line {
		font-family: Verdana, Geneva, Tahoma, sans-serif !important;
        line-height: 1.9;
        text-align: justify;
        text-justify: inter-word;
        font-size: 18px;
    }
</style>