<?php

class Consolidated_report extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->loggedOut();
    }

    public function index()
    {
        if (!in_array('viewMonthlyPFReport', permission_data)) {
            redirect('payroll/dashboard/dashboard');
        }

        $data['title'] = "Consolidated Salary";
        if (isset($_POST['search'])) {
            $resultList = array();
            $date = $this->input->post('date');
            $month = date('m', strtotime($date));
            $year = date('Y', strtotime($date));
            $data['month'] = $month;
            $data['year'] = $year;
            $check_data = $this->sumit->checkData('id', 'payslip_dbo', array('payslip_month' => $month, 'payslip_year' => $year));
            if ($check_data) {
                $resultList = $this->Salary_Model->consolidatedsalary($year, $month);
                // $this->session->set_userdata('consolidatedreport', $resultList);
                foreach ($resultList as $key => $value) {

                    /* Earning Head */
                    $TA += $value['ta_pay'];
                    $DA += $value['da_pay'];
                    $FixAl += $value['fixed_allowance'];
                    $ShiftAl += $value['shift_allowance'];
                    $ShRent += $value['sh_rent'];
                    $MobileRec += $value['mobile_recharge'];
                    $HRA += $value['hra_pay'];
                    $YearlyFee += $value['yearly_fee'];
                    $Basic += $value['basic_salary'];
                    $ArrSal += $value['arrear_basic'] + $value['arrear_da'];
                    $OtherArr += $value['arrear_hra'] + $value['arrear_ta'] + $value['arrear_fixed_allow'] + $value['arrear_shift_allow'];
                    $MedRem += $value['medical_reimbursement'];

                    /* Deduction Head */
                    $LEAVSAL += $value['actual_basic'] - $value['basic_salary'];
                    $MEDICAL += $value['medical_deduct'];
                    $eps = 0;
                    if ($value['pension_applied'] == 1) {
                        $eps_count++;
                        if ($value['basic_salary'] >= $value['pension_pay_limit']) {
                            $eps = ($value['pension_pay_limit'] * $value['pension_rate']) / 100;
                        } else {
                            $eps = ($value['basic_salary'] * $value['pension_rate']) / 100;
                        }
                    }

                    if ($value['pf_app'] == 1) {
                        $epf_count++;
                    }

                    $EPSS += $eps;
                    $EPFF += $value['pf_own_deduct'];
                    $MPF += $value['pf_own_deduct'] + $eps;
                    $SALADV += $value['advance_salary_deduct'];
                    $VPF += $value['vpf_deduct'];
                    $SWF += $value['staff_welfare_fund'];
                    $LIC += $value['lic'];
                    $HRENT += $value['hra_rent_deduct'];
                    $TDS += $value['tds_deduct'];
                    $SECURITY += $value['hra_security_deduct'];
                    $GRPINS += $value['group_insurance_amt'];
                    $BUS += $value['bus_deduction'];
                    $GARAGERENT += $value['hra_garage_deduct'];
                    $ELECTRICITY += $value['hra_elect_deduct'];

                    $esi_amt = 0;
                    if ($value['esi_app'] == 1) {

                        if ($value['basic_salary'] >= $value['esi_limit']) {
                            $esi_amt = ($value['esi_limit'] * $value['esi_own_rate']) / 100;
                        } else {
                            $esi_amt = ($value['basic_salary'] * $value['esi_own_rate']) / 100;
                        }
                    }
                    $ESI += $esi_amt;
                }
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-info">Payslip not generated for this month.</div>');
            }

            $total_earning = $TA + $DA + $FixAl + $ShiftAl + $ShRent + $MobileRec + $HRA + $YearlyFee + $Basic + $ArrSal + $OtherArr + $MedRem;
            $total_deduction = $LEAVSAL + $MEDICAL + $MPF + $SALADV + $VPF + $SWF + $ESI + $LIC + $HRENT + $TDS + $SECURITY + $GRPINS + $BUS + $GARAGERENT + $ELECTRICITY;

            $result['earning'] = array(
                'TA' => $TA,
                'DA' => $DA,
                'FIXAL' => $FixAl,
                'SHIFTAL'=> $ShiftAl,
                'SHRENT' => $ShRent,
                'MOBILE REC.' => $MobileRec,
                'HRA' => $HRA,
                'YEARLY FEE' => $YearlyFee,
                'BASIC' => $Basic,
                'ARRSAL' => $ArrSal,
                'OTHER ARR' => $OtherArr,
                'MED. REM.' => $MedRem,
                'TOT EARNING'  => $total_earning
            );

            $result['deduction'] = array(
                'LEAV. SAL.' => $LEAVSAL,
                'MEDICAL' => $MEDICAL,
                'MPF' => $MPF,
                'SAL. ADV.' => $SALADV,
                'VPF' => $VPF,
                'SWF' => $SWF,
                'ESIC' => $ESI,
                'LIC' => $LIC,
                'HRENT' => $HRENT,
                'ITAX' => $TDS,
                'SECURITY' => $SECURITY,
                'GRP. INS.' => $GRPINS,
                'BUS' => $BUS,
                'GARAGE REN' => $GARAGERENT,
                'ELECTRICITY' => $ELECTRICITY,
                'TOT DEDUCTION' => $total_deduction,
            );
            $result['data'] = array(
                'EPSS' => $EPSS,
                'EPFF' => $EPFF,
                'EPF COUNT' => $epf_count,
                'EPS COUNT' => $eps_count
            );
            // $data['earning']=$earning;
            // $data['deduction']=$deduction;
            $data['result'] = $result;
        }
        $this->render_template('salary_report/consolidatedReport', $data);
    }
    public function generatePDFReport($year, $month)
    {

        ini_set('memory_limit', '-1');
		$data['school_setting'] = $this->sumit->fetchSingleData('*','school_setting',array('S_No'=>1));
		
		$current_session =$this->sumit->fetchSingleData('Session_Nm','session_master',array('Active_Status'=>1));
		$data['current_session'] = $current_session;

        $data['month'] = $month;
        $data['year'] = $year;
        $check_data = $this->sumit->checkData('id', 'payslip_dbo', array('payslip_month' => $month, 'payslip_year' => $year));
        if ($check_data) {
            $resultList = $this->Salary_Model->consolidatedsalary($year, $month);
            // $this->session->set_userdata('consolidatedreport', $resultList);
            foreach ($resultList as $key => $value) {

                /* Earning Head */
                $TA += $value['ta_pay'];
                $DA += $value['da_pay'];
                $FixAl += $value['fixed_allowance'];
                $ShiftAl += $value['shift_allowance'];
                $ShRent += $value['sh_rent'];
                $MobileRec += $value['mobile_recharge'];
                $HRA += $value['hra_pay'];
                $YearlyFee += $value['yearly_fee'];
                $Basic += $value['basic_salary'];
                $ArrSal += $value['arrear_basic'] + $value['arrear_da'];
                $OtherArr += $value['arrear_hra'] + $value['arrear_hra'] + $value['arrear_ta'] + $value['arrear_fixed_allow'] + $value['arrear_shift_allow'];
                $MedRem += $value['medical_reimbursement'];

                /* Deduction Head */
                $LEAVSAL += $value['actual_basic'] - $value['basic_salary'];
                $MEDICAL += $value['medical_deduct'];
                $eps = 0;
                if ($value['pension_applied'] == 1) {
                    $eps_count++;
                    if ($value['basic_salary'] >= $value['pension_pay_limit']) {
                        $eps = ($value['pension_pay_limit'] * $value['pension_rate']) / 100;
                    } else {
                        $eps = ($value['basic_salary'] * $value['pension_rate']) / 100;
                    }
                }

                if ($value['pf_app'] == 1) {
                    $epf_count++;
                }

                $EPSS += $eps;
                $EPFF += $value['pf_own_deduct'];
                $MPF += $value['pf_own_deduct'] + $eps;
                $SALADV += $value['advance_salary_deduct'];
                $VPF += $value['vpf_deduct'];
                $SWF += $value['staff_welfare_fund'];
                $LIC += $value['lic'];
                $HRENT += $value['hra_rent_deduct'];
                $TDS += $value['tds_deduct'];
                $SECURITY += $value['hra_security_deduct'];
                $GRPINS += $value['group_insurance_amt'];
                $BUS += $value['bus_deduction'];
                $GARAGERENT += $value['hra_garage_deduct'];
                $ELECTRICITY += $value['hra_elect_deduct'];

                $esi_amt = 0;
                if ($value['esi_app'] == 1) {

                    if ($value['basic_salary'] >= $value['esi_limit']) {
                        $esi_amt = ($value['esi_limit'] * $value['esi_own_rate']) / 100;
                    } else {
                        $esi_amt = ($value['basic_salary'] * $value['esi_own_rate']) / 100;
                    }
                }
                $ESI += $esi_amt;
            }
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-info">Payslip not generated for this month.</div>');
        }

        $total_earning = $TA + $DA + $FixAl + $ShiftAl + $ShRent + $MobileRec + $HRA + $YearlyFee + $Basic + $ArrSal + $OtherArr + $MedRem;
        $total_deduction = $LEAVSAL + $MEDICAL + $MPF + $SALADV + $VPF + $SWF + $ESI + $LIC + $HRENT + $TDS + $SECURITY + $GRPINS + $BUS + $GARAGERENT + $ELECTRICITY;

        $result['earning'] = array(
            'TA' => $TA,
            'DA' => $DA,
            'FIXAL' => $FixAl,
            'SHIFTAL'=> $ShiftAl,
            'SHRENT' => $ShRent,
            'MOBILE REC.' => $MobileRec,
            'HRA' => $HRA,
            'YEARLY FEE' => $YearlyFee,
            'BASIC' => $Basic,
            'ARRSAL' => $ArrSal,
            'OTHER ARR' => $OtherArr,
            'MED. REM.' => $MedRem,
            'TOT EARNING'  => $total_earning
        );

        $result['deduction'] = array(
            'LEAV. SAL.' => $LEAVSAL,
            'MEDICAL' => $MEDICAL,
            'MPF' => $MPF,
            'SAL. ADV.' => $SALADV,
            'VPF' => $VPF,
            'SWF' => $SWF,
            'ESIC' => $ESI,
            'LIC' => $LIC,
            'HRENT' => $HRENT,
            'ITAX' => $TDS,
            'SECURITY' => $SECURITY,
            'GRP. INS.' => $GRPINS,
            'BUS' => $BUS,
            'GARAGE REN' => $GARAGERENT,
            'ELECTRICITY' => $ELECTRICITY,
            'TOT DEDUCTION' => $total_deduction,
        );
        $result['data'] = array(
            'EPSS' => $EPSS,
            'EPFF' => $EPFF,
            'EPF COUNT' => $epf_count,
            'EPS COUNT' => $eps_count
        );
        // $data['earning']=$earning;
        // $data['deduction']=$deduction;
        $data['result'] = $result;

        $this->load->view('salary_report/consolidatedReportPDF', $data);

        $html = $this->output->get_output();
		$this->load->library('pdf');
		$this->dompdf->loadHtml($html);
		$this->dompdf->setPaper('A4', 'portrait');
		$this->dompdf->render();
		$this->dompdf->set_option("isPhpEnabled", true);
		$this->dompdf->stream("monthlypfpdf.pdf", array("Attachment"=>0));

    }
}
